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

			wp_enqueue_script( 'colormag-plugin-install-helper', get_template_directory_uri() . '/inc/admin/js/admin.js', array( 'jquery' ), COLORMAG_THEME_VERSION, true );

			// Only expose the nonce and AJAX functionality to users with appropriate capabilities
			$welcome_data = array(
				'uri'       => esc_url( admin_url( '/themes.php?page=colormag&tab=starter-templates' ) ),
				'btn_text'  => esc_html__( 'Processing...', 'colormag' ),
				'admin_url' => esc_url( admin_url() ),
			);

			// Only add nonce and ajaxurl if user has appropriate capabilities
			if ( current_user_can( 'manage_options' ) ) {
				$welcome_data['nonce']   = wp_create_nonce( 'colormag_demo_import_nonce' );
				$welcome_data['ajaxurl'] = admin_url( 'admin-ajax.php' );
			}

			wp_localize_script( 'colormag-plugin-install-helper', 'colormagRedirectDemoPage', $welcome_data );
		}
	}

endif;

return new ColorMag_Admin();
