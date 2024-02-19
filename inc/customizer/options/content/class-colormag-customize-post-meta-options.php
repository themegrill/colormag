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
				'name'       => 'colormag_post_meta_structure',
				'default'    => array(
					'categories',
					'date',
					'author',
				),
				'type'       => 'control',
				'control'    => 'colormag-sortable',
				'section'    => 'colormag_post_meta_section',
				'choices'    => array(
					'categories'  => esc_attr__( 'Categories', 'colormag' ),
					'author'      => esc_attr__( 'Author', 'colormag' ),
					'date'        => esc_attr__( 'Date', 'colormag' ),
					'views'       => esc_attr__( 'Views', 'colormag' ),
					'comments'    => esc_attr__( 'Comments', 'colormag' ),
					'tags'        => esc_attr__( 'Tags', 'colormag' ),
					'read-time'   => esc_attr__( 'Reading Time', 'colormag' ),
					'edit-button' => esc_attr__( 'Edit button', 'colormag' ),
				),
				'unsortable' => array( 'categories' ),
				'priority'   => 20,
			),
		);

		$options = array_merge( $options, $configs );

		return $options;
	}

}

return new ColorMag_Customize_Post_Meta_Options();
