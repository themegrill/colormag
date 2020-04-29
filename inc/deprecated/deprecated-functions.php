<?php
/**
 * Deprecated functions for ColorMag theme.
 *
 * @package    ThemeGrill
 * @subpackage ColorMag
 * @since      ColorMag 2.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'colormag_the_custom_logo' ) ) :

	/**
	 * Deprecated function to display the custom logo.
	 */
	function colormag_the_custom_logo() {

		_deprecated_function( __FUNCTION__, '2.0.0', 'the_custom_logo()' );

		the_custom_logo();

	}

endif;
