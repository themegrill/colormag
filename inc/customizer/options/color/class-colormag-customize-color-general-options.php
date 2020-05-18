<?php
/**
 * Class to include Color General customize options.
 *
 * Class ColorMag_Customize_Color_General_Options
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
 * Class to include Color General customize options.
 *
 * Class ColorMag_Customize_Color_General_Options
 */
class ColorMag_Customize_Color_General_Options extends ColorMag_Customize_Base_Option {

	/**
	 * Include customize options.
	 *
	 * @param array                 $options      Customize options provided via the theme.
	 * @param \WP_Customize_Manager $wp_customize Theme Customizer object.
	 *
	 * @return mixed|void Customizer options for registering panels, sections as well as controls.
	 */
	public function customizer_options( $options, $wp_customize ) {

		$configs = array(

			// Primary color option.
			array(
				'name'     => 'colormag_primary_color',
				'default'  => '#289dcc',
				'type'     => 'control',
				'control'  => 'colormag-color',
				'label'    => esc_html__( 'Primary Color', 'colormag' ),
				'section'  => 'colormag_color_general_section',
				'priority' => 5,
			),

		);

		$options = array_merge( $options, $configs );

		return $options;

	}

}

return new ColorMag_Customize_Color_General_Options();
