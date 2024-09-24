<?php

$options = array(
	'colormag_hide_blog_static_page_post_heading' => array(
		'type'         => 'customind-accordion',
		'title'        => esc_html__( 'General', 'colormag' ),
		'section'      => 'colormag_front_page_general_section',
		'sub_controls' => apply_filters(
			'colormag_hide_blog_static_page_post_sub_controls',
			array(
				'colormag_hide_blog_static_page_post' => array(
					'title'    => esc_html__( 'Hide blog posts/static page', 'colormag' ),
					'default'  => false,
					'type'     => 'customind-toggle',
					'section'  => 'colormag_front_page_general_section',
					'priority' => 5,
				),
			)
		),
		'collapsible'  => apply_filters( 'colormag_hide_blog_static_page_post_accordion_collapsible', false ),
	),
	'colormag_front_page_general_upgrade'         => array(
		'type'        => 'customind-upsell',
		'description' => esc_html__( 'Unlock more features available in Pro version.', 'colormag' ),
		'title'       => esc_html__( 'Learn more', 'colormag' ),
		'url'         => esc_url( 'https://themegrill.com/colormag-pricing' ),
		'section'     => 'colormag_front_page_general_section',
		'priority'    => 100,
	),
);
colormag_customind()->add_controls( $options );
