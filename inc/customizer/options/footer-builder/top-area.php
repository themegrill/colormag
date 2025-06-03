<?php
$options = array(
	'colormag_footer_top_area_heading' => array(
		'type'         => 'customind-accordion',
		'title'        => esc_html__( 'Top Area', 'colormag' ),
		'section'      => 'colormag_footer_builder_top_area',
		'sub_controls' => apply_filters(
			'colormag_footer_top_area_sub_controls',
			array(
				'colormag_footer_top_area_cols'            => array(
					'type'        => 'customind-slider',
					'title'       => esc_html__( 'Top row cols', 'colormag' ),
					'default'     => 3,
					'section'     => 'colormag_footer_builder_top_area',
					'input_attrs' => array(
						'min'  => 1,
						'max'  => 6,
						'step' => 1,
					),
				),
				'colormag_footer_top_area_container'       => array(
					'default'     => array(
						'size' => '',
						'unit' => 'px',
					),
					'type'        => 'customind-slider',
					'title'       => esc_html__( 'Container', 'colormag' ),
					'section'     => 'colormag_footer_builder_top_area',
					'transport'   => 'postMessage',
					'units'       => array( 'px' ),
					'defaultUnit' => 'px',
					'input_attrs' => array(
						'min'  => 400,
						'max'  => 1920,
						'step' => 1,
					),
				),
				'colormag_footer_top_area_height'          => array(
					'default'     => array(
						'size' => '',
						'unit' => 'px',
					),
					'type'        => 'customind-slider',
					'title'       => esc_html__( 'Height', 'colormag' ),
					'section'     => 'colormag_footer_builder_top_area',
					'transport'   => 'postMessage',
					'units'       => array( 'px' ),
					'defaultUnit' => 'px',
				),
				'colormag_footer_top_area_color'           => array(
					'title'     => esc_html__( 'Color', 'colormag' ),
					'default'   => '',
					'type'      => 'customind-color',
					'section'   => 'colormag_footer_builder_top_area',
					'transport' => 'postMessage',
				),
				'colormag_footer_top_area_background'      => array(
					'default'   => array(
						'background-color'      => '',
						'background-image'      => '',
						'background-repeat'     => 'repeat',
						'background-position'   => 'center center',
						'background-size'       => 'contain',
						'background-attachment' => 'scroll',
					),
					'type'      => 'customind-background',
					'title'     => esc_html__( 'Background', 'colormag' ),
					'transport' => 'postMessage',
					'section'   => 'colormag_footer_builder_top_area',
				),
				'colormag_footer_top_area_widget_background' => array(
					'default'   => array(
						'background-color'      => '',
						'background-image'      => '',
						'background-repeat'     => 'repeat',
						'background-position'   => 'center center',
						'background-size'       => 'contain',
						'background-attachment' => 'scroll',
					),
					'type'      => 'customind-background',
					'title'     => esc_html__( 'Column Background', 'colormag' ),
					'transport' => 'postMessage',
					'section'   => 'colormag_footer_builder_top_area',
				),
				'colormag_footer_top_area_padding'         => array(
					'default'     => array(
						'top'    => '',
						'right'  => '',
						'bottom' => '',
						'left'   => '',
						'unit'   => 'px',
					),
					'type'        => 'customind-dimensions',
					'title'       => esc_html__( 'Padding', 'colormag' ),
					'section'     => 'colormag_footer_builder_top_area',
					'transport'   => 'postMessage',
					'units'       => array( 'px', 'em' ),
					'defaultUnit' => 'px',
				),

				'colormag_footer_top_area_margin'          => array(
					'default'     => array(
						'top'    => '',
						'right'  => '',
						'bottom' => '',
						'left'   => '',
						'unit'   => 'px',
					),
					'type'        => 'customind-dimensions',
					'title'       => esc_html__( 'Margin', 'colormag' ),
					'section'     => 'colormag_footer_builder_top_area',
					'transport'   => 'postMessage',
					'units'       => array( 'px', 'em' ),
					'defaultUnit' => 'px',
				),

				'colormag_footer_top_area_border_width'    => array(
					'default'     => array(
						'top'    => '0',
						'right'  => '0',
						'bottom' => '0',
						'left'   => '0',
						'unit'   => 'px',
					),
					'type'        => 'customind-dimensions',
					'title'       => esc_html__( 'Border Width', 'colormag' ),
					'section'     => 'colormag_footer_builder_top_area',
					'transport'   => 'postMessage',
					'units'       => array( 'px', 'em' ),
					'defaultUnit' => 'px',
				),

				'colormag_footer_top_area_border_color'    => array(
					'title'     => esc_html__( 'Border Color', 'colormag' ),
					'default'   => '',
					'type'      => 'customind-color',
					'section'   => 'colormag_footer_builder_top_area',
					'transport' => 'postMessage',
				),
				'colormag_footer_top_inner_element_layout_divider' => array(
					'type'    => 'customind-divider',
					'variant' => 'dashed',
					'section' => 'colormag_footer_builder_top_area',
					'tab'     => 'general',
				),
				'colormag_footer_top_inner_element_layout_heading' => array(
					'type'    => 'customind-title',
					'title'   => esc_html__( 'Inner Elements', 'colormag' ),
					'section' => 'colormag_footer_builder_top_area',
				),
				'colormag_footer_top_inner_element_layout' => array(
					'type'      => 'customind-toggle-button',
					'title'     => esc_html__( ' Layout', 'colormag' ),
					'section'   => 'colormag_footer_builder_top_area',
					'transport' => 'postMessage',
					'choices'   => array(
						'column' => esc_html__( 'Stack', 'colormag' ),
						'row'    => esc_html__( 'Inline', 'colormag' ),
					),
				),

			)
		),
		'collapsible'  => apply_filters( 'colormag_footer_top_area_background_accordion_collapsible', false ),
	),
);

colormag_customind()->add_controls( $options );
