import { test, expect } from '../../fixtures/customizer';

const CONTROL_ID = 'colormag_headings_typography';
const TEST_COLOR = '#e63946';

/**
 * @area    global
 * @tier    fresh
 * @guards  MZB-742
 * @source  human 2026-08-25
 * @why     Editor/front-end parity is invisible until an author writes a post
 *          and finds the canvas lying about how it will look. The bug was a
 *          font-only parser dropping the colour, so this asserts colour
 *          specifically.
 *
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
test('block editor canvas reflects the Customizer Heading color @fresh @global', async ({ page, customizer }) => {
  // Two Customizer round trips (publish, then restore-and-publish) plus a
  // block-editor load. The default 30s ceiling cut this off mid-flight and
  // reported "Target page … has been closed", which reads like a crash rather
  // than a timeout. The other customizer specs already set 90s; this one does
  // strictly more work than they do.
  test.setTimeout(150_000);

  await customizer.open();

  const originalValue = await page.evaluate(
    (id) => (window as any).wp.customize(id).get(),
    CONTROL_ID,
  );

  await customizer.setControl(CONTROL_ID, { ...originalValue, color: TEST_COLOR });
  await customizer.publish();

  try {
    await page.goto('/wp-admin/post-new.php?post_type=post');
    await dismissWelcomeGuide(page);

    // Insert the heading through the block-editor data store rather than by
    // clicking into the canvas and typing "/heading" into the slash inserter.
    // The typing route was never confirmed against a live editor and does not
    // work here: it depends on the canvas having focus, on the inserter popup
    // resolving, and on no modal having swallowed the first click — it hung
    // until the test timed out, reported as "Target page has been closed",
    // which reads like a crash rather than a fragile interaction.
    //
    // This changes only how the heading gets onto the page. The assertion is
    // unchanged and still the point: a heading rendered INSIDE the editor
    // canvas must pick up the Customizer's heading colour, which is exactly
    // what MZB-742's font-only parser broke.
    await page.waitForFunction(
      () => Boolean((window as any).wp?.data?.dispatch && (window as any).wp?.blocks?.createBlock),
      null,
      { timeout: 60_000 },
    );
    await page.evaluate(() => {
      const wp = (window as any).wp;
      const block = wp.blocks.createBlock('core/heading', { content: 'Typography Test Heading' });
      wp.data.dispatch('core/block-editor').insertBlocks(block);
    });

    const canvas = page.frameLocator('iframe[name="editor-canvas"]');
    const heading = canvas.locator('[data-type="core/heading"]').first();
    await expect(heading).toBeVisible({ timeout: 30_000 });
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

/**
 * Turn off Gutenberg's "Welcome to the editor" modal.
 *
 * It opens over the canvas on a fresh profile and swallows the first click, so
 * every interaction below it silently targets the overlay instead of the
 * block. Disabled through the preferences store rather than by clicking the
 * close button, because the store setting persists for the session and cannot
 * race the modal's own mount animation.
 */
async function dismissWelcomeGuide(page: import('@playwright/test').Page): Promise<void> {
  await page
    .waitForFunction(() => Boolean((window as any).wp?.data?.dispatch), null, { timeout: 30_000 })
    .catch(() => undefined);

  await page.evaluate(() => {
    const d = (window as any).wp?.data;
    // Modern store first, then the pre-6.0 location. Both are no-ops when the
    // store is absent, so this stays safe across WP versions.
    d?.dispatch?.('core/preferences')?.set?.('core/edit-post', 'welcomeGuide', false);
    d?.dispatch?.('core/edit-post')?.disableComplementaryArea?.('core/edit-post');
  });

  const modal = page.getByRole('dialog', { name: /welcome/i });
  if (await modal.isVisible().catch(() => false)) {
    await modal.getByRole('button', { name: /close/i }).click().catch(() => undefined);
  }
}
