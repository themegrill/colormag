<?php

// Customize transport postMessage variable to set `postMessage` or `refresh` as required.
$customizer_selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';

$options = array(
	'colormag_social_icons_heading'          => array(
		'type'         => 'customind-accordion',
		'title'        => esc_html__( 'Social Icons', 'colormag' ),
		'section'      => 'colormag_social_icons_section',
		'sub_controls' => apply_filters(
			'colormag_social_icons_controls',
			array(
				'colormag_social_icons_general_heading' => array(
					'type'    => 'customind-title',
					'title'   => esc_html__( 'General', 'colormag' ),
					'section' => 'colormag_social_icons_section',
				),
				'colormag_enable_social_icons'          => array(
					'title'     => esc_html__( 'Enable', 'colormag' ),
					'default'   => false,
					'type'      => 'customind-toggle',
					'section'   => 'colormag_social_icons_section',
					'transport' => $customizer_selective_refresh,
					'partial'   => array(
						'selector' => '.social-links',
					),
				),
			),
		),
		'collapsible'  => apply_filters( 'colormag_social_icons_accordion_collapsible', false ),
	),
	'colormag_social_icons_position_heading' => array(
		'type'         => 'customind-accordion',
		'title'        => esc_html__( 'Position', 'colormag' ),
		'section'      => 'colormag_social_icons_section',
		'sub_controls' => apply_filters(
			'colormag_social_icons_position_controls',
			array(
				'colormag_enable_social_icons_header' => array(
					'title'     => esc_html__( 'Header', 'colormag' ),
					'default'   => true,
					'type'      => 'customind-toggle',
					'section'   => 'colormag_social_icons_section',
					'transport' => $customizer_selective_refresh,
					'partial'   => array(
						'selector' => '.social-links',
					),
				),
				'colormag_enable_social_icons_footer' => array(
					'title'     => esc_html__( 'Footer', 'colormag' ),
					'default'   => true,
					'type'      => 'customind-toggle',
					'section'   => 'colormag_social_icons_section',
					'transport' => $customizer_selective_refresh,
					'partial'   => array(
						'selector' => '.social-links',
					),
				),
			),
		),
		'condition'    => array(
			'colormag_enable_social_icons' => true,
		),
		'collapsible'  => apply_filters( 'colormag_social_icons_position_accordion_collapsible', false ),
	),
);

// Social links lists.
$social_links_count    = 70;
$colormag_social_links = array(
	'colormag_social_facebook'  => array(
		'id'      => 'colormag_social_facebook',
		'title'   => esc_html__( 'Facebook', 'colormag' ),
		'default' => '',
	),
	'colormag_social_twitter'   => array(
		'id'      => 'colormag_social_twitter',
		'title'   => esc_html__( 'Twitter', 'colormag' ),
		'default' => '',
	),
	'colormag_social_instagram' => array(
		'id'      => 'colormag_social_instagram',
		'title'   => esc_html__( 'Instagram', 'colormag' ),
		'default' => '',
	),
	'colormag_social_pinterest' => array(
		'id'      => 'colormag_social_pinterest',
		'title'   => esc_html__( 'Pinterest', 'colormag' ),
		'default' => '',
	),
	'colormag_social_youtube'   => array(
		'id'      => 'colormag_social_youtube',
		'title'   => esc_html__( 'YouTube', 'colormag' ),
		'default' => '',
	),
);

// Available social links via theme.
foreach ( $colormag_social_links as $colormag_social_link ) {

	// Social links url option.
	$options[ $colormag_social_link['id'] ] = array(
		'title'     => $colormag_social_link['title'],
		'default'   => $colormag_social_link['default'],
		'type'      => 'customind-text',
		'section'   => 'colormag_social_icons_section',
		'condition' => array(
			'colormag_enable_social_icons' => true,
		),
		'priority'  => $social_links_count,
	);

	// Social links open in new tab enable/disable option.
	$options[ $colormag_social_link['id'] . '_checkbox' ] = array(
		'title'     => esc_html__( 'Check to open in new tab', 'colormag' ),
		'default'   => false,
		'type'      => 'customind-checkbox',
		'section'   => 'colormag_social_icons_section',
		'condition' => array(
			'colormag_enable_social_icons' => true,
		),
		'priority'  => $social_links_count,
	);

	// Social links separator.
	$options[ $colormag_social_link['id'] . '_separator' ] = array(
		'type'      => 'customind-divider',
		'section'   => 'colormag_social_icons_section',
		'condition' => array(
			'colormag_enable_social_icons' => true,
		),
		'priority'  => $social_links_count,
	);

	++$social_links_count;
}

$options['colormag_social_icons_upgrade'] = array(
	'type'        => 'customind-upsell',
	'description' => esc_html__( 'Unlock more features available in Pro version.', 'colormag' ),
	'title'       => esc_html__( 'Learn more', 'colormag' ),
	'url'         => esc_url( 'https://themegrill.com/pricing/?utm_medium=customizer-upgrade&utm_source=colormag-theme&utm_campaign=customizer-upgrade-button&utm_content=learn-more' ),
	'section'     => 'colormag_social_icons_section',
	'priority'    => 1000,
);

colormag_customind()->add_controls( $options );
