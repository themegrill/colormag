<?php
/**
 * Class to include Social customize options.
 *
 * Class ColorMag_Customize_Social_Icons_Options
 *
 * @package    ThemeGrill
 * @subpackage ColorMag
 * @since      ColorMag 3.0.0
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
class ColorMag_Customize_Social_Icons_Options extends ColorMag_Customize_Base_Option {

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

			/**
			 * Social Icons.
			 */
			array(
				'name'     => 'colormag_social_icons_heading',
				'type'     => 'control',
				'control'  => 'colormag-title',
				'label'    => esc_html__( 'Social Icons', 'colormag' ),
				'section'  => 'colormag_social_icons_section',
				'priority' => 5,
			),

			// Social links enable/disable option.
			array(
				'name'        => 'colormag_enable_social_icons',
				'default'     => 0,
				'type'        => 'control',
				'control'     => 'colormag-toggle',
				'label'       => esc_html__( 'Enable', 'colormag' ),
				'description' => esc_html__( 'Check to activate social links area', 'colormag' ),
				'section'     => 'colormag_social_icons_section',
				'transport'   => $customizer_selective_refresh,
				'partial'     => array(
					'selector' => '.social-links',
				),
				'priority'    => 10,
			),

			array(
				'name'       => 'colormag_social_icons_position_heading',
				'type'       => 'control',
				'control'    => 'colormag-title',
				'label'      => esc_html__( 'Position', 'colormag' ),
				'section'    => 'colormag_social_icons_section',
				'priority'   => 20,
				'dependency' => array(
					'colormag_enable_social_icons',
					'!=',
					0,
				),
			),

			array(
				'name'       => 'colormag_enable_social_icons_header',
				'default'    => 1,
				'type'       => 'control',
				'control'    => 'colormag-toggle',
				'label'      => esc_html__( 'Header', 'colormag' ),
				'section'    => 'colormag_social_icons_section',
				'transport'  => $customizer_selective_refresh,
				'partial'    => array(
					'selector' => '.social-links',
				),
				'priority'   => 30,
				'dependency' => array(
					'colormag_enable_social_icons',
					'!=',
					0,
				),
			),

			array(
				'name'       => 'colormag_social_icons_header_location',
				'default'    => 'top-bar',
				'type'       => 'control',
				'control'    => 'select',
				'section'    => 'colormag_social_icons_section',
				'choices'    => array(
					'top-bar' => esc_html__( 'Top Bar', 'colormag' ),
					'menu'    => esc_html__( 'Menu', 'colormag' ),
				),
				'dependency' => array(
					'colormag_enable_social_icons_header',
					'!=',
					0,
				),
				'priority'   => 40,
			),

			array(
				'name'       => 'colormag_enable_social_icons_footer',
				'default'    => 1,
				'type'       => 'control',
				'control'    => 'colormag-toggle',
				'label'      => esc_html__( 'Footer', 'colormag' ),
				'section'    => 'colormag_social_icons_section',
				'transport'  => $customizer_selective_refresh,
				'partial'    => array(
					'selector' => '.social-links',
				),
				'priority'   => 50,
				'dependency' => array(
					'colormag_enable_social_icons',
					'!=',
					0,
				),
			),

			// Social links separator.
			array(
				'name'       => 'colormag_social_link_separator',
				'type'       => 'control',
				'control'    => 'colormag-divider',
				'section'    => 'colormag_social_icons_section',
				'dependency' => array(
					'colormag_enable_social_icons',
					'!=',
					0,
				),
				'priority'   => 60,
			),

		);

		$options = array_merge( $options, $configs );

		// Social links lists.
		$social_links_count    = 70;
		$colormag_social_links = array(
			'colormag_social_facebook'    => array(
				'id'      => 'colormag_social_facebook',
				'title'   => esc_html__( 'Facebook', 'colormag' ),
				'default' => '',
			),
			'colormag_social_twitter'     => array(
				'id'      => 'colormag_social_twitter',
				'title'   => esc_html__( 'Twitter', 'colormag' ),
				'default' => '',
			),
			'colormag_social_googleplus'  => array(
				'id'      => 'colormag_social_googleplus',
				'title'   => esc_html__( 'Google-Plus', 'colormag' ),
				'default' => '',
			),
			'colormag_social_instagram'   => array(
				'id'      => 'colormag_social_instagram',
				'title'   => esc_html__( 'Instagram', 'colormag' ),
				'default' => '',
			),
			'colormag_social_pinterest'   => array(
				'id'      => 'colormag_social_pinterest',
				'title'   => esc_html__( 'Pinterest', 'colormag' ),
				'default' => '',
			),
			'colormag_social_youtube'     => array(
				'id'      => 'colormag_social_youtube',
				'title'   => esc_html__( 'YouTube', 'colormag' ),
				'default' => '',
			),
			'colormag_social_vimeo'       => array(
				'id'      => 'colormag_social_vimeo',
				'title'   => esc_html__( 'Vimeo-Square', 'colormag' ),
				'default' => '',
			),
			'colormag_social_linkedin'    => array(
				'id'      => 'colormag_social_linkedin',
				'title'   => esc_html__( 'LinkedIn', 'colormag' ),
				'default' => '',
			),
			'colormag_social_delicious'   => array(
				'id'      => 'colormag_social_delicious',
				'title'   => esc_html__( 'Delicious', 'colormag' ),
				'default' => '',
			),
			'colormag_social_flickr'      => array(
				'id'      => 'colormag_social_flickr',
				'title'   => esc_html__( 'Flickr', 'colormag' ),
				'default' => '',
			),
			'colormag_social_skype'       => array(
				'id'      => 'colormag_social_skype',
				'title'   => esc_html__( 'Skype', 'colormag' ),
				'default' => '',
			),
			'colormag_social_soundcloud'  => array(
				'id'      => 'colormag_social_soundcloud',
				'title'   => esc_html__( 'SoundCloud', 'colormag' ),
				'default' => '',
			),
			'colormag_social_vine'        => array(
				'id'      => 'colormag_social_vine',
				'title'   => esc_html__( 'Vine', 'colormag' ),
				'default' => '',
			),
			'colormag_social_stumbleupon' => array(
				'id'      => 'colormag_social_stumbleupon',
				'title'   => esc_html__( 'StumbleUpon', 'colormag' ),
				'default' => '',
			),
			'colormag_social_tumblr'      => array(
				'id'      => 'colormag_social_tumblr',
				'title'   => esc_html__( 'Tumblr', 'colormag' ),
				'default' => '',
			),
			'colormag_social_reddit'      => array(
				'id'      => 'colormag_social_reddit',
				'title'   => esc_html__( 'Reddit', 'colormag' ),
				'default' => '',
			),
			'colormag_social_xing'        => array(
				'id'      => 'colormag_social_xing',
				'title'   => esc_html__( 'Xing', 'colormag' ),
				'default' => '',
			),
			'colormag_social_vk'          => array(
				'id'      => 'colormag_social_vk',
				'title'   => esc_html__( 'VK', 'colormag' ),
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
					'colormag_enable_social_icons',
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
					'colormag_enable_social_icons',
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
					'colormag_enable_social_icons',
					'!=',
					0,
				),
				'priority'   => $social_links_count,
			);

			$social_links_count++;

		}

		$options = array_merge( $options, $configs );

		$configs = array(

			/**
			 * Additional social icons options.
			 */
			// Additional social icons heading separator.
			array(
				'name'       => 'colormag_additional_social_icons_heading',
				'type'       => 'control',
				'control'    => 'colormag-title',
				'label'      => esc_html__( 'Additional Social Icons', 'colormag' ),
				'section'    => 'colormag_social_icons_section',
				'dependency' => array(
					'colormag_enable_social_icons',
					'!=',
					0,
				),
				'priority'   => 140,
			),

		);

		$options = array_merge( $options, $configs );

		// Custom available social links.
		$additional_social_links_count = 150;
		$user_custom_social_links      = array(
			'user_custom_social_links_one'   => array(
				'id'      => 'user_custom_social_links_one',
				'title'   => esc_html__( 'Additional Social Link One', 'colormag' ),
				'default' => '',
			),
			'user_custom_social_links_two'   => array(
				'id'      => 'user_custom_social_links_two',
				'title'   => esc_html__( 'Additional Social Link Two', 'colormag' ),
				'default' => '',
			),
			'user_custom_social_links_three' => array(
				'id'      => 'user_custom_social_links_three',
				'title'   => esc_html__( 'Additional Social Link Three', 'colormag' ),
				'default' => '',
			),
			'user_custom_social_links_four'  => array(
				'id'      => 'user_custom_social_links_four',
				'title'   => esc_html__( 'Additional Social Link Four', 'colormag' ),
				'default' => '',
			),
			'user_custom_social_links_five'  => array(
				'id'      => 'user_custom_social_links_five',
				'title'   => esc_html__( 'Additional Social Link Five', 'colormag' ),
				'default' => '',
			),
			'user_custom_social_links_six'   => array(
				'id'      => 'user_custom_social_links_six',
				'title'   => esc_html__( 'Additional Social Link Six', 'colormag' ),
				'default' => '',
			),
		);

		// Custom available social links via theme.
		foreach ( $user_custom_social_links as $user_custom_social_link ) {

			// Social links url option.
			$configs[] = array(
				'name'       => $user_custom_social_link['id'],
				'default'    => $user_custom_social_link['default'],
				'type'       => 'control',
				'control'    => 'url',
				'label'      => $user_custom_social_link['title'],
				'section'    => 'colormag_social_icons_section',
				'dependency' => array(
					'colormag_enable_social_icons',
					'!=',
					0,
				),
				'priority'   => $additional_social_links_count,
			);

			// Social links fontawesome icon option.
			$configs[] = array(
				'name'       => $user_custom_social_link['id'] . '_fontawesome',
				'default'    => '',
				'type'       => 'control',
				'control'    => 'text',
				'label'      => esc_html__( 'Preferred Social Link FontAwesome Icon', 'colormag' ),
				'section'    => 'colormag_social_icons_section',
				'dependency' => array(
					'colormag_enable_social_icons',
					'!=',
					0,
				),
				'priority'   => $additional_social_links_count,
			);

			// Social links icon color option.
			$configs[] = array(
				'name'       => $user_custom_social_link['id'] . '_color',
				'default'    => '',
				'type'       => 'control',
				'control'    => 'colormag-color',
				'label'      => esc_html__( 'Preferred Social Link Color Option', 'colormag' ),
				'section'    => 'colormag_social_icons_section',
				'dependency' => array(
					'colormag_enable_social_icons',
					'!=',
					0,
				),
				'priority'   => $additional_social_links_count,
			);

			// Social links open in new tab enable/disable option.
			$configs[] = array(
				'name'       => $user_custom_social_link['id'] . '_checkbox',
				'default'    => 0,
				'type'       => 'control',
				'control'    => 'checkbox',
				'label'      => esc_html__( 'Check to open in new tab', 'colormag' ),
				'section'    => 'colormag_social_icons_section',
				'dependency' => array(
					'colormag_enable_social_icons',
					'!=',
					0,
				),
				'priority'   => $additional_social_links_count,
			);

			// Social links separator.
			$configs[] = array(
				'name'       => $user_custom_social_link['id'] . '_separator',
				'type'       => 'control',
				'control'    => 'colormag-divider',
				'section'    => 'colormag_social_icons_section',
				'dependency' => array(
					'colormag_enable_social_icons',
					'!=',
					0,
				),
				'priority'   => $additional_social_links_count,
			);

			$additional_social_links_count++;

		}

		$options = array_merge( $options, $configs );

		return $options;
	}

}

return new ColorMag_Customize_Social_Icons_Options();
