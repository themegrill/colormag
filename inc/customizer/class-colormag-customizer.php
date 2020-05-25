<?php
/**
 * ColorMag Customizer Class
 *
 * @package colormag
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'ColorMag_Customizer' ) ) :

	/**
	 * ColorMag Customizer class
	 */
	class ColorMag_Customizer {
		/**
		 * Constructor - Setup customizer
		 */
		public function __construct() {

			add_action( 'customize_register', array( $this, 'colormag_register_panel' ) );
			add_action( 'customize_register', array( $this, 'colormag_customize_register' ) );
			add_action( 'after_setup_theme', array( $this, 'colormag_customize_options' ) );

		}

		/**
		 * Register custom controls
		 *
		 * @param WP_Customize_Manager $wp_customize Manager instance.
		 */
		public function colormag_register_panel( $wp_customize ) {

			// Load customizer options extending classes.
			require COLORMAG_INCLUDES_DIR . '/customizer/extend-customizer/class-colormag-customize-section.php';
			require COLORMAG_INCLUDES_DIR . '/customizer/extend-customizer/class-colormag-customize-upsell-section.php';

			// Register extended classes.
			$wp_customize->register_section_type( 'ColorMag_Customize_Section' );

			// Load base class for controls.
			require_once COLORMAG_INCLUDES_DIR . '/customizer/controls/php/class-colormag-customize-base-control.php';
			// Load custom control classes.
			require_once COLORMAG_INCLUDES_DIR . '/customizer/controls/php/class-colormag-customize-upsell-control.php';

			// Register JS-rendered control types.
			$wp_customize->register_control_type( 'ColorMag_Customize_Upsell_Control' );

		}

		/**
		 * Add postMessage support for site title and description for the Theme Customizer.
		 *
		 * @param WP_Customize_Manager $wp_customize Manager instance.
		 */
		public function colormag_customize_register( $wp_customize ) {

			// Register panels and sections.
			require COLORMAG_INCLUDES_DIR . '/customizer/register-panels-and-sections.php';

		}

		/**
		 * Include customizer options.
		 */
		public function colormag_customize_options() {
			/**
			 * Base class.
			 */
			require COLORMAG_INCLUDES_DIR . '/customizer/options/class-colormag-customize-base-option.php';

			/**
			 * Child option classes.
			 */

			require COLORMAG_INCLUDES_DIR . '/customizer/options/class-colormag-customize-upsell-option.php';
		}

	}
endif;

new ColorMag_Customizer();
