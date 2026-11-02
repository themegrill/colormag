import { mergeTests } from '@playwright/test';
import { test as customizerTest, expect } from '../../fixtures/customizer';
import { test as contentTest } from '../../fixtures/content';

const test = mergeTests(customizerTest, contentTest);

/**
 * Global > Layouts > Container, and the per-content-type "Inherit" fallback.
 *
 * Every content type (Post, Page, Blog, Search) has its own Container Layout,
 * registered with an "Inherit" default, and the Customizer previews an unsaved
 * one as inheriting Global. The front end resolved it to Normal instead, so a
 * published Global Container change never went live (themegrill/colormag-pro#410).
 * Unsaved values now inherit Global. Sites that already carried a non-Normal
 * Global when updating keep Normal for unsaved layouts, in the Customizer and
 * on the front end alike, through an option recorded once on update (#381).
 * That path is not asserted here: it needs the option cleared, which no
 * fixture can do.
 *
 * Only the two Global controls are published; the per-type Container Layouts
 * are never touched, which is the "never saved" state on a fresh site. The
 * `customizer` fixture restores every theme mod from its snapshot afterwards.
 *
 * Verified live before being written (2026-10-28): after publishing these two
 * controls, the preview and the published post, page, blog and search all
 * render `cm-narrow-container`, and single posts keep the Global Right Sidebar.
 *
 * @area    global
 * @tier    fresh
 * @guards  themegrill/colormag-pro#410
 * @source  write-spec 2026-10-28
 * @why     A published Global Container must reach posts, pages, the blog and
 *          search whose own Container Layout was never saved, as the preview
 *          shows. Also asserts the Global Sidebar still applies, so the fix
 *          cannot be "completed" by reverting the sidebar inheritance from #338.
 *          Does not assert widths, or what a SAVED per-type layout does.
 */
test('unsaved per-type Container Layout follows a published Global Container @fresh @global', async ({
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
      `${label}: a never-saved Container Layout shows as Inherit in the Customizer, so it must follow Global Container = Narrow.`,
    ).toContain('cm-narrow-container');
    expect(classes, `${label}: rendered the normal container.`).not.toContain('cm-normal-container');
  }

  await page.goto(bust(post.link));
  await expect(
    page.locator('body'),
    'single post: Global Sidebar = Right must still apply when the post Sidebar Layout is left at Inherit.',
  ).toHaveClass(/\bcm-right-sidebar\b/);
});
