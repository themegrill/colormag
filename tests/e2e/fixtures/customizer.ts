import { test as base } from './wp-admin';
import type { Page } from '@playwright/test';
import { restoreThemeMods } from './theme-mods-snapshot';

type CustomizerHelper = {
  /**
   * Opens the Customizer, optionally auto-focused on a control and/or
   * previewing a specific front-end URL. Mirrors the exact deep-link
   * pattern (`autofocus[control]=...&url=...`) used across the QA
   * sessions this suite is built from — it's the most reliable way to
   * land directly on the right panel instead of clicking through the
   * Customizer's own nested accordion UI.
   */
  open: (opts?: { control?: string; url?: string }) => Promise<void>;

  /**
   * Sets a control's value via `wp.customize(id).set(value)` in the
   * Customizer's top-level window, rather than driving the (often
   * React-rendered, CustoMind-based) control UI directly. This only
   * updates the live preview — nothing is persisted until publish() is
   * called, so most specs never need a revert step at all.
   */
  setControl: (id: string, value: unknown) => Promise<void>;

  /** frameLocator for the live preview iframe (`#customize-preview`). */
  previewFrame: () => ReturnType<Page['frameLocator']>;

  /**
   * Clicks Publish and waits for the save round-trip to finish. Only
   * needed by specs that must assert against a real (non-iframe) page
   * load — e.g. checking front-end HTML output rather than the preview.
   * Pair with a matching setControl() call restoring the original value
   * + publish() again in the test's cleanup step.
   */
  publish: () => Promise<void>;
};

export const test = base.extend<{ customizer: CustomizerHelper }>({
  customizer: async ({ page }, use) => {
    const helper: CustomizerHelper = {
      open: async (opts = {}) => {
        const params = new URLSearchParams();
        if (opts.control) params.set('autofocus[control]', opts.control);
        params.set('url', opts.url ?? '/');

        await page.goto(`/wp-admin/customize.php?${params.toString()}`);

        // wp.customize() isn't available until the Customizer JS finishes
        // bootstrapping — polling for it is more reliable in this codebase
        // than waiting on any specific control's DOM node, since CustoMind
        // renders several control types (accordions, sub-controls) whose
        // markup doesn't always match `#customize-control-<id>`.
        await page.waitForFunction(() => Boolean((window as any).wp?.customize), null, {
          timeout: 20_000,
        });
        await page.frameLocator('#customize-preview iframe').locator('body').waitFor();
      },

      setControl: async (id, value) => {
        await page.evaluate(
          ([controlId, controlValue]) => {
            (window as any).wp.customize(controlId as string).set(controlValue);
          },
          [id, value] as const,
        );
        // Let the postMessage round-trip to the preview iframe settle.
        await page.waitForTimeout(300);
      },

      previewFrame: () => page.frameLocator('#customize-preview iframe'),

      publish: async () => {
        // Earlier versions of this fixture waited for `#save` to
        // re-enable/re-disable in the DOM — measured taking as little as
        // 8.5s on one otherwise-idle run and, on another run against this
        // same unmodified site, still not fired after 45s while the
        // failure screenshot showed the button visibly enabled. That
        // single unreliable DOM wait was why three three-way specs were
        // shelved with test.fixme(). Replaced per instruction: wait for
        // the actual save network request to complete, then confirm from
        // the Customizer's own JS state (`wp.customize.state('saved')`)
        // rather than inferring it from the DOM at all.

        // Nothing to save is a normal state, not a failure, and it must be
        // detected BEFORE clicking. WordPress disables #save and relabels it
        // "Published" when the changeset is clean, so the click below would
        // wait on a permanently-disabled button and the customize_save
        // response would never arrive — the test just burns its whole
        // timeout. Observed for real: an interrupted earlier run left the
        // control's test value published, the next run snapshotted THAT as
        // its baseline, so setControl() to the same value was a no-op and
        // publish() hung for the full 150s.
        //
        // This is the same failure shape as the old #save wait, reached from
        // the opposite direction, so it is deliberately answered from
        // wp.customize state rather than from the button's disabled
        // attribute.
        const alreadySaved = await page.evaluate(
          () => (window as any).wp?.customize?.state?.('saved')?.get() === true,
        );
        if (alreadySaved) return;

        const saved = page.waitForResponse(
          (r) =>
            r.url().includes('admin-ajax.php') &&
            r.status() === 200 &&
            (r.request().postData() ?? '').includes('customize_save'),
        );
        await page.click('#save');
        await saved;

        await page.waitForFunction(
          () => (window as any).wp?.customize?.state?.('saved')?.get() === true,
          null,
          { timeout: 15_000 },
        );
      },
    };

    await use(helper);

    // Runs after every test that requests this fixture, regardless of
    // pass/fail/timeout — a per-spec try/finally revert can't make that
    // guarantee (a test that times out mid-`finally` skips the rest of
    // it; a test that throws before reaching its own cleanup skips all of
    // it), and a customizer spec that fails after publish() but before
    // its own revert otherwise leaves the live site mutated for whatever
    // spec happens to run next. See theme-mods-snapshot.ts's docblock for
    // the concrete cross-test-contamination case this fixes.
    await restoreThemeMods();
  },
});

export { expect } from '@playwright/test';
