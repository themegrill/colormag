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

			/**
			 * Home icon options.
			 */
			array(
				'name'     => 'colormag_icon_logo_display_heading',
				'type'     => 'control',
				'control'  => 'colormag-title',
				'label'    => esc_html__( 'Home Icon/Logo', 'colormag' ),
				'section'  => 'colormag_primary_menu_section',
				'priority' => 10,
			),

			// Home icon in menu heading separator.
			array(
				'name'     => 'colormag_menu_icon_logo',
				'default'  => 'none',
				'type'     => 'control',
				'control'  => 'select',
				'section'  => 'colormag_primary_menu_section',
				'priority' => 20,
				'choices'  => array(
					'none'      => esc_html__( 'None', 'colormag' ),
					'home-icon' => esc_html__( 'Home Icon', 'colormag' ),
				),
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
