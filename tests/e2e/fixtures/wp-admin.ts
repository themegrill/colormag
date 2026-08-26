import { test as base, expect } from '@playwright/test';

/**
 * Base fixture every other fixture module in this suite builds on.
 *
 * Authentication itself lives in global-setup.ts (one login, reused via
 * storageState across every test/worker) — this fixture only adds small
 * wp-admin navigation helpers so specs don't repeat raw path strings.
 */
export const test = base.extend<{
  wpAdmin: {
    goto: (adminPath: string) => Promise<void>;
  };
}>({
  wpAdmin: async ({ page }, use) => {
    await use({
      goto: async (adminPath: string) => {
        await page.goto(`/wp-admin/${adminPath.replace(/^\/+/, '')}`);
      },
    });
  },
});

export { expect };
