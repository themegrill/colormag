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

/**
 * Class to register panels and sections for customize options.
 *
 * Class ColorMag_Customize_Register_Section_Panels
 */
class ColorMag_Customize_Register_Section_Panels extends ColorMag_Customize_Base_Option {

	/**
	 * Include customize options.
	 *
	 * @param array                 $options
	 * @param \WP_Customize_Manager $wp_customize
	 *
	 * @return mixed|void
	 */
	public function customizer_options( $options, $wp_customize ) {

		$configs = array(

			/**
			 * Register panels.
			 */
			// Additional Panel.
			array(
				'name'        => 'colormag_additional_options',
				'type'        => 'panel',
				'title'       => esc_html__( 'Additional Options', 'colormag' ),
				'description' => esc_html__( 'Change the Additional Settings from here as you want', 'colormag' ),
				'priority'    => 515,
			),

			// Category Color Panel.
			array(
				'name'        => 'colormag_category_color_panel',
				'type'        => 'panel',
				'title'       => esc_html__( 'Category Color Options', 'colormag' ),
				'description' => esc_html__( 'Change the color of each category items as you want.', 'colormag' ),
				'priority'    => 535,
			),

			// Design Options.
			array(
				'name'        => 'colormag_design_options',
				'type'        => 'panel',
				'title'       => esc_html__( 'Design Options', 'colormag' ),
				'description' => esc_html__( 'Change the Design Settings from here as you want', 'colormag' ),
				'priority'    => 505,
			),

			// Footer Options.
			array(
				'name'        => 'colormag_footer_options',
				'type'        => 'panel',
				'title'       => esc_html__( 'Footer Options', 'colormag' ),
				'description' => esc_html__( 'Change the Footer Settings from here as you want', 'colormag' ),
				'priority'    => 515,
			),

			// Header Options.
			array(
				'name'        => 'colormag_header_options',
				'type'        => 'panel',
				'title'       => esc_html__( 'Header Options', 'colormag' ),
				'description' => esc_html__( 'Change the Header Settings from here as you want', 'colormag' ),
				'priority'    => 500,
			),

			// Social Options.
			array(
				'name'        => 'colormag_social_links_options',
				'type'        => 'panel',
				'title'       => esc_html__( 'Social Options', 'colormag' ),
				'description' => esc_html__( 'Change the Social Links Settings from here as you want', 'colormag' ),
				'priority'    => 510,
			),

			/**
			 * Register sections.
			 */
			/**
			 * Header sections.
			 */
			// Breaking news section.
			array(
				'name'  => 'colormag_breaking_news_section',
				'type'  => 'section',
				'title' => esc_html__( 'Breaking News', 'colormag' ),
				'panel' => 'colormag_header_options',
			),

			// Date display section.
			array(
				'name'  => 'colormag_date_display_section',
				'type'  => 'section',
				'title' => esc_html__( 'Show Date', 'colormag' ),
				'panel' => 'colormag_header_options',
			),

			// Home icon in primary menu section.
			array(
				'name'  => 'colormag_home_icon_display_section',
				'type'  => 'section',
				'title' => esc_html__( 'Show Home Icon', 'colormag' ),
				'panel' => 'colormag_header_options',
			),

			// Primary sticky menu section.
			array(
				'name'  => 'colormag_primary_sticky_menu_section',
				'type'  => 'section',
				'title' => esc_html__( 'Sticky Menu', 'colormag' ),
				'panel' => 'colormag_header_options',
			),

			// Search icon in menu section.
			array(
				'name'  => 'colormag_search_icon_in_menu_section',
				'type'  => 'section',
				'title' => esc_html__( 'Search Icon', 'colormag' ),
				'panel' => 'colormag_header_options',
			),

			// Random post icon in menu section.
			array(
				'name'  => 'colormag_random_post_in_menu_section',
				'type'  => 'section',
				'title' => esc_html__( 'Random Post', 'colormag' ),
				'panel' => 'colormag_header_options',
			),

			// Header image position section.
			array(
				'name'  => 'colormag_header_image_position_setting',
				'type'  => 'section',
				'title' => esc_html__( 'Header Image Position', 'colormag' ),
				'panel' => 'colormag_header_options',
			),

			// Main total header area display type section.
			array(
				'name'  => 'colormag_main_total_header_area_display_type_option',
				'type'  => 'section',
				'title' => esc_html__( 'Main Header Area Display Type', 'colormag' ),
				'panel' => 'colormag_header_options',
			),

			// Responsive menu style section.
			array(
				'name'  => 'colormag_responsive_menu_section',
				'type'  => 'section',
				'title' => esc_html__( 'Responsive Menu Style', 'colormag' ),
				'panel' => 'colormag_header_options',
			),

		);

		$options = array_merge( $options, $configs );

		return $options;

	}

}

return new ColorMag_Customize_Register_Section_Panels();
