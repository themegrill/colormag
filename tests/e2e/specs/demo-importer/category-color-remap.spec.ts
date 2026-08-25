import { test, expect } from '../../fixtures/demo-import';

/**
 * @area    content
 * @tier    demo
 * @guards  CMAG-338
 * @source  human 2026-08-25
 * @why     Irreducibly @demo: the assertion IS the import's batch-remapping
 *          behaviour — colormag_category_color_{term_id} mods being rewritten
 *          to the new term IDs across a >10-post batch boundary. There is no
 *          seedable stand-in for "an import happened", so this cannot be
 *          reduced to @fresh without testing something else entirely.
 *          Still fixme: demoImport.runImport() is unimplemented.
 *
 * Guards CMAG-338 (fixed): `colormag_category_color_{term_id}` theme mods
 * weren't remapped to the new category IDs created during import, and
 * deferred remapping (menu items, post_parent, post_author, attachment
 * URLs) for imports over 10 posts only persisted the last batch's data —
 * so categories imported in earlier batches silently lost their color.
 *
 * marked test.fixme(): needs demoImport.runImport() implemented first
 * (see fixtures/demo-import.ts), against a demo with >10 posts spanning
 * multiple categories that each have a configured color (the session this
 * is drawn from used ColorMag's "Health Blog" demo).
 */
test.fixme(
  'category colors survive a demo import spanning multiple batches (>10 posts) @demo @content',
  async ({ page, demoImport }) => {
    const before = await demoImport.snapshotPublishedPages();

    await demoImport.gotoStarterTemplates();
    await demoImport.runImport('health-blog'); // TODO: confirm this is still the right demo slug

    try {
      const categoriesRes = await page.request.get('/wp-json/wp/v2/categories?per_page=50');
      const categories = (await categoriesRes.json()) as Array<{ id: number; link: string; count: number }>;
      const populated = categories.filter((c) => c.count > 0);
      test.skip(populated.length < 2, 'Not enough populated categories on this site to check color remapping.');

      for (const category of populated) {
        await page.goto(category.link);
        // TODO: this asserts *a* dynamic <style> block exists at all,
        // as a placeholder — tighten it to check the specific category
        // accent color once the actual rendering selector is confirmed
        // (the category-color feature lives behind
        // inc/customizer/options/global/category-colors.php; its
        // front-end selector wasn't traced for this pass).
        const styleContents = await page.locator('style').allTextContents();
        expect(
          styleContents.join('\n'),
          `Expected category ${category.id}'s configured color to appear in the page's generated CSS`,
        ).toMatch(/color\s*:\s*#[0-9a-f]{3,6}/i);
      }
    } finally {
      await demoImport.deletePagesCreatedSince(before);
    }
  },
);
