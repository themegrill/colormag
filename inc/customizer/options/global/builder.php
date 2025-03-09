<?php

$options = array(
	'colormag_builder_heading' => array(
		'type'         => 'customind-accordion',
		'title'        => esc_html__( 'Builder', 'colormag' ),
		'section'      => 'colormag_builder',
		'sub_controls' => apply_filters(
			'colormag_builder_sub_controls',
			array(
				'colormag_enable_builder' => array(
					'default' => '',
					'title'   => esc_html__( 'Enable', 'colormag' ),
					'type'    => 'customind-builder-migration',
					'section' => 'colormag_builder',
				),
			)
		),
		'collapsible'  => apply_filters( 'colormag_builder_accordion_collapsible', false ),
	),
);
colormag_customind()->add_controls( $options );
