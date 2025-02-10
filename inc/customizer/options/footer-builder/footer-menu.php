<?php
$menus        = wp_get_nav_menus();
$menu_choices = array();

foreach ( $menus as $menu ) {
	$menu_choices[ $menu->term_id ] = $menu->name;
}
$options = array(
	'colormag_footer_menu_heading' => array(
		'type'         => 'customind-accordion',
		'title'        => esc_html__( 'Footer Menu', 'colormag' ),
		'section'      => 'colormag_footer_builder_footer_menu',
		'sub_controls' => apply_filters(
			'colormag_footer_menu_sub_controls',
			array(
				'colormag_footer_menu'             => array(
					'default' => 'none',
					'type'    => 'customind-select',
					'title'   => esc_html__( 'Select a Menu', 'colormag' ),
					'section' => 'colormag_footer_builder_footer_menu',
					'choices' => $menu_choices,
				),
				'colormag_footer_menu_color_group' => array(
					'type'         => 'customind-color-group',
					'title'        => 'Color',
					'section'      => 'colormag_footer_builder_footer_menu',
					'sub_controls' => array(
						'colormag_footer_menu_color'       => array(
							'default'   => '',
							'type'      => 'customind-color',
							'title'     => esc_html__( 'Normal', 'colormag' ),
							'transport' => 'postMessage',
							'section'   => 'colormag_footer_builder_footer_menu',
						),
						'colormag_footer_menu_hover_color' => array(
							'default'   => '',
							'type'      => 'customind-color',
							'title'     => esc_html__( 'Hover', 'colormag' ),
							'transport' => 'postMessage',
							'section'   => 'colormag_footer_builder_footer_menu',
						),
					),
				),
				'colormag_footer_menu_typography'  => array(
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
					'section'   => 'colormag_footer_builder_footer_menu',
				),
			)
		),
		'collapsible'  => apply_filters( 'colormag_footer_menu_accordion_collapsible', false ),
	),
);

colormag_customind()->add_controls( $options );
