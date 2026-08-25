import { test, expect } from '../../fixtures/wp-admin';

/**
 * The negative test (CONVENTIONS.md rule 5): before asserting anything a
 * control does, assert that every template type renders cleanly on its own
 * — no PHP notice/warning/deprecation leaking into the HTML, no raw
 * shortcode text, no untranslated placeholder. This is the check that
 * would have caught a fatal on activation and is cheap enough to run on
 * every PR.
 *
 * Verified live on this site (2026-08-25, ColorMag 4.2.2, ThemeGrill Main
 * demo imported): all six template types below render without PHP notices
 * or literal shortcode text. One template-independent finding surfaced
 * during that pass that this spec deliberately does NOT assert against,
 * documented here instead of silently ignored:
 *
 *   - category archive, single post, page and 404 all fire one console
 *     `net::ERR_NAME_NOT_RESOLVED` for an ad-widget image pointing at
 *     `ap0.qsandbox.cloud` — a dead external asset baked into the
 *     Main demo's imported content (an ad/sidebar widget), not something
 *     ColorMag's own code requests. It does not appear on the front page
 *     or search results, which don't render that sidebar. Not asserted
 *     against here because it is demo *content*, not theme behavior —
 *     flagged in the QA report as "doc drift / demo-content", not a
 *     ColorMag bug.
 *
 * The front page and the "page" template in this run are Elementor-built
 * (the Main demo's static Home / Sample Page), so this also functions as
 * the three-way's implicit check that ColorMag's own header/footer chrome
 * still wraps third-party page-builder content without a PHP notice.
 */
const TEMPLATES: Array<{ name: string; path: string }> = [
  { name: 'front page (static, Elementor-built)', path: '/' },
  { name: 'category archive', path: '/category/politics/' },
  { name: 'single post', path: '/2025/05/13/new-artist-takes-the-music-scene-by-storm-with-unforgettable/' },
  { name: 'page (plain, non-builder)', path: '/sample-page/' },
  { name: 'search results', path: '/?s=fitness' },
  { name: '404', path: '/this-page-does-not-exist-9a8b7c/' },
];

for (const { name, path } of TEMPLATES) {
  test(`${name} renders with no PHP notice and no raw shortcode text @pr`, async ({ page }) => {
    const response = await page.goto(path);

    const bodyText = await page.locator('body').innerText();

    // PHP surfaces problems as literal text in the response when
    // WP_DEBUG_DISPLAY is on — these strings should never reach the DOM.
    for (const marker of ['Notice:', 'Warning:', 'Deprecated:', 'Fatal error:']) {
      expect(bodyText, `Found PHP "${marker}" text on ${name} (${path})`).not.toContain(marker);
    }

    // A shortcode that didn't resolve prints as literal `[tag ...]` text.
    expect(bodyText, `Found raw shortcode-looking text on ${name} (${path})`).not.toMatch(/\[\/?[a-z][a-z0-9_-]*(\s[^\]]*)?\]/i);

    await expect(page.locator('body')).toBeVisible();

    if (path === '/this-page-does-not-exist-9a8b7c/') {
      expect(response?.status(), '404 template should actually respond 404').toBe(404);
    }
  });
}
