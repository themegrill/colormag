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
		$breaking_news_position         = get_theme_mod( 'colormag_news_ticker_position', 'top-bar' );
		$date_display_enable            = get_theme_mod( 'colormag_date_display', 0 );
		$social_links_enable            = get_theme_mod( 'colormag_enable_social_icons', 0 );
		$social_links_header_visibility = get_theme_mod( 'colormag_enable_social_icons_header', 1 );
		$social_links_header_location   = get_theme_mod( 'colormag_social_icons_header_location', 'top-bar' );
		$top_bar_menu_enable            = get_theme_mod( 'colormag_top_bar_menu_enable', 0 );

if (
			( 1 == $top_bar_enable ) && (
				( 1 == $date_display_enable ) ||
				( 1 == $breaking_news_enable && 'top-bar' === $breaking_news_position ) ||
				( 1 == $social_links_enable && 1 == $social_links_header_visibility && 'top-bar' === $social_links_header_location ) ||
				( 1 == $top_bar_menu_enable ) || 1 )
		) :
	if ( 1 == $top_bar_enable ) {
		?>

				<div class="cm-top-bar">
					<div class="cm-container <?php echo colormag_top_bar_full_width_area_class(); ?>">
						<div class="cm-row">
							<div class="cm-top-bar__1">
				<?php
				// Date.
				if ( 1 == $date_display_enable ) {
					colormag_date_display();
				}

				// Breaking news.
				if ( 1 == $breaking_news_enable && 'top-bar' === $breaking_news_position ) {
					colormag_breaking_news();
				}
				?>
							</div>

							<div class="cm-top-bar__2">
				<?php
				// Menu.
				if ( 1 == $top_bar_menu_enable ) {
					?>
									<nav class="top-bar-menu">
						<?php
						if ( has_nav_menu( 'top-bar' ) ) {
							wp_nav_menu(
								array(
									'theme_location' => 'top-bar',
									'depth'          => - 1,
								)
							);
						}
						?>
									</nav>
					<?php
				}

				// Social icons.
				if ( 1 == $social_links_header_visibility && 'top-bar' === $social_links_header_location ) {
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
