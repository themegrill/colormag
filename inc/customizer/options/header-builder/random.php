<?php

$options = array(
	'colormag_random_heading' => array(
		'type'         => 'customind-accordion',
		'title'        => esc_html__( 'Random', 'colormag' ),
		'section'      => 'colormag_header_builder_random',
		'sub_controls' => apply_filters(
			'colormag_random_sub_controls',
			array(
				'colormag_header_random_icon_color' => array(
					'default'   => '',
					'type'      => 'customind-color',
					'title'     => esc_html__( 'Color', 'colormag' ),
					'transport' => 'postMessage',
					'section'   => 'colormag_header_builder_random',
				),
			)
		),
		'collapsible'  => apply_filters( 'colormag_random_accordion_collapsible', false ),
	),
);

colormag_customind()->add_controls( $options );
