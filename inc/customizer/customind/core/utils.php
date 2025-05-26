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

/**
 * Get font format from src.
 *
 * @param string $src
 * @return array
 */
function get_custom_font_format( $src ) {
	$format = pathinfo( $src, PATHINFO_EXTENSION );
	$option = [
		'url'    => $src,
		'format' => 'eot' === $format ? 'embedded-opentype' : (
		'otf' === $format ? 'opentype' : (
		'ttf' === $format ? 'truetype' : $format
		)
		),
	];
	return $option;
}

/**
 * Generate custom fonts CSS.
 *
 * This function retrieves custom fonts using the `magazine_blocks_pro_get_fonts` function if it exists,
 * processes each font to generate the necessary CSS for `@font-face` rules, and returns the complete CSS string.
 *
 * @return string The generated CSS for custom fonts.
 */
function get_custom_fonts_css() {
	$fonts = [];
	if ( function_exists( 'magazine_blocks_pro_get_fonts' ) ) {
		$fonts = magazine_blocks_pro_get_fonts( true );
	}

	$styles = [];
	foreach ( $fonts as $font ) {
		foreach ( $font['faces'] as $face ) {
			$src      = $face['src'];
			$format   = get_custom_font_format( $src );
			$styles[] = [
				'font-family'  => $font['family'],
				'font-style'   => $face['fontStyle'],
				'font-weight'  => $face['fontWeight'],
				'font-display' => 'fallback',
				'src'          => "url({$format['url']}) format('{$format['format']}')",
			];
		}
	}

	$css = '';
	foreach ( $styles as $style ) {
		$css .= '@font-face{';
		foreach ( $style as $key => $value ) {
			$css .= $key . ':' . $value . ';';
		}
		$css .= '}';
	}
	return $css;
}

function get_google_fonts_url_by_ids( $typography_controls_ids, $local = false, $format = 'woff2' ) {
	$fonts = [];
	foreach ( $typography_controls_ids as $id ) {
		$value = get_theme_mod( $id );

		if ( ! $value ) {
			continue;
		}
		$value = apply_filters( 'customind:typography:value', $value ); // phpcs:ignore WordPress.NamingConventions.ValidHookName.UseUnderscores
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
