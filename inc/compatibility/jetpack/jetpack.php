<?php
/**
 * Jetpack Compatibility File.
 *
 * @link       https://jetpack.me/
 *
 * @package    ThemeGrill
 * @subpackage Colormag
 * @since      Colormag 1.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Jetpack setup function.
 *
 * See: https://jetpack.me/support/infinite-scroll/
 * See: https://jetpack.me/support/responsive-videos/
 */
function colormag_jetpack_setup() {

	// Add theme support for Infinite Scroll.
	add_theme_support(
		'infinite-scroll',
		array(
			'container' => 'content',
			'render'    => 'colormag_infinite_scroll_render',
			'footer'    => 'page',
			'wrapper'   => false,
		)
	);

	// Add theme support for Responsive Videos.
	add_theme_support( 'jetpack-responsive-videos' );

}

add_action( 'after_setup_theme', 'colormag_jetpack_setup' );

if ( ! function_exists( 'colormag_infinite_scroll_render' ) ) :

	/**
	 * Custom render function for Infinite Scroll.
	 */
	function colormag_infinite_scroll_render() {
		while ( have_posts() ) {
			the_post();

			if ( is_search() ) :
				get_template_part( 'template-parts/content', 'archive' );
			else :
				get_template_part( 'template-parts/content', '' );
			endif;
		}
	}

endif;

/**
 * Enables Jetpack's Infinite Scroll in search pages, archive pages and blog pages and disables it in WooCommerce
 * product archive pages.
 *
 * @return bool
 */
function colormag_jetpack_infinite_scroll_supported() {
	return current_theme_supports( 'infinite-scroll' ) && ( is_home() || is_archive() || is_search() ) && ! ( is_post_type_archive( 'product' ) || is_tax( 'product_cat' ) || is_tax( 'product_tag' ) );
}

add_filter( 'infinite_scroll_archive_supported', 'colormag_jetpack_infinite_scroll_supported' );
