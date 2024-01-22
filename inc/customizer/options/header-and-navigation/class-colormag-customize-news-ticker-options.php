<?php
/**
 * Class to include News Ticker customize options.
 *
 * Class ColorMag_Customize_News_Ticker_Options
 *
 * @package    ThemeGrill
 * @subpackage ColorMag
 * @since      TBD
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class to include News Ticker customize options.
 *
 * Class ColorMag_Customize_News_Ticker_Options
 */
class ColorMag_Customize_News_Ticker_Options extends ColorMag_Customize_Base_Option {

	/**
	 * Include customize options.
	 *
	 * @param array                 $options      Customize options provided via the theme.
	 * @param \WP_Customize_Manager $wp_customize Theme Customizer object.
	 *
	 * @return mixed|void Customizer options for registering panels, sections as well as controls.
	 */
	public function register_options( $options, $wp_customize ) {

		// Customize transport postMessage variable to set `postMessage` or `refresh` as required.
		$customizer_selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';

		$configs = array(

			/**
			 * Breaking news.
			 */
			// Breaking news heading separator.
			array(
				'name'     => 'colormag_news_ticker_heading',
				'type'     => 'control',
				'control'  => 'colormag-title',
				'label'    => esc_html__( 'News Ticker', 'colormag' ),
				'section'  => 'colormag_news_ticker_section',
				'priority' => 10,
			),

			array(
				'name'     => 'colormag_news_ticker_general_subtitle',
				'type'     => 'control',
				'control'  => 'colormag-subtitle',
				'label'    => esc_html__( 'General', 'colormag' ),
				'section'  => 'colormag_news_ticker_section',
				'priority' => 20,
			),

			// Breaking news in header enable/disable option.
			array(
				'name'     => 'colormag_enable_news_ticker',
				'default'  => 0,
				'type'     => 'control',
				'control'  => 'colormag-toggle',
				'label'    => esc_html__( 'Enable', 'colormag' ),
				'section'  => 'colormag_news_ticker_section',
				'priority' => 30,
			),

			array(
				'name'        => 'colormag_news_ticker_upgrade',
				'type'        => 'control',
				'control'     => 'colormag-upgrade',
				'label'       => esc_html__( 'Learn more', 'colormag' ),
				'description' => esc_html__( 'Unlock more features available in Pro version.', 'colormag' ),
				'url'         => esc_url( 'https://themegrill.com/colormag-pricing/' ),
				'section'     => 'colormag_news_ticker_section',
				'priority'    => 1000,
			),
		);

		$options = array_merge( $options, $configs );

		return $options;
	}

}

return new ColorMag_Customize_News_Ticker_Options();
