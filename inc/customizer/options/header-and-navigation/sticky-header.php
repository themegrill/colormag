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
			'url'         => esc_url( 'https://themegrill.com/themes/colormag-upgrade/?utm_source=cmag-free&utm_medium=upgrade-link&utm_campaign=ui-element-18' ),
			'section'     => 'colormag_sticky_header_section',
			'priority'    => 100,
		),
	)
);

colormag_customind()->add_controls( $options );

do_action( 'colormag_customizer_sticky_header_pro_options', $wp_customize );
