<?php

$sidebar_layout_choices = apply_filters(
	'colormag_site_layout_choices',
	array(
		'right_sidebar'               => array(
			'label' => '',
			'url'   => COLORMAG_PARENT_URL . '/assets/img/sidebar/right-sidebar.svg',
		),
		'left_sidebar'                => array(
			'label' => '',
			'url'   => COLORMAG_PARENT_URL . '/assets/img/sidebar/left-sidebar.svg',
		),
		'no_sidebar_full_width'       => array(
			'label' => '',
			'url'   => COLORMAG_PARENT_URL . '/assets/img/sidebar/contained.svg',
		),
		'no_sidebar_content_centered' => array(
			'label' => '',
			'url'   => COLORMAG_PARENT_URL . '/assets/img/sidebar/centered.svg',
		),
	)
);

$options = apply_filters(
	'colormag_sidebar_options',
	array(
		'colormag_sidebar_layout_title' => array(
			'type'         => 'customind-accordion',
			'title'        => esc_html__( 'Layout', 'colormag' ),
			'section'      => 'colormag_global_sidebar_section',
			'sub_controls' => apply_filters(
				'colormag_sidebar_layout_title_sub_controls',
				array(
					'colormag_default_sidebar_layout' => array(
						'default'  => 'right_sidebar',
						'type'     => 'customind-radio-image',
						'title'    => esc_html__( 'Default Layout', 'colormag' ),
						'section'  => 'colormag_global_sidebar_section',
						'choices'  => $sidebar_layout_choices,
						'priority' => 5,
						'columns'  => 2,
					),
					'colormag_page_sidebar_layout'    => array(
						'default'  => 'right_sidebar',
						'type'     => 'customind-radio-image',
						'title'    => esc_html__( 'Default layout for pages only', 'colormag' ),
						'section'  => 'colormag_global_sidebar_section',
						'choices'  => $sidebar_layout_choices,
						'priority' => 10,
						'columns'  => 2,
					),
					'colormag_post_sidebar_layout'    => array(
						'default'  => 'right_sidebar',
						'type'     => 'customind-radio-image',
						'title'    => esc_html__( 'Default layout for single posts only', 'colormag' ),
						'section'  => 'colormag_global_sidebar_section',
						'choices'  => $sidebar_layout_choices,
						'priority' => 25,
						'columns'  => 2,
					),
				)
			),
			'collapsible'  => apply_filters( 'colormag_global_sidebar_heading_accordion_collapsible', false ),
		),
		'colormag_sidebar_upgrade'      => array(
			'type'        => 'customind-upgrade',
			'description' => esc_html__( 'Upgrade to Pro for more features!', 'colormag' ),
			'label'       => esc_html__( 'Upgrade to Pro', 'colormag' ),
			'url'         => esc_url( 'https://themegrill.com/pricing/?utm_medium=customizer-upgrade&utm_source=colormag-theme&utm_campaign=customizer-upgrade-button&utm_content=learn-more' ),
			'points'      => array(
				esc_html__( 'Sticky sidebar', 'colormag' ),
				esc_html__( 'Sidebar widget title color and typography', 'colormag' ),
				esc_html__( 'Two sidebar layout', 'colormag' ),
			),
			'section'     => 'colormag_global_sidebar_section',
			'priority'    => 100,
		),
	)
);

colormag_customind()->add_controls( $options );
