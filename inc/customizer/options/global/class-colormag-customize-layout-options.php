<?php
/**
 * Class to include Layout customize options.
 *
 * Class ColorMag_Customize_Layout_Options
 *
 * @package    ThemeGrill
 * @subpackage ColorMag
 * @since      ColorMag 2.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class to include Layout customize options.
 *
 * Class ColorMag_Customize_Layout_Options
 */
class ColorMag_Customize_Layout_Options extends ColorMag_Customize_Base_Option {

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

			// Site layout heading.
			array(
				'name'      => 'colormag_site_layout_heading',
				'type'      => 'control',
				'control'   => 'colormag-title',
				'label'     => esc_html__( 'Site Layout', 'colormag' ),
				'section'   => 'colormag_site_layout_section',
				'priority'  => 0,
			),

			// Site layout option.
			array(
				'name'      => 'colormag_site_layout',
				'default'   => 'wide_layout',
				'type'      => 'control',
				'control'   => 'radio',
				'section'   => 'colormag_site_layout_section',
				'transport' => 'postMessage',
				'choices'   => array(
					'boxed_layout' => esc_html__( 'Boxed Layout', 'colormag' ),
					'wide_layout'  => esc_html__( 'Wide Layout', 'colormag' ),
				),
				'priority'  => 10,
			),

			// Default layout heading.
			array(
				'name'      => 'colormag_default_layout_heading',
				'type'      => 'control',
				'control'   => 'colormag-title',
				'label'     => esc_html__( 'Default layout', 'colormag' ),
				'section'   => 'colormag_sidebar_layout_section',
				'priority'  => 0,
			),

			// Default layout option.
			array(
				'name'      => 'colormag_default_layout',
				'default'   => 'right_sidebar',
				'type'      => 'control',
				'control'   => 'colormag-radio-image',
				'section'   => 'colormag_sidebar_layout_section',
				'choices'   => array(
					'right_sidebar'               => array(
						'label' => '',
						'url'   => COLORMAG_ADMIN_IMAGES_URL . '/right-sidebar.png',
					),
					'left_sidebar'                => array(
						'label' => '',
						'url'   => COLORMAG_ADMIN_IMAGES_URL . '/left-sidebar.png',
					),
					'no_sidebar_full_width'       => array(
						'label' => '',
						'url'   => COLORMAG_ADMIN_IMAGES_URL . '/no-sidebar-full-width-layout.png',
					),
					'no_sidebar_content_centered' => array(
						'label' => '',
						'url'   => COLORMAG_ADMIN_IMAGES_URL . '/no-sidebar-content-centered-layout.png',
					),
				),
				'image_col' => 2,
				'priority'  => 10,
			),

			// Default layout for pages only heading.
			array(
				'name'      => 'colormag_default_layout_page_heading',
				'type'      => 'control',
				'control'   => 'colormag-title',
				'label'     => esc_html__( 'Default layout for pages only', 'colormag' ),
				'section'   => 'colormag_sidebar_layout_section',
				'priority'  => 20,
			),

			// Default layout for pages only option.
			array(
				'name'      => 'colormag_default_page_layout',
				'default'   => 'right_sidebar',
				'type'      => 'control',
				'control'   => 'colormag-radio-image',
				'section'   => 'colormag_sidebar_layout_section',
				'choices'   => array(
					'right_sidebar'               => array(
						'label' => '',
						'url'   => COLORMAG_ADMIN_IMAGES_URL . '/right-sidebar.png',
					),
					'left_sidebar'                => array(
						'label' => '',
						'url'   => COLORMAG_ADMIN_IMAGES_URL . '/left-sidebar.png',
					),
					'no_sidebar_full_width'       => array(
						'label' => '',
						'url'   => COLORMAG_ADMIN_IMAGES_URL . '/no-sidebar-full-width-layout.png',
					),
					'no_sidebar_content_centered' => array(
						'label' => '',
						'url'   => COLORMAG_ADMIN_IMAGES_URL . '/no-sidebar-content-centered-layout.png',
					),
				),
				'image_col' => 2,
				'priority'  => 30,
			),

			// Default layout for post only heading.
			array(
				'name'      => 'colormag_default_layout_post_heading',
				'type'      => 'control',
				'control'   => 'colormag-title',
				'label'     => esc_html__( 'Default layout for single posts only', 'colormag' ),
				'section'   => 'colormag_sidebar_layout_section',
				'priority'  => 40,
			),

			// Default layout for single posts page only option.
			array(
				'name'      => 'colormag_default_single_posts_layout',
				'default'   => 'right_sidebar',
				'type'      => 'control',
				'control'   => 'colormag-radio-image',
				'section'   => 'colormag_sidebar_layout_section',
				'choices'   => array(
					'right_sidebar'               => array(
						'label' => '',
						'url'   => COLORMAG_ADMIN_IMAGES_URL . '/right-sidebar.png',
					),
					'left_sidebar'                => array(
						'label' => '',
						'url'   => COLORMAG_ADMIN_IMAGES_URL . '/left-sidebar.png',
					),
					'no_sidebar_full_width'       => array(
						'label' => '',
						'url'   => COLORMAG_ADMIN_IMAGES_URL . '/no-sidebar-full-width-layout.png',
					),
					'no_sidebar_content_centered' => array(
						'label' => '',
						'url'   => COLORMAG_ADMIN_IMAGES_URL . '/no-sidebar-content-centered-layout.png',
					),
				),
				'image_col' => 2,
				'priority'  => 50,
			),

		);

		$options = array_merge( $options, $configs );

		return $options;
	}

}

return new ColorMag_Customize_Layout_Options();
