<?php

$options = array(
	'colormag_search_heading' => array(
		'type'         => 'customind-accordion',
		'title'        => esc_html__( 'Search', 'colormag' ),
		'section'      => 'colormag_header_builder_search',
		'sub_controls' => apply_filters(
			'colormag_search_sub_controls',
			array(
				'colormag_header_search_icon_color' => array(
					'default'   => '',
					'type'      => 'customind-color',
					'title'     => esc_html__( 'Color', 'colormag' ),
					'transport' => 'postMessage',
					'section'   => 'colormag_header_builder_search',
				),
				'colormag_header_search_text_color' => array(
					'default' => '',
					'type'    => 'customind-color',
					'title'   => esc_html__( 'Text Color', 'colormag' ),
					'section' => 'colormag_header_builder_search',
				),
				'colormag_header_search_background' => array(
					'default'   => '',
					'type'      => 'customind-color',
					'transport' => 'postMessage',
					'title'     => esc_html__( 'Background', 'colormag' ),
					'section'   => 'colormag_header_builder_search',
				),
			)
		),
		'collapsible'  => apply_filters( 'colormag_search_accordion_collapsible', false ),
	),
);

colormag_customind()->add_controls( $options );
