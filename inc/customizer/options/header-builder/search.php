<?php

$options = array(
	'colormag_search_heading'        => array(
		'type'         => 'customind-accordion',
		'title'        => esc_html__( 'Search', 'colormag' ),
		'section'      => 'colormag_header_builder_search',
		'sub_controls' => apply_filters(
			'colormag_search_sub_controls',
			array(
				'colormag_header_search_type'              => array(
					'default' => 'normal-search',
					'type'    => 'customind-select',
					'title'   => esc_html__( 'Search Type', 'colormag' ),
					'section' => 'colormag_header_builder_search',
					'choices' => array(
						'normal-search'     => esc_html__( 'Normal Search', 'colormag' ),
						'search-box'        => esc_html__( 'Search Box', 'colormag' ),
						'search-icon-input' => esc_html__( 'Icon Inside Search', 'colormag' ),
					),
				),
				'colormag_header_search_text_color'        => array(
					'default' => '',
					'type'    => 'customind-color',
					'title'   => esc_html__( 'Text Color', 'colormag' ),
					'section' => 'colormag_header_builder_search',
				),
				'colormag_header_search_placeholder_color' => array(
					'default'   => '',
					'type'      => 'customind-color',
					'title'     => esc_html__( 'Placeholder Color', 'colormag' ),
					'transport' => 'postMessage',
					'section'   => 'colormag_header_builder_search',
				),
				'colormag_header_search_background'        => array(
					'default'   => '',
					'type'      => 'customind-color',
					'transport' => 'postMessage',
					'title'     => esc_html__( 'Background', 'colormag' ),
					'section'   => 'colormag_header_builder_search',
				),
				'colormag_header_search_width'             => array(
					'default'     => array(
						'size'  => '',
						'units' => 'px',
					),
					'type'        => 'customind-slider',
					'title'       => esc_html__( 'Width', 'colormag' ),
					'transport'   => 'postMessage',
					'section'     => 'colormag_header_builder_search',
					'units'       => array( 'px' ),
					'defaultUnit' => 'px',
					'condition'   => array(
						'colormag_header_search_type' => 'search-icon-input',
					),
				),
				'colormag_header_search_border_width'      => array(
					'default'     => array(
						'top'    => '',
						'right'  => '',
						'bottom' => '',
						'left'   => '',
						'unit'   => 'px',
					),
					'type'        => 'customind-dimensions',
					'title'       => esc_html__( 'Border Width', 'colormag' ),
					'section'     => 'colormag_header_builder_search',
					'transport'   => 'postMessage',
					'units'       => array( 'px', 'em' ),
					'defaultUnit' => 'px',
					'condition'   => array(
						'colormag_header_search_type' => 'search-icon-input',
					),
				),
				'colormag_header_search_border_color'      => array(
					'default'   => '',
					'type'      => 'customind-color',
					'title'     => esc_html__( 'Border Color', 'colormag' ),
					'transport' => 'postMessage',
					'section'   => 'colormag_header_builder_search',
					'condition' => array(
						'colormag_header_search_type' => 'search-icon-input',
					),
				),
				'colormag_header_search_border_radius'     => array(
					'default'     => array(
						'size'  => '',
						'units' => 'px',
					),
					'type'        => 'customind-slider',
					'title'       => esc_html__( 'Border Radius', 'colormag' ),
					'section'     => 'colormag_header_builder_search',
					'transport'   => 'postMessage',
					'units'       => array( 'px' ),
					'defaultUnit' => 'px',
					'condition'   => array(
						'colormag_header_search_type' => 'search-icon-input',
					),
				),
			)
		),
		'collapsible'  => apply_filters( 'colormag_search_accordion_collapsible', false ),
	),
	'colormag_search_button_heading' => array(
		'type'         => 'customind-accordion',
		'title'        => esc_html__( 'Search Button', 'colormag' ),
		'section'      => 'colormag_header_builder_search',
		'sub_controls' => apply_filters(
			'colormag_search_sub_controls',
			array(
				'colormag_header_search_icon_color' => array(
					'default'   => '',
					'type'      => 'customind-color',
					'title'     => esc_html__( 'Color', 'colormag' ),
					'transport' => 'postMessage',
					'section'   => 'colormag_header_builder_search',
				),
				'colormag_header_search_button_background_group' => array(
					'type'         => 'customind-color-group',
					'title'        => esc_html__( 'Background', 'colormag' ),
					'section'      => 'colormag_header_builder_search',
					'sub_controls' => apply_filters(
						'colormag_header_search_button_background_sub_controls',
						array(
							'colormag_header_search_button_background' => array(
								'default'   => '',
								'type'      => 'customind-color',
								'title'     => esc_html__( 'Normal', 'colormag' ),
								'transport' => 'postMessage',
								'section'   => 'colormag_header_builder_search',
							),
							'colormag_header_search_button_hover_background' => array(
								'default'   => '',
								'type'      => 'customind-color',
								'title'     => esc_html__( 'Hover', 'colormag' ),
								'transport' => 'postMessage',
								'section'   => 'colormag_header_builder_search',
							),
						),
					),
				),
			)
		),
		'collapsible'  => apply_filters( 'colormag_header_search_button_background_accordion_collapsible', false ),
	),
);

colormag_customind()->add_controls( $options );
