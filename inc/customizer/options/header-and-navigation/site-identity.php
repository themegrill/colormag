<?php

$options = apply_filters(
	'colormag_site_identity_options',
	array(
		'colormag_site_identity_general_heading' => array(
			'type'     => 'customind-title',
			'title'    => esc_html__( 'Site Identity', 'colormag' ),
			'section'  => 'title_tagline',
			'priority' => 3,
		),
		'colormag_site_logo_heading'             => array(
			'type'         => 'customind-accordion',
			'title'        => esc_html__( 'Site Logo', 'colormag' ),
			'section'      => 'title_tagline',
			'priority'     => 9,
			'sub_controls' => apply_filters(
				'colormag_site_logo_sub_controls',
				array(
					'custom_logo'          => array(
						'type'    => 'customind-image',
						'title'   => esc_html__( 'Logo', 'colormag' ),
						'section' => 'title_tagline',
						'crop'    => array(
							'width'  => 170,
							'height' => 60,
						),
					),
					'colormag_retina_logo' => array(
						'type'        => 'customind-image',
						'title'       => esc_html__( 'Retina Logo', 'colormag' ),
						'section'     => 'title_tagline',
						'description' => esc_html__( 'Upload 2X times the size of your current logo. Eg: If your current logo size is 120*60 then upload 240*120 sized logo.', 'colormag' ),

					),
				),
			),
			'collapsible'  => apply_filters( 'colormag_site_logo_accordion_collapsible', false ),
		),
		'colormag_site_title_heading'            => array(
			'type'         => 'customind-accordion',
			'title'        => esc_html__( 'Site Title', 'colormag' ),
			'section'      => 'title_tagline',
			'priority'     => 11,
			'sub_controls' => apply_filters(
				'colormag_site_title_sub_controls',
				array(
					'colormag_enable_site_identity'      => array(
						'title'    => esc_html__( 'Enable', 'colormag' ),
						'default'  => true,
						'type'     => 'customind-toggle',
						'section'  => 'title_tagline',
						'priority' => 10,
					),
					'colormag_site_identity_color_group' => array(
						'type'         => 'customind-color-group',
						'title'        => esc_html__( 'Color', 'colormag' ),
						'section'      => 'title_tagline',
						'sub_controls' => apply_filters(
							'colormag_site_identity_color_sub_controls',
							array(
								'colormag_site_title_color'       => array(
									'default'   => '',
									'type'      => 'customind-color',
									'title'     => esc_html__( 'Normal', 'colormag' ),
									'transport' => 'postMessage',
									'section'   => 'title_tagline',
								),
								'colormag_site_title_hover_color'       => array(
									'default'   => '',
									'type'      => 'customind-color',
									'title'     => esc_html__( 'Hover', 'colormag' ),
									'transport' => 'postMessage',
									'section'   => 'title_tagline',
								),
							),
						),
						'condition'    => array(
							'colormag_enable_site_identity' => true,
						),
					),
					'colormag_site_title_typography'     => array(
						'default'   => array(
							'font-family' => 'default',
							'font-size'   => array(
								'desktop' => array(
									'size' => '40',
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
						),
						'type'      => 'customind-typography',
						'title'     => esc_html__( 'Typography', 'colormag' ),
						'section'   => 'title_tagline',
						'transport' => 'postMessage',
						'priority'  => 14,
						'condition' => array(
							'colormag_enable_site_identity' => true,
						),
					),
				),
			),
			'collapsible'  => apply_filters( 'colormag_site_identity_accordion_collapsible', false ),
		),
		'colormag_site_tagline_heading'          => array(
			'type'         => 'customind-accordion',
			'title'        => esc_html__( 'Site Tagline', 'colormag' ),
			'section'      => 'title_tagline',
			'priority'     => 11,
			'sub_controls' => apply_filters(
				'colormag_tagline_sub_controls',
				array(
					'colormag_enable_site_tagline'     => array(
						'default'  => true,
						'type'     => 'customind-toggle',
						'title'    => 'Enable',
						'section'  => 'title_tagline',
						'priority' => 16,
					),
					'colormag_site_tagline_color'      => array(
						'title'     => esc_html__( 'Color', 'colormag' ),
						'default'   => '',
						'type'      => 'customind-color',
						'section'   => 'title_tagline',
						'transport' => 'postMessage',
						'priority'  => 16,
						'condition' => array(
							'colormag_enable_site_tagline' => true,
						),
					),
					'colormag_site_tagline_typography' => array(
						'default'   => array(
							'font-family' => 'default',
							'font-size'   => array(
								'desktop' => array(
									'size' => '16',
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
						'section'   => 'title_tagline',
						'transport' => 'postMessage',
						'priority'  => 18,
						'condition' => array(
							'colormag_enable_site_tagline' => true,
						),
					),
				),
			),
			'collapsible'  => apply_filters( 'colormag_site_tagline_accordion_collapsible', false ),
		),
		'colormag_site_identity_upgrade'         => array(
			'type'        => 'customind-upsell',
			'description' => esc_html__( 'Unlock more features available in Pro version.', 'colormag' ),
			'title'       => esc_html__( 'Learn more', 'colormag' ),
			'url'         => esc_url( 'https://themegrill.com/pricing/?utm_medium=customizer-upgrade&utm_source=colormag-theme&utm_campaign=customizer-upgrade-button&utm_content=learn-more' ),
			'section'     => 'title_tagline',
			'priority'    => 100,
		),
	)
);

colormag_customind()->add_controls( $options );
