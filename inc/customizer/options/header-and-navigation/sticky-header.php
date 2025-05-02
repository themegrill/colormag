<?php

$options = apply_filters(
	'colormag_breadcrumb_options',
	array(
		'colormag_sticky_header_heading' => array(
			'type'         => 'customind-accordion',
			'title'        => esc_html__( 'Sticky Header', 'colormag' ),
			'section'      => 'colormag_sticky_header_section',
			'sub_controls' => apply_filters(
				'colormag_sticky_controls',
				array(
					'colormag_sticky_header_general_subtitle' => array(
						'type'    => 'customind-title',
						'title'   => esc_html__( 'General', 'colormag' ),
						'section' => 'colormag_sticky_header_section',
					),
					'colormag_enable_sticky_menu' => array(
						'title'   => esc_html__( 'Enable', 'colormag' ),
						'default' => 0,
						'type'    => 'customind-toggle',
						'section' => 'colormag_sticky_header_section',
					),
				),
			),
			'collapsible'  => apply_filters( 'colormag_sticky_accordion_collapsible', false ),
		),
		'colormag_sticky_menu_upgrade'   => array(
			'type'        => 'customind-upsell',
			'description' => esc_html__( 'Unlock more features available in Pro version.', 'colormag' ),
			'title'       => esc_html__( 'Learn more', 'colormag' ),
			'url'         => esc_url( 'https://themegrill.com/pricing/?utm_medium=customizer-upgrade&utm_source=colormag-theme&utm_campaign=customizer-upgrade-button&utm_content=learn-more' ),
			'section'     => 'colormag_sticky_header_section',
			'priority'    => 100,
		),
	)
);

colormag_customind()->add_controls( $options );
