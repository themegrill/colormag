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
 * Calling in the admin area for the Welcome Page as well as for the new theme notice too.
 */
if ( is_admin() ) {
	require get_template_directory() . '/inc/admin/class-colormag-admin.php';
	require get_template_directory() . '/inc/admin/class-colormag-dashboard.php';
	require get_template_directory() . '/inc/admin/class-colormag-welcome-notice.php';
	require get_template_directory() . '/inc/admin/class-colormag-theme-review-notice.php';
}

///** ColorMag setup file, hooked for `after_setup_theme`. */
//require COLORMAG_INCLUDES_DIR . '/colormag-setup.php';

/**
 * Base.
 */
// Generate WordPress filter hook dynamically.
require COLORMAG_INCLUDES_DIR . '/base/class-colormag-dynamic-filter.php';

// Generate dynamic CSS from styling options.
require_once COLORMAG_INCLUDES_DIR . '/base/class-colormag-dynamic-css.php';

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
require COLORMAG_INCLUDES_DIR . '/template-functions.php';

// Svg icon class.
require COLORMAG_INCLUDES_DIR . '/class-colormag-svg-icons.php';

//Template hooks.
require COLORMAG_PARENT_DIR . '/template-parts/hooks/hook-functions.php';

require COLORMAG_PARENT_DIR . '/template-parts/hooks/header/header.php';
require COLORMAG_PARENT_DIR . '/template-parts/hooks/header/header-main.php';
require COLORMAG_PARENT_DIR . '/template-parts/hooks/header/top-bar.php';

require COLORMAG_PARENT_DIR . '/template-parts/hooks/content/content.php';

require COLORMAG_PARENT_DIR . '/template-parts/hooks/footer/footer.php';

/** WP_Query functions files. */
require COLORMAG_INCLUDES_DIR . '/colormag-wp-query.php';

/** Breadcrumb class. */
require_once COLORMAG_INCLUDES_DIR . '/class-breadcrumb-trail.php';

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

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 *
 * @since ColorMag 3.0.0
 */
function cm_customize_preview_js() {

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

function get_assets_url() {
	// Get correct URL and path to wp-content.
	$content_url = untrailingslashit( dirname( dirname( get_stylesheet_directory_uri() ) ) );
	$content_dir = wp_normalize_path( untrailingslashit( WP_CONTENT_DIR ) );

	$url = str_replace( $content_dir, $content_url, wp_normalize_path( __DIR__ ) );
	$url = set_url_scheme( $url );

	return $url;
}

add_action( 'customize_preview_init', 'cm_customize_preview_js' );

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

	$colormag_default_sidebar_layout      = get_theme_mod( 'colormag_default_sidebar_layout', 'right_sidebar' );
	$colormag_page_sidebar_layout = get_theme_mod( 'colormag_page_sidebar_layout', 'right_sidebar' );
	$colormag_default_post_layout = get_theme_mod( 'colormag_post_sidebar_layout', 'right_sidebar' );

	if ( 'default_layout' === $layout_meta ) {
		if ( is_page() ) {
			if ( 'no_sidebar_full_width' === $colormag_page_sidebar_layout ) {
				$content_width = 1140; /* pixels */
			}
		} elseif ( is_single() ) {
			if ( 'no_sidebar_full_width' === $colormag_default_post_layout ) {
				$content_width = 1140; /* pixels */
			}
		} else {
			if ( 'no_sidebar_full_width' === $colormag_default_sidebar_layout ) {
				$content_width = 1140; /* pixels */
			}
		}
	} else {
		if ( 'no_sidebar_full_width' === $layout_meta ) {
			$content_width = 1140; /* pixels */
		}
	}

}

add_action( 'template_redirect', 'colormag_content_width' );

/**
 * Detect plugin. For use on Front End only.
 */
include_once ABSPATH . 'wp-admin/includes/plugin.php';
