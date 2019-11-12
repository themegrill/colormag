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
		add_action( 'customize_register', array( $this, 'customize_custom_controls_includes' ) );

		// Include the required files for Customize option.
		add_action( 'customize_register', array( $this, 'customize_options_file_include' ) );

		// Include the required customize options.
		add_action( 'customize_register', array( $this, 'customize_options' ) );

		// Include the required customizer sanitizations, callbacks and partials files.
		add_action( 'customize_register', array( $this, 'customize_sanitize_callback_include' ) );

		// Enqueue the preview JS for customize options.
		add_action( 'customize_preview_init', array( $this, 'customize_preview_js' ) );

	}

	/**
	 * Include the required files for extending the custom Customize controls.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function customize_custom_controls_includes( $wp_customize ) {

		// Include the customize base controls file.
		require COLORMAG_CUSTOMIZER_DIR . '/custom-controls/class-colormag-customize-base-control.php';

		// Include the required customize controls file.
		require COLORMAG_CUSTOMIZER_DIR . '/custom-controls/class-colormag-upsell-section.php';
		require COLORMAG_CUSTOMIZER_DIR . '/custom-controls/class-colormag-image-radio-control.php';

	}

	/**
	 * Include the required files for Customize option.
	 */
	public function customize_options_file_include() {

		// Include the customize base option file.
		require COLORMAG_CUSTOMIZER_DIR . '/options/class-colormag-customize-base-option.php';

		// Include the required customize options file.
		require COLORMAG_CUSTOMIZER_DIR . '/options/header/class-colormag-customize-header-options.php';
		require COLORMAG_CUSTOMIZER_DIR . '/options/design/class-colormag-customize-design-options.php';
		require COLORMAG_CUSTOMIZER_DIR . '/options/social/class-colormag-customize-social-options.php';
		require COLORMAG_CUSTOMIZER_DIR . '/options/footer/class-colormag-customize-footer-options.php';
		require COLORMAG_CUSTOMIZER_DIR . '/options/additional/class-colormag-customize-additional-options.php';
		require COLORMAG_CUSTOMIZER_DIR . '/options/category-color/class-colormag-customize-category-color-options.php';
		require COLORMAG_CUSTOMIZER_DIR . '/options/override-defaults/class-colormag-customize-override-defaults-options.php';

	}

	/**
	 * Include the required customize options.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 *
	 * @return array Customizer options for registering panels, sections as well as controls.
	 */
	public function customize_options( $wp_customize ) {

		return apply_filters( 'colormag_customizer_options', array(), $wp_customize );

	}

	/**
	 * Include the required customizer sanitization, callbacks and partials file.
	 */
	public function customize_sanitize_callback_include() {

		require_once( COLORMAG_CUSTOMIZER_DIR . '/class-colormag-customizer-sanitizes.php' );
		require_once( COLORMAG_CUSTOMIZER_DIR . '/class-colormag-customizer-callbacks.php' );
		require_once( COLORMAG_CUSTOMIZER_DIR . '/class-colormag-customizer-partials.php' );

	}

	/**
	 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
	 *
	 * @since ColorMag 2.0.0
	 */
	public function customize_preview_js() {
		wp_enqueue_script(
			'colormag-customizer',
			get_template_directory_uri() . '/js/customizer.js',
			array(
				'customize-preview',
			),
			false,
			true
		);
	}

}

return new ColorMag_Customizer();
