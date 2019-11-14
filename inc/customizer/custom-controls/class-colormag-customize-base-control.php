<?php
/**
 * ColorMag customizer base control class for theme customize options.
 *
 * Class ColorMag_Customize_Base_Option
 *
 * @package    ThemeGrill
 * @subpackage ColorMag
 * @since      ColorMag 2.0.0
 */

/**
 * ColorMag customizer base control class.
 *
 * Class ColorMag_Customize_Base_Control
 */
class ColorMag_Customize_Base_Control {

	/**
	 * Customizer base control constructor.
	 *
	 * ColorMag_Customize_Base_Control constructor.
	 */
	public function __construct() {

		// Enqueue the required scripts for the custom customize controls.
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue_customize_controls' ) );

	}

	/**
	 * Enqueue custom scripts for customize controls.
	 */
	public function enqueue_customize_controls() {

		$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

		/**
		 * Enqueue required Customize Controls CSS files.
		 */
		// Main CSS file.
		wp_enqueue_style(
			'colormag-customize-controls',
			COLORMAG_CUSTOMIZER_URL . '/custom-controls/assets/css/customize-controls' . $suffix . '.css'
		);

		/**
		 * Enqueue required Customize Controls JS files.
		 */
		// Main JS file.
		wp_enqueue_script(
			'colormag-customize-controls',
			COLORMAG_CUSTOMIZER_URL . '/custom-controls/assets/js/customize-controls' . $suffix . '.js',
			array( 'jquery' ),
			false,
			true
		);

	}

}

return new ColorMag_Customize_Base_Control();
