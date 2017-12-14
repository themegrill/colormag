<?php
/**
 * Functions for configuring demo importer.
 *
 * @author   ThemeGrill
 * @category Admin
 * @package  Importer/Functions
 * @version  1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Setup demo importer packages.
 *
 * @param  array $packages
 *
 * @return array
 */
function colormag_demo_importer_packages( $packages ) {
	$new_packages = array(
		'colormag-free'              => array(
			'name'    => __( 'ColorMag', 'colormag' ),
			'preview' => 'http://demo.themegrill.com/colormag/',
		),
		'colormag-beauty-blog'       => array(
			'name'    => __( 'ColorMag Beauty Blog', 'colormag' ),
			'preview' => 'https://demo.themegrill.com/colormag-beauty-blog/',
		),
		'colormag-business-magazine' => array(
			'name'    => __( 'ColorMag Business Magazine', 'colormag' ),
			'preview' => 'https://demo.themegrill.com/colormag-business-magazine/',
		),
	);

	return array_merge( $new_packages, $packages );
}

add_filter( 'themegrill_demo_importer_packages', 'colormag_demo_importer_packages' );
