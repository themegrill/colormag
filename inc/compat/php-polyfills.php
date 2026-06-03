<?php
/**
 * PHP version polyfills for backward and forward compatibility.
 *
 * Backports PHP 8.0+ functions to PHP 7.4, ensuring the theme runs without
 * fatal errors on PHP 7.4 while remaining compatible with PHP 8.5+.
 *
 * @package    ThemeGrill
 * @subpackage ColorMag
 * @since      ColorMag 4.1.3
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// PHP 8.0: str_contains().
if ( ! function_exists( 'str_contains' ) ) {
	function str_contains( string $haystack, string $needle ): bool {
		return '' === $needle || false !== strpos( $haystack, $needle );
	}
}

// PHP 8.0: str_starts_with().
if ( ! function_exists( 'str_starts_with' ) ) {
	function str_starts_with( string $haystack, string $needle ): bool {
		return 0 === strncmp( $haystack, $needle, strlen( $needle ) );
	}
}

// PHP 8.0: str_ends_with().
if ( ! function_exists( 'str_ends_with' ) ) {
	function str_ends_with( string $haystack, string $needle ): bool {
		return '' === $needle || ( '' !== $haystack && 0 === substr_compare( $haystack, $needle, -strlen( $needle ) ) );
	}
}

// PHP 8.1: array_is_list().
if ( ! function_exists( 'array_is_list' ) ) {
	function array_is_list( array $arr ): bool {
		if ( array() === $arr ) {
			return true;
		}
		$next_key = 0;
		foreach ( $arr as $k => $v ) {
			if ( $k !== $next_key++ ) {
				return false;
			}
		}
		return true;
	}
}
