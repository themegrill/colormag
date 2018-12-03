<?php
/**
 * ColorMag New Theme Notice Class.
 *
 * @author  ThemeGrill
 * @package ColorMag
 * @since   1.3.4
 */

// Exit if directly accessed.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class ColorMag_New_Theme_Notice
 */
class ColorMag_New_Theme_Notice {

	/**
	 * Constructor function to include the required functionality for the class.
	 *
	 * ColorMag_New_Theme_Notice constructor.
	 */
	public function __construct() {

		add_action( 'admin_init', array( $this, 'colormag_display_zakra_notice' ) );
		add_action( 'after_switch_theme', array( $this, 'colormag_theme_activated' ), 20 );

	}

	/**
	 * Add `colormag_time_activated` option for checking theme activation time.
	 */
	public function colormag_theme_activated() {
		update_option( 'colormag_time_activated', time() );
	}

	/**
	 * Determine if the user activated the theme in the last 3 days.
	 */
	public function colormag_display_zakra_notice() {
		$display_zakra_notice = get_option( 'colormag_display_zakra_notice' );
		if ( ! empty( $display_zakra_notice ) ) {
			return;
		}

		$activated_time = get_option( 'colormag_time_activated' );
		if ( empty( $activated_time ) ) {
			return;
		}

		$current_time         = time();
		$days_from_activation = intval( ( $current_time - $activated_time ) / 86400 );
		update_option( 'colormag_display_zakra_notice', 'no' );
		if ( $days_from_activation < 3 ) {
			update_option( 'colormag_display_zakra_notice', 'yes' );
		}
	}

}

new ColorMag_New_Theme_Notice();
