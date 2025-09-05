<?php
$container_layout_choices = apply_filters(
	'colormag_container_layout_choices',
	array(
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
	'colormag_sidebar_layout_choices',
	array(
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

$options = array(
	'colormag_layout_heading'          => array(
		'type'    => 'customind-heading',
		'title'   => esc_html__( 'Container', 'colormag' ),
		'section' => 'colormag_global_layout_section',
	),
	'colormag_global_container_layout' => array(
		'default' => 'no_sidebar_full_width',
		'type'    => 'customind-radio-image',
		'title'   => esc_html__( 'Layout', 'colormag' ),
		'section' => 'colormag_global_layout_section',
		'choices' => $container_layout_choices,
		'columns' => 2,
	),
	'colormag_container_layout'        => [
		'type'    => 'customind-toggle-button',
		'default' => 'wide',
		'title'   => esc_html__( 'Style', 'colormag' ),
		'section' => 'colormag_global_layout_section',
		'choices' => [
			'wide'  => esc_html__( 'Wide', 'colormag' ),
			'boxed' => esc_html__( 'Boxed', 'colormag' ),
		],
	],
	'colormag_content_area_padding'    => array(
		'default'     => array(
			'top'    => '60',
			'right'  => '',
			'bottom' => '60',
			'left'   => '',
			'unit'   => 'px',
		),
		'type'        => 'customind-dimensions',
		'title'       => esc_html__( 'Content Area Padding', 'colormag' ),
		'section'     => 'colormag_global_layout_section',
		'units'       => array( 'px', 'em' ),
		'defaultUnit' => 'px',
	),
	'colormag_sidebar_heading'         => array(
		'type'    => 'customind-heading',
		'title'   => esc_html__( 'Sidebar', 'colormag' ),
		'section' => 'colormag_global_layout_section',
	),
	'colormag_global_sidebar_layout'   => array(
		'default' => 'no_sidebar',
		'type'    => 'customind-radio-image',
		'title'   => esc_html__( 'Layout', 'colormag' ),
		'section' => 'colormag_global_layout_section',
		'choices' => $sidebar_layout_choices,
		'columns' => 2,
	),
	'colormag_sidebar_width'           => array(
		'title'       => esc_html__( 'Width', 'colormag' ),
		'default'     => array(
			'size' => 30,
			'unit' => '%',
		),
		'type'        => 'customind-slider',
		'section'     => 'colormag_global_layout_section',
		'priority'    => 10,
		'units'       => array( '%', 'em', 'rem' ),
		'defaultUnit' => '%',
		'condition'   => array(
			'colormag_global_sidebar_layout!' => 'no_sidebar',
		),
	),
	'colormag_demo_migrated_heading'   => array(
		'type'         => 'customind-accordion',
		'title'        => esc_html__( 'Demo Migrated', 'colormag' ),
		'section'      => 'colormag_global_container_section',
		'sub_controls' => apply_filters(
			'colormag_demo_migrated_sub_controls',
			array(
				'demo_migrated_to_builder' => array(
					'default' => 0,
					'title'   => esc_html__( 'Demo Migrated To Builder', 'colormag' ),
					'type'    => 'customind-toggle',
					'section' => 'colormag_global_container_section',
				),
			),
		),
		'collapsible'  => apply_filters( 'colormag_demo_migrated_accordion_collapsible', false ),
	),
	'colormag_base_colors_upgrade'     => array(
		'type'        => 'customind-upgrade',
		'description' => esc_html__( 'Upgrade to Pro for more features!', 'colormag' ),
		'label'       => esc_html__( 'Upgrade to Pro', 'colormag' ),
		'url'         => esc_url( 'https://themegrill.com/pricing/?utm_medium=customizer-upgrade&utm_source=colormag-theme&utm_campaign=customizer-upgrade-button&utm_content=learn-more' ),
		'points'      => array(
			esc_html__( 'Container width adjustment', 'colormag' ),
		),
		'section'     => 'colormag_global_container_section',
		'priority'    => 100,
	),
);

colormag_customind()->add_controls( $options );
