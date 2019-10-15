<?php
/**
 * ColorMag customizer class for theme customize options.
 *
 * Class ColorMag_Customizer
 *
 * @package    ThemeGrill
 * @subpackage ColorMag
 * @since      ColorMag 2.0.0
 */

/**
 * ColorMag customizer class.
 *
 * Class ColorMag_Customizer
 */
class ColorMag_Customizer {

	/**
	 * Customizer setup constructor.
	 *
	 * ColorMag_Customizer constructor.
	 */
	public function __construct() {

		// Include the required files for Customize option.
		add_action( 'customize_register', array( $this, 'colormag_customize_files_include' ) );

	}

	/**
	 * Include the required files for Customize option.
	 */
	public function colormag_customize_files_include() {

		// Include the customize base option file.
		require COLORMAG_CUSTOMIZER_DIR . '/options/class-colormag-customize-base-option.php';

	}

}

return new ColorMag_Customizer();
