<?php
/**
 * Deprecated functions for ColorMag theme.
 *
 * @package    ThemeGrill
 * @subpackage ColorMag
 * @since      ColorMag 3.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'colormag_colored_category_return' ) ) :

	/**
	 * Deprecated function to return the colored category.
	 */
	function colormag_colored_category_return() {

		_deprecated_function( __FUNCTION__, '3.0.0', 'colormag_colored_category( false )' );

		return colormag_colored_category( false );

	}

endif;


if ( ! function_exists( 'colormag_the_custom_logo' ) ) :

	/**
	 * Deprecated function to display the custom logo.
	 */
	function colormag_the_custom_logo() {

		_deprecated_function( __FUNCTION__, '3.0.0', 'the_custom_logo()' );

		the_custom_logo();

	}

endif;


if ( ! function_exists( 'colormag_render_header_image' ) ) :

	/**
	 * Deprecated function to display the header image.
	 */
	function colormag_render_header_image() {

		_deprecated_function( __FUNCTION__, '3.0.0', 'the_custom_header_markup()' );

		the_custom_header_markup();

	}

endif;


if ( ! function_exists( 'colormag_standard_fonts_array' ) ) :

	/**
	 * Deprecated function standard fonts array.
	 */
	function colormag_standard_fonts_array() {
		_deprecated_function( __FUNCTION__, '3.0.0' );
	}

endif;


if ( ! function_exists( 'colormag_google_fonts_array' ) ) :

	/**
	 * Deprecated function Google fonts array.
	 */
	function colormag_google_fonts_array() {
		_deprecated_function( __FUNCTION__, '3.0.0' );
	}

endif;


if ( ! function_exists( 'colormag_radio_select_sanitize' ) ) :

	/**
	 * Deprecate function for radio/select sanitization.
	 *
	 * @param string               $input   Input from the customize controls.
	 * @param WP_Customize_Setting $setting Setting instance.
	 */
	function colormag_radio_select_sanitize( $input, $setting ) {

		_deprecated_function( __FUNCTION__, '3.0.0', 'ColorMag_Customizer_Sanitizes::sanitize_radio_select( $input, $setting )' );

		return ColorMag_Customizer_Sanitizes::sanitize_radio_select( $input, $setting );

	}

endif;


if ( ! function_exists( 'colormag_fonts_sanitization' ) ) :

	/**
	 * Deprecate function for radio/select sanitization.
	 *
	 * @param string $input Customizer input.
	 */
	function colormag_fonts_sanitization( $input ) {
		_deprecated_function( __FUNCTION__, '3.0.0' );
	}

endif;


if ( ! function_exists( 'colormag_color_option_hex_sanitize' ) ) :

	/**
	 * Deprecate function for hex color sanitization.
	 *
	 * @param string $color Input from the customize controls.
	 *
	 * @return string
	 */
	function colormag_color_option_hex_sanitize( $color ) {

		_deprecated_function( __FUNCTION__, '3.0.0', 'ColorMag_Customizer_Sanitizes::sanitize_hex_color( $color )' );

		return ColorMag_Customizer_Sanitizes::sanitize_hex_color( $color );

	}

endif;


if ( ! function_exists( 'colormag_color_escaping_option_sanitize' ) ) :

	/**
	 * Deprecate function for color escaping sanitization.
	 *
	 * @param string $input Input from the customize controls.
	 */
	function colormag_color_escaping_option_sanitize( $input ) {
		_deprecated_function( __FUNCTION__, '3.0.0' );
	}

endif;


if ( ! function_exists( 'colormag_checkbox_sanitize' ) ) :

	/**
	 * Deprecate function for checkbox sanitization.
	 *
	 * @param string $input Input from the customize controls.
	 */
	function colormag_checkbox_sanitize( $input ) {

		_deprecated_function( __FUNCTION__, '3.0.0', 'ColorMag_Customizer_Sanitizes::sanitize_checkbox( $input )' );

		return ColorMag_Customizer_Sanitizes::sanitize_checkbox( $input );

	}

endif;


if ( ! function_exists( 'colormag_links_sanitize' ) ) :

	/**
	 * Deprecate function for false value sanitization.
	 */
	function colormag_links_sanitize() {

		_deprecated_function( __FUNCTION__, '3.0.0', 'ColorMag_Customizer_Sanitizes::sanitize_false_values()' );

		return ColorMag_Customizer_Sanitizes::sanitize_false_values();

	}

endif;


if ( ! function_exists( 'colormag_excerpt_length_sanitize' ) ) :

	/**
	 * Deprecate function for number sanitization.
	 *
	 * @param string               $val     Input from the customize controls.
	 * @param WP_Customize_Setting $setting Setting instance.
	 */
	function colormag_excerpt_length_sanitize( $val, $setting = array() ) {

		_deprecated_function( __FUNCTION__, '3.0.0', 'ColorMag_Customizer_Sanitizes::sanitize_number( $val, $setting )' );

		return ColorMag_Customizer_Sanitizes::sanitize_number( $val, $setting );

	}

endif;


