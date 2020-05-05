<?php
/**
 * Contains all the fucntions and components related to header part.
 *
 * @package    ThemeGrill
 * @subpackage ColorMag
 * @since      ColorMag 1.0
 */

/* * ************************************************************************************* */

if ( ! function_exists( 'colormag_middle_header_bar_display' ) ) :

	/**
	 * Function to display the middle header bar
	 *
	 * @since ColorMag 1.2.2
	 */
	function colormag_middle_header_bar_display() {
		?>

		<div class="inner-wrap">

			<div id="header-text-nav-wrap" class="clearfix">
				<div id="header-left-section">
					<?php
					if ( ( get_theme_mod( 'colormag_header_logo_placement', 'header_text_only' ) == 'show_both' || get_theme_mod( 'colormag_header_logo_placement', 'header_text_only' ) == 'header_logo_only' ) ) {
						?>
						<div id="header-logo-image">
							<?php
							if ( function_exists( 'the_custom_logo' ) && has_custom_logo( $blog_id = 0 ) ) {
								the_custom_logo();
							}
							?>
						</div><!-- #header-logo-image -->
						<?php
					}
					$screen_reader = '';
					if ( get_theme_mod( 'colormag_header_logo_placement', 'header_text_only' ) == 'header_logo_only' || ( get_theme_mod( 'colormag_header_logo_placement', 'header_text_only' ) == 'disable' ) ) {
						$screen_reader = 'screen-reader-text';
					}
					?>
					<div id="header-text" class="<?php echo $screen_reader; ?>">
						<?php if ( is_front_page() || is_home() ) : ?>
							<h1 id="site-title">
								<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
							</h1>
						<?php else : ?>
							<h3 id="site-title">
								<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
							</h3>
						<?php endif; ?>
						<?php
						$description = get_bloginfo( 'description', 'display' );
						if ( $description || is_customize_preview() ) :
						?>
						<p id="site-description"><?php echo $description; ?></p>
						<?php endif; ?><!-- #site-description -->
					</div><!-- #header-text -->
				</div><!-- #header-left-section -->
				<div id="header-right-section">
					<?php
					if ( is_active_sidebar( 'colormag_header_sidebar' ) ) {
						?>
						<div id="header-right-sidebar" class="clearfix">
							<?php
							// Calling the header sidebar if it exists.
							if ( ! dynamic_sidebar( 'colormag_header_sidebar' ) ):
							endif;
							?>
						</div>
						<?php
					}
					?>
				</div><!-- #header-right-section -->

			</div><!-- #header-text-nav-wrap -->

		</div><!-- .inner-wrap -->

		<?php
	}

endif;

if ( ! function_exists( 'colormag_below_header_bar_display' ) ) :

	/**
	 * Function to display the middle header bar
	 *
	 * @since ColorMag 1.2.2
	 */
	function colormag_below_header_bar_display() {
		?>

		<nav id="site-navigation" class="main-navigation clearfix" role="navigation">
			<div class="inner-wrap clearfix">
				<?php
				if ( get_theme_mod( 'colormag_home_icon_display', 0 ) == 1 ) {
					if ( is_front_page() ) {
						$home_icon_class = 'home-icon front_page_on';
					} else {
						$home_icon_class = 'home-icon';
					}
					?>

					<div class="<?php echo $home_icon_class; ?>">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"><i class="fa fa-home"></i></a>
					</div>

					<?php
				}
				?>

				<?php if ( get_theme_mod( 'colormag_random_post_in_menu', 0 ) == 1 || get_theme_mod( 'colormag_search_icon_in_menu', 0 ) == 1 ) { ?>
					<div class="search-random-icons-container">
						<?php
						// Displays the random post.
						if ( get_theme_mod( 'colormag_random_post_in_menu', 0 ) == 1 ) {
							colormag_random_post();
						}

						// Displays the search icon.
						if ( get_theme_mod( 'colormag_search_icon_in_menu', 0 ) == 1 ) {
							?>
							<div class="top-search-wrap">
								<i class="fa fa-search search-top"></i>
								<div class="search-form-top">
									<?php get_search_form(); ?>
								</div>
							</div>
						<?php } ?>
					</div>
				<?php } ?>

				<p class="menu-toggle"></p>
				<?php
				if ( has_nav_menu( 'primary' ) ) {
					wp_nav_menu( array(
						'theme_location'  => 'primary',
						'container_class' => 'menu-primary-container',
						'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
					) );
				} else {
					wp_page_menu();
				}
				?>

			</div>
		</nav>

		<?php
	}

endif;
