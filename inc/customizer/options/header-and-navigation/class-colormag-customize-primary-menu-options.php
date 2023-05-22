<?php
/**
 * Class to include Header Primary Menu customize options.
 *
 * Class ColorMag_Customize_Primary_Menu_Options
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
 * Class to include Header Primary Menu customize options.
 *
 * Class ColorMag_Customize_Primary_Menu_Options
 */
class ColorMag_Customize_Primary_Menu_Options extends ColorMag_Customize_Base_Option {

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

			array(
				'name'     => 'colormag_primary_menu_heading',
				'type'     => 'control',
				'control'  => 'colormag-title',
				'label'    => esc_html__( 'Primary Menu', 'colormag' ),
				'section'  => 'colormag_primary_menu_section',
				'priority' => 10,
			),

			array(
				'name'     => 'colormag_primary_menu_general_subtitle',
				'type'     => 'control',
				'control'  => 'colormag-subtitle',
				'label'    => esc_html__( 'General', 'colormag' ),
				'section'  => 'colormag_primary_menu_section',
				'priority' => 20,
			),

			array(
				'name'        => 'colormag_enable_category_color',
				'default'     => '',
				'type'        => 'control',
				'control'     => 'colormag-toggle',
				'label'       => esc_html__( 'Category Color', 'colormag' ),
				'description' => esc_html__( 'Check to show category color in menu.', 'colormag' ),
				'section'     => 'colormag_primary_menu_section',
				'priority'    => 30,
			),

			array(
				'name'     => 'colormag_primary_menu_divider',
				'type'     => 'control',
				'control'  => 'colormag-divider',
				'style'    => 'dashed',
				'section'  => 'colormag_primary_menu_section',
				'priority' => 40,
			),

			array(
				'name'     => 'colormag_primary_menu_style_subtitle',
				'type'     => 'control',
				'control'  => 'colormag-subtitle',
				'label'    => esc_html__( 'Style', 'colormag' ),
				'section'  => 'colormag_primary_menu_section',
				'priority' => 50,
			),

			array(
				'name'     => 'colormag_primary_menu_background_group',
				'label'    => esc_html__( 'Background', 'colormag' ),
				'default'  => '',
				'type'     => 'control',
				'control'  => 'colormag-group',
				'section'  => 'colormag_primary_menu_section',
				'priority' => 60,
			),

			array(
				'name'     => 'colormag_primary_menu_background',
				'default'  => array(
					'background-color'      => '#27272A',
					'background-image'      => '',
					'background-position'   => 'center center',
					'background-size'       => 'auto',
					'background-attachment' => 'scroll',
					'background-repeat'     => 'repeat',
				),
				'type'     => 'sub-control',
				'control'  => 'colormag-background',
				'parent'   => 'colormag_primary_menu_background_group',
				'section'  => 'colormag_primary_menu_section',
				'priority' => 70,
			),

			array(
				'name'     => 'colormag_primary_menu_border_top_group',
				'label'    => esc_html__( 'Border Top', 'colormag' ),
				'default'  => '',
				'type'     => 'control',
				'control'  => 'colormag-group',
				'section'  => 'colormag_primary_menu_section',
				'priority' => 80,
			),

			array(
				'name'     => 'colormag_primary_menu_top_border_color',
				'label'    => esc_html__( 'Color', 'colormag' ),
				'default'  => '#207daf',
				'type'     => 'sub-control',
				'control'  => 'colormag-color',
				'parent'   => 'colormag_primary_menu_border_top_group',
				'section'  => 'colormag_primary_menu_section',
				'priority' => 90,
			),

			array(
				'name'      => 'colormag_primary_menu_dimension_padding',
				'default'   => array(
					'top'    => '10',
					'right'  => '16',
					'bottom' => '10',
					'left'   => '16',
					'unit'   => 'px',
				),
				'suffix'    => array( 'px' ),
				'type'      => 'control',
				'control'   => 'colormag-dimensions',
				'label'     => esc_html__( 'Padding', 'colormag' ),
				'section'   => 'colormag_primary_menu_section',
				'transport' => 'postMessage',
				'priority'  => 100,
			),

			/**
			 * Home icon options.
			 */
			array(
				'name'     => 'colormag_icon_logo_display_heading',
				'type'     => 'control',
				'control'  => 'colormag-title',
				'label'    => esc_html__( 'Home Icon/Logo', 'colormag' ),
				'section'  => 'colormag_primary_menu_section',
				'priority' => 110,
			),

			// Home icon in menu heading separator.
			array(
				'name'     => 'colormag_menu_icon_logo',
				'default'  => 'none',
				'type'     => 'control',
				'control'  => 'select',
				'section'  => 'colormag_primary_menu_section',
				'priority' => 120,
				'choices'  => array(
					'none'      => esc_html__( 'None', 'colormag' ),
					'home_icon' => esc_html__( 'Home Icon', 'colormag' ),
					'logo'      => esc_html__( 'Logo', 'colormag' ),
				),
			),

			array(
				'name'       => 'colormag_primary_menu_logo',
				'default'    => '',
				'type'       => 'control',
				'control'    => 'image',
				'label'      => esc_html__( 'Upload', 'colormag' ),
				'section'    => 'colormag_primary_menu_section',
				'priority'   => 130,
				'dependency' => array(
					'colormag_menu_icon_logo',
					'===',
					'logo',
				),
			),

