<?php
/**
 * Demo Importer Functions.
 *
 * @package ThemeGrill_Demo_Importer/Functions
 * @version 1.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'tg_get_demo_file_url' ) ) {

	/**
	 * Get a demo file URL.
	 *
	 * @param  string $demo_dir demo dir.
	 * @return string the demo data file URL.
	 */
	function tg_get_demo_file_url( $demo_dir ) {
		return apply_filters( 'themegrill_demo_file_url', get_template_directory_uri() . '/inc/demo-importer/demos/' . $demo_dir, $demo_dir );
	}
}

if ( ! function_exists( 'tg_get_demo_file_path' ) ) {

	/**
	 * Get a demo file path.
	 *
	 * @param  string $demo_dir demo dir.
	 * @return string the demo data file path.
	 */
	function tg_get_demo_file_path( $demo_dir ) {
		return apply_filters( 'themegrill_demo_file_path', get_template_directory() . '/inc/demo-importer/demos/' . $demo_dir . '/dummy-data', $demo_dir );
	}
}
