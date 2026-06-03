<?php
/**
 * Footer builder: CopyRight
 *
 * @package ColorMag
 */
echo '<div class="cm-copyright copyright">';

echo wp_kses_post( do_shortcode( colormag_footer_builder_copyright() ) );
echo '</div>';
