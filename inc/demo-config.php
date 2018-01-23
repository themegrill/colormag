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
		'colormag-dark'              => array(
			'name'    => __( 'ColorMag Dark', 'colormag' ),
			'preview' => 'https://demo.themegrill.com/colormag-dark/',
		),
		'colormag-pro'               => array(
			'name'     => __( 'ColorMag Pro', 'colormag' ),
			'preview'  => 'https://demo.themegrill.com/colormag-pro/',
			'pro_link' => 'https://themegrill.com/themes/colormag/',
		),
		'colormag-pro-fashion'       => array(
			'name'     => __( 'ColorMag Pro Fashion', 'colormag' ),
			'preview'  => 'https://demo.themegrill.com/colormag-pro-fashion/',
			'pro_link' => 'https://themegrill.com/themes/colormag/',
		),
		'colormag-pro-technology'    => array(
			'name'     => __( 'ColorMag Pro Technology', 'colormag' ),
			'preview'  => 'https://demo.themegrill.com/colormag-pro-technology/',
			'pro_link' => 'https://themegrill.com/themes/colormag/',
		),
		'colormag-pro-sports'        => array(
			'name'     => __( 'ColorMag Pro Sports', 'colormag' ),
			'preview'  => 'https://demo.themegrill.com/colormag-pro-sports/',
			'pro_link' => 'https://themegrill.com/themes/colormag/',
		),
		'colormag-pro-recipes'       => array(
			'name'     => __( 'ColorMag Food Recipe', 'colormag' ),
			'preview'  => 'https://demo.themegrill.com/colormag-pro-recipes/',
			'pro_link' => 'https://themegrill.com/themes/colormag/',
		),
		'colormag-pro-health-blog'   => array(
			'name'     => __( 'ColorMag Health Blog', 'colormag' ),
			'preview'  => 'https://demo.themegrill.com/colormag-pro-health-blog/',
			'pro_link' => 'https://themegrill.com/themes/colormag/',
		),
		'colormag-pro-music'         => array(
			'name'     => __( 'ColorMag Pro Music', 'colormag' ),
			'preview'  => 'https://demo.themegrill.com/colormag-pro-music/',
			'pro_link' => 'https://themegrill.com/themes/colormag/',
		),
	);

	return array_merge( $new_packages, $packages );
}

add_filter( 'themegrill_demo_importer_packages', 'colormag_demo_importer_packages' );
