<?php
/**
 * Class to include Header Top Bar customize options.
 *
 * Class ColorMag_Customize_Header_Top_Bar_Options
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
 * Class to include Header Top Bar customize options.
 *
 * Class ColorMag_Customize_Header_Top_Bar_Options
 */
class ColorMag_Customize_Header_Top_Bar_Options extends ColorMag_Customize_Base_Option {

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

			/**
			 * Top bar enable.
			 */
			array(
				'name'     => 'colormag_top_bar_title',
				'type'     => 'control',
				'control'  => 'colormag-title',
				'label'    => esc_html__( 'Top Bar', 'colormag' ),
				'section'  => 'colormag_top_bar_section',
				'priority' => 10,
			),

			array(
				'name'     => 'colormag_general_subtitle',
				'type'     => 'control',
				'control'  => 'colormag-subtitle',
				'label'    => esc_html__( 'General', 'colormag' ),
				'section'  => 'colormag_top_bar_section',
				'priority' => 20,
			),

			array(
				'name'     => 'colormag_enable_top_bar',
				'default'  => 0,
				'type'     => 'control',
				'control'  => 'colormag-toggle',
				'label'    => esc_html__( 'Enable', 'colormag' ),
				'section'  => 'colormag_top_bar_section',
				'priority' => 30,
			),

			array(
				'name'       => 'colormag_top_bar_full_width',
				'default'    => 0,
				'type'       => 'control',
				'control'    => 'colormag-toggle',
				'label'      => esc_html__( 'Full Width', 'colormag' ),
				'section'    => 'colormag_top_bar_section',
				'dependency' => array(
					'colormag_enable_top_bar',
					'==',
					true,
				),
				'priority'   => 40,
			),

			array(
				'name'       => 'colormag_style_divider',
				'default'    => 0,
				'type'       => 'control',
				'control'    => 'colormag-divider',
				'style'      => 'dashed',
				'section'    => 'colormag_top_bar_section',
				'dependency' => array(
					'colormag_enable_top_bar',
					'==',
					true,
				),
				'priority'   => 50,
			),

			array(
				'name'     => 'colormag_top_bar_style_subtitle',
				'type'     => 'control',
				'control'  => 'colormag-subtitle',
				'label'    => esc_html__( 'Style', 'colormag' ),
				'section'  => 'colormag_top_bar_section',
				'priority' => 60,
			),

			array(
				'name'     => 'colormag_top_bar_background_color_group',
				'type'     => 'control',
				'control'  => 'colormag-group',
				'label'    => esc_html__( 'Background', 'colormag' ),
				'section'  => 'colormag_top_bar_section',
				'priority' => 70,
			),

			array(
				'name'       => 'colormag_top_bar_background_color',
				'default'    => '#fff',
				'type'       => 'sub-control',
				'control'    => 'colormag-color',
				'parent'     => 'colormag_top_bar_background_color_group',
				'section'    => 'colormag_top_bar_section',
				'dependency' => array(
					'colormag_enable_top_bar',
					'==',
					true,
				),
				'priority'   => 80,
			),


			/**
			 * Top bar border bottom styling options.
			 */
			array(
				'name'        => 'colormag_top_bar_border_bottom_size',
				'default'     => array(
					'size' => '',
					'unit' => 'px',
				),
				'suffix'      => array( 'px' ),
				'type'        => 'control',
				'control'     => 'colormag-slider',
				'label'       => esc_html__( 'Border Bottom Size', 'colormag' ),
				'section'     => 'colormag_top_bar_section',
				'input_attrs' => array(
					'px' => array(
						'min'  => 0,
						'max'  => 20,
						'step' => 1,
					),
				),
				'dependency'  => array(
					'colormag_enable_top_bar',
					'==',
					true,
				),
				'transport'   => 'postMessage',
				'priority'    => 80,
			),

			array(
				'name'       => 'colormag_top_bar_border_bottom_color',
				'default'    => '',
				'type'       => 'control',
				'control'    => 'colormag-color',
				'label'      => esc_html__( 'Border Bottom Color', 'colormag' ),
				'section'    => 'colormag_top_bar_section',
				'dependency' => array(
					'colormag_enable_top_bar',
					'==',
					true,
				),
				'transport'  => 'postMessage',
				'priority'   => 90,
			),

			/**
			 * Show Date.
			 */
			array(
				'name'       => 'olormag_display_date_heading',
				'type'       => 'control',
				'control'    => 'colormag-title',
				'label'      => esc_html__( 'Date', 'colormag' ),
				'section'    => 'colormag_top_bar_section',
				'dependency' => array(
					'colormag_enable_top_bar',
					'==',
					true,
				),
				'priority'   => 100,
			),

