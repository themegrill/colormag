<?php
/**
 * ColorMag Admin Class.
 *
 * @package ColorMag
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'ColorMag_Admin' ) ) :

	class ColorMag_Admin {

		public function __construct() {
			add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		}

		public function enqueue_scripts() {
			wp_enqueue_style(
				'colormag-admin-style',
				get_template_directory_uri() . '/inc/admin/css/admin.css',
				array(),
				COLORMAG_THEME_VERSION
			);

			wp_enqueue_script(
				'colormag-plugin-install-helper',
				get_template_directory_uri() . '/inc/admin/js/admin.js',
				array( 'jquery' ),
				COLORMAG_THEME_VERSION,
				true
			);

			$welcome_data = array(
				'uri'       => esc_url( admin_url( '/themes.php?page=colormag&tab=starter-templates' ) ),
				'btn_text'  => esc_html__( 'Processing...', 'colormag' ),
				'admin_url' => esc_url( admin_url() ),
			);

			if ( current_user_can( 'manage_options' ) ) {
				$welcome_data['nonce']   = wp_create_nonce( 'colormag_demo_import_nonce' );
				$welcome_data['ajaxurl'] = admin_url( 'admin-ajax.php' );
			}

			wp_localize_script( 'colormag-plugin-install-helper', 'colormagRedirectDemoPage', $welcome_data );

			$screen          = get_current_screen();
			$allowed_screens = apply_filters( 'colormag_admin_allowed_screens', array( 'appearance_page_colormag' ) );
			if ( ! in_array(
				$screen->id,
				$allowed_screens,
				true
			) ) {
				return;
			}

			$build_dir_uri        = get_template_directory_uri() . '/assets/build/';
			$build_dir_path       = get_template_directory() . '/assets/build/';
			$dashboard_asset_file = $build_dir_path . 'dashboard.asset.php';

			if ( file_exists( $dashboard_asset_file ) ) {
				$dashboard_asset = require $dashboard_asset_file;
				wp_enqueue_script(
					'colormag-dashboard',
					$build_dir_uri . 'dashboard.js',
					$dashboard_asset['dependencies'],
					$dashboard_asset['version'],
					true
				);
				wp_enqueue_style(
					'colormag-dashboard',
					$build_dir_uri . 'dashboard.css',
					array( 'wp-components' ),
					$dashboard_asset['version']
				);

				if ( ! function_exists( 'get_plugins' ) ) {
					require_once ABSPATH . 'wp-admin/includes/plugin.php';
				}
				if ( ! function_exists( 'wp_get_themes' ) ) {
					require_once ABSPATH . 'wp-admin/includes/theme.php';
				}

				$installed_plugin_slugs = array_keys( get_plugins() );
				$allowed_plugin_slugs   = array(
					'everest-forms/everest-forms.php',
					'user-registration/user-registration.php',
					'learning-management-system/lms.php',
					'magazine-blocks/magazine-blocks.php',
					'themegrill-demo-importer/themegrill-demo-importer.php',
				);
				$installed_theme_slugs  = array_keys( wp_get_themes() );
				$current_theme          = get_stylesheet();

				// Settings screen excluded from free — output true empty JS object.
				wp_add_inline_script( 'colormag-dashboard', 'window.__COLORMAG_SETTINGS__ = {"hide_feature_section":true};', 'before' );

				$dashboard_data = apply_filters(
					'colormag_admin_dashboard_data',
					array(
						'version'          => COLORMAG_THEME_VERSION,
						'plugins'          => array_reduce(
							$allowed_plugin_slugs,
							function ( $acc, $curr ) use ( $installed_plugin_slugs ) {
								if ( in_array( $curr, $installed_plugin_slugs, true ) ) {
									$acc[ $curr ] = is_plugin_active( $curr ) ? 'active' : 'inactive';
								} else {
									$acc[ $curr ] = 'not-installed';
								}
								return $acc;
							},
							array()
						),
						'builder'          => colormag_maybe_enable_builder(),
						'demoUrl'          => admin_url( 'admin.php?page=colormag-starter-templates' ),
						'demoImporter'     => is_plugin_active( 'themegrill-demo-importer/themegrill-demo-importer.php' ) ? 'active' : 'inactive',
						'customizerUrl'    => admin_url( 'customize.php' ),
						'dashboardLogo'    => '',
						'enableWhiteLabel' => false,
						'themeName'        => 'ColorMag',
						'adminUrl'         => admin_url(),
						'themes'           => array(
							'colormag' => strpos( $current_theme, 'colormag' ) !== false ? 'active' : (
								in_array( 'colormag', $installed_theme_slugs, true ) ? 'inactive' : 'not-installed'
							),
							'zakra'    => strpos( $current_theme, 'zakra' ) !== false ? 'active' : (
								in_array( 'zakra', $installed_theme_slugs, true ) ? 'inactive' : 'not-installed'
							),
						),
						'nonce'            => wp_create_nonce( 'colormag_dashboard_nonce' ),
						'ajaxUrl'          => admin_url( 'admin-ajax.php' ),
					)
				);

				wp_localize_script(
					'colormag-dashboard',
					'_COLORMAG_DASHBOARD_',
					$dashboard_data
				);
			}
		}
	}

endif;

return new ColorMag_Admin();
