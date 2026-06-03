<?php

$options = apply_filters(
	'colormag_breadcrumb_options',
	array(
		'colormag_breadcrumb_enable'  => array(
			'title'   => esc_html__( 'Enable', 'colormag' ),
			'default' => 0,
			'type'    => 'customind-toggle',
			'section' => 'colormag_breadcrumb_section',
		),
		'colormag_breadcrumb_upgrade' => array(
			'type'        => 'customind-upsell',
			'description' => esc_html__( 'Unlock more features available in Pro version.', 'colormag' ),
			'title'       => esc_html__( 'Learn more', 'colormag' ),
			'url'         => esc_url( 'https://themegrill.com/pricing/?utm_medium=customizer-upgrade&utm_source=colormag-theme&utm_campaign=customizer-upgrade-button&utm_content=learn-more' ),
			'section'     => 'colormag_breadcrumb_section',
			'priority'    => 100,
		),
	)
);

colormag_customind()->add_controls( $options );
