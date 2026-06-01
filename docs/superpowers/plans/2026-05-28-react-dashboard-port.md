# React Dashboard Port (Pro → Free) Implementation Plan

> **For agentic workers:** REQUIRED SUB-SKILL: Use superpowers:subagent-driven-development (recommended) or superpowers:executing-plans to implement this plan task-by-task. Steps use checkbox (`- [ ]`) syntax for tracking.

**Goal:** Replace the ColorMag free theme's PHP/jQuery admin dashboard with the React/TypeScript dashboard from ColorMag Pro, excluding the License and Settings (white-label) screens.

**Architecture:** Copy `src/dashboard/` from Pro to Free verbatim, modify 5 files to remove Pro-only screens and white-label logic, rewrite PHP admin files to register REST routes and enqueue the built React bundle, delete old PHP view templates.

**Tech Stack:** React 19, TypeScript, TailwindCSS, react-query v3, react-router-dom v7, @wordpress/data, @wordpress/scripts (webpack), PHP REST API

---

## File Map

### New files (created in Free)
| File | Source | Notes |
|---|---|---|
| `src/dashboard/index.tsx` | copy Pro | entry point |
| `src/dashboard/App.tsx` | copy Pro | root component |
| `src/dashboard/dashboard.scss` | copy Pro | Tailwind directives |
| `src/dashboard/store/index.ts` | copy Pro | Redux store |
| `src/dashboard/utils/global.ts` | copy Pro | window._COLORMAG_DASHBOARD_ |
| `src/dashboard/hook/create-storage.ts` | copy Pro | localStorage factory |
| `src/dashboard/hook/useDisclosure.ts` | copy Pro | open/close state |
| `src/dashboard/hook/useLocalStorage.ts` | copy Pro | localStorage hook |
| `src/dashboard/hook/usePluginInstallActivate.ts` | copy Pro | plugin install/activate |
| `src/dashboard/icons/icons.js` | copy Pro | SVG exports |
| `src/dashboard/images/` | copy Pro | all images |
| `src/dashboard/components/Changelog.tsx` | copy Pro | changelog drawer |
| `src/dashboard/components/ChangelogSkeleton.tsx` | copy Pro | loading skeleton |
| `src/dashboard/components/UsefulPlugins.tsx` | copy Pro | plugin cards |
| `src/dashboard/screens/dashboard/Dashboard.tsx` | copy Pro | main screen |
| `src/dashboard/screens/free-vs-pro/FreeVsPro.tsx` | copy Pro | comparison table |
| `src/dashboard/screens/help/Help.tsx` | copy Pro | help screen |
| `src/dashboard/screens/products/Products.tsx` | copy Pro | products screen |
| `src/dashboard/screens/starter-template/StarterTemplate.tsx` | copy Pro | TDI install screen |
| `inc/admin/views/header.php` | copy Pro | TDI submenu header |
| `inc/admin/class-colormag-changelog-controller.php` | copy Pro | REST changelog endpoint |
| `webpack.config.js` | new | dual entry build config |

### Modified files (Free)
| File | Change |
|---|---|
| `package.json` | add `clsx` dependency |
| `src/dashboard/types/index.ts` | simplify `colormagLocalized` type (remove Pro-only fields) |
| `src/dashboard/utils/utils.ts` | all-optional `localized` + `?? {}` fallback; keep `cn()` |
| `src/dashboard/constants/index.tsx` | remove License/Settings from ROUTES; drop white-label conditionals |
| `src/dashboard/router/Router.tsx` | remove License + Settings routes |
| `src/dashboard/screens/index.ts` | remove Settings + License exports |
| `src/dashboard/components/Header.tsx` | remove shift+click white-label reset |
| `inc/admin/class-colormag-admin.php` | rewrite: enqueue dashboard.js, localize data, register changelog REST |
| `inc/admin/class-colormag-dashboard.php` | rewrite: React mount point, Pro menu structure |
| `functions.php` | swap changelog-parser require for changelog-controller |

### Deleted files (Free)
- `inc/admin/class-colormag-changelog-parser.php`
- `inc/admin/views/dashbaord.php`
- `inc/admin/views/free-vs-pro.php`
- `inc/admin/views/help.php`
- `inc/admin/views/products.php`
- `inc/admin/views/starter-templates.php`

---

## Task 1: Build Infrastructure

**Files:**
- Modify: `package.json`
- Create: `webpack.config.js`

- [ ] **Step 1: Add `clsx` to package.json**

In `c:\laragon\www\one\wp-content\themes\colormag\package.json`, add to `dependencies`:
```json
"clsx": "^2.1.1"
```

Final dependencies block:
```json
"dependencies": {
  "clsx": "^2.1.1",
  "gulp-rename": "^2.0.0",
  "gulp-uglify-es": "^3.0.0",
  "react": "^19.0.0",
  "react-dom": "^19.0.0",
  "react-hook-form": "^7.54.2",
  "react-query": "^3.39.3",
  "react-router-dom": "^7.4.0"
}
```

- [ ] **Step 2: Create webpack.config.js**

Create `c:\laragon\www\one\wp-content\themes\colormag\webpack.config.js`:
```js
const defaults = require('@wordpress/scripts/config/webpack.config');
const { resolve } = require('path');
const ForkTsCheckerPlugin = require('fork-ts-checker-webpack-plugin');

module.exports = {
	...defaults,
	output: {
		filename: '[name].js',
		path: resolve(process.cwd(), 'assets/build'),
	},
	entry: {
		meta: resolve(process.cwd(), 'src/meta', 'meta.tsx'),
		dashboard: resolve(process.cwd(), 'src/dashboard', 'index.tsx'),
	},
	plugins: [...defaults.plugins, new ForkTsCheckerPlugin()],
};
```

> Note: `tailwind.config.js` already has `content: ['./src/**/*.{ts,tsx}']` — no change needed.

---

## Task 2: Copy Foundation TypeScript Files (Verbatim)

**Files:** All are direct copies — no modification.

- [ ] **Step 1: Create directory structure**

