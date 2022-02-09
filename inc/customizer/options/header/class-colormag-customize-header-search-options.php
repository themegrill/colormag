<?php
/**
 * Class to include Header Search customize options.
 *
 * ColorMag_Customize_Header_Search_Options
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
 * Class to include Header Search customize options.
 *
 * Class ColorMag_Customize_Header_Search_Options
 */
class ColorMag_Customize_Header_Search_Options extends ColorMag_Customize_Base_Option {

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
			 * Header Search options.
			 */

			array(
				'name'        => 'colormag_header_search_option',
				'default'     => 'wp_search',
				'label'       => esc_html__( 'Choose a search option', 'colormag' ),
				'description' => esc_html__( 'Applicable to Header Style 1, 2 and 3.', 'colormag' ),
				'section'     => 'colormag_header_search_section',
				'type'        => 'control',
				'control'	  => 'select',
				'choices'     => array(
					'wp_search' => esc_html__( 'WordPress search', 'colormag' ),
					'wc_search' => esc_html__( 'WooCommerce search', 'colormag' ),
				),
				'priority' => 10,
			),
		);

		$options = array_merge( $options, $configs );

		return $options;

	}

}

return new ColorMag_Customize_Header_Search_Options();
