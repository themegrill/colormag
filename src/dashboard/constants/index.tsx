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
