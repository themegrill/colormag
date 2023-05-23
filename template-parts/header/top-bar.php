<?php
/**
 * Top bar hooks.
 *
 * @package ColorMag
 *
 * TODO: @since
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/*========================================= Hooks > Header Top ==========================================*/

		$top_bar_enable                 = get_theme_mod( 'colormag_enable_top_bar', 0 );
		$breaking_news_enable           = get_theme_mod( 'colormag_enable_news_ticker', 0 );
		$date_display_enable            = get_theme_mod( 'colormag_date_display', 0 );
		$social_links_enable            = get_theme_mod( 'colormag_enable_social_icons', 0 );
		$social_links_header_visibility = get_theme_mod( 'colormag_enable_social_icons_header', 1 );

if (
			( 1 == $top_bar_enable ) && (
				( 1 == $date_display_enable ) ||
				( 1 == $breaking_news_enable ) ||
				( 1 == $social_links_enable && 1 == $social_links_header_visibility ) )
		) :
	if ( 1 == $top_bar_enable ) {
		?>

				<div class="cm-top-bar">
					<div class="cm-container">
						<div class="cm-row">
							<div class="cm-top-bar__1">
				<?php
				// Date.
				if ( 1 == $date_display_enable ) {
					colormag_date_display();
				}

				// Date.
				if ( 1 == $breaking_news_enable ) {
					colormag_breaking_news();
				}
				?>
							</div>

							<div class="cm-top-bar__2">
				<?php

				// Social icons.
				if ( 1 == $social_links_header_visibility ) {
					colormag_social_links();
				}
				?>
							</div>
						</div>
					</div>
				</div>

				<?php

	}
			endif;
