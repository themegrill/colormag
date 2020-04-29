<?php
/**
 * Functions which enhance the theme by hooking into WordPress.
 *
 * @package    ThemeGrill
 * @subpackage ColorMag
 * @since      ColorMag 2.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function colormag_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}

add_action( 'wp_head', 'colormag_pingback_header' );


/**
 * Sets the post excerpt length to 20 words.
 *
 * Function tied to the excerpt_length filter hook.
 *
 * @param int $length The excerpt length.
 *
 * @return int The filtered excerpt length.
 * @uses filter excerpt_length
 */
function colormag_excerpt_length( $length ) {
	return 20;
}

add_filter( 'excerpt_length', 'colormag_excerpt_length' );


/**
 * Returns a "Continue Reading" link for excerpts.
 */
function colormag_continue_reading() {
	return '';
}

add_filter( 'excerpt_more', 'colormag_continue_reading' );


/**
 * Removing the default style of WordPress gallery.
 */
add_filter( 'use_default_gallery_style', '__return_false' );

/**
 * Filtering the size to be full from thumbnail to be used in WordPress gallery as a default size.
 *
 * @param array $out   The output array of shortcode attributes.
 * @param array $pairs The supported attributes and their defaults.
 * @param array $atts  The user defined shortcode attributes.
 *
 * @return mixed
 */
function colormag_gallery_atts( $out, $pairs, $atts ) {
	$atts = shortcode_atts(
		array(
			'size' => 'colormag-featured-image',
		),
		$atts
	);

	$out['size'] = $atts['size'];

	return $out;
}

add_filter( 'shortcode_atts_gallery', 'colormag_gallery_atts', 10, 3 );


/**
 * Removing the more link jumping to middle of content.
 *
 * @param string $link Read More link element.
 *
 * @return string|string[]
 */
function colormag_remove_more_jump_link( $link ) {
	$offset = strpos( $link, '#more-' );

	if ( $offset ) {
		$end = strpos( $link, '"', $offset );
	}

	if ( $end ) {
		$link = substr_replace( $link, '', $offset, $end - $offset );
	}

	return $link;
}

add_filter( 'the_content_more_link', 'colormag_remove_more_jump_link' );


/**
 * Creating responsive video for posts/pages.
 *
 * @param string|false $html    The cached HTML result, stored in post meta.
 * @param string       $url     The attempted embed URL.
 * @param array        $attr    An array of shortcode attributes.
 * @param int          $post_ID Post ID.
 *
 * @return string
 */
function colormag_responsive_video( $html, $url, $attr, $post_ID ) {
	return '<div class="fitvids-video">' . $html . '</div>';
}

add_filter( 'embed_oembed_html', 'colormag_responsive_video', 10, 4 );


/**
 * Use of the hooks for Category Color in the archive titles
 *
 * @param string $title Category title.
 *
 * @return string Category page title.
 */
function colormag_colored_category_title( $title ) {

	$output             = '';
	$color_value        = colormag_category_color( get_cat_id( $title ) );
	$color_border_value = colormag_category_color( get_cat_id( $title ) );

	if ( ! empty( $color_value ) ) {
		$output = '<h1 class="page-title" style="border-bottom-color: ' . esc_attr( $color_border_value ) . '"><span style="background-color: ' . esc_attr( $color_value ) . '">' . esc_html( $title ) . '</span></h1>';
	} else {
		$output = '<h1 class="page-title"><span>' . $title . '</span></h1>';
	}

	return $output;

}

/**
 * Filters the single_cat_title.
 *
 * @param string $category_title Category title.
 */
function colormag_category_title_function( $category_title ) {
	add_filter( 'single_cat_title', 'colormag_colored_category_title' );
}

add_action( 'colormag_category_title', 'colormag_category_title_function' );
