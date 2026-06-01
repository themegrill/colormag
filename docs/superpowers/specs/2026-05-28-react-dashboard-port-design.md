# Design: Port ColorMag Pro React Dashboard to ColorMag Free

**Date:** 2026-05-28
**Status:** Approved

## Goal

Replace the ColorMag free theme's PHP/jQuery admin dashboard with the React/TypeScript dashboard from ColorMag Pro. Exclude Pro-only screens: License and Settings (white-label).

## Screens Included

| Screen | Route | Included |
|---|---|---|
| Dashboard | `/` | Yes |
| Starter Templates | `/demo-importer` or external | Yes |
| Products | `/products` | Yes |
| Free vs Pro | `/free-vs-pro` | Yes |
| Help | `/help` | Yes |
| Settings (white-label) | `/settings` | **No — Pro only** |
| License (Freemius) | `/license` | **No — Pro only** |

## Architecture

### Frontend

**Entry:** `src/dashboard/index.tsx` → `App.tsx` → `HashRouter` → `Router.tsx`

**State:** `@wordpress/data` Redux store (`colormag/dashboard`) — tracks plugin/theme install status.

**Data source:** `window._COLORMAG_DASHBOARD_` localized by PHP on page load.

**Routing:** React Router v7 `HashRouter`. Active tab highlighted by syncing `pathname` to WP submenu DOM.

**Changelog:** Fetched via REST `colormag/v1/changelog` → rendered in slide-over drawer in `Header.tsx`.

### PHP

**Menu:** `ColorMag_Dashboard` singleton — top-level WP menu, React mount point `<div id="render_dashboard_page">`.

**Assets:** `ColorMag_Admin::enqueue_scripts()` — loads `assets/build/dashboard.js` + `dashboard.css` only on dashboard screens.

**REST:** `Colormag_Changelog_Controller` — `GET colormag/v1/changelog` parses `changelog.txt`, requires `manage_options`.

**Localized data (`_COLORMAG_DASHBOARD_`):**
```
version, plugins{}, builder, demoUrl,
demoImporter ('active'|'inactive' — binary, not three-state),
customizerUrl, dashboardLogo(''), enableWhiteLabel(false),
themeName('ColorMag'), adminUrl, themes{}, nonce, ajaxUrl
```
No Freemius (`fs`), no white-label settings, no userRoles, no googleFonts, no popupEditUrl.

**Localized data (`__COLORMAG_SETTINGS__`):** Always `{}` — satisfies type import in utils.ts without white-label data.

## File Changes

### Copy from Pro → Free (src/dashboard/)

Copy entire `src/dashboard/` directory from Pro, with these exclusions and modifications:

**Excluded (not copied):**
- `screens/license/` — Pro only
- `screens/settings/` — Pro only (white-label)
- `components/menubar.tsx` — unused by kept screens; requires Radix UI deps not otherwise needed

**Modified after copy:**

| File | Change |
|---|---|
| `router/Router.tsx` | Remove `<Route path="/settings">` and `<Route path="/license">` |
| `constants/index.tsx` | Remove `/settings` and `/license` from ROUTES; remove white-label conditionals; all included routes always enabled except Starter Templates (conditional on TDI status) |
| `utils/utils.ts` | Remove `__COLORMAG_SETTINGS__` localized export; keep only `cn()` helper |
| `components/Header.tsx` | Remove shift+click white-label reset logic (useForm, onSubmit, handleShiftClick) |
| `screens/index.ts` | Remove Settings + License exports |

### PHP Changes (inc/admin/)

| File | Action | Reason |
|---|---|---|
| `class-colormag-admin.php` | Rewrite | Add dashboard.js enqueue, REST route registration, localize `_COLORMAG_DASHBOARD_`. Remove Freemius. |
| `class-colormag-dashboard.php` | Rewrite | React mount point markup; Pro's menu structure |
| `class-colormag-changelog-controller.php` | Copy from Pro | REST endpoint for changelog; replaces PHP-only parser |
| `class-colormag-changelog-parser.php` | Delete | Superseded by REST controller |
| `class-colormag-welcome-notice.php` | Keep | First-run notice; unrelated to dashboard UI; Pro also has it |
| `class-colormag-theme-review-notice.php` | Keep | Unrelated to dashboard UI |
| `views/` folder | Delete | PHP templates replaced by React |

### Build Config

| File | Action |
|---|---|
| `webpack.config.js` | Create — dual entry: `src/meta/meta.tsx` + `src/dashboard/index.tsx` → `assets/build/` |
| `package.json` | Add `clsx` dependency |
| `tailwind.config.js` | Add `src/dashboard/**/*.{tsx,ts}` to content paths |

### functions.php

One change only:
```php
// Remove:
require .../class-colormag-changelog-parser.php
// Add:
require .../class-colormag-changelog-controller.php
```

All other requires unchanged (`class-colormag-welcome-notice.php`, `class-colormag-theme-review-notice.php`, etc.).

## Constants ROUTES (simplified for free)

```ts
export const ROUTES = [
  { route: '/dashboard',     label: 'Dashboard',         enable: true },
  {
    href: localized.adminUrl + 'admin.php?page=colormag-starter-templates&browse=all',
    label: 'Starter Templates',
    enable: localized.demoImporter === 'active',
  },
  {
    route: '/demo-importer',
    label: 'Starter Templates',
    enable: localized.demoImporter === 'inactive',
  },
  { route: '/products',      label: 'Products',          enable: true },
  { route: '/free-vs-pro',   label: 'Free Vs Pro',       enable: true },
  { route: '/help',          label: 'Help',              enable: true },
];
```

## Dependencies

Added to free theme:
- `clsx` — used by `utils/utils.ts` for `cn()` class merging

Not needed (were only used by excluded screens/components):
- `@chakra-ui/react` — Settings only
- `@radix-ui/react-navigation-menu` — menubar.tsx only
- `class-variance-authority` — menubar.tsx only
- `lucide-react` — menubar.tsx only
- `react-toastify` — Settings/License only
- `zod` — Settings/License only
- `mask-sensitive-data` — License only

## Build & Deploy

```bash
pnpm install        # pick up clsx
pnpm build          # outputs assets/build/dashboard.js + dashboard.css
```

PHP enqueue reads `assets/build/dashboard.asset.php` for versioned dependencies — auto-generated by `@wordpress/scripts`.

## Out of Scope

- Freemius license management
- White-label / Settings tab
- Migrating meta sidebar (`src/meta/`) — already exists in free, unchanged
