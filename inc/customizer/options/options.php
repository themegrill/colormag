<?php
$enable_builder = get_theme_mod( 'colormag_enable_builder', false );

require __DIR__ . '/global/colors.php';
require __DIR__ . '/global/category-colors.php';
require __DIR__ . '/global/layout.php';
//require __DIR__ . '/global/sidebar.php';
require __DIR__ . '/global/button.php';
require __DIR__ . '/global/typography.php';
require __DIR__ . '/front-page/front-page.php';
require __DIR__ . '/header-and-navigation/header-media.php';
require __DIR__ . '/header-and-navigation/sticky-header.php';
require __DIR__ . '/additional/breadcrumb.php';
require __DIR__ . '/content/blog.php';
require __DIR__ . '/content/single-page.php';
require __DIR__ . '/content/single-post.php';
require __DIR__ . '/woocommerce/woocommerce.php';

if ( $enable_builder || colormag_maybe_enable_builder() ) {
	require __DIR__ . '/header-builder/header-builder.php';
	require __DIR__ . '/header-builder/top-area.php';
	require __DIR__ . '/header-builder/main-area.php';
	require __DIR__ . '/header-builder/bottom-area.php';
	require __DIR__ . '/header-builder/mobile-menu.php';
	require __DIR__ . '/header-builder/header-button.php';
	require __DIR__ . '/header-builder/html-1.php';
	require __DIR__ . '/header-builder/primary-menu.php';
	require __DIR__ . '/header-builder/secondary-menu.php';
	require __DIR__ . '/header-builder/random.php';
	require __DIR__ . '/header-builder/home-icon.php';
	require __DIR__ . '/header-builder/offset-area.php';
	require __DIR__ . '/header-builder/search.php';
	require __DIR__ . '/header-builder/socials.php';
	require __DIR__ . '/header-builder/toggle-button.php';
	require __DIR__ . '/header-builder/widget-1.php';
	require __DIR__ . '/header-builder/widget-2.php';
	require __DIR__ . '/header-builder/logo.php';
	require __DIR__ . '/header-builder/date.php';
	require __DIR__ . '/header-builder/news-ticker.php';
	require __DIR__ . '/footer-builder/top-area.php';
	require __DIR__ . '/footer-builder/main-area.php';
	require __DIR__ . '/footer-builder/bottom-area.php';
	require __DIR__ . '/footer-builder/copyright.php';
	require __DIR__ . '/footer-builder/footer-menu.php';
	require __DIR__ . '/footer-builder/html-1.php';
	require __DIR__ . '/footer-builder/widget-1.php';
	require __DIR__ . '/footer-builder/widget-2.php';
	require __DIR__ . '/footer-builder/widget-3.php';
	require __DIR__ . '/footer-builder/widget-4.php';
	require __DIR__ . '/footer-builder/widget-5.php';
	require __DIR__ . '/footer-builder/widget-6.php';
	require __DIR__ . '/footer-builder/widget-7.php';
	require __DIR__ . '/footer-builder/socials.php';
	require __DIR__ . '/footer-builder/footer-builder.php';
} else {
	require __DIR__ . '/global/builder.php';
	require __DIR__ . '/header-and-navigation/primary-menu.php';
	require __DIR__ . '/header-and-navigation/header-action.php';
	require __DIR__ . '/header-and-navigation/site-identity.php';
	require __DIR__ . '/header-and-navigation/main-header.php';
	require __DIR__ . '/header-and-navigation/top-bar.php';
	require __DIR__ . '/header-and-navigation/news-ticker.php';
	require __DIR__ . '/footer/footer-column.php';
	require __DIR__ . '/footer/footer-bar.php';
	require __DIR__ . '/additional/social-icons.php';
}
