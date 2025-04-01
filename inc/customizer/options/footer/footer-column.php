<?php

$options = apply_filters(
	'colormag_footer_column_options',
	array(
		'colormag_footer_column_heading' => array(
			'type'         => 'customind-accordion',
			'title'        => esc_html__( 'Footer Column', 'colormag' ),
			'section'      => 'colormag_footer_column_section',
			'sub_controls' => apply_filters(
				'colormag_footer_column_sub_controls',
				array(
					'colormag_footer_general_subtitle' => array(
						'type'    => 'customind-title',
						'title'   => esc_html__( 'General', 'colormag' ),
						'section' => 'colormag_footer_column_section',
					),
					'colormag_main_footer_layout'      => array(
						'default'   => 'layout-1',
						'type'      => 'customind-select',
						'title'     => esc_html__( 'Layout', 'colormag' ),
						'section'   => 'colormag_footer_column_section',
						'transport' => 'postMessage',
						'choices'   => array(
							'layout-1' => esc_html__( 'Layout 1', 'colormag' ),
							'layout-2' => esc_html__( 'Layout 2', 'colormag' ),
						),
					),
					'colormag_footer_column_layout'    => array(
						'default' => 'style-4',
						'type'    => 'customind-radio-image',
						'title'   => esc_html__( 'Footer Column Layout', 'colormag' ),
						'section' => 'colormag_footer_column_section',
						'choices' => array(
							'style-1' => array(
								'label' => '',
								'url'   => COLORMAG_PARENT_URL . '/assets/img/footer-column/footer-column-one.svg',
							),
							'style-2' => array(
								'label' => '',
								'url'   => COLORMAG_PARENT_URL . '/assets/img/footer-column/footer-column-two.svg',
							),
							'style-3' => array(
								'label' => '',
								'url'   => COLORMAG_PARENT_URL . '/assets/img/footer-column/footer-column-three.svg',
							),
							'style-4' => array(
								'label' => '',
								'url'   => COLORMAG_PARENT_URL . '/assets/img/footer-column/footer-column-four.svg',
							),
						),
						'columns' => 2,
					),
					'colormag_footer_style_divider'    => array(
						'type'    => 'customind-divider',
						'variant' => 'dashed',
						'section' => 'colormag_footer_column_section',
					),
					'colormag_footer_style_subtitle'   => array(
						'type'    => 'customind-title',
						'title'   => esc_html__( 'Style', 'colormag' ),
						'section' => 'colormag_footer_column_section',
					),
					'colormag_footer_background'       => array(
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
						'section'   => 'colormag_footer_column_section',
					),
				)
			),
			'collapsible'  => apply_filters( 'colormag_footer_column_accordion_collapsible', false ),
		),
		'colormag_upper_footer_heading'  => array(
			'type'         => 'customind-accordion',
			'title'        => esc_html__( 'Upper Footer', 'colormag' ),
			'section'      => 'colormag_footer_column_section',
			'sub_controls' => apply_filters(
				'colormag_upper_footer_sub_controls',
				array(
					'colormag_upper_footer_background' => array(
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
						'section'   => 'colormag_footer_column_section',
					),
				)
			),
			'collapsible'  => apply_filters( 'colormag_upper_footer_accordion_collapsible', false ),
		),
		'colormag_widget_title'          => array(
			'type'         => 'customind-accordion',
			'title'        => esc_html__( 'Widget Title', 'colormag' ),
			'section'      => 'colormag_footer_column_section',
			'sub_controls' => apply_filters(
				'colormag_widget_title_sub_controls',
				array(
					'colormag_footer_widget_title_color_group'   => array(
						'type'         => 'customind-color-group',
						'title'        => esc_html__( 'Color.', 'colormag' ),
						'section'      => 'colormag_footer_column_section',
						'sub_controls' => array(
							'colormag_footer_widget_title_color'       => array(
								'default'   => '',
								'type'      => 'customind-color',
								'title'     => esc_html__( 'Normal', 'colormag' ),
								'transport' => 'postMessage',
								'section'   => 'colormag_footer_column_section',
							),
						),
					),
				)
			),
			'collapsible'  => apply_filters( 'colormag_widget_title_accordion_collapsible', false ),
		),
		'colormag_widget_content_title'  => array(
			'type'         => 'customind-accordion',
			'title'        => esc_html__( 'Widget Content', 'colormag' ),
			'section'      => 'colormag_footer_column_section',
			'sub_controls' => apply_filters(
				'colormag_widget_content_title_sub_controls',
				array(
					'colormag_footer_widget_content_color_group'   => array(
						'type'         => 'customind-color-group',
						'title'        => esc_html__( 'Color.', 'colormag' ),
						'section'      => 'colormag_footer_column_section',
						'sub_controls' => array(
							'colormag_footer_widget_content_color'       => array(
								'default'   => '',
								'type'      => 'customind-color',
								'title'     => esc_html__( 'Normal', 'colormag' ),
								'transport' => 'postMessage',
								'section'   => 'colormag_footer_column_section',
							),
						),
					),
				)
			),
			'collapsible'  => apply_filters( 'colormag_widget_content_title_accordion_collapsible', false ),
		),
		'colormag_widget_link_title'     => array(
			'type'         => 'customind-accordion',
			'title'        => esc_html__( 'Widget Link', 'colormag' ),
			'section'      => 'colormag_footer_column_section',
			'sub_controls' => apply_filters(
				'colormag_widget_link_title_sub_controls',
				array(
					'colormag_footer_widget_link_color_group'   => array(
						'type'         => 'customind-color-group',
						'title'        => esc_html__( 'Color.', 'colormag' ),
						'section'      => 'colormag_footer_column_section',
						'sub_controls' => array(
							'colormag_footer_widget_content_link_text_color'       => array(
								'default'   => '',
								'type'      => 'customind-color',
								'title'     => esc_html__( 'Normal', 'colormag' ),
								'transport' => 'postMessage',
								'section'   => 'colormag_footer_column_section',
							),
							'colormag_footer_widget_content_link_text_hover_color'       => array(
								'default'   => '',
								'type'      => 'customind-color',
								'title'     => esc_html__( 'Hover', 'colormag' ),
								'transport' => 'postMessage',
								'section'   => 'colormag_footer_column_section',
							),
						),
					),
				)
			),
			'collapsible'  => apply_filters( 'colormag_widget_link_title_accordion_collapsible', false ),
		),
		'colormag_footer_column_upgrade' => array(
			'type'        => 'customind-upsell',
			'description' => esc_html__( 'Unlock more features available in Pro version.', 'colormag' ),
			'title'       => esc_html__( 'Learn more', 'colormag' ),
			'url'         => esc_url( 'https://themegrill.com/pricing/?utm_medium=customizer-upgrade&utm_source=colormag-theme&utm_campaign=customizer-upgrade-button&utm_content=learn-more' ),
			'section'     => 'colormag_footer_column_section',
			'priority'    => 100,
		),
	)
);

colormag_customind()->add_controls( $options );
