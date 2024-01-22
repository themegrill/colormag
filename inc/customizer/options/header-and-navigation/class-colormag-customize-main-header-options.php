<?php
/**
 * Class to include Main Header customize options.
 *
 * Class ColorMag_Customize_Main_Header_Options
 *
 * @package    ThemeGrill
 * @subpackage ColorMag
 * @since      ColorMag 3.0.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * Class to include Main Header customize options.
 *
 * Class ColorMag_Customize_Main_Header_Options
 */
class ColorMag_Customize_Main_Header_Options extends ColorMag_Customize_Base_Option {

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
				'name'     => 'colormag_main_header_title',
				'type'     => 'control',
				'control'  => 'colormag-title',
				'label'    => esc_html__( 'Main Header', 'colormag' ),
				'section'  => 'colormag_primary_header_section',
				'priority' => 10,
			),

			array(
				'name'     => 'colormag_main_header_general_subtitle',
				'type'     => 'control',
				'control'  => 'colormag-subtitle',
				'label'    => esc_html__( 'General', 'colormag' ),
				'section'  => 'colormag_primary_header_section',
				'priority' => 20,
			),

			array(
				'name'     => 'colormag_main_header_layout',
				'default'  => 'layout-1',
				'type'     => 'control',
				'control'  => 'select',
				'label'    => esc_html__( 'Layout', 'colormag' ),
				'section'  => 'colormag_primary_header_section',
				'priority' => 30,
				'choices'  => array(
					'layout-1' => esc_html__( 'Layout 1', 'colormag' ),
					'layout-2' => esc_html__( 'Layout 2', 'colormag' ),
				),
			),

			array(
				'name'       => 'colormag_main_header_layout_1_style',
				'default'    => 'style-1',
				'type'       => 'control',
				'control'    => 'colormag-radio-image',
				'label'      => esc_html__( 'Advanced Style', 'colormag' ),
				'section'    => 'colormag_primary_header_section',
				'priority'   => 30,
				'choices'    => apply_filters(
					'colormag_main_header_layout_1_style_choices',
					array(
						'style-1' => array(
							'label' => '',
							'url'   => COLORMAG_IMG_URL . '/main-header/layout-1/style-1.svg',
						),
					)
				),
				'image_col'  => 1,
				'dependency' => array(
					'colormag_main_header_layout',
					'==',
					'layout-1',
				),
			),

			array(
				'name'       => 'colormag_main_header_layout_2_style',
				'default'    => 'style-1',
				'type'       => 'control',
				'control'    => 'colormag-radio-image',
				'label'      => esc_html__( 'Advanced Style', 'colormag' ),
				'section'    => 'colormag_primary_header_section',
				'priority'   => 30,
				'choices'    => apply_filters(
					'colormag_main_header_layout_1_style_choices',
					array(
						'style-1' => array(
							'label' => '',
							'url'   => COLORMAG_IMG_URL . '/main-header/layout-2/style-1.svg',
						),
					)
				),
				'image_col'  => 1,
				'dependency' => array(
					'colormag_main_header_layout',
					'==',
					'layout-2',
				),
			),

			array(
				'name'       => 'colormag_main_header_width_subtitle',
				'type'       => 'control',
				'control'    => 'colormag-subtitle',
				'label'      => esc_html__( 'Width', 'colormag' ),
				'section'    => 'colormag_primary_header_section',
				'priority'   => 50,
				'dependency' => array(
					'colormag_main_header_layout',
					'==',
					'layout-1',
				),
			),

			array(
				'name'       => 'colormag_main_header_width_setting',
				'default'    => 'full-width',
				'type'       => 'control',
				'control'    => 'select',
				'section'    => 'colormag_primary_header_section',
				'choices'    => array(
					'full-width' => esc_html__( 'Full Width', 'colormag' ),
					'contained'  => esc_html__( 'Contained', 'colormag' ),
				),
				'priority'   => 60,
				'dependency' => array(
					'colormag_main_header_layout',
					'==',
					'layout-1',
				),
			),

			array(
				'name'        => 'colormag_main_header_upgrade',
				'type'        => 'control',
				'control'     => 'colormag-upgrade',
				'label'       => esc_html__( 'Learn more', 'colormag' ),
				'description' => esc_html__( 'Unlock more features available in Pro version.', 'colormag' ),
				'url'         => esc_url( 'https://themegrill.com/colormag-pricing/' ),
				'section'     => 'colormag_primary_header_section',
				'priority'    => 1000,
			),
		);

		$options = array_merge( $options, $configs );

		return $options;
	}

}

return new ColorMag_Customize_Main_Header_Options();
