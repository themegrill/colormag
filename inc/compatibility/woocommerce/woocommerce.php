<?php
/**
 * WooCommerce Compatibility File.
 *
 * @package    ThemeGrill
 * @subpackage Colormag
 * @since      Colormag 3.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * WooCommerce setup function.
 *
 * @link https://docs.woocommerce.com/document/third-party-custom-theme-compatibility/
 * @link https://github.com/woocommerce/woocommerce/wiki/Enabling-product-gallery-features-(zoom,-swipe,-lightbox)
 * @link https://github.com/woocommerce/woocommerce/wiki/Declaring-WooCommerce-support-in-themes
 *
 * @return void
 */
function colormag_woocommerce_setup() {

	// Adding the WooCommerce plugin support.
	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );

}

add_action( 'after_setup_theme', 'colormag_woocommerce_setup' );


/**
 * Filter body class for WooCommerce pages.
 *
 * @param array $classes CSS classes applied to the body tag.
 *
 * @return array Classes for WooCommerce pages.
 *
 * @since 2.2.8
 */
function colormag_woocommerce_body_class( $classes ) {

	$classes[] = 'woocommerce-active';

	$woocommerce_widgets_enabled            = get_theme_mod( 'colormag_woocommerce_sidebar_register_setting', 0 );
	$woocommerce_shop_page_layout           = get_theme_mod( 'colormag_woocmmerce_shop_page_layout', 'right_sidebar' );
	$woocommerce_archive_page_layout        = get_theme_mod( 'colormag_woocmmerce_archive_page_layout', 'right_sidebar' );
	$woocommerce_single_product_page_layout = get_theme_mod( 'colormag_woocmmerce_single_product_page_layout', 'right_sidebar' );

	if ( 1 == $woocommerce_widgets_enabled ) :
		if ( is_shop() ) {
			$classes[] = ColorMag_Utils::colormag_get_sidebar_layout_class( $woocommerce_shop_page_layout );
		} elseif ( is_product_category() || is_product_tag() ) {
			$classes[] = ColorMag_Utils::colormag_get_sidebar_layout_class( $woocommerce_archive_page_layout );
		} elseif ( is_product() ) {
			$classes[] = ColorMag_Utils::colormag_get_sidebar_layout_class( $woocommerce_single_product_page_layout );
		}
	endif;

	return $classes;

}

add_filter( 'body_class', 'colormag_woocommerce_body_class' );


if ( ! function_exists( 'colormag_woocommerce_sidebar_select' ) ) :

	/**
	 * Select different sidebars for WooCommerce pages as set by the user
	 * when extra WooCommerce widgets is enabled.
	 *
	 * @since 2.2.8
	 */
	function colormag_woocommerce_sidebar_select() {

		// Bail out if extra sidebar area for WooCommerce page is not activated.
		if ( 0 == get_theme_mod( 'colormag_woocommerce_sidebar_register_setting', 0 ) ) {
			return;
		}

		$woocommerce_shop_page_layout           = get_theme_mod( 'colormag_woocmmerce_shop_page_layout', 'right_sidebar' );
		$woocommerce_archive_page_layout        = get_theme_mod( 'colormag_woocmmerce_archive_page_layout', 'right_sidebar' );
		$woocommerce_single_product_page_layout = get_theme_mod( 'colormag_woocmmerce_single_product_page_layout', 'right_sidebar' );

		if ( is_shop() ) {
			ColorMag_Utils::colormag_get_sidebar( $woocommerce_shop_page_layout, false, 'woocommerce' );
		} elseif ( is_product_category() || is_product_tag() ) {
			ColorMag_Utils::colormag_get_sidebar( $woocommerce_archive_page_layout, false, 'woocommerce' );
		} elseif ( is_product() ) {
			ColorMag_Utils::colormag_get_sidebar( $woocommerce_single_product_page_layout, false, 'woocommerce' );
		}

	}

endif;


/**
 * Remove default WooCommerce wrapper.
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

// Remove default WooCommerce breadcrumb.
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );

// Remove WooCommerce default sidebar.
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );

// Disable the page title display for WooCommerce pages.
add_filter( 'woocommerce_show_page_title', '__return_false' );

/**
 * Before Content.
 *
 * Wraps all WooCommerce content in wrappers which match the theme markup.
 *
 * @return void
 */
