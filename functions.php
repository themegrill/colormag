<?php
/**
 * ColorMag functions related to adding files.
 *
 * @link    https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package ColorMag
 *
 * @since   ColorMag 1.0.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;


/**
 * Define constants.
 */
require get_template_directory() . '/inc/base/class-colormag-constants.php';

/**
 * Helpers functions.
 */
require get_template_directory() . '/inc/helper/utils.php';

/**
 * Calling in the admin area for the Welcome Page as well as for the new theme notice too.
 */
if ( is_admin() ) {
	require get_template_directory() . '/inc/admin/class-colormag-admin.php';
	require get_template_directory() . '/inc/admin/class-colormag-dashboard.php';
	require get_template_directory() . '/inc/admin/class-colormag-welcome-notice.php';
	require get_template_directory() . '/inc/admin/class-colormag-theme-review-notice.php';
}

require get_template_directory() . '/inc/admin/class-colormag-changelog-parser.php';


///** ColorMag setup file, hooked for `after_setup_theme`. */
require COLORMAG_INCLUDES_DIR . '/colormag-setup.php';

/**
 * Base.
 */
// Generate WordPress filter hook dynamically.
require COLORMAG_INCLUDES_DIR . '/base/class-colormag-dynamic-filter.php';

// Generate dynamic CSS from styling options.
require_once COLORMAG_INCLUDES_DIR . '/base/class-colormag-dynamic-css.php';
require_once COLORMAG_INCLUDES_DIR . '/base/class-colormag-dynamic-builder-css.php';

// Adds classes to appropriate places.
require_once COLORMAG_INCLUDES_DIR . '/base/class-colormag-dynamic-classes.php';

// Adds classes to appropriate places.
require COLORMAG_INCLUDES_DIR . '/base/class-colormag-css-classes.php';

/**
 * Core.
 */
// ColorMag setup file, hooked for `after_setup_theme`.
require COLORMAG_INCLUDES_DIR . '/core/class-colormag-after-setup-theme.php';

// Load scripts.
require_once COLORMAG_INCLUDES_DIR . '/core/class-colormag-enqueue-scripts.php';

// Header Media.
require_once COLORMAG_INCLUDES_DIR . '/core/custom-header.php';

/**
 * Customizer.
 */
require_once COLORMAG_CUSTOMIZER_DIR . '/class-colormag-customizer.php';

// Load customind.
require_once COLORMAG_CUSTOMIZER_DIR . '/customind/init.php';

//require __DIR__ . '/../customind/init.php';

/**
 * @var \Customind\Core\Customind
 */
global $customind;
$customind->set_css_var_prefix( 'colormag' );
$customind->set_i18n_data(
	[
		'domain' => 'colormag',
	]
);
add_action(
	'after_setup_theme',
	function () use ( $customind ) {
		$customind->set_section_i18n(
			[
				/* Translators: 1: Panel Title. */
				'customizing-action' => __( 'Customizing ▶ %s', 'colormag' ),
				'customizing'        => __( 'Customizing', 'colormag' ),
			]
		);
	}
);

/**
 * Deprecated.
 */
// Load deprecated functions.
require_once COLORMAG_INCLUDES_DIR . '/deprecated/deprecated-filters.php';
require_once COLORMAG_INCLUDES_DIR . '/deprecated/deprecated-functions.php';
require_once COLORMAG_INCLUDES_DIR . '/deprecated/deprecated-hooks.php';

/**
 * Helper.
 */
// Load utils & helper functions.
require_once COLORMAG_INCLUDES_DIR . '/helper/class-colormag-utils.php';

/**
 * Meta Boxes.
 */
// Meta boxes function and classes.
require_once COLORMAG_INCLUDES_DIR . '/meta-boxes/class-colormag-meta-boxes.php';
require_once COLORMAG_INCLUDES_DIR . '/meta-boxes/class-colormag-meta-box-page-settings.php';

/**
 * Migration
 */
// Load demo import migration scripts.
require_once COLORMAG_INCLUDES_DIR . '/migration/demo-import-migration.php';

// Load migration scripts.
require_once COLORMAG_INCLUDES_DIR . '/migration/class-colormag-migration.php';

/**
 * Widgets
 */
// Load Widgets and Widgetized Area.
require_once COLORMAG_WIDGETS_DIR . '/class-colormag-widgets.php';

