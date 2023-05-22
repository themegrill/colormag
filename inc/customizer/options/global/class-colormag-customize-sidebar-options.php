<?php
/**
 * Class to include Sidebar customize options.
 *
 * Class ColorMag_Customize_Sidebar_Options
 *
 * @package    ThemeGrill
 * @subpackage ColorMag
 * @since      TBD
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class to include Sidebar customize options.
 *
 * Class ColorMag_Customize_Sidebar_Options
 */
class ColorMag_Customize_Sidebar_Options extends ColorMag_Customize_Base_Option {

	/**
	 * Include customize options.
	 *
	 * @param array                 $options      Customize options provided via the theme.
	 * @param \WP_Customize_Manager $wp_customize Theme Customizer object.
	 *
	 * @return mixed|void Customizer options for registering panels, sections as well as controls.
	 */
	public function register_options( $options, $wp_customize ) {

		$configs = array(

			// General title.
			array(
				'name'     => 'colormag_sidebar_general_title',
				'type'     => 'control',
				'control'  => 'colormag-title',
				'label'    => esc_html__( 'General', 'colormag' ),
				'section'  => 'colormag_global_sidebar_section',
				'priority' => 10,
			),

			// Sticky Sidebar subtitle.
			array(
				'name'     => 'colormag_sticky_sidebar_subtitle',
				'type'     => 'control',
				'control'  => 'colormag-subtitle',
				'label'    => esc_html__( 'Sticky Sidebar', 'colormag' ),
				'section'  => 'colormag_global_sidebar_section',
				'priority' => 20,
			),

			// Sticky sidebar and content area enable/disable option.
			array(
				'name'        => 'colormag_enable_sticky_sidebar',
				'default'     => 0,
				'type'        => 'control',
				'control'     => 'colormag-toggle',
				'label'       => esc_html__( 'Enable', 'colormag' ),
				'description' => esc_html__( 'Check to activate the sticky options for content and sidebar areas.', 'colormag' ),
				'section'     => 'colormag_global_sidebar_section',
				'priority'    => 30,
			),

			// Widget Title subtitle.
			array(
				'name'     => 'colormag_widget_title_subtitle',
				'type'     => 'control',
				'control'  => 'colormag-subtitle',
				'label'    => esc_html__( 'Widget Title', 'colormag' ),
				'section'  => 'colormag_global_sidebar_section',
				'priority' => 40,
			),

			// Sidebar widget title color option.
			array(
				'name'     => 'colormag_sidebar_widget_title_color_group',
				'type'     => 'control',
				'control'  => 'colormag-group',
				'label'    => esc_html__( 'Color', 'colormag' ),
				'section'  => 'colormag_global_sidebar_section',
				'priority' => 50,
			),

			array(
				'name'     => 'colormag_sidebar_widget_title_color',
				'default'  => '#ffffff',
				'type'     => 'sub-control',
				'control'  => 'colormag-color',
				'parent'   => 'colormag_sidebar_widget_title_color_group',
				'section'  => 'colormag_global_sidebar_section',
				'priority' => 60,
			),

			// Widget title typography group.
			array(
				'name'     => 'colormag_widget_title_typography_group',
				'label'    => esc_html__( 'Typography', 'colormag' ),
				'default'  => '',
				'type'     => 'control',
				'control'  => 'colormag-group',
				'section'  => 'colormag_global_sidebar_section',
				'priority' => 70,
			),

			// Widget title typography option.
			array(
				'name'      => 'colormag_widget_title_typography',
				'default'   => array(
					'font-size' => array(
						'desktop' => array(
							'size' => '18',
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
				'parent'    => 'colormag_widget_title_typography_group',
				'section'   => 'colormag_global_sidebar_section',
				'transport' => 'postMessage',
				'priority'  => 80,
			),

			// Layout title.
			array(
				'name'     => 'colormag_sidebar_layout_title',
				'type'     => 'control',
				'control'  => 'colormag-title',
				'label'    => esc_html__( 'Layout', 'colormag' ),
				'section'  => 'colormag_global_sidebar_section',
				'priority' => 90,
			),

			// Default layout heading.
			array(
				'name'     => 'colormag_default_layout_heading',
				'type'     => 'control',
				'control'  => 'colormag-subtitle',
				'label'    => esc_html__( 'Default Layout', 'colormag' ),
				'section'  => 'colormag_global_sidebar_section',
				'priority' => 100,
			),

			// Default layout option.
			array(
				'name'      => 'colormag_default_layout',
				'default'   => 'right_sidebar',
				'type'      => 'control',
				'control'   => 'colormag-radio-image',
				'section'   => 'colormag_global_sidebar_section',
				'choices'   => array(
					'right_sidebar'               => array(
						'label' => '',
						'url'   => COLORMAG_PARENT_URL . '/assets/img/sidebar/right-sidebar.svg',
					),
					'left_sidebar'                => array(
						'label' => '',
						'url'   => COLORMAG_PARENT_URL . '/assets/img/sidebar/left-sidebar.svg',
					),
					'no_sidebar_full_width'       => array(
						'label' => '',
						'url'   => COLORMAG_PARENT_URL . '/assets/img/sidebar/contained.svg',
					),
					'no_sidebar_content_centered' => array(
						'label' => '',
						'url'   => COLORMAG_PARENT_URL . '/assets/img/sidebar/centered.svg',
					),
					'two_sidebars'                => array(
						'label' => '',
						'url'   => COLORMAG_PARENT_URL . '/assets/img/sidebar/both-sidebar.svg',
					),
				),
				'image_col' => 2,
				'priority'  => 110,
			),

			// Default layout pages heading.
			array(
				'name'     => 'colormag_default_layout_pages_heading',
				'type'     => 'control',
				'control'  => 'colormag-subtitle',
				'label'    => esc_html__( 'Default layout for pages only', 'colormag' ),
				'section'  => 'colormag_global_sidebar_section',
				'priority' => 120,
			),

			// Default layout for pages only option.
			array(
				'name'      => 'colormag_default_page_layout',
				'default'   => 'right_sidebar',
				'type'      => 'control',
				'control'   => 'colormag-radio-image',
				'section'   => 'colormag_global_sidebar_section',
				'choices'   => array(
					'right_sidebar'               => array(
						'label' => '',
						'url'   => COLORMAG_PARENT_URL . '/assets/img/sidebar/right-sidebar.svg',
					),
					'left_sidebar'                => array(
						'label' => '',
						'url'   => COLORMAG_PARENT_URL . '/assets/img/sidebar/left-sidebar.svg',
					),
					'no_sidebar_full_width'       => array(
						'label' => '',
						'url'   => COLORMAG_PARENT_URL . '/assets/img/sidebar/contained.svg',
					),
					'no_sidebar_content_centered' => array(
						'label' => '',
						'url'   => COLORMAG_PARENT_URL . '/assets/img/sidebar/centered.svg',
					),
					'two_sidebars'                => array(
						'label' => '',
						'url'   => COLORMAG_PARENT_URL . '/assets/img/sidebar/both-sidebar.svg',
					),
				),
				'image_col' => 2,
				'priority'  => 130,
			),

			// Default layout post heading.
			array(
				'name'     => 'colormag_default_layout_post_heading',
				'type'     => 'control',
				'control'  => 'colormag-subtitle',
				'label'    => esc_html__( 'Default layout for single posts only', 'colormag' ),
				'section'  => 'colormag_global_sidebar_section',
				'priority' => 140,
			),

			// Default layout for single posts page only option.
			array(
				'name'      => 'colormag_default_single_posts_layout',
				'default'   => 'right_sidebar',
				'type'      => 'control',
				'control'   => 'colormag-radio-image',
				'section'   => 'colormag_global_sidebar_section',
				'choices'   => array(
					'right_sidebar'               => array(
						'label' => '',
						'url'   => COLORMAG_PARENT_URL . '/assets/img/sidebar/right-sidebar.svg',
					),
					'left_sidebar'                => array(
						'label' => '',
						'url'   => COLORMAG_PARENT_URL . '/assets/img/sidebar/left-sidebar.svg',
					),
					'no_sidebar_full_width'       => array(
						'label' => '',
						'url'   => COLORMAG_PARENT_URL . '/assets/img/sidebar/contained.svg',
					),
					'no_sidebar_content_centered' => array(
						'label' => '',
						'url'   => COLORMAG_PARENT_URL . '/assets/img/sidebar/centered.svg',
					),
					'two_sidebars'                => array(
						'label' => '',
						'url'   => COLORMAG_PARENT_URL . '/assets/img/sidebar/both-sidebar.svg',
					),
				),
				'image_col' => 2,
				'priority'  => 150,
			),

		);

		$options = array_merge( $options, $configs );

		return $options;
	}

}

return new ColorMag_Customize_Sidebar_Options();
