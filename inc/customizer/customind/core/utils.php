<?php
/**
 * Utility functions.
 */

namespace Customind\Core;

use Customind\Core\WebFontLoader;

/**
 * Get google fonts url.
 *
 * @param boolean $local Whether to return local url.
 * @param string $format Font format.
 * @return string|false
 */
function get_google_fonts_url( $local = false, $format = 'woff2' ) {
	$cached_fonts_url = get_option( '_customind_google_fonts_url', '' );
	if ( empty( $cached_fonts_url ) ) {
		return false;
	}
	if ( $local ) {
		$webfont_loader = new WebFontLoader( $cached_fonts_url );
		$webfont_loader->set_font_format( $format );
		return $webfont_loader->get_url();
	}

	return $cached_fonts_url;
}


function get_social_networks() {
	static $socials = null;

	if ( ! isset( $socials ) ) {
		$socials = require_once CUSTOMIND_DIR . '/data/socials.php';
	}

	return $socials;
}


function get_google_fonts_url_by_ids( $typography_controls_ids, $local = false, $format = 'woff2' ) {
	$fonts = [];
	foreach ( $typography_controls_ids as $id ) {
		$value = get_theme_mod( $id );
		if ( ! $value ) {
			continue;
		}
		if ( empty( $value['font-family'] ) || 'default' === strtolower( $value['font-family'] ) ) {
			continue;
		}
		$family           = $value['font-family'];
		$weight           = $value['font-weight'] ?? 400;
		$weight           = (int) $weight;
		$fonts[ $family ] = isset( $fonts[ $family ] )
			? ( in_array( $weight, $fonts[ $family ], true )
				? $fonts[ $family ]
				: array_merge( $fonts[ $family ], [ $weight ] ) )
			: [ $weight ];
	}
	if ( empty( $fonts ) ) {
		return false;
	}
	$families  = array_keys( $fonts );
	$fonts_url = add_query_arg(
		[
			'family' => implode(
				'|',
				array_map(
					function ( $f ) use ( $fonts ) {
						return str_replace( ' ', '+', $f ) . ':' . implode( ',', array_unique( $fonts[ $f ] ) );
					},
					$families
				)
			),
		],
		'https://fonts.googleapis.com/css'
	);

	if ( $local ) {
		$webfont_loader = new WebFontLoader( $fonts_url );
		$webfont_loader->set_font_format( $format );
		return $webfont_loader->get_url();
	}
	return $fonts_url;
}
