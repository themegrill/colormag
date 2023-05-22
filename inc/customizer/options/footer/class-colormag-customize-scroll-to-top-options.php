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
class ColorMag_Customize_Scroll_To_Top_Options extends ColorMag_Customize_Base_Option {

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
				'name'     => 'colormag_footer_scroll_to_top_general_heading',
				'type'     => 'control',
				'control'  => 'colormag-title',
				'label'    => esc_html__( 'General', 'colormag' ),
				'section'  => 'colormag_scroll_to_top_section',
				'priority' => 10,
			),

			// Scroll to top button enable/disable option.
			array(
				'name'     => 'colormag_enable_scroll_to_top',
				'default'  => 0,
				'type'     => 'control',
				'control'  => 'colormag-toggle',
				'label'    => esc_html__( 'Enable', 'colormag' ),
				'section'  => 'colormag_scroll_to_top_section',
				'priority' => 20,
			),
		);

		$options = array_merge( $options, $configs );

		return $options;
	}

}

return new ColorMag_Customize_Scroll_To_Top_Options();
