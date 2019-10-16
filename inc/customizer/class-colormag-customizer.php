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

		// Include the custom controls for customize options.
		add_action( 'customize_register', array( $this, 'colormag_customize_custom_controls_includes' ) );

		// Include the required files for Customize option.
		add_action( 'customize_register', array( $this, 'colormag_customize_options_file_include' ) );

		// Include the required customize options.
		add_action( 'customize_register', array( $this, 'colormag_customize_options' ) );

	}

	/**
	 * Include the required files for extending the custom Customize controls.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function colormag_customize_custom_controls_includes( $wp_customize ) {

		require COLORMAG_CUSTOMIZER_DIR . '/custom-controls/class-colormag-upsell-section.php';
		require COLORMAG_CUSTOMIZER_DIR . '/custom-controls/class-colormag-image-radio-control.php';

	}

	/**
	 * Include the required files for Customize option.
	 */
	public function colormag_customize_options_file_include() {

		// Include the customize base option file.
		require COLORMAG_CUSTOMIZER_DIR . '/options/class-colormag-customize-base-option.php';

		// Include the required customize options file.
		require COLORMAG_CUSTOMIZER_DIR . '/options/header/class-colormag-customize-header-options.php';
		require COLORMAG_CUSTOMIZER_DIR . '/options/design/class-colormag-customize-design-options.php';
		require COLORMAG_CUSTOMIZER_DIR . '/options/social/class-colormag-customize-social-options.php';

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
