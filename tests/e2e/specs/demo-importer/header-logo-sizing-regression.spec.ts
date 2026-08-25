import { test, expect } from '../../fixtures/wp-admin';

/**
 * Guards the unticketed 4.2.2 header-logo-squeeze regression (fixed).
 *
 * CMAG-650's demo-import CSS-conflict fix applied `flex-basis: 30%`
 * unconditionally to `.cm-header-left-col`, so any site with just a lone
 * logo in that column got it squeezed to 30% width with no Customizer
 * Logo Width/Height override able to compensate. The fix scopes that
 * flex-basis behind a `.cm-header-col--has-multiple` class, only added
 * (`inc/builder-template-tags.php`) when a header column actually holds
 * more than one configured element.
 *
 * Rather than driving the Header Builder's drag-and-drop UI to force a
 * specific column layout (heavy, and its exact interaction wasn't
 * verified live for this pass), this asserts the underlying invariant
 * directly against whatever header layout is currently live: a column
 * with a single element must never carry the constraining class, and a
 * column with multiple elements always must. That's the exact condition
 * the regression violated, and it holds regardless of which elements are
 * actually configured on this site.
 */
test('header builder columns only get the multi-element width constraint when they actually hold multiple elements @pr', async ({
  page,
}) => {
  await page.goto('/');

  const columns = page.locator(
    '.cm-header-builder .cm-main-row [class*="cm-header-"][class*="-col"]',
  );

  const count = await columns.count();
  test.skip(count === 0, 'No Header Builder main-row columns found on this site to check.');

  for (let i = 0; i < count; i++) {
    const column = columns.nth(i);
    const childCount = await column.evaluate((el) => el.children.length);
    const hasConstraintClass = await column.evaluate((el) =>
      el.classList.contains('cm-header-col--has-multiple'),
    );

    if (childCount > 1) {
      expect(hasConstraintClass, 'Column with multiple elements should carry cm-header-col--has-multiple').toBe(
        true,
      );
    } else {
      expect(
        hasConstraintClass,
        'Column with a single element (e.g. a lone logo) must NOT be width-constrained to 30%',
      ).toBe(false);
    }
  }
});
