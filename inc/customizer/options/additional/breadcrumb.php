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
			'url'         => esc_url_raw( 'https://themegrill.com/themes/colormag-upgrade/?utm_source=cmag-free&utm_medium=upgrade-link&utm_campaign=ui-element-1' ),
			'section'     => 'colormag_breadcrumb_section',
			'priority'    => 100,
		),
	)
);

colormag_customind()->add_controls( $options );
