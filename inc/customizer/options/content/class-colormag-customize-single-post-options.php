<?php
/**
 * Class to include Blog Single Post customize options.
 *
 * Class ColorMag_Customize_Single_Post_Options
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
 * Class to include Blog Single Post customize options.
 *
 * Class ColorMag_Customize_Single_Post_Options
 */
class ColorMag_Customize_Single_Post_Options extends ColorMag_Customize_Base_Option {

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

		$configs = array(

			array(
				'name'        => 'colormag_single_post_elements_heading',
				'type'        => 'control',
				'control'     => 'colormag-title',
				'label'       => esc_html__( 'Post Elements', 'colormag' ),
				'description' => esc_html__( 'Drag & Drop items to re-arrange the order', 'colormag' ),
				'section'     => 'colormag_single_post_section',
				'priority'    => 10,
			),

			array(
				'name'     => 'colormag_single_post_elements',
				'default'  => array(
					'category',
					'title',
					'meta',
					'content',
				),
				'type'     => 'control',
				'control'  => 'colormag-sortable',
				'section'  => 'colormag_single_post_section',
				'choices'  => array(
					'category'    => esc_attr__( 'Category', 'colormag' ),
					'title'       => esc_attr__( 'Title', 'colormag' ),
					'meta'        => esc_attr__( 'Meta Tags', 'colormag' ),
					'content'     => esc_attr__( 'Content', 'colormag' ),
				),
				'priority' => 20,
			),

			/**
			 * Featured Image.
			 */
			array(
				'name'     => 'colormag_single_featured_image_heading',
				'type'     => 'control',
				'control'  => 'colormag-title',
				'label'    => esc_html__( 'Featured Image', 'colormag' ),
				'section'  => 'colormag_single_post_section',
				'priority' => 50,
			),

			array(
				'name'     => 'colormag_enable_featured_image',
				'default'  => true,
				'type'     => 'control',
				'control'  => 'colormag-toggle',
				'label'    => esc_html__( 'Enable', 'colormag' ),
				'section'  => 'colormag_single_post_section',
				'priority' => 60,
			),

			array(
				'name'       => 'colormag_enable_lightbox',
				'default'    => 0,
				'type'       => 'control',
				'control'    => 'colormag-toggle',
				'label'      => esc_html__( 'LightBox', 'colormag' ),
				'section'    => 'colormag_single_post_section',
				'dependency' => array(
					'colormag_enable_featured_image',
					'===',
					true,
				),
				'priority'   => 70,
			),

			/**
			 * Related posts options.
			 */
			array(
				'name'     => 'colormag_related_posts_heading',
				'type'     => 'control',
				'control'  => 'colormag-title',
				'label'    => esc_html__( 'Related Posts', 'colormag' ),
				'section'  => 'colormag_single_post_section',
				'priority' => 80,
			),

			array(
				'name'      => 'colormag_enable_related_posts',
				'default'   => 0,
				'type'      => 'control',
				'control'   => 'colormag-toggle',
				'label'     => esc_html__( 'Enable', 'colormag' ),
				'section'   => 'colormag_single_post_section',
				'transport' => $customizer_selective_refresh,
				'partial'   => array(
					'selector' => '.related-posts',
				),
				'priority'  => 90,
			),

			array(
				'name'       => 'colormag_related_posts_query',
				'default'    => 'categories',
				'type'       => 'control',
				'control'    => 'select',
				'label'      => esc_html__( 'Query', 'colormag' ),
				'section'    => 'colormag_single_post_section',
				'choices'    => array(
					'categories' => esc_html__( 'Categories', 'colormag' ),
					'tags'       => esc_html__( 'Tags', 'colormag' ),
				),
				'dependency' => array(
					'colormag_enable_related_posts',
					'!=',
					0,
				),
				'priority'   => 100,
			),

			array(
				'name'        => 'colormag_single_post_upgrade',
				'type'        => 'control',
				'control'     => 'colormag-upgrade',
				'label'       => esc_html__( 'Learn more', 'colormag' ),
				'description' => esc_html__( 'Unlock more features available in Pro version.', 'colormag' ),
				'url'         => esc_url( 'https://themegrill.com/colormag-pricing/' ),
				'section'     => 'colormag_single_post_section',
				'priority'    => 1000,
			),
		);

		$options = array_merge( $options, $configs );

		return $options;
	}

}

return new ColorMag_Customize_Single_Post_Options();
