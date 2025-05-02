<?php

$header_image_value = get_theme_mod( 'header_image' ) === 'remove-header' ? 'remove-header' : '';
$header_video_value = get_theme_mod( 'header_video' ) === 0 ? 0 : '';

$options = array(
	'colormag_header_media_position_heading' => array(
		'type'         => 'customind-accordion',
		'title'        => esc_html__( 'Position', 'colormag' ),
		'section'      => 'header_image',
		'sub_controls' => apply_filters(
			'colormag_header_media_position_sub_controls',
			array(
				'colormag_header_media_position'         => array(
					'default' => 'position-two',
					'type'    => 'customind-select',
					'title'   => esc_html__( 'Position', 'colormag' ),
					'section' => 'header_image',
					'choices' => array(
						'position-one'   => esc_html__( 'Above Header', 'colormag' ),
						'position-two'   => esc_html__( 'Between Site Identity and Primary Menu', 'colormag' ),
						'position-three' => esc_html__( 'Below Header', 'colormag' ),
					),
				),
				'colormag_enable_header_image_link_home' => array(
					'title'   => esc_html__( 'Check to make header image link back to home page', 'colormag' ),
					'default' => 0,
					'type'    => 'customind-checkbox',
					'section' => 'header_image',
				),
			)
		),
		'conditions'   => array(
			'relation' => 'OR',
			'terms'    => [
				[
					'id'       => 'header_image',
					'operator' => '!=',
					'value'    => $header_image_value,
				],
				[
					'id'       => 'header_video',
					'operator' => '!=',
					'value'    => $header_video_value,
				],
				[
					'id'       => 'external_header_video',
					'operator' => '!=',
					'value'    => '',
				],
			],
		),
		'collapsible'  => apply_filters( 'colormag_header_media_position_accordion_collapsible', false ),
	),
	'colormag_header_media_upgrade'          => array(
		'type'        => 'customind-upsell',
		'description' => esc_html__( 'Unlock more features available in Pro version.', 'colormag' ),
		'title'       => esc_html__( 'Learn more', 'colormag' ),
		'url'         => esc_url( 'https://themegrill.com/pricing/?utm_medium=customizer-upgrade&utm_source=colormag-theme&utm_campaign=customizer-upgrade-button&utm_content=learn-more' ),
		'section'     => 'header_image',
		'priority'    => 100,
	),
);

colormag_customind()->add_controls( $options );
