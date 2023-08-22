<?php
/**
 * Class to include Header Primary Menu customize options.
 *
 * Class ColorMag_Customize_Primary_Menu_Options
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

			array(
				'name'     => 'colormag_primary_menu_heading',
				'type'     => 'control',
				'control'  => 'colormag-title',
				'label'    => esc_html__( 'Primary Menu', 'colormag' ),
				'section'  => 'colormag_primary_menu_section',
				'priority' => 10,
			),

			array(
				'name'     => 'colormag_primary_menu_style_subtitle',
				'type'     => 'control',
				'control'  => 'colormag-subtitle',
				'label'    => esc_html__( 'Style', 'colormag' ),
				'section'  => 'colormag_primary_menu_section',
				'priority' => 20,
			),

			array(
				'name'     => 'colormag_primary_menu_background_group',
				'label'    => esc_html__( 'Background', 'colormag' ),
				'default'  => '',
				'type'     => 'control',
				'control'  => 'colormag-group',
				'section'  => 'colormag_primary_menu_section',
				'priority' => 30,
			),

			array(
				'name'     => 'colormag_primary_menu_background',
				'default'  => array(
					'background-color'      => '#27272A',
					'background-image'      => '',
					'background-position'   => 'center center',
					'background-size'       => 'auto',
					'background-attachment' => 'scroll',
					'background-repeat'     => 'repeat',
				),
				'type'     => 'sub-control',
				'control'  => 'colormag-background',
				'parent'   => 'colormag_primary_menu_background_group',
				'section'  => 'colormag_primary_menu_section',
				'priority' => 40,
			),

			array(
				'name'     => 'colormag_primary_menu_border_top_group',
				'label'    => esc_html__( 'Border Top', 'colormag' ),
				'default'  => '',
				'type'     => 'control',
				'control'  => 'colormag-group',
				'section'  => 'colormag_primary_menu_section',
				'priority' => 50,
			),

			array(
				'name'     => 'colormag_primary_menu_top_border_color',
				'label'    => esc_html__( 'Color', 'colormag' ),
				'default'  => '#207daf',
				'type'     => 'sub-control',
				'control'  => 'colormag-color',
				'parent'   => 'colormag_primary_menu_border_top_group',
				'section'  => 'colormag_primary_menu_section',
				'priority' => 60,
			),

			array(
				'name'     => 'colormag_mobile_menu_heading',
				'type'     => 'control',
				'control'  => 'colormag-title',
				'label'    => esc_html__( 'Mobile Menu', 'colormag' ),
				'section'  => 'colormag_primary_menu_section',
				'priority' => 70,
			),

			array(
				'name'     => 'colormag_mobile_menu_style_subtitle',
				'type'     => 'control',
				'control'  => 'colormag-subtitle',
				'label'    => esc_html__( 'Style', 'colormag' ),
				'section'  => 'colormag_primary_menu_section',
				'priority' => 80,
			),

			array(
				'name'     => 'colormag_mobile_menu_toggle_icon_color',
				'default'  => '#fff',
				'type'     => 'control',
				'control'  => 'colormag-color',
				'label'    => esc_html__( 'Icon Color', 'colormag' ),
				'section'  => 'colormag_primary_menu_section',
				'priority' => 90,
			),

			/**
			 * Home icon options.
			 */
			array(
				'name'     => 'colormag_icon_logo_display_heading',
				'type'     => 'control',
				'control'  => 'colormag-title',
				'label'    => esc_html__( 'Home Icon/Logo', 'colormag' ),
				'section'  => 'colormag_primary_menu_section',
				'priority' => 100,
			),

			// Home icon in menu heading separator.
			array(
				'name'     => 'colormag_menu_icon_logo',
				'default'  => 'none',
				'type'     => 'control',
				'control'  => 'select',
				'section'  => 'colormag_primary_menu_section',
				'priority' => 110,
				'choices'  => array(
					'none'      => esc_html__( 'None', 'colormag' ),
					'home-icon' => esc_html__( 'Home Icon', 'colormag' ),
				),
			),

			// Main Menu.
			array(
				'name'     => 'colormag_main_menu_heading',
				'type'     => 'control',
				'control'  => 'colormag-title',
				'label'    => esc_html__( 'Main Menu', 'colormag' ),
				'section'  => 'colormag_primary_menu_section',
				'priority' => 120,
			),

			// Primary Menu.
			array(
				'name'     => 'colormag_primary_menu_color_group',
				'label'    => esc_html__( 'Color', 'colormag' ),
				'default'  => '',
				'type'     => 'control',
				'control'  => 'colormag-group',
				'section'  => 'colormag_primary_menu_section',
				'priority' => 130,
			),

			array(
				'name'     => 'colormag_primary_menu_text_color',
				'default'  => '',
				'type'     => 'sub-control',
				'control'  => 'colormag-color',
				'parent'   => 'colormag_primary_menu_color_group',
				'tab'      => esc_html__( 'Normal', 'colormag' ),
				'section'  => 'colormag_primary_menu_section',
				'priority' => 140,
			),

			array(
				'name'     => 'colormag_primary_menu_selected_hovered_text_color',
				'default'  => '',
				'type'     => 'sub-control',
				'control'  => 'colormag-color',
				'parent'   => 'colormag_primary_menu_color_group',
				'tab'      => esc_html__( 'Hover/Selected', 'colormag' ),
				'section'  => 'colormag_primary_menu_section',
				'priority' => 150,
			),

			// Sub Menu.
			array(
				'name'     => 'colormag_sub_menu_heading',
				'type'     => 'control',
				'control'  => 'colormag-title',
				'label'    => esc_html__( 'Sub Menu', 'colormag' ),
				'section'  => 'colormag_primary_menu_section',
				'priority' => 160,
			),

			// Background.
			array(
				'name'     => 'colormag_sub_menu_background_group',
				'label'    => esc_html__( 'Background', 'colormag' ),
				'default'  => '',
				'type'     => 'control',
				'control'  => 'colormag-group',
				'section'  => 'colormag_primary_menu_section',
				'priority' => 170,
			),

			array(
				'name'     => 'colormag_primary_sub_menu_background',
				'default'  => array(
					'background-color'      => '#232323',
					'background-image'      => '',
					'background-position'   => 'center center',
					'background-size'       => 'auto',
					'background-attachment' => 'scroll',
					'background-repeat'     => 'repeat',
				),
				'type'     => 'sub-control',
				'control'  => 'colormag-background',
				'parent'   => 'colormag_sub_menu_background_group',
				'section'  => 'colormag_primary_menu_section',
				'priority' => 180,
			),

			array(
				'name'        => 'colormag_primary_menu_upgrade',
				'type'        => 'control',
				'control'     => 'colormag-upgrade',
				'label'       => esc_html__( 'Learn more', 'colormag' ),
				'description' => esc_html__( 'Unlock more features available in Pro version.', 'colormag' ),
				'url'         => esc_url( 'https://themegrill.com/colormag-pricing/' ),
				'section'     => 'colormag_primary_menu_section',
				'priority'    => 1000,
			),
		);

		$options = array_merge( $options, $configs );

		return $options;
	}

}

return new ColorMag_Customize_Primary_Menu_Options();
