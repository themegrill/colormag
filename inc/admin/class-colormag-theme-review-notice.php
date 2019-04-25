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

		add_action( 'admin_notices', array( $this, 'colormag_theme_review_notice' ), 0 );

	}

	/**
	 * Display the theme review notice.
	 */
	public function colormag_theme_review_notice() {

		/**
		 * Return from notice display if,
		 * the theme installed is less than 1 month ago.
		 */
		if ( get_option( 'colormag_theme_installed_time' ) > strtotime( '-1 month' ) ) {
			return;
		}
		?>

		<div class="notice updated theme-review-notice" style="position:relative;">
			<?php
			printf(
				/* Translators: %1$s current user display name. */
				esc_html__(
					'Howdy %1$s! It seems that you have been using this theme for more than 1 month. We hope you are happy with everything that the theme has to offer. If you can spare a mimute, please help us by leaving a 5-star review on WordPress.org.  By spreading the love, we can continue to develop new amazing features in the future, for free!',
					'colormag'
				),
				wp_get_current_user()->display_name
			)
			?>

			<div class="links">
				<a href="https://wordpress.org/support/theme/colormag/reviews/?filter=5#new-post" class="btn button-primary" target="_blank">
					<span class="dashicons dashicons-external"></span>
					<span><?php esc_html_e( 'Sure, you deserve it.', 'colormag' ); ?></span>
				</a>
			</div>
		</div>

		<?php
	}

}

new ColorMag_Theme_Review_Notice();
