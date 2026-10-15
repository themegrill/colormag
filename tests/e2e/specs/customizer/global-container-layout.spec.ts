import { mergeTests } from '@playwright/test';
import { test as customizerTest, expect } from '../../fixtures/customizer';
import { test as contentTest } from '../../fixtures/content';

const test = mergeTests(customizerTest, contentTest);

/**
 * Global > Layouts > Container, and the per-content-type "Inherit" fallback.
 *
 * Every content type (Post, Page, Blog, Search) has its own Container Layout,
 * registered with an "Inherit" default. Until 4.2.5 an UNSAVED per-type setting
 * resolved to Normal at runtime, so Global Container never reached these pages
 * and many sites carry Global = Narrow without ever having seen it applied.
 * 4.2.5 made the unsaved value inherit Global, and those sites shrank to the
 * narrow width with their sidebar hidden on update.
 *
 * Only the two Global controls are published; the per-type Container Layouts
 * are never touched, which is the "never saved" state on a fresh site. The
 * `customizer` fixture restores every theme mod from its snapshot afterwards.
 *
 * Verified live before being written (2026-10-14): 4.2.5 rendered
 * `cm-narrow-container` on post, page, blog, search and category with Global =
 * Narrow; 4.2.4 and the fix render `cm-normal-container`.
 *
 * @area    global
 * @tier    fresh
 * @guards  themegrill/colormag-pro#381
 * @source  write-spec 2026-10-14
 * @why     A Global Container value must not reshape posts, pages, the blog or
 *          search whose own Container Layout was never saved. Also asserts the
 *          Global Sidebar still applies, so the fix cannot be "completed" by
 *          reverting the sidebar inheritance from #338 as well. Does not assert
 *          widths, or what a SAVED Inherit or an explicit per-type layout does.
 */
test('unsaved per-type Container Layout stays Normal when Global Container is Narrow @fresh @global', async ({
  page,
  customizer,
  content,
}) => {
  test.setTimeout(120_000);

  const post = await content.aPost();
  const singlePage = await content.aPage();
  const term = await content.aSearchTerm();

  await customizer.open({ control: 'colormag_global_container_layout' });
  await customizer.setControl('colormag_global_container_layout', 'no_sidebar_content_centered');
  await customizer.setControl('colormag_global_sidebar_layout', 'right_sidebar');
  await customizer.publish();

  const bust = (url: string) => url + (url.includes('?') ? '&' : '?') + 'e2e-cache-bust=' + Date.now();
  const templates: Array<[string, string]> = [
    ['single post', post.link],
    ['page', singlePage.link],
    ['blog', '/'],
    ['search', `/?s=${encodeURIComponent(term)}`],
  ];

  for (const [label, url] of templates) {
    await page.goto(bust(url));
    const classes = (await page.locator('body').getAttribute('class')) ?? '';

    expect(
      classes,
      `${label}: Global Container = Narrow must not narrow a template whose own Container Layout was never saved.`,
    ).toContain('cm-normal-container');
    expect(classes, `${label}: rendered the narrow container.`).not.toContain('cm-narrow-container');
  }

  await page.goto(bust(post.link));
  await expect(
    page.locator('body'),
    'single post: Global Sidebar = Right must still apply when the post Sidebar Layout is left at Inherit.',
  ).toHaveClass(/\bcm-right-sidebar\b/);
});
