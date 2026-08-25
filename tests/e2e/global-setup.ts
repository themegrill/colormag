import { chromium, type FullConfig } from '@playwright/test';
import dotenv from 'dotenv';
import path from 'path';
import fs from 'fs';
import { execFile } from 'child_process';
import { promisify } from 'util';
import { snapshotThemeMods } from './fixtures/theme-mods-snapshot';

dotenv.config({ path: path.join(__dirname, '.env') });

const execFileAsync = promisify(execFile);
const STORAGE_STATE = path.join(__dirname, '.auth/admin.json');

/**
 * Logs into wp-admin once per test run and saves the session as
 * Playwright storageState, so every spec starts already authenticated
 * instead of re-running the login flow per test.
 */
export default async function globalSetup(config: FullConfig) {
  const baseURL = config.projects[0]?.use?.baseURL ?? process.env.WP_BASE_URL ?? 'http://test-colormag.local';
  const user = process.env.WP_ADMIN_USER;
  const password = process.env.WP_ADMIN_PASSWORD;

  if (!user || !password) {
    throw new Error(
      'WP_ADMIN_USER / WP_ADMIN_PASSWORD are not set. Copy tests/e2e/.env.example to ' +
        'tests/e2e/.env and fill in a real admin account on the target site before running the suite.',
    );
  }

  await clearStaleChangesets();

  // Baseline for restoreThemeMods(), called after every customizer-fixture
  // test regardless of pass/fail — see fixtures/theme-mods-snapshot.ts.
  await snapshotThemeMods();

  fs.mkdirSync(path.dirname(STORAGE_STATE), { recursive: true });

  const browser = await chromium.launch();
  const page = await browser.newPage({ baseURL: baseURL as string });

  await page.goto('/wp-login.php');
  await page.locator('#user_login').fill(user);
  await page.locator('#user_pass').fill(password);
  await page.locator('#wp-submit').click();

  // wp-admin's toolbar only renders once the login round-trip completed.
  await page.locator('#wpadminbar').waitFor({ state: 'visible', timeout: 15_000 });

  await page.context().storageState({ path: STORAGE_STATE });
  await browser.close();
}

/**
 * Trashes any stale `auto-draft` customize_changeset posts before the suite
 * runs, so every spec's first Customizer `open()` starts from a genuinely
 * empty changeset instead of silently loading a leftover, unpublished draft.
 *
 * Why this exists: without it, opening the Customizer offers to "restore
 * the more recent autosave" whenever this WP user has an unpublished
 * changeset sitting around — which any earlier crashed/interrupted spec run
 * leaves behind (every setControl() without a following publish() autosaves
 * one). A restored draft can carry a *different* value than what's actually
 * published, which made setControl()-to-the-original-value look like a
 * no-op in testing (nothing to publish, because the draft already matched)
 * even though the live site still had the test's changed value — a
 * confusing, silent source of run-to-run difference that has nothing to do
 * with the spec being run. Confirmed causing exactly that during this
 * suite's own development (see customizer.ts's `publish()` comments).
 *
 * `customize_changeset` is not a REST-exposed post type and WP-CLI is not
 * assumed available in every environment this suite runs in (see
 * .themegrill-qa/knowledge.md, Environment notes) — so this shells out to
 * a `mysql` client directly, configured via WP_DB_* env vars. Trashes
 * rather than deletes, matching how WP's own UI handles removal.
 */
async function clearStaleChangesets(): Promise<void> {
  const host = process.env.WP_DB_HOST;
  const port = process.env.WP_DB_PORT ?? '3306';
  const dbUser = process.env.WP_DB_USER;
  const dbPassword = process.env.WP_DB_PASSWORD;
  const database = process.env.WP_DB_NAME;
  const mysqlBin = process.env.WP_DB_MYSQL_BIN ?? 'mysql';
  const tablePrefix = process.env.WP_DB_TABLE_PREFIX ?? 'wp_';

  if (!host || !dbUser || !database) {
    throw new Error(
      'WP_DB_HOST / WP_DB_USER / WP_DB_NAME are not set — cannot clear stale Customizer ' +
        'changesets before this run. Copy tests/e2e/.env.example to tests/e2e/.env and fill ' +
        'in the target site\'s DB connection (WP_DB_PASSWORD and WP_DB_PORT too, if needed; ' +
        'WP_DB_MYSQL_BIN if the mysql client is not on PATH). This is a hard precondition, not ' +
        'an optional one — without it, a run can silently load a leftover autosaved changeset ' +
        'instead of starting clean, making two consecutive runs of the same suite legitimately ' +
        'diverge for reasons that have nothing to do with the specs themselves.',
    );
  }

  const sql =
    `UPDATE ${tablePrefix}posts SET post_status='trash' ` +
    `WHERE post_type='customize_changeset' AND post_status='auto-draft';`;

  const args = ['-h', host, '-P', port, '-u', dbUser];
  if (dbPassword) args.push(`-p${dbPassword}`);
  args.push('-e', sql, database);

  try {
    const { stderr } = await execFileAsync(mysqlBin, args);
    // The mysql CLI writes its "using a password" notice to stderr even on
    // success — only treat stderr as a real problem if it doesn't match that.
    if (stderr && !/using a password/i.test(stderr)) {
      console.warn(`clearStaleChangesets: mysql reported: ${stderr.trim()}`);
    }
  } catch (err) {
    throw new Error(
      `clearStaleChangesets: failed to run mysql to trash stale changesets (${(err as Error).message}). ` +
        'Fix the WP_DB_* connection settings in tests/e2e/.env before running the suite — see the ' +
        'comment on clearStaleChangesets() in this file for why this is a hard precondition.',
    );
  }
}
