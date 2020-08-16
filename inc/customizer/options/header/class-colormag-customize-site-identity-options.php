<?php
/**
 * Class to include Site Identity customize options.
 *
 * Class ColorMag_Customize_Site_Identity_Options
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
 * Class to include Site Identity customize options.
 *
 * Class ColorMag_Customize_Site_Identity_Options
 */
class ColorMag_Customize_Site_Identity_Options extends ColorMag_Customize_Base_Option {

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

			// Visibility header separator.
			array(
				'name'     => 'colormag_front_page_heading',
				'type'     => 'control',
				'control'  => 'colormag-heading',
				'label'    => esc_html__( 'Visibility', 'colormag' ),
				'section'  => 'title_tagline',
				'priority' => 20,
			),

			// Header logo placement option.
			array(
				'name'     => 'colormag_header_logo_placement',
				'default'  => 'header_text_only',
				'type'     => 'control',
				'control'  => 'radio',
				'label'    => esc_html__( 'Choose the option that you want', 'colormag' ),
				'section'  => 'title_tagline',
				'choices'  => array(
					'header_logo_only' => esc_html__( 'Header Logo Only', 'colormag' ),
					'header_text_only' => esc_html__( 'Header Text Only', 'colormag' ),
					'show_both'        => esc_html__( 'Show Both', 'colormag' ),
					'disable'          => esc_html__( 'Disable', 'colormag' ),
				),
				'priority' => 30,
			),

		);

		$options = array_merge( $options, $configs );

		return $options;
	}

}

return new ColorMag_Customize_Site_Identity_Options();
