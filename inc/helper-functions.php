<?php
/**
 * Required helper functions for this theme.
 *
 * @package    ThemeGrill
 * @subpackage ColorMag
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'colormag_elementor_active_page_check' ) ) :

	/**
	 * Check whether Elementor plugin is activated and is active on current page or not.
	 *
	 * @return bool
	 *
	 * @since ColorMag 1.2.3
	 */
	function colormag_elementor_active_page_check() {
		global $post;

		if ( defined( 'ELEMENTOR_VERSION' ) && get_post_meta( $post->ID, '_elementor_edit_mode', true ) ) {
			return true;
		}

		return false;
	}

endif;


if ( ! function_exists( 'colormag_sidebar_layout_class' ) ) :

	/**
	 * Returns the class for sidebar layout.
	 *
	 * @param string $option Option value.
	 *
	 * @return string Required class for sidebar layout to be used on body class.
	 */
	function colormag_sidebar_layout_class( $option ) {

		$output = str_replace( '_', '-', $option );

		// This extra hack is needed since our theme does not have the class of `.no-sidebar-content-centered`.
		if ( 'no-sidebar-content-centered' === $output ) {
			$output = 'no-sidebar';
		}

		return $output;

	}

endif;
