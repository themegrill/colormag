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
);

$section_option_id = array(
	'colormag_global_colors_section'      => array(
		'title'    => esc_html__( 'Colors', 'colormag' ),
		'panel'    => 'colormag_global_panel',
		'priority' => 10,
	),
	'colormag_category_colors_section'    => array(
		'title'    => esc_html__( 'Category Colors', 'colormag' ),
		'panel'    => 'colormag_global_panel',
		'priority' => 20,
	),
	'colormag_global_container_section'   => array(
		'title'    => esc_html__( 'Container', 'colormag' ),
		'panel'    => 'colormag_global_panel',
		'priority' => 30,
	),
	'colormag_global_sidebar_section'     => array(
		'title'    => esc_html__( 'Sidebar', 'colormag' ),
		'panel'    => 'colormag_global_panel',
		'priority' => 40,
	),
	'colormag_global_typography_section'  => array(
		'title'    => esc_html__( 'Typography', 'colormag' ),
		'panel'    => 'colormag_global_panel',
		'priority' => 50,
	),
	'colormag_button_section'             => array(
		'title'    => esc_html__( 'Button', 'colormag' ),
		'panel'    => 'colormag_global_panel',
		'priority' => 60,
	),
	'colormag_front_page_general_section' => array(
		'title'    => esc_html__( 'General', 'colormag' ),
		'panel'    => 'colormag_front_page_panel',
		'priority' => 10,
	),
);

colormag_customind()->add_panels( $panel_options_id );
colormag_customind()->add_sections( $section_option_id );
