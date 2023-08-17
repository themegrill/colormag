<?php
/**
 * Class to include drawer menu customize options.
 *
 * Class ColorMag_Customize_Drawer_Menu_Options
 *
 * @package    ColorMag
 * @since      TBD
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * Class to include drawer menu customize options.
 *
 * Class ColorMag_Customize_Drawer_Menu_Options
 */
class ColorMag_Customize_Drawer_Menu_Options extends ColorMag_Customize_Base_Option {

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

			array(
				'name'     => 'colormag_drawer_toggle_general_heading',
				'type'     => 'control',
				'control'  => 'colormag-title',
				'label'    => esc_html__( 'General', 'colormag' ),
				'section'  => 'colormag_drawer_toggle_section',
				'priority' => 10,
			),

			array(
				'name'     => 'colormag_enable_header_drawer_toggle',
				'default'  => 0,
				'type'     => 'control',
				'control'  => 'colormag-toggle',
				'label'    => esc_html__( 'Enable', 'colormag' ),
				'section'  => 'colormag_drawer_toggle_section',
				'priority' => 20,
			),

			array(
				'name'          => 'colormag_drawer_block_info',
				'type'          => 'control',
				'control'       => 'colormag-navigate',
				'section'       => 'colormag_drawer_toggle_section',
				'navigate_info' => array(
					'target_container' => 'section',
					'target_id'        => 'sidebar-widgets-mzx-drawer-sidebar',
					'target_label'     => esc_html__( 'Drawer ', 'colormag' ),
				),
				'dependency'    => array(
					'colormag_enable_header_drawer_toggle',
					'==',
					true,
				),
				'priority'      => 30,
			),

			array(
				'name'       => 'colormag_drawer_toggle_content_area_heading',
				'type'       => 'control',
				'control'    => 'colormag-title',
				'label'      => esc_html__( 'Content Area', 'colormag' ),
				'section'    => 'colormag_drawer_toggle_section',
				'dependency' => array(
					'colormag_enable_header_drawer_toggle',
					'==',
					1,
				),
				'priority'   => 40,
			),

			array(
				'name'       => 'colormag_header_drawer_content_background',
				'default'    => '',
				'type'       => 'control',
				'control'    => 'colormag-color',
				'label'      => esc_html__( 'Background Color', 'colormag' ),
				'section'    => 'colormag_drawer_toggle_section',
				'priority'   => 50,
				'dependency' => array(
					'colormag_enable_header_drawer_toggle',
					'==',
					1,
				),
			),

		);

		$options = array_merge( $options, $configs );

		return $options;
	}
}

return new ColorMag_Customize_Drawer_Menu_Options();
