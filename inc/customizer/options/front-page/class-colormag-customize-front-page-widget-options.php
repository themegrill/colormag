<?php
/**
 * Class to include Widget Post Title customize options.
 *
 * Class ColorMag_Customize_Front_Page_Widget_Options
 *
 * @package    ThemeGrill
 * @subpackage ColorMag
 * @since      ColorMag 3.1.2
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class to include Widget Post Title customize options.
 *
 * Class ColorMag_Customize_Front_Page_Widget_Options
 */
class ColorMag_Customize_Front_Page_Widget_Options extends ColorMag_Customize_Base_Option {

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

			array(
				'name'     => 'colormag_front_page_widget_post_title_heading',
				'type'     => 'control',
				'control'  => 'colormag-title',
				'label'    => esc_html__( 'Post Title', 'colormag' ),
				'section'  => 'colormag_front_page_widget_section',
				'priority' => 10,
			),

			array(
				'name'     => 'colormag_front_page_widget_post_title_markup',
				'default'  => 'h3',
				'type'     => 'control',
				'control'  => 'select',
				'label'    => esc_html__( 'Markup', 'colormag' ),
				'section'  => 'colormag_front_page_widget_section',
				'priority' => 20,
				'choices'  => array(
					'h2' => esc_html__( 'Heading 2', 'colormag' ),
					'h3' => esc_html__( 'Heading 3', 'colormag' ),
				),
			),

			array(
				'name'     => 'colormag_front_page_view_all_heading',
				'type'     => 'control',
				'control'  => 'colormag-title',
				'label'    => esc_html__( 'View All Text', 'colormag' ),
				'section'  => 'colormag_front_page_widget_section',
				'priority' => 30,
			),

			// View all button text change option.
			array(
				'name'      => 'colormag_view_all_text',
				'default'   => esc_html__( 'View All', 'colormag' ),
				'type'      => 'control',
				'control'   => 'text',
				'section'   => 'colormag_front_page_widget_section',
				'transport' => $customizer_selective_refresh,
				'partial'   => array(
					'selector'        => '.view-all-link',
					'render_callback' => array(
						'ColorMag_Customizer_Partials',
						'render_view_all_button_text',
					),
				),
				'priority'  => 40,
			),
		);

		$options = array_merge( $options, $configs );

		return $options;
	}

}

return new ColorMag_Customize_Front_Page_Widget_Options();
