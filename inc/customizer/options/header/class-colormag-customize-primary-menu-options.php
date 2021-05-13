<?php
/**
 * Class to include Header Primary Menu customize options.
 *
 * Class ColorMag_Customize_Primary_Menu_Options
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

			/**
			 * Home icon options.
			 */
			// Home icon in menu heading separator.
			array(
				'name'     => 'colormag_home_icon_display_heading',
				'type'     => 'control',
				'control'  => 'colormag-title',
				'label'    => esc_html__( 'Show Home Icon', 'colormag' ),
				'section'  => 'colormag_primary_menu_section',
				'priority' => 10,
			),

			// Home icon in menu display option.
			array(
				'name'      => 'colormag_home_icon_display',
				'default'   => 0,
				'type'      => 'control',
				'control'   => 'checkbox',
				'label'       => esc_html__( 'Enable', 'colormag' ),
				'description' => esc_html__( 'Check to show the Home Icon in the primary menu', 'colormag' ),
				'section'   => 'colormag_primary_menu_section',
				'transport' => $customizer_selective_refresh,
				'partial'   => array(
					'selector' => '.home-icon',
				),
				'priority'  => 20,
			),

			/**
			 * Search icon options.
			 */
			// Search icon in menu heading separator.
			array(
				'name'     => 'colormag_search_icon_in_menu_heading',
				'type'     => 'control',
				'control'  => 'colormag-title',
				'label'    => esc_html__( 'Search Icon', 'colormag' ),
				'section'  => 'colormag_primary_menu_section',
				'priority' => 30,
			),

			// Search icon in menu display option.
			array(
				'name'     => 'colormag_search_icon_in_menu',
				'default'  => 0,
				'type'     => 'control',
				'control'  => 'checkbox',
				'label'       => esc_html__( 'Enable', 'colormag' ),
				'description' => esc_html__( 'Check to display the Search Icon in the primary menu', 'colormag' ),
				'section'  => 'colormag_primary_menu_section',
				'priority' => 40,
			),

			/**
			 * Random posts icon options.
			 */
			// Random posts icon in menu heading separator.
			array(
				'name'     => 'colormag_random_post_in_menu_heading',
				'type'     => 'control',
				'control'  => 'colormag-title',
				'label'    => esc_html__( 'Random Post', 'colormag' ),
				'section'  => 'colormag_primary_menu_section',
				'priority' => 50,
			),

			// Random posts icon in menu display option.
			array(
				'name'      => 'colormag_random_post_in_menu',
				'default'   => 0,
				'type'      => 'control',
				'control'   => 'checkbox',
				'label'       => esc_html__( 'Enable', 'colormag' ),
				'description' => esc_html__( 'Check to display the Random Post Icon in the primary menu', 'colormag' ),
				'section'   => 'colormag_primary_menu_section',
				'transport' => $customizer_selective_refresh,
				'partial'   => array(
					'selector'        => '.random-post',
					'render_callback' => array(
						'ColorMag_Customizer_Partials',
						'render_random_post',
					),
				),
				'priority'  => 60,
			),

			/**
			 * Responsive menu options.
			 */
			// Responsive menu heading separator.
			array(
				'name'     => 'colormag_responsive_menu_heading',
				'type'     => 'control',
				'control'  => 'colormag-title',
				'label'    => esc_html__( 'Responsive Menu Style', 'colormag' ),
				'section'  => 'colormag_primary_menu_section',
				'priority' => 70,
			),

			// New responsive menu enable/disable option.
			array(
				'name'     => 'colormag_responsive_menu',
				'default'  => 0,
				'type'     => 'control',
				'control'  => 'checkbox',
				'label'       => esc_html__( 'Enable', 'colormag' ),
				'description' => esc_html__( 'Check to enable Responsive Menu Style', 'colormag' ),
				'section'  => 'colormag_primary_menu_section',
				'priority' => 80,
			),

			array(
				'name'        => 'colormag_primary_menu_upgrade',
				'type'        => 'control',
				'control'     => 'colormag-upgrade',
				'label'       => esc_html__( 'Learn more', 'colormag' ),
				'description' => esc_html__( 'Unlock more features available for this section.', 'colormag' ),
				'url'         => esc_url( 'https://themegrill.com/colormag-pricing/' ),
				'section'     => 'colormag_primary_menu_section',
				'priority'    => 100,
			),

		);

		$options = array_merge( $options, $configs );

		return $options;

	}

}

return new ColorMag_Customize_Primary_Menu_Options();
