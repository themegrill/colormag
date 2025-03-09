<?php

$options = apply_filters(
	'colormag_breadcrumb_options',
	array(
		'colormag_breadcrumb_general_heading' => array(
			'type'         => 'customind-accordion',
			'title'        => esc_html__( 'Breadcrumb', 'colormag' ),
			'section'      => 'colormag_breadcrumb_section',
			'sub_controls' => apply_filters(
				'colormag_breadcrumb_controls',
				array(
					'colormag_breadcrumb_general_heading' => array(
						'type'    => 'customind-title',
						'title'   => esc_html__( 'General', 'colormag' ),
						'section' => 'colormag_breadcrumb_section',
					),
					'colormag_breadcrumb_enable'          => array(
						'title'   => esc_html__( 'Enable', 'colormag' ),
						'default' => 0,
						'type'    => 'customind-toggle',
						'section' => 'colormag_breadcrumb_section',
					),
				),
			),
			'collapsible'  => apply_filters( 'colormag_breadcrumb_accordion_collapsible', false ),
		),
		'colormag_breadcrumb_upgrade'         => array(
			'type'        => 'customind-upsell',
			'description' => esc_html__( 'Unlock more features available in Pro version.', 'colormag' ),
			'title'       => esc_html__( 'Learn more', 'colormag' ),
			'url'         => esc_url( 'https://themegrill.com/colormag-pricing' ),
			'section'     => 'colormag_breadcrumb_section',
			'priority'    => 100,
		),
	)
);

colormag_customind()->add_controls( $options );
