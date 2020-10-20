<?php
/**
 * Helper class for font settings for this theme.
 *
 * Class ColorMag_Fonts
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
 * Helper class for font settings for this theme.
 *
 * Class ColorMag_Fonts
 */
class ColorMag_Fonts {

	/**
	 * System Fonts
	 *
	 * @var array
	 */
	public static $system_fonts = array();

	/**
	 * Google Fonts
	 *
	 * @var array
	 */
	public static $google_fonts = array();

	/**
	 * Custom Fonts
	 *
	 * @var array
	 */
	public static $custom_fonts = array();

	/**
	 * Font variants
	 *
	 * @var array
	 */
	public static $font_variants = array();

	/**
	 * Google font subsets
	 *
	 * @var array
	 */
	public static $google_font_subsets = array();

	/**
	 * Get system fonts.
	 *
	 * @return mixed|void
	 */
	public static function get_system_fonts() {

		if ( empty( self::$system_fonts ) ) :

			self::$system_fonts = array(

				'default'                                                                                                                              => array(
					'family' => 'default',
					'label'  => 'Default',
				),
				'Georgia,Times,"Times New Roman",serif'                                                                                                 => array(
					'family' => 'Georgia,Times,"Times New Roman",serif',
					'label'  => 'serif',
				),
				'-apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", Helvetica, Arial, sans-serif' => array(
					'family' => '-apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", Helvetica, Arial, sans-serif',
					'label'  => 'sans-serif',
				),
				'Monaco,"Lucida Sans Typewriter","Lucida Typewriter","Courier New",Courier,monospace'                                                   => array(
					'family' => 'Monaco,"Lucida Sans Typewriter","Lucida Typewriter","Courier New",Courier,monospace',
					'label'  => 'monospace',
				),

			);

		endif;

		return apply_filters( 'colormag_system_fonts', self::$system_fonts );

	}

	/**
	 * Get Google fonts.
	 * It's array is generated from the google-fonts.json file.
	 *
	 * @return mixed|void
	 */
	public static function get_google_fonts() {

		if ( empty( self::$google_fonts ) ) :

			global $wp_filesystem;
			$google_fonts_file = apply_filters( 'colormag_google_fonts_json_file', COLORMAG_CUSTOMIZER_DIR . '/custom-controls/typography/google-fonts.json' );

			if ( ! file_exists( COLORMAG_CUSTOMIZER_DIR . '/custom-controls/typography/google-fonts.json' ) ) {
				return array();
			}

			// Require `file.php` file of WordPress to include filesystem check for getting the file contents.
			if ( ! $wp_filesystem ) {
				require_once ABSPATH . '/wp-admin/includes/file.php';
			}

			// Proceed only if the file is readable.
			if ( is_readable( $google_fonts_file ) ) {
				WP_Filesystem();

				$file_contents     = $wp_filesystem->get_contents( $google_fonts_file );
				$google_fonts_json = json_decode( $file_contents, 1 );

				foreach ( $google_fonts_json['items'] as $key => $font ) {

					$google_fonts[ $font['family'] ] = array(
						'family'   => $font['family'],
						'label'    => $font['family'],
						'variants' => $font['variants'],
						'subsets'  => $font['subsets'],
					);

					self::$google_fonts = $google_fonts;

				}
			}

		endif;

		return apply_filters( 'colormag_system_fonts', self::$google_fonts );

	}

	/**
	 * Get custom fonts.
	 *
	 * @return mixed|void
	 */
	public static function get_custom_fonts() {

		return apply_filters( 'colormag_custom_fonts', self::$custom_fonts );

	}

