<?php
/**
 * Class to include Blog General customize options.
 *
 * Class ColorMag_Customize_Blog_Archive_Options
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
 * Class to include Blog General customize options.
 *
 * Class ColorMag_Customize_Blog_Archive_Options
 */
class ColorMag_Customize_Blog_Archive_Options extends ColorMag_Customize_Base_Option {

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
				'name'        => 'colormag_post_elements_heading',
				'type'        => 'control',
				'control'     => 'colormag-title',
				'label'       => esc_html__( 'Post Elements', 'colormag' ),
				'description' => esc_html__( 'Drag & Drop items to re-arrange the order', 'colormag' ),
				'section'     => 'colormag_blog_section',
				'priority'    => 10,
			),

			array(
				'name'       => 'colormag_blog_post_elements',
				'default'    => array(
					'post_format',
					'category',
					'meta',
					'title',
					'content',
				),
				'type'       => 'control',
				'control'    => 'colormag-sortable',
				'section'    => 'colormag_blog_section',
				'choices'    => array(
					'post_format' => esc_attr__( 'Post Format (Image)', 'colormag' ),
					'category'    => esc_attr__( 'Category', 'colormag' ),
					'meta'        => esc_attr__( 'Meta Tags', 'colormag' ),
					'title'       => esc_attr__( 'Title', 'colormag' ),
					'content'     => esc_attr__( 'Content', 'colormag' ),
				),
				'dependency' => apply_filters( 'colormag_structure_archive_blog_order', false ),
				'priority'   => 15,
			),

			array(
				'name'     => 'colormag_blog_post_title_heading',
				'type'     => 'control',
				'control'  => 'colormag-title',
				'label'    => esc_html__( 'Post Title', 'colormag' ),
				'section'  => 'colormag_blog_section',
				'priority' => 30,
			),

			array(
				'name'     => 'colormag_blog_post_title_typography_group',
				'type'     => 'control',
				'default'  => '',
				'control'  => 'colormag-group',
				'label'    => esc_html__( 'Typography', 'colormag' ),
				'section'  => 'colormag_blog_section',
				'priority' => 35,
			),

			array(
				'name'      => 'colormag_blog_post_title_typography',
				'default'   => array(
					'font-family'    => 'default',
					'font-weight'    => '500',
					'font-size'      => array(
						'desktop' => array(
							'size' => '24',
							'unit' => 'px',
						),
						'tablet'  => array(
							'size' => '',
							'unit' => 'px',
						),
						'mobile'  => array(
							'size' => '',
							'unit' => 'px',
						),
					),
					'line-height'    => array(
						'desktop' => array(
							'size' => '1.3',
							'unit' => '',
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
					'font-style'     => 'normal',
					'text-transform' => 'none',
				),
				'type'      => 'sub-control',
				'control'   => 'colormag-typography',
				'parent'    => 'colormag_blog_post_title_typography_group',
				'section'   => 'colormag_blog_section',
				'transport' => 'postMessage',
				'priority'  => 40,
			),

			array(
				'name'     => 'colormag_blog_post_date_heading',
				'type'     => 'control',
				'control'  => 'colormag-title',
				'label'    => esc_html__( 'Post Date', 'colormag' ),
				'section'  => 'colormag_blog_section',
				'priority' => 40,
			),

			array(
				'name'     => 'colormag_blog_post_date_type',
				'default'  => 'post-date',
				'type'     => 'control',
				'control'  => 'select',
				'label'    => esc_html__( 'Type', 'colormag' ),
				'section'  => 'colormag_blog_section',
				'choices'  => array(
					'post-date'     => esc_html__( 'Post Date', 'colormag' ),
					'modified-date' => esc_html__( 'Modified Date', 'colormag' ),
				),
				'priority' => 40,
			),

			array(
				'name'        => 'colormag_blog_content_heading',
				'type'        => 'control',
				'control'     => 'colormag-title',
				'label'       => esc_html__( 'Excerpt', 'colormag' ),
				'description' => esc_html__( 'Choose to display the post content or excerpt:', 'colormag' ),
				'section'     => 'colormag_blog_section',
				'priority'    => 45,
			),

			// Archive pages content display type option.
			array(
				'name'     => 'colormag_blog_content_excerpt_type',
				'default'  => 'excerpt',
				'type'     => 'control',
				'control'  => 'select',
				'label'    => esc_html__( 'Type', 'colormag' ),
				'section'  => 'colormag_blog_section',
				'choices'  => array(
					'excerpt' => esc_html__( 'Excerpt', 'colormag' ),
					'content' => esc_html__( 'Full Content', 'colormag' ),
				),
				'priority' => 50,
			),

			array(
				'name'     => 'colormag_pagination_heading',
				'type'     => 'control',
				'control'  => 'colormag-title',
				'label'    => esc_html__( 'Pagination', 'colormag' ),
				'section'  => 'colormag_blog_section',
				'priority' => 55,
			),

			array(
				'name'     => 'colormag_enable_pagination',
				'default'  => 1,
				'type'     => 'control',
				'control'  => 'colormag-toggle',
				'label'    => esc_html__( 'Enable', 'colormag' ),
				'section'  => 'colormag_blog_section',
				'priority' => 60,
			),

			array(
				'name'       => 'colormag_pagination_type',
				'default'    => 'default',
				'type'       => 'control',
				'control'    => 'select',
				'label'      => esc_html__( 'Type', 'colormag' ),
				'section'    => 'colormag_blog_section',
				'choices'    => array(
					'default'             => esc_html__( 'Default', 'colormag' ),
					'numbered_pagination' => esc_html__( 'Numbered', 'colormag' ),
				),
				'dependency' => array(
					'colormag_enable_pagination',
					'==',
					true,
				),
				'priority'   => 70,
			),
		);

		$options = array_merge( $options, $configs );

		return $options;
	}
}

return new ColorMag_Customize_Blog_Archive_Options();
