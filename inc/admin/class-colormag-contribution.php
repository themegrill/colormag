<?php
/**
 * ColorMag Contribution — ThemeGrill SDK integration for opt-in analytics and tracking.
 *
 * @package ColorMag
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

class ColorMag_Contribution {

	const FORMBRICKS_ENV_ID = 'cmpoz59ty0d2qz001ug5bffs2'; // Replace with real env ID before deploying.

	private static $instance;

	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	private function __construct() {
		$this->setup_hooks();
	}

	private function setup_hooks() {
		add_filter( 'themegrill_sdk_products', array( $this, 'register_product' ) );
		add_action( 'init', array( $this, 'customize_deactivation_labels' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'declare_internal_page' ) );
		add_filter( 'themegrill-sdk/survey/colormag', array( $this, 'configure_formbricks' ), 10, 2 );
		add_filter( 'colormag_logger_data', array( $this, 'logger_data' ) );
		add_action( 'admin_init', array( $this, 'bridge_notification_hooks' ), 20 );

		// Suppress the SDK notification banner — we use our own dashboard toggle instead.
		add_filter( 'colormag_logger_flag_should_show', '__return_false' );

		// AJAX handler for the dashboard toggle.
		add_action( 'wp_ajax_colormag_save_tracking', array( $this, 'ajax_save_tracking' ) );
	}

	/**
	 * Register ColorMag as a ThemeGrill SDK product.
	 *
	 * @param array $products Existing registered product base files.
	 * @return array
	 */
	public function register_product( $products ) {
		$products[] = get_template_directory() . '/style.css';
		return $products;
	}

	/**
	 * Override the uninstall survey heading and option labels for this theme.
	 * Runs on 'init' after the SDK has loaded its defaults into Loader::$labels.
	 */
	public function customize_deactivation_labels() {
		if ( ! class_exists( 'ThemeGrillSDK\Loader' ) ) {
			return;
		}

		\ThemeGrillSDK\Loader::$labels['uninstall']['heading_theme'] = __(
			'Why are you switching away from ColorMag?',
			'colormag'
		);

		\ThemeGrillSDK\Loader::$labels['uninstall']['options'] = array_merge(
			\ThemeGrillSDK\Loader::$labels['uninstall']['options'],
			array(
				'id3' => array(
					'title'       => __( 'I found a better theme', 'colormag' ),
					'placeholder' => __( "What's the theme's name?", 'colormag' ),
				),
				'id4' => array(
					'title'       => __( "I couldn't get the theme to look like the demo", 'colormag' ),
					'placeholder' => __( 'What problem did you experience?', 'colormag' ),
				),
				'id5' => array(
					'title'       => __( 'I no longer need it', 'colormag' ),
					'placeholder' => __( 'If you could improve one thing, what would it be?', 'colormag' ),
				),
				'id6' => array(
					'title'       => __( 'It has a compatibility issue with a plugin', 'colormag' ),
					'placeholder' => __( 'What plugin caused the issue?', 'colormag' ),
				),
			)
		);
	}

	/**
	 * Fire the SDK internal-page action on the theme's own admin screen.
	 * SDK ScriptLoader listens to this action to decide whether to enqueue the survey.
	 */
	public function declare_internal_page() {
		if ( ! is_admin() ) {
			return;
		}

		// phpcs:ignore WordPress.Security.NonceVerification.Recommended
		$page = isset( $_GET['page'] ) ? sanitize_text_field( wp_unslash( $_GET['page'] ) ) : '';

		if ( 'colormag' !== $page ) {
			return;
		}

		do_action( 'themegrill_internal_page', 'colormag', $page );
	}

	/**
	 * Return Formbricks survey configuration for this product.
	 * Called by SDK ScriptLoader via 'themegrill-sdk/survey/colormag' filter.
	 *
	 * @param array  $data      Existing survey data (empty on first call).
	 * @param string $page_slug Current admin page slug.
	 * @return array
	 */
	public function configure_formbricks( $data, $page_slug ) {
		if ( empty( $page_slug ) ) {
			return $data;
		}

		return array(
			'environmentId' => self::FORMBRICKS_ENV_ID,
			'attributes'    => array(
				'install_days_number' => (int) $this->get_install_days(),
				'is_premium'          => false,
				'theme_version'       => defined( 'COLORMAG_THEME_VERSION' ) ? COLORMAG_THEME_VERSION : '',
			),
		);
	}

	/**
	 * Append ColorMag-specific data to the SDK Logger payload.
	 * Called by SDK Logger via 'colormag_logger_data' filter (opt-in only).
	 *
	 * @param array $data Existing custom data array.
	 * @return array
	 */
	public function logger_data( $data ) {
		global $wpdb;

		$data['theme_version']   = defined( 'COLORMAG_THEME_VERSION' ) ? COLORMAG_THEME_VERSION : '';
		$data['child_theme']     = is_child_theme() ? get_stylesheet() : '';
		$data['php_version']     = PHP_VERSION;
		$data['mysql_version']   = $wpdb->db_version();
		$data['server_software'] = isset( $_SERVER['SERVER_SOFTWARE'] ) ? sanitize_text_field( wp_unslash( $_SERVER['SERVER_SOFTWARE'] ) ) : '';
		$data['theme_mods']      = get_theme_mods();

		return $data;
	}

	/**
	 * Bridge SDK notification hook case mismatch.
	 * Logger registers on 'themegrill_sdk_registered_notifications' (lowercase),
	 * but Notification module reads 'themeGrill_sdk_registered_notifications' (capital G).
	 * Runs at admin_init priority 20 — after Logger adds its filter at priority 10.
	 */
	public function bridge_notification_hooks() {
		add_filter(
			'themeGrill_sdk_registered_notifications',
			function ( $notifications ) {
				return apply_filters( 'themegrill_sdk_registered_notifications', $notifications );
			},
			20
		);
	}

	/**
	 * Handle AJAX save from the Contributing dashboard toggle.
	 */
	public function ajax_save_tracking() {
		check_ajax_referer( 'colormag_tracking_nonce', 'nonce' );

		if ( ! current_user_can( 'manage_options' ) ) {
			wp_send_json_error( array( 'message' => 'Insufficient permissions.' ) );
		}

		$enabled = isset( $_POST['enabled'] ) && rest_sanitize_boolean( wp_unslash( $_POST['enabled'] ) );
		$flag    = $enabled ? 'yes' : 'no';

		update_option( 'colormag_logger_flag', $flag );

		if ( $enabled ) {
			// wp_loaded already ran on this request with the old flag, so the Logger
			// didn't register its action. Schedule at time() and spawn cron so the
			// next non-blocking WP-Cron request picks it up fresh.
			if ( ! wp_next_scheduled( 'colormag_log_activity' ) ) {
				wp_schedule_single_event( time(), 'colormag_log_activity' );
			}
			spawn_cron();
		} else {
			wp_clear_scheduled_hook( 'colormag_log_activity' );
		}

		wp_send_json_success( array( 'enabled' => $enabled ) );
	}

	/**
	 * Calculate days since the SDK first registered ColorMag.
	 *
	 * @return int
	 */
	private function get_install_days() {
		$install_time = get_option( 'colormag_install', time() );
		return (int) floor( ( time() - (int) $install_time ) / DAY_IN_SECONDS );
	}
}
