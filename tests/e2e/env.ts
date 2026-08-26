import dotenv from 'dotenv';
import path from 'path';

/**
 * The single place this suite decides *which site it is talking to*.
 *
 * Three callers drive these specs and none of them can be asked to adopt
 * another's variable names, so every value resolves through the same
 * precedence chain instead of each module reading `process.env` its own way
 * (which is how `playwright.config.ts` and `global-setup.ts` previously
 * drifted into two different `baseURL` fallbacks that only happened to agree):
 *
 *   1. `TGQA_*`  — exported by themegrill-qa's run-suite.mjs. Wins, because
 *                  when the platform is driving, the platform decides.
 *   2. `CM_*`    — a developer's own override, from a gitignored .env.local.
 *   3. `WP_*`    — what this suite read before the platform existed. Kept so
 *                  an existing tests/e2e/.env keeps working; documented as
 *                  legacy in tests/e2e/README.md, not advertised.
 *   4. a default — for the base URL only. Never for credentials.
 */

// Real environment variables always win: dotenv does not overwrite what is
// already set, so a run-suite.mjs-exported TGQA_* survives a stale .env.local.
// Theme root first — that is where the prompt-2 contract puts .env.local, and
// where `pnpm test:e2e` is run from.
dotenv.config({ path: path.join(__dirname, '..', '..', '.env.local') });
// Legacy location, kept working rather than migrated for anyone who has one.
dotenv.config({ path: path.join(__dirname, '.env') });

/** Convenience default, so `pnpm test:e2e` needs no setup on the Local site. */
export const DEFAULT_BASE_URL = 'http://test-colormag.local';

/**
 * Where the logged-in admin session is cached between runs.
 *
 * Declared here rather than in `auth.setup.ts` because `playwright.config.ts`
 * needs it too, and a config file may not import a module that calls `test()`
 * — Playwright rejects that with "did not expect test() to be called here".
 * Gitignored via `tests/e2e/.gitignore`.
 */
export const STORAGE_STATE = path.join(__dirname, '.auth', 'admin.json');

export type TargetEnv = 'playground' | 'wp-env' | 'local';

export function baseUrl(): string {
  return (
    process.env.TGQA_BASE_URL ??
    process.env.CM_BASE_URL ??
    process.env.WP_BASE_URL ??
    DEFAULT_BASE_URL
  );
}

/**
 * Which kind of environment we are pointed at.
 *
 * Specs read this to skip what genuinely cannot work rather than to weaken an
 * assertion: Playground is PHP-WASM on SQLite, with no real cron, no outbound
 * mail and no MySQL. A spec that needs one of those states that reason in its
 * skip message — see `skipOnPlayground()` below.
 */
export function targetEnv(): TargetEnv {
  const raw = (process.env.TGQA_ENV ?? 'local').toLowerCase();
  return raw === 'playground' || raw === 'wp-env' ? raw : 'local';
}

export const isPlayground = (): boolean => targetEnv() === 'playground';

/**
 * A real WordPress site backed by MySQL that this run is allowed to reach
 * directly. Only `local` qualifies: the DB-level helpers (changeset clearing,
 * theme-mod snapshot/restore) shell out to a `mysql` client, and there is no
 * such binary — and no MySQL at all — on a Playground runner.
 */
export const hasMysql = (): boolean => targetEnv() === 'local';

export type AdminCredentials = { user: string; password: string };

/**
 * Admin credentials, or a loud failure.
 *
 * Deliberately throws rather than defaulting to `admin`/`password`. A default
 * that works on exactly one environment turns "you forgot to configure this"
 * into "the login step timed out", which costs an investigation every time.
 */
export function adminCredentials(): AdminCredentials {
  const user = process.env.TGQA_ADMIN_USER ?? process.env.CM_ADMIN_USER ?? process.env.WP_ADMIN_USER;
  const password =
    process.env.TGQA_ADMIN_PASS ?? process.env.CM_ADMIN_PASS ?? process.env.WP_ADMIN_PASSWORD;

  if (!user || !password) {
    const missing = [!user && 'user', !password && 'password'].filter(Boolean).join(' and ');
    throw new Error(
      `No admin ${missing} for ${baseUrl()}.\n` +
        'Set one of these pairs, in this order of precedence:\n' +
        '  TGQA_ADMIN_USER / TGQA_ADMIN_PASS   (exported by themegrill-qa run-suite.mjs)\n' +
        '  CM_ADMIN_USER   / CM_ADMIN_PASS     (your own, in a gitignored .env.local at the theme root)\n' +
        '  WP_ADMIN_USER   / WP_ADMIN_PASSWORD (legacy, tests/e2e/.env)\n\n' +
        'Copy tests/e2e/.env.example to .env.local in the theme root and fill it in. ' +
        'Never commit credentials — see tests/e2e/README.md.',
    );
  }

  return { user, password };
}

/**
 * Reason-carrying skip for behaviour Playground genuinely cannot exhibit.
 *
 * The stated reason is the point. "skipped on playground" in a CI log teaches
 * nobody anything; "no MySQL on Playground — this asserts DB-level changeset
 * cleanup" tells the next reader whether the skip is still legitimate.
 */
export function playgroundSkipReason(what: string): string {
  return `${what} — not available on Playground (PHP-WASM on SQLite: no MySQL, no real cron, no outbound mail).`;
}
