<?php
/**
 * Class to include Front Page General customize options.
 *
 * Class ColorMag_Customize_Front_Page_General_Options
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
 * Class to include Front Page customize options.
 *
 * Class ColorMag_Customize_Front_Page_Options
 */
class ColorMag_Customize_Front_Page_General_Options extends ColorMag_Customize_Base_Option {

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

			// Front page posts/pages display option.
			array(
				'name'     => 'colormag_hide_blog_static_page_post',
				'default'  => false,
				'type'     => 'control',
				'control'  => 'colormag-toggle',
				'label'    => esc_html__( 'Hide blog posts/static page', 'colormag' ),
				'section'  => 'colormag_front_page_general_section',
				'priority' => 10,
			),

			// Unique posts enable/disable option.
			array(
				'name'     => 'colormag_enable_unique_post_system',
				'default'  => false,
				'type'     => 'control',
				'control'  => 'colormag-toggle',
				'label'    => esc_html__( 'Unique Post System', 'colormag' ),
				'section'  => 'colormag_front_page_general_section',
				'priority' => 20,
			),
		);

		$options = array_merge( $options, $configs );

		return $options;
	}

}

return new ColorMag_Customize_Front_Page_General_Options();
