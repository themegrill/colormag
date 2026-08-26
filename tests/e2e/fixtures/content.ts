import { test as base } from './wp-admin';
import type { APIRequestContext, Page } from '@playwright/test';

/**
 * Content the `@fresh` tier needs, created on demand and cleaned up after.
 *
 * The problem this solves: several specs asserted against the ThemeGrill
 * "Main" demo — a category literally named Politics, a post at a hardcoded
 * 2025 dated permalink, a menu item labelled World. None of that exists on a
 * CI runner, on a colleague's machine, or (as it turns out) on the reference
 * Local site any more. Those specs were not testing the demo import; they
 * just needed *a* category, *a* post, *a* menu with a dropdown, and reached
 * for whatever happened to be lying around.
 *
 * ## Reuse before create
 *
 * themegrill-qa's `blueprints/theme-test.json` already seeds ~12 posts, 3
 * categories, 4 pages and a nav menu with a "Dropdown Parent" → "Child One"
 * submenu into every Playground site. Re-seeding that would be slower and
 * would test something different from what CI actually renders. So every
 * helper here **looks first and creates only what is missing**, which is also
 * what makes the same spec work against a bare Local site (the reference site
 * is currently a clean slate: one post, no categories beyond Uncategorized,
 * and zero nav menus).
 *
 * ## Tagging and teardown
 *
 * CONVENTIONS.md rule 4 asks for a meta key on every created row. Registering
 * post meta needs `register_meta(... show_in_rest ...)` in PHP, and this pass
 * is explicitly not allowed to touch ColorMag's PHP — so the tag is the
 * `cm-e2e-` **slug prefix** instead, which the REST API can both set and
 * query, and which is just as unambiguous for identifying strays. Anything
 * this fixture creates is also recorded in a per-worker ledger and deleted in
 * reverse dependency order (menu items → menus, posts → categories), so a
 * suite that passes alone still passes in sequence.
 *
 * Nothing that already existed is ever deleted. If a helper reused the
 * blueprint's menu, teardown leaves it exactly where it found it.
 */

/** Prefix identifying every row this fixture creates. Also the cleanup key. */
export const E2E_PREFIX = 'cm-e2e';

type Created = { kind: 'post' | 'page' | 'category' | 'menu' | 'menu-item' | 'widget'; id: number };

export type SeededPost = { id: number; link: string; title: string; slug: string };
export type SeededCategory = { id: number; link: string; name: string; slug: string };
export type SeededMenu = { id: number; parentLabel: string; childLabel: string; childHref: string };
export type SeededTallMenu = { id: number; itemCount: number; lastItemLabel: string };

export type ContentHelper = {
  /** A published post that definitely exists, with a link to it. */
  aPost: () => Promise<SeededPost>;
  /** A category that definitely has at least one published post in it. */
  aPopulatedCategory: () => Promise<SeededCategory>;
  /** A published page that definitely exists. */
  aPage: () => Promise<SeededPost>;
  /** A word guaranteed to return at least one search result. */
  aSearchTerm: () => Promise<string>;
  /**
   * A nav menu assigned to every theme location, containing a top-level item
   * with at least one child — what the mobile submenu specs need.
   */
  aMenuWithDropdown: () => Promise<SeededMenu>;
  /**
   * A nav menu with enough top-level items that the rendered mobile
   * off-canvas panel is taller than a typical mobile viewport — what the
   * CMAG-742 overflow/scroll spec needs. Always created fresh: unlike the
   * other helpers, "reuse whatever menu already exists" cannot guarantee a
   * specific item count, and the whole point here is a deterministic
   * overflow rather than whatever happens to be lying around.
   */
  aMenuTooTallForMobile: () => Promise<SeededTallMenu>;
};

