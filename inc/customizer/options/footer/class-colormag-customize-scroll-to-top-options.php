<?php
/**
 * Class to include Footer General customize options.
 *
 * Class ColorMag_Customize_Footer_General_Options
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
 * Class to include Footer General customize options.
 *
 * Class ColorMag_Customize_Footer_General_Options
 */
class ColorMag_Customize_Scroll_To_Top_Options extends ColorMag_Customize_Base_Option {

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

			array(
				'name'     => 'colormag_scroll_to_top_section_general_heading',
				'type'     => 'control',
				'control'  => 'colormag-title',
				'label'    => esc_html__( 'General', 'colormag' ),
				'section'  => 'colormag_scroll_to_top_section',
				'priority' => 10,
			),

			// Scroll to top button enable/disable option.
			array(
				'name'     => 'colormag_enable_scroll_to_top',
				'default'  => 1,
				'type'     => 'control',
				'control'  => 'colormag-toggle',
				'label'    => esc_html__( 'Enable', 'colormag' ),
				'section'  => 'colormag_scroll_to_top_section',
				'priority' => 20,
			),

			array(
				'name'       => 'colormag_scroll_to_top_background_group',
				'default'    => '',
				'type'       => 'control',
				'control'    => 'colormag-group',
				'label'      => esc_html__( 'Background', 'colormag' ),
				'section'    => 'colormag_scroll_to_top_section',
				'priority'   => 50,
				'dependency' => array(
					'colormag_enable_scroll_to_top',
					'==',
					true,
				),
			),

			array(
				'name'       => 'colormag_scroll_to_top_background',
				'default'    => '',
				'type'       => 'sub-control',
				'control'    => 'colormag-color',
				'parent'     => 'colormag_scroll_to_top_background_group',
				'tab'        => esc_html__( 'Normal', 'colormag' ),
				'section'    => 'colormag_scroll_to_top_section',
				'priority'   => 55,
				'dependency' => array(
					'colormag_enable_scroll_to_top',
					'==',
					true,
				),
			),

			array(
				'name'       => 'colormag_scroll_to_top_hover_background',
				'default'    => '',
				'type'       => 'sub-control',
				'control'    => 'colormag-color',
				'parent'     => 'colormag_scroll_to_top_background_group',
				'tab'        => esc_html__( 'Hover', 'colormag' ),
				'section'    => 'colormag_scroll_to_top_section',
				'priority'   => 55,
				'dependency' => array(
					'colormag_enable_scroll_to_top',
					'==',
					true,
				),
			),

			array(
				'name'       => 'colormag_scroll_to_top_icon_heading',
				'type'       => 'control',
				'control'    => 'colormag-title',
				'label'      => esc_html__( 'Icon', 'colormag' ),
				'section'    => 'colormag_scroll_to_top_section',
				'priority'   => 70,
				'dependency' => array(
					'colormag_enable_scroll_to_top',
					'==',
					true,
				),
			),

			array(
				'name'       => 'colormag_scroll_to_top_icon_color_group',
				'default'    => '',
				'type'       => 'control',
				'control'    => 'colormag-group',
				'label'      => esc_html__( 'Color', 'colormag' ),
				'section'    => 'colormag_scroll_to_top_section',
				'priority'   => 80,
				'dependency' => array(
					'colormag_enable_scroll_to_top',
					'==',
					true,
				),
			),

			array(
				'name'       => 'colormag_scroll_to_top_icon_color',
				'default'    => '',
				'type'       => 'sub-control',
				'control'    => 'colormag-color',
				'parent'     => 'colormag_scroll_to_top_icon_color_group',
				'tab'        => esc_html__( 'Normal', 'colormag' ),
				'section'    => 'colormag_scroll_to_top_section',
				'priority'   => 85,
				'dependency' => array(
					'colormag_enable_scroll_to_top',
					'==',
					true,
				),
			),

			array(
				'name'       => 'colormag_scroll_to_top_icon_hover_color',
				'default'    => '',
				'type'       => 'sub-control',
				'control'    => 'colormag-color',
				'parent'     => 'colormag_scroll_to_top_icon_color_group',
				'tab'        => esc_html__( 'Hover', 'colormag' ),
				'section'    => 'colormag_scroll_to_top_section',
				'priority'   => 85,
				'dependency' => array(
					'colormag_enable_scroll_to_top',
					'==',
					true,
				),
			),
		);

		$options = array_merge( $options, $configs );

		return $options;
	}

}

return new ColorMag_Customize_Scroll_To_Top_Options();