Run in `c:\laragon\www\one\wp-content\themes\colormag`:
```powershell
New-Item -ItemType Directory -Force src\dashboard\router
New-Item -ItemType Directory -Force src\dashboard\store
New-Item -ItemType Directory -Force src\dashboard\types
New-Item -ItemType Directory -Force src\dashboard\utils
New-Item -ItemType Directory -Force src\dashboard\hook
New-Item -ItemType Directory -Force src\dashboard\icons
New-Item -ItemType Directory -Force src\dashboard\images
New-Item -ItemType Directory -Force src\dashboard\components
New-Item -ItemType Directory -Force src\dashboard\screens\dashboard
New-Item -ItemType Directory -Force src\dashboard\screens\free-vs-pro
New-Item -ItemType Directory -Force src\dashboard\screens\help
New-Item -ItemType Directory -Force src\dashboard\screens\products
New-Item -ItemType Directory -Force "src\dashboard\screens\starter-template"
```

- [ ] **Step 2: Copy verbatim foundation files**

```powershell
$pro = "c:\laragon\www\one\wp-content\themes\colormag-pro\src\dashboard"
$free = "c:\laragon\www\one\wp-content\themes\colormag\src\dashboard"

Copy-Item "$pro\index.tsx"        "$free\index.tsx"
Copy-Item "$pro\App.tsx"          "$free\App.tsx"
Copy-Item "$pro\dashboard.scss"   "$free\dashboard.scss"
Copy-Item "$pro\store\index.ts"   "$free\store\index.ts"
Copy-Item "$pro\utils\global.ts"  "$free\utils\global.ts"
Copy-Item "$pro\hook\create-storage.ts"           "$free\hook\create-storage.ts"
Copy-Item "$pro\hook\useDisclosure.ts"            "$free\hook\useDisclosure.ts"
Copy-Item "$pro\hook\useLocalStorage.ts"          "$free\hook\useLocalStorage.ts"
Copy-Item "$pro\hook\usePluginInstallActivate.ts" "$free\hook\usePluginInstallActivate.ts"
Copy-Item "$pro\icons\icons.js"   "$free\icons\icons.js"
```

- [ ] **Step 3: Copy verbatim components**

```powershell
$pro = "c:\laragon\www\one\wp-content\themes\colormag-pro\src\dashboard"
$free = "c:\laragon\www\one\wp-content\themes\colormag\src\dashboard"

Copy-Item "$pro\components\Changelog.tsx"         "$free\components\Changelog.tsx"
Copy-Item "$pro\components\ChangelogSkeleton.tsx" "$free\components\ChangelogSkeleton.tsx"
Copy-Item "$pro\components\UsefulPlugins.tsx"     "$free\components\UsefulPlugins.tsx"
```

- [ ] **Step 4: Copy verbatim screens**

```powershell
$pro = "c:\laragon\www\one\wp-content\themes\colormag-pro\src\dashboard"
$free = "c:\laragon\www\one\wp-content\themes\colormag\src\dashboard"

Copy-Item "$pro\screens\dashboard\Dashboard.tsx"              "$free\screens\dashboard\Dashboard.tsx"
Copy-Item "$pro\screens\free-vs-pro\FreeVsPro.tsx"            "$free\screens\free-vs-pro\FreeVsPro.tsx"
Copy-Item "$pro\screens\help\Help.tsx"                        "$free\screens\help\Help.tsx"
Copy-Item "$pro\screens\products\Products.tsx"                "$free\screens\products\Products.tsx"
Copy-Item "$pro\screens\starter-template\StarterTemplate.tsx" "$free\screens\starter-template\StarterTemplate.tsx"
```

---

## Task 3: Copy Images

**Files:** `src/dashboard/images/` — all image assets.

- [ ] **Step 1: Copy all dashboard images**

```powershell
$pro = "c:\laragon\www\one\wp-content\themes\colormag-pro\src\dashboard\images"
$free = "c:\laragon\www\one\wp-content\themes\colormag\src\dashboard\images"

Copy-Item "$pro\*" "$free\" -Recurse -Force
```

Expected files after copy: `announcement.gif`, `blockart-blocks.webp`, `changelog-announcement.gif`, `cm-logo.png`, `cm-premium.png`, `cm-starter-templates.png`, `colormag.webp`, `evf.webp`, `facebook.webp`, `magazine-blocks.webp`, `masteriyo.webp`, `notification-button.gif`, `starter-templates-background.jpg`, `ur.webp`, `x.webp`, `youtube.webp`, `zakra-logo-square.png`, `zakra-logo.svg`, `zakra-welcome-banner.png`, `zakra.webp`

---

## Task 4: Write Modified TypeScript Files

**Files:** 6 files need changes before use in Free.

- [ ] **Step 1: Write `src/dashboard/types/index.ts`**

Create `c:\laragon\www\one\wp-content\themes\colormag\src\dashboard\types\index.ts`:
```typescript
export type Prettify<T> = {
	[K in keyof T]: T[K];
} & {};

export type colormagLocalized = {
	version: string;
	plugins: {
		'everest-forms/everest-forms.php': 'active' | 'inactive' | 'not-installed';
		'user-registration/user-registration.php':
			| 'active'
			| 'inactive'
			| 'not-installed';
		'learning-management-system/lms.php':
			| 'active'
			| 'inactive'
			| 'not-installed';
		'magazine-blocks/magazine-blocks.php':
			| 'active'
			| 'inactive'
			| 'not-installed';
		'themegrill-demo-importer/themegrill-demo-importer.php':
			| 'active'
			| 'inactive'
			| 'not-installed';
	};
	builder: boolean;
	demoUrl: string;
	demoImporter: 'active' | 'inactive';
	customizerUrl: string;
	dashboardLogo: string;
	enableWhiteLabel: boolean;
	themeName: string;
	adminUrl: string;
	themes: {
		zakra: 'active' | 'inactive' | 'not-installed';
		colormag: 'active' | 'inactive' | 'not-installed';
	};
	nonce: string;
	ajaxUrl: string;
};

export type ChangelogsMap = Array<{
	version: string;
	date: string;
	changes: {
		[key: string]: Array<string>;
	};
}>;
```

- [ ] **Step 2: Write `src/dashboard/utils/utils.ts`**

