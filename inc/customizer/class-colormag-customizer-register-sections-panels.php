<?php
/**
 * Class to register panels and sections for customize options.
 *
 * Class ColorMag_Customize_Register_Section_Panels
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
			 * Panels.
			 */
			array(
				'name'     => 'colormag_global_panel',
				'type'     => 'panel',
				'title'    => esc_html__( 'Global', 'colormag' ),
				'priority' => 10,
			),

			array(
				'name'     => 'colormag_front_page_panel',
				'type'     => 'panel',
				'title'    => esc_html__( 'Front Page', 'colormag' ),
				'priority' => 20,
			),

			array(
				'name'     => 'colormag_header_panel',
				'type'     => 'panel',
				'title'    => esc_html__( 'Header & Navigation', 'colormag' ),
				'priority' => 30,
			),

			array(
				'name'     => 'colormag_content_panel',
				'type'     => 'panel',
				'title'    => esc_html__( 'Content', 'colormag' ),
				'priority' => 40,
			),

			array(
				'name'     => 'colormag_footer_panel',
				'type'     => 'panel',
				'title'    => esc_html__( 'Footer', 'colormag' ),
				'priority' => 50,
			),

			array(
				'name'     => 'colormag_additional_panel',
				'type'     => 'panel',
				'title'    => esc_html__( 'Additional', 'colormag' ),
				'priority' => 60,
			),

			// Separator.
			array(
				'name'             => 'separator',
				'type'             => 'section',
				'priority'         => 80,
				'section_callback' => 'ColorMag_WP_Customize_Separator',
			),

			/**
			 * Global.
			 */
			// Colors.
			array(
				'name'     => 'colormag_global_colors_section',
				'type'     => 'section',
				'title'    => esc_html__( 'Colors', 'colormag' ),
				'panel'    => 'colormag_global_panel',
				'priority' => 10,
			),

			//Category Colors.
			array(
				'name'     => 'colormag_category_colors_section',
				'type'     => 'section',
				'title'    => esc_html__( 'Category Colors', 'colormag' ),
				'panel'    => 'colormag_global_panel',
				'priority' => 20,
			),

			// Container.
			array(
				'name'     => 'colormag_global_container_section',
				'type'     => 'section',
				'title'    => esc_html__( 'Container', 'colormag' ),
				'panel'    => 'colormag_global_panel',
				'priority' => 30,
			),

			// Sidebar.
			array(
				'name'     => 'colormag_global_sidebar_section',
				'type'     => 'section',
				'title'    => esc_html__( 'Sidebar', 'colormag' ),
				'panel'    => 'colormag_global_panel',
				'priority' => 40,
			),

			// Typography.
			array(
				'name'     => 'colormag_global_typography_section',
				'type'     => 'section',
				'title'    => esc_html__( 'Typography', 'colormag' ),
				'panel'    => 'colormag_global_panel',
				'priority' => 50,
			),

			array(
				'name'     => 'colormag_button_section',
				'type'     => 'section',
				'title'    => esc_html__( 'Button', 'colormag' ),
				'panel'    => 'colormag_global_panel',
				'priority' => 51,
			),

			array(
				'name'     => 'colormag_site_layout_section',
				'type'     => 'section',
				'title'    => esc_html__( 'Site Layout', 'colormag' ),
				'panel'    => 'colormag_global_panel',
				'section'  => 'colormag_global_container_section',
				'priority' => 10,
			),

			array(
				'name'     => 'colormag_sidebar_layout_section',
				'type'     => 'section',
				'title'    => esc_html__( 'Sidebar Layout', 'colormag' ),
				'panel'    => 'colormag_global_panel',
				'section'  => 'colormag_global_container_section',
				'priority' => 20,
			),

			array(
				'name'     => 'colormag_container_section',
				'type'     => 'section',
				'title'    => esc_html__( 'Container', 'colormag' ),
				'panel'    => 'colormag_global_panel',
				'section'  => 'colormag_global_container_section',
				'priority' => 30,
			),

			array(
				'name'     => 'colormag_base_typography_section',
				'type'     => 'section',
				'title'    => esc_html__( 'Base', 'colormag' ),
				'panel'    => 'colormag_global_panel',
				'section'  => 'colormag_global_typography_section',
				'priority' => 10,
			),

			/**
			 * Front Page.
			 */
			array(
				'name'     => 'colormag_front_page_general_section',
				'type'     => 'section',
				'title'    => esc_html__( 'General', 'colormag' ),
				'panel'    => 'colormag_front_page_panel',
				'priority' => 0,
			),

			/**
			 * Header.
			 */
			array(
				'name'     => 'colormag_top_bar_section',
				'type'     => 'section',
				'title'    => esc_html__( 'Top Bar', 'colormag' ),
				'panel'    => 'colormag_header_panel',
				'priority' => 10,
			),

			array(
				'name'     => 'colormag_news_ticker_section',
				'type'     => 'section',
				'title'    => esc_html__( 'News Ticker', 'colormag' ),
				'panel'    => 'colormag_header_panel',
				'priority' => 20,
			),

			array(
				'name'             => 'colormag_top_bar_section_separator',
				'type'             => 'section',
				'panel'            => 'colormag_header_panel',
				'priority'         => 30,
				'section_callback' => 'ColorMag_WP_Customize_Separator',
			),

			array(
				'name'     => 'title_tagline',
				'type'     => 'section',
				'title'    => esc_html__( 'Site Identity', 'colormag' ),
				'panel'    => 'colormag_header_panel',
				'priority' => 40,
			),

			array(
				'name'     => 'colormag_primary_header_section',
				'type'     => 'section',
				'title'    => esc_html__( 'Main Header', 'colormag' ),
				'panel'    => 'colormag_header_panel',
				'priority' => 50,
			),

			array(
				'name'     => 'colormag_primary_menu_section',
				'type'     => 'section',
				'title'    => esc_html__( 'Primary Menu', 'colormag' ),
				'panel'    => 'colormag_header_panel',
				'priority' => 60,
			),

			array(
				'name'             => 'colormag_primary_menu_section_separator',
				'type'             => 'section',
				'panel'            => 'colormag_header_panel',
				'priority'         => 70,
				'section_callback' => 'ColorMag_WP_Customize_Separator',
			),

			array(
				'name'     => 'colormag_header_action_section',
				'type'     => 'section',
				'title'    => esc_html__( 'Header Action', 'colormag' ),
				'panel'    => 'colormag_header_panel',
				'priority' => 80,
			),

			array(
				'name'             => 'colormag_header_media_section_separator',
				'type'             => 'section',
				'panel'            => 'colormag_header_panel',
				'priority'         => 90,
				'section_callback' => 'ColorMag_WP_Customize_Separator',
			),

			array(
				'name'             => 'colormag_breadcrumb_section_separator',
				'type'             => 'section',
				'panel'            => 'colormag_header_panel',
				'priority'         => 100,
				'section_callback' => 'ColorMag_WP_Customize_Separator',
			),

			array(
				'name'     => 'colormag_breadcrumb_section',
				'type'     => 'section',
				'title'    => esc_html__( 'Breadcrumb', 'colormag' ),
				'panel'    => 'colormag_header_panel',
				'priority' => 110,
			),

			array(
				'name'             => 'colormag_sticky_header_section_separator',
				'type'             => 'section',
				'panel'            => 'colormag_header_panel',
				'priority'         => 120,
				'section_callback' => 'ColorMag_WP_Customize_Separator',
			),

			array(
				'name'     => 'colormag_sticky_header_section',
				'type'     => 'section',
				'title'    => esc_html__( 'Sticky Header', 'colormag' ),
				'panel'    => 'colormag_header_panel',
				'priority' => 130,
			),

			/**
			 * Content.
			 */
			array(
				'name'     => 'colormag_blog_section',
				'type'     => 'section',
				'title'    => esc_html__( 'Blog', 'colormag' ),
				'panel'    => 'colormag_content_panel',
				'priority' => 10,
			),

			array(
				'name'     => 'colormag_single_post_section',
				'type'     => 'section',
				'title'    => esc_html__( 'Single Post', 'colormag' ),
				'panel'    => 'colormag_content_panel',
				'priority' => 20,
			),

			array(
				'name'     => 'colormag_post_meta_section',
				'type'     => 'section',
				'title'    => esc_html__( 'Post Meta', 'colormag' ),
				'panel'    => 'colormag_content_panel',
				'priority' => 30,
			),

			array(
				'name'     => 'colormag_page_section',
				'type'     => 'section',
				'title'    => esc_html__( 'Page', 'colormag' ),
				'panel'    => 'colormag_content_panel',
				'priority' => 40,
			),

			array(
				'name'     => 'colormag_sidebar_section',
				'type'     => 'section',
				'title'    => esc_html__( 'Sidebar', 'colormag' ),
				'panel'    => 'colormag_content_panel',
				'priority' => 50,
			),

			/**
			 * Footer.
			 */
			array(
				'name'     => 'colormag_footer_column_section',
				'type'     => 'section',
				'title'    => esc_html__( 'Footer Column', 'colormag' ),
				'panel'    => 'colormag_footer_panel',
				'priority' => 10,
			),

			array(
				'name'     => 'colormag_footer_bar_section',
				'type'     => 'section',
				'title'    => esc_html__( 'Footer Bar', 'colormag' ),
				'panel'    => 'colormag_footer_panel',
				'priority' => 20,
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

			/**
			 * WooCommerce.
			 */
			array(
				'name'     => 'colormag_woocommerce_sidebar_section',
				'type'     => 'section',
				'title'    => esc_html__( 'Sidebar', 'colormag' ),
				'panel'    => 'woocommerce',
				'priority' => 30,
			),
		);

		$options = array_merge( $options, $configs );

		return $options;
	}

}

return new ColorMag_Customize_Register_Section_Panels();
