<?php
/**
 * ColorMag Theme Review Notice Class.
 *
 * @author  ThemeGrill
 * @package ColorMag
 * @since   1.3.9
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * Class to display the theme review notice after certain period.
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
		add_action( 'after_setup_theme', array( $this, 'review_notice' ) );
		add_action( 'admin_notices', array( $this, 'review_notice_markup' ), 0 );
		add_action( 'admin_init', array( $this, 'ignore_theme_review_notice' ), 0 );
		add_action( 'admin_init', array( $this, 'ignore_theme_review_notice_partially' ), 0 );
		add_action( 'switch_theme', array( $this, 'review_notice_data_remove' ) );
	}

	/**
	 * Set the required option value as needed for theme review notice.
	 */
	public function review_notice() {
		// Set the installed time in `colormag_theme_installed_time` option table.
		if ( ! get_option( 'colormag_theme_installed_time' ) ) {
			do_action( 'colormag_theme_review_notice_set_time' );
			update_option( 'colormag_theme_installed_time', time() );
		}
	}

	/**
	 * Show HTML markup if conditions meet.
	 */
	public function review_notice_markup() {
		$user_id                  = get_current_user_id();
		$ignored_notice           = get_user_meta( $user_id, 'colormag_ignore_theme_review_notice', true );
		$ignored_notice_partially = get_user_meta( $user_id, 'nag_colormag_ignore_theme_review_notice_partially', true );
		$dismiss_url              = wp_nonce_url(
			add_query_arg( 'nag_colormag_ignore_theme_review_notice', 0 ),
			'nag_colormag_ignore_theme_review_notice_nonce',
			'_colormag_ignore_theme_review_notice_nonce'
		);
		$temporary_dismiss_url    = wp_nonce_url(
			add_query_arg( 'nag_colormag_ignore_theme_review_notice_partially', 0 ),
			'nag_colormag_ignore_theme_review_notice_partially_nonce',
			'_colormag_ignore_theme_review_notice_nonce'
		);

		if ( ! current_user_can( 'edit_posts' ) ) {
			return;
		}

		/**
		 * Return from notice display if:
		 *
		 * 1. The theme installed is less than 14 days ago.
		 * 2. If the user has ignored the message partially for 14 days.
		 * 3. Dismiss always if clicked on 'I Already Did' button.
		 */
		if ( ( get_option( 'colormag_theme_installed_time' ) > strtotime( '-14 day' ) ) || ( $ignored_notice_partially > strtotime( '-14 day' ) ) || ( $ignored_notice ) ) {
			return;
		}
		?>
		<div class="notice notice-success colormag-notice theme-review-notice" style="position:relative;">
			<div class="cm-review-notice-content">
		<div class="colormag-review-message__content">
			<div class="colormag-message__image">
				<img class="colormag-logo--png" src="<?php echo esc_url( get_template_directory_uri() . '/inc/admin/images/colormag-logo-square.png' ); ?>" alt="<?php esc_attr_e( 'Colormag', 'colormag' ); ?>" />
			</div>
			<div class="colormag-message-review__text">
			<h3><?php echo esc_html( 'Loving ColorMag? Help Others Discover It!' ); ?></h3>
					<p class="cm-review-content">
						<?php
						printf(
						/* translators: %1$s: Opening of strong tag, %2$s: Theme's Name, %3$s: Closing of strong tag  */
							esc_html__( "If you're enjoying the theme, would you mind taking 2 minutes to leave a review? %1\$sYour input helps other users find quality themes & motivates us to keep improving.%2\$s", 'colormag' ),
							'<br>',
							''
						);
						?>
					</p>
				<div class="colormag-five-start-review">
					<img class="" src="<?php echo esc_url( get_template_directory_uri() . '/inc/admin/images/cm-five-start.png' ); ?>" alt="<?php esc_attr_e( 'Colormag', 'colormag' ); ?>" />
					<p><?php esc_html_e( 'Rated 4.9/5 by 1,400+ users', 'colormag' ); ?></p>
				</div>

			<div class="links">
				<a href="https://wordpress.org/support/theme/colormag/reviews/?filter=5#new-post" class="btn button-primary" target="_blank">
					<span><?php esc_html_e( 'Leave a 5-Star Review', 'colormag' ); ?></span>
				</a>

				<a href="<?php echo esc_url( $temporary_dismiss_url ); ?>" class="cm-maybe-button btn button-secondary">
					<span><?php esc_html_e( 'Maybe later', 'colormag' ); ?></span>
				</a>

			</div> <!-- /.links -->
			</div>
		</div>
				<div class="colormag-global_review_image">
					<img class="colormag-review-logo--png" src="<?php echo esc_url( get_template_directory_uri() . '/inc/admin/images/global-review.png' ); ?>" alt="<?php esc_attr_e( 'Colormag', 'colormag' ); ?>" />
				</div>
			</div>

			<a class="notice-dismiss" href="<?php echo esc_url( $dismiss_url ); ?>"></a>
		</div> <!-- /.theme-review-notice -->
		<?php
	}

	/**
	 * `I already did` button or `dismiss` button: remove the review notice permanently.
	 */
	public function ignore_theme_review_notice() {

		// If user clicks to ignore the notice, add that to their user meta.
		if ( isset( $_GET['nag_colormag_ignore_theme_review_notice'] ) && isset( $_GET['_colormag_ignore_theme_review_notice_nonce'] ) ) {

			if ( ! wp_verify_nonce( wp_unslash( $_GET['_colormag_ignore_theme_review_notice_nonce'] ), 'nag_colormag_ignore_theme_review_notice_nonce' ) ) {
				wp_die( esc_html__( 'Action failed. Please refresh the page and retry.', 'colormag' ) );
			}

			if ( '0' === $_GET['nag_colormag_ignore_theme_review_notice'] ) {
				add_user_meta( get_current_user_id(), 'colormag_ignore_theme_review_notice', 'true', true );
			}
		}
	}

	/**
	 * `Maybe later` button: remove the review notice partially.
	 */
	public function ignore_theme_review_notice_partially() {

		// If user clicks to ignore the notice, add that to their user meta.
		if ( isset( $_GET['nag_colormag_ignore_theme_review_notice_partially'] ) && isset( $_GET['_colormag_ignore_theme_review_notice_nonce'] ) ) {

			if ( ! wp_verify_nonce( wp_unslash( $_GET['_colormag_ignore_theme_review_notice_nonce'] ), 'nag_colormag_ignore_theme_review_notice_partially_nonce' ) ) {
				wp_die( esc_html__( 'Action failed. Please refresh the page and retry.', 'colormag' ) );
			}

			if ( '0' === $_GET['nag_colormag_ignore_theme_review_notice_partially'] ) {
				update_user_meta( get_current_user_id(), 'nag_colormag_ignore_theme_review_notice_partially', time() );
			}
		}
	}

	/**
	 * Remove the data set after the theme has been switched to other theme.
	 */
	public function review_notice_data_remove() {
		$get_all_users        = get_users();
		$theme_installed_time = get_option( 'colormag_theme_installed_time' );

		// Delete options data.
		//      if ( $theme_installed_time ) {
		//          delete_option( 'colormag_theme_installed_time' );
		//      }

		// Delete user meta data for theme review notice.
		foreach ( $get_all_users as $user ) {
			$ignored_notice           = get_user_meta( $user->ID, 'colormag_ignore_theme_review_notice', true );
			$ignored_notice_partially = get_user_meta( $user->ID, 'nag_colormag_ignore_theme_review_notice_partially', true );

			// Delete permanent notice remove data.
			if ( $ignored_notice ) {
				delete_user_meta( $user->ID, 'colormag_ignore_theme_review_notice' );
			}

			// Delete partial notice remove data.
			if ( $ignored_notice_partially ) {
				delete_user_meta( $user->ID, 'nag_colormag_ignore_theme_review_notice_partially' );
			}
		}
	}
}

new ColorMag_Theme_Review_Notice();
