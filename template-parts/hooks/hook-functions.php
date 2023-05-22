<?php
/**
 * Theme hooks.
 *
 * @package ColorMag
 *
 * TODO: @since
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * Header.
 */
if ( ! function_exists( 'colormag_header' ) ) {

	/**
	 * Header.
	 *
	 * @return void
	 */
	function colormag_header() {

		/**
		 * Hook for header.
		 *
		 * @hooked colormag_header_markup - 10.
		 */
		do_action( 'colormag_header' );
	}
}
