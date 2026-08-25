# ColorMag

<!--
Replaces a generic, unfilled boilerplate version of this file (identical to
the pipeline's default template, never previously edited — confirmed via
`git log` and via git status showing it as untracked). This version is
drafted from theme source + git history (see knowledge.draft.md for the
source-only pass) AND a live browser QA session against
http://test-colormag.local (ColorMag 4.2.2, ThemeGrill "Main" demo
imported, 2026-08-25). Everything below is one of: something seen happen
in that session, a fact read directly from source with a file:line, or an
explicit TODO for a human — never a guess presented as fact.
-->

- **Slug:** `colormag`
- **Type:** theme
- **Repo:** github.com/themegrill/colormag (inferred from merge-commit URLs in git log, e.g. `acd50382`) — TODO confirm
- **Pro companion:** ColorMag Pro (`colormag-pro`, sibling theme directory on this machine) — TODO confirm repo
- **Jira project key:** `CMAG` (from commit messages: CMAG-708, CMAG-732, CMAG-650, etc.). One `DITG-51` commit also seen — **confirmed by the product owner**: `DITG` is the separate Jira project for the ThemeGrill Demo Importer plugin, not this theme.
- **Supported:** WP 5.0+ (`Requires at least`, style.css). **Doc drift**: style.css says `Tested up to: 7.0`, readme.txt says `Tested up to: 6.9` — these disagree and no WP 7.0 exists yet as of this writing, so style.css's header is very likely stale. PHP 7.4+ (`Requires PHP`)
- **Version on this site:** 4.2.2
- **Companion plugins on this site:** ThemeGrill Demo Importer (starter sites, confirmed via `themegrill_demo_importer_activated_id` option), Elementor, Magazine Blocks (confirmed active — see Integrations)

## What it is, in two sentences

A magazine/news WordPress theme whose header and footer are built with a
proprietary drag-and-drop framework called **Customind** (a React app at
`inc/customizer/customind/`, replacing raw `$wp_customize->add_*` calls in
most option files). Its actual front-page content mechanism is WordPress
widget areas populated through Appearance → Widgets, not a customizer
category-picker — see "Front page mechanism" below, a correction to what a
generic magazine-theme assumption would predict.

## Critical flows

**Ordering confirmed by the product owner**, from this file's own mined
fix-commit counts rather than a generic magazine-theme assumption — the
data disagreed sharply with the first-pass seed order (which had front-page
news blocks and demo import first), so blast radius here is ranked by
where the theme has actually, repeatedly cost the most to get wrong, not
by which surface a user notices first.

1. **Upgrade / migration** — `inc/migration/class-colormag-migration.php`,
   45 fix commits, the single most-patched file in the theme. Worst
   customer impact when it fails: a bad migration silently reshapes or
   drops a customer's existing settings on update, which is the class of
   bug this file exists specifically to prevent (see "Upgrade paths that
   matter" below — still the least-covered section of this document,
   which is itself a gap worth closing before anything else here).
2. **Customizer round-trip, including block-editor parity** —
   `inc/base/class-colormag-dynamic-css.php` (43) +
   `inc/core/class-colormag-enqueue-scripts.php` (41) + Customind's own
   live-preview sync (`customind.js` + `cm-customize-preview.js`, 59
   combined) = 143 fix-commit touches, more than migration and everything
   else combined. **Partially verified** this session for three
   representative controls (Global > Colors > Base, Global > Typography
   > Body font size, Header Builder > Main Area padding) — the
   publish+reopen legs passed; see Known-fragile below for why the
   automated live-preview leg and the automated publish() step itself
   both turned out to be less reliable in this environment than manual
   verification, which passed cleanly on all three legs for all three
   controls.
3. **Header/Footer Builder vs. legacy panel** — one theme mod
   (`colormag_enable_builder`) switching the entire header/footer
   settings surface between two independent code paths, and existing
   sites get migrated onto it. **Verified live: this site has the builder
   enabled** (confirmed both in the theme_mods snapshot and by using the
   Customizer UI). New installs default to the builder
   (`colormag_maybe_enable_builder()`).
