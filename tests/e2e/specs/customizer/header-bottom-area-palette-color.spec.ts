import { test, expect } from '../../fixtures/customizer';

/**
 * @area    header
 * @tier    fresh
 * @guards  CMAG-684
 * @source  human 2026-08-25
 * @why     The original bug collapsed any var(--cm-color…) choice down to a
 *          hardcoded fallback, so every palette swatch rendered identically.
 *          Forward-looking guard against that special-casing returning.
 *
 * Guards CMAG-684 (fixed, commit dc6d5611): Header Builder > Bottom Area's
 * background used to special-case any `var(--cm-color...)` value down to a
 * literal, undefined `var(--cm-color, #27272A)`, so it always rendered the
 * hardcoded fallback regardless of which global palette swatch was chosen.
 *
 * Verified against current source: `colormag_header_bottom_area_background`
 * already defaults to `var(--cm-color-5)` and the CSS generator only
 * special-cases the value when it isn't already a `var()` reference — this
 * spec is a forward-looking regression guard against that logic reverting,
 * not a reproduction of the original bug.
 *
 * Test-bug fix (this spec, not the theme): this used to select
 * `#customize-preview iframe` directly, which intermittently resolved to
 * two elements and threw a strict-mode violation — WordPress core's own
 * autosave-to-server round trip (roughly 15s after any change, independent
 * of this control) creates a second `#customize-preview iframe[name=
 * "...-1"][data-src="...customize_autosaved=on"]` mid-session while the
 * first is still live, not something either this control or a stale draft
 * from a prior run caused.
 *
 * A first attempt just added `.last()` (the fix front-page/
 * hide-blog-static-page-toggle.spec.ts already uses) but that's a *live*
 * locator re-resolved on every use, and this spec calls it twice
 * (once for the element under test, once inside resolveCssVar) —
 * if the swap from one iframe to the next happens between those two
 * calls, they can each correctly resolve to "the last iframe at that
 * instant" and still land on two *different* iframes, one of them
 * mid-navigation with no stylesheet loaded yet (that's what produced a
 * resolved `rgba(0, 0, 0, 0)` for `var(--cm-color-2)` — the CSS custom
 * property didn't exist yet in that particular document). Fixed by
 * waiting for the swap to finish — back down to exactly one
 * `#customize-preview iframe` — before resolving anything, so both calls
 * definitely target the same, fully-loaded document. This changes only
 * how the spec finds the preview iframe, not what it asserts.
 */
test('Header Builder Bottom Area background follows the chosen palette color @fresh @header', async ({
  page,
  customizer,
}) => {
  await customizer.open({ control: 'colormag_header_bottom_area_background' });

  const paletteColor = 'var(--cm-color-2)';
  await customizer.setControl('colormag_header_bottom_area_background', {
    'background-color': paletteColor,
    'background-image': '',
    'background-repeat': 'repeat',
    'background-position': 'center center',
    'background-size': 'contain',
    'background-attachment': 'scroll',
  });

  // Let any in-flight autosave-triggered iframe swap finish before reading
  // anything out of the preview — see the docblock above.
  await page.waitForFunction(
    () => document.querySelectorAll('#customize-preview iframe').length === 1,
    null,
    { timeout: 20_000 },
  );

  const previewFrame = page.frameLocator('#customize-preview iframe');

  const bottomRow = previewFrame
    .locator('.cm-header-builder .cm-desktop-row.cm-main-header .cm-header-bottom-row')
    .first();

  await expect(bottomRow).toHaveCSS('background-color', await resolveCssVar(previewFrame, paletteColor));
});

/**
 * `toHaveCSS` compares against the browser's *resolved* color (an
 * `rgb(...)` string), not the raw `var(--cm-color-2)` expression — so we
 * resolve it the same way the real element would, by applying it to a
 * throwaway probe element in the same document and reading its computed
 * style back out.
 */
async function resolveCssVar(
  frame: import('@playwright/test').FrameLocator,
  cssVarExpression: string,
): Promise<string> {
  return frame.locator('body').evaluate((body, expr) => {
    const probe = document.createElement('div');
    probe.style.backgroundColor = expr;
    body.appendChild(probe);
    const resolved = getComputedStyle(probe).backgroundColor;
    probe.remove();
    return resolved;
  }, cssVarExpression);
}
