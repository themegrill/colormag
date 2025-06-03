<?php
$options = array(
	'colormag_footer_copyright_heading' => array(
		'type'         => 'customind-accordion',
		'title'        => esc_html__( 'Copyright', 'colormag' ),
		'section'      => 'colormag_footer_builder_copyright',
		'sub_controls' => apply_filters(
			'colormag_footer_copyright_sub_controls',
			array(
				'colormag_footer_copyright'            => array(
					'default' => sprintf(
					/* translators: 1: Current Year, 2: Site Name, 3: Theme Link, 4: WordPress Link. */
						esc_html__( 'Copyright &copy; %1$s %2$s. Powered by %3$s and %4$s.', 'colormag' ),
						'{the-year}',
						'{site-link}',
						'{theme-link}',
						'{wp-link}'
					),
					'type'    => 'customind-editor',
					'title'   => esc_html__( 'Copyright', 'colormag' ),
					'partial' => array(
						'selector'        => '.copyright',
						'render_callback' => array(
							'ColorMag_Customizer_Partials',
							'render_footer_copyright_text',
						),
					),
					'section' => 'colormag_footer_builder_copyright',
				),
				'colormag_footer_copyright_text_color' => array(
					'title'     => esc_html__( 'Color', 'colormag' ),
					'default'   => '',
					'type'      => 'customind-color',
					'section'   => 'colormag_footer_builder_copyright',
					'transport' => 'postMessage',
				),
				'colormag_footer_copyright_link_color_group' => array(
					'type'         => 'customind-color-group',
					'title'        => esc_html__( 'Links', 'colormag' ),
					'section'      => 'colormag_footer_builder_copyright',
					'sub_controls' => apply_filters(
						'colormag_footer_copyright_link_color_sub_controls',
						array(
							'colormag_footer_copyright_link_color'       => array(
								'default'   => '',
								'type'      => 'customind-color',
								'title'     => esc_html__( 'Normal', 'colormag' ),
								'transport' => 'postMessage',
								'section'   => 'colormag_footer_builder_copyright',
							),
							'colormag_footer_copyright_link_hover_color' => array(
								'default'   => '',
								'type'      => 'customind-color',
								'title'     => esc_html__( 'Hover', 'colormag' ),
								'transport' => 'postMessage',
								'section'   => 'colormag_footer_builder_copyright',
							),
						),
					),
				),
				'colormag_footer_copyright_typography' => array(
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
					'section'   => 'colormag_footer_builder_copyright',
				),
				'colormag_footer_copyright_margin'     => array(
					'default'     => array(
						'top'    => '',
						'right'  => '',
						'bottom' => '',
						'left'   => '',
						'unit'   => 'px',
					),
					'type'        => 'customind-dimensions',
					'title'       => esc_html__( 'Margin', 'colormag' ),
					'section'     => 'colormag_footer_builder_copyright',
					'transport'   => 'postMessage',
					'units'       => array( 'px', 'em', '%', 'rem' ),
					'defaultUnit' => 'px',
				),
			)
		),
		'collapsible'  => apply_filters( 'colormag_footer_copyright_accordion_collapsible', false ),
	),
);

colormag_customind()->add_controls( $options );
