<?php
/**
 * Class to include Additional customize options.
 *
 * Class ColorMag_Customize_Additional_General_Options
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
 * Class to include Additional customize option.
 *
 * Class ColorMag_Customize_Additional_General_Options
 */
class ColorMag_Customize_Additional_General_Options extends ColorMag_Customize_Base_Option {

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
			 * Schema Markup.
			 */
			array(
				'name'     => 'colormag_schema_markup_heading',
				'type'     => 'control',
				'control'  => 'colormag-title',
				'label'    => esc_html__( 'Schema Markup', 'colormag' ),
				'section'  => 'colormag_additional_general_section',
				'priority' => 10,
			),

			array(
				'name'        => 'colormag_enable_schema_markup',
				'default'     => 0,
				'type'        => 'control',
				'control'     => 'colormag-toggle',
				'label'       => esc_html__( 'Enable', 'colormag' ),
				'description' => esc_html__( 'Check to enable schema markup.', 'colormag' ),
				'section'     => 'colormag_additional_general_section',
				'priority'    => 20,
			),

		);

		$options = array_merge( $options, $configs );

		return $options;
	}

}

return new ColorMag_Customize_Additional_General_Options();
