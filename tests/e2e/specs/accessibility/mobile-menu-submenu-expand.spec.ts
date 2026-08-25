import { test, expect } from '../../fixtures/wp-admin';

/**
 * Complements mobile-menu-escape-key.spec.ts (which covers the one
 * confirmed-open bug, CMAG-734). This spec covers the happy path the
 * ground rules ask for explicitly: at mobile width, the hamburger opens,
 * a submenu item with children expands to reveal them, and those child
 * links are real, clickable, correctly-hrefed links — not just that the
 * toggle button exists.
 *
 * Verified live on this site (2026-08-25) at 375px: the hamburger opens an
 * off-canvas panel with a search box and the primary menu; clicking a
 * top-level item's own chevron button (not the item's link) expands an
 * indented child list without navigating away; the child links carry the
 * correct category/tag URLs. No bug found here.
 */
test('mobile primary menu opens and a submenu expands to reveal working child links @pr', async ({ page }) => {
  await page.setViewportSize({ width: 375, height: 812 });
  await page.goto('/');

  const toggle = page.getByRole('button', { name: /menu/i }).first();
  await toggle.click();

  // Scoped to the off-canvas mobile nav specifically (#cm-mobile-nav) —
  // a bare role+text filter also matches the footer's own nav menu
  // (#cm-footer-nav), which happens to list the same category names.
  const nav = page.locator('#cm-mobile-nav');
  await expect(nav).toBeVisible();

  const politicsLink = nav.getByRole('link', { name: 'Politics', exact: true });
  await expect(politicsLink).toHaveAttribute('href', /\/category\/politics\/?$/);

  // The submenu toggle is a sibling button next to the item's own link,
  // not the link itself — clicking it must expand children without
  // navigating.
  const politicsItem = nav.locator('li', { has: politicsLink }).first();
  const submenuToggle = politicsItem.getByRole('button');
  await submenuToggle.click();

  const childLink = nav.getByRole('link', { name: 'World', exact: true });
  await expect(childLink).toBeVisible({ timeout: 10_000 });
  await expect(childLink).toHaveAttribute('href', /\/tag\/world\/?$/);

  await expect(page).toHaveURL(/\/$/); // still on the front page — the toggle didn't navigate
});
