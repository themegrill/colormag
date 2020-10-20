<?php
/**
 * Class to include Front Page customize options.
 *
 * Class ColorMag_Customize_Front_Page_Options
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
 * Class to include Front Page customize options.
 *
 * Class ColorMag_Customize_Front_Page_Options
 */
class ColorMag_Customize_Front_Page_Options extends ColorMag_Customize_Base_Option {

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
				'name'     => 'colormag_front_page_heading',
				'type'     => 'control',
				'control'  => 'colormag-title',
				'label'    => esc_html__( 'Front Page', 'colormag' ),
				'section'  => 'colormag_front_page_section',
				'priority' => 10,
			),

			// Front page posts/pages display option.
			array(
				'name'     => 'colormag_hide_blog_front',
				'default'  => 0,
				'type'     => 'control',
				'control'  => 'checkbox',
				'label'    => esc_html__( 'Check to hide blog posts/static page on front page', 'colormag' ),
				'section'  => 'colormag_front_page_section',
				'priority' => 20,
			),
		);

		$options = array_merge( $options, $configs );

		return $options;
	}

}

return new ColorMag_Customize_Front_Page_Options();
