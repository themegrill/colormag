<?php
/**
 * Migration scripts for ColorMag theme.
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
 * Migrate all of the customize options for 2.0.0 theme update.
 *
 * @since ColorMag 2.0.0
 */
function colormag_major_theme_update_customize_migrate() {

	// Bail out if the migration is already done.
	if ( get_option( 'colormag_major_theme_update_customize_migrate' ) ) {
		return;
	}

	// Set flag to not repeat the migration process, ie, run it only once.
	update_option( 'colormag_major_theme_update_customize_migrate', true );

}

add_action( 'after_setup_theme', 'colormag_major_theme_update_customize_migrate' );
