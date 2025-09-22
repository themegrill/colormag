<?php

$options = array(
	'colormag_button_color_group'            => array(
		'type'         => 'customind-color-group',
		'title'        => esc_html__( 'Color', 'colormag' ),
		'section'      => 'colormag_button_section',
		'priority'     => 5,
		'sub_controls' => array(
			'colormag_button_color'       => array(
				'default'   => '#ffffff',
				'type'      => 'customind-color',
				'title'     => esc_html__( 'Normal', 'colormag' ),
				'transport' => 'postMessage',
				'section'   => 'colormag_button_section',
			),
			'colormag_button_hover_color' => array(
				'default'   => '',
				'type'      => 'customind-color',
				'title'     => esc_html__( 'Hover', 'colormag' ),
				'transport' => 'postMessage',
				'section'   => 'colormag_button_section',
			),
		),
	),
	'colormag_button_background_color_group' => array(
		'type'         => 'customind-color-group',
		'title'        => esc_html__( 'Background', 'colormag' ),
		'section'      => 'colormag_button_section',
		'priority'     => 10,
		'sub_controls' => array(
			'colormag_button_background_color'       => array(
				'default'   => '',
				'type'      => 'customind-color',
				'title'     => esc_html__( 'Normal', 'colormag' ),
				'transport' => 'postMessage',
				'section'   => 'colormag_button_section',
			),
			'colormag_button_background_hover_color' => array(
				'default'   => '',
				'type'      => 'customind-color',
				'title'     => esc_html__( 'Hover', 'colormag' ),
				'transport' => 'postMessage',
				'section'   => 'colormag_button_section',
			),
		),
	),
	'colormag_button_dimension_padding'      => array(
		'default'     => array(
			'top'    => '',
			'right'  => '',
			'bottom' => '',
			'left'   => '',
			'unit'   => 'px',
		),
		'priority'    => 20,
		'type'        => 'customind-dimensions',
		'title'       => esc_html__( 'Padding', 'colormag' ),
		'section'     => 'colormag_button_section',
		'transport'   => 'postMessage',
		'units'       => array( 'px', 'em', '%', 'rem' ),
		'defaultUnit' => 'px',
	),
	'colormag_button_border_radius_divider'  => array(
		'type'     => 'customind-divider',
		'variant'  => 'dashed',
		'priority' => 40,
		'section'  => 'colormag_button_section',
	),
	'colormag_button_border_radius_heading'  => array(
		'type'     => 'customind-title',
		'title'    => esc_html__( 'Border', 'colormag' ),
		'priority' => 40,
		'section'  => 'colormag_button_section',
	),
	'colormag_button_border_radius'          => array(
		'title'       => esc_html__( 'Radius', 'colormag' ),
		'default'     => array(
			'size' => '3',
			'unit' => 'px',
		),
		'priority'    => 55,
		'type'        => 'customind-slider',
		'section'     => 'colormag_button_section',
		'transport'   => 'postMessage',
		'units'       => array( 'px' ),
		'defaultUnit' => 'px',
	),
	'colormag_button_upgrade'                => array(
		'type'        => 'customind-upgrade',
		'description' => esc_html__( 'Upgrade to Pro for more features!', 'colormag' ),
		'label'       => esc_html__( 'Upgrade to Pro', 'colormag' ),
		'url'         => esc_url( 'https://themegrill.com/pricing/?utm_medium=customizer-upgrade&utm_source=colormag-theme&utm_campaign=customizer-upgrade-button&utm_content=learn-more' ),
		'points'      => array(
			esc_html__( 'Global button typography', 'colormag' ),
			esc_html__( 'Button border style, width and colors', 'colormag' ),
		),
		'section'     => 'colormag_button_section',
		'priority'    => 100,
	),
);

colormag_customind()->add_controls( $options );
