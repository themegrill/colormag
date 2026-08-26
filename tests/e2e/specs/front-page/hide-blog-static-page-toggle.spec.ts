import { test, expect } from '../../fixtures/customizer';

const CONTROL_ID = 'colormag_hide_blog_static_page_post';

/**
 * @area    front-page
 * @tier    fresh
 * @source  human 2026-08-25
 * @why     Guards the outcome ColorMag's own docs promise for this toggle.
 *          One of the few controls with no postMessage transport, so it
 *          exercises WP core's full-iframe-reload preview path — which is
 *          also why this spec can assert the preview directly where the
 *          Customind-rendered controls cannot.
 *
 * Guards the stated outcome in ColorMag's own docs, "Hide Blog Posts /
 * Static Page":
 * https://docs.themegrill.com/colormag/docs/enable-or-disable-latest-blog-posts-or-static-page-content-on-the-front-page/
 * — "By default, WordPress displays the latest posts on the homepage. In
 * the ColorMag theme, we add the posts on the front page with the help of
 * the widget area... In order to prevent the latest post from appearing on
 * the front page, you can disable the option."
 *
 * Important correction to a generic assumption this suite's knowledge file
 * template started from: ColorMag free does NOT have a customizer
 * category-picker for front-page news blocks. `front-page.php`'s
 * `.cm-posts` wrapper (guarded by this toggle) renders either "Your latest
 * posts" or, when the front page is a static page (as configured on this
 * site — Customizer > Homepage Settings), that static page's own content
 * — via ordinary WordPress widget areas (`colormag_front_page_*_section`),
 * populated through Appearance > Widgets, not through a Front Page
 * customizer panel. The Front Page panel itself contains only this one
 * toggle plus a Pro upsell.
 *
 * This test site's Main demo has "A static page" selected and all the
 * `colormag_front_page_*` widget areas empty, so `.cm-posts` on this site
 * currently renders the assigned static page's own content (an
 * Elementor-built page) — this spec's assertion works either way, since it
 * only checks that toggling the control removes/restores `.cm-posts`'s
 * content, not what kind of content is inside it.
 *
 * This toggle has no declared `transport: 'postMessage'`, so WP core falls
 * back to its default full-iframe reload on change — unlike the
 * CustoMind-rendered colour/typography/dimension controls in the other
 * three-way specs in this directory, that reload reliably reflects a
 * `setControl()` call, so this checks the live preview directly rather
 * than needing a real publish for each of the two states. This spec never
 * calls publish() at all, in its body or its cleanup — every change is
 * only ever previewed, so there is nothing on the live site to revert.
 *
 * Verified live on this site (2026-08-25): toggling this control hid
 * `.cm-posts` in the live preview; toggling it back restored it.
 */
test('Hide blog posts/static page toggle hides and restores front-page content in the live preview @fresh @front-page', async ({
  page,
  customizer,
}) => {
  test.setTimeout(90_000);
  await customizer.open({ control: CONTROL_ID });

  const original = await page.evaluate((id) => (window as any).wp.customize(id).get(), CONTROL_ID);

  // This control has no `transport: 'postMessage'`, so WP core's default
  // 'refresh' behavior replaces the whole preview iframe with a new one
  // rather than patching the existing one — briefly leaving two
  // `#customize-preview iframe` elements in the DOM (the old one being torn
  // down, the new one loading).
  //
  // Test-bug fix (this spec, not the theme): this used `.last()`, which is a
  // LIVE locator re-resolved on every use. Waiting for `body` on it and then
  // counting `.cm-posts` are two separate resolutions, and a swap landing
  // between them destroys the first one's execution context — the run fails
  // with "Execution context was destroyed, most likely because of a
  // navigation" rather than any assertion. Confirmed intermittently: this
  // spec passed on one full run and failed on the next with no code change.
  //
  // Fixed the same way header-bottom-area-palette-color.spec.ts already
  // handles it: wait for the swap to FINISH — back down to exactly one
  // preview iframe — before reading anything, so every read targets the same
  // fully-loaded document. Changes only how the spec finds the preview, not
  // what it asserts.
  const settledPreviewFrame = async () => {
    await page.waitForFunction(
      () => document.querySelectorAll('#customize-preview iframe').length === 1,
      null,
      { timeout: 20_000 },
    );
    const frame = page.frameLocator('#customize-preview iframe');
    await frame.locator('body').waitFor();
    return frame;
  };

  try {
    await customizer.setControl(CONTROL_ID, true);
    await expect
      .poll(
        async () => (await (await settledPreviewFrame()).locator('.cm-posts').count()),
        {
          message: '.cm-posts should not render in the preview when the toggle is on',
          timeout: 20_000,
        },
      )
      .toBe(0);

    await customizer.setControl(CONTROL_ID, false);
    const shown = await settledPreviewFrame();
    await expect(
      shown.locator('.cm-posts').first(),
      '.cm-posts should render again in the preview once the toggle is off',
    ).toBeVisible({ timeout: 20_000 });
  } finally {
    // No publish() at all in this test (main body or cleanup) — every
    // change made is only ever previewed, never saved, so there is
    // nothing on the live site to revert. This setControl() just leaves
    // the Customizer *session* showing the original value if the
    // browser context is reused.
    try {
      await customizer.setControl(CONTROL_ID, original);
    } catch (revertError) {
      console.warn(`Restoring the preview to ${CONTROL_ID}'s original value did not complete cleanly:`, revertError);
    }
  }
});
