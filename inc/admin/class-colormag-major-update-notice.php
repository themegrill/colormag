<?php
// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

class Colormag_Major_Update_Notice {

	public function __construct() {
		add_action( 'wp_loaded', array( $this, 'major_update_notice' ), 20 );
		add_action( 'wp_loaded', array( $this, 'hide_notices' ), 15 );
	}

	public function major_update_notice() {
		if ( ! get_option( 'colormag_admin_notice_major_update' ) ) {
			add_action( 'admin_notices', array( $this, 'major_update_notice_markup' ) ); // Show notice.
		}
	}

	/**
	 * echo `Get started` CTA.
	 *
	 * @return string
	 *
	 */
	public function update_button_html() {
		$html = '<a class="btn-major-update button button-primary button-hero" href="https://docs.themegrill.com/colormag/all-about-colormag-free-v3-0-and-colormag-pro-v4-0-major-updates/" target=”_blank” aria-label="' . esc_attr__( 'Learn More', 'colormag' ) . '">' . esc_html__( 'Learn about ColorMag 3.0', 'colormag' ) . '</a>';

		return $html;
	}

	public function support_button_html() {
		$html = '<a class="btn-contact-support button button-secondary button-hero" href="https://themegrill.com/contact/" target=”_blank” aria-label="' . esc_attr__( 'Contact Support', 'colormag' ) . '">' . esc_html__( 'Contact Support', 'colormag' ) . '</a>';

		return $html;
	}


	/**
	 * Show welcome notice.
	 */
	public function major_update_notice_markup() {
		$dismiss_url = wp_nonce_url(
			remove_query_arg( array( 'activated' ), add_query_arg( 'colormag-hide-notice', 'major_update' ) ),
			'colormag_hide_notices_nonce',
			'_colormag_notice_nonce'
		);
		?>
		<div id="message" class="notice notice-success colormag-notice colormag-update">
			<a class="colormag-message-close notice-dismiss" href="<?php echo esc_url( $dismiss_url ); ?>"></a>

			<div class="colormag-message__content">
				<div class="colormag-message__image">
					<img class="colormag-screenshot" src="<?php echo esc_url( get_template_directory_uri() ); ?>/screenshot.jpg" alt="<?php esc_attr_e( 'Colormag', 'colormag' ); ?>" /><?php // phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped, Squiz.PHP.EmbeddedPhp.SpacingBeforeClose ?>
				</div>

				<div class="colormag-message__text">
					<h1 class="colormag-message__heading">
						<?php
						printf(
						/* translators: 1: welcome page link starting html tag, 2: welcome page link ending html tag. */
							esc_html__( 'Introducing ColorMag 3.0 !!', 'colormag' )
						);
						?>
						<img class="colormag-announcement-gif" src="<?php echo esc_url( get_template_directory_uri() ); ?>/inc/admin/images/announcement.gif" alt="<?php esc_attr_e( 'Colormag', 'colormag' ); ?>" /><?php // phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped, Squiz.PHP.EmbeddedPhp.SpacingBeforeClose ?>
					</h1>
					<h2 class="colormag-message__heading">
						<?php
						printf(
						/* translators: 1: welcome page link starting html tag, 2: welcome page link ending html tag. */
							esc_html__( 'This is a major release with significant changes. It wouldn&#39;t break anything off your site but improves its UI/UX. Even though if you&#39;re experiencing any problems with your site due to this update, you can contact our support by clicking the button below:', 'colormag' )
						);
						?>
					</h2>

					<div class="colormag-message__cta">
						<?php echo $this->update_button_html(); ?>
						<?php echo $this->support_button_html(); ?>
					</div>
				</div>
			</div>
		</div> <!-- /.colormag-message__content -->
		<?php
	}

	/**
	 * Hide a notice if the GET variable is set.
	 */
	public function hide_notices() {
		if ( isset( $_GET['colormag-hide-notice'] ) && isset( $_GET['_colormag_notice_nonce'] ) ) { // WPCS: input var ok.
			if ( ! wp_verify_nonce( wp_unslash( $_GET['_colormag_notice_nonce'] ), 'colormag_hide_notices_nonce' ) ) { // phpcs:ignore WordPress.VIP.ValidatedSanitizedInput.InputNotSanitized
				wp_die( __( 'Action failed. Please refresh the page and retry.', 'colormag' ) ); // WPCS: xss ok.
			}

			if ( ! current_user_can( 'manage_options' ) ) {
				wp_die( __( 'Cheatin&#8217; huh?', 'colormag' ) ); // WPCS: xss ok.
			}

			$hide_notice = sanitize_text_field( wp_unslash( $_GET['colormag-hide-notice'] ) );

			// Hide.
			if ( 'major_update' === $hide_notice ) {
				update_option( 'colormag_admin_notice_' . $hide_notice, 1 );
			} else { // Show.
				delete_option( 'colormag_admin_notice_' . $hide_notice );
			}
		}
	}
}

new Colormag_Major_Update_Notice();
