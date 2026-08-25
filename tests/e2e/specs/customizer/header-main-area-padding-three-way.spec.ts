import { test, expect } from '../../fixtures/customizer';

const CONTROL_ID = 'colormag_header_main_area_padding';

/**
 * @area    header
 * @tier    fresh
 * @source  human 2026-08-25
 * @why     Header layout is one of the two mandatory round-trip checks. Padding
 *          is used because its effect (row height) is unambiguous to assert,
 *          and only `top` is changed so the other sides are not clobbered on
 *          whatever site this runs against.
 *
 * Round-trip check for a Header Builder layout control (ground rules call
 * out "header layout" by name as one of the two mandatory checks,
 * alongside a global colour). The Header Builder's Main Area row — the
 * row holding logo + primary menu — exposes Container/Height/Color/
 * Background/Padding/Margin; Padding is used here since its effect (row
 * height changing) is trivially visible and unambiguous to assert.
 *
 * `colormag_header_main_area_padding` is a `customind-dimensions` control
 * (`{top, right, bottom, left, unit}`) — only `top` is changed here so the
 * other three sides aren't clobbered on whatever site this runs against.
 *
 * Automates two of the three legs — see global-colors-three-way.spec.ts's
 * docblock for why the live-preview leg isn't automated here (a
 * `setControl()`-vs-CustoMind-React-rerender gap in this suite's own
 * tooling, not a theme bug: a bounding-box height check against the
 * preview iframe here showed no growth after setControl(), yet the
 * published front end reliably reflects the new padding every time — a
 * real user's click does update the preview live, verified by hand). This
 * spec deliberately does not assert the preview leg.
 *
 * Verified live on this site (2026-08-25) by hand: default top padding
 * was 22 (this site's already-customized live value, not the control's
 * own schema default of 20 — which is exactly why this spec reads the
 * live value first rather than assuming the shipped default). Setting
 * top to 70 grew the row height visibly in the live preview, then on the
 * published hard-reloaded front end, then the control still read 70 on
 * reopening the Customizer. All three legs passed manually.
 *
 * This was shelved with test.fixme() for the same reason as
 * global-colors-three-way.spec.ts — `customizer.publish()`'s old DOM-based
 * wait, now fixed at the fixture level. See that spec's docblock.
 */
test('Header Builder > Main Area padding persists through publish and reopen @fresh @header', async ({
  page,
  customizer,
}) => {
  test.setTimeout(90_000);
  await customizer.open({ control: CONTROL_ID });

  const original = (await page.evaluate((id) => (window as any).wp.customize(id).get(), CONTROL_ID)) as Record<
    string,
    unknown
  >;
  const testTop = '70';

  try {
    await customizer.setControl(CONTROL_ID, { ...original, top: testTop });

    // Leg 1 (of 2 automated) — published, hard-reloaded front end.
    await customizer.publish();
    await page.goto('/?e2e-cache-bust=' + Date.now());
    const frontCss = await page.evaluate(
      () => document.getElementById('colormag_style-inline-css')?.textContent ?? '',
    );
    expect(frontCss).toContain(`${testTop}px`);

    // Leg 2 — reopened Customizer shows the persisted value.
    await customizer.open({ control: CONTROL_ID });
    const reopened = (await page.evaluate((id) => (window as any).wp.customize(id).get(), CONTROL_ID)) as Record<
      string,
      unknown
    >;
    expect(String(reopened.top)).toBe(testTop);
  } finally {
    // Courtesy-only revert; the fixture's own teardown restores the real
    // DB value — see global-colors-three-way.spec.ts's finally block.
    try {
      await customizer.setControl(CONTROL_ID, original);
    } catch (revertError) {
      console.warn(`Revert of ${CONTROL_ID} did not complete cleanly:`, revertError);
    }
  }
});
