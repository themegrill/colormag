<?php
$options = array(
	'colormag_footer_builder_social_heading' => array(
		'type'         => 'customind-accordion',
		'title'        => esc_html__( 'Social', 'colormag' ),
		'section'      => 'colormag_footer_builder_socials',
		'sub_controls' => apply_filters(
			'colormag_footer_builder_social_sub_controls',
			array(
				'colormag_footer_socials' => array(
					'type'    => 'customind-socials',
					'title'   => esc_html__( 'Social', 'colormag' ),
					'section' => 'colormag_footer_builder_socials',
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
		'collapsible'  => apply_filters( 'colormag_footer_builder_social_accordion_collapsible', false ),
	),
);

colormag_customind()->add_controls( $options );
