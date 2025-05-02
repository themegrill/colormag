<?php

$options = apply_filters(
	'colormag_footer_bottom_bar_options',
	array(
		'colormag_footer_bar_title'                => array(
			'type'         => 'customind-accordion',
			'title'        => esc_html__( 'Footer Bar', 'colormag' ),
			'section'      => 'colormag_footer_bar_section',
			'sub_controls' => apply_filters(
				'colormag_footer_bar_sub_controls',
				array(
					'colormag_footer_bar_general_subtitle' => array(
						'type'    => 'customind-title',
						'title'   => esc_html__( 'General', 'colormag' ),
						'section' => 'colormag_footer_bar_section',
					),
					'colormag_footer_bar_alignment'        => array(
						'default'   => 'left',
						'type'      => 'customind-radio-image',
						'title'     => esc_html__( 'Alignment', 'colormag' ),
						'section'   => 'colormag_footer_bar_section',
						'transport' => 'postMessage',
						'choices'   => apply_filters(
							'colormag_footer_bar_alignment_choices',
							array(
								'left'   => array(
									'label' => '',
									'url'   => COLORMAG_IMG_URL . '/footer-bar-alignment/left.svg',
								),
								'right'  => array(
									'label' => '',
									'url'   => COLORMAG_IMG_URL . '/footer-bar-alignment/right.svg',
								),
								'center' => array(
									'label' => '',
									'url'   => COLORMAG_IMG_URL . '/footer-bar-alignment/center.svg',
								),
							)
						),
						'columns'   => 2,
					),
					'colormag_footer_bar_style_divider'    => array(
						'type'    => 'customind-divider',
						'variant' => 'dashed',
						'section' => 'colormag_footer_bar_section',
					),
					'colormag_footer_bar_style_subtitle'   => array(
						'type'    => 'customind-title',
						'title'   => esc_html__( 'Style', 'colormag' ),
						'section' => 'colormag_footer_bar_section',
					),
					'colormag_footer_copyright_background' => array(
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
						'section'   => 'colormag_footer_bar_section',
					),
				)
			),
			'collapsible'  => apply_filters( 'colormag_footer_bar_accordion_collapsible', false ),
		),
		'colormag_footer_copyright_heading'        => array(
			'type'         => 'customind-accordion',
			'title'        => esc_html__( 'Footer Copyright', 'colormag' ),
			'section'      => 'colormag_footer_bar_section',
			'sub_controls' => apply_filters(
				'colormag_footer_copyright_sub_controls',
				array(
					'colormag_footer_copyright_color_group' => array(
						'type'         => 'customind-color-group',
						'title'        => esc_html__( 'Color', 'colormag' ),
						'section'      => 'colormag_footer_bar_section',
						'sub_controls' => array(
							'colormag_footer_copyright_text_color' => array(
								'default'   => '#f4f4f5',
								'type'      => 'customind-color',
								'title'     => esc_html__( 'Normal', 'colormag' ),
								'transport' => 'postMessage',
								'section'   => 'colormag_footer_bar_section',
							),
							'colormag_footer_copyright_link_text_color' => array(
								'default'   => '#207dafc',
								'type'      => 'customind-color',
								'title'     => esc_html__( 'Hover', 'colormag' ),
								'transport' => 'postMessage',
								'section'   => 'colormag_footer_bar_section',
							),
						),
					),
				)
			),
			'collapsible'  => apply_filters( 'colormag_footer_copyright_accordion_collapsible', false ),
		),
		'colormag_footer_bar_social_icons_heading' => array(
			'type'         => 'customind-accordion',
			'title'        => esc_html__( 'Social Icons', 'colormag' ),
			'section'      => 'colormag_footer_bar_section',
			'sub_controls' => apply_filters(
				'colormag_footer_bar_social_icons_sub_controls',
				array(
					'colormag_footer_bar_social_icons_navigate' => array(
						'title'    => esc_html__( 'Social Icons', 'colormag' ),
						'type'     => 'customind-navigation',
						'section'  => 'colormag_footer_bar_section',
						'to'       => 'colormag_social_icons_section',
						'nav_type' => 'section',
					),
				)
			),
			'collapsible'  => apply_filters( 'colormag_footer_bar_social_icons_accordion_collapsible', false ),
		),
		'colormag_footer_bar_upgrade'              => array(
			'type'        => 'customind-upsell',
			'description' => esc_html__( 'Unlock more features available in Pro version.', 'colormag' ),
			'title'       => esc_html__( 'Learn more', 'colormag' ),
			'url'         => esc_url( 'https://themegrill.com/pricing/?utm_medium=customizer-upgrade&utm_source=colormag-theme&utm_campaign=customizer-upgrade-button&utm_content=learn-more' ),
			'section'     => 'colormag_footer_bar_section',
			'priority'    => 100,
		),
	)
);

colormag_customind()->add_controls( $options );
