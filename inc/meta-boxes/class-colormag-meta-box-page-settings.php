<?php
/**
 * Page settings meta box class.
 *
 * @package    ThemeGrill
 * @subpackage ColorMag
 * @since      ColorMag 2.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Page settings meta box class.
 *
 * Class ColorMag_Meta_Box_Page_Settings
 */
class ColorMag_Meta_Box_Page_Settings {

	/**
	 * Meta box render content callback.
	 *
	 * @param WP_Post $post Current post object.
	 */
	public static function render( $post ) {

		// Add nonce for security and authentication.
		wp_nonce_field( 'colormag_save_data', 'colormag_meta_nonce' );

	}

	/**
	 * Save meta box content.
	 *
	 * @param int $post_id Post ID.
	 */
	public static function save( $post_id ) {

		/**
		 * Hook for page settings data save.
		 */
		do_action( 'colormag_page_settings_save', $post_id );

	}

}
