<?php
$menus        = wp_get_nav_menus();
$menu_choices = array();

foreach ( $menus as $menu ) {
	$menu_choices[ $menu->term_id ] = $menu->name;
}
$options = array(
	'colormag_header_primary_menu_heading' => array(
		'type'         => 'customind-accordion',
		'title'        => esc_html__( 'Primary Menu', 'colormag' ),
		'section'      => 'colormag_header_builder_primary_menu',
		'priority'     => 9,
		'sub_controls' => apply_filters(
			'colormag_header_primary_menu_sub_controls',
			array(
				'colormag_header_primary_menu_navigation' => array(
					'title'    => esc_html__( 'Select Menu Navigation', 'colormag' ),
					'type'     => 'customind-navigation',
					'section'  => 'colormag_header_builder_primary_menu',
					'to'       => 'menu_locations',
					'nav_type' => 'section',
				),
				'colormag_primary_menu_top_border_width'  => array(
					'default'     => array(
						'size'  => '',
						'units' => 'px',
					),
					'type'        => 'customind-slider',
					'title'       => esc_html__( 'Border Bottom Width', 'colormag' ),
					'section'     => 'colormag_header_builder_primary_menu',
					'transport'   => 'postMessage',
					'units'       => array( 'px' ),
					'defaultUnit' => 'px',
					'input_attrs' => array(
						'min'  => 0,
						'step' => 1,
						'max'  => 20,
					),
				),
				'colormag_primary_menu_top_border_color'  => array(
					'title'     => esc_html__( 'Border Bottom Color', 'colormag' ),
					'default'   => '#207daf',
					'type'      => 'customind-color',
					'transport' => 'postMessage',
					'section'   => 'colormag_header_builder_primary_menu',
				),
			)
		),
		'collapsible'  => apply_filters( 'colormag_primary_menu_accordion_collapsible', false ),
	),
	'colormag_header_main_menu_heading'    => array(
		'type'         => 'customind-accordion',
		'title'        => esc_html__( 'Main Menu', 'colormag' ),
		'section'      => 'colormag_header_builder_primary_menu',
		'sub_controls' => apply_filters(
			'colormag_main_menu_sub_controls',
			array(
				//              'colormag_main_menu_layout_1_style'     => array(
				//                  'default'         => 'style-1',
				//                  'type'            => 'customind-radio-image',
				//                  'title'           => esc_html__( 'Advanced Style', 'colormag' ),
				//                  'section'         => 'colormag_header_builder_primary_menu',
				//                  'transport'       => 'postMessage',
				//                  'choices'         => apply_filters(
				//                      'colormag_main_menu_layout_1_style_choices',
				//                      array(
				//                          'style-1' => array(
				//                              'label' => 'None',
				//                              'url'   => ZAKRA_PARENT_INC_ICON_URI . '/menu-active-none.svg',
				//                          ),
				//                          'style-2' => array(
				//                              'label' => 'Underline Border',
				//                              'url'   => ZAKRA_PARENT_INC_ICON_URI . '/menu-active-underline.svg',
				//                          ),
				//                          'style-3' => array(
				//                              'label' => 'Left Border',
				//                              'url'   => ZAKRA_PARENT_INC_ICON_URI . '/menu-active-left.svg',
				//                          ),
				//                          'style-4' => array(
				//                              'label' => 'Right Border',
				//                              'url'   => ZAKRA_PARENT_INC_ICON_URI . '/menu-active-right.svg',
				//                          ),
				//                      )
				//                  ),
				//                  'columns'         => 2,
				//                  'active_callback' => function () {
				//                      if ( 'default' === get_theme_mod( 'colormag_primary_menu_item_style', 'default' ) && get_theme_mod( 'colormag_enable_primary_menu', true ) && 'layout-2' !== get_theme_mod( 'colormag_main_menu_layout', 'layout-1' ) ) {
				//                          return true;
				//                      }
				//
				//                      return false;
				//                  },
				//              ),
					'colormag_header_main_menu_color_group' => array(
						'type'            => 'customind-color-group',
						'title'           => 'Color',
						'section'         => 'colormag_header_builder_primary_menu',
						'sub_controls'    => array(
							'colormag_header_main_menu_color' => array(
								'default'   => '',
								'type'      => 'customind-color',
								'title'     => esc_html__( 'Normal', 'colormag' ),
								'transport' => 'postMessage',
								'section'   => 'colormag_header_builder_primary_menu',
							),
							'colormag_header_main_menu_hover_color' => array(
								'default'   => '',
								'type'      => 'customind-color',
								'title'     => esc_html__( 'Hover', 'colormag' ),
								'transport' => 'postMessage',
								'section'   => 'colormag_header_builder_primary_menu',
							),
							'colormag_header_main_menu_active_color' => array(
								'default'   => '',
								'type'      => 'customind-color',
								'title'     => esc_html__( 'Active', 'colormag' ),
								'transport' => 'postMessage',
								'section'   => 'colormag_header_builder_primary_menu',
							),
						),
						'active_callback' => function () {
							if ( 'default' === get_theme_mod( 'colormag_primary_menu_item_style', 'default' ) && get_theme_mod( 'colormag_enable_primary_menu', true ) ) {
								return true;
							}

							return false;
						},
					),
				'colormag_header_main_menu_typography' => array(
					'default'   => array(
						'font-family'    => 'Default',
						'font-weight'    => 'regular',
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
					'title'     => esc_html__( 'Typography', 'colormag' ),
					'transport' => 'postMessage',
					'section'   => 'colormag_header_builder_primary_menu',
				),
			)
		),
		'collapsible'  => apply_filters( 'colormag_header_main_menu_accordion_collapsible', false ),
	),
	'colormag_header_sub_menu_heading'     => array(
		'type'         => 'customind-accordion',
		'title'        => esc_html__( 'Sub Menu', 'colormag' ),
		'section'      => 'colormag_header_builder_primary_menu',
		'sub_controls' => apply_filters(
			'colormag_header_sub_menu_sub_controls',
			array(
				'colormag_header_sub_menu_typography' => array(
					'default'   => array(
						'font-family'    => 'Default',
						'font-weight'    => '400',
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
					'title'     => esc_html__( 'Typography', 'colormag' ),
					'transport' => 'postMessage',
					'section'   => 'colormag_header_builder_primary_menu',
				),
			)
		),
		'collapsible'  => apply_filters( 'colormag_sub_menu_accordion_collapsible', false ),
	),

);

colormag_customind()->add_controls( $options );
