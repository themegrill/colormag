<?php
$menus        = wp_get_nav_menus();
$menu_choices = array();

foreach ( $menus as $menu ) {
	$menu_choices[ $menu->term_id ] = $menu->name;
}
$options = array(
	'colormag_header_mobile_menu_heading' => array(
		'type'         => 'customind-accordion',
		'title'        => esc_html__( 'Mobile Menu', 'colormag' ),
		'section'      => 'colormag_header_builder_mobile_menu',
		'priority'     => 9,
		'sub_controls' => apply_filters(
			'colormag_header_mobile_menu_sub_controls',
			array(
				'colormag_header_mobile_menu_item_color_group' => array(
					'type'         => 'customind-color-group',
					'title'        => esc_html__( 'Color', 'colormag' ),
					'section'      => 'colormag_header_builder_mobile_menu',
					'sub_controls' => apply_filters(
						'colormag_header_mobile_menu_item_color_sub_controls',
						array(
							'colormag_header_mobile_menu_item_color' => array(
								'default'   => '',
								'type'      => 'customind-color',
								'title'     => esc_html__( 'Normal', 'colormag' ),
								'transport' => 'postMessage',
								'section'   => 'colormag_header_builder_mobile_menu',
							),
							'colormag_header_mobile_menu_item_hover_color' => array(
								'default'   => '',
								'type'      => 'customind-color',
								'title'     => esc_html__( 'Hover', 'colormag' ),
								'transport' => 'postMessage',
								'section'   => 'colormag_header_builder_mobile_menu',
							),
							'colormag_header_mobile_menu_item_active_color' => array(
								'default'   => '',
								'type'      => 'customind-color',
								'title'     => esc_html__( 'Active', 'colormag' ),
								'transport' => 'postMessage',
								'section'   => 'colormag_header_builder_mobile_menu',
							),
						)
					),
				),
				'colormag_header_mobile_menu_item_border_bottom' => array(
					'default'     => array(
						'size' => 1,
						'unit' => 'px',
					),
					'type'        => 'customind-slider',
					'title'       => esc_html__( 'Border Width', 'colormag' ),
					'section'     => 'colormag_header_builder_mobile_menu',
					'transport'   => 'postMessage',
					'priority'    => 20,
					'units'       => array( 'px' ),
					'defaultUnit' => 'px',
				),
				'colormag_header_mobile_menu_item_border_bottom_style' => array(
					'default'   => 'solid',
					'type'      => 'customind-select',
					'title'     => esc_html__( 'Border Style', 'colormag' ),
					'section'   => 'colormag_header_builder_mobile_menu',
					'transport' => 'postMessage',
					'priority'  => 20,
					'choices'   => array(
						'solid'  => esc_html__( 'Solid', 'colormag' ),
						'dotted' => esc_html__( 'Dotted', 'colormag' ),
						'dashed' => esc_html__( 'Dashed', 'colormag' ),
					),
				),
				'colormag_header_mobile_menu_item_border_bottom_color' => array(
					'default'   => '',
					'type'      => 'customind-color',
					'title'     => esc_html__( 'Border Color', 'colormag' ),
					'transport' => 'postMessage',
					'priority'  => 20,
					'section'   => 'colormag_header_builder_mobile_menu',
				),
				'colormag_header_mobile_menu_typography' => array(
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
								'size' => '1.6',
								'unit' => 'rem',
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
								'size' => '1.8',
								'unit' => '-',
							),
						),
						'font-style'     => 'normal',
						'text-transform' => 'none',
					),
					'type'      => 'customind-typography',
					'priority'  => 15,
					'title'     => esc_html__( 'Typography', 'colormag' ),
					'transport' => 'postMessage',
					'section'   => 'colormag_header_builder_mobile_menu',
				),
			)
		),
		'collapsible'  => apply_filters( 'colormag_header_mobile_menu_accordion_collapsible', false ),
	),

);

colormag_customind()->add_controls( $options );