Create `c:\laragon\www\one\wp-content\themes\colormag\src\dashboard\utils\utils.ts`:
```typescript
import { ClassValue, clsx } from 'clsx';

export function cn(...inputs: ClassValue[]) {
	return clsx(inputs);
}

// All properties optional — PHP localizes {} for free theme.
// Dashboard.tsx checks !colormagLocalized.hide_* — undefined is falsy, so all sections show.
const localized: {
	enable_white_label?: boolean;
	hide_white_label?: boolean;
	hide_starter_templates?: boolean;
	hide_products_tab?: boolean;
	hide_helps_tab?: boolean;
	hide_license_tab?: boolean;
	hide_documentation?: boolean;
	hide_review_section?: boolean;
	hide_feature_section?: boolean;
	hide_support_section?: boolean;
	hide_user_ful_section?: boolean;
	hide_community_section?: boolean;
	hide_starter_template_section?: boolean;
	agency_name?: string;
	agency_url?: string;
	theme_description?: string;
	theme_name?: string;
	theme_screenshot?: string;
	theme_icon?: string;
	dashboard_icon?: string;
} = (window as any).__COLORMAG_SETTINGS__ ?? {};

export { localized };
```

- [ ] **Step 3: Write `src/dashboard/constants/index.tsx`**

Create `c:\laragon\www\one\wp-content\themes\colormag\src\dashboard\constants\index.tsx`:

```typescript
import { __ } from '@wordpress/i18n';
import {
	Blog,
	Colors,
	crossMark,
	everestForm,
	footerColumn,
	magazineBlocks,
	mainHeader,
	masteriyo,
	Sidebar,
	siteIdentity,
	tickMark,
	userRegistration,
} from '../icons/icons';
import colormag_img from '../images/colormag.webp';
import evf_img from '../images/evf.webp';
import magazine_blocks_img from '../images/magazine-blocks.webp';
import masteriyo_img from '../images/masteriyo.webp';
import ur_img from '../images/ur.webp';
import zakra_img from '../images/zakra.webp';
import { localized } from '../utils/global';

export const ROUTES = [
	{
		route: '/dashboard',
		label: __('Dashboard', 'colormag'),
		enable: true,
	},
	{
		href:
			localized.adminUrl +
			'admin.php?page=colormag-starter-templates&browse=all',
		label: __('Starter Templates', 'colormag'),
		enable: localized.demoImporter === 'active',
	},
	{
		route: '/demo-importer',
		label: __('Starter Templates', 'colormag'),
		enable: localized.demoImporter === 'inactive',
	},
	{
		route: '/products',
		label: __('Products', 'colormag'),
		enable: true,
	},
	{
		route: '/free-vs-pro',
		label: __('Free Vs Pro', 'colormag'),
		enable: true,
	},
	{
		route: '/help',
		label: __('Help', 'colormag'),
		enable: true,
	},
] as Array<
	| {
			route: string;
			label: string;
			href?: never;
			enable?: boolean;
			class?: string;
	  }
	| {
			route?: never;
			label: string;
			href: string;
			enable?: boolean;
			class?: string;
	  }
>;

export const QUICK_SETTINGS = [
	{
		title: __('Site Identity', 'colormag'),
		id: localized.builder ? 'colormag_header_builder_logo' : 'title_tagline',
		icon: siteIdentity,
	},
	{
		title: __('Main Header', 'colormag'),
		id: localized.builder
			? 'colormag_header_builder_main_area'
			: 'colormag_main_header',
		icon: mainHeader,
	},
	{
		title: __('Footer Column', 'colormag'),
		id: localized.builder
			? 'colormag_footer_builder_main_area'
			: 'colormag_footer_column',
		icon: footerColumn,
	},
	{
		title: __('Global Colors', 'colormag'),
		id: 'colormag_global_colors_section',
		icon: Colors,
	},
	{
		title: __('Sidebar', 'colormag'),
		id: 'colormag_global_sidebar_section',
		icon: Sidebar,
	},
	{
		title: __('Blog', 'colormag'),
		id: 'colormag_blog_archive_section',
		icon: Blog,
	},
];

export const PREMIUM = [
	{
		title: __('Top Bar', 'colormag'),
		link: 'https://docs.themegrill.com/colormag/docs/customize-top-bar/',
	},
	{
		title: __('Main Header', 'colormag'),
		link: 'https://docs.themegrill.com/colormag/docs/manage-main-header-layout-and-styles/',
	},
	{
		title: __('Primary Menu', 'colormag'),
		link: 'https://docs.themegrill.com/colormag/docs/customize-the-primary-menu-of-the-site/',
	},
	{
		title: __('Blog', 'colormag'),
		link: 'https://docs.themegrill.com/colormag/docs/manage-blog-page-layout/',
	},
	{
		title: __('Sticky Header', 'colormag'),
		link: 'https://docs.themegrill.com/colormag/docs/customize-sticky-header/',
	},
	{
		title: __('Meta', 'colormag'),
		link: 'https://docs.themegrill.com/colormag/docs/customize-the-post-meta/',
	},
	{
		title: __('Footer Column', 'colormag'),
		link: 'https://docs.themegrill.com/colormag/docs/customize-footer-column/',
	},
	{
		title: __('Global Heading Color', 'colormag'),
		link: 'https://docs.themegrill.com/colormag/docs/manage-headings-color/',
	},
	{
		title: __('Global Typography', 'colormag'),
		link: 'https://docs.themegrill.com/colormag/docs/customize-the-typography-of-the-site/',
	},
];

export const THEME_PRODUCTS = [
	{
		title: __('Zakra', 'colormag'),
		icon: zakra_img,
		learn_more: 'https://zakratheme.com/',
		live_demo: 'https://zakratheme.com/demos/',
		desc: __(
			'Multipurpose WordPress theme loaded with intuitive features, powerful customization options, and pre-built demos to create professional websites of any kind.',
			'zakra',
		),
	},
	{
		title: __('ColorMag', 'colormag'),
		icon: colormag_img,
		learn_more: 'https://themegrill.com/themes/colormag/',
		live_demo: 'https://themegrilldemos.com/colormag-demos/',
		desc: __(
			'Modern and professional WordPress magazine and news portal-styled theme perfect for creating websites for your user-engaging magazines, news channels, etc.',
			'colormag',
		),
	},
];

export const features = {
	'General Features': {
		showFreePro: true,
		items: [
			['Premium Support', crossMark, tickMark],
			['Spacing (Margin and Padding)', 'Limited', tickMark],
			['Hook For Developers', tickMark, tickMark],
			['WooCommerce Compatible', tickMark, tickMark],
			['Page Builder Support', tickMark, tickMark],
			['Gutenberg Compatible', tickMark, tickMark],
			['Dynamic Customizable Areas (Menu, Widget, Text/HTML)', '4', '6'],
			['Widgets Area (Sidebar)', '12', '14'],
			['Load Google Font Locally', tickMark, tickMark],
		],
	},
	'Header Features': {
		showFreePro: true,
		items: [
			['Sticky Header', crossMark, tickMark],
			['Transparent Header', crossMark, tickMark],
			['Header Buttons', '1', '2'],
			[
				'Customizable Header Top Bar (Menu, Widget, Text/HTML)',
				tickMark,
				tickMark,
			],
			['Header Top Bar Layouts and Styling Options', 'Limited', tickMark],
			['Header Top bar (Full Width)', crossMark, tickMark],
			['Header Top bar (Responsive Visibility)', crossMark, tickMark],
			['Header Main Area Layouts', '4', '13'],
			['Header Main Area Mobile Layouts', crossMark, tickMark],
			['Header Main Area (Full Width)', crossMark, tickMark],
			['Header Main Area Styling Options', 'Limited', tickMark],
			['Header Media Position and Visibility', crossMark, tickMark],
			['Mobile Logo and Size', crossMark, tickMark],
			['Mobile Header Button', crossMark, tickMark],
		],
	},
	'Footer Features': {
		showFreePro: true,
		items: [
			['Widget Areas', tickMark, tickMark],
			['Footer Widgets Layouts', 4, 11],
			['Footer Widgets Styling Options', 'Limited', tickMark],
			['Footer Copyright', tickMark, tickMark],
			['Scroll to Top', 'Limited', tickMark],
		],
	},
	WooCommerce: {
		showFreePro: true,
		items: [
			['WooCommerce', tickMark, tickMark],
			['WooCommerce Elements Styling', tickMark, tickMark],
			['Related Products', crossMark, tickMark],
			['Dedicated Layouts', 'Limited', tickMark],
			['Dedicated Sidebars', 'Limited', tickMark],
			['Widgets Optimized', tickMark, tickMark],
			['Product Catalog', tickMark, tickMark],
			['Shop Filters', crossMark, tickMark],
			['Enable / Disable Add to Cart Checkout Panel', crossMark, tickMark],
			['Product Result Count', crossMark, tickMark],
			['Sales Badge Customization and Styles', crossMark, tickMark],
			['Product Layouts', crossMark, tickMark],
			['Related Products Customization', crossMark, tickMark],
			['Product Image Size Customization', crossMark, tickMark],
			[
				'Enable/Disable Product Elements (Title, Rating etc)',
				crossMark,
				tickMark,
			],
			['Sales Badge Customization and Styles', crossMark, tickMark],
		],
	},
	'Menu Features': {
		showFreePro: true,
		items: [
			['Menu Styling Option', tickMark, tickMark],
			['Dropdown Menu Styling Options', crossMark, tickMark],
			['Mobile Menu Layout and Styling Options', crossMark, tickMark],
		],
	},
	'Container Layout': {
		showFreePro: true,
		items: [
			['Wide', tickMark, tickMark],
			['Boxed', tickMark, tickMark],
			['Separate', tickMark, tickMark],
			['Container, Content and Sidebar width', tickMark, tickMark],
		],
	},
	Blog: {
		showFreePro: true,
		items: [
			['Grid Layout', crossMark, tickMark],
			['Masonry Layout', crossMark, tickMark],
			['Thumbnail Layout (Normal / Alternative)', crossMark, tickMark],
			['Thumbnail Image Size', crossMark, tickMark],
			['Post Styling Options', crossMark, tickMark],
			['Excerpt Length', crossMark, tickMark],
			['Excerpt More Text', crossMark, tickMark],
			['Read More Position', crossMark, tickMark],
			['Read More Layout', 2, 3],
			['Read More Styles', crossMark, tickMark],
			['Post Pagination Styles', crossMark, tickMark],
			['Post Author Bio', crossMark, tickMark],
			['Related Posts', crossMark, tickMark],
			['Meta Layout', crossMark, tickMark],
			['Breadcrumbs and Page Header Options', 'Limited', tickMark],
			['Post Content and Meta Order', tickMark, tickMark],
			['Infinite Scroll Pagination', crossMark, tickMark],
		],
	},
	'Layout (Sidebar)': {
		showFreePro: true,
		items: [
			['Centered (No Sidebar)', tickMark, tickMark],
			['Left Sidebar', tickMark, tickMark],
			['Right Sidebar', tickMark, tickMark],
			['Full Width', tickMark, tickMark],
			['Stretched', crossMark, tickMark],
			['Unique Layout for Page, Archive, Post', tickMark, tickMark],
			[
				'Unique Layout for Category, Tag, 404, Search Page',
				crossMark,
				tickMark,
			],
			['Unique Layout for WooCommerce Pages', 'Limited', tickMark],
		],
	},
	'Global Styling': {
		showFreePro: true,
		items: [
			['Base Colors', tickMark, tickMark],
			['Link Styling', 'Limited', tickMark],
			['Button Styling', 'Limited', tickMark],
			['Site Identity', crossMark, tickMark],
		],
	},
	Typography: {
		showFreePro: true,
		items: [
			['Google Fonts', tickMark, tickMark],
			['Font Weight', tickMark, tickMark],
			['Font Size', tickMark, tickMark],
			['Line Height', tickMark, tickMark],
			['Subsets(s)', tickMark, tickMark],
			['Base Typography', 'Limited', tickMark],
			['Site Title and Tagline Typography', tickMark, tickMark],
			['Primary Menu Typography', tickMark, tickMark],
			['Widgets Typography', 'Limited', tickMark],
			['Headings Tag Typography', tickMark, tickMark],
			['Mobile Menu Typography', crossMark, tickMark],
			['Header Buttons Typography', crossMark, tickMark],
			['Blog Posts Typography', 'Limited', tickMark],
			['Post Meta Typography', crossMark, tickMark],
		],
	},
	'Page Settings': {
		showFreePro: true,
		items: [
			['Layout (Sidebar)', tickMark, tickMark],
			['Custom Sidebar Widgets', tickMark, tickMark],
			['Container, Content and Sidebar Width', tickMark, tickMark],
			['Transparent Header', tickMark, tickMark],
			['Header Main Area Layouts', 'Limited', tickMark],
			['Primary Menu Layouts and Styling Options', 'Limited', tickMark],
			[
				'Page Header / Breadcrumbs Layouts and Styling Options',
				crossMark,
				tickMark,
			],
			['Footer Widgets Area Layouts and Styling Options', crossMark, tickMark],
			['Footer Bottom Bar Layouts and Styling Options', crossMark, tickMark],
		],
	},
};

export const PLUGINS = [
	{
		label: 'Masteriyo',
		slug: 'learning-management-system/lms.php',
		description: __(
			'Streamline the learning process with an easy-to-use and highly advanced LMS plugin loaded with powerful features to create and sell courses online through your website.',
			'colormag',
		),
		type: 'plugin',
		image: masteriyo_img,
		learn_more: 'https://masteriyo.com/',
		live_demo: 'https://themegrilldemos.com/elearning/',
		website: 'https://masteriyo.com/',
		shortDescription: __('Quiz Builder Plugin', 'colormag'),
		logo: masteriyo,
	},
	{
		label: 'User Registration',
		slug: 'user-registration/user-registration.php',
		description: __(
			'Ultimate WordPress user registration plugin to streamline the user signup process. Create registration & login forms, manage users, and more.',
			'colormag',
		),
		type: 'plugin',
		image: ur_img,
		learn_more: 'https://wpuserregistration.com/',
		live_demo: 'https://demo.wpeverest.com/user-registration/',
		website: 'https://wpuserregistration.com/',
		shortDescription: __('Custom Registration Form', 'colormag'),
		logo: userRegistration,
	},
	{
		label: 'Everest Forms',
		slug: 'everest-forms/everest-forms.php',
		description: __(
			'Feature-rich and highly customizable WordPress form builder plugin to create different types of professional forms for your website.',
			'colormag',
		),
		type: 'plugin',
		image: evf_img,
		learn_more: 'https://everestforms.net/',
		live_demo: 'https://demo.wpeverest.com/everest-forms/',
		website: 'https://everestforms.net/',
		shortDescription: __('Form Builder Plugin', 'colormag'),
		logo: everestForm,
	},
	{
		label: 'Magazine Blocks',
		slug: 'magazine-blocks/magazine-blocks.php',
		description: __(
			'Powerful WordPress Gutenberg block plugin with the perfect blocks and editing options to create magazine-themed websites.',
			'colormag',
		),
		type: 'plugin',
		image: magazine_blocks_img,
		learn_more: 'https://wpblockart.com/magazine-blocks/',
		live_demo: 'https://themegrilldemos.com/colormag/',
		website: 'https://wpblockart.com/magazine-blocks/',
		shortDescription: __('Page Builder Plugin', 'colormag'),
		logo: magazineBlocks,
	},
];

export const CHANGELOG_TAG_COLORS = {
	fix: {
		color: 'primary.500',
		bgColor: 'primary.100',
		scheme: 'primary',
	},
	feature: {
		color: 'green.500',
		bgColor: 'green.50',
		scheme: 'green',
	},
	enhancement: {
		color: 'teal.500',
		bgColor: 'teal.50',
		scheme: 'teal',
	},
	added: {
		color: 'pink.500',
		bgColor: 'pink.50',
		scheme: 'pink',
	},
	update: {
		color: 'orange.500',
		bgColor: 'orange.50',
		scheme: 'orange',
	},
	tweak: {
		color: 'purple.500',
		bgColor: 'purple.50',
		scheme: 'purple',
	},
};
```

