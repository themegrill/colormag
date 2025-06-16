<?php

$options = array(
	'colormag_container_heading'            => array(
		'type'         => 'customind-accordion',
		'title'        => esc_html__( 'Container', 'colormag' ),
		'section'      => 'colormag_global_container_section',
		'sub_controls' => apply_filters(
			'colormag_container_sub_controls',
			array(
				'colormag_container_layout_general_heading' => array(
					'type'    => 'customind-title',
					'title'   => esc_html__( 'General', 'colormag' ),
					'section' => 'colormag_global_container_section',
				),
				'colormag_container_layout'     => array(
					'default'   => 'wide',
					'type'      => 'customind-radio-image',
					'title'     => esc_html__( 'Layout', 'colormag' ),
					'section'   => 'colormag_global_container_section',
					'transport' => 'postMessage',
					'choices'   => array(
						'wide'  => array(
							'label' => 'Wide',
							'url'   => COLORMAG_PARENT_URL . '/assets/img/container-layout/wide.svg',
						),
						'boxed' => array(
							'label' => 'Boxed',
							'url'   => COLORMAG_PARENT_URL . '/assets/img/container-layout/box.svg',
						),
					),
					'columns'   => 2,
					'priority'  => 10,
				),
				'colormag_content_area_padding' => array(
					'default'     => array(
						'top'    => '60',
						'right'  => '',
						'bottom' => '60',
						'left'   => '',
						'unit'   => 'px',
					),
					'type'        => 'customind-dimensions',
					'title'       => esc_html__( 'Content Area Padding', 'colormag' ),
					'section'     => 'colormag_button_section',
					'units'       => array( 'px', 'em' ),
					'defaultUnit' => 'px',
				),
			)
		),
		'collapsible'  => apply_filters( 'colormag_container_accordion_collapsible', false ),
	),
	'colormag_container_background_heading' => array(
		'type'         => 'customind-accordion',
		'title'        => esc_html__( 'Background', 'colormag' ),
		'section'      => 'colormag_global_container_section',
		'sub_controls' => apply_filters(
			'colormag_container_background_sub_controls',
			array(
				'colormag_inside_container_background'  => array(
					'default'   => array(
						'background-color'      => '#ffffff',
						'background-image'      => '',
						'background-position'   => 'center center',
						'background-size'       => 'auto',
						'background-attachment' => 'scroll',
						'background-repeat'     => 'repeat',
					),
					'type'      => 'customind-background',
					'title'     => esc_html__( 'Inside Background', 'colormag' ),
					'section'   => 'colormag_global_container_section',
					'transport' => 'postMessage',
					'priority'  => 20,
				),
				'colormag_outside_container_background' => array(
					'default'   => array(
						'background-color'      => '',
						'background-image'      => '',
						'background-position'   => 'center center',
						'background-size'       => 'auto',
						'background-attachment' => 'scroll',
						'background-repeat'     => 'repeat',
					),
					'type'      => 'customind-background',
					'title'     => esc_html__( 'Outside Background', 'colormag' ),
					'section'   => 'colormag_global_container_section',
					'transport' => 'postMessage',
					'priority'  => 20,
					'condition' => array(
						'colormag_container_layout' => 'boxed',
					),
				),
			)
		),
		'collapsible'  => apply_filters( 'colormag_container_background_accordion_collapsible', false ),
	),
	'colormag_demo_migrated_heading'        => array(
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
	'colormag_base_colors_upgrade'          => array(
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
