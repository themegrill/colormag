<?php
/**
 * Class to register panels and sections for customize options.
 *
 * Class ColorMag_Customize_Register_Section_Panels
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
 * Class to register panels and sections for customize options.
 *
 * Class ColorMag_Customize_Register_Section_Panels
 */
class ColorMag_Customize_Register_Section_Panels extends ColorMag_Customize_Base_Option {

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

			/**
			 * Register panels.
			 */
			// Header Options.
			array(
				'name'     => 'colormag_header_options',
				'type'     => 'panel',
				'title'    => esc_html__( 'Header Options', 'colormag' ),
				'priority' => 10,
			),

			// Design Options.
			array(
				'name'     => 'colormag_design_options',
				'type'     => 'panel',
				'title'    => esc_html__( 'Design Options', 'colormag' ),
				'priority' => 10,
			),

			// Post/Page/Blog Options.
			array(
				'name'     => 'colormag_blog_options',
				'type'     => 'panel',
				'title'    => esc_html__( 'Post/Page/Blog Options', 'colormag' ),
				'priority' => 10,
			),

			// Category Color Panel.
			array(
				'name'     => 'colormag_category_color_panel',
				'type'     => 'panel',
				'title'    => esc_html__( 'Category Color Options', 'colormag' ),
				'priority' => 535,
			),

			// Footer Options.
			array(
				'name'     => 'colormag_footer_options',
				'type'     => 'panel',
				'title'    => esc_html__( 'Footer Options', 'colormag' ),
				'priority' => 10,
			),

			/**
			 * Register sections.
			 */
			// General sections.
			array(
				'name'     => 'colormag_general_section',
				'type'     => 'section',
				'title'    => esc_html__( 'General Options', 'colormag' ),
				'priority' => 5,
			),

			// Social sections.
			array(
				'name'     => 'colormag_social_section',
				'type'     => 'section',
				'title'    => esc_html__( 'Social Options', 'colormag' ),
				'priority' => 5,
			),

			/**
			 * Header sections.
			 */
			// Header general section.
			array(
				'name'     => 'colormag_header_general_section',
				'type'     => 'section',
				'title'    => esc_html__( 'General', 'colormag' ),
				'panel'    => 'colormag_header_options',
				'priority' => 5,
			),

			// Header top bar section.
			array(
				'name'     => 'colormag_header_top_bar_section',
				'type'     => 'section',
				'title'    => esc_html__( 'Top Bar', 'colormag' ),
				'panel'    => 'colormag_header_options',
				'priority' => 10,
			),

			// Header main area section.
			array(
				'name'     => 'colormag_header_main_area_section',
				'type'     => 'section',
				'title'    => esc_html__( 'Main Area', 'colormag' ),
				'panel'    => 'colormag_header_options',
				'priority' => 15,
			),

			// Site identity section.
			array(
				'name'     => 'title_tagline',
				'type'     => 'section',
				'title'    => esc_html__( 'Site Identity', 'colormag' ),
				'panel'    => 'colormag_header_options',
				'section'  => 'colormag_header_main_area_section',
				'priority' => 5,
			),

			// Header primary menu section.
			array(
				'name'     => 'colormag_header_primary_menu_section',
				'type'     => 'section',
				'title'    => esc_html__( 'Primary Menu', 'colormag' ),
				'panel'    => 'colormag_header_options',
				'priority' => 20,
			),

			/**
			 * Design sections.
			 */
			// General section.
			array(
				'name'     => 'colormag_design_general_section',
				'type'     => 'section',
				'title'    => esc_html__( 'General', 'colormag' ),
				'panel'    => 'colormag_design_options',
				'priority' => 5,
			),

			// Primary color section.
			array(
				'name'  => 'colormag_primary_color_setting',
				'type'  => 'section',
				'title' => esc_html__( 'Primary color option', 'colormag' ),
				'panel' => 'colormag_design_options',
			),

			/**
			 * Post/Page/Blog sections.
			 */
			// Single post section.
			array(
				'name'     => 'colormag_blog_single_post_section',
				'type'     => 'section',
				'title'    => esc_html__( 'Single Post', 'colormag' ),
				'panel'    => 'colormag_blog_options',
				'priority' => 15,
			),

			// Page section.
			array(
				'name'     => 'colormag_blog_single_page_section',
				'type'     => 'section',
				'title'    => esc_html__( 'Page', 'colormag' ),
				'panel'    => 'colormag_blog_options',
				'priority' => 20,
			),

			// Additional Section.
			array(
				'name'     => 'colormag_additional_section',
				'type'     => 'section',
				'title'    => esc_html__( 'Additional Options', 'colormag' ),
				'priority' => 10,
			),

			/**
			 * Footer sections.
			 */
			// General section.
			array(
				'name'     => 'colormag_footer_general_section',
				'type'     => 'section',
				'title'    => esc_html__( 'General', 'colormag' ),
				'panel'    => 'colormag_footer_options',
				'priority' => 5,
			),

			/**
			 * Category color sections.
			 */
			// Category color section.
			array(
				'name'  => 'colormag_category_color_setting',
				'type'  => 'section',
				'title' => esc_html__( 'Category Color Settings', 'colormag' ),
				'panel' => 'colormag_category_color_panel',
			),

		);

		$options = array_merge( $options, $configs );

		return $options;

	}

}

return new ColorMag_Customize_Register_Section_Panels();
