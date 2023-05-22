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

			/**
			 * Load Next Post.
			 */
			array(
				'name'     => 'colormag_autoload_posts_heading',
				'type'     => 'control',
				'control'  => 'colormag-title',
				'label'    => esc_html__( 'Autoload Posts', 'colormag' ),
				'section'  => 'colormag_single_post_section',
				'priority' => 10,
			),

			array(
				'name'     => 'colormag_enable_autoload_posts',
				'default'  => 0,
				'type'     => 'control',
				'control'  => 'colormag-toggle',
				'label'    => esc_html__( 'Enable', 'colormag' ),
				'section'  => 'colormag_single_post_section',
				'priority' => 20,
			),

			array(
				'name'       => 'colormag_autoload_posts_filter',
				'default'    => 'previous_posts',
				'type'       => 'control',
				'control'    => 'select',
				'label'      => esc_html__( 'Filter', 'colormag' ),
				'section'    => 'colormag_single_post_section',
				'choices'    => array(
					'previous_posts' => esc_html__( 'Previous posts', 'colormag' ),
					'next_posts'     => esc_html__( 'Next posts', 'colormag' ),
				),
				'priority'   => 30,
				'dependency' => array(
					'colormag_enable_autoload_posts',
					'!=',
					0,
				),
			),

			array(
				'name'       => 'colormag_autoload_posts_type',
				'default'    => 'button',
				'type'       => 'control',
				'control'    => 'select',
				'label'      => esc_html__( 'Style', 'colormag' ),
				'section'    => 'colormag_single_post_section',
				'choices'    => array(
					'button' => esc_html__( 'Button', 'colormag' ),
					'scroll' => esc_html__( 'Scroll', 'colormag' ),
				),
				'priority'   => 40,
				'dependency' => array(
					'colormag_enable_autoload_posts',
					'!=',
					0,
				),
			),

			array(
				'name'        => 'colormag_autoload_posts_limit',
				'default'     => 2,
				'type'        => 'control',
				'control'     => 'number',
				'label'       => esc_html__( 'Number of Posts', 'colormag' ),
				'section'     => 'colormag_single_post_section',
				'priority'    => 50,
				'input_attrs' => array(
					'min' => 1,
					'max' => 5,
				),
				'dependency'  => array(
					'colormag_enable_autoload_posts',
					'!=',
					0,
				),
			),

			/**
			 * Author Bio.
			 */
			array(
				'name'     => 'colormag_author_bio_heading',
				'type'     => 'control',
				'control'  => 'colormag-title',
				'label'    => esc_html__( 'Author Bio', 'colormag' ),
				'section'  => 'colormag_single_post_section',
				'priority' => 60,
			),

			array(
				'name'        => 'colormag_enable_author_bio',
				'default'     => false,
				'type'        => 'control',
				'control'     => 'colormag-toggle',
				'label'       => esc_html__( 'Enable', 'colormag' ),
				'description' => esc_html__( 'Check to disable the Author Bio', 'colormag' ),
				'section'     => 'colormag_single_post_section',
				'priority'    => 70,
			),

			array(
				'name'       => 'colormag_enable_author_bio_profile',
				'default'    => 0,
				'type'       => 'control',
				'control'    => 'colormag-toggle',
				'label'      => esc_html__( 'Social profiles', 'colormag' ),
				'section'    => 'colormag_single_post_section',
				'transport'  => $customizer_selective_refresh,
				'partial'    => array(
					'selector' => '.author-social-sites',
				),
				'dependency' => array(
					'colormag_enable_author_bio',
					'===',
					true,
				),
				'priority'   => 80,
			),

			array(
				'name'       => 'colormag_enable_author_bio_link',
				'default'    => 0,
				'type'       => 'control',
				'control'    => 'colormag-toggle',
				'label'      => esc_html__( 'Link to Author Page', 'colormag' ),
				'section'    => 'colormag_single_post_section',
				'transport'  => $customizer_selective_refresh,
				'partial'    => array(
					'selector' => '.author-url',
				),
				'dependency' => array(
					'colormag_enable_author_bio',
					'===',
					true,
				),
				'priority'   => 90,
			),

			array(
				'name'       => 'colormag_author_bio_style',
				'default'    => 'style_one',
				'type'       => 'control',
				'control'    => 'select',
				'label'      => esc_html__( 'Style', 'colormag' ),
				'section'    => 'colormag_single_post_section',
				'choices'    => array(
					'style-1' => esc_html__( 'Style 1', 'colormag' ),
					'style-2' => esc_html__( 'Style 2', 'colormag' ),
					'style-3' => esc_html__( 'Style 3', 'colormag' ),
				),
				'dependency' => array(
					'colormag_enable_author_bio',
					'===',
					true,
				),
				'priority'   => 100,
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
				'priority' => 110,
			),

			array(
				'name'        => 'colormag_enable_featured_image',
				'default'     => true,
				'type'        => 'control',
				'control'     => 'colormag-toggle',
				'label'       => esc_html__( 'Enable', 'colormag' ),
				'description' => esc_html__( 'Check to hide the featured image in single post page.', 'colormag' ),
				'section'     => 'colormag_single_post_section',
				'priority'    => 120,
			),

			array(
				'name'        => 'colormag_featured_image_position',
				'default'     => 'position-2',
				'type'        => 'control',
				'control'     => 'select',
				'label'       => esc_html__( 'Position', 'colormag' ),
				'description' => esc_html__( 'Post Title Position', 'colormag' ),
				'section'     => 'colormag_single_post_section',
				'choices'     => array(
					'position-1' => esc_html__( 'Above featured image', 'colormag' ),
					'position-2' => esc_html__( 'Below featured image', 'colormag' ),
				),
				'dependency'  => array(
					'colormag_enable_featured_image',
					'===',
					true,
				),
				'priority'    => 130,
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
				'priority'   => 140,
			),

			/**
			 * Social Share.
			 */
			array(
				'name'     => 'colormag_single_post_social_share_heading',
				'type'     => 'control',
				'control'  => 'colormag-title',
				'label'    => esc_html__( 'Social Share Button', 'colormag' ),
				'section'  => 'colormag_single_post_section',
				'priority' => 150,
			),

			array(
				'name'        => 'colormag_enable_social_share',
				'default'     => 0,
				'type'        => 'control',
				'control'     => 'colormag-toggle',
				'label'       => esc_html__( 'Enable', 'colormag' ),
				'description' => esc_html__( 'Check to activate social share buttons in single post', 'colormag' ),
				'section'     => 'colormag_single_post_section',
				'transport'   => $customizer_selective_refresh,
				'partial'     => array(
					'selector' => '.share-buttons',
				),
				'priority'    => 160,
			),

			array(
				'name'       => 'colormag_enable_social_share_twitter',
				'default'    => 1,
				'type'       => 'control',
				'control'    => 'colormag-toggle',
				'label'      => esc_html__( 'Twitter', 'colormag' ),
				'section'    => 'colormag_single_post_section',
				'transport'  => $customizer_selective_refresh,
				'partial'    => array(
					'selector' => '.share-buttons',
				),
				'dependency' => array(
					'colormag_enable_social_share',
					'!=',
					0,
				),
				'priority'   => 170,
			),

			array(
				'name'       => 'colormag_enable_social_share_facebook',
				'default'    => 1,
				'type'       => 'control',
				'control'    => 'colormag-toggle',
				'label'      => esc_html__( 'Facebook', 'colormag' ),
				'section'    => 'colormag_single_post_section',
				'transport'  => $customizer_selective_refresh,
				'partial'    => array(
					'selector' => '.share-buttons',
				),
				'dependency' => array(
					'colormag_enable_social_share',
					'!=',
					0,
				),
				'priority'   => 180,
			),

			array(
				'name'       => 'colormag_enable_social_share_pinterest',
				'default'    => 1,
				'type'       => 'control',
				'control'    => 'colormag-toggle',
				'label'      => esc_html__( 'Pinterest', 'colormag' ),
				'section'    => 'colormag_single_post_section',
				'transport'  => $customizer_selective_refresh,
				'partial'    => array(
					'selector' => '.share-buttons',
				),
				'dependency' => array(
					'colormag_enable_social_share',
					'!=',
					0,
				),
				'priority'   => 190,
			),

			/**
			 * Post Navigation options.
			 */
			// Post Navigation heading separator.
			array(
				'name'     => 'colormag_post_navigation_heading',
				'type'     => 'control',
				'control'  => 'colormag-title',
				'label'    => esc_html__( 'Post Navigation', 'colormag' ),
				'section'  => 'colormag_single_post_section',
				'priority' => 200,
			),

			// Single post navigation option.
			array(
				'name'        => 'colormag_enable_post_navigation',
				'default'     => 0,
				'type'        => 'control',
				'control'     => 'colormag-toggle',
				'label'       => esc_html__( 'Enable', 'colormag' ),
				'description' => esc_html__( 'Disable post navigation', 'colormag' ),
				'section'     => 'colormag_single_post_section',
				'priority'    => 210,
			),

			// Single post navigation display type option.
			array(
				'name'       => 'colormag_post_navigation_style',
				'default'    => 'default',
				'type'       => 'control',
				'control'    => 'select',
				'label'      => esc_html__( 'Style', 'colormag' ),
				'section'    => 'colormag_single_post_section',
				'choices'    => array(
					'style-1' => esc_html__( 'Style 1', 'colormag' ),
					'style-2' => esc_html__( 'Style 2', 'colormag' ),
					'style-3' => esc_html__( 'Style 3', 'colormag' ),
				),
				'dependency' => array(
					'colormag_enable_post_navigation',
					'!=',
					1,
				),
				'priority'   => 220,
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
				'priority' => 230,
			),

			array(
				'name'        => 'colormag_enable_related_posts',
				'default'     => 0,
				'type'        => 'control',
				'control'     => 'colormag-toggle',
				'label'       => esc_html__( 'Enable', 'colormag' ),
				'description' => esc_html__( 'Check to activate the related posts', 'colormag' ),
				'section'     => 'colormag_single_post_section',
				'transport'   => $customizer_selective_refresh,
				'partial'     => array(
					'selector' => '.related-posts',
				),
				'priority'    => 240,
			),

			array(
				'name'       => 'colormag_you_may_also_like_text',
				'default'    => esc_html__( 'You May Also Like', 'colormag' ),
				'type'       => 'control',
				'control'    => 'text',
				'label'      => esc_html__( 'Heading', 'colormag' ),
				'section'    => 'colormag_single_post_section',
				'transport'  => $customizer_selective_refresh,
				'partial'    => array(
					'selector'        => '.related-posts-main-title',
					'render_callback' => array(
						'ColorMag_Customizer_Partials',
						'render_you_may_also_like_text',
					),
				),
				'dependency' => array(
					'colormag_enable_related_posts',
					'!=',
					0,
				),
				'priority'   => 250,
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
				'priority'   => 260,
			),

			array(
				'name'       => 'colormag_related_posts_count',
				'default'    => '3',
				'type'       => 'control',
				'control'    => 'select',
				'label'      => esc_html__( 'Post Count', 'colormag' ),
				'section'    => 'colormag_single_post_section',
				'choices'    => array(
					'3' => esc_html__( '3', 'colormag' ),
					'6' => esc_html__( '6', 'colormag' ),
				),
				'dependency' => array(
					'colormag_enable_related_posts',
					'!=',
					0,
				),
				'priority'   => 270,
			),

			array(
				'name'       => 'colormag_related_posts_style',
				'default'    => 'style-1',
				'type'       => 'control',
				'control'    => 'select',
				'label'      => esc_html__( 'Style', 'colormag' ),
				'section'    => 'colormag_single_post_section',
				'choices'    => array(
					'style-1' => esc_html__( 'Style 1', 'colormag' ),
					'style-2' => esc_html__( 'Style 2', 'colormag' ),
					'style-3' => esc_html__( 'Style 3', 'colormag' ),
					'style-4' => esc_html__( 'Style 4', 'colormag' ),
				),
				'dependency' => array(
					'colormag_enable_related_posts',
					'!=',
					0,
				),
				'priority'   => 280,
			),

			/**
			 * Flyout related posts options.
			 */
			array(
				'name'     => 'colormag_flyout_related_posts_heading',
				'type'     => 'control',
				'control'  => 'colormag-title',
				'label'    => esc_html__( 'Flyout Related Posts', 'colormag' ),
				'section'  => 'colormag_single_post_section',
				'priority' => 290,
			),

			array(
				'name'     => 'colormag_enable_flyout_related_posts',
				'default'  => 0,
				'type'     => 'control',
				'control'  => 'colormag-toggle',
				'label'    => esc_html__( 'Enable', 'colormag' ),
				'section'  => 'colormag_single_post_section',
				'priority' => 300,
			),

			array(
				'name'       => 'colormag_read_next_text',
				'default'    => esc_html__( 'Read Next', 'colormag' ),
				'type'       => 'control',
				'control'    => 'text',
				'label'      => esc_html__( 'Heading', 'colormag' ),
				'section'    => 'colormag_single_post_section',
				'transport'  => $customizer_selective_refresh,
				'partial'    => array(
					'selector'        => '.related-posts-flyout-main-title',
					'render_callback' => array(
						'ColorMag_Customizer_Partials',
						'render_read_next_text',
					),
				),
				'dependency' => array(
					'colormag_enable_flyout_related_posts',
					'!=',
					0,
				),
				'priority'   => 310,
			),

			array(
				'name'       => 'colormag_flyout_related_posts_query',
				'default'    => 'categories',
				'type'       => 'control',
				'control'    => 'select',
				'label'      => esc_html__( 'Query', 'colormag' ),
				'section'    => 'colormag_single_post_section',
				'choices'    => array(
					'categories' => esc_html__( 'Categories', 'colormag' ),
					'tags'       => esc_html__( 'Tags', 'colormag' ),
					'date'       => esc_html__( 'Date', 'colormag' ),
				),
				'dependency' => array(
					'colormag_enable_flyout_related_posts',
					'!=',
					0,
				),
				'priority'   => 320,
			),

			array(
				'name'       => 'colormag_related_posts_flyout_by_date',
				'type'       => 'control',
				'label'      => esc_html__( 'Show Posts After', 'colormag' ),
				'control'    => 'colormag-date',
				'section'    => 'colormag_single_post_section',
				'dependency' => array(
					'conditions' => array(
						array(
							'colormag_enable_flyout_related_posts',
							'!=',
							0,
						),
						array(
							'colormag_flyout_related_posts_query',
							'==',
							'date',
						),
					),
				),
				'priority'   => 330,
			),

			/**
			 * Reading progress indicator options.
			 */
			array(
				'name'     => 'colormag_reading_progress_indicator_heading',
				'type'     => 'control',
				'control'  => 'colormag-title',
				'label'    => esc_html__( 'Reading Progress Indicator', 'colormag' ),
				'section'  => 'colormag_single_post_section',
				'priority' => 340,
			),

			array(
				'name'     => 'colormag_enable_progress_bar_indicator',
				'default'  => 0,
				'type'     => 'control',
				'control'  => 'colormag-toggle',
				'label'    => esc_html__( 'Enable', 'colormag' ),
				'section'  => 'colormag_single_post_section',
				'priority' => 350,
			),

			array(
				'name'       => 'colormag_progress_bar_indicator_color',
				'default'    => '#222222',
				'type'       => 'control',
				'control'    => 'colormag-color',
				'label'      => esc_html__( 'Color', 'colormag' ),
				'section'    => 'colormag_single_post_section',
				'dependency' => array(
					'colormag_enable_progress_bar_indicator',
					'!=',
					0,
				),
				'priority'   => 360,
			),

			/**
			 * Post Title.
			 */
			array(
				'name'     => 'colormag_single_post_title_heading',
				'type'     => 'control',
				'control'  => 'colormag-title',
				'label'    => esc_html__( 'Post Title', 'colormag' ),
				'section'  => 'colormag_single_post_section',
				'priority' => 370,
			),

			array(
				'name'     => 'colormag_single_post_title_color_group',
				'label'    => esc_html__( 'Color', 'colormag' ),
				'default'  => '',
				'type'     => 'control',
				'control'  => 'colormag-group',
				'section'  => 'colormag_single_post_section',
				'priority' => 380,
			),

			array(
				'name'     => 'colormag_post_title_color',
				'label'    => esc_html__( 'Color', 'colormag' ),
				'default'  => '#333333',
				'type'     => 'sub-control',
				'control'  => 'colormag-color',
				'parent'   => 'colormag_single_post_title_color_group',
				'section'  => 'colormag_single_post_section',
				'priority' => 390,
			),

			array(
				'name'     => 'colormag_single_post_title_typography_group',
				'label'    => esc_html__( 'Typography', 'colormag' ),
				'default'  => '',
				'type'     => 'control',
				'control'  => 'colormag-group',
				'section'  => 'colormag_single_post_section',
				'priority' => 400,
			),

			array(
				'name'      => 'colormag_post_title_typography',
				'default'   => array(
					'font-size' => array(
						'desktop' => array(
							'size' => '32',
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
				'parent'    => 'colormag_single_post_title_typography_group',
				'section'   => 'colormag_single_post_section',
				'transport' => 'postMessage',
				'priority'  => 410,
			),

			/**
			 * Comment Title.
			 */
			array(
				'name'     => 'colormag_single_post_typography_heading',
				'type'     => 'control',
				'control'  => 'colormag-title',
				'label'    => esc_html__( 'Comment Title', 'colormag' ),
				'section'  => 'colormag_single_post_section',
				'priority' => 420,
			),

			array(
				'name'     => 'colormag_comment_title_typography_group',
				'label'    => esc_html__( 'Typography', 'colormag' ),
				'default'  => '',
				'type'     => 'control',
				'control'  => 'colormag-group',
				'section'  => 'colormag_single_post_section',
				'priority' => 430,
			),

			array(
				'name'      => 'colormag_comment_title_typography',
				'default'   => array(
					'font-size' => array(
						'desktop' => array(
							'size' => '24',
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
				'parent'    => 'colormag_comment_title_typography_group',
				'section'   => 'colormag_single_post_section',
				'transport' => 'postMessage',
				'priority'  => 440,
			),

		);

		$options = array_merge( $options, $configs );

		return $options;
	}

}

return new ColorMag_Customize_Single_Post_Options();
