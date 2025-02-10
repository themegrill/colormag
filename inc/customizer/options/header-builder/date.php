<?php

defined( 'ABSPATH' ) || exit;

$options = array(
	'colormag_date_title' => array(
		'type'         => 'customind-accordion',
		'title'        => esc_html__( 'Date', 'colormag' ),
		'section'      => 'colormag_header_builder_date',
		'sub_controls' => apply_filters(
			'colormag_date_sub_controls',
			array(
				'colormag_date_display_type' => array(
					'default' => 'theme_default',
					'type'    => 'customind-select',
					'title'   => esc_html__( 'Date Format', 'colormag' ),
					'section' => 'colormag_header_builder_date',
					'choices' => array(
						'theme_default'          => esc_html__( 'Theme Default Setting', 'colormag' ),
						'wordpress_date_setting' => esc_html__( 'From WordPress Date Setting', 'colormag' ),
					),
					'partial' => array(
						'selector'        => '.date-in-header',
						'render_callback' => array(
							'ColorMag_Customizer_Partials',
							'render_date_display_type',
						),
					),
				),
				'colormag_date_color'        => array(
					'title'     => esc_html__( 'Color', 'colormag' ),
					'default'   => '',
					'type'      => 'customind-color',
					'section'   => 'colormag_header_builder_date',
					'transport' => 'postMessage',
				),
				'colormag_date_typography'   => array(
					'default'   => array(
						'font-family'    => 'default',
						'font-weight'    => 'regular',
						'subsets'        => array( 'latin' ),
						'font-size'      => array(
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
						'line-height'    => array(
							'desktop' => array(
								'size' => '',
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
					'title'     => esc_html__( 'Typography', 'colormag' ),
					'section'   => 'colormag_header_builder_date',
				),
			)
		),
		'collapsible'  => apply_filters( 'colormag_date_accordion_collapsible', false ),
	),
);

colormag_customind()->add_controls( $options );
