<?php
/**
 * ColorMag Theme Review Notice Class.
 *
 * @author  ThemeGrill
 * @package ColorMag
 * @since   1.3.9
 */

// Exit if directly accessed.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class to display the theme review notice for this theme after certain period.
 *
 * Class ColorMag_Theme_Review_Notice
 */
class ColorMag_Theme_Review_Notice {

	/**
	 * Constructor function to include the required functionality for the class.
	 *
	 * ColorMag_Theme_Review_Notice constructor.
	 */
	public function __construct() {

		add_action( 'after_setup_theme', array( $this, 'colormag_theme_rating_notice' ) );

	}

	/**
	 * Set the required option value as needed for theme review notice.
	 */
	public function colormag_theme_rating_notice() {

		// Set the installed time in `colormag_theme_installed_time` option table.
		$option = get_option( 'colormag_theme_installed_time' );
		if ( ! $option ) {
			update_option( 'colormag_theme_installed_time', time() );
		}

	}

}

new ColorMag_Theme_Review_Notice();
