<?php
// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

class Colormag_Welcome_Notice {

	public function __construct() {
		add_action( 'wp_loaded', array( $this, 'welcome_notice' ), 20 );
		add_action( 'wp_loaded', array( $this, 'hide_notices' ), 15 );
		add_action( 'wp_ajax_import_button', array( $this, 'welcome_notice_import_handler' ) );
	}

	public function welcome_notice() {
		if ( ! get_option( 'colormag_admin_noticewelcome' ) ) {
			add_action( 'admin_notices', array( $this, 'welcome_notice_markup' ) ); // Show notice.
		}
	}

	/**
	 * echo `Get started` CTA.
	 *
	 * @return string
	 *
	 */
	public function import_button_html() {
		$html = '<a class="btn-get-started button button-primary button-hero" href="#" data-name="' . esc_attr( 'themegrill-demo-importer' ) . '" data-slug="' . esc_attr( 'themegrill-demo-importer' ) . '" aria-label="' . esc_attr__( 'Let’s Get Started', 'colormag' ) . '">' . esc_html__( 'Let’s Get Started', 'colormag' ) . '</a>';

		return $html;
	}

	/**
	 * Show welcome notice.
	 */
	public function welcome_notice_markup() {

		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}

		$dismiss_url = wp_nonce_url(
			remove_query_arg( array( 'activated' ), add_query_arg( 'colormag-hide-notice', 'welcome' ) ),
			'colormag_hide_notices_nonce',
			'_colormag_notice_nonce'
		);

		// Get the current user object
		$current_user = wp_get_current_user();

		// Check if the user is logged in
		if ( 0 !== $current_user->ID ) {
			// Get the username
			$username = $current_user->user_login;
		}

		if ( is_plugin_active( 'themegrill-demo-importer/themegrill-demo-importer.php' ) ) {
			return;
		}
		?>
		<div id="message" class="notice notice-success colormag-notice">

			<div class="colormag-message__content">
				<div class="colormag-message__text">
					<div class="colormag-message__head">
						<h2 class="colormag-message__heading">
							<?php
							printf(
								esc_html__( 'Thank You for Choosing ColorMag!', 'colormag' )
							);
							?>
						</h2>
						<p class="colormag-message__description">
							<?php
							printf(
							/* translators: 1: welcome page link starting html tag, 2: welcome page link ending html tag. */
								esc_html__( 'Jumpstart your website with our professionally designed starter templates — crafted for almost every niche. Create a beautiful, fully functional site in just a few clicks.', 'colormag' )
							);
							?>
						</p>
					</div>
					<div class="colormag-message__cta">
						<?php echo $this->import_button_html(); ?>
					</div>
					<a href="<?php echo esc_url( $dismiss_url ); ?>" class="cm-welcome-notice-remove">
						<?php esc_html_e( 'I prefer to build from scratch', 'colormag' ); ?>
					</a>
				</div>
				<div class="colormag-message__image">
					<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/inc/admin/images/colormag-welcome-banner.png" alt="ColorMag Templates">
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
			if ( 'welcome' === $_GET['colormag-hide-notice'] ) {
				update_option( 'colormag_admin_notice' . $hide_notice, 1 );
			} else { // Show.
				delete_option( 'colormag_admin_notice' . $hide_notice );
			}
		}
	}

	/**
	 * Handle the AJAX process while import or get started button clicked.
	 */
	public function welcome_notice_import_handler() {

		check_ajax_referer( 'colormag_demo_import_nonce', 'security' );

		if ( ! current_user_can( 'manage_options' ) ) {
			wp_send_json_error(
				array(
					'errorCode'    => 'permission_denied',
					'errorMessage' => __( 'You do not have permission to perform this action.', 'colormag' ),
				)
			);
			exit;
		}

		$state = '';

		if ( class_exists( 'themegrill_demo_importer' ) ) {
			$state = 'activated';
		} elseif ( file_exists( WP_PLUGIN_DIR . '/themegrill-demo-importer/themegrill-demo-importer.php' ) ) {
			$state = 'installed';
		}

		if ( 'activated' === $state ) {
			$response['redirect'] = admin_url( '/themes.php?page=colormag&tab=starter-templates' );
		} elseif ( 'installed' === $state ) {
			$response['redirect'] = admin_url( '/themes.php?page=colormag&tab=starter-templates' );
			if ( current_user_can( 'activate_plugin' ) ) {
				$result = activate_plugin( 'themegrill-demo-importer/themegrill-demo-importer.php' );

				if ( is_wp_error( $result ) ) {
					$response['errorCode']    = $result->get_error_code();
					$response['errorMessage'] = $result->get_error_message();
				}
			}
		} else {
			wp_enqueue_style( 'plugin-install' );
			wp_enqueue_script( 'plugin-install' );

			$response['redirect'] = admin_url( '/themes.php?page=colormag&tab=starter-templates' );

			/**
			 * Install Plugin.
			 */
			include_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';
			include_once ABSPATH . 'wp-admin/includes/plugin-install.php';

			$api = plugins_api(
				'plugin_information',
				array(
					'slug'   => sanitize_key( wp_unslash( 'themegrill-demo-importer' ) ),
					'fields' => array(
						'sections' => false,
					),
				)
			);

			$skin     = new WP_Ajax_Upgrader_Skin();
			$upgrader = new Plugin_Upgrader( $skin );
			$result   = $upgrader->install( $api->download_link );

			if ( $result ) {
				$response['installed'] = 'succeed';
			} else {
				$response['installed'] = 'failed';
			}

			// Activate plugin.
			if ( current_user_can( 'activate_plugin' ) ) {
				$result = activate_plugin( 'themegrill-demo-importer/themegrill-demo-importer.php' );

				if ( is_wp_error( $result ) ) {
					$response['errorCode']    = $result->get_error_code();
					$response['errorMessage'] = $result->get_error_message();
				}
			}
		}

		wp_send_json( $response );

		exit();
	}
}

new Colormag_Welcome_Notice();
