<?php
/**
 * ColorMag Admin Class.
 *
 * @author  ThemeGrill
 * @package ColorMag
 * @since   1.1.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'ColorMag_Admin' ) ) :

	/**
	 * ColorMag_Admin Class.
	 */
	class ColorMag_Admin {

		/**
		 * Constructor.
		 */
		public function __construct() {
			add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		}

		/**
		 * Localize array for import button AJAX request.
		 */
		public function enqueue_scripts() {
			wp_enqueue_style( 'colormag-admin-style', get_template_directory_uri() . '/inc/admin/css/admin.css', array(), COLORMAG_THEME_VERSION );

			wp_enqueue_script( 'colormag-plugin-install-helper', get_template_directory_uri() . '/inc/admin/js/plugin-handle.js', array( 'jquery' ), COLORMAG_THEME_VERSION, true );

			$welcome_data = array(
				'uri'      => esc_url( admin_url( '/themes.php?page=demo-importer&browse=all&colormag-hide-notice=welcome' ) ),
				'btn_text' => esc_html__( 'Processing...', 'colormag' ),
				'nonce'    => wp_create_nonce( 'colormag_demo_import_nonce' ),
			);

			wp_localize_script( 'colormag-plugin-install-helper', 'colormagRedirectDemoPage', $welcome_data );
		}
	}

endif;

return new ColorMag_Admin();
