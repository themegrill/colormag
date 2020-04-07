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

	// Return if enqueueing is not enabled by the user.
	if ( false === apply_filters( 'colormag_enqueue_theme_assets', true ) ) {
		return;
	}

	$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

	// Using google font.
	wp_enqueue_style( 'colormag_google_fonts', '//fonts.googleapis.com/css?family=Open+Sans:400,600' );

	// Loads our main stylesheet.
	wp_enqueue_style( 'colormag_style', get_stylesheet_uri(), array(), COLORMAG_THEME_VERSION );

	// Load the dark color skin via theme options.
	if ( 'dark' == get_theme_mod( 'colormag_color_skin_setting', 'white' ) ) {
		wp_enqueue_style( 'colormag_dark_style', get_template_directory_uri() . '/dark.css', array(), COLORMAG_THEME_VERSION );
	}

	/**
	 * Adds JavaScript to pages with the comment form to support
	 * sites with threaded comments (when in use).
	 */
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// BxSlider JS.
	wp_enqueue_script( 'colormag-bxslider', COLORMAG_JS_URL . '/jquery.bxslider' . $suffix . '.js', array( 'jquery' ), COLORMAG_THEME_VERSION, true );

	// Sticky Menu.
	if ( 1 == get_theme_mod( 'colormag_primary_sticky_menu', 0 ) ) {
		wp_enqueue_script( 'colormag-sticky-menu', COLORMAG_JS_URL . '/sticky/jquery.sticky' . $suffix . '.js', array( 'jquery' ), COLORMAG_THEME_VERSION, true );
	}

	// News Ticker.
	if ( 1 == get_theme_mod( 'colormag_breaking_news', 0 ) ) {
		wp_enqueue_script( 'colormag-news-ticker', COLORMAG_JS_URL . '/news-ticker/jquery.newsTicker' . $suffix . '.js', array( 'jquery' ), COLORMAG_THEME_VERSION, true );
	}

	if ( 1 == get_theme_mod( 'colormag_featured_image_popup', 0 ) ) {
		// MagnificPopup JS.
		wp_enqueue_script( 'colormag-featured-image-popup', COLORMAG_JS_URL . '/magnific-popup/jquery.magnific-popup' . $suffix . '.js', array( 'jquery' ), COLORMAG_THEME_VERSION, true );

		// MagnificPopup CSS.
		wp_enqueue_style( 'colormag-featured-image-popup-css', COLORMAG_JS_URL . '/magnific-popup/magnific-popup' . $suffix . '.css', array(), COLORMAG_THEME_VERSION );
	}

	// Navigation JS.
	wp_enqueue_script( 'colormag-navigation', COLORMAG_JS_URL . '/navigation' . $suffix . '.js', array( 'jquery' ), COLORMAG_THEME_VERSION, true );

	// FontAwesome CSS.
	wp_enqueue_style( 'colormag-fontawesome', get_template_directory_uri() . '/fontawesome/css/font-awesome' . $suffix . '.css', array(), COLORMAG_THEME_VERSION );

	// FitVids JS.
	wp_enqueue_script( 'colormag-fitvids', COLORMAG_JS_URL . '/fitvids/jquery.fitvids' . $suffix . '.js', array( 'jquery' ), COLORMAG_THEME_VERSION, true );

	// HTML5Shiv for Lower IE versions.
	wp_enqueue_script( 'html5', COLORMAG_JS_URL . '/html5shiv' . $suffix . '.js', array(), COLORMAG_THEME_VERSION );
	wp_script_add_data( 'html5', 'conditional', 'lte IE 8' );

	// Skip link focus fix JS enqueue.
	wp_enqueue_script( 'colormag-skip-link-focus-fix', COLORMAG_JS_URL . '/skip-link-focus-fix' . $suffix . '.js', array(), COLORMAG_THEME_VERSION, true );

	// Theme custom JS.
	wp_enqueue_script( 'colormag-custom', COLORMAG_JS_URL . '/colormag-custom' . $suffix . '.js', array( 'jquery' ), COLORMAG_THEME_VERSION, true );

}

add_action( 'wp_enqueue_scripts', 'colormag_scripts_styles_method' );

/**
 * Enqueue image upload script for use within widgets.
 */
function colormag_image_uploader() {

	$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

	wp_enqueue_media();
	wp_enqueue_script( 'colormag-widget-image-upload', COLORMAG_JS_URL . '/image-uploader' . $suffix . '.js', false, COLORMAG_THEME_VERSION, true );

}

add_action( 'admin_enqueue_scripts', 'colormag_image_uploader' );

if ( ! function_exists( 'colormag_parse_css' ) ) :

	/**
	 * Parses CSS.
	 *
	 * @param array  $css_output Array of CSS.
	 * @param string $min_media  Min Media breakpoint.
	 * @param string $max_media  Max Media breakpoint.
	 *
	 * @return string Generated CSS.
	 */
	function colormag_parse_css( $css_output = array(), $min_media = '', $max_media = '' ) {

		$parse_css = '';
		if ( is_array( $css_output ) && count( $css_output ) > 0 ) {

			foreach ( $css_output as $selector => $properties ) {

				if ( null === $properties ) {
					break;
				}

				if ( ! count( $properties ) ) {
					continue;
				}

				$temp_parse_css   = $selector . '{';
				$properties_added = 0;

				foreach ( $properties as $property => $value ) {

					if ( '' === $value ) {
						continue;
					}

					$properties_added ++;
					$temp_parse_css .= $property . ':' . $value . ';';
				}

				$temp_parse_css .= '}';

				if ( $properties_added > 0 ) {
					$parse_css .= $temp_parse_css;
				}
			}

			if ( '' !== $parse_css && ( '' !== $min_media || '' !== $max_media ) ) {

				$media_css       = '@media ';
				$min_media_css   = '';
				$max_media_css   = '';
				$media_separator = '';

				if ( '' !== $min_media ) {
					$min_media_css = '(min-width:' . $min_media . 'px)';
				}
				if ( '' !== $max_media ) {
					$max_media_css = '(max-width:' . $max_media . 'px)';
				}
				if ( '' !== $min_media && '' !== $max_media ) {
					$media_separator = ' and ';
				}

				$media_css .= $min_media_css . $media_separator . $max_media_css . '{' . $parse_css . '}';

				return $media_css;

			}
		}

		return $parse_css;

	}

endif;
