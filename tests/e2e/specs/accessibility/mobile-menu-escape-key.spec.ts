import { test, expect } from '../../fixtures/wp-admin';

/**
 * Guards CMAG-734 (source: Zakra ZAK-233, re-confirmed on ColorMag) —
 * currently OPEN, not fixed.
 *
 * Verified directly against assets/js/colormag-custom.js: the theme's only
 * `keyup` handler for the Escape key (keyCode 27) is scoped to closing the
 * top search form (`.search-form-top`) — there is no equivalent handler
 * for `.cm-menu-toggle` / the off-canvas mobile menu, so today pressing
 * Escape while the mobile menu is open does nothing.
 *
 * Written to assert the *correct* behavior and marked test.fail() so it
 * documents the open bug without red-flagging CI — it should start
 * failing-as-expected (i.e. flip to an unexpected pass) once CMAG-734 is
 * fixed, which is the signal to remove the annotation.
 */
test.fail(
  'mobile off-canvas menu closes when Escape is pressed @pr',
  async ({ page }) => {
    await page.setViewportSize({ width: 390, height: 844 });
    await page.goto('/');

    const toggle = page.locator('.cm-menu-toggle').first();
    await toggle.click();
    await expect(toggle).toHaveAttribute('aria-expanded', 'true');

    await page.keyboard.press('Escape');
    await expect(toggle).toHaveAttribute('aria-expanded', 'false');
  },
);
