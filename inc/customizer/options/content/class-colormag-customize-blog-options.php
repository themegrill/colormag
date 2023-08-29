<?php
/**
 * Class to include Blog General customize options.
 *
 * Class ColorMag_Customize_Blog_Archive_Options
 *
 * @package    ThemeGrill
 * @subpackage ColorMag
 * @since      TBD
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class to include Blog General customize options.
 *
 * Class ColorMag_Customize_Blog_Archive_Options
 */
class ColorMag_Customize_Blog_Archive_Options extends ColorMag_Customize_Base_Option {

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
				'name'     => 'colormag_pagination_heading',
				'type'     => 'control',
				'control'  => 'colormag-title',
				'label'    => esc_html__( 'Pagination', 'colormag' ),
				'section'  => 'colormag_blog_section',
				'priority' => 10,
			),

			array(
				'name'     => 'colormag_enable_pagination',
				'default'  => 1,
				'type'     => 'control',
				'control'  => 'colormag-toggle',
				'label'    => esc_html__( 'Enable', 'colormag' ),
				'section'  => 'colormag_blog_section',
				'priority' => 20,
			),

			array(
				'name'       => 'colormag_pagination_type',
				'default'    => 'default',
				'type'       => 'control',
				'control'    => 'select',
				'label'      => esc_html__( 'Type', 'colormag' ),
				'section'    => 'colormag_blog_section',
				'choices'    => array(
					'default'             => esc_html__( 'Default', 'colormag' ),
					'numbered_pagination' => esc_html__( 'Numbered', 'colormag' ),
				),
				'dependency' => array(
					'colormag_enable_pagination',
					'==',
					true,
				),
				'priority'   => 30,
			),
		);

		$options = array_merge( $options, $configs );

		return $options;
	}

}

return new ColorMag_Customize_Blog_Archive_Options();