if ( ! function_exists( 'colormag_news_ticker_animation_duration_sanitize' ) ) :

	/**
	 * Deprecate function for number sanitization.
	 *
	 * @param string               $val     Input from the customize controls.
	 * @param WP_Customize_Setting $setting Setting instance.
	 */
	function colormag_news_ticker_animation_duration_sanitize( $val, $setting = array() ) {

		_deprecated_function( __FUNCTION__, '3.0.0', 'ColorMag_Customizer_Sanitizes::sanitize_number( $val, $setting )' );

		return ColorMag_Customizer_Sanitizes::sanitize_number( $val, $setting );

	}

endif;


if ( ! function_exists( 'colormag_news_ticker_animation_speed_sanitize' ) ) :

	/**
	 * Deprecate function for number sanitization.
	 *
	 * @param string               $val     Input from the customize controls.
	 * @param WP_Customize_Setting $setting Setting instance.
	 */
	function colormag_news_ticker_animation_speed_sanitize( $val, $setting = array() ) {

		_deprecated_function( __FUNCTION__, '3.0.0', 'ColorMag_Customizer_Sanitizes::sanitize_number( $val, $setting )' );

		return ColorMag_Customizer_Sanitizes::sanitize_number( $val, $setting );

	}

endif;


if ( ! function_exists( 'colormag_footer_editor_sanitize' ) ) :

	/**
	 * Deprecate function for footer copyright sanitization.
	 *
	 * @param string $input Input from the customize controls.
	 */
	function colormag_footer_editor_sanitize( $input ) {

		_deprecated_function( __FUNCTION__, '3.0.0', 'ColorMag_Customizer_Sanitizes::sanitize_html( $input )' );

		return ColorMag_Customizer_Sanitizes::sanitize_html( $input );

	}

endif;


if ( ! function_exists( 'colormag_customize_partial_blogname' ) ) :

	/**
	 * Deprecate site title partial refresh function.
	 */
	function colormag_customize_partial_blogname() {

		_deprecated_function( __FUNCTION__, '3.0.0', 'ColorMag_Customizer_Partials::render_customize_partial_blogname()' );

		ColorMag_Customizer_Partials::render_customize_partial_blogname();

	}

endif;


if ( ! function_exists( 'colormag_customize_partial_blogdescription' ) ) :

	/**
	 * Deprecate site tagline partial refresh function.
	 */
	function colormag_customize_partial_blogdescription() {

		_deprecated_function( __FUNCTION__, '3.0.0', 'ColorMag_Customizer_Partials::render_customize_partial_blogdescription()' );

		ColorMag_Customizer_Partials::render_customize_partial_blogdescription();

	}

endif;


if ( ! function_exists( 'colormag_date_display_type' ) ) :

	/**
	 * Deprecate date display type refresh function.
	 */
	function colormag_date_display_type() {

		_deprecated_function( __FUNCTION__, '3.0.0', 'ColorMag_Customizer_Partials::render_date_display_type()' );

		ColorMag_Customizer_Partials::render_date_display_type();

	}

endif;


if ( ! function_exists( 'colormag_breaking_news_content' ) ) :

	/**
	 * Deprecate breaking news content refresh function.
	 */
	function colormag_breaking_news_content() {

		_deprecated_function( __FUNCTION__, '3.0.0', 'ColorMag_Customizer_Partials::render_breaking_news_text()' );

		ColorMag_Customizer_Partials::render_breaking_news_text();

	}

endif;


if ( ! function_exists( 'colormag_read_next_text' ) ) :

	/**
	 * Deprecate read next text refresh function.
	 */
	function colormag_read_next_text() {

		_deprecated_function( __FUNCTION__, '3.0.0', 'ColorMag_Customizer_Partials::render_read_next_text()' );

		ColorMag_Customizer_Partials::render_read_next_text();

	}

endif;


if ( ! function_exists( 'colormag_view_all_button_text' ) ) :

	/**
	 * Deprecate view all text refresh function.
	 */
	function colormag_view_all_button_text() {

		_deprecated_function( __FUNCTION__, '3.0.0', 'ColorMag_Customizer_Partials::render_view_all_button_text()' );

		ColorMag_Customizer_Partials::render_view_all_button_text();

	}

endif;


if ( ! function_exists( 'colormag_you_may_also_like_text' ) ) :

	/**
	 * Deprecate you may also like refresh function.
	 */
	function colormag_you_may_also_like_text() {

		_deprecated_function( __FUNCTION__, '3.0.0', 'ColorMag_Customizer_Partials::render_you_may_also_like_text()' );

		ColorMag_Customizer_Partials::render_you_may_also_like_text();

	}

endif;


if ( ! function_exists( 'colormag_featured_image_caption_display' ) ) :

	/**
	 * Deprecate featured image caption display refresh function.
	 */
	function colormag_featured_image_caption_display() {

		_deprecated_function( __FUNCTION__, '3.0.0', 'ColorMag_Customizer_Partials::render_featured_image_caption()' );

		ColorMag_Customizer_Partials::render_featured_image_caption();

	}

endif;


if ( ! function_exists( 'colormag_background_image' ) ) :

	/**
	 * Deprecate background image refresh function.
	 */
	function colormag_background_image() {
		_deprecated_function( __FUNCTION__, '3.0.0' );
	}

endif;
