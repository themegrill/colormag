<?php
/**
 * Class to include Breadcrumb customize options.
 *
 * Class ColorMag_Customize_Breadcrumb_Options
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
 * Class to include Breadcrumb customize options.
 *
 * Class ColorMag_Customize_Breadcrumb_Options
 */
class ColorMag_Customize_Breadcrumb_Options extends ColorMag_Customize_Base_Option {

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
				'name'     => 'colormag_breadcrumb_general_heading',
				'type'     => 'control',
				'control'  => 'colormag-title',
				'label'    => esc_html__( 'General', 'colormag' ),
				'section'  => 'colormag_breadcrumb_section',
				'priority' => 10,
			),

			array(
				'name'     => 'colormag_breadcrumb_enable',
				'type'     => 'control',
				'control'  => 'colormag-toggle',
				'label'    => esc_html__( 'Enable', 'colormag' ),
				'section'  => 'colormag_breadcrumb_section',
				'priority' => 20,
			),

			// Breadcrumb options.
			array(
				'name'       => 'colormag_breadcrumb_display',
				'default'    => 'none',
				'type'       => 'control',
				'control'    => 'select',
				'label'      => esc_html__( 'Type', 'colormag' ),
				'section'    => 'colormag_breadcrumb_section',
				'choices'    => array(
					'none'                => esc_html__( 'None', 'colormag' ),
					'yoast_seo_navxt'     => esc_html__( 'Yoast SEO/NavXT', 'colormag' ),
					'colormag_breadcrumb' => esc_html__( 'ColorMag Theme', 'colormag' ),
				),
				'dependency' => array(
					'colormag_breadcrumb_enable',
					'===',
					true,
				),
				'priority'   => 30,
			),

			array(
				'name'       => 'colormag_breadcrumb_label',
				'default'    => esc_html__( 'You are here:', 'colormag' ),
				'type'       => 'control',
				'control'    => 'text',
				'label'      => esc_html__( 'Label', 'colormag' ),
				'section'    => 'colormag_breadcrumb_section',
				'transport'  => $customizer_selective_refresh,
				'partial'    => array(
					'selector'        => '.breadcrumbs .breadcrumb-title',
					'render_callback' => array(
						'ColorMag_Customizer_Partials',
						'render_breadcrumb_label',
					),
				),
				'dependency' => array(
					'colormag_breadcrumb_enable',
					'===',
					true,
				),
				'priority'   => 40,
			),
		);

		$options = array_merge( $options, $configs );

		return $options;
	}

}

return new ColorMag_Customize_Breadcrumb_Options();
