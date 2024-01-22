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
class ColorMag_Customize_Footer_General_Options extends ColorMag_Customize_Base_Option {

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
				'name'     => 'colormag_footer_column_heading',
				'type'     => 'control',
				'control'  => 'colormag-title',
				'label'    => esc_html__( 'Footer Column', 'colormag' ),
				'section'  => 'colormag_footer_column_section',
				'priority' => 10,
			),

			array(
				'name'     => 'colormag_footer_general_subtitle',
				'type'     => 'control',
				'control'  => 'colormag-subtitle',
				'label'    => esc_html__( 'General', 'colormag' ),
				'section'  => 'colormag_footer_column_section',
				'priority' => 20,
			),

			// Main total footer area display type option.
			array(
				'name'      => 'colormag_main_footer_layout',
				'default'   => 'layout-1',
				'type'      => 'control',
				'control'   => 'select',
				'label'     => esc_html__( 'Layout', 'colormag' ),
				'section'   => 'colormag_footer_column_section',
				'choices'   => array(
					'layout-1' => esc_html__( 'Layout 1', 'colormag' ),
					'layout-2' => esc_html__( 'Layout 2', 'colormag' ),
				),
				'transport' => 'postMessage',
				'priority'  => 30,
			),

			array(
				'name'        => 'colormag_footer_column_upgrade',
				'type'        => 'control',
				'control'     => 'colormag-upgrade',
				'label'       => esc_html__( 'Learn more', 'colormag' ),
				'description' => esc_html__( 'Unlock more features available in Pro version.', 'colormag' ),
				'url'         => esc_url( 'https://themegrill.com/colormag-pricing/' ),
				'section'     => 'colormag_footer_column_section',
				'priority'    => 1000,
			),
		);

		$options = array_merge( $options, $configs );

		return $options;
	}

}

return new ColorMag_Customize_Footer_General_Options();
