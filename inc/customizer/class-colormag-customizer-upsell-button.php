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
	 * @param array                 $options
	 * @param \WP_Customize_Manager $wp_customize
	 *
	 * @return mixed|void
	 */
	public function customizer_options( $options, $wp_customize ) {

		$configs = array();

		$options = array_merge( $options, $configs );

		return $options;

	}

}

return new ColorMag_Customizer_Upsell_Button();
