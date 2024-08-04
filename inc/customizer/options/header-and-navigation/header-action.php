<?php

$options = array(
	'colormag_header_action_heading'       => array(
		'type'         => 'customind-accordion',
		'title'        => esc_html__( 'Header Action', 'zakra' ),
		'section'      => 'colormag_header_action_section',
		'sub_controls' => apply_filters(
			'colormag_header_action_style_sub_controls',
			array(
				'colormag_header_action_style_heading'    => array(
					'type'    => 'customind-title',
					'title'   => esc_html__( 'Style', 'zakra' ),
					'section' => 'colormag_header_action_section',
				),
				'colormag_header_action_icon_color_group' => array(
					'type'         => 'customind-color-group',
					'title'        => esc_html__( 'Color', 'zakra' ),
					'section'      => 'colormag_header_action_section',
					'sub_controls' => apply_filters(
						'zakra_link_color_sub_controls',
						array(
							'colormag_header_action_icon_color' => array(
								'default'   => '#fff',
								'type'      => 'customind-color',
								'title'     => esc_html__( 'Normal', 'zakra' ),
								'transport' => 'postMessage',
								'section'   => 'colormag_header_action_section',
							),
							'colormag_header_action_icon_hover_color' => array(
								'default'   => '',
								'type'      => 'customind-color',
								'title'     => esc_html__( 'Hover', 'zakra' ),
								'transport' => 'postMessage',
								'section'   => 'colormag_header_action_section',
							),
						),
					),
				),
			)
		),
		'collapsible'  => apply_filters( 'colormag_header_action_style_accordion_collapsible', false ),
	),
	'colormag_search_icon_in_menu_heading' => array(
		'type'         => 'customind-accordion',
		'title'        => esc_html__( 'Search', 'zakra' ),
		'section'      => 'colormag_header_action_section',
		'sub_controls' => apply_filters(
			'colormag_search_icon_in_menu_sub_controls',
			array(
				'colormag_enable_search' => array(
					'title'   => esc_html__( 'Enable', 'zakra' ),
					'default' => 0,
					'type'    => 'customind-toggle',
					'section' => 'colormag_header_action_section',
				),
			)
		),
		'collapsible'  => apply_filters( 'colormag_search_icon_in_menu_accordion_collapsible', false ),
	),
	'colormag_enable_random_post_heading'  => array(
		'type'         => 'customind-accordion',
		'title'        => esc_html__( 'Search', 'zakra' ),
		'section'      => 'colormag_header_action_section',
		'sub_controls' => apply_filters(
			'colormag_enable_random_post_sub_controls',
			array(
				'colormag_enable_random_post' => array(
					'title'   => esc_html__( 'Enable', 'zakra' ),
					'default' => 0,
					'type'    => 'customind-toggle',
					'section' => 'colormag_header_action_section',
				),
			)
		),
		'collapsible'  => apply_filters( 'colormag_enable_random_post_accordion_collapsible', false ),
	),
);

colormag_customind()->add_controls( $options );
