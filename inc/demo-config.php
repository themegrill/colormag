<?php
/**
 * Functions for configuring demo importer.
 *
 * @package ThemeGrill_Demo_Importer/Functions
 * @version 1.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Delete the `Hello world!` post after successful demo import.
 */
function colormag_delete_post_import() {
	$page = get_page_by_title( 'Hello world!', OBJECT, 'post' );

	if ( is_object( $page ) && $page->ID ) {
		wp_delete_post( $page->ID, true );
	}
}

add_filter( 'themegrill_ajax_demo_imported', 'colormag_delete_post_import' );
