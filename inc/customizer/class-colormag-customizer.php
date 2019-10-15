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

		// Include the required customize options.
		add_action( 'customize_register', array( $this, 'colormag_customize_options' ) );

	}

	/**
	 * Include the required files for Customize option.
	 */
	public function colormag_customize_files_include() {

		// Include the customize base option file.
		require COLORMAG_CUSTOMIZER_DIR . '/options/class-colormag-customize-base-option.php';

	}

	/**
	 * Include the required customize options.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 *
	 * @return array Customizer options for registering panels, sections as well as controls.
	 */
	public function colormag_customize_options( $wp_customize ) {

		return apply_filters( 'colormag_customizer_options', array(), $wp_customize );

	}

}

return new ColorMag_Customizer();
