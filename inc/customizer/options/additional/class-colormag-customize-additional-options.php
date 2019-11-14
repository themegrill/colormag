<?php
/**
 * Class to include Additional customize options.
 *
 * Class ColorMag_Customize_Additional_Options
 *
 * @package    ThemeGrill
 * @subpackage ColorMag
 * @since      ColorMag 2.0.0
 */

/**
 * Class to include Additional customize option.
 *
 * Class ColorMag_Customize_Additional_Options
 */
class ColorMag_Customize_Additional_Options extends ColorMag_Customize_Base_Option {

	/**
	 * Include customize options.
	 *
	 * @param array                 $options
	 * @param \WP_Customize_Manager $wp_customize
	 *
	 * @return mixed|void
	 */
	public function customizer_options( $options, $wp_customize ) {

		$configs = array();

		$options = array_merge( $options, $configs );

		return $options;

		// Transport postMessage variable set
		$customizer_selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';

		$wp_customize->add_panel( 'colormag_additional_options', array(
			'capability'  => 'edit_theme_options',
			'description' => __( 'Change the Additional Settings from here as you want', 'colormag' ),
			'priority'    => 515,
			'title'       => __( 'Additional Options', 'colormag' ),
		) );

		// related posts
		$wp_customize->add_section( 'colormag_related_posts_section', array(
			'priority' => 4,
			'title'    => __( 'Related Posts', 'colormag' ),
			'panel'    => 'colormag_additional_options',
		) );

		$wp_customize->add_setting( 'colormag_related_posts_activate', array(
			'default'           => 0,
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => array(
				'ColorMag_Customizer_Sanitizes',
				'sanitize_checkbox',
			),
			'transport'         => $customizer_selective_refresh,
		) );

		$wp_customize->add_control( 'colormag_related_posts_activate', array(
			'type'     => 'checkbox',
			'label'    => __( 'Check to activate the related posts', 'colormag' ),
			'section'  => 'colormag_related_posts_section',
			'settings' => 'colormag_related_posts_activate',
		) );

		// Selective refresh for related posts feature
		if ( isset( $wp_customize->selective_refresh ) ) {
			$wp_customize->selective_refresh->add_partial( 'colormag_related_posts_activate', array(
				'selector'        => '.related-posts',
				'render_callback' => '',
			) );
		}

		$wp_customize->add_setting( 'colormag_related_posts', array(
			'default'           => 'categories',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => array(
				'ColorMag_Customizer_Sanitizes',
				'sanitize_radio_select',
			),
		) );

		$wp_customize->add_control( 'colormag_related_posts', array(
			'type'     => 'radio',
			'label'    => __( 'Related Posts Must Be Shown As:', 'colormag' ),
			'section'  => 'colormag_related_posts_section',
			'settings' => 'colormag_related_posts',
			'choices'  => array(
				'categories' => __( 'Related Posts By Categories', 'colormag' ),
				'tags'       => __( 'Related Posts By Tags', 'colormag' ),
			),
		) );

		// featured image popup check
		$wp_customize->add_section( 'colormag_featured_image_popup_setting', array(
			'priority' => 6,
			'title'    => __( 'Image Lightbox', 'colormag' ),
			'panel'    => 'colormag_additional_options',
		) );

		$wp_customize->add_setting( 'colormag_featured_image_popup', array(
			'default'           => 0,
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => array(
				'ColorMag_Customizer_Sanitizes',
				'sanitize_checkbox',
			),
		) );

		$wp_customize->add_control( 'colormag_featured_image_popup', array(
			'type'     => 'checkbox',
			'label'    => __( 'Check to enable the lightbox for the featured images in single post', 'colormag' ),
			'section'  => 'colormag_featured_image_popup_setting',
			'settings' => 'colormag_featured_image_popup',
		) );

		// Feature Image dispaly/hide option
		$wp_customize->add_section( 'colormag_featured_image_show_setting', array(
			'priority' => 6,
			'title'    => esc_html__( 'Featured Image', 'colormag' ),
			'panel'    => 'colormag_additional_options',
		) );

		$wp_customize->add_setting( 'colormag_featured_image_show', array(
			'default'           => 0,
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => array(
				'ColorMag_Customizer_Sanitizes',
				'sanitize_checkbox',
			),
		) );

		$wp_customize->add_control( 'colormag_featured_image_show', array(
			'type'     => 'checkbox',
			'label'    => esc_html__( 'Check to hide the featured image in single post page.', 'colormag' ),
			'section'  => 'colormag_featured_image_show_setting',
			'settings' => 'colormag_featured_image_show',
		) );

		// Feature Image dispaly option in single page
		$wp_customize->add_section( 'colormag_featured_image_show_setting_single_page', array(
			'priority' => 6,
			'title'    => esc_html__( 'Featured Image In Single Page', 'colormag' ),
			'panel'    => 'colormag_additional_options',
		) );

		$wp_customize->add_setting( 'colormag_featured_image_single_page_show', array(
			'default'           => 0,
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => array(
				'ColorMag_Customizer_Sanitizes',
				'sanitize_checkbox',
			),
		) );

		$wp_customize->add_control( 'colormag_featured_image_single_page_show', array(
			'type'     => 'checkbox',
			'label'    => esc_html__( 'Check to display the featured image in single page.', 'colormag' ),
			'section'  => 'colormag_featured_image_show_setting_single_page',
			'settings' => 'colormag_featured_image_single_page_show',
		) );

	}

}

return new ColorMag_Customize_Additional_Options();
