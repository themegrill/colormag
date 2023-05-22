<?php
/**
 * Class to include Image loading customize options.
 *
 * Class ColorMag_Customize_Image_Load_Options
 *
 * @package    ThemeGrill
 * @subpackage ColorMag
 * @since      ColorMag 3.1.5
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class to include optimization customize options.
 *
 * Class ColorMag_Customize_Optimization_Options
 */
class ColorMag_Customize_Optimization_Options extends ColorMag_Customize_Base_Option {

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

			/**
			 * Smooth Image Loading.
			 */
			array(
				'name'     => 'colormag_smooth_image_loading_heading',
				'type'     => 'control',
				'control'  => 'colormag-title',
				'label'    => esc_html__( 'Smooth Image Loading', 'colormag' ),
				'section'  => 'colormag_optimization_section',
				'priority' => 0,
			),

			array(
				'name'      => 'colormag_enable_smooth_image_loading',
				'default'   => 0,
				'type'      => 'control',
				'control'   => 'colormag-toggle',
				'label'     => esc_html__( 'Enable', 'colormag' ),
				'section'   => 'colormag_optimization_section',
				'transport' => 'refresh',
				'priority'  => 10,
			),

			array(
				'name'       => 'colormag_smooth_image_loading_animation',
				'default'    => 'fade-in',
				'type'       => 'control',
				'control'    => 'select',
				'label'      => esc_html__( 'Animation', 'colormag' ),
				'section'    => 'colormag_optimization_section',
				'transport'  => 'refresh',
				'choices'    => array(
					'fade-in'      => esc_html__( 'Fade In', 'colormag' ),
					'fade-in-down' => esc_html__( 'Fade In Down', 'colormag' ),
					'fade-in-up'   => esc_html__( 'Fade In Up', 'colormag' ),
				),
				'dependency' => array(
					'colormag_enable_smooth_image_loading',
					'!=',
					0,
				),
				'priority'   => 20,
			),

			/**
			 * Load Google fonts locally.
			 */
			array(
				'name'     => 'colormag_load_google_fonts_locally_heading',
				'type'     => 'control',
				'control'  => 'colormag-title',
				'label'    => esc_html__( 'Load Google fonts locally', 'colormag' ),
				'section'  => 'colormag_optimization_section',
				'priority' => 30,
			),

			array(
				'name'     => 'colormag_load_google_fonts_locally',
				'default'  => 0,
				'type'     => 'control',
				'control'  => 'colormag-toggle',
				'label'    => esc_html__( 'Enable', 'colormag' ),
				'section'  => 'colormag_optimization_section',
				'priority' => 40,
			),
		);

		$options = array_merge( $options, $configs );

		return $options;
	}

}

return new ColorMag_Customize_Optimization_Options();
