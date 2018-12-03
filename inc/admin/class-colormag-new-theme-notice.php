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

		add_action( 'after_switch_theme', array( $this, 'colormag_theme_activated' ), 20 );

	}

	/**
	 * Add `colormag_time_activated` option for checking theme activation time.
	 */
	public function colormag_theme_activated() {
		update_option( 'colormag_time_activated', time() );
	}

}

new ColorMag_New_Theme_Notice();
