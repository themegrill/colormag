<?php
/**
 * Colormag compatibility class for Elementor Pro.
 *
 * @package colormag
 */

/**
 * Do not allow direct script access.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Return if Elementor not active.
if ( ! class_exists( '\Elementor\Plugin' ) || ! class_exists( 'ElementorPro\Modules\ThemeBuilder\Module' ) ) {
	return;
}

// PHP 5.6+ is required.
if ( ! version_compare( PHP_VERSION, '5.6', '>=' ) ) {
	return;
}

if ( ! class_exists( 'Colormag_Elementor_Pro' ) ) :

	/**
	 * Elementor compatibility.
	 */
	class Colormag_Elementor_Pro {

		/**
		 * Singleton instance of the class.
		 *
		 * @var object
		 */
		private static $instance;

		/**
		 * Elementor location manager
		 *
		 * @var object
		 */
		public $elementor_location_manager;

		/**
		 * Instance.
		 *
		 * @return Colormag_Elementor_Pro
		 */
		public static function instance() {

			if ( ! isset( self::$instance ) && ! ( self::$instance instanceof Colormag_Elementor_Pro ) ) {
				self::$instance = new Colormag_Elementor_Pro();
			}

			return self::$instance;
		}

		/**
		 * Primary class constructor.
		 *
		 * @return void
		 */
		public function __construct() {

			// Register theme locations.
			add_action( 'elementor/theme/register_locations', array( $this, 'register_locations' ) );

			// Override Header templates.
			add_action( 'colormag_action_before_header', array( $this, 'do_header' ), 16 );

			// Override Footer templates.
			add_action( 'colormag_action_before_footer', array( $this, 'do_footer' ), 11 );
		}

		/**
		 * Register Theme Location for Elementor.
		 *
		 * @param object $manager Elementor object.
		 *
		 * @return void
		 */
		public function register_locations( $manager ) {

			$manager->register_all_core_location();

			$this->elementor_location_manager = \ElementorPro\Modules\ThemeBuilder\Module::instance()->get_locations_manager(); // phpcs:ignore PHPCompatibility.Syntax.NewDynamicAccessToStatic.Found
		}

		/**
		 * Override Header.
		 *
		 * @return void
		 */
		public function do_header() {

			$did_location = $this->elementor_location_manager->do_location( 'header' );

			if ( $did_location ) {
				remove_action( 'colormag_action_before_header', 'colormag_transparent_header_start', 20 );
				remove_action( 'colormag_action_header_top', 'colormag_header_top', 10 );
				remove_action( 'colormag_action_before_header_main', 'colormag_before_header_main', 10 );
				remove_action( 'colormag_action_header_main', 'colormag_header_main', 10 );
				remove_action( 'colormag_action_after_header_main', 'colormag_after_header_main', 10 );
				remove_action( 'colormag_action_after_header', 'colormag_transparent_header_end', 10 );
				remove_action( 'colormag_action_after_header', 'colormag_header_media_markup', 20 );
			}
		}

		/**
		 * Override Footer.
		 *
		 * @since 1.0.0
		 * @return void
		 */
		public function do_footer() {

			$did_location = $this->elementor_location_manager->do_location( 'footer' );

			if ( $did_location ) {
				remove_action( 'colormag_action_footer_widgets', 'colormag_footer_widgets', 10 );
				remove_action( 'colormag_action_footer_bottom_bar', 'colormag_footer_bottom_bar', 10 );
			}
		}
	}

endif;

Colormag_Elementor_Pro::instance();
