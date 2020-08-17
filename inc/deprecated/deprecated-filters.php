<?php
/**
 * Deprecated filters for ColorMag theme.
 *
 * @package    ThemeGrill
 * @subpackage ColorMag
 * @since      ColorMag 2.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'colormag_apply_filters_deprecated' ) ) :

	/**
	 * ColorMag Hook Deprecated.
	 *
	 * @param string $tag         The name of the action hook.
	 * @param array  $args        Array of additional function arguments to be passed to apply_filters().
	 * @param string $version     The version of theme that deprecated the hook.
	 * @param string $replacement Optional. The hook that should have been used. Default null.
	 * @param string $message     Optional. A message regarding the change. Default null.
	 *
	 * @since 2.0.0
	 */
	function colormag_apply_filters_deprecated( $tag, $args, $version, $replacement = null, $message = null ) {

		if ( function_exists( 'apply_filters_deprecated' ) ) {
			apply_filters_deprecated( $tag, $args, $version, $replacement, $message );
		} else {
			apply_filters_ref_array( $tag, $args );
		}
	}

endif;