	/**
	 * Get font variants.
	 *
	 * @return mixed|void
	 */
	public static function get_font_variants() {

		if ( empty( self::$font_variants ) ) :

			self::$font_variants = array(
				'100'       => esc_html__( 'Thin 100', 'colormag' ),
				'100italic' => esc_html__( 'Thin 100 Italic', 'colormag' ),
				'200'       => esc_html__( 'Extra-Light 200', 'colormag' ),
				'200italic' => esc_html__( 'Extra-Light 200 Italic', 'colormag' ),
				'300'       => esc_html__( 'Light 300', 'colormag' ),
				'300italic' => esc_html__( 'Light 300 Italic', 'colormag' ),
				'regular'   => esc_html__( 'Regular 400', 'colormag' ),
				'italic'    => esc_html__( 'Regular 400 Italic', 'colormag' ),
				'500'       => esc_html__( 'Medium 500', 'colormag' ),
				'500italic' => esc_html__( 'Medium 500 Italic', 'colormag' ),
				'600'       => esc_html__( 'Semi-Bold 600', 'colormag' ),
				'600italic' => esc_html__( 'Semi-Bold 600 Italic', 'colormag' ),
				'700'       => esc_html__( 'Bold 700', 'colormag' ),
				'700italic' => esc_html__( 'Bold 700 Italic', 'colormag' ),
				'800'       => esc_html__( 'Extra-Bold 800', 'colormag' ),
				'800italic' => esc_html__( 'Extra-Bold 800 Italic', 'colormag' ),
				'900'       => esc_html__( 'Black 900', 'colormag' ),
				'900italic' => esc_html__( 'Black 900 Italic', 'colormag' ),
			);

		endif;

		return apply_filters( 'colormag_font_variants', self::$font_variants );

	}

	/**
	 * Get Google font subsets.
	 *
	 * @return mixed|void
	 */
	public static function get_google_font_subsets() {

		if ( empty( self::$google_font_subsets ) ) :

			self::$google_font_subsets = array(
				'arabic'              => esc_html__( 'Arabic', 'colormag' ),
				'bengali'             => esc_html__( 'Bengali', 'colormag' ),
				'chinese-hongkong'    => esc_html__( 'Chinese (Hong Kong)', 'colormag' ),
				'chinese-simplified'  => esc_html__( 'Chinese (Simplified)', 'colormag' ),
				'chinese-traditional' => esc_html__( 'Chinese (Traditional)', 'colormag' ),
				'cyrillic'            => esc_html__( 'Cyrillic', 'colormag' ),
				'cyrillic-ext'        => esc_html__( 'Cyrillic Extended', 'colormag' ),
				'devanagari'          => esc_html__( 'Devanagari', 'colormag' ),
				'greek'               => esc_html__( 'Greek', 'colormag' ),
				'greek-ext'           => esc_html__( 'Greek Extended', 'colormag' ),
				'gujarati'            => esc_html__( 'Gujarati', 'colormag' ),
				'gurmukhi'            => esc_html__( 'Gurmukhi', 'colormag' ),
				'hebrew'              => esc_html__( 'Hebrew', 'colormag' ),
				'japanese'            => esc_html__( 'Japanese', 'colormag' ),
				'kannada'             => esc_html__( 'Kannada', 'colormag' ),
				'khmer'               => esc_html__( 'Khmer', 'colormag' ),
				'korean'              => esc_html__( 'Korean', 'colormag' ),
				'latin'               => esc_html__( 'Latin', 'colormag' ),
				'latin-ext'           => esc_html__( 'Latin Extended', 'colormag' ),
				'malayalam'           => esc_html__( 'Malayalam', 'colormag' ),
				'myanmar'             => esc_html__( 'Myanmar', 'colormag' ),
				'oriya'               => esc_html__( 'Oriya', 'colormag' ),
				'sinhala'             => esc_html__( 'Sinhala', 'colormag' ),
				'tamil'               => esc_html__( 'Tamil', 'colormag' ),
				'telugu'              => esc_html__( 'Telugu', 'colormag' ),
				'thai'                => esc_html__( 'Thai', 'colormag' ),
				'tibetan'             => esc_html__( 'Tibetan', 'colormag' ),
				'vietnamese'          => esc_html__( 'Vietnamese', 'colormag' ),
			);

		endif;

		return apply_filters( 'colormag_font_variants', self::$google_font_subsets );

	}

}
