import { test, expect } from '../../fixtures/customizer';

const CONTROL_ID = 'colormag_base_color';

/**
 * The customizer round-trip check (ground rule, and CONVENTIONS.md's
 * rationale for this whole suite existing): a setting can fail any one of
 * preview-updates, publish-reaches-the-front-end, or
 * control-still-shows-its-value-on-reopen while looking fine in the other
 * two. Global > Colors is a reasonable representative control to guard
 * permanently, since `inc/base/class-colormag-dynamic-css.php` (the
 * customizer-setting-to-CSS translator) is the single most fix-commit-
 * churned file in this theme's git history after the migration routines.
 *
 * This automates two of the three legs, not all three — see below for why.
 *
 * Verified live on this site (2026-08-25), by hand, via real UI
 * interaction (clicking the colour swatch, typing a hex value, clicking
 * Publish, reopening): all three legs passed, including the live preview.
 * Screenshots of that manual pass are attached to this QA session's
 * report.
 *
 * NOT automated here: the live-preview leg. This suite's `setControl()`
 * drives controls via the low-level `wp.customize(id).set(value)` API
 * rather than the actual rendered control widget, and repeated runs
 * showed that path updates the underlying setting/model (which is what
 * both Publish and the front end read — hence the two legs below are
 * reliable) without reliably triggering CustoMind's own React re-render
 * of `#customind-dynamic-control-css` in the preview iframe. That is a
 * gap in how this suite drives CustoMind's controls, not evidence of a
 * theme bug — a real user changing the swatch does update the preview
 * live, verified by hand (screenshots in this QA session's report). This
 * spec deliberately does not assert the preview leg and does not report
 * it as broken — only the two legs below are automated.
 *
 * `customizer.publish()` previously waited for `#save` to re-enable in
 * the DOM, which measured taking 8.5s on one run and still hadn't fired
 * after 45s on another against this same unmodified site — that
 * unreliable wait, not this spec, was why this test was shelved with
 * test.fixme(). Fixed at the fixture level (see customizer.ts): publish()
 * now waits for the actual customize_save network response, then
 * confirms from `wp.customize.state('saved')` rather than the DOM.
 */
test('Global > Colors > Base persists through publish and reopen @pr', async ({ page, customizer }) => {
  test.setTimeout(90_000);
  await customizer.open({ control: CONTROL_ID });

  const original = await page.evaluate((id) => (window as any).wp.customize(id).get(), CONTROL_ID);
  const testColor = '#ff00aa';

  try {
    await customizer.setControl(CONTROL_ID, testColor);

    // Leg 1 (of 2 automated) — published, hard-reloaded front end (a fresh
    // page, not the preview iframe).
    await customizer.publish();
    await page.goto('/?e2e-cache-bust=' + Date.now());
    const frontCss = await page.evaluate(
      () => document.getElementById('colormag_style-inline-css')?.textContent ?? '',
    );
    expect(frontCss.toLowerCase()).toContain(testColor);

    // Leg 2 — reopened Customizer shows the persisted value, not the old one.
    await customizer.open({ control: CONTROL_ID });
    const reopened = await page.evaluate((id) => (window as any).wp.customize(id).get(), CONTROL_ID);
    expect(String(reopened).toLowerCase()).toBe(testColor);
  } finally {
    // This setControl() is only a courtesy for a reused browser context —
    // it is not this test's actual safety net, and deliberately does not
    // call publish() again. That's the `customizer` fixture's own
    // teardown (see customizer.ts), which restores the real DB value from
    // a snapshot taken once in global-setup, after every test, regardless
    // of how this one exits.
    try {
      await customizer.setControl(CONTROL_ID, original);
    } catch (revertError) {
      console.warn(`Revert of ${CONTROL_ID} did not complete cleanly:`, revertError);
    }
  }
});
