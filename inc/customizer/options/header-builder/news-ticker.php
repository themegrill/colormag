<?php

defined( 'ABSPATH' ) || exit;

$options = array(
	'colormag_news_ticker_title' => array(
		'type'         => 'customind-accordion',
		'title'        => esc_html__( 'News Ticker', 'colormag' ),
		'section'      => 'colormag_header_builder_news_ticker',
		'sub_controls' => apply_filters(
			'colormag_news_ticker_sub_controls',
			array(
				'colormag_news_ticker_label'              => array(
					'title'     => esc_html__( 'Label', 'colormag' ),
					'default'   => 'Latest:',
					'type'      => 'customind-text',
					'section'   => 'colormag_header_builder_news_ticker',
					'transport' => 'postMessage',
				),
				'colormag_news_ticker_width'              => array(
					'default'     => array(
						'size'  => 240,
						'units' => 'px',
					),
					'type'        => 'customind-slider',
					'title'       => esc_html__( 'Width', 'colormag' ),
					'section'     => 'colormag_header_builder_button_1',
					'units'       => array( 'px' ),
					'defaultUnit' => 'px',
				),
				'colormag_news_ticker_color'              => array(
					'title'     => esc_html__( 'Color', 'colormag' ),
					'default'   => '',
					'type'      => 'customind-color',
					'section'   => 'colormag_header_builder_news_ticker',
					'transport' => 'postMessage',
				),
				'colormag_news_ticker_link_color'         => array(
					'title'     => esc_html__( 'Link Color', 'colormag' ),
					'default'   => 'var(--cm-color-1)',
					'type'      => 'customind-color',
					'section'   => 'colormag_header_builder_news_ticker',
					'transport' => 'postMessage',

				),
				'colormag_news_ticker_content_typography' => array(
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
					'title'     => esc_html__( 'Link Typography', 'colormag' ),
					'section'   => 'colormag_header_builder_news_ticker',
				),
				'colormag_news_ticker_typography'         => array(
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
					'title'     => esc_html__( 'Label Typography', 'colormag' ),
					'section'   => 'colormag_header_builder_news_ticker',
				),
			)
		),
		'collapsible'  => apply_filters( 'colormag_news_ticker_accordion_collapsible', false ),
	),
);

colormag_customind()->add_controls( $options );
