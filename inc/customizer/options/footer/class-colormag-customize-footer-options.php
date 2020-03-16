<?php
/**
 * Class to include Footer customize options.
 *
 * Class ColorMag_Customize_Footer_Options
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
 * Class to include Footer customize option.
 *
 * Class ColorMag_Customize_Footer_Options
 */
class ColorMag_Customize_Footer_Options extends ColorMag_Customize_Base_Option {

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

			// Main total footer area display type option.
			array(
				'name'      => 'colormag_main_footer_layout_display_type',
				'default'   => 'type_one',
				'type'      => 'control',
				'control'   => 'radio',
				'label'     => esc_html__( 'Choose the main total footer area display type that you want', 'colormag' ),
				'section'   => 'colormag_main_footer_layout_display_type_section',
				'choices'   => array(
					'type_one' => esc_html__( 'Type 1 (Default)', 'colormag' ),
					'type_two' => esc_html__( 'Type 2', 'colormag' ),
				),
				'transport' => 'postMessage',
			),

		);

		$options = array_merge( $options, $configs );

		return $options;

	}

}

return new ColorMag_Customize_Footer_Options();