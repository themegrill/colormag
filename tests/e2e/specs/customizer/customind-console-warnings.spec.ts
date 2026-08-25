import { test, expect } from '../../fixtures/customizer';

/**
 * Guards CMAG-733 (source: Zakra ZAK-282, re-confirmed on ColorMag) — NOT
 * fixed, confirmed still reproducing on this site (2026-08-25, ColorMag
 * 4.2.2): opening the Customizer reliably logs exactly 5 React "Invalid
 * DOM property" warnings, one each for stroke-linecap, stroke-linejoin,
 * stroke-width, fill-rule and clip-rule — CustoMind's SVG icons use the
 * raw kebab-case HTML attribute names instead of their camelCase JSX
 * equivalents. React dedupes identical warnings per session, so this
 * count is stable rather than growing with the number of icon instances.
 *
 * Deliberately asserting the exact count instead of either `toHaveLength(0)`
 * (permanently red until CMAG-733 lands, which trains the team to ignore
 * red — the actual cost of leaving it that way) or `test.fixme()` (green,
 * but blind to the bug getting worse). Asserting exactly 5 catches CMAG-733
 * getting *worse* — a sixth attribute, or a newly-affected icon component —
 * as well as it getting fixed. A fix should make this spec fail with a
 * count of 0, which is the cue to flip the assertion back to `toHaveLength(0)`
 * and close CMAG-733's loop here.
 */
test('Customizer logs exactly the known CMAG-733 "Invalid DOM property" warnings @pr', async ({
  page,
  customizer,
}) => {
  const consoleErrors: string[] = [];
  page.on('console', (msg) => {
    if (msg.type() === 'error') consoleErrors.push(msg.text());
  });

  await customizer.open();

  // Give CustoMind's panels a moment to finish their initial render pass —
  // the warnings fire during mount, not on any particular user action.
  await page.waitForTimeout(1000);

  const invalidDomPropertyWarnings = consoleErrors.filter((text) => text.includes('Invalid DOM property'));

  expect(
    invalidDomPropertyWarnings,
    `Expected exactly 5 known CMAG-733 warnings, found ${invalidDomPropertyWarnings.length}:\n` +
      invalidDomPropertyWarnings.join('\n'),
  ).toHaveLength(5);
});
