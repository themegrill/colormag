<?php

$options = array(
	'colormag_header_builder_toggle_button_heading' => array(
		'type'         => 'customind-accordion',
		'title'        => esc_html__( 'Load Google fonts locally', 'colormag' ),
		'section'      => 'colormag_header_builder_toggle_button',
		'sub_controls' => apply_filters(
			'colormag_header_builder_toggle_button_sub_controls',
			array(
				'colormag_header_builder_toggle_button' => array(
					'default' => 0,
					'title'   => esc_html__( 'Enable', 'colormag' ),
					'type'    => 'customind-toggle',
					'section' => 'colormag_header_builder_toggle_button',
				),
			)
		),
		'input_attrs'  => array(
			'collapsible' => apply_filters( 'colormag_header_builder_toggle_button_accordion_collapsible', false ),
		),
	),
);

colormag_customind()->add_controls( $options );
