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
	public function register_options( $options, $wp_customize ) {

		$configs = array(

			/**
			 * Register panels.
			 */
			// Global Options.
			array(
				'name'     => 'colormag_global_panel',
				'type'     => 'panel',
				'title'    => esc_html__( 'Global', 'colormag' ),
				'priority' => 10,
			),

			// Front Page Options.
			array(
				'name'     => 'colormag_front_page_panel',
				'type'     => 'panel',
				'title'    => esc_html__( 'Front Page', 'colormag' ),
				'priority' => 20,
			),

			// Front Page General Options.
			array(
				'name'     => 'colormag_front_page_general_section',
				'type'     => 'section',
				'title'    => esc_html__( 'General', 'colormag' ),
				'panel'    => 'colormag_front_page_panel',
				'priority' => 10,
			),

			// Header Options.
			array(
				'name'     => 'colormag_header_panel',
				'type'     => 'panel',
				'title'    => esc_html__( 'Header', 'colormag' ),
				'priority' => 30,
			),

			// Content Options.
			array(
				'name'     => 'colormag_content_panel',
				'type'     => 'panel',
				'title'    => esc_html__( 'Content', 'colormag' ),
				'priority' => 40,
			),

			// Footer Options.
			array(
				'name'     => 'colormag_footer_panel',
				'type'     => 'panel',
				'title'    => esc_html__( 'Footer', 'colormag' ),
				'priority' => 50,
			),

			// Additional Options.
			array(
				'name'     => 'colormag_additional_panel',
				'type'     => 'panel',
				'title'    => esc_html__( 'Additional', 'colormag' ),
				'priority' => 60,
			),

			/**
			 * Register sections.
			 */
			// Color.
			array(
				'name'     => 'colormag_global_colors_section',
				'type'     => 'section',
				'title'    => esc_html__( 'Colors', 'colormag' ),
				'panel'    => 'colormag_global_panel',
				'priority' => 10,
			),

			array(
				'name'     => 'colormag_primary_colors_section',
				'type'     => 'section',
				'title'    => esc_html__( 'Primary Colors', 'colormag' ),
				'panel'    => 'colormag_global_panel',
				'section'  => 'colormag_global_colors_section',
				'priority' => 10,
			),

			array(
				'name'     => 'colormag_skin_color_section',
				'type'     => 'section',
				'title'    => esc_html__( 'Skin Color', 'colormag' ),
				'panel'    => 'colormag_global_panel',
				'section'  => 'colormag_global_colors_section',
				'priority' => 40,
			),

			array(
				'name'     => 'colormag_category_colors_section',
				'type'     => 'section',
				'title'    => esc_html__( 'Category Colors', 'colormag' ),
				'panel'    => 'colormag_global_panel',
				'section'  => 'colormag_global_colors_section',
				'priority' => 40,
			),

			// Background.
			array(
				'name'     => 'colormag_global_background_section',
				'type'     => 'section',
				'title'    => esc_html__( 'Background', 'colormag' ),
				'panel'    => 'colormag_global_panel',
				'priority' => 20,
			),

			// Layout.
			array(
				'name'     => 'colormag_global_layout_section',
				'type'     => 'section',
				'title'    => esc_html__( 'Layout', 'colormag' ),
				'panel'    => 'colormag_global_panel',
				'priority' => 30,
			),

			array(
				'name'     => 'colormag_site_layout_section',
				'type'     => 'section',
				'title'    => esc_html__( 'Site Layout', 'colormag' ),
				'panel'    => 'colormag_global_panel',
				'section'  => 'colormag_global_layout_section',
				'priority' => 10,
			),

			array(
				'name'     => 'colormag_sidebar_layout_section',
				'type'     => 'section',
				'title'    => esc_html__( 'Sidebar Layout', 'colormag' ),
				'panel'    => 'colormag_global_panel',
				'section'  => 'colormag_global_layout_section',
				'priority' => 20,
			),

			/**
			 * Header.
			 */
			array(
				'name'     => 'title_tagline',
				'type'     => 'section',
				'title'    => esc_html__( 'Site Identity', 'colormag' ),
				'panel'    => 'colormag_header_panel',
				'priority' => 5,
			),

			array(
				'name'     => 'colormag_top_bar_section',
				'type'     => 'section',
				'title'    => esc_html__( 'Top Bar', 'colormag' ),
				'panel'    => 'colormag_header_panel',
				'priority' => 20,
			),

			array(
				'name'     => 'colormag_primary_header_section',
				'type'     => 'section',
				'title'    => esc_html__( 'Primary Header', 'colormag' ),
				'panel'    => 'colormag_header_panel',
				'priority' => 30,
			),

			array(
				'name'     => 'colormag_primary_menu_section',
				'type'     => 'section',
				'title'    => esc_html__( 'Primary Menu', 'colormag' ),
				'panel'    => 'colormag_header_panel',
				'priority' => 40,
			),

			array(
				'name'     => 'colormag_sticky_header_section',
				'type'     => 'section',
				'title'    => esc_html__( 'Sticky Header', 'colormag' ),
				'panel'    => 'colormag_header_panel',
				'priority' => 50,
			),

			/**
			 * Content.
			 */
			array(
				'name'     => 'colormag_single_post_section',
				'type'     => 'section',
				'title'    => esc_html__( 'Single Post', 'colormag' ),
				'panel'    => 'colormag_content_panel',
				'priority' => 20,
			),

			array(
				'name'     => 'colormag_page_section',
				'type'     => 'section',
				'title'    => esc_html__( 'Page', 'colormag' ),
				'panel'    => 'colormag_content_panel',
				'priority' => 40,
			),

			/**
			 * Footer.
			 */
			array(
				'name'     => 'colormag_footer_general_section',
				'type'     => 'section',
				'title'    => esc_html__( 'General', 'colormag' ),
				'panel'    => 'colormag_footer_panel',
				'priority' => 10,
			),

			/**
			 * Additional.
			 */
			array(
				'name'     => 'colormag_social_icons_section',
				'type'     => 'section',
				'title'    => esc_html__( 'Social Icons', 'colormag' ),
				'panel'    => 'colormag_additional_panel',
				'priority' => 20,
			),

		);

		$options = array_merge( $options, $configs );

		return $options;

	}

}

return new ColorMag_Customize_Register_Section_Panels();
