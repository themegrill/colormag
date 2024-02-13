<?php
/**
 * Class to include Button customize options.
 *
 * Class ColorMag_Customize_Button_Options
 *
 * @package    ThemeGrill
 * @subpackage ColorMag
 * @since     @todo
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
class ColorMag_Customize_Button_Options extends ColorMag_Customize_Base_Option
{


	/**
	 * Include customize options.
	 *
	 * @param array $options Customize options provided via the theme.
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 *
	 * @return mixed|void Customizer options for registering panels, sections as well as controls.
	 */
	public function register_options( $options, $wp_customize )
	{

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
				'tab'       => esc_html__( 'Normal', 'colormag' ),
				'priority'  => 30,
			),

			array(
				'name'      => 'colormag_button_hover_color',
				'default'   => '',
				'type'      => 'sub-control',
				'control'   => 'colormag-color',
				'parent'    => 'colormag_button_color_group',
				'section'   => 'colormag_button_section',
				'transport' => 'postMessage',
				'tab'       => esc_html__( 'Hover', 'colormag' ),
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
				'tab'       => esc_html__( 'Normal', 'colormag' ),
				'priority'  => 50,
			),

			array(
				'name'      => 'colormag_button_background_hover_color',
				'default'   => '',
				'type'      => 'sub-control',
				'control'   => 'colormag-color',
				'parent'    => 'colormag_button_background_color_group',
				'section'   => 'colormag_button_section',
				'transport' => 'postMessage',
				'tab'       => esc_html__( 'Hover', 'colormag' ),
				'priority'  => 50,
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

			array(
				'name'        => 'colormag_colors_upgrade',
				'type'        => 'control',
				'control'     => 'colormag-upgrade',
				'label'       => esc_html__( 'Learn more', 'colormag' ),
				'description' => esc_html__( 'Unlock more features available in Pro version.', 'colormag' ),
				'url'         => esc_url( 'https://themegrill.com/colormag-pricing/' ),
				'section'     => 'colormag_button_section',
				'priority'    => 1000,
			),

		);

		$options = array_merge( $options, $configs );

		return $options;
	}
}

return new ColorMag_Customize_Button_Options();
