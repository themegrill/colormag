import { test, expect } from '../../fixtures/customizer';
import type { Page } from '@playwright/test';

/** Years seeded, oldest first. Newest three are the expected related posts. */
const YEARS = [2008, 2009, 2010, 2011, 2012, 2013, 2014, 2015, 2016, 2017, 2018, 2019];

/** The three oldest are the ones we view — each is its own transient key. */
const VIEW_COUNT = 3;

const PREFIX = 'cm-e2e-cmag741';

type SeededPost = { id: number; link: string; title: string; year: number };

/*
 * A REST nonce, read from a throwaway tab.
 *
 * Duplicated from `fixtures/content.ts` rather than imported, because that
 * module does not export it and this spec needs the `customizer` fixture (for
 * the theme-mod publish plus its guaranteed restore), not the `content` one.
 * Merging the two fixtures for a single spec would be a larger change to
 * shared code than copying twenty lines into the one file that needs them.
 *
 * Deliberately a `/* *\/` comment and not a `/** *\/` docblock: themegrill-qa's
 * spec parser (scripts/lib/spec-parse.mjs, `docblockAbove`) attributes to a
 * test the LAST docblock closing before it with only whitespace in between.
 * A docblock here would win over the spec's own and the test would index with
 * no @area, no @tier and no @guards — silently uncounted coverage.
 */
async function restNonce(page: Page): Promise<string> {
  const scratch = await page.context().newPage();
  try {
    await scratch.goto('/wp-admin/post-new.php?post_type=post');
    const nonce = await scratch.evaluate(() => (window as any).wpApiSettings?.nonce);
    if (!nonce) {
      throw new Error('Could not read a REST nonce from wpApiSettings on post-new.php.');
    }
    return nonce as string;
  } finally {
    await scratch.close();
  }
}

/**
 * @area    content
 * @tier    fresh
 * @guards  CMAG-741
 * @source  verify-fix 2026-08-26
 * @why     Related Posts picked a RANDOM offset into the date-ordered pool
 *          (`colormag_get_offset_random_post_ids()`), so "You May Also Like"
 *          could surface arbitrarily old posts — reproduced live at 10 of 12
 *          trials showing a stale window, e.g. 2016/2015/2014 out of a
 *          2006–2025 pool. The fix adds `colormag_get_recent_post_ids()` and
 *          an "Order By" control defaulting to Recent.
 *
 *          This guards the DEFAULT ordering only: with Order By unset (or
 *          Recent), the three most recent posts in the matching category are
 *          shown, deterministically. It deliberately does NOT assert anything
 *          about the opt-in Random mode — random output has no stable
 *          assertion — nor about related-posts styling, card layout,
 *          thumbnails or entry meta, all of which are free to change without
 *          this spec caring. It also says nothing about the `tags` query
 *          mode, which shares the fixed code path but not this fixture.
 *
 * ## Why three posts are viewed rather than one page reloaded
 *
 * The result is cached in a transient keyed by post ID
 * (`colormag_related_<id>_<query>_<order>`), so reloading one post re-serves
 * the same cached window and gives only ONE draw against the bug. Flushing
 * that transient from a spec would need a PHP round-trip this suite has no
 * route for. Viewing three DIFFERENT posts is three independent cache keys,
 * hence three independent draws, without touching the cache at all.
 *
 * That is also what makes the assertion strong. The pool is 12 seeded posts;
 * excluding the post being viewed leaves 11, so the broken code picks one of
 * 9 possible 3-post windows and hits the newest with p≈1/9. Across three
 * posts that is p≈0.0014 of a false pass. Measured against the pre-fix code
 * it failed on the FIRST viewed post, on the ordering assertion.
 *
 * Runtime ~7s, within the 30s guideline.
 */
