<?php
/**
 * Deprecated hooks for ColorMag theme.
 *
 * @package    ThemeGrill
 * @subpackage ColorMag
 * @since      ColorMag 3.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'colormag_do_action_deprecated' ) ) :

	/**
	 * ColorMag Hook Deprecated.
	 *
	 * @param string $tag         The name of the action hook.
	 * @param array  $args        Array of additional function arguments to be passed to do_action().
	 * @param string $version     The version of theme that deprecated the hook.
	 * @param string $replacement Optional. The hook that should have been used. Default null.
	 * @param string $message     Optional. A message regarding the change. Default null.
	 *
	 * @since 3.0.0
	 */
	function colormag_do_action_deprecated( $tag, $args, $version, $replacement = null, $message = null ) {

		if ( function_exists( 'do_action_deprecated' ) ) {
			do_action_deprecated( $tag, $args, $version, $replacement, $message );
		} else {
			do_action_ref_array( $tag, $args );
		}
	}

endif;
