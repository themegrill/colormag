import { test, expect } from '../../fixtures/customizer';

/**
 * @area    global
 * @tier    fresh
 * @guards  CMAG-733
 * @source  human 2026-08-25
 * @why     Shelved, not deleted, because CMAG-733 cannot be observed from the
 *          console on the bundle ColorMag free ships: its React is a
 *          PRODUCTION build, and "Invalid DOM property" is a development-only
 *          warning. A console-count assertion here is unfalsifiable — it
 *          cannot fail when the bug is present and cannot pass because the bug
 *          is absent. Kept as a named placeholder so the invariant stays
 *          traceable to a spec (CONVENTIONS.md rule 7) and so the next person
 *          does not re-derive this. See the evidence below.
 *
 * Guards CMAG-733 (source: Zakra ZAK-282, re-confirmed on ColorMag): CustoMind's
 * SVG icon components pass raw kebab-case HTML attribute names
 * (`stroke-linecap`, `stroke-linejoin`, `stroke-width`, `fill-rule`,
 * `clip-rule`) where React expects their camelCase JSX equivalents.
 *
 * ## Why this is test.fixme() rather than an assertion in either direction
 *
 * The brief for this pass offered two options — `test.fixme()` naming
 * CMAG-733, or inverting the assertion to "exactly 5 warnings" so it fails if
 * the count moves either way — and leaned toward inverting. Measured on this
 * site (2026-08-25, ColorMag free 4.2.2), neither works, for a reason neither
 * option anticipated:
 *
 *   - Opening the Customizer logs **zero** "Invalid DOM property" warnings.
 *   - That is not because the bug is fixed. The Customizer's React panels
 *     render fully (2646 CustoMind nodes, 56 controls, 26 panels, React
 *     18.3.1 present), so this is not a failed bundle load.
 *   - Rendering a probe element with exactly the offending attributes
 *     (`stroke-width`, `fill-rule`) through the page's own React produced **no
 *     warning either**. That is the decisive result: React here is a
 *     production build, which strips this entire warning class.
 *
 * So the earlier observation of "exactly 5" was made against a *different*
 * bundle — ColorMag **Pro** was the active theme at the time, and it ships an
 * older CustoMind whose React is a development build. Asserting 5 fails on
 * free; asserting 0 would pass for entirely the wrong reason and would keep
 * passing if CMAG-733 got strictly worse. A green spec that cannot fail is
 * worse than a red one, because it is believed.
 *
 * ## What would actually guard this
 *
 * Assert against the rendered DOM rather than the console: query CustoMind's
 * SVG icons in the Customizer and check that none carries a raw kebab-case
 * React-invalid attribute. That is observable on a production build and is
 * the real invariant. It needs the offending components enumerated first,
 * which is a spec-writing job, not a retag — queued rather than guessed at.
 */
test.fixme(
  'Customizer logs no CustoMind React DOM-property warnings @fresh @global',
  async ({ page, customizer }) => {
    const consoleErrors: string[] = [];
    page.on('console', (msg) => {
      if (msg.type() === 'error') consoleErrors.push(msg.text());
    });

    await customizer.open();

    // CustoMind's panels mount asynchronously; the warnings fire during mount,
    // not on any particular user action.
    await page.waitForTimeout(1000);

    const invalidDomPropertyWarnings = consoleErrors.filter((text) =>
      text.includes('Invalid DOM property'),
    );

    expect(
      invalidDomPropertyWarnings,
      `Expected no CMAG-733 warnings, found ${invalidDomPropertyWarnings.length}:\n` +
        invalidDomPropertyWarnings.join('\n'),
    ).toHaveLength(0);
  },
);
