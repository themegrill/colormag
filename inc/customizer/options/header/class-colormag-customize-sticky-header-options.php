<?php
/**
 * Class to include Header Primary Menu customize options.
 *
 * Class ColorMag_Customize_Sticky_Header_Options
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
 * Class ColorMag_Customize_Sticky_Header_Options
 */
class ColorMag_Customize_Sticky_Header_Options extends ColorMag_Customize_Base_Option {

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
			 * Sticky menu options.
			 */
			// Sticky menu heading separator.
			array(
				'name'     => 'colormag_primary_sticky_menu_heading',
				'type'     => 'control',
				'control'  => 'colormag-title',
				'label'    => esc_html__( 'Sticky Menu', 'colormag' ),
				'section'  => 'colormag_sticky_header_section',
				'priority' => 5,
			),

			// Primary sticky menu enable/disable option.
			array(
				'name'     => 'colormag_primary_sticky_menu',
				'default'  => 0,
				'type'     => 'control',
				'control'  => 'checkbox',
				'label'    => esc_html__( 'Enable', 'colormag' ),
				'section'  => 'colormag_sticky_header_section',
				'priority' => 10,
			),

		);

		$options = array_merge( $options, $configs );

		return $options;

	}

}

return new ColorMag_Customize_Sticky_Header_Options();