			// Date in header display option.
			array(
				'name'        => 'colormag_date_display',
				'default'     => false,
				'type'        => 'control',
				'control'     => 'colormag-toggle',
				'label'       => esc_html__( 'Enable', 'colormag' ),
				'description' => esc_html__( 'Check to show the date in header', 'colormag' ),
				'section'     => 'colormag_top_bar_section',
				'transport'   => $customizer_selective_refresh,
				'partial'     => array(
					'selector'        => '.date-in-header',
					'render_callback' => array(
						'ColorMag_Customizer_Partials',
						'render_current_date',
					),
				),
				'dependency'  => array(
					'colormag_enable_top_bar',
					'==',
					true,
				),
				'priority'    => 110,
			),

			// Date in header display type option.
			array(
				'name'        => 'colormag_date_display_type',
				'default'     => 'theme_default',
				'type'        => 'control',
				'control'     => 'select',
				'label'       => esc_html__( 'Date Format', 'colormag' ),
				'description' => esc_html__( 'Date in header display type:', 'colormag' ),
				'section'     => 'colormag_top_bar_section',
				'transport'   => $customizer_selective_refresh,
				'choices'     => array(
					'theme_default'          => esc_html__( 'Theme Default Setting', 'colormag' ),
					'wordpress_date_setting' => esc_html__( 'From WordPress Date Setting', 'colormag' ),
				),
				'partial'     => array(
					'selector'        => '.date-in-header',
					'render_callback' => array(
						'ColorMag_Customizer_Partials',
						'render_date_display_type',
					),
				),
				'dependency'  => array(
					'colormag_date_display',
					'!=',
					0,
				),
				'priority'    => 120,
			),

			/**
			 * Breaking news.
			 */
			array(
				'name'       => 'colormag_top_bar_news_ticker_title',
				'type'       => 'control',
				'control'    => 'colormag-title',
				'label'      => esc_html__( 'News Ticker', 'colormag' ),
				'section'    => 'colormag_top_bar_section',
				'dependency' => array(
					'colormag_enable_top_bar',
					'==',
					true,
				),
				'priority'   => 130,
			),

			array(
				'name'          => 'colormag_news_ticker_navigate',
				'type'          => 'control',
				'control'       => 'colormag-navigate',
				'section'       => 'colormag_top_bar_section',
				'navigate_info' => array(
					'target_id'    => 'colormag_news_ticker_section',
					'target_label' => esc_html__( 'News Ticker', 'colormag' ),
				),
				'dependency'    => array(
					'colormag_enable_top_bar',
					'==',
					true,
				),
				'priority'      => 140,
			),

			// Social Icons.
			array(
				'name'       => 'colormag_top_bar_social_icons_heading',
				'type'       => 'control',
				'control'    => 'colormag-title',
				'label'      => esc_html__( 'Social Icons', 'colormag' ),
				'section'    => 'colormag_top_bar_section',
				'dependency' => array(
					'colormag_enable_top_bar',
					'==',
					true,
				),
				'priority'   => 150,
			),

			array(
				'name'          => 'colormag_top_bar_social_icons_navigate',
				'type'          => 'control',
				'control'       => 'colormag-navigate',
				'section'       => 'colormag_top_bar_section',
				'navigate_info' => array(
					'target_id'    => 'colormag_social_icons_section',
					'target_label' => esc_html__( 'Social Icons', 'colormag' ),
				),
				'dependency'    => array(
					'colormag_enable_top_bar',
					'==',
					true,
				),
				'priority'      => 160,
			),

			// Menu.
			array(
				'name'       => 'colormag_top_bar_menu_heading',
				'type'       => 'control',
				'control'    => 'colormag-title',
				'label'      => esc_html__( 'Menu', 'colormag' ),
				'section'    => 'colormag_top_bar_section',
				'dependency' => array(
					'colormag_enable_top_bar',
					'==',
					true,
				),
				'priority'   => 170,
			),

			array(
				'name'       => 'colormag_top_bar_menu_enable',
				'type'       => 'control',
				'default'    => 0,
				'control'    => 'colormag-toggle',
				'label'      => esc_html__( 'Enable', 'colormag' ),
				'section'    => 'colormag_top_bar_section',
				'dependency' => array(
					'colormag_enable_top_bar',
					'==',
					true,
				),
				'priority'   => 180,
			),

