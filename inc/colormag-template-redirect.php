<?php
/**
 * ColorMag template redirect hooks.
 *
 * @package    ThemeGrill
 * @subpackage ColorMag
 * @since      ColorMag 1.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 800;
}

/**
 * $content_width global variable adjustment as per layout option.
 */
function colormag_content_width() {

	global $post;
	global $content_width;

	if ( $post ) {
		$layout_meta = get_post_meta( $post->ID, 'colormag_page_layout', true );
	}

	if ( empty( $layout_meta ) || is_archive() || is_search() ) {
		$layout_meta = 'default_layout';
	}

	$colormag_default_layout      = get_theme_mod( 'colormag_default_layout', 'right_sidebar' );
	$colormag_default_page_layout = get_theme_mod( 'colormag_default_page_layout', 'right_sidebar' );
	$colormag_default_post_layout = get_theme_mod( 'colormag_default_single_posts_layout', 'right_sidebar' );

	if ( 'default_layout' === $layout_meta ) {
		if ( 'no_sidebar_full_width' === $colormag_default_layout || 'no_sidebar_full_width' === $colormag_default_page_layout || 'no_sidebar_full_width' === $colormag_default_post_layout ) {
			$content_width = 1140; /* pixels */
		} else {
			$content_width = 800; /* pixels */
		}
	} else {
		if ( 'no_sidebar_full_width' === $layout_meta ) {
			$content_width = 1140; /* pixels */
		} else {
			$content_width = 800; /* pixels */
		}
	}

}

add_action( 'template_redirect', 'colormag_content_width' );
