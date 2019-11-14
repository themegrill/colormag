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

		$configs = array();

		$options = array_merge( $options, $configs );

		return $options;

		// Transport postMessage variable set
		$customizer_selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';

		$wp_customize->add_panel( 'colormag_design_options', array(
			'capabitity'  => 'edit_theme_options',
			'description' => __( 'Change the Design Settings from here as you want', 'colormag' ),
			'priority'    => 505,
			'title'       => __( 'Design Options', 'colormag' ),
		) );

		// FrontPage setting
		$wp_customize->add_section( 'colormag_front_page_setting', array(
			'priority' => 1,
			'title'    => __( 'Front Page Settings', 'colormag' ),
			'panel'    => 'colormag_design_options',
		) );
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

		// site layout setting
		$wp_customize->add_section( 'colormag_site_layout_setting', array(
			'priority' => 2,
			'title'    => __( 'Site Layout', 'colormag' ),
			'panel'    => 'colormag_design_options',
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

		// default layout setting
		$wp_customize->add_section( 'colormag_default_layout_setting', array(
			'priority' => 3,
			'title'    => __( 'Default layout', 'colormag' ),
			'panel'    => 'colormag_design_options',
		) );

		$wp_customize->add_setting( 'colormag_default_layout', array(
			'default'           => 'right_sidebar',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => array(
				'ColorMag_Customizer_Sanitizes',
				'sanitize_radio_select',
			),
		) );

		$wp_customize->add_control( new COLORMAG_Image_Radio_Control( $wp_customize, 'colormag_default_layout', array(
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

		// default layout for pages
		$wp_customize->add_section( 'colormag_default_page_layout_setting', array(
			'priority' => 4,
			'title'    => __( 'Default layout for pages only', 'colormag' ),
			'panel'    => 'colormag_design_options',
		) );

		$wp_customize->add_setting( 'colormag_default_page_layout', array(
			'default'           => 'right_sidebar',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => array(
				'ColorMag_Customizer_Sanitizes',
				'sanitize_radio_select',
			),
		) );

		$wp_customize->add_control( new COLORMAG_Image_Radio_Control( $wp_customize, 'colormag_default_page_layout', array(
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

		// default layout for single posts
		$wp_customize->add_section( 'colormag_default_single_posts_layout_setting', array(
			'priority' => 5,
			'title'    => __( 'Default layout for single posts only', 'colormag' ),
			'panel'    => 'colormag_design_options',
		) );

		$wp_customize->add_setting( 'colormag_default_single_posts_layout', array(
			'default'           => 'right_sidebar',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => array(
				'ColorMag_Customizer_Sanitizes',
				'sanitize_radio_select',
			),
		) );

		$wp_customize->add_control( new COLORMAG_Image_Radio_Control( $wp_customize, 'colormag_default_single_posts_layout', array(
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

		// primary color options
		$wp_customize->add_section( 'colormag_primary_color_setting', array(
			'panel'    => 'colormag_design_options',
			'priority' => 7,
			'title'    => __( 'Primary color option', 'colormag' ),
		) );

		$wp_customize->add_setting( 'colormag_primary_color', array(
			'default'           => '#289dcc',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => array(
				'ColorMag_Customizer_Sanitizes',
				'sanitize_hex_color',
			),
			'transport'         => 'postMessage',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'colormag_primary_color', array(
			'label'    => __( 'This will reflect in links, buttons and many others. Choose a color to match your site', 'colormag' ),
			'section'  => 'colormag_primary_color_setting',
			'settings' => 'colormag_primary_color',
		) ) );

		// Color Skin
		$wp_customize->add_section( 'colormag_color_skin_setting_section', array(
			'priority' => 6,
			'title'    => esc_html__( 'Skin Color', 'colormag' ),
			'panel'    => 'colormag_design_options',
		) );

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
