<?php
/**
 * Class to include Front Page Layout customize options.
 *
 * Class ColorMag_Customize_Front_Page_Layout_Options
 *
 * @package    ThemeGrill
 * @subpackage ColorMag
 * @since      TBD
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class to include Front Page Layout customize options.
 *
 * Class ColorMag_Customize_Front_Page_Layout_Options
 */
class ColorMag_Customize_Front_Page_Layout_Options extends ColorMag_Customize_Base_Option {

	/**
	 * Include customize options.
	 *
	 * @param array                 $options      Customize options provided via the theme.
	 * @param \WP_Customize_Manager $wp_customize Theme Customizer object.
	 *
	 * @return mixed|void Customizer options for registering panels, sections as well as controls.
	 */
	public function register_options( $options, $wp_customize ) {

		// Customize transport postMessage variable to set `postMessage` or `refresh` as required.
		$customizer_selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';

		$configs = array(

			// Top Full Width Container Layout Option.
			array(
				'name'     => 'colormag_top_full_width_container',
				'default'  => 'boxed',
				'type'     => 'control',
				'control'  => 'select',
				'label'    => esc_html__( 'Front Page: Top Full Width Container', 'colormag' ),
				'section'  => 'colormag_front_page_layout_section',
				'priority' => 10,
				'choices'  => array(
					'boxed'   => esc_html__( 'Full Width', 'colormag' ),
					'stretch' => esc_html__( 'Full Width/Content Stretched', 'colormag' ),
				),
			),
		);

		$options = array_merge( $options, $configs );

		return $options;
	}

}

return new ColorMag_Customize_Front_Page_Layout_Options();
