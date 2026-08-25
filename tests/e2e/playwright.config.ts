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
  fullyParallel: true,
  forbidOnly: !!process.env.CI,
  retries: process.env.CI ? 1 : 0,
  workers: process.env.CI ? 2 : undefined,
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
