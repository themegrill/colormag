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
 * locator re-resolved on every use, and this spec called it twice — once
 * for the element under test, once inside a `resolveCssVar` helper — so a
 * swap between those two calls could land them on two *different* iframes,
 * one mid-navigation with no stylesheet loaded yet. That produced a
 * resolved `rgba(0, 0, 0, 0)` for `var(--cm-color-2)`: the custom property
 * did not exist yet in that particular document.
 *
 * A second attempt waited for the iframe count to drop back to exactly one
 * before resolving anything. That was still not enough, and it failed under
 * `run-suite.mjs` with default parallel workers while passing serially: the
 * probe resolved the palette variable to transparent in a document whose
 * stylesheet had not finished loading, while the element itself was already
 * correctly painted `rgb(34, 112, 176)`. The spec reported ColorMag broken
 * on the strength of its own unresolved probe.
 *
 * Fixed properly by resolving the variable and reading the element's colour
 * inside ONE `evaluate` — so they cannot come from different documents — and
 * polling that pair, treating an unresolved variable as "not ready yet"
 * rather than as a verdict. This changes only how the spec finds and
 * compares the values, not what it asserts.
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

  const previewFrame = page.frameLocator('#customize-preview iframe').last();

  const bottomRow = previewFrame
    .locator('.cm-header-builder .cm-desktop-row.cm-main-header .cm-header-bottom-row')
    .first();
  await bottomRow.waitFor({ timeout: 20_000 });

  // Resolve the palette variable and read the element's colour in the SAME
  // evaluate, then poll the pair.
  //
  // The previous version resolved `var(--cm-color-2)` once, up front, through a
  // throwaway probe div, and passed the result into toHaveCSS. Under parallel
  // workers that raced: the probe ran in a preview document whose stylesheet
  // had not loaded yet, so the variable resolved to `rgba(0, 0, 0, 0)`, while
  // the element itself was already correctly painted `rgb(34, 112, 176)`. The
  // spec then reported ColorMag broken on the strength of its own unresolved
  // probe — a false positive, and exactly the failure mode its docblock warned
  // about, just one level further in.
  //
  // Requiring `expected` to be non-transparent is what makes this poll rather
  // than assert against a half-loaded document: an unresolved variable is a
  // "not ready yet", never a verdict.
  await expect
    .poll(
      async () =>
        bottomRow.evaluate((el, expr) => {
          const probe = document.createElement('div');
          probe.style.backgroundColor = expr;
          document.body.appendChild(probe);
          const expected = getComputedStyle(probe).backgroundColor;
          probe.remove();
          const actual = getComputedStyle(el).backgroundColor;
          return expected === 'rgba(0, 0, 0, 0)' ? `palette not resolved yet (element is ${actual})` : `${actual} vs ${expected}`;
        }, paletteColor),
      {
        timeout: 20_000,
        message:
          'Header Builder Bottom Area background should resolve to the chosen palette colour ' +
          `(${paletteColor}) in the live preview`,
      },
    )
    .toMatch(/^(rgba?\([^)]*\)) vs \1$/);
});
