<?php
/**
 * Helper class for font settings for this theme.
 *
 * Class ColorMag_Fonts
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
	 * Get system fonts.
	 *
	 * @return mixed|void
	 */
	public static function get_system_fonts() {

		if ( empty( self::$system_fonts ) ) :

			self::$system_fonts = array(

				'serif'      => array(
					'fallback' => 'Georgia,Times,"Times New Roman",serif',
				),
				'sans-serif' => array(
					'fallback' => '-apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", Helvetica, Arial, sans-serif',
				),
				'monospace'  => array(
					'fallback' => 'Monaco,"Lucida Sans Typewriter","Lucida Typewriter","Courier New",Courier,monospace',
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

}
