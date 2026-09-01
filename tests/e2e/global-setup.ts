import { execFile } from 'child_process';
import { promisify } from 'util';
import { baseUrl, hasMysql, targetEnv } from './env';
import {
  connectionArgs,
  readDbConfig,
  snapshotThemeMods,
} from './fixtures/theme-mods-snapshot';

const execFileAsync = promisify(execFile);

/**
 * Prepare the target site, once, before any test runs.
 *
 * Authentication is deliberately NOT here any more — it is `auth.setup.ts`, a
 * real setup project, so a failed login gets a trace and a screenshot instead
 * of an opaque global-setup crash.
 *
 * What is left is the DB-level state hygiene that only makes sense against a
 * long-lived MySQL site. Every step below is gated on `hasMysql()` rather than
 * attempted-and-caught: on Playground there is no MySQL and no `mysql` binary,
 * so an ungated `clearStaleChangesets()` threw before the first `@fresh` test
 * could run — which made the entire CI tier unreachable for a reason that had
 * nothing to do with any spec.
 */
export default async function globalSetup() {
  const env = targetEnv();
  console.warn(`colormag e2e: target ${baseUrl()} (env: ${env})`);

  if (!hasMysql()) {
    console.warn(
      `colormag e2e: '${env}' is a disposable site — skipping changeset cleanup and theme-mod ` +
        'snapshot. Both exist to protect a real site from a run; there is nothing here to protect.',
    );
    return;
  }

  await clearStaleChangesets();

  // Baseline for restoreThemeMods(), called after every customizer-fixture
  // test regardless of pass/fail, and once more in global-teardown.ts.
  await snapshotThemeMods();
}

/**
 * Trashes any stale `auto-draft` customize_changeset posts before the suite
 * runs, so every spec's first Customizer `open()` starts from a genuinely
 * empty changeset instead of silently loading a leftover, unpublished draft.
 *
 * Why this exists: without it, opening the Customizer offers to "restore the
 * more recent autosave" whenever this WP user has an unpublished changeset
 * sitting around — which any earlier crashed or interrupted spec run leaves
 * behind (every setControl() without a following publish() autosaves one). A
 * restored draft can carry a *different* value than what is actually
 * published, which made setControl()-to-the-original-value look like a no-op
 * in testing (nothing to publish, because the draft already matched) even
 * though the live site still had the test's changed value — a confusing,
 * silent source of run-to-run difference that has nothing to do with the spec
 * being run. Confirmed causing exactly that during this suite's development.
 *
 * `customize_changeset` is not a REST-exposed post type, so this shells out to
 * a `mysql` client directly, configured via WP_DB_* env vars. Trashes rather
 * than deletes, matching how WP's own UI handles removal.
 *
 * Still a hard precondition — on `local`. The throw is what keeps two
 * consecutive runs comparable, which is the single signal section 11 asks for.
 */
async function clearStaleChangesets(): Promise<void> {
  const config = readDbConfig();

  const sql =
    `UPDATE ${config.tablePrefix}posts SET post_status='trash' ` +
    `WHERE post_type='customize_changeset' AND post_status='auto-draft';`;

  const args = [...connectionArgs(config), '-u', config.user];
  if (config.password) args.push(`-p${config.password}`);
  args.push('-e', sql, config.database);

  try {
    const { stderr } = await execFileAsync(config.mysqlBin, args);
    // The mysql CLI writes its "using a password" notice to stderr even on
    // success — only treat stderr as a real problem if it does not match that.
    if (stderr && !/using a password/i.test(stderr)) {
      console.warn(`clearStaleChangesets: mysql reported: ${stderr.trim()}`);
    }
  } catch (err) {
    throw new Error(
      `clearStaleChangesets: failed to run mysql to trash stale changesets (${(err as Error).message}). ` +
        'Fix the WP_DB_* settings in .env.local before running the suite — see the comment on ' +
        'clearStaleChangesets() in this file for why this is a hard precondition.',
    );
  }
}