- [ ] **Step 4: Write `src/dashboard/router/Router.tsx`**

Create `c:\laragon\www\one\wp-content\themes\colormag\src\dashboard\router\Router.tsx`:
```typescript
import React from 'react';
import { Route, Routes, useLocation } from 'react-router-dom';
import { Dashboard, Help, Products } from '../screens';
import FreeVsPro from '../screens/free-vs-pro/FreeVsPro';
import { StarterTemplates } from '../screens/starter-template/StarterTemplate';

const Router: React.FC = () => {
	const { pathname } = useLocation();

	React.useLayoutEffect(() => {
		const submenu = document.querySelector(
			`.wp-submenu a[href="admin.php?page=colormag#${pathname}"]`,
		);
		if (!submenu) return;
		submenu.parentElement?.classList.add('current');
		return () => {
			submenu.parentElement?.classList?.remove('current');
		};
	}, [pathname]);

	return (
		<Routes>
			<Route path="/" element={<Dashboard />} />
			<Route path="/demo-importer" element={<StarterTemplates />} />
			<Route path="/products" element={<Products />} />
			<Route path="/free-vs-pro" element={<FreeVsPro />} />
			<Route path="/help" element={<Help />} />
			<Route path="*" element={<Dashboard />} />
		</Routes>
	);
};

export default Router;
```

- [ ] **Step 5: Write `src/dashboard/screens/index.ts`**

Create `c:\laragon\www\one\wp-content\themes\colormag\src\dashboard\screens\index.ts`:
```typescript
export { default as Dashboard } from './dashboard/Dashboard';
export { default as Help } from './help/Help';
export { default as Products } from './products/Products';
```

> **Note:** Check the actual export style in the copied screen files. If they use named exports (`export const Dashboard`) rather than default exports, use `export { Dashboard } from './dashboard/Dashboard'` instead.

- [ ] **Step 6: Write `src/dashboard/components/Header.tsx`**

