<?php
/**
 * ColorMag theme hooks.
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
 * Hooks for the header of this theme.
 */
// HTML Head.
add_action( 'colormag_action_head', 'colormag_head', 10 );

// Page starts.
add_action( 'colormag_action_before', 'colormag_page_start', 10 );
// Skip content link.
add_action( 'colormag_action_before', 'colormag_skip_content_link', 15 );

// Header starts.
add_action( 'colormag_action_before_header', 'colormag_header_start', 10 );

// Header nav container starts.
add_action( 'colormag_action_before_inner_header', 'colormag_header_nav_container_start', 10 );

// Header main area.
add_action( 'colormag_action_header', 'colormag_header', 10 );

// Header image display before header end.
add_action( 'colormag_action_after_inner_header', 'colormag_header_image_before_nav_container_end', 5 );
// Header nav container ends.
add_action( 'colormag_action_after_inner_header', 'colormag_header_nav_container_end', 10 );

// Header ends.
add_action( 'colormag_action_after_header', 'colormag_header_end', 10 );

// Main section starts.
add_action( 'colormag_action_before_content', 'colormag_main_section_start', 10 );

// Main section inner starts.
add_action( 'colormag_action_before_inner_content', 'colormag_main_section_inner_start', 10 );


/**
 * Hooks for the content of this theme.
 */
// Archive header.
add_action( 'colormag_action_archive_header', 'colormag_archive_header', 10 );

// Post/Page comments.
add_action( 'colormag_action_comments', 'colormag_render_comments', 10 );

// Author bio.
add_action( 'colormag_action_after_single_post_content', 'colormag_author_bio', 10 );
// Related posts.
add_action( 'colormag_action_after_single_post_content', 'colormag_related_posts', 20 );


/**
 * Hooks for the footer of this theme.
 */
// Main section inner ends.
add_action( 'colormag_action_after_inner_content', 'colormag_main_section_inner_end', 10 );

// Main section ends.
add_action( 'colormag_action_after_content', 'colormag_main_section_end', 10 );
// Advertisement above footer sidebar area.
add_action( 'colormag_action_after_content', 'colormag_advertisement_above_footer_sidebar', 15 );

// Footer starts.
add_action( 'colormag_action_before_footer', 'colormag_footer_start', 10 );
// Footer sidebar.
add_action( 'colormag_action_before_footer', 'colormag_footer_sidebar', 15 );

// Footer socket inner wrapper starts.
add_action( 'colormag_action_before_inner_footer', 'colormag_footer_socket_inner_wrapper_start', 10 );

// Footer socket area starts.
add_action( 'colormag_action_footer', 'colormag_footer_socket_area_start', 10 );
// Footer socket area right section.
add_action( 'colormag_action_footer', 'colormag_footer_socket_right_section', 15 );
// Footer socket area left section.
add_action( 'colormag_action_footer', 'colormag_footer_socket_left_section', 20 );
// Footer socket area ends.
add_action( 'colormag_action_footer', 'colormag_footer_socket_area_end', 25 );

// Footer socket inner wrapper ends.
add_action( 'colormag_action_after_inner_footer', 'colormag_footer_socket_inner_wrapper_end', 10 );

// Footer ends.
add_action( 'colormag_action_after_footer', 'colormag_footer_end', 10 );
// Scroll to top button.
add_action( 'colormag_action_after_footer', 'colormag_scroll_top_button', 15 );

// Page ends.
add_action( 'colormag_action_after', 'colormag_page_end', 10 );

// Footer copyright.
add_action( 'colormag_footer_copyright', 'colormag_footer_copyright', 10 );
