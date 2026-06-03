<?php

$options = array(
	'colormag_hide_blog_static_page_post' => array(
		'title'    => esc_html__( 'Hide blog posts/static page', 'colormag' ),
		'default'  => false,
		'type'     => 'customind-toggle',
		'section'  => 'colormag_front_page_general_section',
		'priority' => 5,
	),
	'colormag_front_page_general_upgrade' => array(
		'type'        => 'customind-upsell',
		'description' => esc_html__( 'Unlock more features available in Pro version.', 'colormag' ),
		'title'       => esc_html__( 'Learn more', 'colormag' ),
		'url'         => esc_url( 'https://themegrill.com/pricing/?utm_medium=customizer-upgrade&utm_source=colormag-theme&utm_campaign=customizer-upgrade-button&utm_content=learn-more' ),
		'section'     => 'colormag_front_page_general_section',
		'priority'    => 100,
	),
);
colormag_customind()->add_controls( $options );
