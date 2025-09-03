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
				'colormag_header_main_menu_color_group'   => array(
					'type'         => 'customind-color-group',
					'title'        => esc_html__( 'Color', 'colormag' ),
					'section'      => 'colormag_header_builder_primary_menu',
					'sub_controls' => array(
						'colormag_header_primary_menu_text_color' => array(
							'default'   => '',
							'type'      => 'customind-color',
							'title'     => esc_html__( 'Normal', 'colormag' ),
							'transport' => 'postMessage',
							'section'   => 'colormag_header_builder_primary_menu',
						),
						'colormag_header_primary_menu_selected_hovered_text_color' => array(
							'default'   => '',
							'type'      => 'customind-color',
							'title'     => esc_html__( 'Hover', 'colormag' ),
							'transport' => 'postMessage',
							'section'   => 'colormag_header_builder_primary_menu',
						),
						'colormag_header_primary_menu_active_text_color' => array(
							'default'   => '',
							'type'      => 'customind-color',
							'title'     => esc_html__( 'Active', 'colormag' ),
							'transport' => 'postMessage',
							'section'   => 'colormag_header_builder_primary_menu',
						),
					),
				),

				'colormag_header_main_menu_background_group' => array(
					'type'         => 'customind-color-group',
					'title'        => esc_html__( 'Background', 'colormag' ),
					'section'      => 'colormag_header_builder_primary_menu',
					'sub_controls' => array(
						'colormag_header_primary_menu_hover_background' => array(
							'default'   => 'var(--cm-color-1)',
							'type'      => 'customind-color',
							'title'     => esc_html__( 'Hover', 'colormag' ),
							'transport' => 'postMessage',
							'section'   => 'colormag_header_builder_primary_menu',
						),
						'colormag_header_primary_menu_active_background' => array(
							'default'   => '',
							'type'      => 'customind-color',
							'title'     => esc_html__( 'Active', 'colormag' ),
							'transport' => 'postMessage',
							'section'   => 'colormag_header_builder_primary_menu',
						),
					),
				),

				'colormag_header_primary_menu_typography' => array(
					'default'   => array(
						'font-family'    => 'default',
						'font-weight'    => '600',
						'font-size'      => array(
							'desktop' => array(
								'size' => '14',
								'unit' => 'px',
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
					'title'     => esc_html__( 'Typography', 'colormag' ),
					'transport' => 'postMessage',
					'section'   => 'colormag_header_builder_primary_menu',
				),

			)
		),
		'collapsible'  => apply_filters( 'colormag_primary_menu_accordion_collapsible', false ),
	),
	'colormag_header_sub_menu_heading'     => array(
		'type'         => 'customind-accordion',
		'title'        => esc_html__( 'Sub Menu', 'colormag' ),
		'section'      => 'colormag_header_builder_primary_menu',
		'sub_controls' => apply_filters(
			'colormag_header_sub_menu_sub_controls',
			array(
				'colormag_header_primary_sub_menu_background' => array(
					'default'   => array(
						'background-color'      => '#232323',
						'background-image'      => '',
						'background-position'   => 'center center',
						'background-size'       => 'auto',
						'background-attachment' => 'scroll',
						'background-repeat'     => 'repeat',
					),
					'type'      => 'customind-background',
					'title'     => esc_html__( 'Background', 'colormag' ),
					'transport' => 'postMessage',
					'section'   => 'colormag_header_builder_primary_menu',
				),
				'colormag_header_primary_sub_menu_typography' => array(
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
