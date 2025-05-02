<?php

// Customize transport postMessage variable to set `postMessage` or `refresh` as required.
$customizer_selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';

$options = apply_filters(
	'colormag_top_bar_options',
	array(
		'colormag_top_bar_title'                => array(
			'type'         => 'customind-accordion',
			'title'        => esc_html__( 'Top Bar', 'colormag' ),
			'section'      => 'colormag_top_bar_section',
			'priority'     => 5,
			'sub_controls' => apply_filters(
				'colormag_top_bar_sub_controls',
				array(
					'colormag_top_bar_general_heading'  => array(
						'type'     => 'customind-title',
						'title'    => esc_html__( 'General', 'colormag' ),
						'section'  => 'colormag_top_bar_section',
						'priority' => 5,
					),
					'colormag_enable_top_bar'           => array(
						'title'    => esc_html__( 'Enable', 'colormag' ),
						'default'  => 0,
						'type'     => 'customind-toggle',
						'section'  => 'colormag_top_bar_section',
						'priority' => 5,
					),
					'colormag_top_bar_style_heading_divider' => array(
						'type'      => 'customind-divider',
						'variant'   => 'dashed',
						'section'   => 'colormag_top_bar_section',
						'priority'  => 30,
						'condition' => array(
							'colormag_enable_top_bar' => true,
						),
					),
					'colormag_top_bar_style_heading'    => array(
						'type'      => 'customind-title',
						'title'     => esc_html__( 'Style', 'colormag' ),
						'section'   => 'colormag_top_bar_section',
						'priority'  => 30,
						'condition' => array(
							'colormag_enable_top_bar' => true,
						),
					),
					'colormag_top_bar_background_color' => array(
						'title'     => esc_html__( 'Background', 'colormag' ),
						'default'   => '',
						'type'      => 'customind-color',
						'transport' => 'postMessage',
						'section'   => 'colormag_top_bar_section',
						'priority'  => 30,
						'condition' => array(
							'colormag_enable_top_bar' => true,
						),
					),
				)
			),
			'collapsible'  => apply_filters( 'colormag_top_bar_accordion_collapsible', false ),
		),
		'colormag_display_date_heading'         => array(
			'type'         => 'customind-accordion',
			'title'        => esc_html__( 'Date', 'colormag' ),
			'section'      => 'colormag_top_bar_section',
			'sub_controls' => apply_filters(
				'colormag_display_date_sub_controls',
				array(
					'colormag_date_display'      => array(
						'title'     => esc_html__( 'Enable', 'colormag' ),
						'default'   => false,
						'type'      => 'customind-toggle',
						'section'   => 'colormag_top_bar_section',
						'transport' => $customizer_selective_refresh,
						'partial'   => array(
							'selector'        => '.date-in-header',
							'render_callback' => array(
								'ColorMag_Customizer_Partials',
								'render_current_date',
							),
						),
					),
					'colormag_date_display_type' => array(
						'default'   => 'theme_default',
						'type'      => 'customind-select',
						'title'     => esc_html__( 'Date Format', 'colormag' ),
						'section'   => 'colormag_top_bar_section',
						'choices'   => array(
							'theme_default'          => esc_html__( 'Theme Default Setting', 'colormag' ),
							'wordpress_date_setting' => esc_html__( 'From WordPress Date Setting', 'colormag' ),
						),
						'condition' => array(
							'colormag_date_display' => true,
						),
						'partial'   => array(
							'selector'        => '.date-in-header',
							'render_callback' => array(
								'ColorMag_Customizer_Partials',
								'render_date_display_type',
							),
						),
					),
				)
			),
			'collapsible'  => apply_filters( 'colormag_display_date_accordion_collapsible', false ),
			'condition'    => array(
				'colormag_enable_top_bar' => true,
			),
		),
		'colormag_top_bar_news_ticker_title'    => array(
			'type'         => 'customind-accordion',
			'title'        => esc_html__( 'News Ticker', 'colormag' ),
			'section'      => 'colormag_top_bar_section',
			'sub_controls' => apply_filters(
				'colormag_top_bar_news_ticker_sub_controls',
				array(
					'colormag_news_ticker_navigate' => array(
						'title'    => esc_html__( 'News Ticker', 'colormag' ),
						'type'     => 'customind-navigation',
						'section'  => 'colormag_top_bar_section',
						'to'       => 'colormag_news_ticker_section',
						'nav_type' => 'section',
					),
				)
			),
			'collapsible'  => apply_filters( 'colormag_top_bar_news_ticker_accordion_collapsible', false ),
			'condition'    => array(
				'colormag_enable_top_bar' => true,
			),
		),
		'colormag_top_bar_social_icons_heading' => array(
			'type'         => 'customind-accordion',
			'title'        => esc_html__( 'Social Icons', 'colormag' ),
			'section'      => 'colormag_top_bar_section',
			'sub_controls' => apply_filters(
				'colormag_top_bar_social_icons_sub_controls',
				array(
					'colormag_top_bar_social_icons_navigate' => array(
						'title'    => esc_html__( 'Social Icons', 'colormag' ),
						'type'     => 'customind-navigation',
						'section'  => 'colormag_top_bar_section',
						'to'       => 'colormag_social_icons_section',
						'nav_type' => 'section',
					),
				)
			),
			'collapsible'  => apply_filters( 'colormag_top_bar_social_icons_accordion_collapsible', false ),
			'condition'    => array(
				'colormag_enable_top_bar' => true,
			),
		),
		'colormag_top_bar_upgrade'              => array(
			'type'        => 'customind-upsell',
			'description' => esc_html__( 'Unlock more features available in Pro version.', 'colormag' ),
			'title'       => esc_html__( 'Learn more', 'colormag' ),
			'url'         => esc_url( 'https://themegrill.com/pricing/?utm_medium=customizer-upgrade&utm_source=colormag-theme&utm_campaign=customizer-upgrade-button&utm_content=learn-more' ),
			'section'     => 'colormag_top_bar_section',
			'priority'    => 100,
		),
	)
);

colormag_customind()->add_controls( $options );
