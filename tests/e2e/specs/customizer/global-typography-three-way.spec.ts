import { test, expect } from '../../fixtures/customizer';

const CONTROL_ID = 'colormag_base_typography';

/**
 * @area    global
 * @tier    fresh
 * @source  human 2026-08-25
 * @why     Same round trip as global-colors, for a customind-typocolor object
 *          rather than a scalar — set() replaces the whole object, which is
 *          its own class of regression (an earlier draft used a flat
 *          font-size key and silently asserted nothing).
 *
 * Same round-trip check as global-colors-three-way.spec.ts, for Global >
 * Typography > Body font size — the ground rules call out colour AND
 * typography explicitly, and this control is a `customind-typocolor`
 * object (font-family, weight, per-breakpoint font-size/line-height, ...),
 * so `set()` replaces the whole object. This reads the live value first
 * and only overrides the desktop font-size, to avoid clobbering whatever
 * font is actually configured on the site under test.
 *
 * The nested shape below (`font-size.desktop.size`, not a flat
 * `font-size`) was read directly off this control's live value via
 * `wp.customize(id).get()` rather than guessed — an earlier draft of this
 * spec used a flat `font-size` key, which silently did nothing (the
 * dynamic CSS generator only reads `font-size.desktop.size`) and would
 * have been a false-negative regression guard.
 *
 * Automates two of the three legs — see global-colors-three-way.spec.ts's
 * docblock for why the live-preview leg isn't automated here (a
 * `setControl()`-vs-CustoMind-React-rerender gap in this suite's own
 * tooling, not a theme bug — a real user's click does update the preview,
 * verified by hand). This spec deliberately does not assert the preview
 * leg. Verified live on this site (2026-08-25) by hand: Body was
 * Inter/14px; setting it to 26 updated the live preview, the published
 * front end, and still read 26 on reopening — all three legs passed
 * manually.
 *
 * This was shelved with test.fixme() for the same reason as
 * global-colors-three-way.spec.ts — `customizer.publish()`'s old DOM-based
 * wait, now fixed at the fixture level. See that spec's docblock.
 */
test('Global > Typography > Body font size persists through publish and reopen @fresh @global', async ({
  page,
  customizer,
}) => {
  test.setTimeout(90_000);
  await customizer.open({ control: CONTROL_ID });

  const original = (await page.evaluate((id) => (window as any).wp.customize(id).get(), CONTROL_ID)) as any;
  const testSize = 26;
  const changed = {
    ...original,
    'font-size': { ...original['font-size'], desktop: { ...original['font-size'].desktop, size: testSize } },
  };

  try {
    await customizer.setControl(CONTROL_ID, changed);

    // Leg 1 (of 2 automated) — published, hard-reloaded front end.
    await customizer.publish();
    await page.goto('/?e2e-cache-bust=' + Date.now());
    const frontCss = await page.evaluate(
      () => document.getElementById('colormag_style-inline-css')?.textContent ?? '',
    );
    expect(frontCss).toContain(`font-size:${testSize}px`);

    // Leg 2 — reopened Customizer shows the persisted value.
    await customizer.open({ control: CONTROL_ID });
    const reopened = (await page.evaluate((id) => (window as any).wp.customize(id).get(), CONTROL_ID)) as any;
    expect(Number(reopened['font-size'].desktop.size)).toBe(testSize);
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