/**
 * Templates.
 */
// Template functions files.
require COLORMAG_INCLUDES_DIR . '/template-tags.php';
require COLORMAG_INCLUDES_DIR . '/builder-template-tags.php';
require COLORMAG_INCLUDES_DIR . '/template-functions.php';

// Svg icon class.
require COLORMAG_INCLUDES_DIR . '/class-colormag-svg-icons.php';

//Template hooks.
require COLORMAG_PARENT_DIR . '/template-parts/hooks/hook-functions.php';
require COLORMAG_PARENT_DIR . '/template-parts/hooks/builder.php';

require COLORMAG_PARENT_DIR . '/template-parts/hooks/header/header.php';
require COLORMAG_PARENT_DIR . '/template-parts/hooks/header/header-main.php';
require COLORMAG_PARENT_DIR . '/template-parts/hooks/header/top-bar.php';

require COLORMAG_PARENT_DIR . '/template-parts/hooks/content/content.php';

require COLORMAG_PARENT_DIR . '/template-parts/hooks/footer/footer.php';

/** WP_Query functions files. */
require COLORMAG_INCLUDES_DIR . '/colormag-wp-query.php';

/** Breadcrumb class. */
require_once COLORMAG_INCLUDES_DIR . '/class-breadcrumb-trail.php';
require_once COLORMAG_INCLUDES_DIR . '/class-colormag-starter-content.php';

/** Load functions */
require_once COLORMAG_INCLUDES_DIR . '/ajax.php';

/** Add the JetPack plugin support */
if ( defined( 'JETPACK__VERSION' ) ) {
	require_once COLORMAG_INCLUDES_DIR . '/compatibility/jetpack/jetpack.php';
}

/** Add the WooCommerce plugin support */
if ( class_exists( 'WooCommerce' ) ) {
	require_once COLORMAG_INCLUDES_DIR . '/compatibility/woocommerce/woocommerce.php';
}

/** Add the Elementor compatibility file */
if ( defined( 'ELEMENTOR_VERSION' ) ) {
	require_once COLORMAG_ELEMENTOR_DIR . '/elementor.php';
	require_once COLORMAG_ELEMENTOR_DIR . '/elementor-functions.php';
}

function get_assets_url() {
	// Get correct URL and path to wp-content.
	$content_url = untrailingslashit( dirname( dirname( get_stylesheet_directory_uri() ) ) );
	$content_dir = wp_normalize_path( untrailingslashit( WP_CONTENT_DIR ) );

	$url = str_replace( $content_dir, $content_url, wp_normalize_path( __DIR__ ) );
	$url = set_url_scheme( $url );

	return $url;
}

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function colormag_set_content_width() {

	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'colormag_set_content_width', 800 );
}

add_filter( 'themegrill_demo_importer_show_main_menu', '__return_false' );

add_filter( 'themegrill_demo_importer_routes', 'colormag_demo_importer_routes', 10, 1 );

function colormag_demo_importer_routes( $routes ) {
	// Remove the existing routes from the TDI
	unset( $routes['themes.php?page=demo-importer&demo=:slug'] );
	unset( $routes['themes.php?page=demo-importer&browse=:sort'] );
	unset( $routes['themes.php?page=demo-importer&search=:query'] );
	unset( $routes['themes.php?page=demo-importer'] );

	// Add the new routes
	$routes['themes.php?page=colormag&tab=starter-templates&demo=:slug']    = 'preview';
	$routes['themes.php?page=colormag&tab=starter-templates&browse=:sort']  = 'sort';
	$routes['themes.php?page=colormag&tab=starter-templates&search=:query'] = 'search';
	$routes['themes.php?page=colormag&tab=starter-templates']               = 'sort';

	return $routes;
}

add_filter( 'themegrill_demo_importer_baseURL', 'colormag_demo_importer_baseURL', 10, 1 );

function colormag_demo_importer_baseURL( $base_url ) {
	// Update the base URL in the demo importer.
	$base_url = 'themes.php?page=colormag&tab=starter-templates';

	return $base_url;
}

add_filter( 'themegrill_demo_importer_redirect_link', 'colormag_demo_importer_redirect_url' );