Create `c:\laragon\www\one\wp-content\themes\colormag\src\dashboard\components\Header.tsx`:
```typescript
import { __ } from '@wordpress/i18n';
import React, { useState } from 'react';
import { Link, useLocation } from 'react-router-dom';
import { ROUTES } from '../constants';
import announcement from '../images/changelog-announcement.gif';
import logo from '../images/cm-logo.png';
import { localized } from '../utils/global';
import Changelog from './Changelog';

const Header: React.FC = () => {
	const location = useLocation();
	const [isOpen, setIsOpen] = useState(false);

	const toggleDrawer = () => {
		setIsOpen(!isOpen);
	};

	return (
		<>
			<div className="cm-dashboard-header py-3 px-5 bt-1 border-b border-t-0 border-x-0 border-[#E9E9E9] border-solid mb-8 bg-[#FFFFFF]">
				<div className="container mx-auto lg:max-w-screen-xl px-5 box-border flex justify-between">
					<div className="header flex items-center gap-8">
						<div className="header__logo flex items-center">
							<Link to="/dashboard">
								<img
									src={localized.dashboardLogo ? localized.dashboardLogo : logo}
									alt="ColorMag"
									className="w-8 h-8"
								/>
							</Link>
						</div>
						<div className="header__menu">
							<ul className="flex items-center gap-4">
								{ROUTES.map(
									(route) =>
										route.enable && (
											<li
												key={route.route || route.label}
												className={`m-0 text-sm font-semibold ${location.pathname === route.route ? 'active' : ''}`}
											>
												{route.route && (
													<Link
														className="no-underline px-2 text-[#383838] focus:outline-0 hover:text-primary-500 focus:shadow-none"
														to={route.route}
													>
														{route.label}
													</Link>
												)}
												{route.href && (
													<a
														className="no-underline px-2 text-[#383838] focus:outline-0 hover:text-primary-500 focus:shadow-none"
														href={route.href}
													>
														{route.label}
													</a>
												)}
											</li>
										),
								)}
							</ul>
						</div>
					</div>
					<div className="flex gap-4 items-center">
						<span className="border border-solid border-[#27AE60] py-[2px] px-[10px] font-semibold text-[#27AE60] bg-[#F8FAFF] rounded-[12px]">
							{localized.version} {__('Core', 'colormag')}
						</span>
						<button
							type="button"
							onClick={toggleDrawer}
							className="border border-solid border-[#d3d3d366] p-0 bg-transparent rounded-[20px] hover:cursor-pointer"
						>
							<img
								src={announcement}
								alt="announcement"
								className="w-[35px] h-[35px] relative"
							/>
						</button>
					</div>
				</div>
			</div>

			<div className={`drawer ${isOpen ? 'open' : ''}`}>
				<div className="drawer-content z-[99] relative bg-[#FFFFFF]">
					<div className="cm-dialog-head mt-[16px] py-[30px] px-[24px] border-b-[1px] border-t-0 border-x-0 border-solid border-[#E9E9E9]">
						<h3>{__('Latest Updates', 'colormag')}</h3>
						<div id="cm-dialog-close" className="cm-dialog-close">
							<button className="drawer-close" onClick={toggleDrawer}>
								&times;
							</button>
						</div>
					</div>
					<div className="drawer-body overflow-y-auto h-[100vh] p-[20px]">
						<Changelog />
					</div>
				</div>
				{isOpen && (
					<div className="drawer-overlay" onClick={toggleDrawer}></div>
				)}
			</div>
		</>
	);
};

export { Header };
```

---

## Task 5: PHP — Changelog REST Controller

**Files:**
- Copy: `inc/admin/class-colormag-changelog-controller.php` from Pro
- Copy: `inc/admin/views/header.php` from Pro

- [ ] **Step 1: Copy changelog controller**

```powershell
$pro  = "c:\laragon\www\one\wp-content\themes\colormag-pro\inc\admin"
$free = "c:\laragon\www\one\wp-content\themes\colormag\inc\admin"

Copy-Item "$pro\class-colormag-changelog-controller.php" "$free\class-colormag-changelog-controller.php"
```

The controller uses `COLORMAG_PARENT_DIR` — verified this constant is already defined in `inc/base/class-colormag-constants.php` as `get_template_directory()`. No modification needed.

- [ ] **Step 2: Copy views/header.php (needed by render_starter_templates_tab)**

```powershell
$pro  = "c:\laragon\www\one\wp-content\themes\colormag-pro\inc\admin\views"
$free = "c:\laragon\www\one\wp-content\themes\colormag\inc\admin\views"

Copy-Item "$pro\header.php" "$free\header.php"
```

---

## Task 6: PHP — Rewrite Admin Class

**Files:**
- Modify: `inc/admin/class-colormag-admin.php`

- [ ] **Step 1: Rewrite class-colormag-admin.php**

Replace the entire contents of `c:\laragon\www\one\wp-content\themes\colormag\inc\admin\class-colormag-admin.php`:
```php
<?php
/**
 * ColorMag Admin Class.
 *
 * @package ColorMag
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'ColorMag_Admin' ) ) :

	class ColorMag_Admin {

		public function __construct() {
			add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
			add_action( 'rest_api_init', array( $this, 'register_rest_routes' ) );
		}

		public function register_rest_routes() {
			( new Colormag_Changelog_Controller() )->register_routes();
		}

		public function enqueue_scripts() {
			wp_enqueue_style(
				'colormag-admin-style',
				get_template_directory_uri() . '/inc/admin/css/admin.css',
				array(),
				COLORMAG_THEME_VERSION
			);

			wp_enqueue_script(
				'colormag-plugin-install-helper',
				get_template_directory_uri() . '/inc/admin/js/admin.js',
				array( 'jquery' ),
				COLORMAG_THEME_VERSION,
				true
			);

			$welcome_data = array(
				'uri'       => esc_url( admin_url( '/themes.php?page=colormag&tab=starter-templates' ) ),
				'btn_text'  => esc_html__( 'Processing...', 'colormag' ),
				'admin_url' => esc_url( admin_url() ),
			);

			if ( current_user_can( 'manage_options' ) ) {
				$welcome_data['nonce']   = wp_create_nonce( 'colormag_demo_import_nonce' );
				$welcome_data['ajaxurl'] = admin_url( 'admin-ajax.php' );
			}

			wp_localize_script( 'colormag-plugin-install-helper', 'colormagRedirectDemoPage', $welcome_data );

			$screen = get_current_screen();
			if ( ! in_array(
				$screen->id,
				array( 'toplevel_page_colormag', 'appearance_page_colormag' ),
				true
			) ) {
				return;
			}

			$build_dir_uri        = get_template_directory_uri() . '/assets/build/';
			$build_dir_path       = get_template_directory() . '/assets/build/';
			$dashboard_asset_file = $build_dir_path . 'dashboard.asset.php';

			if ( file_exists( $dashboard_asset_file ) ) {
				$dashboard_asset = require $dashboard_asset_file;
				wp_enqueue_script(
					'colormag-dashboard',
					$build_dir_uri . 'dashboard.js',
					$dashboard_asset['dependencies'],
					$dashboard_asset['version'],
					true
				);
				wp_enqueue_style(
					'colormag-dashboard',
					$build_dir_uri . 'dashboard.css',
					array( 'wp-components' ),
					$dashboard_asset['version']
				);
			}

			if ( ! function_exists( 'get_plugins' ) ) {
				require_once ABSPATH . 'wp-admin/includes/plugin.php';
			}
			if ( ! function_exists( 'wp_get_themes' ) ) {
				require_once ABSPATH . 'wp-admin/includes/theme.php';
			}

			$installed_plugin_slugs = array_keys( get_plugins() );
			$allowed_plugin_slugs   = array(
				'everest-forms/everest-forms.php',
				'user-registration/user-registration.php',
				'learning-management-system/lms.php',
				'magazine-blocks/magazine-blocks.php',
				'themegrill-demo-importer/themegrill-demo-importer.php',
			);
			$installed_theme_slugs  = array_keys( wp_get_themes() );
			$current_theme          = get_stylesheet();

			// Settings screen is excluded from free — pass empty object to satisfy JS import.
			wp_localize_script( 'colormag-dashboard', '__COLORMAG_SETTINGS__', array() );

			wp_localize_script(
				'colormag-dashboard',
				'_COLORMAG_DASHBOARD_',
				array(
					'version'          => COLORMAG_THEME_VERSION,
					'plugins'          => array_reduce(
						$allowed_plugin_slugs,
						function ( $acc, $curr ) use ( $installed_plugin_slugs ) {
							if ( in_array( $curr, $installed_plugin_slugs, true ) ) {
								$acc[ $curr ] = is_plugin_active( $curr ) ? 'active' : 'inactive';
							} else {
								$acc[ $curr ] = 'not-installed';
							}
							return $acc;
						},
						array()
					),
					'builder'          => colormag_maybe_enable_builder(),
					'demoUrl'          => admin_url( 'admin.php?page=colormag-starter-templates' ),
					'demoImporter'     => is_plugin_active( 'themegrill-demo-importer/themegrill-demo-importer.php' ) ? 'active' : 'inactive',
					'customizerUrl'    => admin_url( 'customize.php' ),
					'dashboardLogo'    => '',
					'enableWhiteLabel' => false,
					'themeName'        => 'ColorMag',
					'adminUrl'         => admin_url(),
					'themes'           => array(
						'colormag' => strpos( $current_theme, 'colormag' ) !== false ? 'active' : (
							in_array( 'colormag', $installed_theme_slugs, true ) ? 'inactive' : 'not-installed'
						),
						'zakra'    => strpos( $current_theme, 'zakra' ) !== false ? 'active' : (
							in_array( 'zakra', $installed_theme_slugs, true ) ? 'inactive' : 'not-installed'
						),
					),
					'nonce'            => wp_create_nonce( 'colormag_dashboard_nonce' ),
					'ajaxUrl'          => admin_url( 'admin-ajax.php' ),
				)
			);
		}
	}

endif;

return new ColorMag_Admin();
```

