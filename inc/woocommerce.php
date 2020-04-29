<?php
/**
 * WooCommerce Compatibility File.
 *
 * @package    ThemeGrill
 * @subpackage Colormag
 * @since      Colormag 2.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * WooCommerce setup function.
 *
 * @link https://docs.woocommerce.com/document/third-party-custom-theme-compatibility/
 * @link https://github.com/woocommerce/woocommerce/wiki/Enabling-product-gallery-features-(zoom,-swipe,-lightbox)
 * @link https://github.com/woocommerce/woocommerce/wiki/Declaring-WooCommerce-support-in-themes
 *
 * @return void
 */
function colormag_woocommerce_setup() {

	// Adding the WooCommerce plugin support.
	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );

}

add_action( 'after_setup_theme', 'colormag_woocommerce_setup' );

/**
 * Remove default WooCommerce wrapper.
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

// Remove default WooCommerce breadcrumb.
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );

// Remove WooCommerce default sidebar.
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );

// Disable the page title display for WooCommerce pages.
add_filter( 'woocommerce_show_page_title', '__return_false' );

/**
 * Before Content.
 *
 * Wraps all WooCommerce content in wrappers which match the theme markup.
 *
 * @return void
 */
function colormag_wrapper_start() {
	echo '<div id="primary">';
}

add_action( 'woocommerce_before_main_content', 'colormag_wrapper_start', 10 );

/**
 * After Content.
 *
 * Closes the wrapping divs.
 *
 * @return void
 */
function colormag_wrapper_end() {
	echo '</div>';

	colormag_sidebar_select();
}

add_action( 'woocommerce_after_main_content', 'colormag_wrapper_end', 10 );
