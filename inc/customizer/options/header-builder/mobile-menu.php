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
						)
					),
				),
				'colormag_mobile_menu_background'        => array(
					'default'   => array(
						'background-color'      => '',
						'background-image'      => '',
						'background-position'   => 'center center',
						'background-size'       => 'auto',
						'background-attachment' => 'scroll',
						'background-repeat'     => 'repeat',
					),
					'type'      => 'customind-background',
					'title'     => esc_html__( 'Background', 'colormag' ),
					'transport' => 'postMessage',
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
