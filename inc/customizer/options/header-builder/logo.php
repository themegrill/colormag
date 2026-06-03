<?php

$options = array(
	'colormag_header_site_identity_general_heading' => array(
		'type'     => 'customind-title',
		'title'    => esc_html__( 'Site Identity', 'colormag' ),
		'section'  => 'colormag_header_builder_logo',
		'priority' => 3,
	),
	'colormag_header_site_logo_heading'             => array(
		'type'         => 'customind-accordion',
		'title'        => esc_html__( 'Site Logo', 'colormag' ),
		'section'      => 'colormag_header_builder_logo',
		'priority'     => 9,
		'sub_controls' => apply_filters(
			'colormag_header_site_logo_sub_controls',
			array(
				'custom_logo'                      => array(
					'type'    => 'customind-image',
					'title'   => esc_html__( 'Logo', 'colormag' ),
					'section' => 'colormag_header_builder_logo',
					'crop'    => array(
						'width'  => 170,
						'height' => 60,
					),
				),
				'colormag_retina_logo'             => array(
					'type'        => 'customind-image',
					'title'       => esc_html__( 'Retina Logo', 'colormag' ),
					'section'     => 'colormag_header_builder_logo',
					'description' => esc_html__( 'Upload 2X times the size of your current logo. Eg: If your current logo size is 120*60 then upload 240*120 sized logo.', 'colormag' ),

				),
				'colormag_header_site_logo_height' => array(
					'default'     => array(
						'desktop' => array(
							'size' => '',
							'unit' => 'px',
						),
						'tablet'  => array(
							'size' => '',
							'unit' => 'px',
						),
						'mobile'  => array(
							'size' => '',
							'unit' => 'px',
						),
					),
					'type'        => 'customind-slider',
					'title'       => esc_html__( 'Width', 'colormag' ),
					'transport'   => 'postMessage',
					'section'     => 'colormag_header_builder_logo',
					'units'       => array( 'px' ),
					'defaultUnit' => 'px',
					'responsive'  => true,
				),
			),
		),
		'collapsible'  => apply_filters( 'colormag_header_site_logo_accordion_collapsible', false ),
	),
	'colormag_header_site_identity_heading'         => array(
		'type'         => 'customind-accordion',
		'title'        => esc_html__( 'Site Title', 'colormag' ),
		'section'      => 'colormag_header_builder_logo',
		'priority'     => 11,
		'sub_controls' => apply_filters(
			'colormag_header_site_identity_sub_controls',
			array(
				'colormag_enable_site_identity'         => array(
					'title'    => esc_html__( 'Enable', 'colormag' ),
					'default'  => true,
					'type'     => 'customind-toggle',
					'section'  => 'colormag_header_builder_logo',
					'priority' => 10,
				),
				'colormag_header_site_identity_color_group' => array(
					'type'         => 'customind-color-group',
					'title'        => esc_html__( 'Color', 'colormag' ),
					'section'      => 'colormag_header_builder_logo',
					'sub_controls' => apply_filters(
						'colormag_header_site_identity_color_sub_controls',
						array(
							'colormag_header_site_identity_color' => array(
								'default'   => 'var(--cm-color-1)',
								'type'      => 'customind-color',
								'title'     => esc_html__( 'Normal', 'colormag' ),
								'transport' => 'postMessage',
								'section'   => 'colormag_header_builder_logo',
							),
							'colormag_header_site_identity_hover_color' => array(
								'default'   => '',
								'type'      => 'customind-color',
								'title'     => esc_html__( 'Hover', 'colormag' ),
								'transport' => 'postMessage',
								'section'   => 'colormag_header_builder_logo',
							),
						),
					),
					'condition'    => array(
						'colormag_enable_site_identity' => true,
					),
				),
				'colormag_header_site_title_typography' => array(
					'default'   => array(
						'font-family'    => 'Default',
						'font-weight'    => '400',
						'subsets'        => array( 'latin' ),
						'font-size'      => array(
							'desktop' => array(
								'size' => '4',
								'unit' => 'rem',
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
						'line-height'    => array(
							'desktop' => array(
								'size' => '1.5',
								'unit' => '-',
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
						'font-style'     => 'normal',
						'text-transform' => 'none',
					),
					'type'      => 'customind-typography',
					'title'     => esc_html__( 'Typography', 'colormag' ),
					'section'   => 'colormag_header_builder_logo',
					'transport' => 'postMessage',
					'priority'  => 14,
					'condition' => array(
						'colormag_enable_site_identity' => true,
					),
				),
				'colormag_header_site_title_visibility' => [
					'default'   => array(
						'desktop',
						'tablet',
						'mobile',
					),
					'type'      => 'customind-visibility-button',
					'title'     => esc_html__( 'Site Title Visibility', 'colormag' ),
					'section'   => 'colormag_header_builder_logo',
					'multiple'  => true,
					'priority'  => 20,
					'choices'   => [
						'desktop' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M16.5 2.5h-12a2.333 2.333 0 0 0-2.333 2.308v7.5A2.342 2.342 0 0 0 4.5 14.642h5.167v1.325H7.5a.834.834 0 0 0 0 1.666h6a.833.833 0 1 0 0-1.666h-2.167V14.65H16.5a2.342 2.342 0 0 0 2.333-2.333v-7.5A2.333 2.333 0 0 0 16.5 2.5Zm.667 9.833A.667.667 0 0 1 16.5 13h-12a.666.666 0 0 1-.667-.667v-7.5a.658.658 0 0 1 .667-.666h12a.659.659 0 0 1 .667.658v7.508Z"/></svg>',
						'tablet'  => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M15.042 18.4H5.958a2.276 2.276 0 0 1-2.275-2.275V4a2.267 2.267 0 0 1 2.275-2.267h9.084A2.267 2.267 0 0 1 17.317 4v12.125a2.275 2.275 0 0 1-2.275 2.275ZM5.958 3.24A.758.758 0 0 0 5.2 4v12.125a.758.758 0 0 0 .758.758h9.084a.758.758 0 0 0 .758-.758V4a.758.758 0 0 0-.758-.759H5.958Zm5.3 11.367a.758.758 0 0 0-.758-.758.758.758 0 1 0 .767.758h-.009Z"/></svg>',
						'mobile'  => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M14.292 18.333H6.709a2.275 2.275 0 0 1-2.267-2.275V3.941a2.267 2.267 0 0 1 2.267-2.274h7.583a2.267 2.267 0 0 1 2.267 2.266v12.134a2.275 2.275 0 0 1-2.267 2.266ZM6.709 3.192a.75.75 0 0 0-.75.75v12.125a.75.75 0 0 0 .75.758h7.583a.75.75 0 0 0 .75-.758V3.94a.75.75 0 0 0-.75-.75H6.709Zm4.558 11.358a.758.758 0 0 0-.758-.759.758.758 0 1 0 .766.759h-.008Z"/></svg>',
					],
					'condition' => array(
						'colormag_enable_site_identity' => true,
					),
				],
			),
		),
		'collapsible'  => apply_filters( 'colormag_header_site_identity_accordion_collapsible', false ),
	),
	'colormag_header_tagline_heading'               => array(
		'type'         => 'customind-accordion',
		'title'        => esc_html__( 'Tagline', 'colormag' ),
		'section'      => 'colormag_header_builder_logo',
		'priority'     => 11,
		'sub_controls' => apply_filters(
			'colormag_tagline_sub_controls',
			array(
				'colormag_enable_site_tagline'            => array(
					'default'  => true,
					'type'     => 'customind-toggle',
					'title'    => 'Enable',
					'section'  => 'colormag_header_builder_logo',
					'priority' => 16,
				),
				'colormag_header_site_tagline_color'      => array(
					'title'     => esc_html__( 'Color', 'colormag' ),
					'default'   => '',
					'type'      => 'customind-color',
					'section'   => 'colormag_header_builder_logo',
					'transport' => 'postMessage',
					'priority'  => 16,
					'condition' => array(
						'colormag_enable_site_tagline' => true,
					),
				),
				'colormag_header_site_tagline_typography' => array(
					'default'   => array(
						'font-family'    => 'Default',
						'font-weight'    => '400',
						'subsets'        => array( 'latin' ),
						'font-size'      => array(
							'desktop' => array(
								'size' => '',
								'unit' => 'rem',
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
						'line-height'    => array(
							'desktop' => array(
								'size' => '1.8',
								'unit' => '-',
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
						'font-style'     => 'normal',
						'text-transform' => 'none',
					),
					'type'      => 'customind-typography',
					'title'     => esc_html__( 'Typography', 'colormag' ),
					'section'   => 'colormag_header_builder_logo',
					'transport' => 'postMessage',
					'priority'  => 18,
					'condition' => array(
						'colormag_enable_site_tagline' => true,
					),
				),
				'colormag_header_site_tagline_visibility' => [
					'default'   => array(
						'desktop',
						'tablet',
						'mobile',
					),
					'type'      => 'customind-visibility-button',
					'title'     => esc_html__( 'Site Tagline Visibility', 'colormag' ),
					'section'   => 'colormag_header_builder_logo',
					'priority'  => 20,
					'multiple'  => true,
					'choices'   => [
						'desktop' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M16.5 2.5h-12a2.333 2.333 0 0 0-2.333 2.308v7.5A2.342 2.342 0 0 0 4.5 14.642h5.167v1.325H7.5a.834.834 0 0 0 0 1.666h6a.833.833 0 1 0 0-1.666h-2.167V14.65H16.5a2.342 2.342 0 0 0 2.333-2.333v-7.5A2.333 2.333 0 0 0 16.5 2.5Zm.667 9.833A.667.667 0 0 1 16.5 13h-12a.666.666 0 0 1-.667-.667v-7.5a.658.658 0 0 1 .667-.666h12a.659.659 0 0 1 .667.658v7.508Z"/></svg>',
						'tablet'  => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M15.042 18.4H5.958a2.276 2.276 0 0 1-2.275-2.275V4a2.267 2.267 0 0 1 2.275-2.267h9.084A2.267 2.267 0 0 1 17.317 4v12.125a2.275 2.275 0 0 1-2.275 2.275ZM5.958 3.24A.758.758 0 0 0 5.2 4v12.125a.758.758 0 0 0 .758.758h9.084a.758.758 0 0 0 .758-.758V4a.758.758 0 0 0-.758-.759H5.958Zm5.3 11.367a.758.758 0 0 0-.758-.758.758.758 0 1 0 .767.758h-.009Z"/></svg>',
						'mobile'  => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M14.292 18.333H6.709a2.275 2.275 0 0 1-2.267-2.275V3.941a2.267 2.267 0 0 1 2.267-2.274h7.583a2.267 2.267 0 0 1 2.267 2.266v12.134a2.275 2.275 0 0 1-2.267 2.266ZM6.709 3.192a.75.75 0 0 0-.75.75v12.125a.75.75 0 0 0 .75.758h7.583a.75.75 0 0 0 .75-.758V3.94a.75.75 0 0 0-.75-.75H6.709Zm4.558 11.358a.758.758 0 0 0-.758-.759.758.758 0 1 0 .766.759h-.008Z"/></svg>',
					],
					'condition' => array(
						'colormag_enable_site_tagline' => true,
					),
				],
			),
		),
		'collapsible'  => apply_filters( 'colormag_tagline_accordion_collapsible', false ),
	),
);

colormag_customind()->add_controls( $options );