4. **Fresh activation and template rendering** — **verified**: every
   template type (front page, category archive, single post, plain page,
   search, 404) rendered cleanly on this site with no PHP notices and no
   raw shortcode text.
5. **Header layout and mobile menu** — **verified**: Header Builder's Main
   Area row (logo + primary menu) has Container/Height/Color/Background/
   Padding/Margin controls; changing Padding correctly changed row height
   on publish. At 375px, the hamburger opens an off-canvas panel with
   search + the primary menu; a top-level item's own chevron button
   (distinct from the item's link) expands an indented child list without
   navigating away; child links carry correct URLs.
6. **RTL** — `style-rtl.css` churned 98 times in fix commits, nearly as
   much as `style.css` itself, yet has **zero coverage** from this
   session or the pre-existing spec suite. The single largest gap between
   evidenced fragility and actual test coverage in this whole document —
   next QA pass should start here, not at the bottom of a list.
7. **Demo import** (ThemeGrill Demo Importer, a separate plugin, Jira
   project `DITG`) — not exercised this session (the Main demo was
   already imported). `inc/migration/demo-import-migration.php` exists
   specifically to reconcile customizer state after an import.
8. **WooCommerce** — theme ships a compatibility layer
   (`inc/compatibility/woocommerce/`); not exercised this session (no
   WooCommerce admin menu observed on this site, so it does not appear to
   be active here).

**Not ranked above, still TODO**: theme switch away and back (theme mods
are per-theme, so some loss is by design — see Known non-issues — but the
exact expected behaviour on switching back to ColorMag isn't confirmed).

## Front page mechanism (correction to a generic assumption)

A first-pass draft of this file (built from source + a generic
magazine-theme template) assumed ColorMag has a customizer category-picker
for front-page news blocks. **That's wrong for this version, verified two
ways:**

- The live Customizer's **Front Page** panel contains exactly one control
  (`colormag_hide_blog_static_page_post`, "Hide blog posts/static page")
  plus a Pro-upsell block — no category assignment UI.
- ColorMag's own docs confirm the real mechanism: "In the ColorMag theme,
  we add the posts on the front page with the help of the widget area."
  (<https://docs.themegrill.com/colormag/docs/enable-or-disable-latest-blog-posts-or-static-page-content-on-the-front-page/>)

The actual mechanism: `front-page.php` always runs for the front page
(WP's own template-hierarchy front-page.php takes priority regardless of
Settings → Reading mode). It outputs a series of widget areas
(`colormag_front_page_slider_area`, `colormag_front_page_area_beside_slider`,
`colormag_front_page_content_{top,middle_left,middle_right,bottom}_section`)
populated through Appearance → Widgets — **all empty on this site's live
theme_mods**, which is why none of them render here — followed by a
`.cm-posts` wrapper (guarded by the one Front Page toggle) containing
either "Your latest posts" or, when the front page is set to a static page
(this site's configuration, Customizer → Homepage Settings → "A static
page"), that static page's own content.

**On this site specifically**, the front page is a static page ("Home",
post ID 2463) built with **Elementor** (+ the **Magazine Blocks** plugin
for the news-grid layout you see visually) — so the rich homepage layout
this demo shows comes from Elementor/Magazine Blocks content injected via
`the_content()`, not from ColorMag's own front-page widget-area system,
which sits there unused. **Verified**: toggling the one Front Page control
on/off correctly hid/showed `.cm-posts` (and therefore the Elementor page
content within it) in the live Customizer preview.

## Admin surfaces

| Surface | Where | Notes |
|---|---|---|
| Customizer | `/wp-admin/customize.php` | Built on Customind (`inc/customizer/customind/core/Customind.php`). **Live panel inventory, verified**: Global (Typography, Colors, Category Colors, Layouts, Sidebar, Button), Front Page (one toggle + upsell), Header (builder: drag-and-drop rows — Top/Main/Bottom areas, each holding components like Widget N, Date, Social, Site Title & Logo, Secondary Menu, Search, Primary Menu, Random Post Viewer; some components Pro-gated — Divider, Off Canvas, Color Switcher), Post Types, Footer (builder: same pattern — HTML 1, Socials, Widget N columns, Copyright, Menu 1; Logo/Button Pro-gated), Additional, plus core WP sections (Site Identity, Header Media, Menus, Widgets, Homepage Settings, Additional CSS) |
| ColorMag dashboard/welcome page | Appearance → ColorMag (`add_theme_page`, `inc/admin/class-colormag-dashboard.php:30`) | Onboarding/welcome screen, plugin install nudges |
| Demo Importer | Appearance → Demo Importer | Provided by companion plugin, not this theme |
| Widgets | `/wp-admin/widgets.php` | Sidebars registered: `colormag_right_sidebar`, `colormag_left_sidebar`, `colormag_header_sidebar`, the front-page section sidebars above, `colormag_footer_sidebar_{one,two,three,four}` (+`_upper` variants — **note**: `_upper` variants can hold real widgets even when the plain ones are empty, verified live: `colormag_footer_sidebar_two_upper` held a block-based widget on this site), `colormag_contact_page_sidebar`, `colormag_error_404_page_sidebar`, `colormag_advertisement_above_the_footer_sidebar`, `header-sidebar-2` |
| Menus | `/wp-admin/nav-menus.php` | Locations on this site: `primary`, `menu-secondary` |

## Frontend surfaces

Front page (static and blog), category archive, tag archive, author
archive, date archive, single post, page, search results, 404 — **all
verified rendering cleanly** on this site (no PHP notices, no raw
shortcode text). No custom post types or shortcodes registered by the
theme itself.

Footer (global, every template): **verified live** — on a plain page
(non-Elementor), the footer showed only Copyright text + a "Menu 1"
category-link nav; the four main footer widget columns were empty (no
widgets assigned on this site) but the builder wiring for them is
confirmed correct — populating them is untested this session.

TODO: list the theme's own widgets and confirm which third-party
shortcodes this theme must not mangle.

## Roles and capabilities

| Role | Should be able to | Must NOT be able to |
|---|---|---|
| Administrator | Customize, import demos, switch theme | — |
| Editor | Publish content | Reach the customizer or demo importer — TODO: not tested with an Editor account this session (only Administrator and Subscriber were tested) |
| Subscriber | Read the frontend | Any theme option — **verified**: a real Subscriber account (created and deleted this session) got HTTP 403 from `/wp-admin/customize.php` |
| Logged out | Read the frontend | Everything admin |

Capability checks found in theme code: `manage_options`, `edit_theme_options`,
`install_plugins`/`activate_plugins`, `edit_post`/`edit_page`/`edit_user`.
No ColorMag-specific role gate beyond WP's own capability system was found
in source.

## Integrations

- **WooCommerce** — `inc/compatibility/woocommerce/woocommerce.php`; shop
  sidebar toggle via `colormag_woocommerce_sidebar_register_setting` theme
  mod. Not active on this site (no WooCommerce admin menu observed) —
  TODO test with it active.
- **Elementor** — active on this site and used for the front page ("Home")
  and at least one other page. Renders correctly wrapped in ColorMag's own
  header/footer chrome (confirmed: the Elementor front page still shows
  the theme's header, primary nav, and global footer) — i.e. it's using
  Elementor's "Default"/theme-wrapped template, not "Canvas". TODO:
  full-width/canvas template support specifically, and re-check the
  "orphaned Elementor widgets" issue a prior session's notes flagged.
- **Magazine Blocks** (`wp-content/plugins/magazine-blocks/`) — active on
  this site, provides the `mzb-*` block classes used in the demo's
  news-grid layout. **Confirmed bug in this plugin's own generated CSS**
  (not ColorMag's): its inline `<style id="magazine-blocks-blocks-css-...">`
  tags on this site's front page contain `align-items:;` (an empty-value
  CSS declaration) in `.mzb-section-*` rules — same defect *class* as
  ColorMag's own already-fixed CMAG-738, but in the companion plugin, not
  this theme.
- **Gutenberg** — block-editor styling sync is one of the most-churned
  areas in this theme's git history (multiple "not reflecting in block
  editor" fixes for typography/colors/buttons).
- **ThemeGrill Demo Importer** — required for starter sites; not bundled
  in this theme's code.

## Data model / persistence

Settings are **theme mods** (`get_theme_mod`/`set_theme_mod`), stored in
the `theme_mods_colormag` option — **confirmed on this live site** by
querying `wp_options` directly (`option_id` 672). wp-cli was not available
in this environment (see Environment notes), so this was verified via a
direct `mysqli` query against the site's database instead of
`wp option get`.

Also stored **outside** theme_mods, as separate `wp_options` rows:
- Migration-run flags (booleans, not the settings themselves):
  `colormag_breadcrumb_options_migrate`, `colormag_builder_migration`,
  `colormag_container_sidebar_migration`, `colormag_demo_import_migration_notice_dismiss`,
  `colormag_free_demo_migrated_to_builder`,
  `colormag_free_major_update_customizer_migration_v1`,
  `colormag_logo_height_migration`, `colormag_maybe_enable_builder`,
  `colormag_outside_background_migration`, `colormag_sidebar_layout_migration`,
  `colormag_social_icons_control_migrate`, `colormag_social_icons_migrated_v1`,
  `colormag_top_bar_options_migrate`, `colormag_typography_migration`
- `colormag_theme_installed_time`, `colormag_admin_noticewelcome`, `colormag_logger_flag`
- `_customind_google_fonts_url` (Customind framework cache)
- **`customize_changeset` posts** (`wp_posts`, `post_type = 'customize_changeset'`)
  — WordPress core, not ColorMag-specific, but worth flagging: repeated
  Customizer sessions (including automated ones) accumulate `auto-draft`
  changesets, and WP's own "restore the more recent autosave" prompt on
  reopening the Customizer can silently load one of these instead of the
  published state — **this caused real confusion during this session's
  own spec-writing** (see tests/e2e/fixtures/customizer.ts comments and
  the QA report). Worth a periodic cleanup (`post_status = 'trash'` for
  stale auto-drafts) on any long-lived test/staging site.
- No custom database tables (`CREATE TABLE`/`dbDelta`: zero matches in
  theme code).

## Upgrade paths that matter

TODO — highest-value section, needs a human. `inc/migration/class-colormag-migration.php`
(45 fix-commit touches — the single most-patched file in the theme)
contains the actual migration routines, each gated by one of the flags
listed above:
- `colormag_typography_migration` — typography settings reshaped
- `colormag_sidebar_layout_migration` / `colormag_container_sidebar_migration` — sidebar/container layout settings reshaped
- `colormag_social_icons_migrated_v1` / `_control_migrate` — social icons control changed shape twice
- `colormag_top_bar_options_migrate`, `colormag_breadcrumb_options_migrate`, `colormag_outside_background_migration`, `colormag_logo_height_migration` — one-off reshapes
- `colormag_free_major_update_customizer_migration_v1` — migrates existing sites onto the Header/Footer Builder
- `colormag_free_demo_migrated_to_builder` — demo-imported sites specifically

What must survive each of these, and how to seed the pre-migration shape
to test them, needs whoever wrote `class-colormag-migration.php` or a
changelog deep-dive.

## Known-fragile areas

**The `#save`-state wait was the root cause of three shelved specs — read
this before writing another Customizer spec here.** `customizer.publish()`
originally waited for WP core's `#save` button to flip
enabled→disabled/"Publish"→"Published" in the DOM. That wait was the
single most unreliable thing in this whole suite: measured completing in
8.5s on one otherwise-idle run, and still not firing after 45s on another
run against this same unmodified site — while the failure screenshot from
that second run showed `#save` visibly rendered as an enabled "Publish"
button at the moment `toBeEnabled()` gave up. Because three separate
specs (`global-colors-three-way`, `global-typography-three-way`,
`header-main-area-padding-three-way`) all called `publish()`, all three
were shelved with `test.fixme()` even though the product behavior each
guards was independently, repeatedly confirmed correct by hand.

**Fixed** by not inferring the save from the DOM at all: `publish()` now
waits for the actual `admin-ajax.php` POST whose body contains
`customize_save` to resolve, then confirms success from the Customizer's
own JS state (`window.wp.customize.state('saved').get() === true`) rather
than a UI element. Un-shelved all three specs on this fix. Proof: ran the
three formerly-shelved specs in a five-iteration loop — 12 of 15
individual runs passed; the one iteration where all three failed
together did so by hitting the *test's* 90s timeout with three workers
contending for one local WP install simultaneously, not the publish
mechanism itself — a serial (`--workers=1`) re-run of the same three
specs passed 3/3 in ~23s each. If a future spec's `publish()` call
times out, suspect resource contention from parallel workers on this
single dev site before suspecting the fixture again.

Two more, smaller Customizer-testing gotchas worth knowing before writing
a spec here:
- WP core's own autosave-to-server round trip (roughly 15s after any
  `setControl()`, independent of transport type) creates a second
  `#customize-preview iframe` mid-session while the first is still live.
  A bare `page.frameLocator('#customize-preview iframe')` will
  intermittently strict-mode-fail. Either scope to `.last()` (the one WP
  is actually showing), or — more robust, since `.last()` re-resolves
  live and two separate calls to it can land on two different iframes if
  the swap happens in between them — wait for
  `document.querySelectorAll('#customize-preview iframe').length === 1`
  before reading anything out of the preview at all.
- Setting a control via the low-level `wp.customize(id).set(value)` API
  reliably updates the underlying setting (so `publish()` and the
  published front end both reflect it correctly) but does not reliably
  trigger CustoMind's own React re-render of the live preview's dynamic
  CSS. A real user's click **does** update the preview live — this is a
  gap in how this suite drives CustoMind's React controls, not a theme
  bug. The three three-way specs above deliberately assert only the
  publish+reopen legs for this reason, with the preview leg verified by
  hand instead.

Evidenced from git history (127 fix/bug/hotfix/regress/revert commits in
the last 400) plus this session's own findings:

| Area | Evidence |
|---|---|
| `inc/migration/class-colormag-migration.php` | 45 fix-commit touches — the migration logic itself |
| `inc/base/class-colormag-dynamic-css.php` | 43 touches — customizer-setting-to-CSS translation; repeated "not reflecting in block editor" bugs |
| `inc/core/class-colormag-enqueue-scripts.php` | 41 touches — asset enqueue, Google Fonts, editor/frontend parity |
| Customind live-preview sync (`customind.js`, `cm-customize-preview.js`) | 31+28 touches — **this is the exact three-way-check failure mode**: past fixes for "Blog title font size change not reflected in customizer preview", "Search Button Color not reflected in search box dropdown", "Footer Column layout option not working" |
| **CONFIRMED, reproducing today**: Customind React console errors | Opening `/wp-admin/customize.php` reliably logs 5 React "Invalid DOM property" console errors (`stroke-linecap`, `stroke-linejoin`, `stroke-width`, `fill-rule`, `clip-rule` — SVG icon components using raw HTML attribute names instead of React's camelCase equivalents). Reproduced on repeated fresh loads. Purely console noise, no visible rendering defect found. This suite's `customind-console-warnings.spec.ts` already guards it as CMAG-733. |
| **This session's own tooling gap**: driving Customind controls via `wp.customize(id).set()` | Does NOT reliably trigger Customind's own React re-render of the live preview's dynamic CSS. A real user changing a control **does** update the preview live (confirmed by hand, with screenshots) — this is a gap in how an automated suite drives these specific React controls, not a theme bug. |
| ~~Automating the Publish click itself~~ | **Fixed** — see "The `#save`-state wait..." above this table. Superseded, kept struck through rather than deleted so the history of what was tried is legible. |
| **Cross-test contamination via `theme_mods_colormag`** (found and fixed this session) | A customizer spec that publishes a test value and then fails *before* its own revert step left the live site mutated for whatever spec ran next — concretely, `blog-layout/entry-summary-spacing.spec.ts` (an unrelated layout measurement) once measured a gap more than 3x its expected size purely because of this. Fixed at the fixture level: `tests/e2e/global-setup.ts` snapshots `theme_mods_colormag` once before the suite runs, and the shared `customizer` fixture (`tests/e2e/fixtures/customizer.ts`) restores it after every test that uses it, regardless of pass/fail. |
| **This dev machine degrades over a long session, independent of parallel vs. serial** | Two default-parallel full-suite runs and two serial (`--workers=1`) full-suite runs, all four run back-to-back with no manual reset, did NOT produce an identical failing set — the intersection stable across all four was only 4 specs (`mobile-menu-submenu-expand`, `block-editor-heading-color`, `dynamic-css-empty-declarations`, `header-footer-css-conflict`); serial was consistently better than parallel, but even serial-vs-serial got worse the later it ran (4 failed vs. 9 failed). Basic, always-reliable specs (plain template renders) failed only under heavy parallel contention. Treat any single run's totals on this specific machine with caution — prefer the intersection across a couple of runs, and expect a fresh session/machine to look better than this one's later runs. |
| RTL layout | style-rtl.css churned 98 times in fix commits — nearly as much as style.css itself, and has **zero test coverage**. The single biggest evidenced-fragility-vs-coverage gap in this document. |
| Menu dropdowns at the tablet breakpoint | Not tested this session (375px and 1440px only) |
| `blog-layout/entry-summary-spacing.spec.ts` fails on this site, unrelated to the contamination above | Measures a consistent ~45.6px gap against whatever post `/wp-json/wp/v2/posts?per_page=1` returns on this site, reproducing identically across repeated clean runs — not flaky, but the spec's own docblock caveats it assumes "page header enabled, on a post that has one," which may not hold for whichever post that query picks here. Needs a human to confirm expected gap for this site's actual post state, or seed a specific fixture post instead of using whatever's most recent. |

## Known non-issues

<!-- Every false positive the agent reports gets a line here, with a reason. -->
- A `net::ERR_NAME_NOT_RESOLVED` console error for an ad-widget image
  (`ap0.qsandbox.cloud/.../CM-Ad.jpg`) on category archive/single/page/404
  templates — this is a dead external asset baked into the Main demo's
  imported sidebar widget content, not something ColorMag's own code
  requests. Doesn't appear on the front page or search results (different
  sidebar config). Demo-content issue, not a theme bug.

## Environment notes

- **This machine's `wp` CLI is broken**: the global Composer install at
  `~/AppData/Roaming/Composer/vendor/wp-cli/wp-cli` is missing
  `php/boot-fs.php` and fails immediately on any command. Local by
  Flywheel does not bundle a working `wp-cli.phar` for this site either.
  Verified/restored DB state instead via the site's Local MySQL instance
  directly (host `127.0.0.1`, port from `AppData/Roaming/Local/sites.json`
  → this site's `mysql.ports.MYSQL`, credentials `root`/`root`, database
  `local`) using the bundled `lightning-services/mysql-*/bin/win64/bin/mysql.exe`
  / PHP `mysqli`. A human should fix the wp-cli install before the next QA
  pass — the harness's own `global-setup.ts` and demo-import fixture both
  note they'd prefer WP-CLI-based seeding where available.
- The site under test already has the ThemeGrill "Main" demo imported —
  **this is not default theme behaviour**, it's the environment given to
  this session, chosen because it's the most common demo real users
  import. Any behaviour above observed only on this imported-demo state
  is flagged as such.
- A pre-existing, uncommitted Playwright E2E suite (`tests/e2e/`,
  TypeScript, pnpm-based) already existed on this branch before this
  session, referencing a QA ledger of prior findings (the audit reports in
  the Local site root). This session extended it rather than starting a
  parallel suite — see the suite's own README and this QA session's
  report for what was added and why.
