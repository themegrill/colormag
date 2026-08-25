import { test, expect } from '../../fixtures/wp-admin';

/**
 * @area    header
 * @tier    fresh
 * @source  human 2026-08-25
 * @why     A lone logo squeezed to 30% of the header width, with no Customizer
 *          Logo Width/Height setting able to compensate. Guards the exact
 *          condition the regression violated — the 30% constraint applying to
 *          a column that was never meant to carry it.
 *
 * Guards the unticketed 4.2.2 header-logo-squeeze regression (fixed).
 *
 * CMAG-650's demo-import CSS-conflict fix applied `flex-basis: 30%`
 * unconditionally to `.cm-header-left-col`, so any site with just a lone logo
 * in that column got it squeezed to 30% width. The fix scopes that flex-basis
 * behind a `.cm-header-col--has-multiple` class, added by
 * `colormag_render_header_cols()` in `inc/builder-template-tags.php` only when
 * a column actually holds more than one configured builder element.
 *
 * ## Test-bug fix — this DOES change what the spec asserts, flagged for review
 *
 * The previous version counted the column's **DOM children** and required the
 * class whenever there was more than one. That proxy is wrong, and it produced
 * a confident false positive: on a default header the left column has two DOM
 * children — `.cm-site-branding` and `.cm-site-info` — but both come from the
 * *single* `logo` builder element (`template-parts/header-builder-elements/logo.php`
 * emits both divs). The theme was correct to omit the class; the spec was
 * measuring the wrong thing and reported ColorMag as broken.
 *
 * Configured builder elements are not recoverable from the front-end DOM — the
 * count lives in `$cols`, a theme mod read server-side — so counting them
 * correctly is not available here. Instead this now asserts the invariant that
 * the regression actually violated, which IS observable: the 30% constraint
 * must apply only to a left column carrying the class. Verified against
 * `style.css:1080` — `.cm-header-builder .cm-main-row .cm-header-left-col.cm-header-col--has-multiple
 * { flex-basis: 30% }` is the only rule that applies it.
 *
 * This is a change to WHAT is asserted (class-presence-vs-child-count →
 * width-constraint-vs-class), not only to how the elements are found, so it
 * needs review. It is strictly closer to the user-visible defect, and it can
 * no longer fail on a header layout it merely misread.
 */
test('header builder columns only get the multi-element width constraint when they actually hold multiple elements @fresh @header', async ({
  page,
}) => {
  await page.goto('/');

  const columns = page.locator('.cm-header-builder .cm-main-row [class*="cm-header-"][class*="-col"]');

  const count = await columns.count();
  test.skip(count === 0, 'No Header Builder main-row columns found on this site to check.');

  let checked = 0;

  for (let i = 0; i < count; i++) {
    const column = columns.nth(i);

    const info = await column.evaluate((el) => ({
      className: el.className,
      isLeft: el.classList.contains('cm-header-left-col'),
      hasConstraintClass: el.classList.contains('cm-header-col--has-multiple'),
      flexBasis: getComputedStyle(el).flexBasis,
      // Only meaningful for the failure message — never asserted on, because
      // one builder element can emit several DOM children.
      domChildren: el.children.length,
    }));

    // The constraint rule is scoped to the LEFT column only, so the right and
    // centre columns cannot exhibit this regression at all.
    if (!info.isLeft) continue;
    checked++;

    if (info.hasConstraintClass) {
      // Carrying the class is the theme's own statement that this column holds
      // multiple elements; 30% is then the intended width.
      continue;
    }

    expect(
      info.flexBasis,
      `A .cm-header-left-col WITHOUT .cm-header-col--has-multiple must not be width-constrained ` +
        `to 30% — that is the lone-logo squeeze regression. Measured flex-basis "${info.flexBasis}" ` +
        `on <div class="${info.className}"> (${info.domChildren} DOM children, which is NOT the ` +
        `builder-element count — see this spec's docblock).`,
    ).not.toBe('30%');
  }

  expect(checked, 'Expected at least one .cm-header-left-col in the header main row').toBeGreaterThan(0);
});
