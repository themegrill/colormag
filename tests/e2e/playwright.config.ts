import { defineConfig, devices } from '@playwright/test';
import path from 'path';

/**
 * Playwright config for ColorMag's E2E regression suite.
 *
 * No test suite existed in this repo before this one — there are no prior
 * conventions to match, so choices here (storageState reuse, @pr/@nightly
 * tagging via --grep, one flat "colormag" project) are a starting point,
 * not an inherited standard. See tests/e2e/README.md for the reasoning
 * behind the fixture layout.
 */

const STORAGE_STATE = path.join(__dirname, '.auth/admin.json');

export default defineConfig({
  testDir: './specs',
  outputDir: './test-results',
  fullyParallel: true,
  forbidOnly: !!process.env.CI,
  retries: process.env.CI ? 1 : 0,
  workers: process.env.CI ? 2 : undefined,
  reporter: [['list'], ['html', { outputFolder: './playwright-report', open: 'never' }]],
  globalSetup: require.resolve('./global-setup'),

  use: {
    baseURL: process.env.WP_BASE_URL ?? 'http://test-colormag.local',
    storageState: STORAGE_STATE,
    trace: 'retain-on-failure',
    screenshot: 'only-on-failure',
    video: 'retain-on-failure',
  },

  projects: [
    {
      name: 'colormag',
      use: { ...devices['Desktop Chrome'], viewport: { width: 1440, height: 900 } },
    },
  ],
});
