<?php

function customind_get_header_components() {

	return array(
		'desktop' => array_filter(
			array(
				array(
					'name'    => __( 'Site Title & Logo', 'colormag' ),
					'section' => 'colormag_header_builder_logo',
					'id'      => 'logo',
				),
				array(
					'name'    => __( 'Primary Menu', 'colormag' ),
					'section' => 'colormag_header_builder_primary_menu',
					'id'      => 'primary-menu',
				),
				array(
					'name'    => __( 'Secondary Menu', 'colormag' ),
					'section' => 'colormag_header_builder_secondary_menu',
					'id'      => 'secondary-menu',
				),
				array(
					'name'    => __( 'Button 1', 'colormag' ),
					'section' => 'colormag_header_builder_button_1',
					'id'      => 'button',
				),
				array(
					'name'    => __( 'Search', 'colormag' ),
					'section' => 'colormag_header_builder_search',
					'id'      => 'search',
				),
				array(
					'name'    => __( 'HTML 1', 'colormag' ),
					'section' => 'colormag_header_builder_html_1',
					'id'      => 'html-1',
				),
				array(
					'name'     => __( 'Widget 1', 'colormag' ),
					'section'  => 'colormag_header_builder_widget_1',
					'id'       => 'widget-1',
					'section2' => 'sidebar-widgets-colormag_header_sidebar',
				),
				array(
					'name'     => __( 'Widget 2', 'colormag' ),
					'section'  => 'colormag_header_builder_widget_2',
					'id'       => 'widget-2',
					'section2' => 'sidebar-widgets-header-sidebar-2',
				),
				array(
					'name'    => __( 'Social', 'colormag' ),
					'section' => 'colormag_header_builder_socials',
					'id'      => 'socials',
				),
				array(
					'name'    => __( 'Date', 'colormag' ),
					'section' => 'colormag_header_builder_date',
					'id'      => 'date',
				),
				array(
					'name'    => __( 'News Ticker', 'colormag' ),
					'section' => 'colormag_header_builder_news_ticker',
					'id'      => 'news-ticker',
				),
				array(
					'name'    => __( 'Random Post Viewer', 'colormag' ),
					'section' => 'colormag_header_builder_random',
					'id'      => 'random',
				),
				array(
					'name'    => __( 'Home Icon', 'colormag' ),
					'section' => 'colormag_header_builder_home_icon',
					'id'      => 'home-icon',
				),
			)
		),
		'mobile'  => array_filter(
			array(
				array(
					'name'    => __( 'Site Title & Logo', 'colormag' ),
					'section' => 'colormag_header_builder_logo',
					'id'      => 'logo',
				),
				array(
					'name'    => __( 'Mobile Menu', 'colormag' ),
					'section' => 'colormag_header_builder_mobile_menu',
					'id'      => 'mobile-menu',
				),
				array(
					'name'    => __( 'Button', 'colormag' ),
					'section' => 'colormag_header_builder_button_1',
					'id'      => 'button',
				),
				array(
					'name'    => __( 'Search', 'colormag' ),
					'section' => 'colormag_header_builder_search',
					'id'      => 'search',
				),
				array(
					'name'    => __( 'HTML 1', 'colormag' ),
					'section' => 'colormag_header_builder_html_1',
					'id'      => 'html-1',
				),
				array(
					'name'     => __( 'Widget 1', 'colormag' ),
					'section'  => 'colormag_header_builder_widget_1',
					'id'       => 'widget-1',
					'section2' => 'sidebar-widgets-colormag_header_sidebar',
				),
				array(
					'name'     => __( 'Widget 2', 'colormag' ),
					'section'  => 'colormag_header_builder_widget_2',
					'id'       => 'widget-2',
					'section2' => 'sidebar-widgets-header-sidebar-2',
				),
				array(
					'name'    => __( 'Toggle Button', 'colormag' ),
					'section' => 'colormag_header_builder_toggle_button',
					'id'      => 'toggle-button',
				),
				array(
					'name'    => __( 'Date', 'colormag' ),
					'section' => 'colormag_header_builder_date',
					'id'      => 'date',
				),
				array(
					'name'    => __( 'News Ticker', 'colormag' ),
					'section' => 'colormag_header_builder_news_ticker',
					'id'      => 'news-ticker',
				),
				array(
					'name'    => __( 'Random', 'colormag' ),
					'section' => 'colormag_header_builder_random',
					'id'      => 'random',
				),
				array(
					'name'    => __( 'Social', 'colormag' ),
					'section' => 'colormag_header_builder_socials',
					'id'      => 'socials',
				),
				array(
					'name'    => __( 'Home Icon', 'colormag' ),
					'section' => 'colormag_header_builder_home_icon',
					'id'      => 'home-icon',
				),
			)
		),
	);
}

