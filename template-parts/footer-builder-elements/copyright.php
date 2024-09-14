<?php
/**
 * Footer builder: CopyRight
 *
 * @package Zakra
 */
echo '<div class="cm-copyright">';
echo do_shortcode( wp_kses_post( ColorMag_Utils::colormag_footer_builder_copyright() ) );
echo '</div>';
