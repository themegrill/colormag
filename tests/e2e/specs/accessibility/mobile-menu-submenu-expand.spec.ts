import { test, expect } from '../../fixtures/content';

/**
 * @area    header
 * @tier    fresh
 * @source  human 2026-08-25
 * @why     The off-canvas mobile menu is the one navigation path a phone
 *          visitor has, and its submenu toggle is a separate button from the
 *          item's own link — a regression that makes the chevron navigate
 *          instead of expand strands every child page on mobile without
 *          breaking anything a desktop reviewer would notice.
 *
 * Complements mobile-menu-escape-key.spec.ts, which covers the one
 * confirmed-open bug (CMAG-734). This is the happy path: at mobile width the
 * hamburger opens, an item with children expands to reveal them, and those
 * child links are real, correctly-hrefed links — not just that a toggle
 * button exists.
 *
 * Verified live (2026-08-25) at 375px: the hamburger opens an off-canvas panel
 * with a search box and the primary menu; clicking a top-level item's own
 * chevron button (not the item's link) expands an indented child list without
 * navigating away; the child links carry the correct URLs.
 *
 * Test-bug fix — how it finds, not what it asserts: this used to hardcode the
 * Main demo's "Politics" → "World" pair and assert `/category/politics/` and
 * `/tag/world/` hrefs. That menu does not exist on a Playground runner and no
 * longer exists on the reference Local site either (which has zero nav menus),
 * so the spec was unrunnable anywhere but one machine at one point in time.
 * The menu now comes from the content fixture, which reuses the blueprint's
 * "Dropdown Parent" → "Child One" where CI provides it and seeds an equivalent
 * pair where it does not. The assertions are unchanged: a child link becomes
 * visible, it carries the href it was configured with, and the page did not
 * navigate.
 */
test('mobile primary menu opens and a submenu expands to reveal working child links @fresh @header', async ({
  page,
  content,
}) => {
  const menu = await content.aMenuWithDropdown();

  await page.setViewportSize({ width: 375, height: 812 });
  await page.goto('/');

  const toggle = page.getByRole('button', { name: /menu/i }).first();
  await toggle.click();

  // Scoped to the off-canvas mobile nav specifically (#cm-mobile-nav) — a bare
  // role+text filter also matches the footer's own nav menu (#cm-footer-nav),
  // which can list the same item names.
  const nav = page.locator('#cm-mobile-nav');
  await expect(nav).toBeVisible();

  const parentLink = nav.getByRole('link', { name: menu.parentLabel, exact: true });
  await expect(parentLink).toBeVisible();

  // The `has:` locator is re-rooted against each candidate <li>, so it must be
  // relative — built from `page`, not from `nav`. Passing `parentLink` here
  // (which carries its own `#cm-mobile-nav` prefix) asks Playwright to find a
  // `#cm-mobile-nav` INSIDE the li, which never matches, and the filter
  // silently returns zero elements rather than erroring. That bug was in the
  // original spec too; it had simply never run.
  const parentItem = nav
    .locator('li')
    .filter({ has: page.getByRole('link', { name: menu.parentLabel, exact: true }) })
    .first();

  // The submenu toggle is a sibling control next to the item's own link, not
  // the link itself — clicking it must expand children without navigating.
  // ColorMag renders it as <span role="button" class="cm-submenu-toggle">, so
  // this is an ARIA-role match, not an element-name one.
  await parentItem.getByRole('button').first().click();

  const childLink = nav.getByRole('link', { name: menu.childLabel, exact: true });
  await expect(childLink).toBeVisible({ timeout: 10_000 });
  await expect(childLink).toHaveAttribute('href', hrefPattern(menu.childHref));

  await expect(page).toHaveURL(/\/$/); // still on the front page — the toggle did not navigate
});

/**
 * Compare the path, not the whole URL. The configured href is absolute and
 * carries whatever host the site is served from; matching on that would
 * reintroduce exactly the one-machine coupling this spec was just freed from.
 */
function hrefPattern(href: string): RegExp {
  const path = href.replace(/^https?:\/\/[^/]+/, '').replace(/\/$/, '');
  return new RegExp(`${path.replace(/[.*+?^${}()|[\]\\]/g, '\\$&')}/?$`);
}
