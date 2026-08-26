import { test, expect } from '../../fixtures/content';

/**
 * @area    header
 * @tier    fresh
 * @guards  CMAG-742
 * @source  verify-fix 2026-08-26
 * @why     Before this fix the off-canvas mobile menu had no height cap and
 *          no scroll: `overflow-y` was `visible`, so a menu with enough
 *          top-level items rendered its trailing items entirely below the
 *          viewport with no way to reach them (confirmed live at 375x667
 *          against pre-fix code — items 12-14 of a 14-item menu were fully
 *          off-screen). The fix bounds the open menu's height to the space
 *          actually available below it and makes it internally scrollable.
 *          This spec guards the mechanism, not just that the menu opens:
 *          the box must genuinely be scrollable, and scrolling it must
 *          genuinely reveal the last item. It deliberately does not assert
 *          the exact pixel height used for the cap, only that content
 *          taller than the box is reachable.
 *
 * Seeds its own 20-item menu via the content fixture rather than relying on
 * the blueprint's or a demo's menu — neither is long enough to overflow a
 * mobile viewport, and the whole point here is a deterministic overflow.
 */
test('mobile off-canvas menu becomes scrollable when its content overflows the viewport @fresh @header', async ({
  page,
  content,
}) => {
  const menu = await content.aMenuTooTallForMobile();

  await page.setViewportSize({ width: 375, height: 812 });
  await page.goto('/');

  const toggle = page.getByRole('button', { name: /menu/i }).first();
  await toggle.click();

  const nav = page.locator('#cm-mobile-nav');
  await expect(nav).toBeVisible();

  // ColorMag's own off-canvas box — no semantic equivalent exists for "a
  // custom scrollable panel", so this is the owned-chrome exception under
  // CONVENTIONS.md rule 1, same as the `#cm-mobile-nav` root used above.
  const menuBox = nav.locator('.cm-mobile-menu');
  await expect(menuBox).toHaveCSS('overflow-y', 'scroll');

  const { scrollHeight, clientHeight } = await menuBox.evaluate((el) => ({
    scrollHeight: el.scrollHeight,
    clientHeight: el.clientHeight,
  }));
  // The box is genuinely bounded below its content — not just tagged
  // scrollable while still rendering everything inline.
  expect(scrollHeight).toBeGreaterThan(clientHeight);

  const lastItem = nav.getByRole('link', { name: menu.lastItemLabel, exact: true });
  await expect(lastItem).not.toBeInViewport();

  await menuBox.evaluate((el) => {
    el.scrollTop = el.scrollHeight;
  });
  await expect(lastItem).toBeInViewport();
});
