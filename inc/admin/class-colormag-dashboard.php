<?php
// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

class ColorMag_Dashboard {

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
		add_action( 'in_admin_header', array( $this, 'hide_admin_notices' ) );
		add_action( 'admin_menu', array( $this, 'create_menu_page' ), 11 );
	}

	public function create_menu_page() {
		$icon = 'data:image/svg+xml,' . rawurlencode(
			'<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20"><mask id="a" width="19" height="17" x="0" y="1" maskUnits="userSpaceOnUse" style="mask-type:luminance"><path fill="#fff" d="M18.413 1H0v17h18.413V1Z"/></mask><g fill="#F3F1F1" mask="url(#a)"><path d="M17.293 5.53c.196.227.304.498.283.793v6.68a.963.963 0 0 1-.26.723c-.392.363-.977.363-1.346 0-.174-.203-.283-.452-.26-.724v-3.6l-1.347 2.581a1.56 1.56 0 0 1-.434.566.75.75 0 0 1-.52.16.838.838 0 0 1-.522-.16 1.839 1.839 0 0 1-.434-.565l-1.324-2.491v3.51a.974.974 0 0 1-.262.722.867.867 0 0 1-.694.273.912.912 0 0 1-.673-.272 1.043 1.043 0 0 1-.238-.746V6.322a1.063 1.063 0 0 1 .282-.792.988.988 0 0 1 1.302-.113c.174.136.326.339.435.543l2.17 4.234 2.128-4.257c.239-.498.564-.725.999-.725.26 0 .52.114.715.318ZM8.543 11.832a.658.658 0 0 0-.524-.273c-.1.002-.199.016-.295.042-.084.042-.21.084-.378.19-.358.167-.652.293-.883.356a3.858 3.858 0 0 1-.987.126c-.736 0-1.282-.23-1.64-.672-.357-.441-.545-1.093-.545-1.996v-.168H1v.168c-.02.825.167 1.641.546 2.375a3.721 3.721 0 0 0 1.512 1.554 4.61 4.61 0 0 0 2.29.546c1.05 0 2.249-.273 3.026-.82a.765.765 0 0 0 .294-.336.828.828 0 0 0 .084-.441.94.94 0 0 0-.21-.65Z"/><path d="M3.815 7.588c.358-.441.904-.673 1.64-.673.272 0 .524.042.798.105.294.084.567.21.82.379.104.063.23.125.336.189.105.042.21.063.336.063a.657.657 0 0 0 .525-.273 1.05 1.05 0 0 0 .21-.652c0-.147-.02-.315-.084-.44a1.414 1.414 0 0 0-.294-.316 4.754 4.754 0 0 0-2.752-.819 4.555 4.555 0 0 0-2.29.546 3.72 3.72 0 0 0-1.514 1.555 4.923 4.923 0 0 0-.524 2.185H3.29c.02-.82.21-1.43.524-1.85Z"/></g></svg>'
		);

		add_theme_page(
			'ColorMag',
			'ColorMag',
			'manage_options',
			'colormag',
			array( $this, 'markup' )
		);

	}

	public function hide_admin_notices() {
		$_page = sanitize_text_field( $_GET['page'] ?? '' );

		if ( ! in_array( $_page, array( 'colormag', 'colormag-starter-templates' ), true ) ) {
			return;
		}

		global $wp_filter;
		$ignore_notices = apply_filters( 'colormag_ignore_hide_admin_notices', array() );

		foreach ( array( 'user_admin_notices', 'admin_notices', 'all_admin_notices' ) as $wp_notice ) {
			if ( empty( $wp_filter[ $wp_notice ] ) ) {
				continue;
			}

			$hook_callbacks = $wp_filter[ $wp_notice ]->callbacks;

			if ( empty( $hook_callbacks ) || ! is_array( $hook_callbacks ) ) {
				continue;
			}

			foreach ( $hook_callbacks as $priority => $hooks ) {
				foreach ( $hooks as $name => $callback ) {
					if ( ! empty( $name ) && in_array( $name, $ignore_notices, true ) ) {
						continue;
					}
					if (
						! empty( $callback['function'] ) &&
						! is_a( $callback['function'], '\Closure' ) &&
						isset( $callback['function'][0], $callback['function'][1] ) &&
						is_object( $callback['function'][0] ) &&
						in_array( $callback['function'][1], $ignore_notices, true )
					) {
						continue;
					}
					unset( $wp_filter[ $wp_notice ]->callbacks[ $priority ][ $name ] );
				}
			}
		}
	}

	public function markup() {
		echo '<div id="render_dashboard_page" class="colormag"></div>';
	}

}

ColorMag_Dashboard::instance();
