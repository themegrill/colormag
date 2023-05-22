<?php
/**
 * Main header markup file.
 *
 * @package ColorMag
 *
 * TODO: @since.
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$header_image_position = get_theme_mod( 'colormag_header_media_position', 'position-two' );

if ( 'position-one' === $header_image_position ) {
	the_custom_header_markup();
}

	// Display the middle header bar.
	do_action( 'colormag_header_one' );

if ( 'position-two' === $header_image_position ) {
	the_custom_header_markup();
}

	// Display the below header bar.
	do_action( 'colormag_header_two' );

