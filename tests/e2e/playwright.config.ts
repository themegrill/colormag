import { defineConfig, devices } from '@playwright/test';
import { baseUrl, STORAGE_STATE, targetEnv } from './env';

/**
 * Playwright config for ColorMag's E2E regression suite.
 *
 * Three callers drive this suite and the config has to serve all three
 * without any of them editing it:
 *
 *   a developer, locally   → `pnpm test:e2e`, no env vars, hits the Local site
 *   CI, on every PR        → `--grep @fresh` against a disposable Playground site
 *   themegrill-qa skills   → run-suite.mjs, which exports TGQA_* and greps a tier
 *
 * Nothing here hardcodes a host: `env.ts` owns that decision and its
 * precedence chain (TGQA_* → CM_* → WP_* → the local default). Every spec
 * navigates with a relative path so `baseURL` governs, without exception.
 *
 * Tiering is by tag in the test *title*, because that is what `--grep`
 * matches. `@fresh` runs anywhere; `@demo` needs a demo-imported site. See
 * tests/e2e/README.md.
 */
export default defineConfig({
  testDir: './specs',
  outputDir: './test-results',
  // Serial, deliberately, and not because this machine is slow.
  //
  // Customizer specs mutate `theme_mods_<stylesheet>` — one row, shared by the
  // whole site — and the `customizer` fixture restores it from a snapshot after
  // every test that touches it. Two workers doing that concurrently clobber
  // each other by construction: worker A's post-test restore reverts the value
  // worker B published a moment earlier, and B then fails asserting against a
  // front end that no longer carries its change. Measured across three parallel
  // runs of the @fresh tier: 2 failed, 2 failed, 0 failed, with a DIFFERENT
  // pair failing each time (global-colors + padding, then global-colors +
  // typography, then none) — the signature of a race, not of three flaky specs.
  // The same specs pass 15/15 serially.
  //
  // This is a property of WordPress's global theme-mod state, not of this
  // machine, so it applies on a Playground runner too. The suite is 23 tests in
  // ~43s serially; determinism is worth those seconds. If it grows enough for
  // that to hurt, the fix is to isolate customizer state per worker (separate
  // sites, or a per-worker changeset), NOT to raise the worker count and accept
  // an occasionally-wrong required check.
  fullyParallel: false,
  forbidOnly: !!process.env.CI,
  retries: process.env.CI ? 1 : 0,
  workers: 1,
  reporter: [['list'], ['html', { outputFolder: './playwright-report', open: 'never' }]],
  globalSetup: require.resolve('./global-setup'),
  globalTeardown: require.resolve('./global-teardown'),

  use: {
    baseURL: baseUrl(),
    trace: 'retain-on-failure',
    screenshot: 'only-on-failure',
    video: 'retain-on-failure',
  },

  projects: [
    {
      // A setup project rather than a step inside globalSetup, so a failed
      // login is a reported test with a trace instead of an opaque crash.
      name: 'setup',
      testDir: '.',
      testMatch: /auth\.setup\.ts/,
    },
    {
      name: 'colormag',
      dependencies: ['setup'],
      use: {
        ...devices['Desktop Chrome'],
        viewport: { width: 1440, height: 900 },
        storageState: STORAGE_STATE,
      },
      metadata: { env: targetEnv() },
    },
  ],
});
