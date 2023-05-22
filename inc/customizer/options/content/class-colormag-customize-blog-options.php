<?php
/**
 * Class to include Blog General customize options.
 *
 * Class ColorMag_Customize_Blog_Archive_Options
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
				'name'     => 'colormag_blog_general_heading',
				'type'     => 'control',
				'control'  => 'colormag-title',
				'label'    => esc_html__( 'General', 'colormag' ),
				'section'  => 'colormag_blog_archive_section',
				'priority' => 10,
			),

			array(
				'name'     => 'colormag_blog_layout_subtitle',
				'type'     => 'control',
				'control'  => 'colormag-subtitle',
				'label'    => esc_html__( 'Layout', 'colormag' ),
				'section'  => 'colormag_blog_archive_section',
				'priority' => 20,
			),

			array(
				'name'     => 'colormag_blog_layout',
				'default'  => 'layout-1',
				'type'     => 'control',
				'control'  => 'select',
				'section'  => 'colormag_blog_archive_section',
				'choices'  => array(
					'layout-1' => esc_html__( 'Layout 1', 'colormag' ),
					'layout-2' => esc_html__( 'Layout 2', 'colormag' ),
				),
				'priority' => 30,
			),

			array(
				'name'       => 'colormag_blog_layout_1_style',
				'default'    => 'style-1',
				'type'       => 'control',
				'control'    => 'colormag-radio-image',
				'label'      => esc_html__( 'Advanced Style', 'colormag' ),
				'section'    => 'colormag_blog_archive_section',
				'priority'   => 40,
				'choices'    => apply_filters(
					'colormag_blog_layout_1_style_choices',
					array(
						'style-1' => array(
							'label' => '',
							'url'   => COLORMAG_IMG_URL . '/blog/layout-1/style-1.svg',
						),
						'style-2' => array(
							'label' => '',
							'url'   => COLORMAG_IMG_URL . '/blog/layout-1/style-2.svg',
						),
					)
				),
				'image_col'  => 2,
				'dependency' => array(
					'colormag_blog_layout',
					'==',
					'layout-1',
				),
			),

			array(
				'name'       => 'colormag_blog_layout_2_style',
				'default'    => 'style-1',
				'type'       => 'control',
				'control'    => 'colormag-radio-image',
				'label'      => esc_html__( 'Advanced Style', 'colormag' ),
				'section'    => 'colormag_blog_archive_section',
				'priority'   => 40,
				'choices'    => apply_filters(
					'colormag_blog_layout_2_style_choices',
					array(
						'style-1' => array(
							'label' => '',
							'url'   => COLORMAG_IMG_URL . '/blog/layout-2/style-1.svg',
						),
						'style-2' => array(
							'label' => '',
							'url'   => COLORMAG_IMG_URL . '/blog/layout-2/style-2.svg',
						),
					)
				),
				'image_col'  => 2,
				'dependency' => array(
					'colormag_blog_layout',
					'==',
					'layout-2',
				),
			),

			array(
				'name'       => 'colormag_grid_layout_column',
				'default'    => '2',
				'type'       => 'control',
				'control'    => 'select',
				'label'      => esc_html__( 'Column', 'colormag' ),
				'section'    => 'colormag_blog_archive_section',
				'choices'    => array(
					'2'   => esc_html__( '2', 'colormag' ),
					'3' => esc_html__( '3', 'colormag' ),
					'4'  => esc_html__( '4', 'colormag' ),
				),
				'dependency' => array(
					'colormag_blog_layout',
					'===',
					'layout-2',
				),
				'priority'   => 50,
			),

			array(
				'name'        => 'colormag_blog_featured_image_heading',
				'type'        => 'control',
				'control'     => 'colormag-title',
				'label'       => esc_html__( 'Featured Image', 'colormag' ),
				'description' => esc_html__( 'Check to show the image caption under the featured image in archive, search as well as the single post page.', 'colormag' ),
				'section'     => 'colormag_blog_archive_section',
				'priority'    => 60,
			),

			// Featured image caption display enable/disable option.
			array(
				'name'      => 'colormag_enable_featured_image_caption',
				'default'   => 0,
				'type'      => 'control',
				'control'   => 'colormag-toggle',
				'label'     => 'Enable',
				'section'   => 'colormag_blog_archive_section',
				'transport' => $customizer_selective_refresh,
				'partial'   => array(
					'selector'        => '.featured-image-caption',
					'render_callback' => array(
						'ColorMag_Customizer_Partials',
						'render_featured_image_caption',
					),
				),
				'priority'  => 70,
			),

			array(
				'name'     => 'colormag_blog_post_title_heading',
				'type'     => 'control',
				'control'  => 'colormag-title',
				'label'    => esc_html__( 'Post Title', 'colormag' ),
				'section'  => 'colormag_blog_archive_section',
				'priority' => 80,
			),

			// Post title length input number field.
			array(
				'name'      => 'colormag_blog_post_title_length',
				'default'   => '',
				'type'      => 'control',
				'control'   => 'number',
				'label'     => esc_html__( 'Length', 'colormag' ),
				'section'   => 'colormag_blog_archive_section',
				'transport' => 'refresh',
				'priority'  => 90,
			),

			array(
				'name'        => 'colormag_blog_content_heading',
				'type'        => 'control',
				'control'     => 'colormag-title',
				'label'       => esc_html__( 'Excerpt', 'colormag' ),
				'description' => esc_html__( 'Choose to display the post content or excerpt:', 'colormag' ),
				'section'     => 'colormag_blog_archive_section',
				'priority'    => 100,
			),

			// Archive pages content display type option.
			array(
				'name'     => 'colormag_blog_content_excerpt_type',
				'default'  => 'excerpt',
				'type'     => 'control',
				'control'  => 'select',
				'label'    => esc_html__( 'Type', 'colormag' ),
				'section'  => 'colormag_blog_archive_section',
				'choices'  => array(
					'excerpt' => esc_html__( 'Excerpt', 'colormag' ),
					'content' => esc_html__( 'Full Content', 'colormag' ),
				),
				'priority' => 110,
			),

			// Archive pages content display type important notice.
			array(
				'name'     => 'colormag_custom_information_for_content_display_type',
				'type'     => 'control',
				'control'  => 'colormag-custom',
				'label'    => esc_html__( 'Important Notice:', 'colormag' ),
				'section'  => 'colormag_blog_archive_section',
				'info'     => sprintf(
				/* Translators: %1$s: Strong tag open, %2$s: Strong tag close */
					esc_html__(
						'The content will only be displayed if you have chosen %1$sOne Column (Featured image on left and post excerpt on right)%2$s or %1$sFull Width (Featured image on top and post excerpt below)%2$s option in %1$sBlog/Archive and Search Pages Layout%2$s under the %1$sDesign Settings%2$s.',
						'colormag'
					),
					'<strong>',
					'</strong>'
				),
				'priority' => 120,
			),

			// Excerpt length option.
			array(
				'name'       => 'colormag_excerpt_length_setting',
				'default'    => 20,
				'type'       => 'control',
				'control'    => 'number',
				'label'      => esc_html__( 'Length', 'colormag' ),
				'section'    => 'colormag_blog_archive_section',
				'dependency' => array(
					'colormag_blog_content_excerpt_type',
					'===',
					'excerpt',
				),
				'priority'   => 130,
			),

			// Read more text change option.
			array(
				'name'       => 'colormag_excerpt_more_text',
				'default'    => '',
				'type'       => 'control',
				'control'    => 'text',
				'label'      => esc_html__( 'More Text', 'colormag' ),
				'section'    => 'colormag_blog_archive_section',
				'dependency' => array(
					'colormag_blog_content_excerpt_type',
					'===',
					'excerpt',
				),
				'priority'   => 140,
			),

			// Read More title
			array(
				'name'     => 'colormag_read_more_heading',
				'type'     => 'control',
				'control'  => 'colormag-title',
				'label'    => esc_html__( 'CTA', 'colormag' ),
				'section'  => 'colormag_blog_archive_section',
				'priority' => 150,
			),

			array(
				'name'     => 'colormag_cta_enable',
				'default'  => true,
				'type'     => 'control',
				'control'  => 'colormag-toggle',
				'label'    => esc_html__( 'Enable', 'colormag' ),
				'section'  => 'colormag_blog_archive_section',
				'priority' => 160,
			),

			// Read more text change option.
			array(
				'name'       => 'colormag_read_more_text',
				'default'    => esc_html__( 'Read More', 'colormag' ),
				'type'       => 'control',
				'control'    => 'text',
				'label'      => esc_html__( 'Text', 'colormag' ),
				'section'    => 'colormag_blog_archive_section',
				'transport'  => $customizer_selective_refresh,
				'partial'    => array(
					'selector'        => '.cm-entry-button span',
					'render_callback' => array(
						'ColorMag_Customizer_Partials',
						'render_read_more_text',
					),
				),
				'dependency' => array(
					'colormag_cta_enable',
					'===',
					true,
				),
				'priority'   => 170,
			),

			array(
				'name'     => 'colormag_pagination_heading',
				'type'     => 'control',
				'control'  => 'colormag-title',
				'label'    => esc_html__( 'Pagination', 'colormag' ),
				'section'  => 'colormag_blog_archive_section',
				'priority' => 180,
			),

			array(
				'name'     => 'colormag_enable_pagination',
				'type'     => 'control',
				'control'  => 'colormag-toggle',
				'label'    => esc_html__( 'Enable', 'colormag' ),
				'section'  => 'colormag_blog_archive_section',
				'priority' => 190,
			),

			array(
				'name'       => 'colormag_pagination_type',
				'default'    => 'default',
				'type'       => 'control',
				'control'    => 'select',
				'label'      => esc_html__( 'Type', 'colormag' ),
				'section'    => 'colormag_blog_archive_section',
				'choices'    => array(
					'default'             => esc_html__( 'Default', 'colormag' ),
					'numbered_pagination' => esc_html__( 'Numbered', 'colormag' ),
					'infinite_scroll'     => esc_html__( 'Infinite Scroll', 'colormag' ),
				),
				'dependency' => array(
					'colormag_enable_pagination',
					'===',
					true,
				),
				'priority'   => 200,
			),

			array(
				'name'       => 'colormag_infinite_scroll_type',
				'default'    => 'button',
				'type'       => 'control',
				'control'    => 'select',
				'label'      => esc_html__( 'Style', 'colormag' ),
				'section'    => 'colormag_blog_archive_section',
				'choices'    => array(
					'button' => esc_html__( 'Button', 'colormag' ),
					'scroll' => esc_html__( 'Scroll', 'colormag' ),
				),
				'priority'   => 210,
				'dependency' => array(
					'colormag_pagination_type',
					'===',
					'infinite_scroll',
				),
			),

		);

		$options = array_merge( $options, $configs );

		return $options;
	}

}

return new ColorMag_Customize_Blog_Archive_Options();
