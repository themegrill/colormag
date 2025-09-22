<?php
use function Customind\Core\get_social_networks;
$options = apply_filters(
	'colormag_global_color_options',
	array(
		'colormag_color_palettes_heading'       => array(
			'type'     => 'customind-heading',
			'priority' => 5,
			'title'    => esc_html__( 'Color palette', 'colormag' ),
			'section'  => 'colormag_global_colors_section',
		),
		'colormag_color_palette'                => array(
			'type'     => 'customind-color-palette',
			'section'  => 'colormag_global_colors_section',
			'priority' => 5,
			'default'  => array(
				'id'     => 'preset-5',
				'name'   => 'Default',
				'colors' => array(
					'cm-color-1' => '#257BC1',
					'cm-color-2' => '#2270B0',
					'cm-color-3' => '#FFFFFF',
					'cm-color-4' => '#F9FEFD',
					'cm-color-5' => '#27272A',
					'cm-color-6' => '#16181A',
					'cm-color-7' => '#8F8F8F',
					'cm-color-8' => '#FFFFFF',
					'cm-color-9' => '#C7C7C7',
				),
			),
			'presets'  => array(
				array(
					'id'     => 'preset-1',
					'name'   => 'Preset 1',
					'colors' => array(
						'cm-color-1' => '#040e16',
						'cm-color-2' => '#94c4eb',
						'cm-color-3' => '#eaf3fb',
						'cm-color-4' => '#bfdcf3',
						'cm-color-5' => '#27272a',
						'cm-color-6' => '#0c2941',
						'cm-color-7' => '#15446b',
						'cm-color-8' => '#257bc1',
						'cm-color-9' => '#d4d4d8',
					),
				),
				array(
					'id'     => 'preset-2',
					'name'   => 'Preset 2',
					'colors' => array(
						'cm-color-1' => '#170411',
						'cm-color-2' => '#eb95d0',
						'cm-color-3' => '#fbebf6',
						'cm-color-4' => '#f3c0e3',
						'cm-color-5' => '#971d70',
						'cm-color-6' => '#420c31',
						'cm-color-7' => '#6c1550',
						'cm-color-8' => '#c22590',
						'cm-color-9' => '#e36abc',
					),
				),
				array(
					'id'     => 'preset-3',
					'name'   => 'Preset 3',
					'colors' => array(
						'cm-color-1' => '#161704',
						'cm-color-2' => '#e5eb95',
						'cm-color-3' => '#fafbeb',
						'cm-color-4' => '#f0f3c0',
						'cm-color-5' => '#8f971d',
						'cm-color-6' => '#3e420c',
						'cm-color-7' => '#676c15',
						'cm-color-8' => '#b8c225',
						'cm-color-9' => '#dbe36a',
					),
				),
				array(
					'id'     => 'preset-4',
					'name'   => 'Preset 4',
					'colors' => array(
						'cm-color-1' => '#170704',
						'cm-color-2' => '#eba395',
						'cm-color-3' => '#fbeeeb',
						'cm-color-4' => '#f3c8c0',
						'cm-color-5' => '#97311d',
						'cm-color-6' => '#42150c',
						'cm-color-7' => '#6c2315',
						'cm-color-8' => '#c23f25',
						'cm-color-9' => '#e37e6a',
					),
				),
				array(
					'id'     => 'preset-5',
					'name'   => 'Default',
					'colors' => array(
						'cm-color-1' => '#257BC1',
						'cm-color-2' => '#2270B0',
						'cm-color-3' => '#FFFFFF',
						'cm-color-4' => '#F9FEFD',
						'cm-color-5' => '#27272A',
						'cm-color-6' => '#16181A',
						'cm-color-7' => '#8F8F8F',
						'cm-color-8' => '#FFFFFF',
						'cm-color-9' => '#C7C7C7',
					),
				),
				array(
					'id'     => 'preset-7',
					'name'   => 'Coral Red',
					'colors' => array(
						'cm-color-1' => '#F44336',
						'cm-color-2' => '#D12729',
						'cm-color-3' => '#FFFFFF',
						'cm-color-4' => '#FEF6F4',
						'cm-color-5' => '#0F000A',
						'cm-color-6' => '#252020',
						'cm-color-7' => '#7E7777',
						'cm-color-8' => '#FFFFFF',
						'cm-color-9' => '#C1BDBD',
					),
				),
				array(
					'id'     => 'preset-8',
					'name'   => 'Apple Green',
					'colors' => array(
						'cm-color-1' => '#4CAF50',
						'cm-color-2' => '#379643',
						'cm-color-3' => '#FFFFFF',
						'cm-color-4' => '#FAFEF6',
						'cm-color-5' => '#000504',
						'cm-color-6' => '#141614',
						'cm-color-7' => '#858585',
						'cm-color-8' => '#FFFFFF',
						'cm-color-9' => '#BDBDBD',
					),
				),
				array(
					'id'     => 'preset-9',
					'name'   => 'Neon Carrot',
					'colors' => array(
						'cm-color-1' => '#FFA726',
						'cm-color-2' => '#DB851B',
						'cm-color-3' => '#FFFFFF',
						'cm-color-4' => '#FFFDF6',
						'cm-color-5' => '#0B0A0A',
						'cm-color-6' => '#121110',
						'cm-color-7' => '#828282',
						'cm-color-8' => '#FFFFFF',
						'cm-color-9' => '#B7B5B3',
					),
				),
				array(
					'id'     => 'preset-6',
					'name'   => 'Dark',
					'colors' => array(
						'cm-color-1' => '#257BC1',
						'cm-color-2' => '#2270B0',
						'cm-color-3' => '#0D0D0D',
						'cm-color-4' => '#1C1C1C',
						'cm-color-5' => '#27272A',
						'cm-color-6' => '#FFFFFF',
						'cm-color-7' => '#E3E2E2',
						'cm-color-8' => '#FFFFFF',
						'cm-color-9' => '#AEAEAD', // Border
					),
				),
			),
		),
		'colormag_theme_colors_heading'         => array(
			'type'    => 'customind-heading',
			'title'   => esc_html__( 'Theme Colors', 'colormag' ),
			'section' => 'colormag_global_colors_section',
		),
		'colormag_primary_color'                => array(
			'title'   => esc_html__( 'Primary Color', 'colormag' ),
			'default' => 'var(--cm-color-1)',
			'type'    => 'customind-color',
			'section' => 'colormag_global_colors_section',
		),
		'colormag_base_color'                   => array(
			'title'     => esc_html__( 'Base', 'colormag' ),
			'default'   => 'var(--cm-color-6)',
			'type'      => 'customind-color',
			'section'   => 'colormag_global_colors_section',
			'transport' => 'postMessage',
		),
		'colormag_box_shadow_color'             => array(
			'title'     => esc_html__( 'Box Border Color', 'colormag' ),
			'default'   => '#E4E4E7',
			'transport' => 'postMessage',
			'type'      => 'customind-color',
			'section'   => 'colormag_global_colors_section',
		),
		'colormag_link_color_group'             => array(
			'type'         => 'customind-color-group',
			'title'        => esc_html__( 'Links', 'colormag' ),
			'section'      => 'colormag_global_colors_section',
			'sub_controls' => apply_filters(
				'colormag_link_color_sub_controls',
				array(
					'colormag_link_color'       => array(
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
		'colormag_inside_container_background'  => array(
			'default'   => array(
				'background-color'      => '#ffffff',
				'background-image'      => '',
				'background-position'   => 'center center',
				'background-size'       => 'auto',
				'background-attachment' => 'scroll',
				'background-repeat'     => 'repeat',
			),
			'type'      => 'customind-background',
			'title'     => esc_html__( 'Container Inside Background', 'colormag' ),
			'section'   => 'colormag_global_container_section',
			'transport' => 'postMessage',
			'priority'  => 20,
		),
		'colormag_outside_container_background' => array(
			'default'   => array(
				'background-color'      => '',
				'background-image'      => '',
				'background-position'   => 'center center',
				'background-size'       => 'auto',
				'background-attachment' => 'scroll',
				'background-repeat'     => 'repeat',
			),
			'type'      => 'customind-background',
			'title'     => esc_html__( 'Container Outside Background', 'colormag' ),
			'section'   => 'colormag_global_container_section',
			'transport' => 'postMessage',
			'priority'  => 20,
			'condition' => array(
				'colormag_container_layout' => 'boxed',
			),
		),
		'colormag_dark_skin_heading'            => array(
			'type'        => 'customind-heading',
			'title'       => esc_html__( 'Dark Skin', 'colormag' ),
			'section'     => 'colormag_global_colors_section',
			'priority'    => 89,
			'description' => esc_html__( 'When dark palette is selected it will override this style in all content', 'colormag' ),
		),
		'colormag_colors_upgrade'               => array(
			'type'        => 'customind-upgrade',
			'description' => esc_html__( 'Upgrade to Pro for more features!', 'colormag' ),
			'label'       => esc_html__( 'Upgrade to Pro', 'colormag' ),
			'url'         => esc_url( 'https://themegrill.com/pricing/?utm_medium=customizer-upgrade&utm_source=colormag-theme&utm_campaign=customizer-upgrade-button&utm_content=learn-more' ),
			'points'      => array(
				esc_html__( 'Headings Color Customization Option', 'colormag' ),
				esc_html__( 'Separate Color for H1, H2 and H3', 'colormag' ),
			),
			'section'     => 'colormag_global_colors_section',
			'priority'    => 100,
		),
	)
);
//$options['colormag_dark_skin'] = array(
//  'default'   => 'preset-5',
//  'type'      => 'customind-select',
//  'title'     => esc_html__( 'Skin Color', 'colormag' ),
//  'section'   => 'colormag_global_colors_section',
//  'transport' => 'postMessage',
//  'priority'  => 90,
//  'choices'   => call_user_func(
//      function () use ( $options ) {
//          // Get predefined presets
//          $presets = $options['colormag_color_palette']['presets'];
//
//          // Get custom presets from theme mod
//          $color_palette = get_theme_mod( 'colormag_color_palette', array() );
//          $custom_presets = isset( $color_palette['custom'] ) ? $color_palette['custom'] : array();
//
//          // Combine all presets
//          $all_presets = array_merge( $presets, $custom_presets );
//
//          // Create choices array with name as key and id as value
//          $choices = array();
//          foreach ( $all_presets as $preset ) {
//              $name = isset( $preset['name'] ) ? $preset['name'] : ( isset( $preset['id'] ) ? 'Custom ' . $preset['id'] : 'Unknown' );
//              $id = isset( $preset['id'] ) ? $preset['id'] : 'unknown';
//              $choices[ $id ] = $name;
//          }
//
//          return $choices;
//      }
//  ),
//  'js_vars'   => array(
//      array(
//          'function' => 'colormag_update_skin_choices',
//          'args'     => array(
//              'colormag_color_palette',
//          ),
//      ),
//  ),
//);


colormag_customind()->add_controls( $options );
