import { test, expect } from '../../fixtures/wp-admin';

/**
 * @area    footer
 * @tier    demo
 * @guards  CMAG-650
 * @source  human 2026-08-25
 * @why     Demoted to @demo deliberately, not for convenience. The assertion
 *          needs a footer widget that sets its OWN link colour, so that a
 *          theme rule overriding it is detectable. A clean site renders only
 *          the copyright bar — no footer widget areas at all — so making this
 *          @fresh would mean seeding a widget AND reconfiguring the Footer
 *          Builder's row layout through theme mods to place that widget area
 *          into a rendered row, then restoring the layout afterwards. That is
 *          more seeding than this assertion is worth, and it would be
 *          asserting against a footer this suite invented rather than one a
 *          user would have. The demo import produces the real shape for free.
 *          See the UNRESOLVED note below: the spec's premise is also in
 *          question, which is a second reason not to spend that budget yet.
 *
 * Guards the footer-widget-link half of CMAG-650 (fixed): a demo-import
 * CSS-conflict fix once added `.cm-footer-builder .widget a { color: #fff }`
 * unconditionally, overriding any imported widget's actual link color.
 *
 * Verified against current compiled style.css: that rule now only sets
 * `text-decoration: none` — no forced color.
 *
 * Test-bug fix (this spec, not the theme — this part only): the selector used
 * to be `.cm-footer-builder .widget a` unqualified, which also matches the
 * Footer Builder's own "Menu 1" component — deliberately white against the
 * dark footer by design, not an imported widget. A first attempt at narrowing
 * this used `.widget:not(.widget_nav_menu) a`, which did not work: the
 * nav-menu widget is nested *inside* the Footer Builder's own `.widget`-classed
 * wrapper, on a different element, so excluding `.widget_nav_menu` from the
 * immediate `.widget` ancestor does not stop its descendant links matching
 * through the outer wrapper. Fixed by checking each candidate link's closest
 * `.widget_nav_menu` ancestor at any depth and skipping it. That is a
 * selector-only fix — it changes how the spec finds the link, not what it
 * asserts about it.
 *
 * UNRESOLVED, flagged rather than forced green: after that fix the spec still
 * failed on the demo-imported site, and the premise — not the selector — looks
 * like the problem. Tracing the winning cascade rule for the link under test
 * (a social icon inside `colormag_footer_sidebar_two_upper`) via
 * `document.styleSheets` found FOUR matching rules, of which the highest
 * specificity — and so the one that wins — is
 * `.cm-footer-builder .widget.widget-colormag_footer_sidebar_two_upper a
 * { color: var(--cm-color-8) }`, a customizer-driven per-widget-slot variable.
 * That variable resolves to white on the default palette, which is what the
 * spec measures. But a *configurable* variable resolving to white is not the
 * same defect as CMAG-650's unconditional force, and no widget on that site
 * set its own distinct link colour to test the override against. Whether
 * `--cm-color-8` defaulting to white is intended or a regression of the same
 * bug through a more specific rule needs a human call, not a selector change.
 * Left as-is rather than narrowed further, which would risk asserting past
 * what is actually known.
 */
test('footer widget links are not forced white @demo @footer', async ({ page }) => {
  await page.goto('/');

  const color = await page.evaluate(() => {
    const links = Array.from(document.querySelectorAll('.cm-footer-builder .widget a'));
    const contentLink = links.find((a) => !a.closest('.widget_nav_menu'));
    return contentLink ? getComputedStyle(contentLink).color : null;
  });

  test.skip(
    color === null,
    'No footer widget links (excluding the Menu 1 nav-menu component) on this site to check — ' +
      'this is the @demo precondition: a footer with configured widget areas.',
  );

  expect(color, `Footer widget link color resolved to ${color} (forced white would be rgb(255, 255, 255))`).not.toBe(
    'rgb(255, 255, 255)',
  );
});
