<?php
/**
 * Footer builder: CopyRight
 *
 * @package ColorMag
 */
echo '<div class="cm-copyright copyright">';

echo do_shortcode( wp_kses_post( colormag_footer_builder_copyright() ) );
echo '</div>';
