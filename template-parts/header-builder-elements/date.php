
<div class="date-in-header">
	<?php
	if ( 'theme_default' == get_theme_mod( 'colormag_date_display_type', 'theme_default' ) ) {
		echo esc_html( date_i18n( 'l, F j, Y' ) );
	} elseif ( 'wordpress_date_setting' == get_theme_mod( 'colormag_date_display_type', 'theme_default' ) ) {
		echo esc_html( date_i18n( get_option( 'date_format' ) ) );
	}
	?>
</div>
