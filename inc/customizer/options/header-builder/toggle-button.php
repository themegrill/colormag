<?php

$options = array(
	'colormag_header_builder_toggle_button_heading' => array(
		'type'         => 'customind-accordion',
		'title'        => esc_html__( 'Toggle Button', 'colormag' ),
		'section'      => 'colormag_header_builder_toggle_button',
		'sub_controls' => apply_filters(
			'colormag_header_builder_toggle_button_sub_controls',
			array(
				'colormag_header_builder_toggle_button_color' => array(
					'title'   => esc_html__( 'Color', 'colormag' ),
					'default' => '',
					'type'    => 'customind-color',
					'section' => 'colormag_header_builder_toggle_button',
				),
			)
		),
		'collapsible'  => apply_filters( 'colormag_header_builder_toggle_button_accordion_collapsible', false ),
	),
);

colormag_customind()->add_controls( $options );
