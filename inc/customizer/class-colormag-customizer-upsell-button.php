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

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

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

			// View Pro Version section.
			array(
				'name'     => 'colormag_upsell_section',
				'type'     => 'section',
				'title'    => esc_html__( 'View Pro Version', 'colormag' ),
				'priority' => 1,
			),

			// View Pro Version option.
			array(
				'name'     => 'colormag_upsell',
				'type'     => 'control',
				'control'  => 'colormag-upsell',
				'section'  => 'colormag_upsell_section',
				'priority' => 5,
			),

		);

		$options = array_merge( $options, $configs );

		return $options;

	}

}

return new ColorMag_Customizer_Upsell_Button();
