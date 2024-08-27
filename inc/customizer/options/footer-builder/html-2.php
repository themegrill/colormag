<?php

$options = array(
	'colormag_footer_html_2_heading' => array(
		'type'         => 'customind-accordion',
		'title'        => esc_html__( 'HTML 2', 'colormag' ),
		'section'      => 'colormag_footer_builder_html_2',
		'sub_controls' => apply_filters(
			'colormag_footer_html_2_sub_controls',
			array(
				'colormag_footer_html_2'                  => array(
					'default'  => '',
					'type'     => 'customind-editor',
					'title'    => esc_html__( 'Text/HTML for HTML 2', 'colormag' ),
					'section'  => 'colormag_footer_builder_html_2',
					'priority' => 30,
				),
				'colormag_footer_html_2_text_color'       => array(
					'title'     => esc_html__( 'Color', 'colormag' ),
					'default'   => '',
					'type'      => 'customind-color',
					'section'   => 'colormag_footer_builder_html_2',
					'transport' => 'postMessage',
				),
				'colormag_footer_html_2_link_color_group' => array(
					'type'         => 'customind-color-group',
					'title'        => esc_html__( 'Links', 'colormag' ),
					'section'      => 'colormag_footer_builder_html_2',
					'sub_controls' => apply_filters(
						'colormag_footer_html_2_link_color_sub_controls',
						array(
							'colormag_footer_html_2_link_color'       => array(
								'default'   => '',
								'type'      => 'customind-color',
								'title'     => esc_html__( 'Normal', 'colormag' ),
								'transport' => 'postMessage',
								'section'   => 'colormag_footer_builder_html_2',
							),
							'colormag_footer_html_2_link_hover_color' => array(
								'default'   => '',
								'type'      => 'customind-color',
								'title'     => esc_html__( 'Hover', 'colormag' ),
								'transport' => 'postMessage',
								'section'   => 'colormag_footer_builder_html_2',
							),
						),
					),
				),
				'colormag_footer_html_2_font_size'        => array(
					'title'       => esc_html__( 'Font Size', 'colormag' ),
					'default'     => array(
						'size' => '',
						'unit' => 'px',
					),
					'type'        => 'customind-slider',
					'section'     => 'colormag_footer_builder_html_2',
					'transport'   => 'postMessage',
					'units'       => array( 'px', 'em', 'rem' ),
					'defaultUnit' => 'px',
				),
				'colormag_footer_html_2_margin'           => array(
					'default'     => array(
						'top'    => '',
						'right'  => '',
						'bottom' => '',
						'left'   => '',
						'unit'   => 'px',
					),
					'type'        => 'customind-dimensions',
					'title'       => 'Margin',
					'section'     => 'colormag_footer_builder_html_2',
					'transport'   => 'postMessage',
					'units'       => array( 'px', 'em', '%', 'rem' ),
					'defaultUnit' => 'px',
				),
			)
		),
		'collapsible'  => apply_filters( 'colormag_footer_html_2_accordion_collapsible', false ),
	),
);

colormag_customind()->add_controls( $options );
