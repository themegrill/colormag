<?php
/**
 * Class to include Header General customize options.
 *
 * Class ColorMag_Customize_Header_General_Options
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
 * Class to include Header General customize options.
 *
 * Class ColorMag_Customize_Header_General_Options
 */
class ColorMag_Customize_Header_General_Options extends ColorMag_Customize_Base_Option {

	/**
	 * Include customize options.
	 *
	 * @param array                 $options      Customize options provided via the theme.
	 * @param \WP_Customize_Manager $wp_customize Theme Customizer object.
	 *
	 * @return mixed|void Customizer options for registering panels, sections as well as controls.
	 */
	public function register_options( $options, $wp_customize ) {

		$configs = array(

			// Style header separator.
			array(
				'name'     => 'colormag_style_heading',
				'type'     => 'control',
				'control'  => 'colormag-title',
				'label'    => esc_html__( 'Style', 'colormag' ),
				'section'  => 'colormag_primary_header_section',
				'priority' => 0,
			),

			// Main total header area display type option.
			array(
				'name'     => 'colormag_main_total_header_area_display_type',
				'default'  => 'type_one',
				'type'     => 'control',
				'control'  => 'colormag-radio-image',
				'label'    => esc_html__( 'Choose the main total header area display type that you want', 'colormag' ),
				'section'  => 'colormag_primary_header_section',
				'choices'  => array(
					'type_one'   => array(
						'label' => '',
						'url'   => COLORMAG_ADMIN_IMAGES_URL . '/header-variation-1.png',
					),
					'type_two'   => array(
						'label' => '',
						'url'   => COLORMAG_ADMIN_IMAGES_URL . '/header-variation-2.png',
					),
					'type_three' => array(
						'label' => '',
						'url'   => COLORMAG_ADMIN_IMAGES_URL . '/header-variation-3.png',
					),
				),
				'priority' => 5,
			),

		);

		$options = array_merge( $options, $configs );

		return $options;

	}

}

return new ColorMag_Customize_Header_General_Options();
