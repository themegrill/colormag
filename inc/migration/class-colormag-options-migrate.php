<?php
/**
 * Class to migrate customize options from free to pro, when the theme switches.
 * Class ColorMag_Dynamic_CSS
 *
 * @package    ThemeGrill
 * @subpackage ColorMag
 * @since      ColorMag 1.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class to migrate customize options from free to pro, when the theme switches.
 *
 * Class ColorMag_Options_Migrate
 */
class ColorMag_Options_Migrate {

	/**
	 * Constructor.
	 *
	 * ColorMag_Options_Migrate constructor.
	 */
	public function __construct() {

		// Customize options migrate from free to pro theme switch.
		add_action( 'after_switch_theme', array( $this, 'colormag_options_migrate' ) );

	}

	/**
	 * Customize options migrate from free to pro theme switch.
	 */
	public function colormag_options_migrate() {

		// Bail out if ColorMag Pro theme is already activated.
		if ( get_option( 'colormag_pro_active' ) ) {
			return;
		}

		// Add option to check if pro theme is already activated or not.
		update_option( 'colormag_pro_active', 1 );

		// Bail out if `theme_mods_colormag` does not exists.
		if ( false === ( $mods = get_option( 'theme_mods_colormag' ) ) ) {
			return;
		}

		// Bail out if `colormag_transfer` already exists,
		// which refers that the database is already migrated.
		if ( get_option( 'colormag_transfer' ) ) {
			return;
		}

		// Migrate the free theme mods data to pro,
		// ie, from `theme_mods_colormag` to `theme_mods_colormag-pro`.
		update_option( 'colormag_check', 'changed' );
		$free = get_option( 'theme_mods_colormag' );
		update_option( 'theme_mods_colormag-pro', $free );

		// Set transfer as complete.
		update_option( 'colormag_transfer', 1 );

	}

}

return new ColorMag_Options_Migrate();
