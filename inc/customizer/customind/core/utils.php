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