			array(
				'name'        => 'colormag_primary_menu_logo_height',
				'default'     => '',
				'suffix'      => array( 'px' ),
				'type'        => 'control',
				'control'     => 'colormag-slider',
				'label'       => esc_html__( 'Height', 'colormag' ),
				'section'     => 'colormag_primary_menu_section',
				'priority'    => 140,
				'input_attrs' => array(
					'px' => array(
						'step' => 1,
					),
				),
				'dependency'  => array(
					'colormag_menu_icon_logo',
					'===',
					'logo',
				),
			),

			array(
				'name'        => 'colormag_primary_menu_logo_spacing',
				'default'     => '',
				'suffix'      => array( 'px' ),
				'type'        => 'control',
				'control'     => 'colormag-slider',
				'label'       => esc_html__( 'Spacing', 'colormag' ),
				'section'     => 'colormag_primary_menu_section',
				'priority'    => 150,
				'input_attrs' => array(
					'px' => array(
						'step' => 1,
					),
				),
				'dependency'  => array(
					'colormag_menu_icon_logo',
					'===',
					'logo',
				),
			),

			// Main Menu.
			array(
				'name'     => 'colormag_main_menu_heading',
				'type'     => 'control',
				'control'  => 'colormag-title',
				'label'    => esc_html__( 'Main Menu', 'colormag' ),
				'section'  => 'colormag_primary_menu_section',
				'priority' => 160,
			),

			// Primary Menu.
			array(
				'name'     => 'colormag_primary_menu_color_group',
				'label'    => esc_html__( 'Color', 'colormag' ),
				'default'  => '',
				'type'     => 'control',
				'control'  => 'colormag-group',
				'section'  => 'colormag_primary_menu_section',
				'priority' => 170,
			),

			array(
				'name'     => 'colormag_primary_menu_text_color',
				'default'  => '',
				'type'     => 'sub-control',
				'control'  => 'colormag-color',
				'parent'   => 'colormag_primary_menu_color_group',
				'tab'      => esc_html__( 'Normal', 'colormag' ),
				'section'  => 'colormag_primary_menu_section',
				'priority' => 180,
			),

			array(
				'name'     => 'colormag_primary_menu_selected_hovered_text_color',
				'default'  => '',
				'type'     => 'sub-control',
				'control'  => 'colormag-color',
				'parent'   => 'colormag_primary_menu_color_group',
				'tab'      => esc_html__( 'Hover/Selected', 'colormag' ),
				'section'  => 'colormag_primary_menu_section',
				'priority' => 190,
			),

			// Primary Menu.
			array(
				'name'     => 'colormag_primary_menu_typography_group',
				'label'    => esc_html__( 'Typography', 'colormag' ),
				'default'  => '',
				'type'     => 'control',
				'control'  => 'colormag-group',
				'section'  => 'colormag_primary_menu_section',
				'priority' => 200,
			),

			array(
				'name'      => 'colormag_primary_menu_typography',
				'default'   => array(
					'font-family' => 'default',
					'font-weight' => '600',
					'font-size'   => array(
						'desktop' => array(
							'size' => '14',
							'unit' => 'px',
						),
						'tablet'  => array(
							'size' => '',
							'unit' => '',
						),
						'mobile'  => array(
							'size' => '',
							'unit' => '',
						),
					),
				),
				'type'      => 'sub-control',
				'control'   => 'colormag-typography',
				'parent'    => 'colormag_primary_menu_typography_group',
				'section'   => 'colormag_primary_menu_section',
				'transport' => 'postMessage',
				'priority'  => 210,
			),

			// Sub Menu.
			array(
				'name'     => 'colormag_sub_menu_heading',
				'type'     => 'control',
				'control'  => 'colormag-title',
				'label'    => esc_html__( 'Sub Menu', 'colormag' ),
				'section'  => 'colormag_primary_menu_section',
				'priority' => 220,
			),

			// Background.
			array(
				'name'     => 'colormag_sub_menu_background_group',
				'label'    => esc_html__( 'Background', 'colormag' ),
				'default'  => '',
				'type'     => 'control',
				'control'  => 'colormag-group',
				'section'  => 'colormag_primary_menu_section',
				'priority' => 230,
			),

			array(
				'name'     => 'colormag_primary_sub_menu_background',
				'default'  => array(
					'background-color'      => '#232323',
					'background-image'      => '',
					'background-position'   => 'center center',
					'background-size'       => 'auto',
					'background-attachment' => 'scroll',
					'background-repeat'     => 'repeat',
				),
				'type'     => 'sub-control',
				'control'  => 'colormag-background',
				'parent'   => 'colormag_sub_menu_background_group',
				'section'  => 'colormag_primary_menu_section',
				'priority' => 240,
			),

			// Sub Menu.
			array(
				'name'     => 'colormag_primary_sub_menu_typography_group',
				'label'    => esc_html__( 'Typography', 'colormag' ),
				'default'  => '',
				'type'     => 'control',
				'control'  => 'colormag-group',
				'section'  => 'colormag_primary_menu_section',
				'priority' => 250,
			),

			// Primary sub menu typography option.
			array(
				'name'      => 'colormag_primary_sub_menu_typography',
				'default'   => array(
					'font-size' => array(
						'desktop' => array(
							'size' => '14',
							'unit' => 'px',
						),
						'tablet'  => array(
							'size' => '',
							'unit' => '',
						),
						'mobile'  => array(
							'size' => '',
							'unit' => '',
						),
					),
				),
				'type'      => 'sub-control',
				'control'   => 'colormag-typography',
				'parent'    => 'colormag_primary_sub_menu_typography_group',
				'section'   => 'colormag_primary_menu_section',
				'transport' => 'postMessage',
				'priority'  => 260,
			),
		);

		$options = array_merge( $options, $configs );

		return $options;
	}

}

return new ColorMag_Customize_Primary_Menu_Options();
