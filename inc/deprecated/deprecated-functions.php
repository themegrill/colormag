<?php
/**
 * Deprecated functions for ColorMag theme.
 *
 * @package    ThemeGrill
 * @subpackage ColorMag
 * @since      ColorMag 2.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'colormag_the_custom_logo' ) ) :

	/**
	 * Deprecated function to display the custom logo.
	 */
	function colormag_the_custom_logo() {

		_deprecated_function( __FUNCTION__, '2.0.0', 'the_custom_logo()' );

		the_custom_logo();

	}

endif;


if ( ! function_exists( 'colormag_render_header_image' ) ) :

	/**
	 * Deprecated function to display the header image.
	 */
	function colormag_render_header_image() {

		_deprecated_function( __FUNCTION__, '2.0.0', 'the_custom_header_markup()' );

		the_custom_header_markup();

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

		_deprecated_function( __FUNCTION__, '2.0.0', 'ColorMag_Customizer_Sanitizes::sanitize_radio_select( $input, $setting )' );

		return ColorMag_Customizer_Sanitizes::sanitize_radio_select( $input, $setting );

	}

endif;


if ( ! function_exists( 'colormag_related_posts_sanitize' ) ) :

	/**
	 * Deprecate function for radio/select sanitization.
	 *
	 * @param string               $input   Input from the customize controls.
	 * @param WP_Customize_Setting $setting Setting instance.
	 */
	function colormag_related_posts_sanitize( $input, $setting = array() ) {

		_deprecated_function( __FUNCTION__, '2.0.0', 'ColorMag_Customizer_Sanitizes::sanitize_radio_select( $input, $setting )' );

		return ColorMag_Customizer_Sanitizes::sanitize_radio_select( $input, $setting );

	}

endif;


if ( ! function_exists( 'colormag_show_radio_saniztize' ) ) :

	/**
	 * Deprecate function for radio/select sanitization.
	 *
	 * @param string               $input   Input from the customize controls.
	 * @param WP_Customize_Setting $setting Setting instance.
	 */
	function colormag_show_radio_saniztize( $input, $setting = array() ) {

		_deprecated_function( __FUNCTION__, '2.0.0', 'ColorMag_Customizer_Sanitizes::sanitize_radio_select( $input, $setting )' );

		return ColorMag_Customizer_Sanitizes::sanitize_radio_select( $input, $setting );

	}

endif;


if ( ! function_exists( 'colormag_header_image_position_sanitize' ) ) :

	/**
	 * Deprecate function for radio/select sanitization.
	 *
	 * @param string               $input   Input from the customize controls.
	 * @param WP_Customize_Setting $setting Setting instance.
	 */
	function colormag_header_image_position_sanitize( $input, $setting = array() ) {

		_deprecated_function( __FUNCTION__, '2.0.0', 'ColorMag_Customizer_Sanitizes::sanitize_radio_select( $input, $setting )' );

		return ColorMag_Customizer_Sanitizes::sanitize_radio_select( $input, $setting );

	}

endif;


if ( ! function_exists( 'colormag_site_layout_sanitize' ) ) :

	/**
	 * Deprecate function for radio/select sanitization.
	 *
	 * @param string               $input   Input from the customize controls.
	 * @param WP_Customize_Setting $setting Setting instance.
	 */
	function colormag_site_layout_sanitize( $input, $setting = array() ) {

		_deprecated_function( __FUNCTION__, '2.0.0', 'ColorMag_Customizer_Sanitizes::sanitize_radio_select( $input, $setting )' );

		return ColorMag_Customizer_Sanitizes::sanitize_radio_select( $input, $setting );

	}

endif;


if ( ! function_exists( 'colormag_layout_sanitize' ) ) :

	/**
	 * Deprecate function for radio/select sanitization.
	 *
	 * @param string               $input   Input from the customize controls.
	 * @param WP_Customize_Setting $setting Setting instance.
	 */
	function colormag_layout_sanitize( $input, $setting = array() ) {

		_deprecated_function( __FUNCTION__, '2.0.0', 'ColorMag_Customizer_Sanitizes::sanitize_radio_select( $input, $setting )' );

		return ColorMag_Customizer_Sanitizes::sanitize_radio_select( $input, $setting );

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

		_deprecated_function( __FUNCTION__, '2.0.0', 'ColorMag_Customizer_Sanitizes::sanitize_hex_color( $color )' );

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
		_deprecated_function( __FUNCTION__, '2.0.0' );
	}

endif;


if ( ! function_exists( 'colormag_checkbox_sanitize' ) ) :

	/**
	 * Deprecate function for checkbox sanitization.
	 *
	 * @param string $input Input from the customize controls.
	 */
	function colormag_checkbox_sanitize( $input ) {

		_deprecated_function( __FUNCTION__, '2.0.0', 'ColorMag_Customizer_Sanitizes::sanitize_checkbox( $input )' );

		return ColorMag_Customizer_Sanitizes::sanitize_checkbox( $input );

	}

endif;


if ( ! function_exists( 'colormag_links_sanitize' ) ) :

	/**
	 * Deprecate function for false value sanitization.
	 */
	function colormag_links_sanitize() {

		_deprecated_function( __FUNCTION__, '2.0.0', 'ColorMag_Customizer_Sanitizes::sanitize_false_values()' );

		return ColorMag_Customizer_Sanitizes::sanitize_false_values();

	}

endif;


if ( ! function_exists( 'colormag_customize_partial_blogname' ) ) :

	/**
	 * Deprecate site title partial refresh function.
	 */
	function colormag_customize_partial_blogname() {

		_deprecated_function( __FUNCTION__, '2.0.0', 'ColorMag_Customizer_Partials::render_customize_partial_blogname()' );

		ColorMag_Customizer_Partials::render_customize_partial_blogname();

	}

endif;


if ( ! function_exists( 'colormag_customize_partial_blogdescription' ) ) :

	/**
	 * Deprecate site tagline partial refresh function.
	 */
	function colormag_customize_partial_blogdescription() {

		_deprecated_function( __FUNCTION__, '2.0.0', 'ColorMag_Customizer_Partials::render_customize_partial_blogdescription()' );

		ColorMag_Customizer_Partials::render_customize_partial_blogdescription();

	}

endif;


if ( ! function_exists( 'colormag_date_display_type' ) ) :

	/**
	 * Deprecate date display type refresh function.
	 */
	function colormag_date_display_type() {

		_deprecated_function( __FUNCTION__, '2.0.0', 'ColorMag_Customizer_Partials::render_date_display_type()' );

		ColorMag_Customizer_Partials::render_date_display_type();

	}

endif;
