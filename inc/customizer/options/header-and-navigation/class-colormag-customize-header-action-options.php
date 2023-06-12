<?php
/**
 * Class to include Header Action customize options.
 *
 * Class ColorMag_Customize_Header_Action_Options
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
 * Class to include Header Action customize options.
 *
 * Class ColorMag_Customize_Heaeder_Action_Options
 */
class ColorMag_Customize_Header_Action_Options extends ColorMag_Customize_Base_Option {

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

			// Search Icon.
			array(
				'name'     => 'colormag_search_icon_in_menu_heading',
				'type'     => 'control',
				'control'  => 'colormag-title',
				'label'    => esc_html__( 'Search', 'colormag' ),
				'section'  => 'colormag_header_action_section',
				'priority' => 10,
			),

			array(
				'name'     => 'colormag_enable_search',
				'default'  => 0,
				'type'     => 'control',
				'control'  => 'colormag-toggle',
				'label'    => esc_html__( 'Enable', 'colormag' ),
				'section'  => 'colormag_header_action_section',
				'priority' => 20,
			),

			// Random Post.
			array(
				'name'     => 'colormag_enable_random_post_heading',
				'type'     => 'control',
				'control'  => 'colormag-title',
				'label'    => esc_html__( 'Random Post', 'colormag' ),
				'section'  => 'colormag_header_action_section',
				'priority' => 30,
			),

			array(
				'name'      => 'colormag_enable_random_post',
				'default'   => 0,
				'type'      => 'control',
				'control'   => 'colormag-toggle',
				'label'     => esc_html__( 'Enable', 'colormag' ),
				'section'   => 'colormag_header_action_section',
				'transport' => $customizer_selective_refresh,
				'partial'   => array(
					'selector'        => '.cm-random-post',
					'render_callback' => array(
						'ColorMag_Customizer_Partials',
						'render_random_post',
					),
				),
				'priority'  => 40,
			),
		);

		$options = array_merge( $options, $configs );

		return $options;
	}

}

return new ColorMag_Customize_Header_Action_Options();
