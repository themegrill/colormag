import { test, expect } from '../../fixtures/demo-import';

/**
 * Guards CMAG-677 (fixed): unslashed `post_content` passed to
 * `wp_update_post()` during import let WordPress's `wp_unslash()` strip
 * the escape backslash `serialize_blocks()` uses for literal `--`,
 * silently corrupting `var(--custom-color)` CSS custom properties in any
 * imported content built with an Everest Forms block.
 *
 * marked test.fixme(): needs demoImport.runImport() implemented first
 * (see fixtures/demo-import.ts), plus a demo/fixture whose content
 * actually contains an Everest Forms block using a `var(--...)` custom
 * color — confirm one exists in the target demo before enabling this.
 */
test.fixme(
  'demo content with a var(--...) custom property survives import intact @nightly',
  async ({ page, demoImport }) => {
    const before = await demoImport.snapshotPublishedPages();

    await demoImport.gotoStarterTemplates();
    await demoImport.runImport('TODO-pick-a-demo-with-an-everest-forms-block'); // TODO

    try {
      const pagesRes = await page.request.get('/wp-json/wp/v2/pages?per_page=100&status=publish');
      const pages = (await pagesRes.json()) as Array<{ link: string; content: { rendered: string } }>;

      const pageWithForm = pages.find((p) => p.content.rendered.includes('everest-form'));
      test.skip(!pageWithForm, 'No imported page contains an Everest Forms block to check.');

      await page.goto(pageWithForm!.link);
      const styleContents = await page.locator('style').allTextContents();
      const combined = styleContents.join('\n');

      // A corrupted custom property collapses "var(--custom-color)" down
      // to a single dash — assert the double-dash property declaration
      // survived as an actual custom property, not a stripped one.
      expect(combined, 'Expected an intact var(--...) custom property in the page CSS').toMatch(/var\(--[a-z0-9-]+/i);
    } finally {
      await demoImport.deletePagesCreatedSince(before);
    }
  },
);
