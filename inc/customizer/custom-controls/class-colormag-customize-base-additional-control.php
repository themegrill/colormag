<?php
/**
 * ColorMag customizer base additional control class for theme customize options.
 *
 * Class ColorMag_Customize_Base_Additional_Control
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
 * Class ColorMag_Customize_Base_Additional_Control
 */
class ColorMag_Customize_Base_Additional_Control extends WP_Customize_Control {

	/**
	 * Enqueue control related scripts/styles.
	 */
	public function enqueue() {

		$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

		/**
		 * Enqueue required Customize Controls CSS files.
		 */
		// SelectWoo CSS library file.
		wp_enqueue_style(
			'selectWoo',
			COLORMAG_CUSTOMIZER_URL . '/custom-controls/assets/css/selectWoo' . $suffix . '.css',
			array(),
			COLORMAG_THEME_VERSION
		);

		// Main CSS file.
		wp_enqueue_style(
			'colormag-customize-controls',
			COLORMAG_CUSTOMIZER_URL . '/custom-controls/assets/css/customize-controls' . $suffix . '.css',
			array(),
			COLORMAG_THEME_VERSION
		);
		wp_style_add_data( 'colormag-customize-controls', 'rtl', 'replace' );

		/**
		 * Enqueue required Customize Controls JS files.
		 */
		// SelectWoo JS library file.
		wp_enqueue_script(
			'selectWoo',
			COLORMAG_CUSTOMIZER_URL . '/custom-controls/assets/js/selectWoo' . $suffix . '.js',
			array(),
			COLORMAG_THEME_VERSION,
			true
		);

		// WP Color Picker Alpha JS library file.
		wp_enqueue_script(
			'wp-color-picker-alpha',
			COLORMAG_CUSTOMIZER_URL . '/custom-controls/assets/js/wp-color-picker-alpha' . $suffix . '.js',
			array(
				'wp-color-picker',
			),
			COLORMAG_THEME_VERSION,
			true
		);

		// Main JS file.
		wp_enqueue_script(
			'colormag-customize-controls',
			COLORMAG_CUSTOMIZER_URL . '/custom-controls/assets/js/customize-controls' . $suffix . '.js',
			array(
				'jquery',
			),
			COLORMAG_THEME_VERSION,
			true
		);

	}

}
