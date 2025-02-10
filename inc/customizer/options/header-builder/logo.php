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
						'size'  => '',
						'units' => 'px',
					),
					'type'        => 'customind-slider',
					'title'       => esc_html__( 'Height', 'colormag' ),
					'transport'   => 'postMessage',
					'section'     => 'colormag_header_builder_logo',
					'units'       => array( 'px' ),
					'defaultUnit' => 'px',
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
								'default'   => '',
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
			),
		),
		'collapsible'  => apply_filters( 'colormag_tagline_accordion_collapsible', false ),
	),
);

colormag_customind()->add_controls( $options );
