<?php
/**
 * Class to include Blog Post Meta customize options.
 *
 * Class ColorMag_Customize_Post_Meta_Options
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
 * Class to include Post Meta customize options.
 *
 * Class ColorMag_Customize_Post_Meta_Options
 */
class ColorMag_Customize_Post_Meta_Options extends ColorMag_Customize_Base_Option {

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
				'name'     => 'colormag_post_meta_elements_title',
				'type'     => 'control',
				'control'  => 'colormag-title',
				'label'    => esc_html__( 'Meta Elements', 'colormag' ),
				'section'  => 'colormag_post_meta_section',
				'priority' => 10,
			),

			array(
				'name'        => 'colormag_post_meta_structure',
				'default'     => array(
					'categories',
					'author',
					'date',
				),
				'type'        => 'control',
				'control'     => 'colormag-sortable',
				'description' => esc_html__( 'Drag & Drop items to re-arrange the order', 'colormag' ),
				'section'     => 'colormag_post_meta_section',
				'choices'     => array(
					'categories' => esc_attr__( 'Categories', 'colormag' ),
					'date'       => esc_attr__( 'Date', 'colormag' ),
					'author'     => esc_attr__( 'Author', 'colormag' ),
					'views'      => esc_attr__( 'Views', 'colormag' ),
					'comments'   => esc_attr__( 'Comments', 'colormag' ),
					'tags'       => esc_attr__( 'Tags', 'colormag' ),
					'read-time'  => esc_attr__( 'Reading Time', 'colormag' ),
				),
				'unsortable'  => array( 'categories' ),
				'priority'    => 20,
			),

			// Edit button post meta display enable/disable option.
			array(
				'name'       => 'colormag_edit_button_entry_meta_remove',
				'default'    => 0,
				'type'       => 'control',
				'control'    => 'colormag-toggle',
				'label'      => esc_html__( 'Disable the edit button only in post meta section.', 'colormag' ),
				'section'    => 'colormag_post_meta_section',
				'transport'  => 'postMessage',
				'dependency' => array(
					'colormag_all_entry_meta_remove',
					'==',
					0,
				),
				'priority'   => 30,
			),

			// Edit button post meta display enable/disable option.
			array(
				'name'       => 'colormag_post_meta_date_title',
				'default'    => 0,
				'type'       => 'control',
				'control'    => 'colormag-title',
				'label'      => esc_html__( 'Date', 'colormag' ),
				'section'    => 'colormag_post_meta_section',
				'transport'  => 'postMessage',
				'dependency' => array(
					'colormag_all_entry_meta_remove',
					'==',
					0,
				),
				'priority'   => 40,
			),

			array(
				'name'       => 'colormag_post_meta_date_style_subtitle',
				'default'    => 0,
				'type'       => 'control',
				'control'    => 'colormag-subtitle',
				'label'      => esc_html__( 'Style', 'colormag' ),
				'section'    => 'colormag_post_meta_section',
				'transport'  => 'postMessage',
				'dependency' => array(
					'colormag_all_entry_meta_remove',
					'==',
					0,
				),
				'priority'   => 50,
			),

			// Post meta date display type option.
			array(
				'name'     => 'colormag_post_meta_date_style',
				'default'  => 'style-1',
				'type'     => 'control',
				'control'  => 'select',
				'section'  => 'colormag_post_meta_section',
				'choices'  => array(
					'style-1' => esc_html__( 'Style 1', 'colormag' ),
					'style-2' => esc_html__( 'Style 2', 'colormag' ),
				),
				'priority' => 60,
			),

			/**
			 * Text.
			 */

			// Color options heading separator.
			array(
				'name'       => 'colormag_post_meta_colors_heading',
				'type'       => 'control',
				'control'    => 'colormag-title',
				'label'      => esc_html__( 'Text', 'colormag' ),
				'section'    => 'colormag_post_meta_section',
				'dependency' => array(
					'colormag_all_entry_meta_remove',
					'==',
					0,
				),
				'priority'   => 70,
			),

			array(
				'name'       => 'colormag_post_meta_color_group',
				'label'      => esc_html__( 'Color', 'colormag' ),
				'default'    => '',
				'type'       => 'control',
				'control'    => 'colormag-group',
				'section'    => 'colormag_post_meta_section',
				'dependency' => array(
					'colormag_all_entry_meta_remove',
					'==',
					0,
				),
				'priority'   => 80,
			),

			array(
				'name'       => 'colormag_post_meta_color',
				'default'    => '#71717A',
				'type'       => 'sub-control',
				'control'    => 'colormag-color',
				'parent'     => 'colormag_post_meta_color_group',
				'section'    => 'colormag_post_meta_section',
				'dependency' => array(
					'colormag_all_entry_meta_remove',
					'==',
					0,
				),
				'priority'   => 90,
			),

			array(
				'name'       => 'colormag_post_meta_title_typography_group',
				'label'      => esc_html__( 'Typography', 'colormag' ),
				'default'    => '',
				'type'       => 'control',
				'control'    => 'colormag-group',
				'section'    => 'colormag_post_meta_section',
				'dependency' => array(
					'colormag_all_entry_meta_remove',
					'==',
					0,
				),
				'priority'   => 100,
			),

			array(
				'name'       => 'colormag_post_meta_typography',
				'default'    => array(
					'font-size' => array(
						'desktop' => array(
							'size' => '12',
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
				'type'       => 'sub-control',
				'control'    => 'colormag-typography',
				'parent'     => 'colormag_post_meta_title_typography_group',
				'section'    => 'colormag_post_meta_section',
				'transport'  => 'postMessage',
				'dependency' => array(
					'colormag_all_entry_meta_remove',
					'==',
					0,
				),
				'priority'   => 110,
			),

		);

		$options = array_merge( $options, $configs );

		return $options;
	}

}

return new ColorMag_Customize_Post_Meta_Options();
