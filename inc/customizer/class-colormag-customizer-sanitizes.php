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
	function checkbox_sanitize( $input ) {

		if ( $input == 1 ) {
			return 1;
		} else {
			return '';
		}

	}

}
