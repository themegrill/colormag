<?php

$options = array(
	'colormag_footer_builder_widget_6_heading' => array(
		'type'         => 'customind-accordion',
		'title'        => esc_html__( 'Widget 6', 'zakra' ),
		'section'      => 'colormag_footer_builder_widget_6',
		'sub_controls' => apply_filters(
			'colormag_footer_builder_widget_6_sub_controls',
			array(
				'colormag_footer_widget_1_title_color'   => array(
					'default'   => '',
					'type'      => 'customind-color',
					'title'     => esc_html__( 'Title Color', 'zakra' ),
					'transport' => 'postMessage',
					'section'   => 'colormag_footer_builder_widget_6',
				),
				'colormag_footer_widget_1_title_typography' => array(
					'default'   => array(
						'font-family'    => 'default',
						'font-weight'    => '600',
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
					'title'     => esc_html__( 'Title Typography', 'zakra' ),
					'section'   => 'colormag_footer_builder_widget_6',
				),
				'colormag_footer_widget_1_link_divider'  => array(
					'type'    => 'customind-divider',
					'variant' => 'dashed',
					'section' => 'colormag_blog',
				),
				'colormag_footer_widget_1_link_color'    => array(
					'default'   => '',
					'type'      => 'customind-color',
					'title'     => esc_html__( 'Link', 'zakra' ),
					'transport' => 'postMessage',
					'section'   => 'colormag_footer_builder_widget_6',
				),
				'colormag_footer_widget_1_content_color_divider' => array(
					'type'    => 'customind-divider',
					'variant' => 'dashed',
					'section' => 'colormag_blog',
				),
				'colormag_footer_widget_1_content_color' => array(
					'default'   => '',
					'type'      => 'customind-color',
					'title'     => esc_html__( 'Content Color', 'zakra' ),
					'transport' => 'postMessage',
					'section'   => 'colormag_footer_builder_widget_6',
				),
				'colormag_footer_widget_1_content_typography' => array(
					'default'   => array(
						'font-family'    => 'default',
						'font-weight'    => '600',
						'font-size'      => array(
							'desktop' => array(
								'size' => '1.6',
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
					'title'     => esc_html__( 'Content Typography', 'zakra' ),
					'section'   => 'colormag_footer_builder_widget_6',
				),
			)
		),
		'collapsible'  => apply_filters( 'colormag_footer_builder_widget_6_accordion_collapsible', false ),
	),
);

colormag_customind()->add_controls( $options );
