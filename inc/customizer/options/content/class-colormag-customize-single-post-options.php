<?php
/**
 * Class to include Blog Single Post customize options.
 *
 * Class ColorMag_Customize_Single_Post_Options
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

			// Post Title header separator.
			array(
				'name'     => 'colormag_single_feature_image_heading',
				'type'     => 'control',
				'control'  => 'colormag-title',
				'label'    => esc_html__( 'Featured Image', 'colormag' ),
				'section'  => 'colormag_single_post_section',
				'priority' => 0,
			),

			// Featured image display in single post page option.
			array(
				'name'     => 'colormag_featured_image_show',
				'default'  => 0,
				'type'     => 'control',
				'control'  => 'checkbox',
				'label'       => esc_html__( 'Disable', 'colormag' ),
				'description' => esc_html__( 'Check to hide the featured image in single post page.', 'colormag' ),
				'section'  => 'colormag_single_post_section',
				'priority' => 5,
			),

			// Featured image popup enable/disable option.
			array(
				'name'       => 'colormag_featured_image_popup',
				'default'    => 0,
				'type'       => 'control',
				'control'    => 'checkbox',
				'label'      => esc_html__( 'Check to enable the lightbox for the featured images in single post', 'colormag' ),
				'section'    => 'colormag_single_post_section',
				'dependency' => array(
					'colormag_featured_image_show',
					'!=',
					1,
				),
				'priority'   => 10,
			),

			/**
			 * Related posts options.
			 */
			// Related posts heading separator.
			array(
				'name'     => 'colormag_related_posts_heading',
				'type'     => 'control',
				'control'  => 'colormag-title',
				'label'    => esc_html__( 'Related Posts', 'colormag' ),
				'section'  => 'colormag_single_post_section',
				'priority' => 305,
			),

			// Related posts enable/disable option.
			array(
				'name'      => 'colormag_related_posts_activate',
				'default'   => 0,
				'type'      => 'control',
				'control'   => 'checkbox',
				'label'       => esc_html__( 'Enable', 'colormag' ),
				'description' => esc_html__( 'Check to activate the related posts', 'colormag' ),
				'section'   => 'colormag_single_post_section',
				'transport' => $customizer_selective_refresh,
				'partial'   => array(
					'selector' => '.related-posts',
				),
				'priority'  => 310,
			),

			// Related posts display from option.
			array(
				'name'       => 'colormag_related_posts',
				'default'    => 'categories',
				'type'       => 'control',
				'control'    => 'radio',
				'label'      => esc_html__( 'Related Posts Must Be Shown As:', 'colormag' ),
				'section'    => 'colormag_single_post_section',
				'choices'    => array(
					'categories' => esc_html__( 'Related Posts By Categories', 'colormag' ),
					'tags'       => esc_html__( 'Related Posts By Tags', 'colormag' ),
				),
				'dependency' => array(
					'colormag_related_posts_activate',
					'!=',
					0,
				),
				'priority'   => 315,
			),

		);

		$options = array_merge( $options, $configs );

		return $options;

	}

}

return new ColorMag_Customize_Single_Post_Options();
