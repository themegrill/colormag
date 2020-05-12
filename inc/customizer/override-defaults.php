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

// Background image section.
$wp_customize->get_section( 'background_image' )->panel = 'colormag_design_options';
$wp_customize->get_section( 'header_image' )->priority  = 15;

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
