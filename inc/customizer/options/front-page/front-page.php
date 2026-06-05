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
		'url'         => esc_url( 'https://themegrill.com/themes/colormag-upgrade/?utm_source=cmag-free&utm_medium=upgrade-link&utm_campaign=ui-element-7' ),
		'section'     => 'colormag_front_page_general_section',
		'priority'    => 100,
	),
);
colormag_customind()->add_controls( $options );
