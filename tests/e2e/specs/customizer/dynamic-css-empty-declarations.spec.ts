import { test, expect } from '../../fixtures/wp-admin';

/**
 * Guards CMAG-738 (source: Zakra ZAK-214/215/222): dynamic/inline CSS used
 * to ship invalid empty declarations (`background-position:;` etc.) for
 * background sub-fields left at their default, unset state — shipped on
 * the live public front end, not just inside the Customizer preview.
 *
 * Verified against current source: `colormag_parse_background_css()` only
 * emits a declaration when a sub-field differs from its own default, and
 * every background control's defaults use real values (`center center`,
 * `scroll`, `repeat`, ...) rather than empty strings — so this is written
 * as a general regression guard against ANY inline stylesheet shipping an
 * empty-value declaration, not a reproduction tied to one specific control.
 */
test('front-end inline stylesheets never ship an empty-value CSS declaration @pr', async ({ page }) => {
  await page.goto('/');

  const styleContents = await page.locator('style').allTextContents();
  const combined = styleContents.join('\n');

  // Matches e.g. "background-position:;" or "border-radius: ;" — a
  // property immediately followed by an empty value.
  const emptyDeclarations = combined.match(/[a-z-]+\s*:\s*;/gi) ?? [];

  expect(
    emptyDeclarations,
    `Found empty-value CSS declarations in inline <style> output:\n${emptyDeclarations.join('\n')}`,
  ).toHaveLength(0);
});
