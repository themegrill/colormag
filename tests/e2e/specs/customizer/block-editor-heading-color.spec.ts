import { test, expect } from '../../fixtures/customizer';

const CONTROL_ID = 'colormag_headings_typography';
const TEST_COLOR = '#e63946';

/**
 * Guards MZB-742 (fixed): the block editor's own generated CSS used a
 * font-only parser for the Customizer's Heading typography control, so a
 * custom heading *color* applied correctly on the front end but never
 * showed up inside the block editor canvas — only font-family did.
 *
 * `colormag_headings_typography` is a `customind-typocolor` control whose
 * value is a single object (font-family, weights, spacing, color, ...) —
 * `wp.customize().set()` replaces the whole object, so this reads the
 * current value first and only overrides `color`, to avoid clobbering
 * whatever font settings are already live on the test site.
 *
 * This needs the change actually published (not just previewed), since
 * the assertion happens in a separate wp-admin screen (the block editor),
 * not inside the Customizer's own preview iframe — hence the publish/
 * restore pair instead of setControl() alone.
 *
 * Block editor selectors below (`iframe[name="editor-canvas"]`, slash
 * inserter, `[data-type="core/heading"]`) follow current Gutenberg
 * conventions but weren't confirmed against a live run for this pass —
 * verify on a first run against your installed WP version.
 */
test('block editor canvas reflects the Customizer Heading color @pr', async ({ page, customizer }) => {
  await customizer.open();

  const originalValue = await page.evaluate(
    (id) => (window as any).wp.customize(id).get(),
    CONTROL_ID,
  );

  await customizer.setControl(CONTROL_ID, { ...originalValue, color: TEST_COLOR });
  await customizer.publish();

  try {
    await page.goto('/wp-admin/post-new.php?post_type=post');
    const canvas = page.frameLocator('iframe[name="editor-canvas"]');

    const firstBlock = canvas.locator('[data-type="core/paragraph"]').first();
    await firstBlock.click();
    await page.keyboard.type('/heading');
    await page.keyboard.press('Enter');
    await page.keyboard.type('Typography Test Heading');

    const heading = canvas.locator('[data-type="core/heading"]').first();
    await expect(heading).toHaveCSS('color', hexToRgb(TEST_COLOR));
  } finally {
    // Restore the original theme mod and publish again so the site isn't
    // left with a test-only heading color.
    await customizer.open();
    await customizer.setControl(CONTROL_ID, originalValue);
    await customizer.publish();
  }
});

function hexToRgb(hex: string): string {
  const value = hex.replace('#', '');
  const r = parseInt(value.substring(0, 2), 16);
  const g = parseInt(value.substring(2, 4), 16);
  const b = parseInt(value.substring(4, 6), 16);
  return `rgb(${r}, ${g}, ${b})`;
}
