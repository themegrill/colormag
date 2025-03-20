<?php
$sidebar_layout_choices = apply_filters(
	'colormag_site_layout_choices',
	array(
		'right_sidebar'               => array(
			'label' => '',
			'url'   => COLORMAG_PARENT_URL . '/assets/img/sidebar/right-sidebar.svg',
		),
		'left_sidebar'                => array(
			'label' => '',
			'url'   => COLORMAG_PARENT_URL . '/assets/img/sidebar/left-sidebar.svg',
		),
		'no_sidebar_full_width'       => array(
			'label' => '',
			'url'   => COLORMAG_PARENT_URL . '/assets/img/sidebar/contained.svg',
		),
		'no_sidebar_content_centered' => array(
			'label' => '',
			'url'   => COLORMAG_PARENT_URL . '/assets/img/sidebar/centered.svg',
		),
	)
);

$options = array(
	'colormag_woocommerce_sidebar_register_setting_heading' => array(
		'type'         => 'customind-accordion',
		'title'        => esc_html__( 'WooCommerce Sidebar', 'colormag' ),
		'section'      => 'colormag_woocommerce_sidebar_section',
		'sub_controls' => apply_filters(
			'colormag_woocommerce_sidebar_register_setting_controls',
			array(
				'colormag_woocommerce_sidebar_register_setting'          => array(
					'title'   => esc_html__( 'Check to register different sidebar areas to be used for WooCommerce pages.', 'colormag' ),
					'default' => 0,
					'type'    => 'customind-checkbox',
					'section' => 'colormag_woocommerce_sidebar_section',
				),
			),
		),
		'collapsible'  => apply_filters( 'colormag_woocommerce_sidebar_register_setting_accordion_collapsible', false ),
	),
	'colormag_woocommerce_sidebar_layout_heading' => array(
		'type'         => 'customind-accordion',
		'title'        => esc_html__( 'Sidebar Layout', 'colormag' ),
		'section'      => 'colormag_woocommerce_sidebar_section',
		'sub_controls' => apply_filters(
			'colormag_woocommerce_sidebar_layout_controls',
			array(
				'colormag_woocmmerce_shop_page_layout'    => array(
					'default' => 'right_sidebar',
					'type'    => 'customind-radio-image',
					'title'   => esc_html__( 'WooCommerce Shop Page Layout', 'colormag' ),
					'section' => 'colormag_woocommerce_sidebar_section',
					'choices' => $sidebar_layout_choices,
					'columns' => 2,
				),
				'colormag_woocmmerce_archive_page_layout' => array(
					'default' => 'right_sidebar',
					'type'    => 'customind-radio-image',
					'title'   => esc_html__( 'WooCommerce Archive Page Layout', 'colormag' ),
					'section' => 'colormag_woocommerce_sidebar_section',
					'choices' => $sidebar_layout_choices,
					'columns' => 2,
				),
				'colormag_woocmmerce_single_product_page_layout' => array(
					'default' => 'right_sidebar',
					'type'    => 'customind-radio-image',
					'title'   => esc_html__( 'WooCommerce Single Product Page Layout', 'colormag' ),
					'section' => 'colormag_woocommerce_sidebar_section',
					$sidebar_layout_choices,
					'columns' => 2,
				),
			),
		),
		'condition'    => array(
			'colormag_woocommerce_sidebar_register_setting!' => 0,
		),
		'collapsible'  => apply_filters( 'colormag_woocommerce_sidebar_layout_accordion_collapsible', false ),
	),
);

colormag_customind()->add_controls( $options );
