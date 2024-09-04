<?php

$options = array(
	'colormag_footer_builder_widget_2_heading' => array(
		'type'         => 'customind-accordion',
		'title'        => esc_html__( 'Widget 2', 'colormag' ),
		'section'      => 'colormag_footer_builder_widget_2',
		'sub_controls' => apply_filters(
			'colormag_footer_builder_widget_2_sub_controls',
			array(
				'colormag_footer_widget_1_title_color'   => array(
					'default'   => '',
					'type'      => 'customind-color',
					'title'     => esc_html__( 'Title Color', 'colormag' ),
					'transport' => 'postMessage',
					'section'   => 'colormag_footer_builder_widget_2',
				),
				'colormag_footer_widget_1_title_typography' => array(
					'default'   => array(
						'font-family'    => 'default',
						'font-weight'    => '400',
						'font-size'      => array(
							'desktop' => array(
								'size' => '2',
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
								'size' => '1.3',
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
					'title'     => esc_html__( 'Title Typography', 'colormag' ),
					'section'   => 'colormag_footer_builder_widget_2',
				),
				'colormag_footer_widget_1_link_divider'  => array(
					'type'    => 'customind-divider',
					'variant' => 'dashed',
					'section' => 'colormag_blog',
				),
				'colormag_footer_widget_1_link_color'    => array(
					'default'   => '',
					'type'      => 'customind-color',
					'title'     => esc_html__( 'Link', 'colormag' ),
					'transport' => 'postMessage',
					'section'   => 'colormag_footer_builder_widget_2',
				),
				'colormag_footer_widget_1_content_color_divider' => array(
					'type'    => 'customind-divider',
					'variant' => 'dashed',
					'section' => 'colormag_blog',
				),
				'colormag_footer_widget_1_content_color' => array(
					'default'   => '',
					'type'      => 'customind-color',
					'title'     => esc_html__( 'Content Color', 'colormag' ),
					'transport' => 'postMessage',
					'section'   => 'colormag_footer_builder_widget_2',
				),
				'colormag_footer_widget_1_content_typography' => array(
					'default'   => array(
						'font-family'    => 'default',
						'font-weight'    => '400',
						'font-size'      => array(
							'desktop' => array(
								'size' => '1.4',
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
					'transport' => 'postMessage',
					'title'     => esc_html__( 'Content Typography', 'colormag' ),
					'section'   => 'colormag_footer_builder_widget_2',
				),
			)
		),
		'collapsible'  => apply_filters( 'colormag_footer_builder_widget_2_accordion_collapsible', false ),
	),
);

colormag_customind()->add_controls( $options );