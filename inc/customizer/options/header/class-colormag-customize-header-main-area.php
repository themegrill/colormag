<?php
/**
 * Class to include Header Main Area customize options.
 *
 * Class ColorMag_Customize_Header_Main_Area
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
 * Class to include Header Main Area customize options.
 *
 * Class ColorMag_Customize_Header_Main_Area
 */
class ColorMag_Customize_Header_Main_Area extends ColorMag_Customize_Base_Option {

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

			// Header logo placement option.
			array(
				'name'    => 'colormag_header_logo_placement',
				'default' => 'header_text_only',
				'type'    => 'control',
				'control' => 'radio',
				'label'   => esc_html__( 'Choose the option that you want', 'colormag' ),
				'section' => 'title_tagline',
				'choices' => array(
					'header_logo_only' => esc_html__( 'Header Logo Only', 'colormag' ),
					'header_text_only' => esc_html__( 'Header Text Only', 'colormag' ),
					'show_both'        => esc_html__( 'Show Both', 'colormag' ),
					'disable'          => esc_html__( 'Disable', 'colormag' ),
				),
			),

		);

		$options = array_merge( $options, $configs );

		return $options;

	}

}

return new ColorMag_Customize_Header_Main_Area();