function colormag_demo_importer_redirect_url( $redirect_url ) {
	// Update the base URL in the demo importer.
	$redirect_url = admin_url( 'themes.php?page=colormag&tab=starter-templates&browse=all' );

	return $redirect_url;
}

add_action( 'wp_ajax_install_plugin', 'colormag_plugin_action_callback' );
add_action( 'wp_ajax_activate_plugin', 'colormag_plugin_action_callback' );

function colormag_plugin_action_callback() {
	if ( ! isset( $_POST['security'] ) || ! wp_verify_nonce( $_POST['security'], 'colormag_demo_import_nonce' ) ) {
		wp_send_json_error( array( 'message' => 'Security check failed.' ) );
	}
	if ( ! current_user_can( 'install_plugins' ) ) {
		wp_send_json_error( array( 'message' => 'You are not allowed to perform this action.' ) );
	}

	$plugin      = sanitize_text_field( $_POST['plugin'] );
	$plugin_slug = sanitize_text_field( $_POST['slug'] );

	if ( colormag_is_plugin_installed( $plugin ) ) {
		if ( is_plugin_active( $plugin ) ) {
			wp_send_json_success( array( 'message' => 'Plugin is already activated.' ) );
		} else {
			// Activate the plugin
			$result = activate_plugin( $plugin );

			if ( is_wp_error( $result ) ) {
				wp_send_json_error( array( 'message' => 'Error activating the plugin.' ) );
			} else {
				wp_send_json_success( array( 'message' => 'Plugin activated successfully!' ) );
			}
		}
	} else {
		// Install and activate the plugin
		include_once ABSPATH . 'wp-admin/includes/plugin-install.php';
		include_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';
		$plugin_info = plugins_api( 'plugin_information', array( 'slug' => $plugin_slug ) );
		$upgrader    = new Plugin_Upgrader( new WP_Ajax_Upgrader_Skin() );
		$result      = $upgrader->install( $plugin_info->download_link );

		if ( is_wp_error( $result ) ) {
			wp_send_json_error( array( 'message' => 'Error installing the plugin.' ) );
		}

		$result = activate_plugin( $plugin );

		if ( is_wp_error( $result ) ) {
			wp_send_json_error( array( 'message' => 'Error activating the plugin.' ) );
		} else {
			wp_send_json_success( array( 'message' => 'Plugin installed and activated successfully!' ) );
		}
	}
}

function colormag_is_plugin_installed( $plugin_path ) {
	$plugins = get_plugins();
	return isset( $plugins[ $plugin_path ] );
}

add_action( 'after_setup_theme', 'colormag_set_content_width', 0 );

/**
 * $content_width global variable adjustment as per layout option.
 */
function colormag_content_width() {

	global $post;
	global $content_width;

	if ( $post ) {
		$layout_meta = get_post_meta( $post->ID, 'colormag_page_layout', true );
	}

	if ( is_home() ) {
		$queried_id  = get_option( 'page_for_posts' );
		$layout_meta = get_post_meta( $queried_id, 'colormag_page_layout', true );
	}

	if ( empty( $layout_meta ) || is_archive() || is_search() ) {
		$layout_meta = 'default_layout';
	}

	$colormag_default_sidebar_layout = get_theme_mod( 'colormag_default_sidebar_layout', 'right_sidebar' );
	$colormag_page_sidebar_layout    = get_theme_mod( 'colormag_page_sidebar_layout', 'right_sidebar' );
	$colormag_default_post_layout    = get_theme_mod( 'colormag_post_sidebar_layout', 'right_sidebar' );

	if ( 'default_layout' === $layout_meta ) {
		if ( is_page() ) {
			if ( 'no_sidebar_full_width' === $colormag_page_sidebar_layout ) {
				$content_width = 1140; /* pixels */
			}
		} elseif ( is_single() ) {
			if ( 'no_sidebar_full_width' === $colormag_default_post_layout ) {
				$content_width = 1140; /* pixels */
			}
		} elseif ( 'no_sidebar_full_width' === $colormag_default_sidebar_layout ) {
				$content_width = 1140; /* pixels */
		}
	} elseif ( 'no_sidebar_full_width' === $layout_meta ) {
			$content_width = 1140; /* pixels */
	}
}

add_action( 'template_redirect', 'colormag_content_width' );

/**
 * Detect plugin. For use on Front End only.
 */
