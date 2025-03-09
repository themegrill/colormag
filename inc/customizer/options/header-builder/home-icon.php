<?php

$options = array(
	'colormag_home_icon_heading' => array(
		'type'         => 'customind-accordion',
		'title'        => esc_html__( 'Home Icon', 'colormag' ),
		'section'      => 'colormag_header_builder_home_icon',
		'sub_controls' => apply_filters(
			'colormag_home_icon_sub_controls',
			array(
				'colormag_header_home_icon_color' => array(
					'default'   => '',
					'type'      => 'customind-color',
					'title'     => esc_html__( 'Color', 'colormag' ),
					'transport' => 'postMessage',
					'section'   => 'colormag_header_builder_home_icon',
				),
			)
		),
		'collapsible'  => apply_filters( 'colormag_home_icon_accordion_collapsible', false ),
	),
);

colormag_customind()->add_controls( $options );
