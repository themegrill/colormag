<?php
/**
 * ColorMag utils class.
 *
 * @package ColorMag
 * @since   1.0.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * ColorMag utils.
 *
 * Class responsible for different utility methods.
 *
 * @since 1.0.0
 */
class ColorMag_Utils {

	/**
	 * Given an hex colors, returns an array with the colors components.
	 *
	 * @param string $hex Hex color.
	 *
	 * @return array      Array with color components (r, g, b).
	 * @since  1.0.0
	 *
	 */
	public static function get_rgba_values_from_hex( $hex ) {

		if ( false !== strpos( $hex, 'rgb' ) ) {
			$hex = self::rgba_to_hex( $hex );
		}

		// Format the hex color string.
		$hex  = str_replace( '#', '', $hex );
		$rgba = array();

		switch ( strlen( $hex ) ) {

			case 3:
				$rgba['r'] = hexdec( substr( $hex, 0, 1 ) . substr( $hex, 0, 1 ) );
				$rgba['g'] = hexdec( substr( $hex, 1, 1 ) . substr( $hex, 1, 1 ) );
				$rgba['b'] = hexdec( substr( $hex, 2, 1 ) . substr( $hex, 2, 1 ) );
				$rgba['a'] = 1;

				break;
			case 7:
			case 6:
				$rgba['r'] = hexdec( substr( $hex, 0, 2 ) );
				$rgba['g'] = hexdec( substr( $hex, 2, 2 ) );
				$rgba['b'] = hexdec( substr( $hex, 4, 2 ) );
				$rgba['a'] = 1;

				break;
			case 8:
				$rgba['r'] = hexdec( substr( $hex, 0, 2 ) );
				$rgba['g'] = hexdec( substr( $hex, 2, 2 ) );
				$rgba['b'] = hexdec( substr( $hex, 4, 2 ) );
				$rgba['a'] = hexdec( substr( $hex, 6, 2 ) ) / 255;
				break;
		}

		return $rgba;
	}

	/**
	 * Convert rgba to hex.
	 *
	 * @param string $rgba RGBA color value.
	 *
	 * @return string
	 * @since  1.0.0
	 *
	 */
	public static function rgba_to_hex( $rgba ) {

		$regex = '#\((([^()]+|(?R))*)\)#';

		if ( preg_match_all( $regex, $rgba, $matches ) ) {
			$rgba = explode( ',', implode( ' ', $matches[1] ) );
		} else {
			$rgba = explode( ',', $rgba );
		}

		$r_hex = dechex( $rgba['0'] );
		$g_hex = dechex( $rgba['1'] );
		$b_hex = dechex( $rgba['2'] );
		$a_hex = '';

		if ( array_key_exists( '3', $rgba ) ) {
			$a_hex = dechex( $rgba['3'] * 255 );
		}

		return '#' . $r_hex . $g_hex . $b_hex . $a_hex;
	}

	/**
	 * Generate hex/rgba color value by changing brightness.
	 *
	 * Useful for generating hover color values.
	 *
	 * @param string $hex Hex color value.
	 * @param integer $steps -255 (darken) to 255 (brighten).
	 *
	 * @return string          hex or rgba color value depending on the param passed.
	 * @since  1.0.0
	 *
	 */
	public static function adjust_color_brightness( $hex, $steps ) {

		$steps = max( -255, min( 255, $steps ) );

		$rgb_values = self::get_rgba_values_from_hex( $hex );

		$r = max( 0, min( 255, $rgb_values['r'] + $steps ) );
		$g = max( 0, min( 255, $rgb_values['g'] + $steps ) );
		$b = max( 0, min( 255, $rgb_values['b'] + $steps ) );

		if ( $rgb_values['a'] >= 0 && $rgb_values['a'] < 1 && 1 !== $rgb_values['a'] ) {
			return 'rgba(' . $r . ',' . $g . ',' . $b . ',' . round( $rgb_values['a'], 2 ) . ')';
		}

		$r_hex = str_pad( dechex( $r ), 2, '0', STR_PAD_LEFT );
		$g_hex = str_pad( dechex( $g ), 2, '0', STR_PAD_LEFT );
		$b_hex = str_pad( dechex( $b ), 2, '0', STR_PAD_LEFT );

		return '#' . $r_hex . $g_hex . $b_hex;
	}

	/**
	 * Adjust opacity level of color.
	 *
	 * Useful for dynamically changing color opacity of reference color.
	 *
	 * $package ColorMag
	 *
	 * @param string $hex Hex color value.
	 * @param integer $steps 0 (transparent) to 100 (opaque).
	 *
	 * @return string          rgba color value with opacity level.
	 * @since   1.0.2
	 *
	 */

	public static function adjust_color_opacity( $hex, $steps ) {

		$steps     = max( 0, min( 100, $steps ) );
		$rgba      = self::get_rgba_values_from_hex( $hex );
		$a         = isset( $rgba['a'] ) ? $rgba['a'] : 1;
		$a         = $steps / 100 * $a;
		$a         = max( 0, min( 1, round( $a, 2 ) ) );
		$rgba['a'] = $a;

		return 'rgba(' . implode( ',', array_values( $rgba ) ) . ')';
	}

	/**
	 * Check whether Elementor plugin is activated and is active on current page or not.
	 *
	 * @return bool
	 *
	 * @since ColorMag 2.2.3
	 */
	public static function colormag_elementor_active_page_check() {
		global $post;

		if ( defined( 'ELEMENTOR_VERSION' ) && get_post_meta( $post->ID, '_elementor_edit_mode', true ) ) {
			return true;
		}

		return false;
	}

	/**
	 * Check if WooCommerce plugin is active.
	 *
	 * @see https://docs.woocommerce.com/document/query-whether-woocommerce-is-activated/
	 */
	public static function colormag_is_woocommerce_active() {

		if ( class_exists( 'woocommerce' ) ) {
			return true;
		} else {
			return false;
		}
	}

	/**
	 * Returns the class for sidebar layout.
	 *
	 * @param string $class Option value.
	 *
	 * @return string Required class for sidebar layout to be used on body class.
	 */
	public static function colormag_get_sidebar_layout_class( $class ) {

		$output = str_replace( '_', '-', $class );

		// This extra hack is needed since our theme does not have the class of `.no-sidebar-content-centered`.
		if ( 'no-sidebar-content-centered' === $output ) {
			$output = 'no-sidebar';
		}

		return $output;
	}

	/**
	 * Get sidebar as per the option chosen.
	 *
	 * @param string $sidebar        The passed sidebar area to be used.
	 * @param bool   $disable_suffix Option to bare the `get_sidebar()` file call for `right` sidebar.
	 * @param string $sidebar_prefix The prefix for sidebar area to be used.
	 */
	public static function colormag_get_sidebar( $sidebar, $disable_suffix = true, $sidebar_prefix = '' ) {

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
}
