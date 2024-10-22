<?php

$options = array(
	'colormag_header_builder_cart_heading' => array(
		'type'         => 'customind-accordion',
		'title'        => esc_html__( 'Load Google fonts locally', 'colormag' ),
		'section'      => 'colormag_header_builder_cart',
		'sub_controls' => apply_filters(
			'colormag_header_builder_cart_sub_controls',
			array(
				'colormag_header_cart' => array(
					'default' => 0,
					'title'   => esc_html__( 'Enable', 'colormag' ),
					'type'    => 'customind-toggle',
					'section' => 'colormag_header_builder_cart',
				),
			)
		),
		'collapsible'  => apply_filters( 'colormag_header_builder_cart_accordion_collapsible', false ),
	),
);

colormag_customind()->add_controls( $options );