function colormag_wrapper_start() {
	echo '<div id="cm-primary" class="cm-primary">';
}

add_action( 'woocommerce_before_main_content', 'colormag_wrapper_start', 10 );

/**
 * After Content.
 *
 * Closes the wrapping divs.
 *
 * @return void
 */
function colormag_wrapper_end() {
	echo '</div>';

	if ( 1 == get_theme_mod( 'colormag_woocommerce_sidebar_register_setting', 0 ) ) {
		colormag_woocommerce_sidebar_select();
	} else {
		colormag_sidebar_select();
	}
}

add_action( 'woocommerce_after_main_content', 'colormag_wrapper_end', 10 );


function colormag_is_wc_shop() {

	return ( is_shop() || is_product_taxonomy() || is_product_category() || is_product_tag() );
}

if ( ! function_exists( 'colormag_woocommerce_main_section_inner_end' ) ) :

	/**
	 *  Main section inner ends.
	 */
	function colormag_woocommerce_main_section_inner_end() {

		if ( colormag_is_wc_shop() || is_product() ) {

			echo '</div>';
		}
	}

endif;

add_action( 'colormag_action_after_inner_content', 'colormag_woocommerce_main_section_inner_end',11 );

if ( ! function_exists( 'colormag_woocommerce_main_section_inner_start' ) ) :

	/**
	 * Main section inner starts.
	 */
	function colormag_woocommerce_main_section_inner_start() {

		if ( colormag_is_wc_shop() || is_product() ) {

			echo '<div class="cm-row">';
		}
	}

endif;

add_action( 'colormag_action_before_inner_content', 'colormag_woocommerce_main_section_inner_start', 11 );

add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

function colormag_enqueue_wc_scripts() {

	wp_enqueue_style( 'colormag-woocommerce-style', get_template_directory_uri() . '/woocommerce.css', array( 'colormag_style' ), COLORMAG_THEME_VERSION );

	add_filter( 'colormag_dynamic_theme_wc_css', array( 'ColorMag_Dynamic_CSS', 'render_wc_output' ) );

	// Generate dynamic CSS to add inline styles for the theme.
	$theme_dynamic_css = apply_filters( 'colormag_dynamic_theme_wc_css', '' );

	wp_add_inline_style( 'colormag-woocommerce-style', $theme_dynamic_css );

	$font_path   = WC()->plugin_url() . '/assets/fonts/';
	$inline_font = '
	@font-face {
		font-family: "star";
		src: url("' . $font_path . 'star.eot");
		src: url("' . $font_path . 'star.eot?#iefix") format("embedded-opentype"),
			url("' . $font_path . 'star.woff") format("woff"),
			url("' . $font_path . 'star.ttf") format("truetype"),
			url("' . $font_path . 'star.svg#star") format("svg");
		font-weight: normal;
		font-style: normal;
	}
	@font-face {
		font-family: "WooCommerce";
		src: url("' . $font_path . 'WooCommerce.eot");
		src: url("' . $font_path . 'WooCommerce.eot?#iefix") format("embedded-opentype"),
			url("' . $font_path . 'WooCommerce.woff") format("woff"),
			url("' . $font_path . 'WooCommerce.ttf") format("truetype"),
			url("' . $font_path . 'WooCommerce.svg#star") format("svg");
		font-weight: normal;
		font-style: normal;
	}
	';

	wp_add_inline_style( 'colormag-woocommerce-style', $inline_font );
}
add_action( 'wp_enqueue_scripts', 'colormag_enqueue_wc_scripts', 11 );

/**
 * Opening element for filter wrapper at the top of WC pages.
 *
 * @since 1.0.0
 *
 * @return void
	 */
function colormag_woocommerce_filter_wrapper_before() {
		echo '<div class="cm-wc-filter">';
}

/**
 * Closing element for filter wrapper at the top of WC pages.
 *
 * @since 1.0.0
 *
 * @return void
 */
function colormag_woocommerce_filter_wrapper_after() {
	echo '</div><!-- /.cm-wc-filter -->';
}

// Add filter wrapper.
add_action( 'woocommerce_before_shop_loop', 'colormag_woocommerce_filter_wrapper_before', 10 );
add_action( 'woocommerce_before_shop_loop', 'colormag_woocommerce_filter_wrapper_after', 30 );
