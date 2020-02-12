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
	 * @param array                 $options      Customize options provided via the theme.
	 * @param \WP_Customize_Manager $wp_customize Theme Customizer object.
	 *
	 * @return mixed|void Customizer options for registering panels, sections as well as controls.
	 */
	public function customizer_options( $options, $wp_customize ) {

		// Customize transport postMessage variable to set `postMessage` or `refresh` as required.
		$customizer_selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';

		$configs = array(

			// Related posts enable/disable option.
			array(
				'name'      => 'colormag_related_posts_activate',
				'default'   => 0,
				'type'      => 'control',
				'control'   => 'colormag-toggle',
				'label'     => esc_html__( 'Check to activate the related posts', 'colormag' ),
				'section'   => 'colormag_related_posts_section',
				'transport' => $customizer_selective_refresh,
				'partial'   => array(
					'selector' => '.related-posts',
				),
			),

			// Related posts display from option.
			array(
				'name'    => 'colormag_related_posts',
				'default' => 'categories',
				'type'    => 'control',
				'control' => 'radio',
				'label'   => esc_html__( 'Related Posts Must Be Shown As:', 'colormag' ),
				'section' => 'colormag_related_posts_section',
				'choices' => array(
					'categories' => esc_html__( 'Related Posts By Categories', 'colormag' ),
					'tags'       => esc_html__( 'Related Posts By Tags', 'colormag' ),
				),
			),

		);

		$options = array_merge( $options, $configs );

		return $options;

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
