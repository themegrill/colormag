<?php

$options = array(
	'colormag_header_builder_offset_area_heading' => array(
		'type'         => 'customind-accordion',
		'title'        => esc_html__( 'Offset Area', 'colormag' ),
		'section'      => 'colormag_header_builder_offset_area',
		'sub_controls' => apply_filters(
			'colormag_header_builder_offset_area_sub_controls',
			array(
				'colormag_header_mobile_menu_background' => array(
					'default'   => '',
					'type'      => 'customind-color',
					'title'     => esc_html__( 'Background', 'colormag' ),
					'transport' => 'postMessage',
					'section'   => 'colormag_header_builder_offset_area',
				),
			)
		),
		'collapsible'  => apply_filters( 'colormag_header_builder_offset_area_accordion_collapsible', false ),
	),
);

colormag_customind()->add_controls( $options );
