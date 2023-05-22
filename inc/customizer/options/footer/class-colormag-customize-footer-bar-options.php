<?php
/**
 * Class to include Footer Bottom Bar customize options.
 *
 * Class ColorMag_Customize_Footer_Bottom_Bar_Options
 *
 * @package    ThemeGrill
 * @subpackage ColorMag
 * @since      ColorMag 3.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class to include Footer Bottom Bar customize options.
 *
 * Class ColorMag_Customize_Footer_Bottom_Bar_Options
 */
class ColorMag_Customize_Footer_Bottom_Bar_Options extends ColorMag_Customize_Base_Option {

	/**
	 * Include customize options.
	 *
	 * @param array                 $options      Customize options provided via the theme.
	 * @param \WP_Customize_Manager $wp_customize Theme Customizer object.
	 *
	 * @return mixed|void Customizer options for registering panels, sections as well as controls.
	 */
	public function register_options( $options, $wp_customize ) {

		// Customize transport postMessage variable to set `postMessage` or `refresh` as required.
		$customizer_selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';

		// Footer copyright default value.
		$default_footer_value = esc_html__( 'Copyright &copy; ', 'colormag' ) . '[the-year] [site-link]. ' . esc_html__( 'All rights reserved.', 'colormag' ) . '<br>' . esc_html__( 'Theme: ', 'colormag' ) . '[tg-link]' . esc_html__( ' by ThemeGrill. Powered by ', 'colormag' ) . '[wp-link].';

		$configs = array(

			array(
				'name'     => 'colormag_footer_bar_title',
				'type'     => 'control',
				'control'  => 'colormag-title',
				'label'    => esc_html__( 'Footer Bar', 'colormag' ),
				'section'  => 'colormag_footer_bar_section',
				'priority' => 10,
			),

			array(
				'name'     => 'colormag_footer_bar_general_subtitle',
				'type'     => 'control',
				'control'  => 'colormag-subtitle',
				'label'    => esc_html__( 'General', 'colormag' ),
				'section'  => 'colormag_footer_bar_section',
				'priority' => 20,
			),

			// Footer copyright alignment option.
			array(
				'name'      => 'colormag_footer_bar_layout',
				'default'   => 'layout-1',
				'type'      => 'control',
				'control'   => 'select',
				'label'     => esc_html__( 'Layout', 'colormag' ),
				'section'   => 'colormag_footer_bar_section',
				'choices'   => array(
					'layout-1' => esc_html__( 'Layout 1', 'colormag' ),
					'layout-2' => esc_html__( 'Layout 2', 'colormag' ),
					'layout-3' => esc_html__( 'Layout 3', 'colormag' ),
				),
				'transport' => 'postMessage',
				'priority'  => 30,
			),

			array(
				'name'     => 'colormag_footer_bar_style_divider',
				'type'     => 'control',
				'control'  => 'colormag-divider',
				'style'    => 'dashed',
				'section'  => 'colormag_footer_bar_section',
				'priority' => 40,
			),

			array(
				'name'     => 'colormag_footer_bar_style_subtitle',
				'type'     => 'control',
				'control'  => 'colormag-subtitle',
				'label'    => esc_html__( 'Style', 'colormag' ),
				'section'  => 'colormag_footer_bar_section',
				'priority' => 50,
			),

			array(
				'name'     => 'colormag_footer_copyright_background_group',
				'label'    => esc_html__( 'Background', 'colormag' ),
				'default'  => '',
				'type'     => 'control',
				'control'  => 'colormag-group',
				'section'  => 'colormag_footer_bar_section',
				'priority' => 60,
			),

			array(
				'name'     => 'colormag_footer_copyright_background',
				'default'  => array(
					'background-color'      => '',
					'background-image'      => '',
					'background-position'   => 'center center',
					'background-size'       => 'auto',
					'background-attachment' => 'scroll',
					'background-repeat'     => 'repeat',
				),
				'type'     => 'sub-control',
				'control'  => 'colormag-background',
				'parent'   => 'colormag_footer_copyright_background_group',
				'section'  => 'colormag_footer_bar_section',
				'priority' => 70,
			),

			/**
			 * Footer Copyright.
			 */
			array(
				'name'     => 'colormag_footer_copyright_heading',
				'type'     => 'control',
				'control'  => 'colormag-title',
				'label'    => esc_html__( 'Footer Copyright', 'colormag' ),
				'section'  => 'colormag_footer_bar_section',
				'priority' => 80,
			),

			array(
				'name'      => 'colormag_footer_editor',
				'default'   => $default_footer_value,
				'type'      => 'control',
				'control'   => 'colormag-editor',
				'label'     => esc_html__( 'Edit the Copyright information in your footer. You can also use shortcodes [the-year], [site-link], [wp-link], [tg-link] for current year, your site link, WordPress site link and ThemeGrill site link respectively.', 'colormag' ),
				'section'   => 'colormag_footer_bar_section',
				'transport' => $customizer_selective_refresh,
				'partial'   => array(
					'selector'        => '.copyright',
					'render_callback' => array(
						'ColorMag_Customizer_Partials',
						'render_footer_copyright_text',
					),
				),
				'priority'  => 90,
			),

			array(
				'name'     => 'colormag_footer_copyright_color_group',
				'label'    => esc_html__( 'Color', 'colormag' ),
				'default'  => '#F4F4F5',
				'type'     => 'sub-control',
				'control'  => 'colormag-color',
				'parent'   => 'colormag_footer_copyright_color_group',
				'section'  => 'colormag_footer_bottom_bar_section',
				'priority' => 90,
			),

			array(
				'name'     => 'colormag_footer_copyright_link_text_color',
				'label'    => esc_html__( 'Link Color', 'colormag' ),
				'default'  => '#289dcc',
				'type'     => 'sub-control',
				'control'  => 'colormag-color',
				'parent'   => 'colormag_footer_copyright_color_group',
				'section'  => 'colormag_footer_bottom_bar_section',
				'priority' => 100,
			),

			// Footer Menu.
			array(
				'name'     => 'colormag_footer_menu_color_group',
				'label'    => esc_html__( 'Footer Menu', 'colormag' ),
				'default'  => '',
				'type'     => 'control',
				'control'  => 'colormag-group',
				'section'  => 'colormag_footer_bar_section',
				'priority' => 100,
			),

			array(
				'name'     => 'colormag_footer_copyright_text_color',
				'tab'      => esc_html__( 'Color', 'colormag' ),
				'default'  => '#b1b6b6',
				'type'     => 'sub-control',
				'control'  => 'colormag-color',
				'parent'   => 'colormag_footer_copyright_color_group',
				'section'  => 'colormag_footer_bar_section',
				'priority' => 110,
			),

			array(
				'name'     => 'colormag_footer_copyright_link_text_color',
				'tab'      => esc_html__( 'Link Color', 'colormag' ),
				'default'  => '#b1b6b6',
				'type'     => 'sub-control',
				'control'  => 'colormag-color',
				'parent'   => 'colormag_footer_copyright_color_group',
				'section'  => 'colormag_footer_bar_section',
				'priority' => 120,
			),

			array(
				'name'     => 'colormag_footer_copyright_typography_group',
				'label'    => esc_html__( 'Typography', 'colormag' ),
				'default'  => '',
				'type'     => 'control',
				'control'  => 'colormag-group',
				'section'  => 'colormag_footer_bar_section',
				'priority' => 130,
			),

			array(
				'name'      => 'colormag_footer_copyright_typography',
				'default'   => array(
					'font-size' => array(
						'desktop' => array(
							'size' => '14',
							'unit' => 'px',
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
				),
				'type'      => 'sub-control',
				'control'   => 'colormag-typography',
				'parent'    => 'colormag_footer_copyright_typography_group',
				'section'   => 'colormag_footer_bar_section',
				'transport' => 'postMessage',
				'priority'  => 140,
			),

			/**
			 * Footer Menu.
			 */
			array(
				'name'     => 'colormag_footer_menu_heading',
				'type'     => 'control',
				'control'  => 'colormag-title',
				'label'    => esc_html__( 'Footer Menu', 'colormag' ),
				'section'  => 'colormag_footer_bar_section',
				'priority' => 150,
			),

			array(
				'name'     => 'colormag_footer_menu_color_group',
				'label'    => esc_html__( 'Color', 'colormag' ),
				'default'  => '',
				'type'     => 'control',
				'control'  => 'colormag-group',
				'section'  => 'colormag_footer_bar_section',
				'priority' => 160,
			),

			array(
				'name'     => 'colormag_footer_menu_color',
				'default'  => '#b1b6b6',
				'type'     => 'sub-control',
				'control'  => 'colormag-color',
				'parent'   => 'colormag_footer_menu_color_group',
				'tab'      => esc_html__( 'Normal', 'colormag' ),
				'section'  => 'colormag_footer_bar_section',
				'priority' => 170,
			),

			array(
				'name'     => 'colormag_footer_menu_hover_color',
				'default'  => '#207daf',
				'type'     => 'sub-control',
				'control'  => 'colormag-color',
				'parent'   => 'colormag_footer_menu_color_group',
				'tab'      => esc_html__( 'Hover', 'colormag' ),
				'section'  => 'colormag_footer_bar_section',
				'priority' => 180,
			),

			array(
				'name'     => 'colormag_footer_menu_typography_group',
				'label'    => esc_html__( 'Typography', 'colormag' ),
				'default'  => '',
				'type'     => 'control',
				'control'  => 'colormag-group',
				'section'  => 'colormag_footer_bar_section',
				'priority' => 190,
			),

			array(
				'name'      => 'colormag_footer_menu_typography',
				'default'   => array(
					'font-size' => array(
						'desktop' => array(
							'size' => '14',
							'unit' => 'px',
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
				),
				'type'      => 'sub-control',
				'control'   => 'colormag-typography',
				'parent'    => 'colormag_footer_menu_typography_group',
				'section'   => 'colormag_footer_bar_section',
				'transport' => 'postMessage',
				'priority'  => 200,
			),

			/**
			 * Social Icons.
			 */
			array(
				'name'     => 'colormag_footer_bar_social_icons_heading',
				'type'     => 'control',
				'control'  => 'colormag-title',
				'label'    => esc_html__( 'Social Icons', 'colormag' ),
				'section'  => 'colormag_footer_bar_section',
				'priority' => 210,
			),

			array(
				'name'          => 'colormag_footer_bar_social_icons_navigate',
				'type'          => 'control',
				'control'       => 'colormag-navigate',
				'label'         => esc_html__( 'Social Icons', 'colormag' ),
				'section'       => 'colormag_footer_bar_section',
				'navigate_info' => array(
					'target_id'    => 'colormag_social_icons_section',
					'target_label' => esc_html__( 'Social Icons', 'colormag' ),
				),
				'priority'      => 220,
			),

		);

		$options = array_merge( $options, $configs );

		return $options;
	}

}

return new ColorMag_Customize_Footer_Bottom_Bar_Options();
