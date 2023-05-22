<?php
/**
 * Class to include Colors customize options.
 *
 * Class ColorMag_Customize_Colors_Options
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
 * Class to include Colors customize options.
 *
 * Class ColorMag_Customize_Colors_Options
 */
class ColorMag_Customize_Colors_Options extends ColorMag_Customize_Base_Option {

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

			/**
			 * Theme Colors.
			 */
			// Theme Colors heading.
			array(
				'name'     => 'colormag_theme_colors_heading',
				'type'     => 'control',
				'control'  => 'colormag-title',
				'label'    => esc_html__( 'Theme Colors', 'colormag' ),
				'section'  => 'colormag_global_colors_section',
				'priority' => 10,
			),

			// Primary color option.
			array(
				'name'     => 'colormag_primary_color_group',
				'label'    => esc_html__( 'Primary Color', 'colormag' ),
				'default'  => '',
				'type'     => 'control',
				'control'  => 'colormag-group',
				'section'  => 'colormag_global_colors_section',
				'priority' => 20,
			),

			array(
				'name'     => 'colormag_primary_color',
				'default'  => '#207daf',
				'type'     => 'sub-control',
				'control'  => 'colormag-color',
				'parent'   => 'colormag_primary_color_group',
				'section'  => 'colormag_global_colors_section',
				'priority' => 30,
			),

			// Skin color option.
			array(
				'name'     => 'colormag_color_skin_setting',
				'default'  => 'white',
				'type'     => 'control',
				'control'  => 'select',
				'label'    => esc_html__( 'Skin Color', 'colormag' ),
				'section'  => 'colormag_global_colors_section',
				'choices'  => array(
					'white' => esc_html__( 'White Skin', 'colormag' ),
					'dark'  => esc_html__( 'Dark Skin', 'colormag' ),
				),
				'priority' => 60,
			),

			/**
			 * Link Colors.
			 */
			// Links heading.
			array(
				'name'     => 'colormag_links_heading',
				'type'     => 'control',
				'control'  => 'colormag-title',
				'label'    => esc_html__( 'Links', 'colormag' ),
				'section'  => 'colormag_global_colors_section',
				'priority' => 160,
			),

			// Link color option.
			array(
				'name'     => 'colormag_link_color_group',
				'label'    => esc_html__( 'Link', 'colormag' ),
				'default'  => '',
				'type'     => 'control',
				'control'  => 'colormag-group',
				'section'  => 'colormag_global_colors_section',
				'priority' => 170,
			),

			array(
				'name'      => 'colormag_link_color',
				'default'   => '#207daf',
				'type'      => 'sub-control',
				'control'   => 'colormag-color',
				'parent'    => 'colormag_link_color_group',
				'tab'       => esc_html__( 'Color', 'colormag' ),
				'section'   => 'colormag_global_colors_section',
				'transport' => 'postMessage',
				'priority'  => 180,
			),

			// Link Hover color option.
			array(
				'name'      => 'colormag_link_hover_color',
				'default'   => '#207daf',
				'type'      => 'sub-control',
				'control'   => 'colormag-color',
				'parent'    => 'colormag_link_color_group',
				'tab'       => esc_html__( 'Hover Color', 'colormag' ),
				'section'   => 'colormag_global_colors_section',
				'transport' => 'postMessage',
				'priority'  => 190,
			),

		);

		$options = array_merge( $options, $configs );

		return $options;
	}

}

return new ColorMag_Customize_Colors_Options();
