<?php
/**
 * Override default customizer panels, sections, settings or controls.
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
 * Override Sections.
 */
/**
 * Override controls.
 */

// Site Identity.
// Settings.
$wp_customize->get_setting( 'blogname' )->transport        = 'postMessage';
$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

if ( get_theme_mod( 'colormag_enable_builder', false ) || colormag_maybe_enable_builder() ) {
	$wp_customize->get_control( 'blogname' )->section         = 'colormag_header_builder_logo';
	$wp_customize->get_control( 'blogname' )->priority        = 4;
	$wp_customize->get_control( 'blogdescription' )->section  = 'colormag_header_builder_logo';
	$wp_customize->get_control( 'blogdescription' )->priority = 5;
	//  $wp_customize->get_control( 'site_icon' )->section        = 'colormag_header_builder_logo';
	$wp_customize->get_control( 'site_icon' )->priority = 6;
} else {
		$wp_customize->get_control( 'site_icon' )->priority       = 5;
		$wp_customize->get_control( 'blogname' )->priority        = 6;
		$wp_customize->get_control( 'blogdescription' )->priority = 7;
}


$wp_customize->remove_control( 'display_header_text' );
$wp_customize->remove_control( 'display_header_text' );
$wp_customize->remove_control( 'header_textcolor' );
$wp_customize->remove_control( 'background_attachment' );
$wp_customize->remove_control( 'background_repeat' );
$wp_customize->remove_control( 'background_size' );
$wp_customize->remove_control( 'background_position' );
$wp_customize->remove_control( 'background_preset' );
$wp_customize->remove_control( 'background_image' );
$wp_customize->remove_control( 'background_color' );

if ( isset( $wp_customize->selective_refresh ) ) {
	$wp_customize->selective_refresh->add_partial(
		'blogname',
		array(
			'selector'        => '.cm-site-title a',
			'render_callback' => array(
				'ColorMag_Customizer_Partials',
				'render_customize_partial_blogname',
			),
		)
	);

	$wp_customize->selective_refresh->add_partial(
		'blogdescription',
		array(
			'selector'        => '.cm-site-description',
			'render_callback' => array(
				'ColorMag_Customizer_Partials',
				'render_customize_partial_blogdescription',
			),
		)
	);
}

/*
 * Modify WooCommerce default section priorities
*/
if ( class_exists( 'WooCommerce' ) ) {
	$wp_customize->get_panel( 'woocommerce' )->priority = 70;
}
