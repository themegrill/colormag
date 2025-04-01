<?php

$options = apply_filters(
	'colormag_news_ticker_options',
	array(
		'colormag_news_ticker_heading' => array(
			'type'         => 'customind-accordion',
			'title'        => esc_html__( 'News Ticker', 'colormag' ),
			'section'      => 'colormag_news_ticker_section',
			'priority'     => 5,
			'sub_controls' => apply_filters(
				'colormag_news_ticker_sub_controls',
				array(
					'colormag_news_ticker_general_subtitle' => array(
						'type'    => 'customind-title',
						'title'   => esc_html__( 'General', 'colormag' ),
						'section' => 'colormag_news_ticker_section',
					),
					'colormag_enable_news_ticker' => array(
						'title'   => esc_html__( 'Enable', 'colormag' ),
						'default' => 0,
						'type'    => 'customind-toggle',
						'section' => 'colormag_news_ticker_section',
					),
				)
			),
			'collapsible'  => apply_filters( 'colormag_news_ticker_accordion_collapsible', false ),
		),
		'colormag_news_ticker_upgrade' => array(
			'type'        => 'customind-upsell',
			'description' => esc_html__( 'Unlock more features available in Pro version.', 'colormag' ),
			'title'       => esc_html__( 'Learn more', 'colormag' ),
			'url'         => esc_url( 'https://themegrill.com/pricing/?utm_medium=customizer-upgrade&utm_source=colormag-theme&utm_campaign=customizer-upgrade-button&utm_content=learn-more' ),
			'section'     => 'colormag_news_ticker_section',
			'priority'    => 100,
		),
	)
);

colormag_customind()->add_controls( $options );
