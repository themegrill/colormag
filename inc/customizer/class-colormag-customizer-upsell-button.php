<?php
/**
 * Class to include upsell button on customize section.
 *
 * Class ColorMag_Customizer_Upsell_Button
 *
 * @package    ThemeGrill
 * @subpackage ColorMag
 * @since      ColorMag 2.0.0
 */

/**
 * Class to include upsell button on customize section
 *
 * Class ColorMag_Customizer_Upsell_Button
 */
class ColorMag_Customizer_Upsell_Button extends ColorMag_Customize_Base_Option {

	/**
	 * Include customize options.
	 *
	 * @param array                 $options      Customize options provided via the theme.
	 * @param \WP_Customize_Manager $wp_customize Theme Customizer object.
	 *
	 * @return mixed|void Customizer options for registering panels, sections as well as controls.
	 */
	public function customizer_options( $options, $wp_customize ) {

		$configs = array(

			array(
				'name'             => 'colormag_upsell_section',
				'type'             => 'section',
				'title'            => esc_html__( 'View PRO version', 'colormag' ),
				'url'              => 'https://themegrill.com/themes/colormag/?utm_source=colormag-customizer&utm_medium=view-pro-link&utm_campaign=view-pro#free-vs-pro',
				'priority'         => 1,
				'section_callback' => 'ColorMag_Upsell_Section',
			),

		);

		$options = array_merge( $options, $configs );

		return $options;

	}

}

return new ColorMag_Customizer_Upsell_Button();
