<?php

$options = apply_filters(
	'colormag_page_options',
	array(
		'colormag_page_featured_image_heading' => array(
			'type'         => 'customind-accordion',
			'title'        => esc_html__( 'Featured Image', 'colormag' ),
			'section'      => 'colormag_page_section',
			'sub_controls' => apply_filters(
				'colormag_page_featured_image_sub_controls',
				array(
					'colormag_enable_page_featured_image' => array(
						'title'   => esc_html__( 'Enable', 'colormag' ),
						'default' => false,
						'type'    => 'customind-toggle',
						'section' => 'colormag_page_section',
					),
				)
			),
			'collapsible'  => apply_filters( 'colormag_page_featured_image_accordion_collapsible', false ),
		),
		'colormag_page_upgrade'                => array(
			'type'        => 'customind-upsell',
			'description' => esc_html__( 'Unlock more features available in Pro version.', 'colormag' ),
			'title'       => esc_html__( 'Learn more', 'colormag' ),
			'url'         => esc_url( 'https://themegrill.com/colormag-pricing' ),
			'section'     => 'colormag_page_section',
			'priority'    => 100,
		),
	)
);

colormag_customind()->add_controls( $options );
