<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class ColorMag_Customize_Review_Link_Options extends ColorMag_Customize_Base_Option {
	public function register_options( $options, $wp_customize ) {
		$configs = array(

			// View Pro Version section.
			array(
				'name'             => 'colormag_customize_review_link_section',
				'type'             => 'section',
				'title'            => esc_html__( 'Review', 'colormag' ),
				'url'              => 'https://wordpress.org/support/theme/colormag/reviews/#new-post',
				'priority'         => 200,
				'section_callback' => 'ColorMag_Upsell_Section',
			),

		);

		$options = array_merge( $options, $configs );

		return $options;
	}
}

return new ColorMag_Customize_Review_Link_Options();


