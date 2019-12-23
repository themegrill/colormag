<?php
/**
 * ColorMag customizer class for theme customize sanitizes.
 *
 * Class ColorMag_Customizer_Sanitizes
 *
 * @package    ThemeGrill
 * @subpackage ColorMag
 * @since      ColorMag 2.0.0
 */

/**
 * ColorMag customizer class for theme customize callbacks.
 *
 * Class ColorMag_Customizer_Sanitizes
 */
class ColorMag_Customizer_Sanitizes {

	/**
	 * Sanitize the checkbox options set within customizer controls.
	 *
	 * @param int $input Input from the customize controls.
	 *
	 * @return int|string
	 */
	public static function sanitize_checkbox( $input ) {

		if ( $input == 1 ) {
			return 1;
		} else {
			return '';
		}

	}

	/**
	 * Sanitize the text editor strings set within customizer controls.
	 *
	 * @param string $input Input from the customize controls.
	 *
	 * @return string
	 */
	public static function sanitize_text_editor( $input ) {

		if ( isset( $input ) ) {
			$input = stripslashes( wp_filter_post_kses( addslashes( $input ) ) );
		}

		return $input;

	}

	/**
	 * Sanitize the radio as well as select options set within customizer controls.
	 *
	 * @param string               $input   Input from the customize controls.
	 * @param WP_Customize_Setting $setting Setting instance.
	 *
	 * @return string
	 */
	public static function sanitize_radio_select( $input, $setting ) {

		// Ensuring that the input is a slug.
		$input = sanitize_key( $input );

		// Get the list of choices from the control associated with the setting.
		$choices = $setting->manager->get_control( $setting->id )->choices;

		// If the input is a valid key, return it, else, return the default.
		return ( array_key_exists( $input, $choices ) ? $input : $setting->default );

	}

	/**
	 * Sanitize the hex color set within customizer controls.
	 *
	 * @param string $color Input from the customize controls.
	 *
	 * @return string
	 */
	public static function sanitize_hex_color( $color ) {

		if ( '' === $color ) {
			return '';
		}

		// 3 or 6 hex digits, or the empty string.
		if ( preg_match( '|^#([A-Fa-f0-9]{3}){1,2}$|', $color ) ) {
			return $color;
		}

		return '';

	}

}
