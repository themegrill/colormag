<?php
use function Customind\Core\get_social_networks;
$options = apply_filters(
	'colormag_global_color_options',
	array(
		'colormag_color_palettes'     => array(
			'type'         => 'customind-accordion',
			'title'        => esc_html__( 'Customized Color palette', 'colormag' ),
			'section'      => 'colormag_global_colors_section',
			'sub_controls' => array(
				'colormag_color_palette' => array(
					'type'     => 'customind-color-palette',
					'title'    => esc_html__( 'Customized Color palette', 'colormag' ),
					'section'  => 'colormag_global_colors_section',
					'priority' => 5,
					'default'  => array(
						'id'     => 'preset-1',
						'name'   => 'Preset 1',
						'colors' => array(
							'colormag-color-1' => '#eaf3fb',
							'colormag-color-2' => '#bfdcf3',
							'colormag-color-3' => '#94c4eb',
							'colormag-color-4' => '#6aace2',
							'colormag-color-5' => '#257bc1',
							'colormag-color-6' => '#1d6096',
							'colormag-color-7' => '#15446b',
							'colormag-color-8' => '#0c2941',
							'colormag-color-9' => '#040e16',
						),
					),
					'presets'  => array(
						array(
							'id'     => 'preset-1',
							'name'   => 'Preset 1',
							'colors' => array(
								'colormag-color-1' => '#eaf3fb',
								'colormag-color-2' => '#bfdcf3',
								'colormag-color-3' => '#94c4eb',
								'colormag-color-4' => '#6aace2',
								'colormag-color-5' => '#257bc1',
								'colormag-color-6' => '#1d6096',
								'colormag-color-7' => '#15446b',
								'colormag-color-8' => '#0c2941',
								'colormag-color-9' => '#040e16',
							),
						),
						array(
							'id'     => 'preset-2',
							'name'   => 'Preset 2',
							'colors' => array(
								'colormag-color-1' => '#fbebf6',
								'colormag-color-2' => '#f3c0e3',
								'colormag-color-3' => '#eb95d0',
								'colormag-color-4' => '#e36abc',
								'colormag-color-5' => '#c22590',
								'colormag-color-6' => '#971d70',
								'colormag-color-7' => '#6c1550',
								'colormag-color-8' => '#420c31',
								'colormag-color-9' => '#170411',
							),
						),
						array(
							'id'     => 'preset-3',
							'name'   => 'Preset 3',
							'colors' => array(
								'colormag-color-1' => '#fafbeb',
								'colormag-color-2' => '#f0f3c0',
								'colormag-color-3' => '#e5eb95',
								'colormag-color-4' => '#dbe36a',
								'colormag-color-5' => '#b8c225',
								'colormag-color-6' => '#8f971d',
								'colormag-color-7' => '#676c15',
								'colormag-color-8' => '#3e420c',
								'colormag-color-9' => '#161704',
							),
						),
						array(
							'id'     => 'preset-4',
							'name'   => 'Preset 4',
							'colors' => array(
								'colormag-color-1' => '#fbeeeb',
								'colormag-color-2' => '#f3c8c0',
								'colormag-color-3' => '#eba395',
								'colormag-color-4' => '#e37e6a',
								'colormag-color-5' => '#c23f25',
								'colormag-color-6' => '#97311d',
								'colormag-color-7' => '#6c2315',
								'colormag-color-8' => '#42150c',
								'colormag-color-9' => '#170704',
							),
						),
					),
				),
			),
			'priority'     => 5,
			'collapsible'  => apply_filters( 'colormag_theme_colors_accordion_collapsible', false ),
		),
		'colormag_theme_colors'       => array(
			'type'         => 'customind-accordion',
			'title'        => esc_html__( 'Theme Colors', 'colormag' ),
			'section'      => 'colormag_global_colors_section',
			'sub_controls' => apply_filters(
				'colormag_theme_colors_sub_controls',
				array(
					'colormag_primary_color'      => array(
						'title'   => esc_html__( 'Primary Color', 'colormag' ),
						'default' => '#207daf',
						'type'    => 'customind-color',
						'section' => 'colormag_global_colors_section',
					),
					'colormag_base_color'         => array(
						'title'     => esc_html__( 'Base', 'colormag' ),
						'default'   => '#444444',
						'type'      => 'customind-color',
						'section'   => 'colormag_global_colors_section',
						'transport' => 'postMessage',
					),
					'colormag_box_shadow_color'   => array(
						'title'     => esc_html__( 'Box Border Color', 'colormag' ),
						'default'   => '#E4E4E7',
						'transport' => 'postMessage',
						'type'      => 'customind-color',
						'section'   => 'colormag_global_colors_section',
					),
					'colormag_color_skin_setting' => array(
						'default' => 'white',
						'type'    => 'customind-select',
						'title'   => esc_html__( 'Skin Color', 'colormag' ),
						'section' => 'colormag_global_colors_section',
						'choices' => array(
							'white' => esc_html__( 'White Skin', 'colormag' ),
							'dark'  => esc_html__( 'Dark Skin', 'colormag' ),
						),
					),
				)
			),
			'priority'     => 5,
			'collapsible'  => apply_filters( 'colormag_theme_colors_accordion_collapsible', false ),
		),
		'colormag_link_color_heading' => array(
			'type'         => 'customind-accordion',
			'title'        => esc_html__( 'Links', 'colormag' ),
			'section'      => 'colormag_global_colors_section',
			'sub_controls' => apply_filters(
				'colormag_link_colors_sub_controls',
				array(
					'colormag_link_color_group' => array(
						'type'         => 'customind-color-group',
						'title'        => esc_html__( 'Links', 'colormag' ),
						'section'      => 'colormag_global_colors_section',
						'sub_controls' => apply_filters(
							'colormag_link_color_sub_controls',
							array(
								'colormag_link_color' => array(
									'default'   => '',
									'type'      => 'customind-color',
									'title'     => esc_html__( 'Normal', 'colormag' ),
									'transport' => 'postMessage',
									'section'   => 'colormag_global_colors_section',
								),
								'colormag_link_hover_color' => array(
									'default'   => '',
									'type'      => 'customind-color',
									'title'     => esc_html__( 'Hover', 'colormag' ),
									'transport' => 'postMessage',
									'section'   => 'colormag_global_colors_section',
								),
							),
						),
					),
				)
			),
			'priority'     => 15,
			'collapsible'  => apply_filters( 'colormag_link_colors_accordion_collapsible', false ),
		),
		'colormag_colors_upgrade'     => array(
			'type'        => 'customind-upsell',
			'description' => esc_html__( 'Unlock more features available in Pro version.', 'colormag' ),
			'title'       => esc_html__( 'Learn more', 'colormag' ),
			'url'         => esc_url( 'https://themegrill.com/colormag-pricing' ),
			'section'     => 'colormag_global_colors_section',
			'priority'    => 100,
		),
	)
);

colormag_customind()->add_controls( $options );
