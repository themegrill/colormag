<?php
/**
 * Localize load more scripts.
 *
 * @package ColorMag
 *
 * @since   ColorMag 1.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Allow the pro version (or any add-on) to register its AJAX handlers.
 *
 * The pro AJAX functions (load more, infinite scroll, single post
 * navigation and comments) hook into this action. It is fired on
 * `after_setup_theme` so that all include files (including the pro
 * AJAX file) have been loaded and their listeners attached first.
 */
add_action(
	'after_setup_theme',
	function () {
		do_action( 'colormag_ajax_pro_hooks' );
	}
);