$options = array(
	'colormag_header_builder_components' => array(
		'type'    => 'customind-builder-components',
		'choices' => customind_get_header_components(),
		'context' => 'header',
		'group'   => 'colormag_header_builder',
		'section' => 'colormag_header_builder_section',

	),
	'colormag_header_builder'            => array(
		'section'     => 'colormag_header_builder_section',
		'type'        => 'customind-header-builder',
		'transport'   => 'postMessage',
		'components'  => customind_get_header_components(),
		'default'     => array(
			'desktop' => array(
				'top'    => array(
					'left'   => array(),
					'center' => array(),
					'right'  => array(),
				),
				'main'   => array(
					'left'   => array(
						'logo',
					),
					'center' => array(),
					'right'  => array(),
				),
				'bottom' => array(
					'left'   => array( 'primary-menu' ),
					'center' => array(),
					'right'  => array(),
				),
			),
			'mobile'  => array(
				'top'    => array(
					'left'   => array(),
					'center' => array(),
					'right'  => array(),
				),
				'main'   => array(
					'left'   => array(),
					'center' => array(
						'logo',
					),
					'right'  => array(),
				),
				'bottom' => array(
					'left'   => array(
						'toggle-button',
					),
					'center' => array(),
					'right'  => array(),
				),
			),
			'offset'  => array(
				'mobile-menu',
			),
		),
		'areas'       => array(
			array(
				'name'    => __( 'Builder area top', 'colormag' ),
				'id'      => 'top',
				'section' => 'colormag_header_builder_top_area',
				'areas'   => array(
					array(
						'name'    => __( 'Builder area top left', 'colormag' ),
						'id'      => 'left',
						'section' => '',
					),
					array(
						'name'    => __( 'Builder area top middle', 'colormag' ),
						'id'      => 'center',
						'section' => '',
					),
					array(
						'name'    => __( 'Builder area top right', 'colormag' ),
						'id'      => 'right',
						'section' => '',
					),
				),
			),
			array(
				'name'    => __( 'Builder Main area', 'colormag' ),
				'id'      => 'main',
				'section' => 'colormag_header_builder_main_area',
				'areas'   => array(
					array(
						'name'    => __( 'Builder area middle left', 'colormag' ),
						'id'      => 'left',
						'section' => '',
					),
					array(
						'name'    => __( 'Main center', 'colormag' ),
						'id'      => 'center',
						'section' => '',
					),
					array(
						'name'    => __( 'Main right', 'colormag' ),
						'id'      => 'right',
						'section' => '',
					),
				),
			),
			array(
				'name'    => __( 'Bottom', 'colormag' ),
				'id'      => 'bottom',
				'section' => 'colormag_header_builder_bottom_area',
				'areas'   => array(
					array(
						'name'    => __( 'Bottom left', 'colormag' ),
						'id'      => 'left',
						'section' => '',
					),
					array(
						'name'    => __( 'Bottom center', 'colormag' ),
						'id'      => 'center',
						'section' => '',
					),
					array(
						'name'    => __( 'Bottom right', 'colormag' ),
						'id'      => 'right',
						'section' => '',
					),
				),
			),
		),
		'offset_area' => array(
			'name'    => __( 'Offset Area', 'colormag' ),
			'id'      => 'offset',
			'section' => 'colormag_header_builder_offset_area',
		),
		'partial'     => array(
			'selector'            => '.cm-header-builder',
			'container_inclusive' => true,
			'render_callback'     => function () {
				colormag_header_builder_markup();
			},
		),
	),
);

colormag_customind()->add_controls( $options );
