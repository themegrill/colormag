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
/**
 * HTML Head.
 *
 * @see colormag_head()
 */
add_action( 'colormag_action_head', 'colormag_head' );
