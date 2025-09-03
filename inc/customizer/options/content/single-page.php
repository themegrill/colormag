<?php
$container_layout_choices = apply_filters(
	'colormag_container_layout_choices',
	array(
		'default'                     => array(
			'label' => 'Inherit',
			'url'   => COLORMAG_PARENT_URL . '/assets/img/sidebar/inherit.svg',
		),
		'no_sidebar_full_width'       => array(
			'label' => 'Normal',
			'url'   => COLORMAG_PARENT_URL . '/assets/img/sidebar/normal.svg',
		),
		'no_sidebar_content_centered' => array(
			'label' => 'Narrow',
			'url'   => COLORMAG_PARENT_URL . '/assets/img/sidebar/narrow.svg',
		),
	)
);

$sidebar_layout_choices = apply_filters(
	'colormag_site_layout_choices',
	array(
		'default'       => array(
			'label' => 'Inherit',
			'url'   => COLORMAG_PARENT_URL . '/assets/img/sidebar/inherit.svg',
		),
		'no_sidebar'    => array(
			'label' => 'No Sidebar',
			'url'   => COLORMAG_PARENT_URL . '/assets/img/sidebar/no-sidebar.svg',
		),
		'right_sidebar' => array(
			'label' => 'Right Sidebar',
			'url'   => COLORMAG_PARENT_URL . '/assets/img/sidebar/right-sidebar.svg',
		),
		'left_sidebar'  => array(
			'label' => 'Left Sidebar',
			'url'   => COLORMAG_PARENT_URL . '/assets/img/sidebar/left-sidebar.svg',
		),
	)
);
$options                = apply_filters(
	'colormag_page_options',
	array(
		'colormag_single_page_container_layout'       => array(
			'default'   => 'default',
			'type'      => 'customind-radio-image',
			'title'     => esc_html__( 'Container Layout', 'colormag' ),
			'section'   => 'colormag_page_section',
			'tab_group' => 'colormag_single_page_container_tab_group',
			'tab'       => 'general',
			'choices'   => $container_layout_choices,
			'columns'   => 2,
			'priority'  => 10,
		),
		'colormag_single_page_sidebar_layout_divider' => array(
			'type'      => 'customind-divider',
			'variant'   => 'dashed',
			'tab'       => 'general',
			'section'   => 'colormag_page_section',
			'tab_group' => 'colormag_single_page_container_tab_group',
		),
		'colormag_single_page_sidebar_layout'         => array(
			'default'   => 'default',
			'type'      => 'customind-radio-image',
			'title'     => esc_html__( 'Sidebar Layout', 'colormag' ),
			'section'   => 'colormag_page_section',
			'tab_group' => 'colormag_single_page_container_tab_group',
			'tab'       => 'general',
			'choices'   => $sidebar_layout_choices,
			'columns'   => 2,
			'priority'  => 10,
		),
		'colormag_single_page_layout_divider'         => array(
			'type'      => 'customind-divider',
			'variant'   => 'dashed',
			'tab'       => 'general',
			'section'   => 'colormag_page_section',
			'tab_group' => 'colormag_single_page_container_tab_group',
		),
		'colormag_archive_page_heading'               => array(
			'type'      => 'customind-heading',
			'title'     => esc_html__( 'Page Header', 'colormag' ),
			'section'   => 'colormag_page_section',
			'tab'       => 'general',
			'tab_group' => 'colormag_single_page_container_tab_group',
		),
		'colormag_enable_page_header'                 => array(
			'title'     => esc_html__( 'Enable', 'colormag' ),
			'default'   => true,
			'type'      => 'customind-toggle',
			'section'   => 'colormag_page_section',
			'tab'       => 'general',
			'tab_group' => 'colormag_single_page_container_tab_group',
		),
		'colormag_page_featured_image_heading'        => array(
			'type'      => 'customind-heading',
			'title'     => esc_html__( 'Featured Image', 'colormag' ),
			'section'   => 'colormag_page_section',
			'tab'       => 'general',
			'tab_group' => 'colormag_single_page_container_tab_group',
		),
		'colormag_enable_page_featured_image'         => array(
			'title'     => esc_html__( 'Enable', 'colormag' ),
			'default'   => false,
			'type'      => 'customind-toggle',
			'section'   => 'colormag_page_section',
			'transport' => 'refresh',
			'tab_group' => 'colormag_single_page_container_tab_group',
			'tab'       => 'general',
		),
		'colormag_page_upgrade'                       => array(
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
