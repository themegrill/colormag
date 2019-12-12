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
	 * @param array                 $options
	 * @param \WP_Customize_Manager $wp_customize
	 *
	 * @return mixed|void
	 */
	public function customizer_options( $options, $wp_customize ) {

		$configs = array(

			// Breaking news in header enable/disable option.
			array(
				'name'     => 'colormag_breaking_news',
				'default'  => 0,
				'type'     => 'control',
				'control'  => 'checkbox',
				'label'    => esc_html__( 'Check to enable the breaking news section', 'colormag' ),
				'section'  => 'colormag_breaking_news_section',
				'priority' => 1,
			),

			// Main total header area display type option.
			array(
				'name'     => 'colormag_main_total_header_area_display_type',
				'default'  => 'type_one',
				'type'     => 'control',
				'control'  => 'colormag-radio-image',
				'label'    => esc_html__( 'Choose the main total header area display type that you want', 'colormag' ),
				'section'  => 'colormag_main_total_header_area_display_type_option',
				'priority' => 20,
				'choices'  => array(
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

		);

		$options = array_merge( $options, $configs );

		return $options;

		// Transport postMessage variable set
		$customizer_selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';

		$wp_customize->add_setting( 'colormag_date_display', array(
			'priority'          => 2,
			'default'           => 0,
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => array(
				'ColorMag_Customizer_Sanitizes',
				'sanitize_checkbox',
			),
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
			$wp_customize->selective_refresh->add_partial(
				'colormag_date_display',
				array(
					'selector'        => '.date-in-header',
					'render_callback' => array(
						'ColorMag_Customizer_Partials',
						'render_current_date',
					),
				)
			);
		}

		// date in header display type
		$wp_customize->add_setting( 'colormag_date_display_type', array(
			'default'           => 'theme_default',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => array(
				'ColorMag_Customizer_Sanitizes',
				'sanitize_radio_select',
			),
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
			$wp_customize->selective_refresh->add_partial(
				'colormag_date_display_type',
				array(
					'selector'        => '.date-in-header',
					'render_callback' => array(
						'ColorMag_Customizer_Partials',
						'render_date_display_type',
					),
				)
			);
		}

		$wp_customize->add_setting( 'colormag_home_icon_display', array(
			'priority'          => 3,
			'default'           => 0,
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => array(
				'ColorMag_Customizer_Sanitizes',
				'sanitize_checkbox',
			),
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

		$wp_customize->add_setting( 'colormag_primary_sticky_menu', array(
			'priority'          => 4,
			'default'           => 0,
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => array(
				'ColorMag_Customizer_Sanitizes',
				'sanitize_checkbox',
			),
		) );

		$wp_customize->add_control( 'colormag_primary_sticky_menu', array(
			'type'     => 'checkbox',
			'label'    => __( 'Check to enable the sticky behavior of the primary menu', 'colormag' ),
			'section'  => 'colormag_primary_sticky_menu_section',
			'settings' => 'colormag_primary_sticky_menu',
		) );

		$wp_customize->add_setting( 'colormag_search_icon_in_menu', array(
			'priority'          => 5,
			'default'           => 0,
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => array(
				'ColorMag_Customizer_Sanitizes',
				'sanitize_checkbox',
			),
		) );

		$wp_customize->add_control( 'colormag_search_icon_in_menu', array(
			'type'     => 'checkbox',
			'label'    => __( 'Check to display the Search Icon in the primary menu', 'colormag' ),
			'section'  => 'colormag_search_icon_in_menu_section',
			'settings' => 'colormag_search_icon_in_menu',
		) );

		$wp_customize->add_setting( 'colormag_random_post_in_menu', array(
			'priority'          => 6,
			'default'           => 0,
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => array(
				'ColorMag_Customizer_Sanitizes',
				'sanitize_checkbox',
			),
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
			$wp_customize->selective_refresh->add_partial(
				'colormag_random_post_in_menu',
				array(
					'selector'        => '.random-post',
					'render_callback' => array(
						'ColorMag_Customizer_Partials',
						'render_random_post',
					),
				)
			);
		}

		$wp_customize->add_setting( 'colormag_responsive_menu', array(
			'priority'          => 7,
			'default'           => 0,
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => array(
				'ColorMag_Customizer_Sanitizes',
				'sanitize_checkbox',
			),
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

		$wp_customize->add_setting( 'colormag_header_image_position', array(
			'default'           => 'position_two',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => array(
				'ColorMag_Customizer_Sanitizes',
				'sanitize_radio_select',
			),
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
			'sanitize_callback' => array(
				'ColorMag_Customizer_Sanitizes',
				'sanitize_checkbox',
			),
		) );

		$wp_customize->add_control( 'colormag_header_image_link', array(
			'type'    => 'checkbox',
			'label'   => __( 'Check to make header image link back to home page', 'colormag' ),
			'section' => 'colormag_header_image_position_setting',
		) );

	}

}

return new ColorMag_Customize_Header_Options();
