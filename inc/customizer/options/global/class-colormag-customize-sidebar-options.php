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

			array(
				'name'        => 'colormag_sidebar_width',
				'default'     => array(
					'size' => 30,
					'unit' => '%',
				),
				'suffix'      => array( '%' ),
				'type'        => 'control',
				'control'     => 'colormag-slider',
				'label'       => esc_html__( 'Width', 'colormag' ),
				'section'     => 'colormag_global_sidebar_section',
				'transport'   => 'postMessage',
				'priority'    => 10,
				'input_attrs' => array(
					'%' => array(
						'min'  => 15,
						'max'  => 80,
						'step' => 1,
					),
				),
			),

			// Layout title.
			array(
				'name'     => 'colormag_sidebar_layout_title',
				'type'     => 'control',
				'control'  => 'colormag-title',
				'label'    => esc_html__( 'Layout', 'colormag' ),
				'section'  => 'colormag_global_sidebar_section',
				'priority' => 10,
			),

			// Default layout heading.
			array(
				'name'     => 'colormag_default_sidebar_layout_heading',
				'type'     => 'control',
				'control'  => 'colormag-subtitle',
				'label'    => esc_html__( 'Default Layout', 'colormag' ),
				'section'  => 'colormag_global_sidebar_section',
				'priority' => 20,
			),

			// Default layout option.
			array(
				'name'      => 'colormag_default_sidebar_layout',
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
				),
				'image_col' => 2,
				'priority'  => 30,
			),

			// Default layout pages heading.
			array(
				'name'     => 'colormag_default_sidebar_layout_pages_heading',
				'type'     => 'control',
				'control'  => 'colormag-subtitle',
				'label'    => esc_html__( 'Default layout for pages only', 'colormag' ),
				'section'  => 'colormag_global_sidebar_section',
				'priority' => 40,
			),

			// Default layout for pages only option.
			array(
				'name'      => 'colormag_page_sidebar_layout',
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
				),
				'image_col' => 2,
				'priority'  => 50,
			),

			// Default layout post heading.
			array(
				'name'     => 'colormag_default_sidebar_layout_post_heading',
				'type'     => 'control',
				'control'  => 'colormag-subtitle',
				'label'    => esc_html__( 'Default layout for single posts only', 'colormag' ),
				'section'  => 'colormag_global_sidebar_section',
				'priority' => 60,
			),

			// Default layout for single posts page only option.
			array(
				'name'      => 'colormag_post_sidebar_layout',
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
				),
				'image_col' => 2,
				'priority'  => 70,
			),

			array(
				'name'        => 'colormag_sidebar_upgrade',
				'type'        => 'control',
				'control'     => 'colormag-upgrade',
				'label'       => esc_html__( 'Learn more', 'colormag' ),
				'description' => esc_html__( 'Unlock more features available in Pro version.', 'colormag' ),
				'url'         => esc_url( 'https://themegrill.com/colormag-pricing/' ),
				'section'     => 'colormag_global_sidebar_section',
				'priority'    => 1000,
			),
		);

		$options = array_merge( $options, $configs );

		return $options;
	}

}

return new ColorMag_Customize_Sidebar_Options();
