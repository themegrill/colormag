<?php
/**
 * Class to include Header customize options.
 *
 * Class ColorMag_Customize_Header_Options
 *
 * @package    ThemeGrill
 * @subpackage ColorMag
 * @since      ColorMag 2.0.0
 */

/**
 * Class to include Header customize option.
 *
 * Class ColorMag_Customize_Header_Options
 */
class ColorMag_Customize_Header_Options extends ColorMag_Customize_Base_Option {

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

			// Main total header area display type option.
			array(
				'name'    => 'colormag_main_total_header_area_display_type',
				'default' => 'type_one',
				'type'    => 'control',
				'control' => 'colormag-radio-image',
				'label'   => esc_html__( 'Choose the main total header area display type that you want', 'colormag' ),
				'section' => 'colormag_main_total_header_area_display_type_option',
				'choices' => array(
					'type_one'   => array(
						'label' => '',
						'url'   => COLORMAG_ADMIN_IMAGES_URL . '/header-variation-1.png',
					),
					'type_two'   => array(
						'label' => '',
						'url'   => COLORMAG_ADMIN_IMAGES_URL . '/header-variation-2.png',
					),
					'type_three' => array(
						'label' => '',
						'url'   => COLORMAG_ADMIN_IMAGES_URL . '/header-variation-3.png',
					),
				),
			),

			// Header image position option.
			array(
				'name'    => 'colormag_header_image_position',
				'default' => 'position_two',
				'type'    => 'control',
				'control' => 'radio',
				'label'   => esc_html__( 'Header image display position', 'colormag' ),
				'section' => 'colormag_header_image_position_setting',
				'choices' => array(
					'position_one'   => __( 'Display the Header image just above the site title/text.', 'colormag' ),
					'position_two'   => __( 'Default: Display the Header image between site title/text and the main/primary menu.', 'colormag' ),
					'position_three' => __( 'Display the Header image below main/primary menu.', 'colormag' ),
				),
			),

			// Header image link to home page option.
			array(
				'name'    => 'colormag_header_image_link',
				'default' => 0,
				'type'    => 'control',
				'control' => 'colormag-toggle',
				'label'   => esc_html__( 'Check to make header image link back to home page', 'colormag' ),
				'section' => 'colormag_header_image_position_setting',
			),

			// Breaking news in header enable/disable option.
			array(
				'name'    => 'colormag_breaking_news',
				'default' => 0,
				'type'    => 'control',
				'control' => 'colormag-toggle',
				'label'   => esc_html__( 'Check to enable the breaking news section', 'colormag' ),
				'section' => 'colormag_breaking_news_section',
			),

			// Date in header display option.
			array(
				'name'      => 'colormag_date_display',
				'default'   => 0,
				'type'      => 'control',
				'control'   => 'colormag-toggle',
				'label'     => esc_html__( 'Check to show the date in header', 'colormag' ),
				'section'   => 'colormag_date_display_section',
				'transport' => $customizer_selective_refresh,
				'partial'   => array(
					'selector'        => '.date-in-header',
					'render_callback' => array(
						'ColorMag_Customizer_Partials',
						'render_current_date',
					),
				),
			),

			// Date in header display type option.
			array(
				'name'      => 'colormag_date_display_type',
				'default'   => 'theme_default',
				'type'      => 'control',
				'control'   => 'radio',
				'label'     => esc_html__( 'Date in header display type:', 'colormag' ),
				'section'   => 'colormag_date_display_section',
				'transport' => $customizer_selective_refresh,
				'choices'   => array(
					'theme_default'          => esc_html__( 'Theme Default Setting', 'colormag' ),
					'wordpress_date_setting' => esc_html__( 'From WordPress Date Setting', 'colormag' ),
				),
				'partial'   => array(
					'selector'        => '.date-in-header',
					'render_callback' => array(
						'ColorMag_Customizer_Partials',
						'render_date_display_type',
					),
				),
			),

			// Home icon in menu display option.
			array(
				'name'      => 'colormag_home_icon_display',
				'default'   => 0,
				'type'      => 'control',
				'control'   => 'colormag-toggle',
				'label'     => esc_html__( 'Check to show the home icon in the primary menu', 'colormag' ),
				'section'   => 'colormag_home_icon_display_section',
				'transport' => $customizer_selective_refresh,
				'partial'   => array(
					'selector' => '.home-icon',
				),
			),

			// Primary sticky menu enable/disable option.
			array(
				'name'    => 'colormag_primary_sticky_menu',
				'default' => 0,
				'type'    => 'control',
				'control' => 'colormag-toggle',
				'label'   => esc_html__( 'Check to enable the sticky behavior of the primary menu', 'colormag' ),
				'section' => 'colormag_primary_sticky_menu_section',
			),

			// Search icon in menu display option.
			array(
				'name'    => 'colormag_search_icon_in_menu',
				'default' => 0,
				'type'    => 'control',
				'control' => 'colormag-toggle',
				'label'   => esc_html__( 'Check to display the Search Icon in the primary menu', 'colormag' ),
				'section' => 'colormag_search_icon_in_menu_section',
			),

			// Random posts icon in menu display option.
			array(
				'name'      => 'colormag_random_post_in_menu',
				'default'   => 0,
				'type'      => 'control',
				'control'   => 'colormag-toggle',
				'label'     => esc_html__( 'Check to display the Random Post Icon in the primary menu', 'colormag' ),
				'section'   => 'colormag_random_post_in_menu_section',
				'transport' => $customizer_selective_refresh,
				'partial'   => array(
					'selector'        => '.random-post',
					'render_callback' => array(
						'ColorMag_Customizer_Partials',
						'render_random_post',
					),
				),
			),

			// New responsive menu enable/disable option.
			array(
				'name'    => 'colormag_responsive_menu',
				'default' => 0,
				'type'    => 'control',
				'control' => 'colormag-toggle',
				'label'   => esc_html__( 'Check to switch to new responsive menu.', 'colormag' ),
				'section' => 'colormag_responsive_menu_section',
			),

		);

		$options = array_merge( $options, $configs );

		return $options;

		$wp_customize->add_setting( 'colormag_header_logo_placement', array(
			'default'           => 'header_text_only',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => array(
				'ColorMag_Customizer_Sanitizes',
				'sanitize_radio_select',
			),
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

	}

}

return new ColorMag_Customize_Header_Options();
