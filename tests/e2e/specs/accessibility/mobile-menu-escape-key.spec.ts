import { test, expect } from '../../fixtures/content';

/**
 * @area    header
 * @tier    fresh
 * @guards  CMAG-734
 * @source  human 2026-08-25
 * @why     Escape is the documented way out of any overlay, and the off-canvas
 *          menu traps a keyboard user without it. Written to assert the
 *          correct behaviour and marked test.fail() so the open bug is
 *          documented without holding CI red — it flips to an unexpected pass
 *          the moment CMAG-734 lands, which is the signal to drop the
 *          annotation.
 *
 * Guards CMAG-734 (source: Zakra ZAK-233, re-confirmed on ColorMag) —
 * currently OPEN, not fixed.
 *
 * Verified directly against assets/js/colormag-custom.js: the theme's only
 * `keyup` handler for the Escape key (keyCode 27) is scoped to closing the top
 * search form (`.search-form-top`) — there is no equivalent handler for
 * `.cm-menu-toggle` / the off-canvas mobile menu, so today pressing Escape
 * while the mobile menu is open does nothing.
 *
 * Now seeds its menu through the content fixture rather than assuming one
 * exists: on a site with no nav menu the toggle never renders, and this would
 * have failed on "no such element" — an unexpected pass, indistinguishable
 * from CMAG-734 being fixed.
 */
test('mobile off-canvas menu closes when Escape is pressed @fresh @header', async ({ page, content }) => {
  // Called in the body rather than as `test.fail('title', ...)`, which is
  // equivalent to Playwright but invisible to themegrill-qa's spec parser:
  // its regex accepts test.fixme/skip/only/serial/concurrent and not
  // test.fail, so the wrapper form silently dropped this spec from
  // suite-index.mjs entirely — no coverage credit, no docblock check.
  test.fail();

  await content.aMenuWithDropdown();

  await page.setViewportSize({ width: 390, height: 844 });
  await page.goto('/');

  const toggle = page.locator('.cm-menu-toggle').first();
  await toggle.click();
  await expect(toggle).toHaveAttribute('aria-expanded', 'true');

  await page.keyboard.press('Escape');
  await expect(toggle).toHaveAttribute('aria-expanded', 'false');
});
