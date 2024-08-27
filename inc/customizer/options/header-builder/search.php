<?php

$options = array(
	'colormag_search_heading' => array(
		'type'         => 'customind-accordion',
		'title'        => esc_html__( 'Search', 'colormag' ),
		'section'      => 'colormag_header_builder_search',
		'sub_controls' => apply_filters(
			'colormag_search_sub_controls',
			array(
				'colormag_enable_product_search_search' => array(
					'title'   => esc_html__( 'Product Search', 'colormag' ),
					'default' => false,
					'type'    => 'customind-toggle',
					'section' => 'colormag_header_builder_search',
				),
				'colormag_header_search_icon_color'     => array(
					'default'   => '',
					'type'      => 'customind-color',
					'title'     => esc_html__( 'Color', 'colormag' ),
					'transport' => 'postMessage',
					'section'   => 'colormag_header_builder_primary_menu',
				),
				'colormag_header_search_text_color'     => array(
					'default'   => '',
					'type'      => 'customind-color',
					'title'     => esc_html__( 'Text Color', 'colormag' ),
					'transport' => 'postMessage',
					'section'   => 'colormag_header_builder_primary_menu',
				),
				'colormag_header_search_background'     => array(
					'default'   => array(
						'background-color'      => '',
						'background-image'      => '',
						'background-position'   => 'center center',
						'background-size'       => 'auto',
						'background-attachment' => 'scroll',
						'background-repeat'     => 'repeat',
					),
					'type'      => 'customind-background',
					'title'     => esc_html__( 'Background', 'colormag' ),
					'section'   => 'colormag_header_builder_search',
					'transport' => 'postMessage',
					'priority'  => 20,
				),
			)
		),
		'collapsible'  => apply_filters( 'colormag_search_accordion_collapsible', false ),
	),
);

colormag_customind()->add_controls( $options );
