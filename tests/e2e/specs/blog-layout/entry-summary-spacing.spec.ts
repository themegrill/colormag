import { test, expect } from '../../fixtures/wp-admin';

/**
 * @area    content
 * @tier    fresh
 * @source  human 2026-08-25
 * @why     A doubled gap above post content is a pure-CSS regression that no
 *          functional test would catch and that ships looking merely
 *          "a bit loose". Guards the fix, not the exact spacing value.
 *
 * Guards the fix/remove-entry-summary-fixed-top-margin branch (fixed):
 * `.cm-entry-summary` used to carry its own top margin that stacked with
 * the *immediately preceding element*'s bottom margin, doubling the
 * visual gap above a single post's content to ~24px instead of one
 * ~12px gap.
 *
 * Verified against the current compiled style.css: no standalone
 * `.cm-entry-summary { margin-top: ... }` rule remains.
 *
 * Deliberately not asserting an exact pixel value — that's an
 * implementation detail. The threshold below only needs to catch the
 * doubled-gap regression coming back, not pin the design to one number.
 *
 * Test-bug fix (this spec, not the theme): this used to hardcode
 * `.cm-entry-title` as the element immediately above `.cm-entry-summary`
 * and measure title-bottom to summary-top. On this site (and, from
 * inspecting `template-parts/content.php`, apparently by default on any
 * site) that gap is not empty margin at all — `.cm-below-entry-meta` (the
 * byline/date row) sits between them, a real ~22px-tall content block,
 * not spacing — so the old measurement was really "margin + a whole
 * meta row + margin" (~45.6px, reproducing identically on every run,
 * because it isn't flaky: it's measuring the wrong two elements). An
 * earlier attempt at fixing this by picking a post with a featured image
 * instead of "most recent" didn't help, because the meta row shows up
 * regardless of featured image. Fixed by measuring from
 * `.cm-entry-summary`'s actual DOM `previousElementSibling` — whatever
 * that is (title directly, or a meta row, or anything else this theme's
 * post-header options produce) — instead of assuming it's always the
 * title. That's exactly what "the summary's own top margin doubling with
 * whatever comes before it" means, and it doesn't need to special-case
 * page-header/featured-image state at all: this changes what the spec
 * measures, from a hardcoded pair of elements to "the summary and
 * whatever actually precedes it" — flagging this per the instruction to
 * flag a change to *what* is measured, not just how it's found. The
 * assertion itself (single ~12px gap, not doubled) is unchanged.
 */
test('single post title-to-content gap is a single gap, not doubled @fresh @content', async ({ page }) => {
  const res = await page.request.get('/wp-json/wp/v2/posts?per_page=1&status=publish');
  const posts = (await res.json()) as Array<{ link: string }>;
  test.skip(posts.length === 0, 'No published posts on this site to check spacing against.');

  await page.goto(posts[0].link);

  const summary = page.locator('.cm-entry-summary').first();
  const summaryBox = await summary.boundingBox();
  if (!summaryBox) {
    throw new Error('Could not measure .cm-entry-summary — check the page rendered as expected.');
  }

  const precedingBox = await summary.evaluate((el) => {
    const prev = el.previousElementSibling;
    if (!prev) return null;
    const rect = prev.getBoundingClientRect();
    return { top: rect.top, bottom: rect.bottom, tag: prev.tagName, className: prev.className };
  });
  if (!precedingBox) {
    throw new Error('.cm-entry-summary has no preceding sibling — check the page rendered as expected.');
  }

  const gap = summaryBox.y - precedingBox.bottom;

  // A doubled gap (the original bug) was ~24px; a single gap ~12px.
  // 20px gives headroom for minor design changes without missing a
  // regression back to the doubled state.
  expect(
    gap,
    `Expected a single ~12px gap between .cm-entry-summary and its preceding ` +
      `<${precedingBox.tag.toLowerCase()} class="${precedingBox.className}">, measured ${gap}px`,
  ).toBeLessThan(20);
  expect(gap, `Expected a non-negative gap, measured ${gap}px`).toBeGreaterThanOrEqual(0);
});
