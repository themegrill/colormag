<?php
/**
 * Class to include Social customize options.
 *
 * Class ColorMag_Customize_Social_Options
 *
 * @package    ThemeGrill
 * @subpackage ColorMag
 * @since      ColorMag 2.0.0
 */

/**
 * Class to include Social customize option.
 *
 * Class ColorMag_Customize_Social_Options
 */
class ColorMag_Customize_Social_Options extends ColorMag_Customize_Base_Option {

	/**
	 * Include customize options.
	 *
	 * @param array                 $options
	 * @param \WP_Customize_Manager $wp_customize
	 *
	 * @return mixed|void
	 */
	public function customizer_options( $options, $wp_customize ) {

		// Transport postMessage variable set
		$customizer_selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';

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
			'sanitize_callback' => array(
				'ColorMag_Customizer_Sanitizes',
				'sanitize_checkbox',
			),
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
			'sanitize_callback' => array(
				'ColorMag_Customizer_Sanitizes',
				'sanitize_radio_select',
			),
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
				'sanitize_callback' => array(
					'ColorMag_Customizer_Sanitizes',
					'sanitize_checkbox',
				),
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

	}

}

return new ColorMag_Customize_Social_Options();