---

## Task 7: PHP — Rewrite Dashboard Class

**Files:**
- Modify: `inc/admin/class-colormag-dashboard.php`

- [ ] **Step 1: Rewrite class-colormag-dashboard.php**

Replace the entire contents of `c:\laragon\www\one\wp-content\themes\colormag\inc\admin\class-colormag-dashboard.php`:
```php
<?php
// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

class ColorMag_Dashboard {

	private static $instance;
	private $demo_packages;

	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	private function __construct() {
		$this->setup_hooks();
	}

	private function setup_hooks() {
		add_action( 'in_admin_header', array( $this, 'hide_admin_notices' ) );
		add_action( 'admin_menu', array( $this, 'create_menu_page' ), 11 );
	}

	public function create_menu_page() {
		$icon = 'data:image/svg+xml;base64,' . base64_encode(
			'<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20"><mask id="a" width="19" height="17" x="0" y="1" maskUnits="userSpaceOnUse" style="mask-type:luminance"><path fill="#fff" d="M18.413 1H0v17h18.413V1Z"/></mask><g fill="#F3F1F1" mask="url(#a)"><path d="M17.293 5.53c.196.227.304.498.283.793v6.68a.963.963 0 0 1-.26.723c-.392.363-.977.363-1.346 0-.174-.203-.283-.452-.26-.724v-3.6l-1.347 2.581a1.56 1.56 0 0 1-.434.566.75.75 0 0 1-.52.16.838.838 0 0 1-.522-.16 1.839 1.839 0 0 1-.434-.565l-1.324-2.491v3.51a.974.974 0 0 1-.262.722.867.867 0 0 1-.694.273.912.912 0 0 1-.673-.272 1.043 1.043 0 0 1-.238-.746V6.322a1.063 1.063 0 0 1 .282-.792.988.988 0 0 1 1.302-.113c.174.136.326.339.435.543l2.17 4.234 2.128-4.257c.239-.498.564-.725.999-.725.26 0 .52.114.715.318ZM8.543 11.832a.658.658 0 0 0-.524-.273c-.1.002-.199.016-.295.042-.084.042-.21.084-.378.19-.358.167-.652.293-.883.356a3.858 3.858 0 0 1-.987.126c-.736 0-1.282-.23-1.64-.672-.357-.441-.545-1.093-.545-1.996v-.168H1v.168c-.02.825.167 1.641.546 2.375a3.721 3.721 0 0 0 1.512 1.554 4.61 4.61 0 0 0 2.29.546c1.05 0 2.249-.273 3.026-.82a.765.765 0 0 0 .294-.336.828.828 0 0 0 .084-.441.94.94 0 0 0-.21-.65Z"/><path d="M3.815 7.588c.358-.441.904-.673 1.64-.673.272 0 .524.042.798.105.294.084.567.21.82.379.104.063.23.125.336.189.105.042.21.063.336.063a.657.657 0 0 0 .525-.273 1.05 1.05 0 0 0 .21-.652c0-.147-.02-.315-.084-.44a1.414 1.414 0 0 0-.294-.316 4.754 4.754 0 0 0-2.752-.819 4.555 4.555 0 0 0-2.29.546 3.72 3.72 0 0 0-1.514 1.555 4.923 4.923 0 0 0-.524 2.185H3.29c.02-.82.21-1.43.524-1.85Z"/></g></svg>'
		);

		add_menu_page(
			'colormag',
			'ColorMag',
			'manage_options',
			'colormag',
			array( $this, 'markup' ),
			$icon,
			59
		);

		if ( is_plugin_active( 'themegrill-demo-importer/themegrill-demo-importer.php' ) ) {
			remove_submenu_page( 'themes.php', 'demo-importer' );
			remove_submenu_page( 'themes.php', 'demo-importer-status' );

			add_submenu_page(
				'colormag',
				'Demo Importer',
				'Demo Importer',
				'manage_options',
				'colormag-starter-templates',
				array( $this, 'render_starter_templates_tab' )
			);

			add_submenu_page(
				'colormag',
				'Demo Importer Status',
				'Demo Importer Status',
				'manage_options',
				'demo-importer-status',
				function () {
					include plugin_dir_path( TGDM_PLUGIN_FILE ) . '/includes/admin/views/html-admin-page-status.php';
				}
			);
		}
	}

	public function hide_admin_notices() {
		$_page = sanitize_text_field( $_GET['page'] ?? '' );

		if ( ! in_array( $_page, array( 'colormag', 'colormag-starter-templates' ), true ) ) {
			return;
		}

		global $wp_filter;
		$ignore_notices = apply_filters( 'colormag_ignore_hide_admin_notices', array() );

		foreach ( array( 'user_admin_notices', 'admin_notices', 'all_admin_notices' ) as $wp_notice ) {
			if ( empty( $wp_filter[ $wp_notice ] ) ) {
				continue;
			}

			$hook_callbacks = $wp_filter[ $wp_notice ]->callbacks;

			if ( empty( $hook_callbacks ) || ! is_array( $hook_callbacks ) ) {
				continue;
			}

			foreach ( $hook_callbacks as $priority => $hooks ) {
				foreach ( $hooks as $name => $callback ) {
					if ( ! empty( $name ) && in_array( $name, $ignore_notices, true ) ) {
						continue;
					}
					if (
						! empty( $callback['function'] ) &&
						! is_a( $callback['function'], '\Closure' ) &&
						isset( $callback['function'][0], $callback['function'][1] ) &&
						is_object( $callback['function'][0] ) &&
						in_array( $callback['function'][1], $ignore_notices, true )
					) {
						continue;
					}
					unset( $wp_filter[ $wp_notice ]->callbacks[ $priority ][ $name ] );
				}
			}
		}
	}

	public function markup() {
		echo '<div id="render_dashboard_page" class="colormag"></div>';
	}

	public function render_starter_templates_tab() {
		if ( is_plugin_active( 'themegrill-demo-importer/themegrill-demo-importer.php' ) ) {
			wp_enqueue_style( 'tg-demo-importer' );
			wp_enqueue_script( 'tg-demo-importer' );
			$this->demo_packages = get_transient( 'themegrill_demo_importer_packages' );
			include __DIR__ . '/views/header.php';
		}
	}
}

ColorMag_Dashboard::instance();
```

