<?php
/**
 * Class to include Design customize options.
 *
 * Class ColorMag_Customize_Design_Options
 *
 * @package    ThemeGrill
 * @subpackage ColorMag
 * @since      ColorMag 2.0.0
 */

/**
 * Class to include Design customize option.
 *
 * Class ColorMag_Customize_Design_Options
 */
class ColorMag_Customize_Design_Options extends ColorMag_Customize_Base_Option {

	/**
	 * Include customize options.
	 *
	 * @param array                 $options
	 * @param \WP_Customize_Manager $wp_customize
	 *
	 * @return mixed|void
	 */
	public function customizer_options( $options, $wp_customize ) {

		$configs = array(

			// Primary color option.
			array(
				'name'     => 'colormag_primary_color',
				'default'  => '#289dcc',
				'type'     => 'control',
				'control'  => 'colormag-color',
				'label'    => esc_html__( 'This will reflect in links, buttons and many others. Choose a color to match your site', 'colormag' ),
				'section'  => 'colormag_primary_color_setting',
				'priority' => 1,
			),

		);

		$options = array_merge( $options, $configs );

		return $options;

		// Transport postMessage variable set
		$customizer_selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';

		$wp_customize->add_setting( 'colormag_hide_blog_front', array(
			'default'           => 0,
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => array(
				'ColorMag_Customizer_Sanitizes',
				'sanitize_checkbox',
			),
		) );

		$wp_customize->add_control( 'colormag_hide_blog_front', array(
			'type'    => 'checkbox',
			'label'   => __( 'Check to hide blog posts/static page on front page', 'colormag' ),
			'section' => 'colormag_front_page_setting',
		) );

		$wp_customize->add_setting( 'colormag_site_layout', array(
			'default'           => 'wide_layout',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => array(
				'ColorMag_Customizer_Sanitizes',
				'sanitize_radio_select',
			),
			'transport'         => 'postMessage',
		) );

		$wp_customize->add_control( 'colormag_site_layout', array(
			'type'    => 'radio',
			'label'   => __( 'Choose your site layout. The change is reflected in whole site', 'colormag' ),
			'choices' => array(
				'boxed_layout' => __( 'Boxed Layout', 'colormag' ),
				'wide_layout'  => __( 'Wide Layout', 'colormag' ),
			),
			'section' => 'colormag_site_layout_setting',
		) );

		$wp_customize->add_setting( 'colormag_default_layout', array(
			'default'           => 'right_sidebar',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => array(
				'ColorMag_Customizer_Sanitizes',
				'sanitize_radio_select',
			),
		) );

		$wp_customize->add_control( new ColorMag_Radio_Image_Control( $wp_customize, 'colormag_default_layout', array(
			'type'     => 'radio',
			'label'    => __( 'Select default layout. This layout will be reflected in whole site archives, categories, search page etc. The layout for a single post and page can be controlled from below options', 'colormag' ),
			'section'  => 'colormag_default_layout_setting',
			'settings' => 'colormag_default_layout',
			'choices'  => array(
				'right_sidebar'               => COLORMAG_ADMIN_IMAGES_URL . '/right-sidebar.png',
				'left_sidebar'                => COLORMAG_ADMIN_IMAGES_URL . '/left-sidebar.png',
				'no_sidebar_full_width'       => COLORMAG_ADMIN_IMAGES_URL . '/no-sidebar-full-width-layout.png',
				'no_sidebar_content_centered' => COLORMAG_ADMIN_IMAGES_URL . '/no-sidebar-content-centered-layout.png',
			),
		) ) );

		$wp_customize->add_setting( 'colormag_default_page_layout', array(
			'default'           => 'right_sidebar',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => array(
				'ColorMag_Customizer_Sanitizes',
				'sanitize_radio_select',
			),
		) );

		$wp_customize->add_control( new ColorMag_Radio_Image_Control( $wp_customize, 'colormag_default_page_layout', array(
			'type'     => 'radio',
			'label'    => __( 'Select default layout for pages. This layout will be reflected in all pages unless unique layout is set for specific page', 'colormag' ),
			'section'  => 'colormag_default_page_layout_setting',
			'settings' => 'colormag_default_page_layout',
			'choices'  => array(
				'right_sidebar'               => COLORMAG_ADMIN_IMAGES_URL . '/right-sidebar.png',
				'left_sidebar'                => COLORMAG_ADMIN_IMAGES_URL . '/left-sidebar.png',
				'no_sidebar_full_width'       => COLORMAG_ADMIN_IMAGES_URL . '/no-sidebar-full-width-layout.png',
				'no_sidebar_content_centered' => COLORMAG_ADMIN_IMAGES_URL . '/no-sidebar-content-centered-layout.png',
			),
		) ) );

		$wp_customize->add_setting( 'colormag_default_single_posts_layout', array(
			'default'           => 'right_sidebar',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => array(
				'ColorMag_Customizer_Sanitizes',
				'sanitize_radio_select',
			),
		) );

		$wp_customize->add_control( new ColorMag_Radio_Image_Control( $wp_customize, 'colormag_default_single_posts_layout', array(
			'type'     => 'radio',
			'label'    => __( 'Select default layout for single posts. This layout will be reflected in all single posts unless unique layout is set for specific post', 'colormag' ),
			'section'  => 'colormag_default_single_posts_layout_setting',
			'settings' => 'colormag_default_single_posts_layout',
			'choices'  => array(
				'right_sidebar'               => COLORMAG_ADMIN_IMAGES_URL . '/right-sidebar.png',
				'left_sidebar'                => COLORMAG_ADMIN_IMAGES_URL . '/left-sidebar.png',
				'no_sidebar_full_width'       => COLORMAG_ADMIN_IMAGES_URL . '/no-sidebar-full-width-layout.png',
				'no_sidebar_content_centered' => COLORMAG_ADMIN_IMAGES_URL . '/no-sidebar-content-centered-layout.png',
			),
		) ) );

		$wp_customize->add_setting( 'colormag_color_skin_setting', array(
			'default'           => 'white',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => array(
				'ColorMag_Customizer_Sanitizes',
				'sanitize_radio_select',
			),
		) );

		$wp_customize->add_control( 'colormag_color_skin_setting', array(
			'type'    => 'radio',
			'label'   => esc_html__( 'Choose the color skin for your site.', 'colormag' ),
			'choices' => array(
				'white' => esc_html__( 'White Skin', 'colormag' ),
				'dark'  => esc_html__( 'Dark Skin', 'colormag' ),
			),
			'section' => 'colormag_color_skin_setting_section',
		) );

	}

}

return new ColorMag_Customize_Design_Options();
