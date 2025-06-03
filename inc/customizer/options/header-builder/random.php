<?php

$options = array(
	'colormag_random_heading' => array(
		'type'         => 'customind-accordion',
		'title'        => esc_html__( 'Random', 'colormag' ),
		'section'      => 'colormag_header_builder_random',
		'sub_controls' => apply_filters(
			'colormag_random_sub_controls',
			array(
				'colormag_header_random_icon_color_group' => array(
					'type'         => 'customind-color-group',
					'title'        => esc_html__( 'Icon Color', 'colormag' ),
					'section'      => 'colormag_header_builder_random',
					'sub_controls' => apply_filters(
						'colormag_header_random_icon_color_sub_controls',
						array(
							'colormag_header_random_icon_color'       => array(
								'default'   => '',
								'type'      => 'customind-color',
								'title'     => esc_html__( 'Normal', 'colormag' ),
								'transport' => 'postMessage',
								'section'   => 'colormag_header_builder_random',
							),
							'colormag_header_random_icon_hover_color'       => array(
								'default'   => '',
								'type'      => 'customind-color',
								'title'     => esc_html__( 'Hover', 'colormag' ),
								'transport' => 'postMessage',
								'section'   => 'colormag_header_builder_random',
							),
						),
					),
				),
				'colormag_header_random_icon_size'        => array(
					'default'     => array(
						'size'  => '',
						'units' => 'px',
					),
					'type'        => 'customind-slider',
					'title'       => esc_html__( 'Icon Size', 'colormag' ),
					'transport'   => 'postMessage',
					'section'     => 'colormag_header_builder_random',
					'units'       => array( 'px', 'em', 'rem' ),
					'defaultUnit' => 'px',
				),
			)
		),
		'collapsible'  => apply_filters( 'colormag_random_accordion_collapsible', false ),
	),
);

colormag_customind()->add_controls( $options );