---

## Task 8: PHP — Update functions.php

**Files:**
- Modify: `functions.php` (line 36)

- [ ] **Step 1: Replace changelog-parser require with changelog-controller**

In `c:\laragon\www\one\wp-content\themes\colormag\functions.php`, find:
```php
require get_template_directory() . '/inc/admin/class-colormag-changelog-parser.php';
```

Replace with:
```php
require get_template_directory() . '/inc/admin/class-colormag-changelog-controller.php';
```

This is outside the `is_admin()` block because `rest_api_init` fires on both admin and front-end REST requests.

---

## Task 9: Delete Obsolete Files

**Files:** Old PHP templates replaced by React.

- [ ] **Step 1: Delete obsolete view files**

```powershell
$views = "c:\laragon\www\one\wp-content\themes\colormag\inc\admin\views"

Remove-Item "$views\dashbaord.php"         -Force
Remove-Item "$views\free-vs-pro.php"       -Force
Remove-Item "$views\help.php"              -Force
Remove-Item "$views\products.php"          -Force
Remove-Item "$views\starter-templates.php" -Force
```

- [ ] **Step 2: Delete old changelog parser**

```powershell
Remove-Item "c:\laragon\www\one\wp-content\themes\colormag\inc\admin\class-colormag-changelog-parser.php" -Force
```

---

## Task 10: Install Dependencies & Build

- [ ] **Step 1: Install dependencies**

Run in `c:\laragon\www\one\wp-content\themes\colormag`:
```powershell
pnpm install
```

Expected: `clsx` installed, lockfile updated.

- [ ] **Step 2: Build the dashboard**

```powershell
pnpm build
```

Expected output: build completes with no errors. Check:
```
assets/build/dashboard.js       ← exists
assets/build/dashboard.css      ← exists
assets/build/dashboard.asset.php ← exists (PHP enqueue reads this for dependencies/version)
```

If TypeScript errors appear, diagnose by error message:
- `Cannot find module 'clsx'` → `pnpm install` didn't run correctly
- `Property X does not exist on type` → check the import in the failing file matches the types defined in Task 4 Step 1
- `Module not found: screens/license` → check Router.tsx doesn't still reference License
- `Export 'Dashboard' not found` → check screens/index.ts export style matches screen file export style (default vs named)

---

## Task 11: Browser Verification

- [ ] **Step 1: Verify dashboard loads**

1. Open WordPress admin → navigate to the ColorMag menu item (top-level, new icon)
2. Verify: React app renders — header with logo, nav tabs (Dashboard, Starter Templates, Products, Free Vs Pro, Help)
3. Verify: No License tab, no Settings tab

- [ ] **Step 2: Verify each tab**

| Tab | Expected |
|---|---|
| Dashboard | Welcome section, Quick Settings grid, Features grid, sidebar with community/docs/review sections |
| Starter Templates | If TDI inactive: install prompt. If TDI active: redirects to TDI interface |
| Products | Theme + plugin cards with Learn More / Live Demo links |
| Free Vs Pro | Feature comparison table with checkmarks |
| Help | Documentation, Support, Community links |

- [ ] **Step 3: Verify changelog drawer**

Click the announcement GIF button in the header → drawer slides in → changelog entries load from REST `colormag/v1/changelog`.

If changelog is empty: check `changelog.txt` exists in free theme root and matches the format `= X.X.X - YYYY-MM-DD =`.

- [ ] **Step 4: Verify welcome notice still works**

Deactivate and reactivate the free theme → the welcome notice banner should still appear in the WP admin (handled by `class-colormag-welcome-notice.php` which is unchanged).

---

## Notes

- **"Pro" badge in Dashboard welcome:** `Dashboard.tsx` shows a "Pro" badge next to the theme name. This is copied as-is. If you want it to say "Free" instead, change `{__('Pro', 'colormag')}` to `{__('Free', 'colormag')}` in `src/dashboard/screens/dashboard/Dashboard.tsx` line 33.
- **screens/index.ts export style:** Verify after copying `Dashboard.tsx`, `Help.tsx`, `Products.tsx` whether they use `export default` or named `export const`. Adjust `screens/index.ts` accordingly.
- **TDI submenu:** The `demo-importer-status` submenu references `TGDM_PLUGIN_FILE` constant — only available when TDI plugin is active, so it's safe (wrapped in the `is_plugin_active()` check).
