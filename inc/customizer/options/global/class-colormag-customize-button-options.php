<?php
/**
 * Class to include Button customize options.
 *
 * Class ColorMag_Customize_Button_Options
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
 * Class to include Button customize options.
 *
 * Class ColorMag_Customize_Button_Options
 */
class ColorMag_Customize_Button_Options extends ColorMag_Customize_Base_Option {

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
				'name'     => 'colormag_button_title',
				'type'     => 'control',
				'control'  => 'colormag-title',
				'label'    => esc_html__( 'Button', 'colormag' ),
				'section'  => 'colormag_button_section',
				'priority' => 10,
			),

			/**
			 * Colors.
			 */
			array(
				'name'     => 'colormag_button_color_group',
				'type'     => 'control',
				'control'  => 'colormag-group',
				'label'    => esc_html__( 'Color', 'colormag' ),
				'section'  => 'colormag_button_section',
				'priority' => 20,
			),

			array(
				'name'      => 'colormag_button_color',
				'default'   => '#ffffff',
				'type'      => 'sub-control',
				'control'   => 'colormag-color',
				'parent'    => 'colormag_button_color_group',
				'section'   => 'colormag_button_section',
				'transport' => 'postMessage',
				'priority'  => 30,
			),

			array(
				'name'     => 'colormag_button_background_color_group',
				'type'     => 'control',
				'control'  => 'colormag-group',
				'label'    => esc_html__( 'Background', 'colormag' ),
				'section'  => 'colormag_button_section',
				'priority' => 40,
			),
			array(
				'name'      => 'colormag_button_background_color',
				'default'   => '#207daf',
				'type'      => 'sub-control',
				'control'   => 'colormag-color',
				'parent'    => 'colormag_button_background_color_group',
				'section'   => 'colormag_button_section',
				'transport' => 'postMessage',
				'priority'  => 50,
			),

			/**
			 * Typography.
			 */
			array(
				'name'     => 'colormag_button_typography_group',
				'type'     => 'control',
				'control'  => 'colormag-group',
				'label'    => esc_html__( 'Typography', 'colormag' ),
				'section'  => 'colormag_button_section',
				'priority' => 60,
			),

			array(
				'name'      => 'colormag_button_typography',
				'default'   => array(
					'font-family'    => 'default',
					'font-weight'    => 'regular',
					'subsets'        => array( 'latin' ),
					'font-size'      => array(
						'desktop' => array(
							'size' => '12',
							'unit' => 'px',
						),
						'tablet'  => array(
							'size' => '',
							'unit' => 'px',
						),
						'mobile'  => array(
							'size' => '',
							'unit' => 'px',
						),
					),
					'line-height'    => array(
						'desktop' => array(
							'size' => '',
							'unit' => 'px',
						),
						'tablet'  => array(
							'size' => '',
							'unit' => 'px',
						),
						'mobile'  => array(
							'size' => '',
							'unit' => 'px',
						),
					),
					'letter-spacing' => array(
						'desktop' => array(
							'size' => '',
							'unit' => 'px',
						),
						'tablet'  => array(
							'size' => '',
							'unit' => 'px',
						),
						'mobile'  => array(
							'size' => '',
							'unit' => 'px',
						),
					),
					'font-style'     => 'normal',
					'text-transform' => 'none',
				),
				'type'      => 'sub-control',
				'control'   => 'colormag-typography',
				'parent'    => 'colormag_button_typography_group',
				'section'   => 'colormag_button_section',
				'transport' => 'postMessage',
				'priority'  => 70,
			),

			array(
				'name'     => 'colormag_button_padding_divider',
				'type'     => 'control',
				'control'  => 'colormag-divider',
				'style'    => 'dashed',
				'section'  => 'colormag_button_section',
				'priority' => 80,
			),

			/**
			 * Dimension.
			 */
			array(
				'name'     => 'colormag_button_dimension_subtitle',
				'type'     => 'control',
				'control'  => 'colormag-subtitle',
				'label'    => esc_html__( 'Padding', 'colormag' ),
				'section'  => 'colormag_button_section',
				'priority' => 90,
			),

			array(
				'name'      => 'colormag_button_dimension_padding',
				'default'   => array(
					'top'    => '',
					'right'  => '',
					'bottom' => '',
					'left'   => '',
					'unit'   => 'px',
				),
				'suffix'    => array( 'px' ),
				'type'      => 'control',
				'control'   => 'colormag-dimensions',
				'label'     => esc_html__( 'Padding', 'colormag' ),
				'transport' => 'postMessage',
				'section'   => 'colormag_button_section',
				'priority'  => 100,
			),

			array(
				'name'     => 'colormag_button_border_divider',
				'type'     => 'control',
				'control'  => 'colormag-divider',
				'style'    => 'dashed',
				'section'  => 'colormag_button_section',
				'priority' => 110,
			),

			/**
			 * Border options
			 */
			array(
				'name'     => 'colormag_button_border_subtitle',
				'type'     => 'control',
				'control'  => 'colormag-subtitle',
				'label'    => esc_html__( 'Border', 'colormag' ),
				'section'  => 'colormag_button_section',
				'priority' => 120,
			),

			array(
				'name'      => 'colormag_button_border_style',
				'default'   => 'none',
				'type'      => 'control',
				'control'   => 'select',
				'label'     => esc_html__( 'Style', 'colormag' ),
				'section'   => 'colormag_button_section',
				'choices'   => array(
					'none'   => esc_html__( 'None', 'colormag' ),
					'solid'  => esc_html__( 'Solid', 'colormag' ),
					'double' => esc_html__( 'Double', 'colormag' ),
					'dashed' => esc_html__( 'Dashed', 'colormag' ),
					'dotted' => esc_html__( 'Dotted', 'colormag' ),
				),
				'transport' => 'postMessage',
				'priority'  => 130,
			),

			array(
				'name'        => 'colormag_button_border_width',
				'default'     => array(
					'size' => '',
					'unit' => 'px',
				),
				'suffix'      => array( 'px' ),
				'type'        => 'control',
				'control'     => 'colormag-slider',
				'label'       => esc_html__( 'Size', 'colormag' ),
				'section'     => 'colormag_button_section',
				'transport'   => 'postMessage',
				'priority'    => 140,
				'input_attrs' => array(
					'px' => array(
						'min'  => 0,
						'max'  => 10,
						'step' => 1,
					),
				),
			),

			array(
				'name'      => 'colormag_button_border_color_group',
				'default'   => '',
				'type'      => 'control',
				'control'   => 'colormag-group',
				'label'     => esc_html__( 'Color', 'colormag' ),
				'section'   => 'colormag_button_section',
				'transport' => 'postMessage',
				'priority'  => 150,
			),

			array(
				'name'      => 'colormag_button_border_color',
				'default'   => '',
				'type'      => 'sub-control',
				'control'   => 'colormag-color',
				'parent'    => 'colormag_button_border_color_group',
				'section'   => 'colormag_button_section',
				'transport' => 'postMessage',
				'priority'  => 150,
			),


			array(
				'name'        => 'colormag_button_border_radius',
				'default'     => array(
					'size' => '3',
					'unit' => 'px',
				),
				'suffix'      => array( 'px' ),
				'type'        => 'control',
				'control'     => 'colormag-slider',
				'label'       => esc_html__( 'Radius', 'colormag' ),
				'section'     => 'colormag_button_section',
				'transport'   => 'postMessage',
				'priority'    => 160,
				'input_attrs' => array(
					'px' => array(
						'min'  => 0,
						'max'  => 50,
						'step' => 1,
					),
				),
			),
		);

		$options = array_merge( $options, $configs );

		return $options;
	}

}

return new ColorMag_Customize_Button_Options();
