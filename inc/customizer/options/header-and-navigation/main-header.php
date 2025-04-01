<?php

$options = apply_filters(
	'colormag_main_header_options',
	array(
		'colormag_main_header_title'   => array(
			'type'         => 'customind-accordion',
			'title'        => esc_html__( 'Main Header', 'colormag' ),
			'section'      => 'colormag_primary_header_section',
			'priority'     => 10,
			'sub_controls' => apply_filters(
				'colormag_main_header_sub_controls',
				array(
					'colormag_main_header_layout_general_heading' => array(
						'type'    => 'customind-title',
						'title'   => esc_html__( 'General', 'colormag' ),
						'section' => 'colormag_primary_header_section',
					),
					'colormag_main_header_layout'         => array(
						'default'   => 'layout-1',
						'type'      => 'customind-select',
						'title'     => esc_html__( 'Layout', 'colormag' ),
						'transport' => 'postMessage',
						'section'   => 'colormag_primary_header_section',
						'choices'   => array(
							'layout-1' => esc_html__( 'Layout 1', 'colormag' ),
							'layout-2' => esc_html__( 'Layout 2', 'colormag' ),
						),
					),
					'colormag_main_header_layout_1_style' => array(
						'default'   => 'style-1',
						'type'      => 'customind-radio-image',
						'title'     => esc_html__( 'Advanced Style', 'colormag' ),
						'section'   => 'colormag_primary_header_section',
						'priority'  => 10,
						'choices'   => apply_filters(
							'colormag_main_header_layout_1_style_choices',
							array(
								'style-1' => array(
									'label' => '',
									'url'   => COLORMAG_IMG_URL . '/main-header/layout-1/style-1.svg',
								),
							)
						),
						'columns'   => 2,
						'condition' => apply_filters(
							'colormag_main_header_style_cb',
							array(
								'colormag_main_header_layout' => 'layout-1',
							)
						),
					),
					'colormag_main_header_layout_2_style' => array(
						'default'   => 'style-1',
						'type'      => 'customind-radio-image',
						'title'     => esc_html__( 'Advanced Style', 'colormag' ),
						'section'   => 'colormag_primary_header_section',
						'priority'  => 10,
						'choices'   => apply_filters(
							'colormag_main_header_layout_1_style_choices',
							array(
								'style-1' => array(
									'label' => '',
									'url'   => COLORMAG_IMG_URL . '/main-header/layout-2/style-1.svg',
								),
							)
						),
						'columns'   => 2,
						'condition' => array(
							'colormag_main_header_layout' => 'layout-2',
						),
					),
					'colormag_header_display_type'        => array(
						'default'   => 'type_one',
						'type'      => 'customind-radio-image',
						'title'     => esc_html__( 'Alignment', 'colormag' ),
						'section'   => 'colormag_primary_header_section',
						'priority'  => 10,
						'choices'   => apply_filters(
							'colormag_header_display_type_choices',
							array(
								'type_one'   => array(
									'label' => '',
									'url'   => COLORMAG_IMG_URL . '/alignment/align-left.svg',
								),
								'type_three' => array(
									'label' => '',
									'url'   => COLORMAG_IMG_URL . '/alignment/align-center.svg',
								),
								'type_two'   => array(
									'label' => '',
									'url'   => COLORMAG_IMG_URL . '/alignment/align-right.svg',
								),
							)
						),
						'columns'   => 2,
						'condition' => array(
							'colormag_main_header_layout!' => 'layout-2',
						),
					),
					'colormag_main_header_width_setting'  => array(
						'default'   => 'full-width',
						'type'      => 'customind-select',
						'title'     => esc_html__( 'Width', 'colormag' ),
						'section'   => 'colormag_primary_header_section',
						'choices'   => array(
							'full-width' => esc_html__( 'Full Width', 'colormag' ),
							'contained'  => esc_html__( 'Contained', 'colormag' ),
						),
						'priority'  => 20,
						'condition' => array(
							'colormag_main_header_layout' => 'layout-1',
						),
					),
					'colormag_main_header_background_color_divider' => array(
						'type'     => 'customind-divider',
						'variant'  => 'dashed',
						'section'  => 'colormag_primary_header_section',
						'priority' => 20,
					),
					'colormag_main_header_style_subtitle' => array(
						'type'     => 'customind-title',
						'title'    => esc_html__( 'Style', 'colormag' ),
						'section'  => 'colormag_primary_header_section',
						'priority' => 20,
					),
					'colormag_main_header_background'     => array(
						'default'   => array(
							'background-color'      => '',
							'background-image'      => '',
							'background-position'   => 'center center',
							'background-size'       => 'auto',
							'background-attachment' => 'scroll',
							'background-repeat'     => 'repeat',
						),
						'priority'  => 20,
						'type'      => 'customind-background',
						'title'     => esc_html__( 'Background', 'colormag' ),
						'transport' => 'postMessage',
						'section'   => 'colormag_primary_header_section',
					),
				)
			),
			'collapsible'  => apply_filters( 'colormag_main_header_accordion_collapsible', false ),
		),
		'colormag_main_header_upgrade' => array(
			'type'        => 'customind-upsell',
			'description' => esc_html__( 'Unlock more features available in Pro version.', 'colormag' ),
			'title'       => esc_html__( 'Learn more', 'colormag' ),
			'url'         => esc_url( 'https://themegrill.com/pricing/?utm_medium=customizer-upgrade&utm_source=colormag-theme&utm_campaign=customizer-upgrade-button&utm_content=learn-more' ),
			'section'     => 'colormag_primary_header_section',
			'priority'    => 100,
		),
	)
);

colormag_customind()->add_controls( $options );
