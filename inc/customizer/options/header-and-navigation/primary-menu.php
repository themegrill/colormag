<?php

$options = apply_filters(
	'colormag-primary_menu_options',
	array(
		'colormag_primary_menu_heading'      => array(
			'type'         => 'customind-accordion',
			'title'        => esc_html__( 'Primary Menu', 'colormag' ),
			'section'      => 'colormag_primary_menu_section',
			'sub_controls' => apply_filters(
				'colormag_primary_menu_sub_controls',
				array(
					'colormag_primary_menu_style_subtitle' => array(
						'type'    => 'customind-title',
						'title'   => esc_html__( 'Style', 'colormag' ),
						'section' => 'colormag_primary_menu_section',
					),
					'colormag_primary_menu_background'     => array(
						'default'   => array(
							'background-color'      => '#27272A',
							'background-image'      => '',
							'background-position'   => 'center center',
							'background-size'       => 'auto',
							'background-attachment' => 'scroll',
							'background-repeat'     => 'repeat',
						),
						'type'      => 'customind-background',
						'title'     => esc_html__( 'Background', 'colormag' ),
						'transport' => 'postMessage',
						'section'   => 'colormag_primary_menu_section',
					),
					'colormag_button_border_divider'       => array(
						'type'    => 'customind-divider',
						'variant' => 'dashed',
						'section' => 'colormag_primary_menu_section',
					),
					'colormag_button_border_subtitle'      => array(
						'type'    => 'customind-title',
						'title'   => esc_html__( 'Border Top', 'colormag' ),
						'section' => 'colormag_primary_menu_section',
					),
					'colormag_primary_menu_top_border_width' => array(
						'default'     => array(
							'size'  => '4',
							'units' => 'px',
						),
						'type'        => 'customind-slider',
						'title'       => esc_html__( 'Width', 'colormag' ),
						'section'     => 'colormag_primary_menu_section',
						'transport'   => 'postMessage',
						'units'       => array( 'px' ),
						'defaultUnit' => 'px',
					),
					'colormag_primary_menu_top_border_color' => array(
						'title'   => esc_html__( 'Color', 'colormag' ),
						'default' => 'var(--cm-color-1)',
						'type'    => 'customind-color',
						'section' => 'colormag_primary_menu_section',
					),
				)
			),
			'collapsible'  => apply_filters( 'colormag_primary_menu_accordion_collapsible', false ),
		),
		'colormag_main_menu_heading'         => array(
			'type'         => 'customind-accordion',
			'title'        => esc_html__( 'Main Menu', 'colormag' ),
			'section'      => 'colormag_primary_menu_section',
			'sub_controls' => apply_filters(
				'colormag_main_menu_sub_controls',
				array(
					'colormag_primary_menu_color_group' => array(
						'type'         => 'customind-color-group',
						'title'        => esc_html__( 'Color', 'colormag' ),
						'section'      => 'colormag_primary_menu_section',
						'sub_controls' => apply_filters(
							'colormag_primary_menu_sub_controls',
							array(
								'colormag_primary_menu_text_color' => array(
									'default'   => '',
									'type'      => 'customind-color',
									'title'     => esc_html__( 'Normal', 'colormag' ),
									'transport' => 'postMessage',
									'section'   => 'colormag_primary_menu_section',
								),
								'colormag_primary_menu_selected_hovered_text_color' => array(
									'default'   => '',
									'type'      => 'customind-color',
									'title'     => esc_html__( 'Hover/Selected', 'colormag' ),
									'transport' => 'postMessage',
									'section'   => 'colormag_primary_menu_section',
								),
							)
						),
					),
					'colormag_primary_menu_typography'  => array(
						'default'   => array(
							'font-family' => 'default',
							'font-weight' => '600',
							'font-size'   => array(
								'desktop' => array(
									'size' => '14',
									'unit' => 'px',
								),
								'tablet'  => array(
									'size' => '',
									'unit' => '',
								),
								'mobile'  => array(
									'size' => '',
									'unit' => '',
								),
							),
						),
						'type'      => 'customind-typography',
						'title'     => esc_html__( 'Typography', 'colormag' ),
						'transport' => 'postMessage',
						'section'   => 'colormag_primary_menu_section',
					),
				)
			),
			'collapsible'  => apply_filters( 'colormag_main_menu_accordion_collapsible', false ),
		),
		'colormag_sub_menu_heading'          => array(
			'type'         => 'customind-accordion',
			'title'        => esc_html__( 'Sub Menu', 'colormag' ),
			'section'      => 'colormag_primary_menu_section',
			'sub_controls' => apply_filters(
				'colormag_sub_menu_sub_controls',
				array(
					'colormag_primary_sub_menu_background' => array(
						'default'   => array(
							'background-color'      => '#232323',
							'background-image'      => '',
							'background-position'   => 'center center',
							'background-size'       => 'auto',
							'background-attachment' => 'scroll',
							'background-repeat'     => 'repeat',
						),
						'type'      => 'customind-background',
						'title'     => esc_html__( 'Background', 'colormag' ),
						'transport' => 'postMessage',
						'section'   => 'colormag_primary_menu_section',
					),
					'colormag_primary_sub_menu_typography' => array(
						'default'   => array(
							'font-size' => array(
								'desktop' => array(
									'size' => '14',
									'unit' => 'px',
								),
								'tablet'  => array(
									'size' => '',
									'unit' => '',
								),
								'mobile'  => array(
									'size' => '',
									'unit' => '',
								),
							),
						),
						'type'      => 'customind-typography',
						'title'     => esc_html__( 'Typography', 'colormag' ),
						'transport' => 'postMessage',
						'section'   => 'colormag_primary_menu_section',
					),
				)
			),
			'collapsible'  => apply_filters( 'colormag_sub_menu_accordion_collapsible', false ),
		),
		'colormag_mobile_menu_heading'       => array(
			'type'         => 'customind-accordion',
			'title'        => esc_html__( 'Mobile Menu', 'colormag' ),
			'section'      => 'colormag_primary_menu_section',
			'sub_controls' => apply_filters(
				'colormag_mobile_menu_sub_controls',
				array(
					'colormag_mobile_menu_general_subtitle' => array(
						'type'    => 'customind-title',
						'title'   => esc_html__( 'General', 'colormag' ),
						'section' => 'colormag_primary_menu_section',
					),
					'colormag_mobile_menu_toggle_icon_color' => array(
						'title'   => esc_html__( 'Icon Color', 'colormag' ),
						'default' => '#fff',
						'type'    => 'customind-color',
						'section' => 'colormag_primary_menu_section',
					),
					'colormag_mobile_menu_style_subtitle_divider' => array(
						'type'    => 'customind-divider',
						'variant' => 'dashed',
						'section' => 'colormag_primary_menu_section',
					),
					'colormag_mobile_menu_style_subtitle' => array(
						'type'    => 'customind-title',
						'title'   => esc_html__( 'Style', 'colormag' ),
						'section' => 'colormag_primary_menu_section',
					),
					'colormag_mobile_menu_color_group'    => array(
						'type'         => 'customind-color-group',
						'title'        => esc_html__( 'Color', 'colormag' ),
						'section'      => 'colormag_primary_menu_section',
						'sub_controls' => apply_filters(
							'colormag_mobile_menu_color_sub_controls',
							array(
								'colormag_mobile_menu_text_color' => array(
									'default'   => '',
									'type'      => 'customind-color',
									'title'     => esc_html__( 'Normal', 'colormag' ),
									'transport' => 'postMessage',
									'section'   => 'colormag_primary_menu_section',
								),
								'colormag_mobile_menu_selected_hovered_text_color' => array(
									'default'   => '',
									'type'      => 'customind-color',
									'title'     => esc_html__( 'Hover/Selected', 'colormag' ),
									'transport' => 'postMessage',
									'section'   => 'colormag_primary_menu_section',
								),
							)
						),
					),
					'colormag_mobile_menu_typography'     => array(
						'default'   => array(
							'font-family' => 'default',
							'font-weight' => '600',
							'font-size'   => array(
								'desktop' => array(
									'size' => '14',
									'unit' => 'px',
								),
								'tablet'  => array(
									'size' => '',
									'unit' => '',
								),
								'mobile'  => array(
									'size' => '',
									'unit' => '',
								),
							),
						),
						'type'      => 'customind-typography',
						'title'     => esc_html__( 'Typography', 'colormag' ),
						'transport' => 'postMessage',
						'section'   => 'colormag_primary_menu_section',
						'condition' => array(
							'colormag_enable_primary_menu' => true,
						),
					),
					'colormag_mobile_sub_menu_style_subtitle_divider' => array(
						'type'    => 'customind-divider',
						'variant' => 'dashed',
						'section' => 'colormag_primary_menu_section',
					),
					'colormag_mobile_sub_menu_style_subtitle' => array(
						'type'    => 'customind-title',
						'title'   => esc_html__( 'Sub Menu', 'colormag' ),
						'section' => 'colormag_primary_menu_section',
					),
					'colormag_mobile_sub_menu_background' => array(
						'default'   => array(
							'background-color'      => '#232323',
							'background-image'      => '',
							'background-position'   => 'center center',
							'background-size'       => 'auto',
							'background-attachment' => 'scroll',
							'background-repeat'     => 'repeat',
						),
						'type'      => 'customind-background',
						'title'     => esc_html__( 'Background', 'colormag' ),
						'transport' => 'postMessage',
						'section'   => 'colormag_primary_menu_section',
					),
					'colormag_mobile_sub_menu_typography' => array(
						'default'   => array(
							'font-size' => array(
								'desktop' => array(
									'size' => '14',
									'unit' => 'px',
								),
								'tablet'  => array(
									'size' => '',
									'unit' => '',
								),
								'mobile'  => array(
									'size' => '',
									'unit' => '',
								),
							),
						),
						'type'      => 'customind-typography',
						'title'     => esc_html__( 'Typography', 'colormag' ),
						'transport' => 'postMessage',
						'section'   => 'colormag_primary_menu_section',
					),
				)
			),
			'collapsible'  => apply_filters( 'colormag_mobile_menu_accordion_collapsible', false ),
		),
		'colormag_icon_logo_display_heading' => array(
			'type'         => 'customind-accordion',
			'title'        => esc_html__( 'Home Icon/Logo', 'colormag' ),
			'section'      => 'colormag_primary_menu_section',
			'sub_controls' => apply_filters(
				'colormag_icon_logo_display_sub_controls',
				array(
					'colormag_menu_icon_logo' => array(
						'default' => 'none',
						'type'    => 'customind-select',
						'title'   => esc_html__( 'Home Icon/Logo', 'colormag' ),
						'section' => 'colormag_primary_menu_section',
						'choices' => array(
							'none'      => esc_html__( 'None', 'colormag' ),
							'home-icon' => esc_html__( 'Home Icon', 'colormag' ),
						),
					),
				)
			),
			'collapsible'  => apply_filters( 'colormag_icon_logo_display_accordion_collapsible', false ),
		),
		'colormag_primary_menu_upgrade'      => array(
			'type'        => 'customind-upsell',
			'description' => esc_html__( 'Unlock more features available in Pro version.', 'colormag' ),
			'title'       => esc_html__( 'Learn more', 'colormag' ),
			'url'         => esc_url( 'https://themegrill.com/pricing/?utm_medium=customizer-upgrade&utm_source=colormag-theme&utm_campaign=customizer-upgrade-button&utm_content=learn-more' ),
			'section'     => 'colormag_primary_menu_section',
			'priority'    => 100,
		),
	)
);

colormag_customind()->add_controls( $options );
