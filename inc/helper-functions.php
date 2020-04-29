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


if ( ! function_exists( 'colormag_get_sidebar_layout_class' ) ) :

	/**
	 * Returns the class for sidebar layout.
	 *
	 * @param string $class Option value.
	 *
	 * @return string Required class for sidebar layout to be used on body class.
	 */
	function colormag_get_sidebar_layout_class( $class ) {

		$output = str_replace( '_', '-', $class );

		// This extra hack is needed since our theme does not have the class of `.no-sidebar-content-centered`.
		if ( 'no-sidebar-content-centered' === $output ) {
			$output = 'no-sidebar';
		}

		return $output;

	}

endif;


if ( ! function_exists( 'colormag_get_sidebar' ) ) :

	/**
	 * Get sidebar as per the option chosen.
	 *
	 * @param string $sidebar        The passed sidebar area to be used.
	 * @param bool   $disable_suffix Option to bare the `get_sidebar()` file call for `right` sidebar.
	 * @param string $sidebar_prefix The prefix for sidebar area to be used.
	 */
	function colormag_get_sidebar( $sidebar, $disable_suffix = true, $sidebar_prefix = '' ) {

		// Bail out if `no_sidebar_full_width` or `no_sidebar_content_centered` is chosen.
		if ( 'no_sidebar_full_width' === $sidebar || 'no_sidebar_content_centered' === $sidebar ) {
			return;
		}

		$sidebar = str_replace( '_sidebar', '', $sidebar );

		// Bare the sidebar if sidebar is set to `right` sidebar to prevent being called different sidebar
		// if user is utilizing it via the child theme.
		if ( 'right' === $sidebar && $disable_suffix ) {
			$sidebar = '';
		}

		if ( $sidebar_prefix ) {
			get_sidebar( $sidebar_prefix . '-' . $sidebar );
		} else {
			get_sidebar( $sidebar );
		}

	}

endif;
