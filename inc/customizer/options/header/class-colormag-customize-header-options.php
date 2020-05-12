<?php
/**
 * Class to include Header customize options.
 *
 * Class ColorMag_Customize_Header_Options
 *
 * @package    ThemeGrill
 * @subpackage ColorMag
 * @since      ColorMag 2.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class to include Header customize option.
 *
 * Class ColorMag_Customize_Header_Options
 */
class ColorMag_Customize_Header_Options extends ColorMag_Customize_Base_Option {

	/**
	 * Include customize options.
	 *
	 * @param array                 $options      Customize options provided via the theme.
	 * @param \WP_Customize_Manager $wp_customize Theme Customizer object.
	 *
	 * @return mixed|void Customizer options for registering panels, sections as well as controls.
	 */
	public function customizer_options( $options, $wp_customize ) {

		// Customize transport postMessage variable to set `postMessage` or `refresh` as required.
		$customizer_selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';

		$configs = array(

			// Primary sticky menu enable/disable option.
			array(
				'name'    => 'colormag_primary_sticky_menu',
				'default' => 0,
				'type'    => 'control',
				'control' => 'checkbox',
				'label'   => esc_html__( 'Check to enable the sticky behavior of the primary menu', 'colormag' ),
				'section' => 'colormag_primary_sticky_menu_section',
			),

			// Search icon in menu display option.
			array(
				'name'    => 'colormag_search_icon_in_menu',
				'default' => 0,
				'type'    => 'control',
				'control' => 'checkbox',
				'label'   => esc_html__( 'Check to display the Search Icon in the primary menu', 'colormag' ),
				'section' => 'colormag_search_icon_in_menu_section',
			),

			// Random posts icon in menu display option.
			array(
				'name'      => 'colormag_random_post_in_menu',
				'default'   => 0,
				'type'      => 'control',
				'control'   => 'checkbox',
				'label'     => esc_html__( 'Check to display the Random Post Icon in the primary menu', 'colormag' ),
				'section'   => 'colormag_random_post_in_menu_section',
				'transport' => $customizer_selective_refresh,
				'partial'   => array(
					'selector'        => '.random-post',
					'render_callback' => array(
						'ColorMag_Customizer_Partials',
						'render_random_post',
					),
				),
			),

			// New responsive menu enable/disable option.
			array(
				'name'    => 'colormag_responsive_menu',
				'default' => 0,
				'type'    => 'control',
				'control' => 'checkbox',
				'label'   => esc_html__( 'Check to switch to new responsive menu.', 'colormag' ),
				'section' => 'colormag_responsive_menu_section',
			),

		);

		$options = array_merge( $options, $configs );

		return $options;

	}

}

return new ColorMag_Customize_Header_Options();
