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
	 * @param array                 $options      Customize options provided via the theme.
	 * @param \WP_Customize_Manager $wp_customize Theme Customizer object.
	 *
	 * @return mixed|void Customizer options for registering panels, sections as well as controls.
	 */
	public function customizer_options( $options, $wp_customize ) {

		// Customize transport postMessage variable to set `postMessage` or `refresh` as required.
		$customizer_selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';

		$configs = array(

			// Social links enable/disable option.
			array(
				'name'      => 'colormag_social_link_activate',
				'default'   => 0,
				'type'      => 'control',
				'control'   => 'checkbox',
				'label'     => esc_html__( 'Check to activate social links area', 'colormag' ),
				'section'   => 'colormag_social_link_activate_settings',
				'transport' => $customizer_selective_refresh,
				'partial'   => array(
					'selector' => '.social-links',
				),
			),

			// Social links location option.
			array(
				'name'    => 'colormag_social_link_location_option',
				'default' => 'both',
				'type'    => 'control',
				'control' => 'radio',
				'label'   => esc_html__( 'Social links to display on:', 'colormag' ),
				'section' => 'colormag_social_link_activate_settings',
				'choices' => array(
					'header' => esc_html__( 'Header only', 'colormag' ),
					'footer' => esc_html__( 'Footer only', 'colormag' ),
					'both'   => esc_html__( 'Both header and footer', 'colormag' ),
				),
			),

		);

		$options = array_merge( $options, $configs );

		return $options;

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
