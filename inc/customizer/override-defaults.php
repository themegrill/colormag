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
// Header media section.
$wp_customize->get_section( 'header_image' )->panel    = 'colormag_header_and_navigation_panel';
$wp_customize->get_section( 'header_image' )->priority = 15;

/**
 * Override controls.
 */
// Outside container > background control.
//$wp_customize->get_control( 'background_color' )->section  = 'colormag_global_container_section';
//$wp_customize->get_control( 'background_color' )->priority = 60;
//$wp_customize->get_control( 'background_color' )->type = 'sub-control';
//$wp_customize->get_control( 'background_color' )->control = 'colormag-color';
//$wp_customize->get_control( 'background_color' )->parent = 'colormag_container_background_group';
//$wp_customize->get_control( 'background_color' )->tab = esc_html__( 'Outside Container', 'colormag' );
//
//$wp_customize->get_control( 'background_image' )->section  = 'colormag_global_container_section';
//$wp_customize->get_control( 'background_image' )->priority = 70;
//
//$wp_customize->get_control( 'background_preset' )->section  = 'colormag_global_container_section';
//$wp_customize->get_control( 'background_preset' )->priority = 80;
//
//$wp_customize->get_control( 'background_position' )->section  = 'colormag_global_container_section';
//$wp_customize->get_control( 'background_position' )->priority = 90;
//
//$wp_customize->get_control( 'background_size' )->section  = 'colormag_global_container_section';
//$wp_customize->get_control( 'background_size' )->priority = 100;
//
//$wp_customize->get_control( 'background_repeat' )->section  = 'colormag_global_container_section';
//$wp_customize->get_control( 'background_repeat' )->priority = 110;
//
//$wp_customize->get_control( 'background_attachment' )->section  = 'colormag_global_container_section';
//$wp_customize->get_control( 'background_attachment' )->priority = 120;

// Site Identity.
$wp_customize->get_control( 'custom_logo' )->priority     = 20;
$wp_customize->get_control( 'site_icon' )->priority       = 40;
$wp_customize->get_control( 'blogname' )->priority        = 60;
$wp_customize->get_control( 'blogdescription' )->priority = 90;

$wp_customize->get_section( 'header_image' )->panel    = 'colormag_header_and_navigation_panel';
$wp_customize->get_section( 'header_image' )->priority = 10;

// Override Settings.
$wp_customize->get_setting( 'blogname' )->transport        = 'postMessage';
$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

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
