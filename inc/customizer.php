<?php

/**
 * ColorMag Theme Customizer
 *
 * @package    ThemeGrill
 * @subpackage ColorMag
 * @since      ColorMag 1.0
 */
function colormag_customize_register( $wp_customize ) {

	require COLORMAG_INCLUDES_DIR . '/customize-controls/class-colormag-upsell-section.php';
	require COLORMAG_INCLUDES_DIR . '/customize-controls/class-colormag-image-radio-control.php';
	require COLORMAG_INCLUDES_DIR . '/customize-controls/class-colormag-custom-css-control.php';

	// Transport postMessage variable set
	$customizer_selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';

	$wp_customize->get_setting( 'blogname' )->transport        = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '#site-title a',
			'render_callback' => 'colormag_customize_partial_blogname',
		) );

		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '#site-description',
			'render_callback' => 'colormag_customize_partial_blogdescription',
		) );
	}

	// Register `COLORMAG_Upsell_Section` type section.
	$wp_customize->register_section_type( 'COLORMAG_Upsell_Section' );

	// Add `COLORMAG_Upsell_Section` to display pro link.
	$wp_customize->add_section(
		new COLORMAG_Upsell_Section( $wp_customize, 'colormag_upsell_section',
			array(
				'title'      => esc_html__( 'View PRO version', 'colormag' ),
				'url'        => 'https://themegrill.com/themes/colormag/?utm_source=colormag-customizer&utm_medium=view-pro-link&utm_campaign=view-pro#free-vs-pro',
				'capability' => 'edit_theme_options',
				'priority'   => 1,
			)
		)
	);

	// Start of the Header Options
	$wp_customize->add_panel( 'colormag_header_options', array(
		'capabitity'  => 'edit_theme_options',
		'description' => __( 'Change the Header Settings from here as you want', 'colormag' ),
		'priority'    => 500,
		'title'       => __( 'Header Options', 'colormag' ),
	) );

	// breaking news enable/disable
	$wp_customize->add_section( 'colormag_breaking_news_section', array(
		'title' => __( 'Breaking News', 'colormag' ),
		'panel' => 'colormag_header_options',
	) );

	$wp_customize->add_setting( 'colormag_breaking_news', array(
		'priority'          => 1,
		'default'           => 0,
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'colormag_checkbox_sanitize',
	) );

	$wp_customize->add_control( 'colormag_breaking_news', array(
		'type'     => 'checkbox',
		'label'    => __( 'Check to enable the breaking news section', 'colormag' ),
		'section'  => 'colormag_breaking_news_section',
		'settings' => 'colormag_breaking_news',
	) );

	// date display enable/disable
	$wp_customize->add_section( 'colormag_date_display_section', array(
		'title' => __( 'Show Date', 'colormag' ),
		'panel' => 'colormag_header_options',
	) );

	$wp_customize->add_setting( 'colormag_date_display', array(
		'priority'          => 2,
		'default'           => 0,
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'colormag_checkbox_sanitize',
		'transport'         => $customizer_selective_refresh,
	) );

	$wp_customize->add_control( 'colormag_date_display', array(
		'type'     => 'checkbox',
		'label'    => __( 'Check to show the date in header', 'colormag' ),
		'section'  => 'colormag_date_display_section',
		'settings' => 'colormag_date_display',
	) );

	// Selective refresh for date display
	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'colormag_date_display', array(
			'selector'        => '.date-in-header',
			'render_callback' => 'colormag_date_display',
		) );
	}

	// date in header display type
	$wp_customize->add_setting( 'colormag_date_display_type', array(
		'default'           => 'theme_default',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'colormag_radio_select_sanitize',
		'transport'         => $customizer_selective_refresh,
	) );

	$wp_customize->add_control( 'colormag_date_display_type', array(
		'type'     => 'radio',
		'label'    => esc_html__( 'Date in header display type:', 'colormag' ),
		'choices'  => array(
			'theme_default'          => esc_html__( 'Theme Default Setting', 'colormag' ),
			'wordpress_date_setting' => esc_html__( 'From WordPress Date Setting', 'colormag' ),
		),
		'section'  => 'colormag_date_display_section',
		'settings' => 'colormag_date_display_type',
	) );

	// Selective refresh for date display type
	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'colormag_date_display_type', array(
			'selector'        => '.date-in-header',
			'render_callback' => 'colormag_date_display_type',
		) );
	}

	// home icon enable/disable in primary menu
	$wp_customize->add_section( 'colormag_home_icon_display_section', array(
		'title' => __( 'Show Home Icon', 'colormag' ),
		'panel' => 'colormag_header_options',
	) );

	$wp_customize->add_setting( 'colormag_home_icon_display', array(
		'priority'          => 3,
		'default'           => 0,
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'colormag_checkbox_sanitize',
		'transport'         => $customizer_selective_refresh,
	) );

	$wp_customize->add_control( 'colormag_home_icon_display', array(
		'type'     => 'checkbox',
		'label'    => __( 'Check to show the home icon in the primary menu', 'colormag' ),
		'section'  => 'colormag_home_icon_display_section',
		'settings' => 'colormag_home_icon_display',
	) );

	// Selective refresh for displaying home icon
	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'colormag_home_icon_display', array(
			'selector'        => '.home-icon',
			'render_callback' => '',
		) );
	}

	// primary sticky menu enable/disable
	$wp_customize->add_section( 'colormag_primary_sticky_menu_section', array(
		'title' => __( 'Sticky Menu', 'colormag' ),
		'panel' => 'colormag_header_options',
	) );

	$wp_customize->add_setting( 'colormag_primary_sticky_menu', array(
		'priority'          => 4,
		'default'           => 0,
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'colormag_checkbox_sanitize',
	) );

	$wp_customize->add_control( 'colormag_primary_sticky_menu', array(
		'type'     => 'checkbox',
		'label'    => __( 'Check to enable the sticky behavior of the primary menu', 'colormag' ),
		'section'  => 'colormag_primary_sticky_menu_section',
		'settings' => 'colormag_primary_sticky_menu',
	) );

	// search icon in menu enable/disable
	$wp_customize->add_section( 'colormag_search_icon_in_menu_section', array(
		'title' => __( 'Search Icon', 'colormag' ),
		'panel' => 'colormag_header_options',
	) );

	$wp_customize->add_setting( 'colormag_search_icon_in_menu', array(
		'priority'          => 5,
		'default'           => 0,
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'colormag_checkbox_sanitize',
	) );

	$wp_customize->add_control( 'colormag_search_icon_in_menu', array(
		'type'     => 'checkbox',
		'label'    => __( 'Check to display the Search Icon in the primary menu', 'colormag' ),
		'section'  => 'colormag_search_icon_in_menu_section',
		'settings' => 'colormag_search_icon_in_menu',
	) );

	// random posts in menu enable/disable
	$wp_customize->add_section( 'colormag_random_post_in_menu_section', array(
		'title' => __( 'Random Post', 'colormag' ),
		'panel' => 'colormag_header_options',
	) );

	$wp_customize->add_setting( 'colormag_random_post_in_menu', array(
		'priority'          => 6,
		'default'           => 0,
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'colormag_checkbox_sanitize',
		'transport'         => $customizer_selective_refresh,
	) );

	$wp_customize->add_control( 'colormag_random_post_in_menu', array(
		'type'     => 'checkbox',
		'label'    => __( 'Check to display the Random Post Icon in the primary menu', 'colormag' ),
		'section'  => 'colormag_random_post_in_menu_section',
		'settings' => 'colormag_random_post_in_menu',
	) );

	// Selective refresh for displaying random post icon
	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'colormag_random_post_in_menu', array(
			'selector'        => '.random-post',
			'render_callback' => 'colormag_random_post',
		) );
	}

	// Responsive new menu enable/disable
	$wp_customize->add_section( 'colormag_responsive_menu_section', array(
		'title' => esc_html__( 'Responsive Menu Style', 'colormag' ),
		'panel' => 'colormag_header_options',
	) );

	$wp_customize->add_setting( 'colormag_responsive_menu', array(
		'priority'          => 7,
		'default'           => 0,
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'colormag_checkbox_sanitize',
	) );

	$wp_customize->add_control( 'colormag_responsive_menu', array(
		'type'     => 'checkbox',
		'label'    => esc_html__( 'Check to switch to new responsive menu.', 'colormag' ),
		'section'  => 'colormag_responsive_menu_section',
		'settings' => 'colormag_responsive_menu',
	) );

	$wp_customize->add_setting( 'colormag_header_logo_placement', array(
		'default'           => 'header_text_only',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'colormag_show_radio_saniztize',
	) );

	$wp_customize->add_control( 'colormag_header_logo_placement', array(
		'type'    => 'radio',
		'label'   => __( 'Choose the option that you want', 'colormag' ),
		'section' => 'title_tagline',
		'choices' => array(
			'header_logo_only' => __( 'Header Logo Only', 'colormag' ),
			'header_text_only' => __( 'Header Text Only', 'colormag' ),
			'show_both'        => __( 'Show Both', 'colormag' ),
			'disable'          => __( 'Disable', 'colormag' ),
		),
	) );

	// Main total Header area display type
	$wp_customize->add_section( 'colormag_main_total_header_area_display_type_option', array(
		'priority' => 4,
		'title'    => esc_html__( 'Main Header Area Display Type', 'colormag' ),
		'panel'    => 'colormag_header_options',
	) );

	$wp_customize->add_setting( 'colormag_main_total_header_area_display_type', array(
		'default'           => 'type_one',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'colormag_radio_select_sanitize',
	) );

	$wp_customize->add_control( new COLORMAG_Image_Radio_Control( $wp_customize, 'colormag_main_total_header_area_display_type', array(
		'type'    => 'radio',
		'label'   => esc_html__( 'Choose the main total header area display type that you want', 'colormag' ),
		'section' => 'colormag_main_total_header_area_display_type_option',
		'choices' => array(
			'type_one'   => COLORMAG_ADMIN_IMAGES_URL . '/header-variation-1.png',
			'type_two'   => COLORMAG_ADMIN_IMAGES_URL . '/header-variation-2.png',
			'type_three' => COLORMAG_ADMIN_IMAGES_URL . '/header-variation-3.png',
		),
	) ) );

	// header image position setting
	$wp_customize->add_section( 'colormag_header_image_position_setting', array(
		'priority' => 6,
		'title'    => __( 'Header Image Position', 'colormag' ),
		'panel'    => 'colormag_header_options',
	) );

	$wp_customize->add_setting( 'colormag_header_image_position', array(
		'default'           => 'position_two',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'colormag_header_image_position_sanitize',
	) );

	$wp_customize->add_control( 'colormag_header_image_position', array(
		'type'    => 'radio',
		'label'   => __( 'Header image display position', 'colormag' ),
		'section' => 'colormag_header_image_position_setting',
		'choices' => array(
			'position_one'   => __( 'Display the Header image just above the site title/text.', 'colormag' ),
			'position_two'   => __( 'Default: Display the Header image between site title/text and the main/primary menu.', 'colormag' ),
			'position_three' => __( 'Display the Header image below main/primary menu.', 'colormag' ),
		),
	) );

	$wp_customize->add_setting( 'colormag_header_image_link', array(
		'default'           => 0,
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'colormag_checkbox_sanitize',
	) );

	$wp_customize->add_control( 'colormag_header_image_link', array(
		'type'    => 'checkbox',
		'label'   => __( 'Check to make header image link back to home page', 'colormag' ),
		'section' => 'colormag_header_image_position_setting',
	) );

	// Start of the Design Options
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
		'sanitize_callback' => 'colormag_checkbox_sanitize',
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
		'sanitize_callback' => 'colormag_site_layout_sanitize',
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
		'sanitize_callback' => 'colormag_layout_sanitize',
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
		'sanitize_callback' => 'colormag_layout_sanitize',
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
		'sanitize_callback' => 'colormag_layout_sanitize',
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
		'default'              => '#289dcc',
		'capability'           => 'edit_theme_options',
		'sanitize_callback'    => 'colormag_color_option_hex_sanitize',
		'sanitize_js_callback' => 'colormag_color_escaping_option_sanitize',
		'transport'            => 'postMessage',
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
		'sanitize_callback' => 'colormag_radio_select_sanitize',
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

	if ( ! function_exists( 'wp_update_custom_css_post' ) ) {

		$wp_customize->add_section( 'colormag_custom_css_setting', array(
			'priority' => 9,
			'title'    => __( 'Custom CSS', 'colormag' ),
			'panel'    => 'colormag_design_options',
		) );

		$wp_customize->add_setting( 'colormag_custom_css', array(
			'default'              => '',
			'capability'           => 'edit_theme_options',
			'sanitize_callback'    => 'wp_filter_nohtml_kses',
			'sanitize_js_callback' => 'wp_filter_nohtml_kses',
		) );

		$wp_customize->add_control( new COLORMAG_Custom_CSS_Control( $wp_customize, 'colormag_custom_css', array(
			'label'    => __( 'Write your Custom CSS', 'colormag' ),
			'section'  => 'colormag_custom_css_setting',
			'settings' => 'colormag_custom_css',
		) ) );
	}
	// End of the Design Options
	// Start of the Social Link Options
	$wp_customize->add_panel( 'colormag_social_links_options', array(
		'priority'    => 510,
		'title'       => __( 'Social Options', 'colormag' ),
		'description' => __( 'Change the Social Links settings from here as you want', 'colormag' ),
		'capability'  => 'edit_theme_options',
	) );

	$wp_customize->add_section( 'colormag_social_link_activate_settings', array(
		'priority' => 1,
		'title'    => __( 'Activate social links area', 'colormag' ),
		'panel'    => 'colormag_social_links_options',
	) );

	$wp_customize->add_setting( 'colormag_social_link_activate', array(
		'default'           => 0,
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'colormag_checkbox_sanitize',
		'transport'         => $customizer_selective_refresh,
	) );

	$wp_customize->add_control( 'colormag_social_link_activate', array(
		'type'     => 'checkbox',
		'label'    => __( 'Check to activate social links area', 'colormag' ),
		'section'  => 'colormag_social_link_activate_settings',
		'settings' => 'colormag_social_link_activate',
	) );

	// Social link location option.
	$wp_customize->add_setting( 'colormag_social_link_location_option', array(
		'default'           => 'both',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'colormag_radio_select_sanitize',
	) );

	$wp_customize->add_control( 'colormag_social_link_location_option', array(
		'type'     => 'radio',
		'label'    => esc_html__( 'Social links to display on:', 'colormag' ),
		'section'  => 'colormag_social_link_activate_settings',
		'settings' => 'colormag_social_link_location_option',
		'choices'  => array(
			'header' => esc_html__( 'Header only', 'colormag' ),
			'footer' => esc_html__( 'Footer only', 'colormag' ),
			'both'   => esc_html__( 'Both header and footer', 'colormag' ),
		),
	) );

	// Selective refresh for displaying social icons/links
	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'colormag_social_link_activate', array(
			'selector'        => '.social-links',
			'render_callback' => '',
		) );
	}

	$colormag_social_links = array(
		'colormag_social_facebook'   => array(
			'id'      => 'colormag_social_facebook',
			'title'   => __( 'Facebook', 'colormag' ),
			'default' => '',
		),
		'colormag_social_twitter'    => array(
			'id'      => 'colormag_social_twitter',
			'title'   => __( 'Twitter', 'colormag' ),
			'default' => '',
		),
		'colormag_social_googleplus' => array(
			'id'      => 'colormag_social_googleplus',
			'title'   => __( 'Google-Plus', 'colormag' ),
			'default' => '',
		),
		'colormag_social_instagram'  => array(
			'id'      => 'colormag_social_instagram',
			'title'   => __( 'Instagram', 'colormag' ),
			'default' => '',
		),
		'colormag_social_pinterest'  => array(
			'id'      => 'colormag_social_pinterest',
			'title'   => __( 'Pinterest', 'colormag' ),
			'default' => '',
		),
		'colormag_social_youtube'    => array(
			'id'      => 'colormag_social_youtube',
			'title'   => __( 'YouTube', 'colormag' ),
			'default' => '',
		),
	);

	$i = 20;

	foreach ( $colormag_social_links as $colormag_social_link ) {

		$wp_customize->add_setting( $colormag_social_link['id'], array(
			'default'           => $colormag_social_link['default'],
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'esc_url_raw',
		) );

		$wp_customize->add_control( $colormag_social_link['id'], array(
			'label'    => $colormag_social_link['title'],
			'section'  => 'colormag_social_link_activate_settings',
			'settings' => $colormag_social_link['id'],
			'priority' => $i,
		) );

		$wp_customize->add_setting( $colormag_social_link['id'] . '_checkbox', array(
			'default'           => 0,
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'colormag_checkbox_sanitize',
		) );

		$wp_customize->add_control( $colormag_social_link['id'] . '_checkbox', array(
			'type'     => 'checkbox',
			'label'    => __( 'Check to open in new tab', 'colormag' ),
			'section'  => 'colormag_social_link_activate_settings',
			'settings' => $colormag_social_link['id'] . '_checkbox',
			'priority' => $i,
		) );

		$i ++;
	}
	// End of the Social Link Options
	// Start of the Footer Options
	$wp_customize->add_panel( 'colormag_footer_options', array(
		'capability'  => 'edit_theme_options',
		'description' => esc_html__( 'Change the Footer Settings from here as you want', 'colormag' ),
		'priority'    => 515,
		'title'       => esc_html__( 'Footer Options', 'colormag' ),
	) );

	// Footer display type option
	$wp_customize->add_section( 'colormag_main_footer_layout_display_type_section', array(
		'priority' => 1,
		'title'    => esc_html__( 'Footer Main Area Display Type', 'colormag' ),
		'panel'    => 'colormag_footer_options',
	) );

	$wp_customize->add_setting( 'colormag_main_footer_layout_display_type', array(
		'default'           => 'type_one',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'colormag_radio_select_sanitize',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( 'colormag_main_footer_layout_display_type', array(
		'type'    => 'radio',
		'label'   => esc_html__( 'Choose the main total footer area display type that you want', 'colormag' ),
		'section' => 'colormag_main_footer_layout_display_type_section',
		'choices' => array(
			'type_one' => esc_html__( 'Type 1 (Default)', 'colormag' ),
			'type_two' => esc_html__( 'Type 2', 'colormag' ),
		),
	) );
	// End of Footer Options
	// Start of the Additional Options
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
		'sanitize_callback' => 'colormag_checkbox_sanitize',
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
		'sanitize_callback' => 'colormag_related_posts_sanitize',
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
		'sanitize_callback' => 'colormag_checkbox_sanitize',
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
		'sanitize_callback' => 'colormag_checkbox_sanitize',
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
		'sanitize_callback' => 'colormag_checkbox_sanitize',
	) );

	$wp_customize->add_control( 'colormag_featured_image_single_page_show', array(
		'type'     => 'checkbox',
		'label'    => esc_html__( 'Check to display the featured image in single page.', 'colormag' ),
		'section'  => 'colormag_featured_image_show_setting_single_page',
		'settings' => 'colormag_featured_image_single_page_show',
	) );
	// End of the Additional Options
	// Category Color Options
	$wp_customize->add_panel( 'colormag_category_color_panel', array(
		'priority'    => 535,
		'title'       => __( 'Category Color Options', 'colormag' ),
		'capability'  => 'edit_theme_options',
		'description' => __( 'Change the color of each category items as you want.', 'colormag' ),
	) );

	$wp_customize->add_section( 'colormag_category_color_setting', array(
		'priority' => 1,
		'title'    => __( 'Category Color Settings', 'colormag' ),
		'panel'    => 'colormag_category_color_panel',
	) );

	$i                = 1;
	$args             = array(
		'orderby'    => 'id',
		'hide_empty' => 0,
	);
	$categories       = get_categories( $args );
	$wp_category_list = array();
	foreach ( $categories as $category_list ) {
		$wp_category_list[ $category_list->cat_ID ] = $category_list->cat_name;

		$wp_customize->add_setting( 'colormag_category_color_' . get_cat_id( $wp_category_list[ $category_list->cat_ID ] ), array(
			'default'              => '',
			'capability'           => 'edit_theme_options',
			'sanitize_callback'    => 'colormag_color_option_hex_sanitize',
			'sanitize_js_callback' => 'colormag_color_escaping_option_sanitize',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'colormag_category_color_' . get_cat_id( $wp_category_list[ $category_list->cat_ID ] ), array(
			'label'    => sprintf( __( '%s', 'colormag' ), $wp_category_list[ $category_list->cat_ID ] ),
			'section'  => 'colormag_category_color_setting',
			'settings' => 'colormag_category_color_' . get_cat_id( $wp_category_list[ $category_list->cat_ID ] ),
			'priority' => $i,
		) ) );
		$i ++;
	}

	// sanitization works
	// radio/select buttons sanitization
	function colormag_radio_select_sanitize( $input, $setting ) {
		// Ensuring that the input is a slug.
		$input = sanitize_key( $input );
		// Get the list of choices from the control associated with the setting.
		$choices = $setting->manager->get_control( $setting->id )->choices;

		// If the input is a valid key, return it, else, return the default.
		return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
	}

	// radio button sanitization
	function colormag_related_posts_sanitize( $input ) {
		$valid_keys = array(
			'categories' => __( 'Related Posts By Categories', 'colormag' ),
			'tags'       => __( 'Related Posts By Tags', 'colormag' ),
		);
		if ( array_key_exists( $input, $valid_keys ) ) {
			return $input;
		} else {
			return '';
		}
	}

	function colormag_show_radio_saniztize( $input ) {
		$valid_keys = array(
			'header_logo_only' => __( 'Header Logo Only', 'colormag' ),
			'header_text_only' => __( 'Header Text Only', 'colormag' ),
			'show_both'        => __( 'Show Both', 'colormag' ),
			'disable'          => __( 'Disable', 'colormag' ),
		);
		if ( array_key_exists( $input, $valid_keys ) ) {
			return $input;
		} else {
			return '';
		}
	}

	function colormag_header_image_position_sanitize( $input ) {
		$valid_keys = array(
			'position_one'   => __( 'Display the Header image just above the site title/text.', 'colormag' ),
			'position_two'   => __( 'Default: Display the Header image between site title/text and the main/primary menu.', 'colormag' ),
			'position_three' => __( 'Display the Header image below main/primary menu.', 'colormag' ),
		);
		if ( array_key_exists( $input, $valid_keys ) ) {
			return $input;
		} else {
			return '';
		}
	}

	function colormag_site_layout_sanitize( $input ) {
		$valid_keys = array(
			'boxed_layout' => __( 'Boxed Layout', 'colormag' ),
			'wide_layout'  => __( 'Wide Layout', 'colormag' ),
		);
		if ( array_key_exists( $input, $valid_keys ) ) {
			return $input;
		} else {
			return '';
		}
	}

	function colormag_layout_sanitize( $input ) {
		$valid_keys = array(
			'right_sidebar'               => COLORMAG_ADMIN_IMAGES_URL . '/right-sidebar.png',
			'left_sidebar'                => COLORMAG_ADMIN_IMAGES_URL . '/left-sidebar.png',
			'no_sidebar_full_width'       => COLORMAG_ADMIN_IMAGES_URL . '/no-sidebar-full-width-layout.png',
			'no_sidebar_content_centered' => COLORMAG_ADMIN_IMAGES_URL . '/no-sidebar-content-centered-layout.png',
		);
		if ( array_key_exists( $input, $valid_keys ) ) {
			return $input;
		} else {
			return '';
		}
	}

	// color sanitization
	function colormag_color_option_hex_sanitize( $color ) {
		if ( $unhashed = sanitize_hex_color_no_hash( $color ) ) {
			return '#' . $unhashed;
		}

		return $color;
	}

	function colormag_color_escaping_option_sanitize( $input ) {
		$input = esc_attr( $input );

		return $input;
	}

	// checkbox sanitization
	function colormag_checkbox_sanitize( $input ) {
		if ( $input == 1 ) {
			return 1;
		} else {
			return '';
		}
	}

	// sanitization of links
	function colormag_links_sanitize() {
		return false;
	}

}

