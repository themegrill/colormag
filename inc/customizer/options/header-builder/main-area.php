<?php
$options = array(
	'colormag_header_main_area_heading' => array(
		'type'         => 'customind-accordion',
		'title'        => esc_html__( 'Main Area', 'colormag' ),
		'section'      => 'colormag_header_builder_main_area',
		'sub_controls' => apply_filters(
			'colormag_header_main_area_sub_controls',
			array(
				'colormag_header_main_area_container'    => array(
					'default'     => array(
						'size' => '',
						'unit' => 'px',
					),
					'type'        => 'customind-slider',
					'title'       => esc_html__( 'Container', 'colormag' ),
					'section'     => 'colormag_header_builder_main_area',
					'transport'   => 'postMessage',
					'units'       => array( 'px' ),
					'defaultUnit' => 'px',
					'input_attrs' => array(
						'min'  => 400,
						'max'  => 1920,
						'step' => 1,
					),
				),
				'colormag_header_main_area_height'       => array(
					'default'     => array(
						'size' => '',
						'unit' => 'px',
					),
					'type'        => 'customind-slider',
					'title'       => esc_html__( 'Height', 'colormag' ),
					'section'     => 'colormag_header_builder_main_area',
					'transport'   => 'postMessage',
					'units'       => array( 'px' ),
					'defaultUnit' => 'px',
				),
				'colormag_header_main_area_color'        => array(
					'title'     => esc_html__( 'Color', 'colormag' ),
					'default'   => '',
					'type'      => 'customind-color',
					'section'   => 'colormag_header_builder_main_area',
					'transport' => 'postMessage',
				),
				'colormag_header_main_area_background'   => array(
					'default'   => array(
						'background-color'      => '#FAFAFA',
						'background-image'      => '',
						'background-repeat'     => 'repeat',
						'background-position'   => 'center center',
						'background-size'       => 'contain',
						'background-attachment' => 'scroll',
					),
					'type'      => 'customind-background',
					'title'     => esc_html__( 'Background', 'colormag' ),
					'transport' => 'postMessage',
					'section'   => 'colormag_header_builder_main_area',
				),

				'colormag_header_main_area_padding'      => array(
					'default'     => array(
						'top'    => '20',
						'right'  => '20',
						'bottom' => '20',
						'left'   => '20',
						'unit'   => 'px',
					),
					'type'        => 'customind-dimensions',
					'title'       => esc_html__( 'Padding', 'colormag' ),
					'section'     => 'colormag_header_builder_main_area',
					'transport'   => 'postMessage',
					'units'       => array( 'px', 'em' ),
					'defaultUnit' => 'px',
				),

				'colormag_header_main_area_margin'       => array(
					'default'     => array(
						'top'    => '',
						'right'  => '',
						'bottom' => '',
						'left'   => '',
						'unit'   => 'px',
					),
					'type'        => 'customind-dimensions',
					'title'       => esc_html__( 'Margin', 'colormag' ),
					'section'     => 'colormag_header_builder_main_area',
					'transport'   => 'postMessage',
					'units'       => array( 'px', 'em' ),
					'defaultUnit' => 'px',
				),

				'colormag_header_main_area_border_width' => array(
					'default'     => array(
						'top'    => '0',
						'right'  => '0',
						'bottom' => '0',
						'left'   => '0',
						'unit'   => 'px',
					),
					'type'        => 'customind-dimensions',
					'title'       => esc_html__( 'Border Width', 'colormag' ),
					'section'     => 'colormag_header_builder_main_area',
					'transport'   => 'postMessage',
					'units'       => array( 'px', 'em' ),
					'defaultUnit' => 'px',
				),

				'colormag_header_main_area_border_color' => array(
					'title'     => esc_html__( 'Border Color', 'colormag' ),
					'default'   => '',
					'type'      => 'customind-color',
					'section'   => 'colormag_header_builder_main_area',
					'transport' => 'postMessage',
				),
			)
		),
		'collapsible'  => apply_filters( 'colormag_header_main_area_background_accordion_collapsible', false ),
	),
);

colormag_customind()->add_controls( $options );
