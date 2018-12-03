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

		add_action( 'admin_notices', array( $this, 'colormag_zakra_notice' ) );
		add_action( 'admin_init', array( $this, 'colormag_ignore_zakra_notice' ) );

	}

	/**
	 * Add a dismissible notice in the dashboard about Zakra.
	 */
	public function colormag_zakra_notice() {
		global $current_user;
		$user_id        = $current_user->ID;
		$ignored_notice = get_user_meta( $user_id, 'colormag_ignore_zakra_notice' );
		if ( ! empty( $ignored_notice ) ) {
			return;
		}

		$dismiss_button = sprintf(
			'<a href="%s" class="notice-dismiss" style="text-decoration:none;"></a>',
			'?nag_ignore_zakra=0'
		);

		$message = sprintf(
			/* translators: Install Zakra link */
			esc_html__( 'Check out %1$s. Zakra is compatible with Elementor plugin and works perfectly with Gutenberg. You will love it!', 'colormag' ),
			sprintf(
				/* translators: Install Zakra link */
				'<a target="_blank" href="%1$s"><strong>%2$s</strong></a>',
				esc_url( 'https://themegrill.com/themes/zakra/' ),
				esc_html__( 'our newest theme', 'colormag' )
			)
		);

		printf(
			'<div class="notice updated" style="position:relative;">%1$s<p>%2$s</p></div>',
			$dismiss_button,
			$message
		);
	}

	/**
	 * Update the colormag_ignore_zakra_notice option to true, to dismiss the notice from the dashboard
	 */
	public function colormag_ignore_zakra_notice() {
		global $current_user;
		$user_id = $current_user->ID;

		/* If user clicks to ignore the notice, add that to their user meta */
		if ( isset( $_GET['nag_ignore_zakra'] ) && '0' == $_GET['nag_ignore_zakra'] ) {
			add_user_meta( $user_id, 'colormag_ignore_zakra_notice', 'true', true );
		}
	}

}

new ColorMag_New_Theme_Notice();