			array(
				'name'          => 'colormag_top_bar_menu',
				'default'       => 0,
				'type'          => 'control',
				'control'       => 'colormag-navigate',
				'section'       => 'colormag_top_bar_section',
				'navigate_info' => array(
					'target_id'    => 'add_menu',
					'target_label' => esc_html__( 'Menus', 'colormag' ),
				),
				'priority'      => 190,
				'dependency'    => array(
					'colormag_top_bar_menu_enable',
					'==',
					'1',
				),
			),

			/**
			 * Top bar color styling options.
			 */
			array(
				'name'       => 'colormag_top_bar_text_heading',
				'type'       => 'control',
				'control'    => 'colormag-title',
				'label'      => esc_html__( 'Text', 'colormag' ),
				'section'    => 'colormag_top_bar_section',
				'dependency' => array(
					'colormag_enable_top_bar',
					'==',
					true,
				),
				'priority'   => 200,
			),

			array(
				'name'       => 'colormag_top_bar_text_color_group',
				'type'       => 'control',
				'control'    => 'colormag-group',
				'label'      => esc_html__( 'Color', 'colormag' ),
				'section'    => 'colormag_top_bar_section',
				'dependency' => array(
					'colormag_enable_top_bar',
					'==',
					true,
				),
				'priority'   => 210,
			),

			array(
				'name'       => 'colormag_top_bar_text_color',
				'default'    => '#555',
				'type'       => 'sub-control',
				'control'    => 'colormag-color',
				'parent'     => 'colormag_top_bar_text_color_group',
				'section'    => 'colormag_top_bar_section',
				'dependency' => array(
					'colormag_enable_top_bar',
					'==',
					true,
				),
				'priority'   => 220,
			),

			array(
				'name'       => 'colormag_top_bar_label_heading',
				'type'       => 'control',
				'control'    => 'colormag-title',
				'label'      => esc_html__( 'Label', 'colormag' ),
				'section'    => 'colormag_top_bar_section',
				'dependency' => array(
					'colormag_enable_top_bar',
					'==',
					true,
				),
				'priority'   => 230,
			),

			array(
				'name'       => 'colormag_top_bar_label_color_group',
				'type'       => 'control',
				'control'    => 'colormag-group',
				'label'      => esc_html__( 'Color', 'colormag' ),
				'section'    => 'colormag_top_bar_section',
				'dependency' => array(
					'colormag_enable_top_bar',
					'==',
					true,
				),
				'priority'   => 240,
			),

			array(
				'name'       => 'colormag_top_bar_label_color',
				'default'    => '#555',
				'type'       => 'sub-control',
				'control'    => 'colormag-color',
				'parent'     => 'colormag_top_bar_label_color_group',
				'section'    => 'colormag_top_bar_section',
				'dependency' => array(
					'colormag_enable_top_bar',
					'==',
					true,
				),
				'priority'   => 250,
			),

			array(
				'name'       => 'colormag_top_bar_links_heading',
				'type'       => 'control',
				'control'    => 'colormag-title',
				'label'      => esc_html__( 'Links', 'colormag' ),
				'section'    => 'colormag_top_bar_section',
				'dependency' => array(
					'colormag_enable_top_bar',
					'==',
					true,
				),
				'priority'   => 260,
			),

			array(
				'name'       => 'colormag_top_bar_link_color_group',
				'label'      => esc_html__( 'Color', 'colormag' ),
				'default'    => '',
				'type'       => 'control',
				'control'    => 'colormag-group',
				'section'    => 'colormag_top_bar_section',
				'dependency' => array(
					'colormag_enable_top_bar',
					'==',
					true,
				),
				'priority'   => 270,
			),

			array(
				'name'       => 'colormag_top_bar_link_color',
				'default'    => '#207daf',
				'type'       => 'sub-control',
				'control'    => 'colormag-color',
				'tab'        => esc_html__( 'Normal', 'colormag' ),
				'section'    => 'colormag_top_bar_section',
				'parent'     => 'colormag_top_bar_link_color_group',
				'dependency' => array(
					'colormag_enable_top_bar',
					'==',
					true,
				),
				'priority'   => 280,
			),

			array(
				'name'       => 'colormag_top_bar_link_hover_color',
				'default'    => '',
				'type'       => 'sub-control',
				'control'    => 'colormag-color',
				'label'      => esc_html__( 'Color', 'colormag' ),
				'tab'        => esc_html__( 'Hover', 'colormag' ),
				'section'    => 'colormag_top_bar_section',
				'parent'     => 'colormag_top_bar_link_color_group',
				'dependency' => array(
					'colormag_enable_top_bar',
					'==',
					true,
				),
				'priority'   => 290,
			),
		);

		$options = array_merge( $options, $configs );

		return $options;
	}

}

return new ColorMag_Customize_Header_Top_Bar_Options();
