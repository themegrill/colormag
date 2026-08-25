import { test, expect } from '../../fixtures/wp-admin';

/**
 * Guards the footer-widget-link half of CMAG-650 (fixed): a demo-import
 * CSS-conflict fix once added `.cm-footer-builder .widget a { color: #fff }`
 * unconditionally, overriding any imported widget's actual link color.
 *
 * Verified against current compiled style.css: that rule now only sets
 * `text-decoration: none` — no forced color. This runs against whatever
 * footer widget links are currently on the site rather than requiring a
 * fresh demo import, since the bug was a static CSS rule, not
 * import-specific behavior — it would affect footer widget links however
 * they got there.
 *
 * Test-bug fix (this spec, not the theme — this part only): the selector
 * used to be `.cm-footer-builder .widget a` unqualified, which also
 * matches the Footer Builder's own "Menu 1" component — deliberately
 * white against the dark footer by design, not an imported widget. A
 * first attempt at narrowing this used `.widget:not(.widget_nav_menu) a`,
 * which didn't work: on this site the nav-menu widget is nested *inside*
 * the Footer Builder's own outer `.widget`-classed wrapper, on a
 * different element, so excluding `.widget_nav_menu` from the immediate
 * `.widget` ancestor doesn't stop its descendant links from still
 * matching through the outer wrapper. Fixed by checking each candidate
 * link's actual closest `.widget_nav_menu` ancestor (at any depth) and
 * skipping it. That part is a genuine selector-only fix — it changes how
 * the spec finds the link, not what it asserts about it.
 *
 * UNRESOLVED, flagged rather than forced green: after that fix, the spec
 * still fails on this site, and this time it looks like the spec's
 * premise may not hold rather than a selector bug. Traced the winning
 * cascade rule for the actual link under test (a social icon inside
 * `colormag_footer_sidebar_two_upper`) via `document.styleSheets`: FOUR
 * rules match it — a generic `a { color: var(--cm-color-1) }`, the
 * blanket `.cm-footer-builder a { color: #fff }` `_footer_builder.scss`
 * still ships (specificity 0,1,1), the dynamic-CSS bundle's own base `a`
 * rule, and — highest specificity, so the one that actually wins —
 * `.cm-footer-builder .widget.widget-colormag_footer_sidebar_two_upper a
 * { color: var(--cm-color-8) }`, a customizer-driven, per-widget-slot
 * variable. That variable currently resolves to white on this site's
 * palette, which is what the spec measures — but a *configurable*
 * variable resolving to white is not the same defect as CMAG-650's
 * original unconditional force, and no widget on this site sets its own
 * distinct link color to actually test the override against. I can't
 * tell from here whether `--cm-color-8` defaulting to white is intended
 * or a regression of the same bug through a different, more specific
 * rule — that needs a human call, not a selector change. Left red rather
 * than narrowed further, which would risk asserting past what's actually
 * known.
 */
test('footer widget links are not forced white @pr', async ({ page }) => {
  await page.goto('/');

  const color = await page.evaluate(() => {
    const links = Array.from(document.querySelectorAll('.cm-footer-builder .widget a'));
    const contentLink = links.find((a) => !a.closest('.widget_nav_menu'));
    return contentLink ? getComputedStyle(contentLink).color : null;
  });

  test.skip(
    color === null,
    'No footer widget links (excluding the Menu 1 nav-menu component) on this site to check.',
  );

  expect(color, `Footer widget link color resolved to ${color} (forced white would be rgb(255, 255, 255))`).not.toBe(
    'rgb(255, 255, 255)',
  );
});
