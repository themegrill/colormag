<?php
/**
 * Class to include Widget General customize options.
 *
 * Class ColorMag_Customize_Widget_Options
 *
 * @package    ThemeGrill
 * @subpackage ColorMag
 * @since      ColorMag 3.1.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class to include Widget General customize options.
 *
 * Class ColorMag_Customize_Widget_Options
 */
class ColorMag_Customize_Widget_Options extends ColorMag_Customize_Base_Option {

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
				'name'     => 'colormag_widget_heading',
				'type'     => 'control',
				'control'  => 'colormag-title',
				'label'    => esc_html__( 'Widget Title', 'colormag' ),
				'section'  => 'colormag_widget_section',
				'priority' => 5,
			),

			array(
				'name'     => 'colormag_widget_markup',
				'default'  => 'h3',
				'type'     => 'control',
				'control'  => 'select',
				'label'    => esc_html__( 'Markup', 'colormag' ),
				'section'  => 'colormag_widget_section',
				'priority' => 10,
				'choices'         => array(
					'h2' => esc_html__( 'Heading 2', 'colormag' ),
					'h3' => esc_html__( 'Heading 3', 'colormag' ),
				),
			),
		);

		$options = array_merge( $options, $configs );

		return $options;
	}

}

return new ColorMag_Customize_Widget_Options();
