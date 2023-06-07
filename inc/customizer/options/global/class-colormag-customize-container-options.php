<?php
/**
 * Class to include Layout customize options.
 *
 * Class ColorMag_Customize_Layout_Options
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
 * Class to include Layout customize options.
 *
 * Class ColorMag_Customize_Layout_Options
 */
class ColorMag_Customize_Layout_Options extends ColorMag_Customize_Base_Option {

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

			// Site layout heading.
			array(
				'name'     => 'colormag_container_heading',
				'type'     => 'control',
				'control'  => 'colormag-title',
				'label'    => esc_html__( 'Container', 'colormag' ),
				'section'  => 'colormag_global_container_section',
				'priority' => 10,
			),

			// Site layout heading.
			array(
				'name'     => 'colormag_container_general_subtitle',
				'type'     => 'control',
				'control'  => 'colormag-subtitle',
				'label'    => esc_html__( 'General', 'colormag' ),
				'section'  => 'colormag_global_container_section',
				'priority' => 20,
			),

			// Site layout option.
			array(
				'name'      => 'colormag_container_layout',
				'default'   => 'wide',
				'type'      => 'control',
				'control'   => 'select',
				'label'     => esc_html__( 'Layout', 'colormag' ),
				'section'   => 'colormag_global_container_section',
				'transport' => 'postMessage',
				'choices'   => array(
					'boxed' => esc_html__( 'Boxed Layout', 'colormag' ),
					'wide'  => esc_html__( 'Wide Layout', 'colormag' ),
				),
				'priority'  => 30,
			),

			array(
				'name'     => 'colormag_container_outside_background_divider',
				'type'     => 'control',
				'control'  => 'colormag-divider',
				'style'    => 'dashed',
				'section'  => 'colormag_global_container_section',
				'priority' => 50,
			),

			array(
				'name'     => 'colormag_container_outside_background_divider',
				'type'     => 'control',
				'control'  => 'colormag-divider',
				'style'    => 'dashed',
				'section'  => 'colormag_global_container_section',
				'priority' => 80,
			),

			// Site layout heading.
			array(
				'name'     => 'colormag_container_outside_subtitle',
				'type'     => 'control',
				'control'  => 'colormag-subtitle',
				'label'    => esc_html__( 'Outside', 'colormag' ),
				'section'  => 'colormag_global_container_section',
				'priority' => 90,
			),

			array(
				'name'      => 'colormag_outside_container_background',
				'default'   => array(
					'background-color'      => '#ffffff',
					'background-image'      => '',
					'background-position'   => 'center center',
					'background-size'       => 'auto',
					'background-attachment' => 'scroll',
					'background-repeat'     => 'repeat',
				),
				'type'      => 'control',
				'control'   => 'colormag-background',
				'section'   => 'colormag_global_container_section',
				'transport' => 'postMessage',
				'priority'  => 100,
			),

			array(
				'name'        => 'colormag_container_upgrade',
				'type'        => 'control',
				'control'     => 'colormag-upgrade',
				'label'       => esc_html__( 'Learn more', 'colormag' ),
				'description' => esc_html__( 'Unlock more features available in Pro version.', 'colormag' ),
				'url'         => esc_url( 'https://themegrill.com/colormag-pricing/' ),
				'section'     => 'colormag_global_container_section',
				'priority'    => 1000,
			),
		);

		$options = array_merge( $options, $configs );

		return $options;
	}

}

return new ColorMag_Customize_Layout_Options();