add_action( 'customize_register', 'colormag_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 *
 * @since ColorMag 1.2.4
 */

function colormag_customize_preview_js() {
	wp_enqueue_script( 'colormag-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), false, true );
}

add_action( 'customize_preview_init', 'colormag_customize_preview_js' );

/* * ************************************************************************************** */

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function colormag_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function colormag_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Render the breaking news display type for selective refresh partial
 *
 * @return void
 */
function colormag_date_display_type() {
	// Return if date display option is not enabled
	if ( get_theme_mod( 'colormag_date_display', 0 ) == 0 ) {
		return;
	}

	if ( get_theme_mod( 'colormag_date_display_type', 'theme_default' ) == 'theme_default' ) {
		echo date_i18n( 'l, F j, Y' );
	} elseif ( get_theme_mod( 'colormag_date_display_type', 'theme_default' ) == 'wordpress_date_setting' ) {
		echo date_i18n( get_option( 'date_format' ) );
	}
}

/* * ************************************************************************************** */

/*
 * Custom Scripts
 */
add_action( 'customize_controls_print_footer_scripts', 'colormag_customizer_custom_scripts' );

function colormag_customizer_custom_scripts() {
	?>
	<style>
		/* Theme Instructions Panel CSS */
		li#accordion-section-colormag_upsell_section h3.accordion-section-title {
			background-color: #289DCC !important;
			border-left-color: #0073aa;
			color: #fff !important;
		}

		#accordion-section-colormag_upsell_section h3 a:after {
			content: '\f345';
			color: #fff;
			position: absolute;
			top: 12px;
			right: 10px;
			z-index: 1;
			font: 400 20px/1 dashicons;
			speak: none;
			display: block;
			-webkit-font-smoothing: antialiased;
			-moz-osx-font-smoothing: grayscale;
			text-decoration: none !important;
		}

		li#accordion-section-colormag_upsell_section h3.accordion-section-title a {
			color: #fff;
			display: block;
			text-decoration: none;
		}

		li#accordion-section-colormag_upsell_section h3.accordion-section-title a:focus {
			box-shadow: none;
		}

		li#accordion-section-colormag_upsell_section h3.accordion-section-title:hover {
			background-color: #1f91bf !important;
			border-left-color: #0073aa !important;
			color: #fff !important;
		}

		li#accordion-section-colormag_upsell_section h3.accordion-section-title:after {
			color: #fff !important;
		}

		/* Upsell button CSS */
		.themegrill-pro-info,
		.customize-control-colormag-important-links a {
			/* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#8fc800+0,8fc800+100;Green+Flat+%232 */
			background: #008EC2;
			color: #fff;
			display: block;
			margin: 15px 0 0;
			padding: 5px 0;
			text-align: center;
			font-weight: 600;
		}

		.customize-control-colormag-important-links a {
			padding: 8px 0;
		}

		.themegrill-pro-info:hover,
		.customize-control-colormag-important-links a:hover {
			color: #ffffff;
			/* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#006e2e+0,006e2e+100;Green+Flat+%233 */
			background: #2380BA;
		}
	</style>

	<script>
		( function ( $, api ) {
			api.sectionConstructor['colormag-upsell-section'] = api.Section.extend( {

				// No events for this type of section.
				attachEvents : function () {
				},

				// Always make the section active.
				isContextuallyActive : function () {
					return true;
				}
			} );
		} )( jQuery, wp.customize );

	</script>
	<?php
}