test('Related Posts shows the most recent posts in the category, not a random window @fresh @content', async ({
  page,
  customizer,
}) => {
  test.setTimeout(120_000);

  const nonce = await restNonce(page);
  const headers = { 'X-WP-Nonce': nonce };
  const created: Array<{ endpoint: string; id: number }> = [];

  const post = async <T>(path: string, data: Record<string, unknown>): Promise<T> => {
    const res = await page.request.post(path, { headers, data });
    if (!res.ok()) throw new Error(`Seeding ${path} failed (${res.status()}): ${await res.text()}`);
    return (await res.json()) as T;
  };

  try {
    // ---- seed: one dedicated category, 12 posts with a wide date spread ----
    //
    // A dedicated category (not Uncategorized) is what makes the expected
    // result knowable: `category__in` then matches only these 12 posts, so
    // whatever else the site happens to hold — the blueprint's ~12 posts, a
    // Local site's "Hello world!" — cannot appear in the assertion.
    const stamp = Date.now();
    const category = await post<{ id: number }>('/wp-json/wp/v2/categories', {
      name: 'CMAG-741 Related Order',
      slug: `${PREFIX}-cat-${stamp}`,
    });
    created.push({ endpoint: '/wp-json/wp/v2/categories', id: category.id });

    const seeded: SeededPost[] = [];
    for (const year of YEARS) {
      const p = await post<{ id: number; link: string }>('/wp-json/wp/v2/posts', {
        title: `CMAG-741 Seeded Post ${year}`,
        slug: `${PREFIX}-${year}-${stamp}`,
        status: 'publish',
        date: `${year}-06-15T12:00:00`,
        categories: [category.id],
        content: '<!-- wp:paragraph --><p>Body copy.</p><!-- /wp:paragraph -->',
      });
      created.push({ endpoint: '/wp-json/wp/v2/posts', id: p.id });
      seeded.push({ id: p.id, link: p.link, title: `CMAG-741 Seeded Post ${year}`, year });
    }

    const newestFirst = [...seeded].sort((a, b) => b.year - a.year);
    const expectedTitles = newestFirst.slice(0, 3).map((p) => p.title);
    const oldest = [...seeded].sort((a, b) => a.year - b.year).slice(0, VIEW_COUNT);

    // ---- enable Related Posts, pinned to the Categories query ----
    await customizer.open({ control: 'colormag_enable_related_posts' });

    // Read (do not yet assert) whether the fix's new control is registered.
    // Asserted at the END of this spec on purpose: the ordering assertions
    // below are the actual regression, and they must be what fails first
    // against the broken code. A control-existence check placed here would
    // short-circuit the run before the bug was ever exercised.
    const orderControlRegistered = await page.evaluate(
      () => typeof (window as any).wp.customize('colormag_related_posts_order') !== 'undefined',
    );

    await customizer.setControl('colormag_enable_related_posts', true);
    await customizer.setControl('colormag_related_posts_query', 'categories');
    await customizer.publish();

    // ---- assert: every viewed post shows the same three newest posts ----
    //
    // Selecting on the theme's own classes is correct here and not a rule-1
    // violation: for a theme the markup IS the product, and `.related-posts`
    // has no semantic landmark to reach for. The visible heading is used as
    // the anchor so a renamed wrapper fails loudly rather than silently
    // matching nothing.
    for (const viewed of oldest) {
      await page.goto(viewed.link);

      await expect(
        page.getByRole('heading', { name: 'You May Also Like' }),
        `Related Posts section missing on ${viewed.title} — the toggle did not take effect`,
      ).toBeVisible();

      const titles = await page.locator('.single-related-posts .cm-entry-title a').allInnerTexts();

      expect(
        titles.map((t) => t.trim()),
        `Related Posts on "${viewed.title}" should be the three most recent posts in the ` +
          `category (CMAG-741). A window of older posts here means the random-offset ` +
          `selection is back.`,
      ).toEqual(expectedTitles);
    }

    // ---- and the control the fix introduced is actually registered ----
    expect(
      orderControlRegistered,
      'Customizer control colormag_related_posts_order (Single Post → Related Posts → ' +
        'Order By) is not registered — CMAG-741 shipped it alongside the ordering fix.',
    ).toBe(true);
  } finally {
    // Children before parents: posts, then the category they belonged to.
    // Theme mods are restored by the customizer fixture's own teardown, which
    // runs even if this spec times out — see fixtures/customizer.ts.
    for (const row of [...created].reverse()) {
      try {
        await page.request.delete(`${row.endpoint}/${row.id}?force=true`, { headers });
      } catch (err) {
        console.warn(
          `related-posts spec: could not delete ${row.endpoint}/${row.id}: ${(err as Error).message}`,
        );
      }
    }
  }
});
