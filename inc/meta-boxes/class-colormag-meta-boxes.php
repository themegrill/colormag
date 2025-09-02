<?php
/**
 * Meta boxes base class.
 *
 * @package    ThemeGrill
 * @subpackage ColorMag
 * @since      ColorMag 3.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Meta boxes base class.
 *
 * Class ColorMag_Meta_Boxes
 */
class ColorMag_Meta_Boxes {

	/**
	 * Is meta boxes saved once?
	 *
	 * @var boolean
	 */
	private static $saved_meta_boxes = false;

	/**
	 * Constructor.
	 *
	 * ColorMag_Meta_Boxes constructor.
	 */
	public function __construct() {

		// Adding required meta boxes.
		add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ) );

		// Enqueue required meta boxes styles and scripts.
		add_action( 'admin_print_styles-post-new.php', array( $this, 'enqueue' ) );
		add_action( 'admin_print_styles-post.php', array( $this, 'enqueue' ) );

		// Save the meta boxes contents.
		add_action( 'save_post', array( $this, 'save_meta_boxes' ), 1, 2 );

		// Save page settings meta boxes.
		add_action( 'colormag_process_page_settings_meta', 'ColorMag_Meta_Box_Page_Settings::save', 10, 2 );

		add_action(
			'enqueue_block_editor_assets',
			function () {
				$meta_asset_file = get_template_directory() . '/assets/build/meta.asset.php';
				if ( get_current_screen()->id === 'customize' ) {
					return;
				}
				if ( file_exists( $meta_asset_file ) ) {
					$meta_asset = require $meta_asset_file;
					wp_enqueue_script( 'colormag-pro-meta', get_template_directory_uri() . '/assets/build/meta.js', $meta_asset['dependencies'], $meta_asset['version'], true );
					wp_enqueue_style( 'colormag-pro-meta', get_template_directory_uri() . '/assets/build/meta.css', array(), time() );
				}
			}
		);

		$this->register_meta_fields();
	}

	private function register_meta_fields() {
		register_post_meta(
			'',
			'colormag_page_container_layout',
			[
				'show_in_rest'  => true,
				'single'        => true,
				'default'       => 'default_layout',
				'type'          => 'string',
				'auth_callback' => '__return_true',
			]
		);
		register_post_meta(
			'',
			'colormag_page_sidebar_layout',
			[
				'show_in_rest'  => true,
				'single'        => true,
				'default'       => 'default_layout',
				'type'          => 'string',
				'auth_callback' => '__return_true',
			]
		);
	}

	/**
	 * Adding required meta boxes.
	 */
	public function add_meta_boxes() {

		if ( ! $this->is_classic_editor_active() ) {
			return;
		}
		// Global options for page and posts.
		add_meta_box(
			'colormag-page-setting',
			esc_html__( 'Page Settings', 'colormag' ),
			'ColorMag_Meta_Box_Page_Settings::render',
			array(
				'post',
				'page',
			)
		);

		// Video URL option for video post format only.
		add_meta_box( 'post-video-url', esc_html__( 'Video URL', 'colormag' ), 'ColorMag_Meta_Box_Page_Settings::render_video_url', 'post', 'side', 'high' );
	}

	private function is_classic_editor_active() {

		include_once ABSPATH . 'wp-admin/includes/plugin.php';
		if ( is_plugin_active( 'classic-editor/classic-editor.php' ) ) {
			return true;
		}

		if ( ! apply_filters( 'use_block_editor_for_post', true, get_post() ) ) {
			return true;
		}

		return false;
	}

	/**
	 * Enqueue required meta boxes styles and scripts.
	 */
	public function enqueue() {

		if ( ! $this->is_classic_editor_active() ) {
			return;
		}

		$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

		// Enqueue meta boxes CSS file.
		wp_enqueue_style( 'colormag-meta-boxes', COLORMAG_INCLUDES_URL . '/meta-boxes/assets/css/meta-boxes' . $suffix . '.css', array(), COLORMAG_THEME_VERSION );
		wp_style_add_data( 'colormag-meta-boxes', 'rtl', 'replace' );

		// Enqueue meta boxes JS file.
		wp_enqueue_script( 'colormag-meta-boxes', COLORMAG_INCLUDES_URL . '/meta-boxes/assets/js/meta-boxes' . $suffix . '.js', array( 'jquery-ui-tabs' ), COLORMAG_THEME_VERSION, true );
	}

	/**
	 * Save the meta boxes contents.
	 *
	 * @param int     $post_id Post ID.
	 * @param WP_Post $post    Post object.
	 *
	 * @return void|mixed
	 */
	public function save_meta_boxes( $post_id, $post ) {

		if ( ! $this->is_classic_editor_active() ) {
			return;
		}

		$post_id = absint( $post_id );

		// $post_id and $post are required.
		if ( empty( $post_id ) || empty( $post ) || self::$saved_meta_boxes ) {
			return;
		}

		// Dont' save meta boxes for revisions or autosaves.
		if ( defined( 'DOING_AUTOSAVE' ) || is_int( wp_is_post_revision( $post ) ) || is_int( wp_is_post_autosave( $post ) ) ) {
			return;
		}

		// Check the nonce.
		if ( empty( $_POST['colormag_meta_nonce'] ) || ! wp_verify_nonce( wp_unslash( $_POST['colormag_meta_nonce'] ), 'colormag_save_data' ) ) { // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized
			return;
		}

		// Check the post being saved == the $post_id to prevent triggering this call for other save_post events.
		if ( empty( $_POST['post_ID'] ) || absint( $_POST['post_ID'] ) !== $post_id ) {
			return;
		}

		// Check user has permission to edit.
		if ( isset( $_POST['post_type'] ) && ( 'page' === $_POST['post_type'] ) ) {

			if ( ! current_user_can( 'edit_page', $post_id ) ) {
				return $post_id;
			}
		} elseif ( ! current_user_can( 'edit_post', $post_id ) ) {
				return $post_id;
		}

		// We need this save event to run once to avoid potential endless loops.
		self::$saved_meta_boxes = true;

		// Trigger action.
		$process_actions = array( 'page_settings' );
		foreach ( $process_actions as $process_action ) {
			do_action( 'colormag_process_' . $process_action . '_meta', $post_id, $post );
		}
	}
}

return new ColorMag_Meta_Boxes();
