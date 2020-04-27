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
