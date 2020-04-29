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
 * Making the theme Woocommrece compatible
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );

// Remove WooCommerce default sidebar.
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );

// Disable the page title display for WooCommerce pages.
add_filter( 'woocommerce_show_page_title', '__return_false' );

add_action( 'woocommerce_before_main_content', 'colormag_wrapper_start', 10 );
add_action( 'woocommerce_after_main_content', 'colormag_wrapper_end', 10 );

function colormag_wrapper_start() {
	echo '<div id="primary">';
}

function colormag_wrapper_end() {
	echo '</div>';
	colormag_sidebar_select();
}
