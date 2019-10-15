<?php
/**
 * ColorMag customizer base option class for theme customize options.
 *
 * Class ColorMag_Customize_Base_Option
 *
 * @package    ThemeGrill
 * @subpackage ColorMag
 * @since      ColorMag 3.0.0
 */

/**
 * ColorMag customizer base option class.
 *
 * Class ColorMag_Customize_Base_Option
 */
class ColorMag_Customize_Base_Option {

	/**
	 * Customizer setup constructor.
	 *
	 * ColorMag_Customize_Base_Option constructor.
	 */
	public function __construct() {

		// Register the customize panels, sections and controls.
		add_filter( 'colormag_customizer_options', array( $this, 'colormag_customizer_options' ), 10, 2 );

	}

	/**
	 * Base method for customize options.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 *
	 * @return mixed Customizer options for registering panels, sections as well as controls.
	 */
	public function colormag_customizer_options( $options, $wp_customize ) {

		return $options;

	}

}

return new ColorMag_Customize_Base_Option();
