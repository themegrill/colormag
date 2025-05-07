<?php

$options = array(
	'colormag_header_builder_social_heading' => array(
		'type'         => 'customind-accordion',
		'title'        => esc_html__( 'Social', 'colormag' ),
		'section'      => 'colormag_header_builder_socials',
		'sub_controls' => apply_filters(
			'colormag_header_builder_social_sub_controls',
			array(
				'colormag_header_socials_color_group' => array(
					'type'         => 'customind-color-group',
					'title'        => esc_html__( 'Color', 'colormag' ),
					'section'      => 'colormag_header_builder_primary_menu',
					'sub_controls' => array(
						'colormag_header_socials_color' => array(
							'default'   => '',
							'type'      => 'customind-color',
							'title'     => esc_html__( 'Normal', 'colormag' ),
							'transport' => 'postMessage',
							'section'   => 'colormag_header_builder_socials',
						),
					),
				),
				'colormag_header_socials_style'       => array(
					'default' => 'default',
					'type'    => 'customind-select',
					'title'   => esc_html__( 'Style', 'colormag' ),
					'section' => 'colormag_header_builder_socials',
					'choices' => array(
						'default' => esc_html__( 'Default', 'colormag' ),
						'style-1' => esc_html__( 'Style 1', 'colormag' ),
					),
				),
				'colormag_header_socials'             => array(
					'type'    => 'customind-socials',
					'title'   => esc_html__( 'Social', 'colormag' ),
					'section' => 'colormag_header_builder_socials',
					'default' => array(
						array(
							'id'    => uniqid(),
							'label' => 'facebook',
							'url'   => '#',
							'icon'  => 'fa-brands fa-facebook',
						),
						array(
							'id'    => uniqid(),
							'label' => 'twitter',
							'url'   => '#',
							'icon'  => 'fa-brands fa-x-twitter',
						),
						array(
							'id'    => uniqid(),
							'label' => 'instagram',
							'url'   => '#',
							'icon'  => 'fa-brands fa-square-instagram',
						),
					),
				),
			)
		),
		'collapsible'  => apply_filters( 'colormag_header_builder_social_accordion_collapsible', false ),
	),
);

colormag_customind()->add_controls( $options );
