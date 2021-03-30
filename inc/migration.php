<?php
/**
 * Migration scripts for ColorMag theme.
 *
 * @package    ThemeGrill
 * @subpackage ColorMag
 * @since      ColorMag 2.0.6
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
 * Migrate the social icons control.
 *
 * @since ColorMag 2.0.6
 */
function colormag_social_icons_control_migrate() {

	$social_icon            = get_theme_mod( 'colormag_social_link_activate', 0 );
	$social_icon_visibility = get_theme_mod( 'colormag_social_link_location_option', 'both' );

	// Disable social icon on header if enabled on footer only.
	if ( 0 !== $social_icon ) {
		set_theme_mod( 'colormag_social_icons_activate', true );
	}

	// Disable social icon on header if enabled on footer only.
	if ( 'footer' === $social_icon_visibility ) {
		set_theme_mod( 'colormag_social_icons_header_activate', false );
	}

	// Disable social icon on footer if enabled on header only.
	if ( 'header' === $social_icon_visibility ) {
		set_theme_mod( 'colormag_social_icons_footer_activate', false );
	}

	$remove_theme_mod_settings = array(
		'colormag_social_link_activate',
		'colormag_social_link_location_option'
	);

	// Loop through the theme mods to remove them.
	foreach ( $remove_theme_mod_settings as $remove_theme_mod_setting ) {
		remove_theme_mod( $remove_theme_mod_setting );
	}

	// Set flag to not repeat the migration process, ie, run it only once.
	update_option( 'colormag_social_icons_control_migrate', true );

}

add_action( 'after_setup_theme', 'colormag_social_icons_control_migrate' );
