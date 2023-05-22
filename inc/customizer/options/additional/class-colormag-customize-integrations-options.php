<?php
/**
 * Class to include Additional customize options.
 *
 * Class ColorMag_Customize_Integrations_Options
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
 * Class to include Additional customize option.
 *
 * Class ColorMag_Customize_Integrations_Options
 */
class ColorMag_Customize_Integrations_Options extends ColorMag_Customize_Base_Option {

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

			// Open Weather Map API Key option.
			array(
				'name'     => 'colormag_openweathermap_api_key',
				'default'  => '',
				'type'     => 'control',
				'control'  => 'text',
				'label'    => esc_html__( 'OpenWeatherMap API Key', 'colormag' ),
				'section'  => 'colormag_integrations_section',
				'priority' => 10,
			),

			// Google Map API Key option.
			array(
				'name'     => 'colormag_googlemap_api_key',
				'default'  => '',
				'type'     => 'control',
				'control'  => 'text',
				'label'    => esc_html__( 'GoogleMaps API Key', 'colormag' ),
				'section'  => 'colormag_integrations_section',
				'priority' => 15,
			),

			// Exchange Rate API Key option.
			array(
				'name'     => 'colormag_exchange_rate_api_key',
				'default'  => '',
				'type'     => 'control',
				'control'  => 'text',
				'label'    => esc_html__( 'Exchange Rate API Key', 'colormag' ),
				'section'  => 'colormag_integrations_section',
				'priority' => 20,
			),

		);

		$options = array_merge( $options, $configs );

		return $options;
	}

}

return new ColorMag_Customize_Integrations_Options();
