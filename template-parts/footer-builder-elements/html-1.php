<?php
$html_1 = get_theme_mod( 'colormag_footer_html_1', '' );
echo '<div class="cm-html-1 cm-footer-html-1">';
echo wp_kses_post( $html_1 );
echo '</div>';
