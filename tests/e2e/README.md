# ColorMag E2E suite

Playwright specs guarding confirmed bugs/regressions found across prior QA
sessions on this theme. This is the first test suite in this repo — there
were no existing conventions to inherit, so the choices below (fixtures,
tagging, tiering) are a starting point, open to revision.

Scoped to **ColorMag (free) only** for now. ColorMag Pro-only findings from
the QA ledger (Header Builder Logo Height, Active Text Color ancestor
highlighting, Scroll-to-Top, the preset-5 palette-reset regression) are
intentionally not covered here.

## Setup

```bash
pnpm install
npx playwright install chromium
cp tests/e2e/.env.example tests/e2e/.env   # fill in WP_ADMIN_USER / WP_ADMIN_PASSWORD / WP_DB_*
```

`WP_DB_*` (host/port/user/password/name, optionally table prefix and a
`mysql` binary path) is a **hard precondition**, not optional — global
setup uses it to trash stale Customizer auto-draft changesets before the
run starts. Without it, opening the Customizer can silently restore a
leftover unpublished draft from an earlier run instead of starting clean,
which makes two consecutive runs of the same suite legitimately diverge
for reasons that have nothing to do with the specs themselves. See
`clearStaleChangesets()` in `global-setup.ts`.

## Running

```bash
pnpm test:e2e            # everything
pnpm test:e2e:pr         # fast, deterministic — every PR
pnpm test:e2e:nightly    # slower/state-heavy — scheduled runs only
pnpm test:e2e:ui         # interactive UI mode, for authoring/debugging
```

Tests are tagged `@pr` or `@nightly` in their titles and selected via
`--grep`, rather than separate spec directories per tier — a spec's
directory reflects the *feature* it covers (matching the QA ledger's
grouping), not how often it runs.

## Layout

- `fixtures/wp-admin.ts` — base fixture; auth itself happens once in
  `global-setup.ts` via `storageState`, not per test.
- `fixtures/customizer.ts` — opens the Customizer, sets a control's value
  via `wp.customize(id).set()` against the live preview (no Publish, no
  revert needed for most specs), plus a `publish()` step for the few specs
  that must assert against a real page load instead of the preview iframe.
- `fixtures/demo-import.ts` — REST-based before/after page diffing for
  cleanup after an import, instead of a full WP-CLI DB snapshot/restore
  (not assumed available in every environment this suite might run in).
- `fixtures/geometry.ts` — bounding-box helpers for layout assertions, so
  specs describe what's visually true (image above vs. beside content)
  instead of reading CSS class names or `flex-direction`.

## Known gaps — read before extending this suite

- **`demoImport.runImport()` is a documented stub, not implemented.** The
  "pick a demo, start the import, wait for completion" interaction lives
  in the `themegrill-demo-importer` plugin's own admin UI (a separate
  plugin, not this theme) and wasn't verified against a live DOM for this
  pass. The three specs in `specs/demo-importer/` that need it are marked
  `test.fixme()` until it's filled in.
- **Block-editor selectors are best-effort.** `block-editor-heading-color.spec.ts`
  uses current Gutenberg conventions (`iframe[name="editor-canvas"]`, the
  slash inserter) but hasn't been confirmed against a live run.
- **Two specs assert the *correct* behavior for bugs confirmed still
  open** and are marked `test.fail()` so they document intent without
  failing CI: `mobile-menu-escape-key.spec.ts` (CMAG-734) and
  `orphaned-pages.spec.ts` (CMAG-681, once its `runImport()` TODO is
  filled in). Remove the annotation once the underlying bug is actually
  fixed — an unexpected pass is the signal to do so.
- Everything else asserts behavior confirmed fixed, verified directly
  against current theme source before being written (see each spec's
  top comment for what was checked and where).

See the QA ledger this suite is based on for the full findings inventory,
including what was deliberately left out of automated coverage and why.
