<?php
/**
 * Class to include Social customize options.
 *
 * Class ColorMag_Customize_Social_Icons_Options
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
 * Class to include Social customize option.
 *
 * Class ColorMag_Customize_Social_Icons_Options
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
	public function register_options( $options, $wp_customize ) {

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
				'section'   => 'colormag_social_icons_section',
				'transport' => $customizer_selective_refresh,
				'partial'   => array(
					'selector' => '.social-links',
				),
				'priority'  => 5,
			),

			// Social links location option.
			array(
				'name'       => 'colormag_social_link_location_option',
				'default'    => 'both',
				'type'       => 'control',
				'control'    => 'radio',
				'label'      => esc_html__( 'Social links to display on:', 'colormag' ),
				'section'    => 'colormag_social_icons_section',
				'choices'    => array(
					'header' => esc_html__( 'Header only', 'colormag' ),
					'footer' => esc_html__( 'Footer only', 'colormag' ),
					'both'   => esc_html__( 'Both header and footer', 'colormag' ),
				),
				'dependency' => array(
					'colormag_social_link_activate',
					'!=',
					0,
				),
				'priority'   => 10,
			),

			// Social links separator.
			array(
				'name'       => 'colormag_social_link_separator',
				'type'       => 'control',
				'control'    => 'colormag-divider',
				'section'    => 'colormag_social_icons_section',
				'dependency' => array(
					'colormag_social_link_activate',
					'!=',
					0,
				),
				'priority'   => 15,
			),

		);

		$options = array_merge( $options, $configs );

		// Social links lists.
		$social_links_count    = 20;
		$colormag_social_links = array(
			'colormag_social_facebook'   => array(
				'id'      => 'colormag_social_facebook',
				'title'   => esc_html__( 'Facebook', 'colormag' ),
				'default' => '',
			),
			'colormag_social_twitter'    => array(
				'id'      => 'colormag_social_twitter',
				'title'   => esc_html__( 'Twitter', 'colormag' ),
				'default' => '',
			),
			'colormag_social_googleplus' => array(
				'id'      => 'colormag_social_googleplus',
				'title'   => esc_html__( 'Google-Plus', 'colormag' ),
				'default' => '',
			),
			'colormag_social_instagram'  => array(
				'id'      => 'colormag_social_instagram',
				'title'   => esc_html__( 'Instagram', 'colormag' ),
				'default' => '',
			),
			'colormag_social_pinterest'  => array(
				'id'      => 'colormag_social_pinterest',
				'title'   => esc_html__( 'Pinterest', 'colormag' ),
				'default' => '',
			),
			'colormag_social_youtube'    => array(
				'id'      => 'colormag_social_youtube',
				'title'   => esc_html__( 'YouTube', 'colormag' ),
				'default' => '',
			),
		);

		// Available social links via theme.
		foreach ( $colormag_social_links as $colormag_social_link ) {

			// Social links url option.
			$configs[] = array(
				'name'       => $colormag_social_link['id'],
				'default'    => $colormag_social_link['default'],
				'type'       => 'control',
				'control'    => 'url',
				'label'      => $colormag_social_link['title'],
				'section'    => 'colormag_social_icons_section',
				'dependency' => array(
					'colormag_social_link_activate',
					'!=',
					0,
				),
				'priority'   => $social_links_count,
			);

			// Social links open in new tab enable/disable option.
			$configs[] = array(
				'name'       => $colormag_social_link['id'] . '_checkbox',
				'default'    => 0,
				'type'       => 'control',
				'control'    => 'checkbox',
				'label'      => esc_html__( 'Check to open in new tab', 'colormag' ),
				'section'    => 'colormag_social_icons_section',
				'dependency' => array(
					'colormag_social_link_activate',
					'!=',
					0,
				),
				'priority'   => $social_links_count,
			);

			// Social links separator.
			$configs[] = array(
				'name'       => $colormag_social_link['id'] . '_separator',
				'type'       => 'control',
				'control'    => 'colormag-divider',
				'section'    => 'colormag_social_icons_section',
				'dependency' => array(
					'colormag_social_link_activate',
					'!=',
					0,
				),
				'priority'   => $social_links_count,
			);

			$social_links_count ++;

		}

		$options = array_merge( $options, $configs );

		return $options;

	}

}

return new ColorMag_Customize_Social_Options();