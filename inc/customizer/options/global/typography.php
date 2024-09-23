<?php

$options = apply_filters(
	'colormag_typography_options',
	array(
		'colormag_body_typography_heading'     => array(
			'type'         => 'customind-accordion',
			'title'        => esc_html__( 'Body', 'colormag' ),
			'section'      => 'colormag_global_typography_section',
			'sub_controls' => apply_filters(
				'colormag_body_typography_sub_controls',
				array(
					'colormag_base_typography' => array(
						'default'   => array(
							'font-family'    => 'default',
							'font-weight'    => 'regular',
							'subsets'        => array( 'latin' ),
							'font-size'      => array(
								'desktop' => array(
									'size' => '15',
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
							'line-height'    => array(
								'desktop' => array(
									'size' => '1.6',
									'unit' => '-',
								),
								'tablet'  => array(
									'size' => '',
									'unit' => '-',
								),
								'mobile'  => array(
									'size' => '',
									'unit' => '-',
								),
							),
							'font-style'     => 'normal',
							'text-transform' => 'none',
						),
						'type'      => 'customind-typography',
						'transport' => 'postMessage',
						'title'     => esc_html__( 'Body', 'colormag' ),
						'section'   => 'colormag_global_typography_section',
					),
				)
			),
			'collapsible'  => apply_filters( 'colormag_body_typography_accordion_collapsible', false ),
		),
		'colormag_headings_typography_heading' => array(
			'type'         => 'customind-accordion',
			'title'        => esc_html__( 'Headings', 'colormag' ),
			'section'      => 'colormag_global_typography_section',
			'sub_controls' => apply_filters(
				'zakar_headings_typography_sub_controls',
				array(
					'colormag_headings_typography' => array(
						'default'            => array(
							'font-family'    => 'default',
							'font-weight'    => 'regular',
							'subsets'        => array( 'latin' ),
							'line-height'    => array(
								'desktop' => array(
									'size' => '1.2',
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
							'letter-spacing' => array(
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
							'font-style'     => 'inherit',
							'text-transform' => 'none',
						),
						'type'               => 'customind-typography',
						'title'              => esc_html__( 'Heading', 'colormag' ),
						'transport'          => 'postMessage',
						'section'            => 'colormag_global_typography_section',
						'allowed_properties' => array(
							'font-family',
							'font-weight',
							'line-height',
							'font-style',
							'text-transform',
						),
					),
					'colormag_h1_typography'       => array(
						'default'   => array(
							'font-family'    => 'default',
							'font-weight'    => 'regular',
							'subsets'        => array( 'latin' ),
							'font-size'      => array(
								'desktop' => array(
									'size' => '36',
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
							'line-height'    => array(
								'desktop' => array(
									'size' => '1.2',
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
						'transport' => 'postMessage',
						'title'     => esc_html__( 'H1', 'colormag' ),
						'section'   => 'colormag_global_typography_section',
					),
					'colormag_h2_typography'       => array(
						'default'   => array(
							'font-family'    => 'default',
							'font-weight'    => 'regular',
							'subsets'        => array( 'latin' ),
							'font-size'      => array(
								'desktop' => array(
									'size' => '32',
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
							'line-height'    => array(
								'desktop' => array(
									'size' => '1.2',
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
						'transport' => 'postMessage',
						'title'     => esc_html__( 'H2', 'colormag' ),
						'section'   => 'colormag_global_typography_section',
					),
					'colormag_h3_typography'       => array(
						'default'   => array(
							'font-family'    => 'default',
							'font-weight'    => 'regular',
							'subsets'        => array( 'latin' ),
							'font-size'      => array(
								'desktop' => array(
									'size' => '24',
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
							'line-height'    => array(
								'desktop' => array(
									'size' => '1.2',
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
						'title'     => esc_html__( 'H3', 'colormag' ),
						'transport' => 'postMessage',
						'section'   => 'colormag_global_typography_section',
					),
					'colormag_h4_typography'       => array(
						'default'   => array(
							'font-family' => 'default',
							'font-weight' => 'regular',
							'subsets'     => array( 'latin' ),
							'font-size'   => array(
								'desktop' => array(
									'size' => '24',
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
							'line-height' => array(
								'desktop' => array(
									'size' => '1.2',
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
						),
						'type'      => 'customind-typography',
						'title'     => esc_html__( 'H4', 'colormag' ),
						'transport' => 'postMessage',
						'section'   => 'colormag_global_typography_section',
					),
					'colormag_h5_typography'       => array(
						'default'   => array(
							'font-family' => 'default',
							'font-weight' => 'regular',
							'subsets'     => array( 'latin' ),
							'font-size'   => array(
								'desktop' => array(
									'size' => '22',
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
							'line-height' => array(
								'desktop' => array(
									'size' => '1.2',
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
						),
						'type'      => 'customind-typography',
						'title'     => esc_html__( 'H5', 'colormag' ),
						'transport' => 'postMessage',
						'section'   => 'colormag_global_typography_section',
					),
					'colormag_h6_typography'       => array(
						'default'   => array(
							'font-family' => 'default',
							'font-weight' => 'regular',
							'subsets'     => array( 'latin' ),
							'font-size'   => array(
								'desktop' => array(
									'size' => '18',
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
							'line-height' => array(
								'desktop' => array(
									'size' => '1.2',
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
						),
						'type'      => 'customind-typography',
						'title'     => esc_html__( 'H6', 'colormag' ),
						'transport' => 'postMessage',
						'section'   => 'colormag_global_typography_section',
					),
				)
			),
			'collapsible'  => apply_filters( 'zakar_headings_typography_accordion_collapsible', false ),
		),
	),
);

colormag_customind()->add_controls( $options );