require_once ABSPATH . 'wp-admin/includes/plugin.php';

function colormag_maybe_enable_builder() {

	if ( get_option( 'colormag_builder_migration' ) || get_option( 'colormag_maybe_enable_builder' ) ) {
		return true;
	}

	if ( get_option( 'colormag_free_major_update_customizer_migration_v1' ) || get_option( 'colormag_top_bar_options_migrate' ) || get_option( 'colormag_breadcrumb_options_migrate' ) || get_option( 'colormag_social_icons_control_migrate' ) ) {
		return false;
	}

	update_option( 'colormag_maybe_enable_builder', true );

	return true;
}

function colormag_fresh_install() {

	if ( get_option( 'colormag_free_major_update_customizer_migration_v1' ) || get_option( 'colormag_top_bar_options_migrate' ) || get_option( 'colormag_breadcrumb_options_migrate' ) || get_option( 'colormag_social_icons_control_migrate' ) ) {
		return false;
	}

	return true;
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 *
 * @since ColorMag 3.0.0
 */
function cm_customize_preview_js() {

	if ( colormag_maybe_enable_builder() ) {
		set_theme_mod( 'colormag_enable_builder', true );
		update_option( 'colormag_builder_migration', true );
	}

	$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

	wp_enqueue_script(
		'colormag-customizer-pre',
		get_assets_url() . '/inc/customizer/assets/js/cm-customize-preview.js',
		array(
			'customize-preview',
		),
		COLORMAG_THEME_VERSION,
		true
	);
}
add_action( 'customize_preview_init', 'cm_customize_preview_js' );

add_action(
	'customize_controls_enqueue_scripts',
	function () {
		add_filter(
			'customind_setting_data',
			function ( $data ) {
				$data['upgrade_notice']      = true;
				$data['upgrade_notice_text'] = __( 'Upgrade to ColorMag Pro for more features and customization options.', 'colormag' );
				$data['upgrade_notice_link'] = 'https://themegrill.com/pricing/?utm_medium=customizer-upsell&utm_source=colormag-theme&utm_campaign=upsell-button&utm_content=more-feature-in-pro';

				return $data;
			}
		);
	},
	11
);


// Add Google Fonts to block editor typography options
add_filter(
	'wp_theme_json_data_theme',
	function ( $json ) {

		if ( ! class_exists( 'WP_Theme_JSON_Data' ) || ! ( $json instanceof WP_Theme_JSON_Data ) ) {
			return $json;
		}
		$google_fonts = [
			[
				'name'       => 'DM Sans',
				'slug'       => 'dm-sans',
				'fontFamily' => 'DM Sans, sans-serif',
				'fontFace'   => [
					[
						'src'        => [
							'https://fonts.gstatic.com/s/dmsans/v15/rP2Hp2ywxg089UriCZOIHTWEBlw.woff2', // 400
							'https://fonts.gstatic.com/s/dmsans/v15/rP2Cp2ywxg089UriAWCrOBw.woff2', // 700
							'https://fonts.gstatic.com/s/dmsans/v15/rP2Hp2ywxg089UriCZOIHTWEBlw.woff2', // variable
						],
						'fontWeight' => '100 900',
						'fontStyle'  => 'normal',
						'fontFamily' => 'DM Sans',
					],
				],
			],
			[
				'name'       => 'Public Sans',
				'slug'       => 'public-sans',
				'fontFamily' => 'Public Sans, sans-serif',
				'fontFace'   => [
					[
						'src'        => [
							'https://fonts.gstatic.com/s/publicsans/v15/ijwOs5juQtsyLLR5jN4cxBEoRDf44uE.woff2', // 400
							'https://fonts.gstatic.com/s/publicsans/v15/ijwPs5juQtsyLLR5jN4cxBEoRDf44uE.woff2', // 700
							'https://fonts.gstatic.com/s/publicsans/v15/ijwOs5juQtsyLLR5jN4cxBEoRDf44uE.woff2', // variable
						],
						'fontWeight' => '100 900',
						'fontStyle'  => 'normal',
						'fontFamily' => 'Public Sans',
					],
				],
			],
			[
				'name'       => 'Roboto',
				'slug'       => 'roboto',
				'fontFamily' => 'Roboto, sans-serif',
				'fontFace'   => [
					[
						'src'        => [
							'https://fonts.gstatic.com/s/roboto/v30/KFOmCnqEu92Fr1Mu4mxM.woff2', // 400
							'https://fonts.gstatic.com/s/roboto/v30/KFOlCnqEu92Fr1MmWUlfBBc9.woff2', // 700
							'https://fonts.gstatic.com/s/roboto/v30/KFOjCnqEu92Fr1Mu51TjASc6CsE.woff2', // variable
						],
						'fontWeight' => '100 900',
						'fontStyle'  => 'normal',
						'fontFamily' => 'Roboto',
					],
				],
			],
			[
				'name'       => 'Segoe UI',
				'slug'       => 'segoe-ui',
				'fontFamily' => 'Segoe UI, Arial, sans-serif',
				'fontFace'   => [],
			],
		];

		$existing = $json->get_data()['settings']['typography']['fontFamilies']['theme'] ?? [];
		$json->update_with(
			[
				'version'  => 3,
				'settings' => [
					'typography' => [
						'fontFamilies' => [
							...$google_fonts,
							...$existing,
						],
					],
				],
			]
		);
		return $json;
	},
	10
);

// Enqueue Google Fonts in the block editor (all weights and variable fonts)
add_action(
	'enqueue_block_editor_assets',
	function () {
		wp_enqueue_style(
			'colormag-google-fonts',
			'https://fonts.googleapis.com/css2?family=DM+Sans:wght@100..900&family=Public+Sans:wght@100..900&family=Roboto:wght@100..900&display=swap',
			[],
			null
		);
	}
);

function colormag_typography_should_migrate() {
	// Default values for comparison
	$default_typography_presets   = '';
	$default_base_typography_body = array(
		'font-family'    => 'inherit',
		'font-weight'    => 'regular',
		'subsets'        => array( 'latin' ),
		'font-size'      => array(
			'desktop' => array(
				'size' => '15',
				'unit' => 'px',
			),
			'tablet'  => array(
				'size' => '',
				'unit' => 'px',
			),
			'mobile'  => array(
				'size' => '',
				'unit' => 'px',
			),
		),
		'line-height'    => array(
			'desktop' => array(
				'size' => '1.6',
				'unit' => '-',
			),
			'tablet'  => array(
				'size' => '',
				'unit' => '-',
			),
			'mobile'  => array(
				'size' => '',
				'unit' => '-',
			),
		),
		'letter-spacing' => array(
			'desktop' => array(
				'size' => '',
				'unit' => 'px',
			),
			'tablet'  => array(
				'size' => '',
				'unit' => 'px',
			),
			'mobile'  => array(
				'size' => '',
				'unit' => 'px',
			),
		),
	);

	$default_base_heading_typography = array(
		'font-family'    => 'inherit',
		'font-weight'    => 'regular',
		'subsets'        => array( 'latin' ),
		'line-height'    => array(
			'desktop' => array(
				'size' => '1.2',
				'unit' => '-',
			),
			'tablet'  => array(
				'size' => '',
				'unit' => '',
			),
			'mobile'  => array(
				'size' => '',
				'unit' => '',
			),
		),
		'letter-spacing' => array(
			'desktop' => array(
				'size' => '',
				'unit' => 'px',
			),
			'tablet'  => array(
				'size' => '',
				'unit' => 'px',
			),
			'mobile'  => array(
				'size' => '',
				'unit' => 'px',
			),
		),
		'font-style'     => 'normal',
		'text-transform' => 'none',
	);

	// Get current values
	$current_typography_presets      = get_theme_mod( 'colormag_typography_presets', $default_typography_presets );
	$current_base_typography_body    = get_theme_mod( 'colormag_base_typography', $default_base_typography_body );
	$current_base_heading_typography = get_theme_mod( 'colormag_headings_typography', $default_base_heading_typography );

	// Check if current values are different from default values
	$should_migrate = false;

	// Check typography presets
	if ( $current_typography_presets !== $default_typography_presets ) {
		$should_migrate = true;
	}

	// Check base typography body
	if ( $current_base_typography_body !== $default_base_typography_body ) {
		$should_migrate = true;
	}

	// Check base heading typography
	if ( $current_base_heading_typography !== $default_base_heading_typography ) {
		$should_migrate = true;
	}

	return $should_migrate;
}
