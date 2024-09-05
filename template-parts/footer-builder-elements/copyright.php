<?php
/**
 * Footer builder: CopyRight
 *
 * @package Zakra
 */
echo '<div class="zak-copyright">';
echo do_shortcode( wp_kses_post( zakra_footer_builder_copyright() ) );
echo '</div>';
