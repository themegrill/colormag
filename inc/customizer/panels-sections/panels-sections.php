<?php

$panel_options_id = array(
	'colormag_global_panel'     => array(
		'title'    => esc_html__( 'Global', 'colormag' ),
		'priority' => 10,
	),
	'colormag_front_page_panel' => array(
		'title'    => esc_html__( 'Front Page', 'colormag' ),
		'priority' => 20,
	),
	'colormag_header_panel'     => array(
		'title'    => esc_html__( 'Header & Navigation', 'colormag' ),
		'priority' => 30,
	),
	'colormag_content_panel'    => array(
		'title'    => esc_html__( 'Content', 'colormag' ),
		'priority' => 40,
	),
	'colormag_footer_panel'     => array(
		'title'    => esc_html__( 'Footer', 'colormag' ),
		'priority' => 50,
	),
	'colormag_additional_panel' => array(
		'title'    => esc_html__( 'Additional', 'colormag' ),
		'priority' => 60,
	),
	'woocommerce'               => array(
		'title'    => esc_html__( 'WooCommerce', 'colormag' ),
		'priority' => 70,
	),
	'colormag_header_builder'   => array(
		'title'    => esc_html__( 'Header Builder', 'colormag' ),
		'priority' => 10,
	),
);

$section_option_id = array(
	'colormag_global_colors_section'          => array(
		'title'    => esc_html__( 'Colors', 'colormag' ),
		'panel'    => 'colormag_global_panel',
		'priority' => 10,
	),
	'colormag_category_colors_section'        => array(
		'title'    => esc_html__( 'Category Colors', 'colormag' ),
		'panel'    => 'colormag_global_panel',
		'priority' => 20,
	),
	'colormag_global_container_section'       => array(
		'title'    => esc_html__( 'Container', 'colormag' ),
		'panel'    => 'colormag_global_panel',
		'priority' => 30,
	),
	'colormag_global_sidebar_section'         => array(
		'title'    => esc_html__( 'Sidebar', 'colormag' ),
		'panel'    => 'colormag_global_panel',
		'priority' => 40,
	),
	'colormag_global_typography_section'      => array(
		'title'    => esc_html__( 'Typography', 'colormag' ),
		'panel'    => 'colormag_global_panel',
		'priority' => 50,
	),
	'colormag_button_section'                 => array(
		'title'    => esc_html__( 'Button', 'colormag' ),
		'panel'    => 'colormag_global_panel',
		'priority' => 60,
	),
	'colormag_front_page_general_section'     => array(
		'title'    => esc_html__( 'General', 'colormag' ),
		'panel'    => 'colormag_front_page_panel',
		'priority' => 10,
	),
	'colormag_top_bar_section'                => array(
		'title'    => esc_html__( 'Top Bar', 'colormag' ),
		'panel'    => 'colormag_header_panel',
		'priority' => 10,
	),
	'colormag_news_ticker_section'            => array(
		'title'    => esc_html__( 'News Ticker', 'colormag' ),
		'panel'    => 'colormag_header_panel',
		'priority' => 20,
	),
	'title_tagline'                           => array(
		'title'    => esc_html__( 'Site Identity', 'colormag' ),
		'panel'    => 'colormag_header_panel',
		'priority' => 30,
	),
	'colormag_primary_header_section'         => array(
		'title'    => esc_html__( 'Main Header', 'colormag' ),
		'panel'    => 'colormag_header_panel',
		'priority' => 40,
	),
	'colormag_primary_menu_section'           => array(
		'title'    => esc_html__( 'Primary Menu', 'colormag' ),
		'panel'    => 'colormag_header_panel',
		'priority' => 50,
	),
	'colormag_header_action_section'          => array(
		'title'    => esc_html__( 'Header Action', 'colormag' ),
		'panel'    => 'colormag_header_panel',
		'priority' => 60,
	),
	'colormag_breadcrumb_section'             => array(
		'title'    => esc_html__( 'Breadcrumb', 'colormag' ),
		'panel'    => 'colormag_header_panel',
		'priority' => 70,
	),
	'colormag_sticky_header_section'          => array(
		'title'    => esc_html__( 'Sticky Header', 'colormag' ),
		'panel'    => 'colormag_header_panel',
		'priority' => 80,
	),
	'colormag_blog_section'                   => array(
		'title'    => esc_html__( 'Blog', 'colormag' ),
		'panel'    => 'colormag_content_panel',
		'priority' => 10,
	),
	'colormag_single_post_section'            => array(
		'title'    => esc_html__( 'Single Post', 'colormag' ),
		'panel'    => 'colormag_content_panel',
		'priority' => 20,
	),
	'colormag_post_meta_section'              => array(
		'title'    => esc_html__( 'Post Meta', 'colormag' ),
		'panel'    => 'colormag_content_panel',
		'priority' => 30,
	),
	'colormag_page_section'                   => array(
		'title'    => esc_html__( 'Page', 'colormag' ),
		'panel'    => 'colormag_content_panel',
		'priority' => 40,
	),
	'colormag_footer_column_section'          => array(
		'title'    => esc_html__( 'Footer Column', 'colormag' ),
		'panel'    => 'colormag_footer_panel',
		'priority' => 10,
	),
	'colormag_footer_bar_section'             => array(
		'title'    => esc_html__( 'Footer Bar', 'colormag' ),
		'panel'    => 'colormag_footer_panel',
		'priority' => 20,
	),
	'colormag_social_icons_section'           => array(
		'title'    => esc_html__( 'Social Icons', 'colormag' ),
		'panel'    => 'colormag_additional_panel',
		'priority' => 10,
	),
	'colormag_woocommerce_sidebar_section'    => array(
		'title'    => esc_html__( 'WooCommerce Sidebar', 'colormag' ),
		'panel'    => 'woocommerce',
		'priority' => 20,
	),
	'colormag_header_builder_logo'            => array(
		'title'    => esc_html__( 'Logo', 'colormag' ),
		'panel'    => 'colormag_header_builder',
		'priority' => 10,
	),
	'colormag_header_builder_primary_menu'    => array(
		'title'    => esc_html__( 'Primary Menu', 'colormag' ),
		'panel'    => 'colormag_header_builder',
		'priority' => 10,
	),
	'colormag_header_builder_secondary_menu'  => array(
		'title'    => esc_html__( 'Secondary Menu', 'colormag' ),
		'panel'    => 'colormag_header_builder',
		'priority' => 10,
	),
	'colormag_header_builder_tertiary_menu'   => array(
		'title'    => esc_html__( 'Tertiary Menu', 'colormag' ),
		'panel'    => 'colormag_header_builder',
		'priority' => 10,
	),
	'colormag_header_builder_quaternary_menu' => array(
		'title'    => esc_html__( 'Quaternary Menu', 'colormag' ),
		'panel'    => 'colormag_header_builder',
		'priority' => 10,
	),
	'colormag_header_builder_button_1'        => array(
		'title'    => esc_html__( 'Header Button', 'colormag' ),
		'panel'    => 'colormag_header_builder',
		'priority' => 10,
	),
	'colormag_header_builder_search'          => array(
		'title'    => esc_html__( 'Search', 'colormag' ),
		'panel'    => 'colormag_header_builder',
		'priority' => 10,
	),
	'colormag_header_builder_html_1'          => array(
		'title'    => esc_html__( 'HTML 1', 'colormag' ),
		'panel'    => 'colormag_header_builder',
		'priority' => 10,
	),
	'colormag_header_builder_html_2'          => array(
		'title'    => esc_html__( 'HTML 2', 'colormag' ),
		'panel'    => 'colormag_header_builder',
		'priority' => 10,
	),
	'colormag_header_builder_widget_1'        => array(
		'title'    => esc_html__( 'Widget 1', 'colormag' ),
		'panel'    => 'colormag_header_builder',
		'priority' => 10,
	),
	'colormag_header_builder_widget_2'        => array(
		'title'    => esc_html__( 'Widget 2', 'colormag' ),
		'panel'    => 'colormag_header_builder',
		'priority' => 10,
	),
	'colormag_header_builder_socials'         => array(
		'title'    => esc_html__( 'Social', 'colormag' ),
		'panel'    => 'colormag_header_builder',
		'priority' => 10,
	),
	'colormag_header_builder_offset_area'     => array(
		'title'    => esc_html__( 'Offset Area', 'colormag' ),
		'panel'    => 'colormag_header_builder',
		'priority' => 10,
	),
	'colormag_header_builder_section'         => array(
		'title'    => esc_html__( 'Header Builder', 'colormag' ),
		'panel'    => 'colormag_header_builder',
		'priority' => 15,
	),
	'colormag_header_builder_top_area'        => array(
		'title'    => esc_html__( 'Top Area', 'colormag' ),
		'panel'    => 'colormag_header_builder',
		'priority' => 10,
	),
	'colormag_header_builder_main_area'       => array(
		'title'    => esc_html__( 'Main Area', 'colormag' ),
		'panel'    => 'colormag_header_builder',
		'priority' => 10,
	),
	'colormag_header_builder_bottom_area'     => array(
		'title'    => esc_html__( 'Bottom Area', 'colormag' ),
		'panel'    => 'colormag_header_builder',
		'priority' => 10,
	),
	'colormag_header_builder_cart'            => array(
		'title'    => esc_html__( 'Cart', 'colormag' ),
		'panel'    => 'colormag_header_builder',
		'priority' => 10,
	),
);

colormag_customind()->add_panels( $panel_options_id );
colormag_customind()->add_sections( $section_option_id );
