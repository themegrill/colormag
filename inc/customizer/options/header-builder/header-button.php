<?php

$options = array(
	'colormag_header_button_heading' => array(
		'type'         => 'customind-accordion',
		'title'        => esc_html__( 'Button 1', 'colormag' ),
		'section'      => 'colormag_header_builder_button_1',
		'sub_controls' => apply_filters(
			'colormag_header_button_sub_controls',
			array(
				'colormag_header_button_text'          => array(
					'default' => 'Button 1',
					'title'   => esc_html__( 'Text', 'colormag' ),
					'type'    => 'customind-text',
					'section' => 'colormag_header_builder_button_1',
				),
				'colormag_header_button_link'          => array(
					'default'     => '',
					'title'       => esc_html__( 'Link', 'colormag' ),
					'type'        => 'customind-text',
					'section'     => 'colormag_header_builder_button_1',
					'input_attrs' => array(
						'placeholder' => esc_attr__( 'https://example.com', 'colormag' ),
					),
				),
				'colormag_header_button_target'        => array(
					'default' => false,
					'title'   => esc_html__( 'Open link in a new tab', 'colormag' ),
					'type'    => 'customind-toggle',
					'section' => 'colormag_header_builder_button_1',
				),
				'colormag_header_button_color_group'   => array(
					'type'         => 'customind-color-group',
					'title'        => esc_html__( 'Color', 'colormag' ),
					'section'      => 'colormag_header_builder_button_1',
					'sub_controls' => array(
						'colormag_header_button_color' => array(
							'default'   => '#ffffff',
							'type'      => 'customind-color',
							'title'     => esc_html__( 'Normal', 'colormag' ),
							'transport' => 'postMessage',
							'section'   => 'colormag_header_builder_button_1',
						),
						'colormag_header_button_hover_color' => array(
							'default'   => '#ffffff',
							'type'      => 'customind-color',
							'title'     => esc_html__( 'Hover', 'colormag' ),
							'transport' => 'postMessage',
							'section'   => 'colormag_header_builder_button_1',
						),
					),
				),
				'colormag_header_button_background_color_group' => array(
					'type'         => 'customind-color-group',
					'title'        => esc_html__( 'Background', 'colormag' ),
					'section'      => 'colormag_header_builder_button_1',
					'sub_controls' => array(
						'colormag_header_button_background_color'       => array(
							'default'   => 'var(--cm-color-1)',
							'type'      => 'customind-color',
							'title'     => esc_html__( 'Normal', 'colormag' ),
							'transport' => 'postMessage',
							'section'   => 'colormag_header_builder_button_1',
						),
						'colormag_header_button_background_hover_color' => array(
							'default'   => '#ffffff',
							'type'      => 'customind-color',
							'title'     => esc_html__( 'Hover', 'colormag' ),
							'transport' => 'postMessage',
							'section'   => 'colormag_header_builder_button_1',
						),
					),
				),
				'colormag_header_button_padding'       => array(
					'default'     => array(
						'top'    => '5',
						'right'  => '10',
						'bottom' => '5',
						'left'   => '10',
						'unit'   => 'px',
					),
					'type'        => 'customind-dimensions',
					'title'       => esc_html__( 'Padding', 'colormag' ),
					'section'     => 'colormag_header_builder_button_1',
					'transport'   => 'postMessage',
					'units'       => array( 'px', 'em', '%' ),
					'defaultUnit' => 'px',
				),
				'colormag_header_button_border_width'  => array(
					'default'     => array(
						'top'    => '',
						'right'  => '',
						'bottom' => '',
						'left'   => '',
						'unit'   => 'px',
					),
					'type'        => 'customind-dimensions',
					'title'       => esc_html__( 'Border Width', 'colormag' ),
					'section'     => 'colormag_header_builder_button_1',
					'transport'   => 'postMessage',
					'units'       => array( 'px', 'em' ),
					'defaultUnit' => 'px',
				),
				'colormag_header_button_border_color'  => array(
					'default'   => 'var(--cm-color-1)',
					'type'      => 'customind-color',
					'title'     => esc_html__( 'Border Color', 'colormag' ),
					'transport' => 'postMessage',
					'section'   => 'colormag_header_builder_button_1',
				),
				'colormag_header_button_border_radius' => array(
					'default'     => array(
						'size'  => '',
						'units' => 'px',
					),
					'type'        => 'customind-slider',
					'title'       => esc_html__( 'Border Radius', 'colormag' ),
					'section'     => 'colormag_header_builder_button_1',
					'transport'   => 'postMessage',
					'units'       => array( 'px' ),
					'defaultUnit' => 'px',
				),
			)
		),
		'collapsible'  => apply_filters( 'colormag_header_button_accordion_collapsible', false ),
	),
);

colormag_customind()->add_controls( $options );
