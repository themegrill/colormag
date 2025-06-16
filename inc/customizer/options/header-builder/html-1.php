<?php

$options = array(
	'colormag_header_html_1_heading' => array(
		'type'         => 'customind-accordion',
		'title'        => esc_html__( 'HTML 1', 'colormag' ),
		'section'      => 'colormag_header_builder_html_1',
		'sub_controls' => apply_filters(
			'colormag_header_html_1_sub_controls',
			array(
				'colormag_header_html_1'                  => array(
					'default'  => 'Insert Text Here',
					'type'     => 'customind-editor',
					'title'    => esc_html__( 'Text/HTML for HTML 1', 'colormag' ),
					'section'  => 'colormag_header_builder_html_1',
					'priority' => 30,
				),
				'colormag_header_html_1_text_color'       => array(
					'title'     => esc_html__( 'Color', 'colormag' ),
					'default'   => '',
					'type'      => 'customind-color',
					'section'   => 'colormag_header_builder_html_1',
					'transport' => 'postMessage',
				),
				'colormag_header_html_1_link_color_group' => array(
					'type'         => 'customind-color-group',
					'title'        => esc_html__( 'Links', 'colormag' ),
					'section'      => 'colormag_header_builder_html_1',
					'sub_controls' => apply_filters(
						'colormag_header_html_1_link_color_sub_controls',
						array(
							'colormag_header_html_1_link_color'       => array(
								'default'   => '',
								'type'      => 'customind-color',
								'title'     => esc_html__( 'Normal', 'colormag' ),
								'transport' => 'postMessage',
								'section'   => 'colormag_header_builder_html_1',
							),
							'colormag_header_html_1_link_hover_color' => array(
								'default'   => '',
								'type'      => 'customind-color',
								'title'     => esc_html__( 'Hover', 'colormag' ),
								'transport' => 'postMessage',
								'section'   => 'colormag_header_builder_html_1',
							),
						),
					),
				),
				'colormag_header_html_1_font_size'        => array(
					'title'       => esc_html__( 'Font Size', 'colormag' ),
					'default'     => array(
						'size' => '',
						'unit' => 'px',
					),
					'type'        => 'customind-slider',
					'section'     => 'colormag_header_builder_html_1',
					'transport'   => 'postMessage',
					'units'       => array( 'px', 'em', 'rem' ),
					'defaultUnit' => 'px',
				),
				'colormag_header_html_1_margin'           => array(
					'default'     => array(
						'top'    => '',
						'right'  => '',
						'bottom' => '',
						'left'   => '',
						'unit'   => 'px',
					),
					'type'        => 'customind-dimensions',
					'title'       => 'Margin',
					'section'     => 'colormag_header_builder_html_1',
					'transport'   => 'postMessage',
					'units'       => array( 'px', 'em', '%', 'rem' ),
					'defaultUnit' => 'px',
				),
			)
		),
		'collapsible'  => apply_filters( 'colormag_header_html_1_accordion_collapsible', false ),
	),
);

colormag_customind()->add_controls( $options );
