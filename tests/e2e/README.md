# ColorMag E2E suite

Playwright specs for ColorMag, written so three different callers can run
them: you on your own machine, CI on every pull request, and the
`themegrill-qa` agent skills. They are the same specs in all three cases —
what changes is which **tier** runs, because not every spec is meaningful on
every kind of site.

## The two tiers

Every test carries its tier as a tag in its **title**, because a title is what
Playwright's `--grep` actually matches. There are exactly two.

**`@fresh`** — runs against a site with nothing on it but WordPress, ColorMag
activated, and whatever `themegrill-qa`'s `blueprints/theme-test.json` seeds
(~12 posts, 3 categories, 4 pages, a nav menu with one dropdown, postname
permalinks). Anything else a `@fresh` spec needs, it seeds for itself through
`fixtures/content.ts`, which reuses what is already there and creates only
what is missing — so the same spec runs unchanged on a bare Local site. This
is the tier CI runs, and it is 19 of the 23 tests.

**`@demo`** — needs a site with a ThemeGrill demo imported. Four tests, and
each is `@demo` because of what it asserts rather than how much work it would
be: three assert side-effects **of the import routine itself** (seeding
equivalent content would skip the code path under test), and
`header-footer-css-conflict` needs a footer widget that sets its own link
colour, which a clean site has no way to produce without inventing a Footer
Builder layout. An **untagged** test is treated as `@demo` by the platform, so
it would silently lose its CI coverage — do not leave one untagged.

## The environment variables

Three values, each resolved through the same precedence chain in `env.ts`:
`TGQA_*` (exported by the platform's `run-suite.mjs`, so you never set these)
→ `CM_*` (yours) → `WP_*` (legacy, still honoured) → a default.

| Value | Yours | Notes |
|---|---|---|
| Site URL | `CM_BASE_URL` | Defaults to `http://test-colormag.local`, so a local run needs no setup at all |
| Admin user | `CM_ADMIN_USER` | **No default.** Missing credentials fail loudly rather than timing out on a login screen |
| Admin password | `CM_ADMIN_PASS` | Same |

`TGQA_ENV` (`playground` \| `wp-env` \| `local`) tells specs what kind of site
they are on. It is what makes the DB-level helpers skip themselves on
Playground, which is PHP-WASM on SQLite with no MySQL, no real cron and no
outbound mail. Read it to branch; never weaken an assertion to make one spec
pass in both places — tag it `@demo`, or skip it with a stated reason.

## Where `.env.local` goes

**In the theme root, next to `package.json`** — not in this directory. Copy
`tests/e2e/.env.example` to `.env.local` and fill it in. It is gitignored and
must stay that way: a credential never belongs in a tracked file, and if you
find one in a spec, a config or a workflow, that is a bug to fix rather than a
pattern to copy. A run against a real (non-disposable) site also needs the
`WP_DB_*` block, which two helpers use to trash stale Customizer changesets
before the run and to snapshot and restore the active theme's mods around it.
Both are skipped automatically on Playground.

## Running it

Against your Local site, nothing to configure beyond `.env.local`:

```
pnpm test:e2e          # everything
pnpm test:e2e:fresh    # the CI tier — what a PR gates on
pnpm test:e2e:demo     # needs a demo-imported site
pnpm test:e2e:ui       # interactive
pnpm test:e2e:report   # open the last HTML report
```

Against a disposable Playground site, let the platform boot one and point the
suite at it — this is exactly what CI does, so it is the way to reproduce a CI
failure locally:

```
node "$THEMEGRILL_QA_HOME/scripts/run-suite.mjs" --tier fresh --boot playground --install
```

Or point the suite at any site yourself:

```
CM_BASE_URL=https://example.test TGQA_ENV=local pnpm test:e2e:fresh
```

## Two things that will bite you

The suite logs in once per run (`auth.setup.ts`, a setup project) and caches
the session in `.auth/`. That cache is validated before it is trusted, so a
stale one re-logs in rather than failing the run — you should never need to
delete it by hand.

Driving a Customind control with `wp.customize(id).set(value)` updates the
underlying setting reliably, but does **not** reliably trigger Customind's own
React re-render of the live preview. A real user's click does. So a
`.set()`-driven test that sees no preview change has found a gap in this
suite's tooling, not a theme bug — never report "live preview broken" from
one. The three round-trip specs assert the publish and reopen legs only, and
say so in their docblocks.
