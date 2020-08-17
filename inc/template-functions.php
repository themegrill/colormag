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

	if ( ! current_theme_supports( 'responsive-embeds' ) ) {
		return '<div class="fitvids-video">' . $html . '</div>';
	}

	return $html;

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


/**
 * Filter the get_header_image_tag() for option of adding the link back to home page option.
 *
 * @param string $html   The HTML image tag markup being filtered.
 * @param object $header The custom header object returned by 'get_custom_header()'.
 * @param array  $attr   Array of the attributes for the image tag.
 *
 * @return string
 */
function colormag_header_image_markup( $html, $header, $attr ) {

	$output       = '';
	$header_image = get_header_image();

	if ( ! empty( $header_image ) ) {
		$output .= '<div class="header-image-wrap">';

		if ( 1 == get_theme_mod( 'colormag_header_image_link', 0 ) ) {
			$output .= '<a href="' . esc_url( home_url( '/' ) ) . '" title="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '" rel="home">';
		}

		$output .= '<img src="' . esc_url( $header_image ) . '" class="header-image" width="' . absint( get_custom_header()->width ) . '" height="' . absint( get_custom_header()->height ) . '" alt="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '">';

		if ( 1 == get_theme_mod( 'colormag_header_image_link', 0 ) ) {
			$output .= '</a>';
		}

		$output .= '</div>';
	}

	return $output;

}

add_filter( 'get_header_image_tag', 'colormag_header_image_markup', 10, 3 );


/**
 * Filter the body_class.
 *
 * Throwing different body class for the different layouts in the body tag.
 *
 * @param array $classes CSS classes applied to the body tag.
 *
 * @return array Classes for body.
 */
function colormag_body_class( $classes ) {

	global $post;

	if ( $post ) {
		$layout_meta = get_post_meta( $post->ID, 'colormag_page_layout', true );
	}

	if ( is_home() ) {
		$queried_id  = get_option( 'page_for_posts' );
		$layout_meta = get_post_meta( $queried_id, 'colormag_page_layout', true );
	}

	if ( empty( $layout_meta ) || is_archive() || is_search() ) {
		$layout_meta = 'default_layout';
	}

	$colormag_default_layout      = get_theme_mod( 'colormag_default_layout', 'right_sidebar' );
	$colormag_default_page_layout = get_theme_mod( 'colormag_default_page_layout', 'right_sidebar' );
	$colormag_default_post_layout = get_theme_mod( 'colormag_default_single_posts_layout', 'right_sidebar' );

	if ( 'default_layout' === $layout_meta ) {
		if ( is_page() ) {
			$classes[] = colormag_get_sidebar_layout_class( $colormag_default_page_layout );
		} elseif ( is_single() ) {
			$classes[] = colormag_get_sidebar_layout_class( $colormag_default_post_layout );
		} else {
			$classes[] = colormag_get_sidebar_layout_class( $colormag_default_layout );
		}
	} else {
		$classes[] = colormag_get_sidebar_layout_class( $layout_meta );
	}

	// For site layout option.
	$site_layout = get_theme_mod( 'colormag_site_layout', 'wide_layout' );
	$classes[]   = ( 'wide_layout' === $site_layout ) ? 'wide' : 'box-layout';

	// For responsive menu display.
	if ( 1 === get_theme_mod( 'colormag_responsive_menu', 0 ) ) {
		$classes[] = 'better-responsive-menu';
	}

	// Add body class for body skin type.
	if ( 'dark' === get_theme_mod( 'colormag_color_skin_setting', 'white' ) ) {
		$classes[] = 'dark-skin';
	}

	return $classes;

}

add_filter( 'body_class', 'colormag_body_class' );