/**
 * A REST nonce, fetched without disturbing the spec's own page.
 *
 * The admin cookie alone is not enough: WordPress requires `X-WP-Nonce` for
 * writes *and* for reading private collections like `/wp/v2/menus`, which
 * answers a cookie-only request with 401 `rest_cannot_view`.
 *
 * Read from a throwaway second tab rather than from `page`. Navigating the
 * spec's own page to post-new.php mid-test would silently undo whatever it had
 * already set up — a seeding helper must never move the page under the test
 * that called it.
 */
async function restNonce(page: Page): Promise<string> {
  const scratch = await page.context().newPage();
  try {
    await scratch.goto('/wp-admin/post-new.php?post_type=post');
    const nonce = await scratch.evaluate(() => (window as any).wpApiSettings?.nonce);
    if (!nonce) {
      throw new Error(
        'Could not read a REST nonce from wpApiSettings on post-new.php. The block editor ' +
          'normally localises it; if that changed, seed content another way rather than ' +
          'assuming this screen still exposes it.',
      );
    }
    return nonce as string;
  } finally {
    await scratch.close();
  }
}

export const test = base.extend<{ content: ContentHelper }>({
  content: async ({ page }, use, testInfo) => {
    const created: Created[] = [];
    let nonce: string | null = null;
    const api = (): APIRequestContext => page.request;

    // Unique per worker so parallel workers cannot collide on a slug, and so a
    // stray row names the run that leaked it.
    const tag = `${E2E_PREFIX}-w${testInfo.workerIndex}`;

    const withNonce = async () => (nonce ??= await restNonce(page));

    async function post<T>(path: string, data: Record<string, unknown>): Promise<T> {
      const res = await api().post(path, { headers: { 'X-WP-Nonce': await withNonce() }, data });
      if (!res.ok()) {
        throw new Error(`Seeding ${path} failed (${res.status()}): ${await res.text()}`);
      }
      return (await res.json()) as T;
    }

    // The nonce goes on reads too — /wp/v2/menus and /menu-items are private
    // collections and answer a cookie-only GET with 401 rest_cannot_view.
    async function get<T>(path: string): Promise<T> {
      const res = await api().get(path, { headers: { 'X-WP-Nonce': await withNonce() } });
      if (!res.ok()) {
        throw new Error(`Reading ${path} failed (${res.status()}): ${await res.text()}`);
      }
      return (await res.json()) as T;
    }

    let cachedPost: SeededPost | null = null;
    let cachedCategory: SeededCategory | null = null;
    let cachedPage: SeededPost | null = null;
    let cachedMenu: SeededMenu | null = null;
    let cachedTallMenu: SeededTallMenu | null = null;

    const helper: ContentHelper = {
      aPost: async () => {
        if (cachedPost) return cachedPost;

        const existing = await get<Array<{ id: number; link: string; slug: string; title: { rendered: string } }>>(
          '/wp-json/wp/v2/posts?per_page=1&status=publish&orderby=date&order=desc',
        );
        if (existing.length > 0) {
          const p = existing[0];
          cachedPost = { id: p.id, link: p.link, slug: p.slug, title: p.title.rendered };
          return cachedPost;
        }

        const slug = `${tag}-post-${Date.now()}`;
        const p = await post<{ id: number; link: string; slug: string; title: { rendered: string } }>(
          '/wp-json/wp/v2/posts',
          {
            title: 'E2E seeded article — a headline long enough to wrap on narrow viewports',
            slug,
            status: 'publish',
            content:
              '<!-- wp:paragraph --><p>Lead paragraph. This body text exists so typography, ' +
              'line-height and measure can be inspected.</p><!-- /wp:paragraph -->',
          },
        );
        created.push({ kind: 'post', id: p.id });
        cachedPost = { id: p.id, link: p.link, slug: p.slug, title: p.title.rendered };
        return cachedPost;
      },

      aPopulatedCategory: async () => {
        if (cachedCategory) return cachedCategory;

        // `count > 0` is the whole requirement — an empty category archive is
        // a different template (and a different assertion) from a populated one.
        const populated = await get<Array<{ id: number; link: string; name: string; slug: string; count: number }>>(
          '/wp-json/wp/v2/categories?per_page=100&orderby=count&order=desc',
        );
        const usable = populated.find((c) => c.count > 0);
        if (usable) {
          cachedCategory = { id: usable.id, link: usable.link, name: usable.name, slug: usable.slug };
          return cachedCategory;
        }

        const slug = `${tag}-category-${Date.now()}`;
        const term = await post<{ id: number; link: string; name: string; slug: string }>(
          '/wp-json/wp/v2/categories',
          { name: 'E2E Seeded Category', slug },
        );
        created.push({ kind: 'category', id: term.id });

        const p = await post<{ id: number }>('/wp-json/wp/v2/posts', {
          title: 'E2E seeded article in a seeded category',
          slug: `${tag}-catpost-${Date.now()}`,
          status: 'publish',
          categories: [term.id],
          content: '<!-- wp:paragraph --><p>Body copy for the category archive.</p><!-- /wp:paragraph -->',
        });
        created.push({ kind: 'post', id: p.id });

        cachedCategory = { id: term.id, link: term.link, name: term.name, slug: term.slug };
        return cachedCategory;
      },

      aPage: async () => {
        if (cachedPage) return cachedPage;

        const existing = await get<Array<{ id: number; link: string; slug: string; title: { rendered: string } }>>(
          '/wp-json/wp/v2/pages?per_page=100&status=publish',
        );
        // Skip WooCommerce's own pages: cart/checkout/my-account render
        // shortcode- or block-driven app UI, not the plain page template this
        // is meant to exercise.
        const plain = existing.find((p) => !/^(cart|checkout|my-account|shop)$/.test(p.slug));
        if (plain) {
          cachedPage = { id: plain.id, link: plain.link, slug: plain.slug, title: plain.title.rendered };
          return cachedPage;
        }

        const slug = `${tag}-page-${Date.now()}`;
        const p = await post<{ id: number; link: string; slug: string; title: { rendered: string } }>(
          '/wp-json/wp/v2/pages',
          {
            title: 'E2E Seeded Page',
            slug,
            status: 'publish',
            content: '<!-- wp:paragraph --><p>Plain page content.</p><!-- /wp:paragraph -->',
          },
        );
        created.push({ kind: 'page', id: p.id });
        cachedPage = { id: p.id, link: p.link, slug: p.slug, title: p.title.rendered };
        return cachedPage;
      },

      aSearchTerm: async () => {
        // Derived from a real post title so the search genuinely matches
        // something, instead of hardcoding a demo-content word like "fitness".
        const p = await helper.aPost();
        const word = p.title
          .replace(/<[^>]*>/g, ' ')
          .split(/\s+/)
          .map((w) => w.replace(/[^\w-]/g, ''))
          .filter((w) => w.length > 4)[0];
        return word ?? 'the';
      },

      aMenuWithDropdown: async () => {
        if (cachedMenu) return cachedMenu;

        const menus = await get<Array<{ id: number; name: string }>>('/wp-json/wp/v2/menus?per_page=100');

        for (const menu of menus) {
          const items = await get<
            Array<{ id: number; parent: number; title: { rendered: string }; url: string }>
          >(`/wp-json/wp/v2/menu-items?menus=${menu.id}&per_page=100`);
          const child = items.find((i) => i.parent && i.parent > 0);
          if (!child) continue;
          const parent = items.find((i) => i.id === child.parent);
          if (!parent) continue;

          // Reused, not created — deliberately not recorded for cleanup.
          cachedMenu = {
            id: menu.id,
            parentLabel: stripTags(parent.title.rendered),
            childLabel: stripTags(child.title.rendered),
            childHref: child.url,
          };
          return cachedMenu;
        }

        const menu = await post<{ id: number }>('/wp-json/wp/v2/menus', {
          name: `${tag}-menu`,
          // Assign to every location the theme registers, so whichever one the
          // header actually renders picks this up.
          locations: await themeMenuLocations(get),
        });
        created.push({ kind: 'menu', id: menu.id });

        const parentLabel = 'E2E Parent';
        const childLabel = 'E2E Child';
        const parent = await post<{ id: number }>('/wp-json/wp/v2/menu-items', {
          title: parentLabel,
          url: '/',
          menus: menu.id,
          status: 'publish',
        });
        created.push({ kind: 'menu-item', id: parent.id });

        const childHref = (await helper.aPopulatedCategory()).link;
        const child = await post<{ id: number }>('/wp-json/wp/v2/menu-items', {
          title: childLabel,
          url: childHref,
          menus: menu.id,
          parent: parent.id,
          status: 'publish',
        });
        created.push({ kind: 'menu-item', id: child.id });

        cachedMenu = { id: menu.id, parentLabel, childLabel, childHref };
        return cachedMenu;
      },

      aMenuTooTallForMobile: async () => {
        if (cachedTallMenu) return cachedTallMenu;

        // 20 top-level items comfortably exceeds any mobile viewport this
        // suite uses (measured ~46px per rendered item against ColorMag's
        // off-canvas panel, so 20 items is ~920px of content against an
        // 812px-tall mobile project) without relying on a specific banner
        // height that could drift with theme changes.
        const ITEM_COUNT = 20;

        const menu = await post<{ id: number }>('/wp-json/wp/v2/menus', {
          name: `${tag}-tall-menu`,
          locations: await themeMenuLocations(get),
        });
        created.push({ kind: 'menu', id: menu.id });

        let lastItemLabel = '';
        for (let i = 1; i <= ITEM_COUNT; i++) {
          lastItemLabel = `E2E Tall Menu Item ${i}`;
          const item = await post<{ id: number }>('/wp-json/wp/v2/menu-items', {
            title: lastItemLabel,
            url: '/',
            menus: menu.id,
            status: 'publish',
          });
          created.push({ kind: 'menu-item', id: item.id });
        }

        cachedTallMenu = { id: menu.id, itemCount: ITEM_COUNT, lastItemLabel };
        return cachedTallMenu;
      },
    };

    await use(helper);

    // ---- teardown: children before parents, newest first ----------------
    const order: Created['kind'][] = ['menu-item', 'menu', 'widget', 'post', 'page', 'category'];
    const endpoint: Record<Created['kind'], string> = {
      post: '/wp-json/wp/v2/posts',
      page: '/wp-json/wp/v2/pages',
      category: '/wp-json/wp/v2/categories',
      menu: '/wp-json/wp/v2/menus',
      'menu-item': '/wp-json/wp/v2/menu-items',
      widget: '/wp-json/wp/v2/widgets',
    };

    for (const kind of order) {
      for (const row of created.filter((c) => c.kind === kind).reverse()) {
        try {
          await api().delete(`${endpoint[kind]}/${row.id}?force=true`, {
            headers: { 'X-WP-Nonce': await withNonce() },
          });
        } catch (err) {
          // A failed cleanup must not replace the test's own verdict — it is
          // reported so a leak is visible, and the `cm-e2e-` prefix makes the
          // stray row identifiable afterwards.
          console.warn(`content fixture: could not delete ${kind} ${row.id}: ${(err as Error).message}`);
        }
      }
    }
  },
});

/** Every nav-menu location the active theme registers, as a REST `locations` array. */
async function themeMenuLocations(
  get: <T>(path: string) => Promise<T>,
): Promise<string[]> {
  try {
    const locations = await get<Record<string, { name: string }>>('/wp-json/wp/v2/menu-locations');
    return Object.keys(locations);
  } catch {
    // Not fatal: an unassigned menu still renders wherever a spec asks for it
    // by name, and guessing a location name would be worse than none.
    return [];
  }
}

function stripTags(html: string): string {
  return html.replace(/<[^>]*>/g, '').trim();
}

export { expect } from '@playwright/test';
