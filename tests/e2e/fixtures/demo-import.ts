import { test as base } from './wp-admin';

/**
 * Demo-import specs are the slowest and most state-mutating in this suite
 * (they create dozens of real posts/pages/menus). Rather than a full
 * WP-CLI database snapshot/restore — not assumed to be available in every
 * environment this suite might run in — cleanup here works by diffing
 * page IDs before/after via the REST API and deleting whatever the import
 * created. That's enough for the specs in specs/demo-importer/, which only
 * assert against pages; a heavier DB-snapshot rollback is worth adding
 * later if imported posts/menus/options need cleaning up too.
 */

const STARTER_TEMPLATES_PATH = 'themes.php?page=colormag&tab=starter-templates';

type PageSummary = { id: number; slug: string; link: string };

type DemoImportHelper = {
  gotoStarterTemplates: () => Promise<void>;
  snapshotPublishedPages: () => Promise<PageSummary[]>;
  deletePagesCreatedSince: (before: PageSummary[]) => Promise<void>;
  /**
   * Intentionally unimplemented — see the TODO block at the bottom of this
   * file. Selects and runs a named demo import, resolving once the
   * plugin reports completion. Specs that need this are marked
   * `test.fixme()` until it's filled in against the demo-importer
   * plugin's actual admin UI.
   */
  runImport: (demoSlug: string) => Promise<void>;
};

export const test = base.extend<{ demoImport: DemoImportHelper }>({
  demoImport: async ({ page, wpAdmin }, use) => {
    const helper: DemoImportHelper = {
      gotoStarterTemplates: () => wpAdmin.goto(STARTER_TEMPLATES_PATH),

      runImport: async (demoSlug: string) => {
        throw new Error(
          `demoImport.runImport("${demoSlug}") is not implemented yet — fill this in against the ` +
            'themegrill-demo-importer plugin\'s current admin UI (its selectors live in that plugin\'s ' +
            'own repo, not this theme) before un-fixme-ing the spec that called it.',
        );
      },

      snapshotPublishedPages: async () => {
        const res = await page.request.get('/wp-json/wp/v2/pages?per_page=100&status=publish');
        const pages = (await res.json()) as Array<{ id: number; slug: string; link: string }>;
        return pages.map(({ id, slug, link }) => ({ id, slug, link }));
      },

      deletePagesCreatedSince: async (before) => {
        const beforeIds = new Set(before.map((p) => p.id));
        const res = await page.request.get('/wp-json/wp/v2/pages?per_page=100&status=publish');
        const after = (await res.json()) as Array<{ id: number }>;
        const created = after.filter((p) => !beforeIds.has(p.id));

        for (const p of created) {
          await page.request.delete(`/wp-json/wp/v2/pages/${p.id}?force=true`);
        }
      },
    };

    await use(helper);
  },
});

export { expect } from '@playwright/test';

/**
 * TODO before enabling the specs in specs/demo-importer/ for real:
 *
 * The "click a demo, start the import, wait for completion" interaction
 * lives entirely in the themegrill-demo-importer plugin's own admin UI
 * (a separate plugin repo, not this theme) — its exact selectors weren't
 * verified against a live DOM for this pass. Each demo-importer spec below
 * calls a `runImport()` step with the intended API left as a documented
 * stub; fill it in against the plugin's current admin screen before
 * running these specs in CI.
 */
