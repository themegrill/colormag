<?php

$options = apply_filters(
	'colormag_page_options',
	array(
		'colormag_archive_page_heading'        => array(
			'type'         => 'customind-accordion',
			'title'        => esc_html__( 'Page Header', 'colormag' ),
			'section'      => 'colormag_page_section',
			'sub_controls' => apply_filters(
				'colormag_page_featured_image_sub_controls',
				array(
					'colormag_enable_page_header' => array(
						'title'   => esc_html__( 'Enable', 'colormag' ),
						'default' => true,
						'type'    => 'customind-toggle',
						'section' => 'colormag_page_section',
					),
				)
			),
			'collapsible'  => apply_filters( 'colormag_page_header_accordion_collapsible', false ),
		),
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
			'type'        => 'customind-upgrade',
			'description' => esc_html__( 'Upgrade to Pro for more features!', 'colormag' ),
			'label'       => esc_html__( 'Upgrade to Pro', 'colormag' ),
			'url'         => esc_url( 'https://themegrill.com/pricing/?utm_medium=customizer-upgrade&utm_source=colormag-theme&utm_campaign=customizer-upgrade-button&utm_content=learn-more' ),
			'points'      => array(
				esc_html__( 'Page header settings', 'colormag' ),
			),
			'section'     => 'colormag_page_section',
			'priority'    => 100,
		),
	)
);

colormag_customind()->add_controls( $options );
