<?php

/**
 * ColorMag Theme Customizer
 *
 * @package    ThemeGrill
 * @subpackage ColorMag
 * @since      ColorMag 1.0
 */
function colormag_customize_register( $wp_customize ) {

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

}

add_action( 'customize_register', 'colormag_customize_register' );
