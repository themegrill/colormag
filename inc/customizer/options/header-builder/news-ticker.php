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
				'colormag_news_ticker_color'      => array(
					'title'     => esc_html__( 'Color', 'colormag' ),
					'default'   => '',
					'type'      => 'customind-color',
					'section'   => 'colormag_header_builder_news_ticker',
					'transport' => 'postMessage',
				),
				'colormag_news_ticker_link_color' => array(
					'title'     => esc_html__( 'Link Color', 'colormag' ),
					'default'   => '',
					'type'      => 'customind-color',
					'section'   => 'colormag_header_builder_news_ticker',
					'transport' => 'postMessage',
				),
				'colormag_news_ticker_typography' => array(
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
					'section'   => 'colormag_header_builder_news_ticker',
				),
			)
		),
		'collapsible'  => apply_filters( 'colormag_news_ticker_accordion_collapsible', false ),
	),
);

colormag_customind()->add_controls( $options );
