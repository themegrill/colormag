<?php
/**
 * ColorMag theme hooks.
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
 * Hooks for the header of this theme.
 */
// HTML Head.
add_action( 'colormag_action_head', 'colormag_head', 10 );

// Page starts.
add_action( 'colormag_action_before', 'colormag_page_start', 10 );


/**
 * Hooks for the footer of this theme.
 */
// Page ends.
add_action( 'colormag_action_after', 'colormag_page_end', 10 );
