<?php
/**
 * Footer builder: CopyRight
 *
 * @package ColorMag
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// Default copyright text (free base). Pro can override this via the filter to
// honour the theme-mod based copyright text.
$default_copyright = colormag_footer_builder_copyright();

/**
 * Filters the footer copyright text.
 *
 * @param string $default_copyright The default copyright markup.
 */
$copyright_text = apply_filters( 'colormag_footer_copyright_text', $default_copyright );

echo '<div class="cm-copyright copyright">';
echo wp_kses_post( do_shortcode( $copyright_text ) );
echo '</div>';
