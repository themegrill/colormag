<?php
/**
 * Override default customizer panels, sections, settings or controls.
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
 * Override Sections.
 */
// Header media section.
$wp_customize->get_section( 'header_image' )->panel    = 'colormag_header_options';
$wp_customize->get_section( 'header_image' )->priority = 25;

//// Background image section.
//$wp_customize->get_section( 'background_image' )->panel    = 'colormag_design_options';
//$wp_customize->get_section( 'background_image' )->priority = 15;

/**
 * Override controls.
 */
// Outside container > background control.
$wp_customize->get_control( 'background_color' )->section  = 'colormag_global_background_section';
$wp_customize->get_control( 'background_color' )->priority = 20;
$wp_customize->get_control( 'background_color' )->type = 'colormag-color';

$wp_customize->get_control( 'background_image' )->section  = 'colormag_global_background_section';
$wp_customize->get_control( 'background_image' )->priority = 25;

$wp_customize->get_control( 'background_preset' )->section  = 'colormag_global_background_section';
$wp_customize->get_control( 'background_preset' )->priority = 30;

$wp_customize->get_control( 'background_position' )->section  = 'colormag_global_background_section';
$wp_customize->get_control( 'background_position' )->priority = 35;

$wp_customize->get_control( 'background_size' )->section  = 'colormag_global_background_section';
$wp_customize->get_control( 'background_size' )->priority = 40;

$wp_customize->get_control( 'background_repeat' )->section  = 'colormag_global_background_section';
$wp_customize->get_control( 'background_repeat' )->priority = 45;

$wp_customize->get_control( 'background_attachment' )->section  = 'colormag_global_background_section';
$wp_customize->get_control( 'background_attachment' )->priority = 50;

// Site Identity.
$wp_customize->get_control( 'custom_logo' )->priority     = 6;
$wp_customize->get_control( 'site_icon' )->priority       = 8;
$wp_customize->get_control( 'blogname' )->priority        = 10;
$wp_customize->get_control( 'blogdescription' )->priority = 12;

$wp_customize->get_section( 'header_image' )->panel    = 'colormag_header_panel';
$wp_customize->get_section( 'header_image' )->priority = 10;

// Override Settings.
$wp_customize->get_setting( 'blogname' )->transport        = 'postMessage';
$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

if ( isset( $wp_customize->selective_refresh ) ) {
	$wp_customize->selective_refresh->add_partial(
		'blogname',
		array(
			'selector'        => '#site-title a',
			'render_callback' => array(
				'ColorMag_Customizer_Partials',
				'render_customize_partial_blogname',
			),
		)
	);

	$wp_customize->selective_refresh->add_partial(
		'blogdescription',
		array(
			'selector'        => '#site-description',
			'render_callback' => array(
				'ColorMag_Customizer_Partials',
				'render_customize_partial_blogdescription',
			),
		)
	);
}
