import { test, expect } from '../../fixtures/demo-import';

/**
 * Guards CMAG-681 — filed as resolved in Jira, but a later QA session
 * re-confirmed it still reproducing: a starter-template import leaves
 * orphaned duplicate pages behind (Home/Blog/Contact ×3 observed), with
 * only one of each correctly wired as Front Page / Posts Page — including
 * one orphaned page reachable at a plausible URL instead of the real
 * Posts Page.
 *
 * marked test.fixme(): needs demoImport.runImport() implemented first
 * (see fixtures/demo-import.ts). Once that's filled in, this documents a
 * bug that — per the QA session — is still open despite its ticket status,
 * so expect it to need a test.fail() annotation too until it's genuinely
 * fixed.
 */
test.fixme('demo import does not leave orphaned duplicate pages @nightly', async ({ page, demoImport }) => {
  const before = await demoImport.snapshotPublishedPages();

  await demoImport.gotoStarterTemplates();
  await demoImport.runImport('agency'); // TODO: pick/parametrize a real demo slug once runImport() works

  try {
    const pagesRes = await page.request.get('/wp-json/wp/v2/pages?per_page=100&status=publish');
    const pages = (await pagesRes.json()) as Array<{ slug: string; link: string }>;

    const slugCounts = pages.reduce<Record<string, number>>((acc, p) => {
      acc[p.slug] = (acc[p.slug] ?? 0) + 1;
      return acc;
    }, {});

    const duplicated = Object.entries(slugCounts).filter(([, n]) => n > 1);
    expect(duplicated, `Found duplicate page slugs after import: ${JSON.stringify(duplicated)}`).toHaveLength(0);

    // The site's front page and posts page should each resolve to a real,
    // non-orphaned page rather than an arbitrary duplicate.
    const settingsRes = await page.request.get('/wp-json/wp/v2/settings');
    const settings = await settingsRes.json();
    expect(settings.page_on_front, 'Front page should be explicitly configured after import').not.toBe(0);
    expect(settings.page_for_posts, 'Posts page should be explicitly configured after import').not.toBe(0);
  } finally {
    await demoImport.deletePagesCreatedSince(before);
  }
});
