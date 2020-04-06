<?php
/**
 * ColorMag enqueue CSS and JS files.
 *
 * @package    ThemeGrill
 * @subpackage ColorMag
 * @since      ColorMag 2.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
 * Enqueue CSS and JS files.
 */
function colormag_scripts_styles_method() {

	// Using google font.
	wp_enqueue_style( 'colormag_google_fonts', '//fonts.googleapis.com/css?family=Open+Sans:400,600' );

	// Loads our main stylesheet.
	wp_enqueue_style( 'colormag_style', get_stylesheet_uri() );

	// Load the dark color skin via theme options.
	if ( get_theme_mod( 'colormag_color_skin_setting', 'white' ) == 'dark' ) {
		wp_enqueue_style( 'colormag_dark_style', get_template_directory_uri() . '/dark.css' );
	}

	/**
	 * Adds JavaScript to pages with the comment form to support
	 * sites with threaded comments (when in use).
	 */
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// BxSlider JS.
	wp_enqueue_script( 'colormag-bxslider', COLORMAG_JS_URL . '/jquery.bxslider.min.js', array( 'jquery' ), '4.2.10', true );

	// News Ticker.
	if ( 1 == get_theme_mod( 'colormag_breaking_news', 0 ) ) {
		wp_enqueue_script( 'colormag-news-ticker', COLORMAG_JS_URL . '/news-ticker/jquery.newsTicker.min.js', array( 'jquery' ), '1.0.0', true );
	}

	// Sticky Menu.
	if ( 1 == get_theme_mod( 'colormag_primary_sticky_menu', 0 ) ) {
		wp_enqueue_script( 'colormag-sticky-menu', COLORMAG_JS_URL . '/sticky/jquery.sticky.js', array( 'jquery' ), '20150309', true );
	}

	// Navigation JS.
	wp_enqueue_script( 'colormag-navigation', COLORMAG_JS_URL . '/navigation.js', array( 'jquery' ), false, true );

	// FontAwesome CSS.
	wp_enqueue_style( 'colormag-fontawesome', get_template_directory_uri() . '/fontawesome/css/font-awesome.css', array(), '4.2.1' );

	if ( 1 == get_theme_mod( 'colormag_featured_image_popup', 0 ) ) {
		// MagnificPopup JS.
		wp_enqueue_script( 'colormag-featured-image-popup', COLORMAG_JS_URL . '/magnific-popup/jquery.magnific-popup.min.js', array( 'jquery' ), '20150310', true );

		// MagnificPopup CSS.
		wp_enqueue_style( 'colormag-featured-image-popup-css', COLORMAG_JS_URL . '/magnific-popup/magnific-popup.css', array(), '20150310' );
	}

	// FitVids JS.
	wp_enqueue_script( 'colormag-fitvids', COLORMAG_JS_URL . '/fitvids/jquery.fitvids.js', array( 'jquery' ), '20150311', true );

	// HTML5Shiv for Lower IE versions.
	wp_enqueue_script( 'html5', COLORMAG_JS_URL . '/html5shiv.min.js' );
	wp_script_add_data( 'html5', 'conditional', 'lte IE 8' );

	// Skip link focus fix JS enqueue.
	wp_enqueue_script( 'colormag-skip-link-focus-fix', COLORMAG_JS_URL . '/skip-link-focus-fix.js', array(), false, true );

	// Theme custom JS.
	wp_enqueue_script( 'colormag-custom', COLORMAG_JS_URL . '/colormag-custom.js', array( 'jquery' ), false, true );

}

add_action( 'wp_enqueue_scripts', 'colormag_scripts_styles_method' );
