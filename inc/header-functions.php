<?php
/**
 * Contains all the fucntions and components related to header part.
 *
 * @package    ThemeGrill
 * @subpackage ColorMag
 * @since      ColorMag 1.0
 */
/* * ************************************************************************************* */

if ( ! function_exists( 'colormag_social_links' ) ) :

	/**
	 * This function is for social links display on header
	 *
	 * Get links through Theme Options
	 */
	function colormag_social_links() {
		// Bail out if social links is not activated
		if ( get_theme_mod( 'colormag_social_link_activate', 0 ) == 0 ) {
			return;
		}

		$colormag_social_links = array(
			'colormag_social_facebook'   => 'Facebook',
			'colormag_social_twitter'    => 'Twitter',
			'colormag_social_googleplus' => 'Google-Plus',
			'colormag_social_instagram'  => 'Instagram',
			'colormag_social_pinterest'  => 'Pinterest',
			'colormag_social_youtube'    => 'YouTube',
		);
		?>
		<div class="social-links clearfix">
			<ul>
				<?php
				$i                     = 0;
				$colormag_links_output = '';
				foreach ( $colormag_social_links as $key => $value ) {
					$link = get_theme_mod( $key, '' );
					if ( ! empty( $link ) ) {
						if ( get_theme_mod( $key . '_checkbox', 0 ) == 1 ) {
							$new_tab = 'target="_blank"';
						} else {
							$new_tab = '';
						}
						$colormag_links_output .= '<li><a href="' . esc_url( $link ) . '" ' . $new_tab . '><i class="fa fa-' . strtolower( $value ) . '"></i></a></li>';
					}
					$i ++;
				}
				echo $colormag_links_output;
				?>
			</ul>
		</div><!-- .social-links -->
		<?php
	}

endif;

/* * ************************************************************************************* */

// Filter the get_header_image_tag() for option of adding the link back to home page option
function colormag_header_image_markup( $html, $header, $attr ) {
	$output       = '';
	$header_image = get_header_image();

	if ( ! empty( $header_image ) ) {
		$output .= '<div class="header-image-wrap">';
		if ( get_theme_mod( 'colormag_header_image_link', 0 ) == 1 ) {
			$output .= '<a href="' . esc_url( home_url( '/' ) ) . '" title="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '" rel="home">';
		}

		$output .= '<img src="' . esc_url( $header_image ) . '" class="header-image" width="' . get_custom_header()->width . '" height="' . get_custom_header()->height . '" alt="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '">';

		if ( get_theme_mod( 'colormag_header_image_link', 0 ) == 1 ) {
			$output .= '</a>';
		}
		$output .= '</div>';
	}

	return $output;
}

function colormag_header_image_markup_filter() {
	add_filter( 'get_header_image_tag', 'colormag_header_image_markup', 10, 3 );
}

add_action( 'colormag_header_image_markup_render', 'colormag_header_image_markup_filter' );

/* * ************************************************************************************* */

if ( ! function_exists( 'colormag_render_header_image' ) ) :

	/**
	 * Shows the small info text on top header part
	 */
	function colormag_render_header_image() {
		if ( function_exists( 'the_custom_header_markup' ) ) {
			do_action( 'colormag_header_image_markup_render' );
			the_custom_header_markup();
		} else {
			$header_image = get_header_image();
			if ( ! empty( $header_image ) ) {
				if ( get_theme_mod( 'colormag_header_image_link', 0 ) == 1 ) {
					?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
				<?php } ?>
				<div class="header-image-wrap">
					<img src="<?php echo esc_url( $header_image ); ?>" class="header-image" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
				</div>
				<?php if ( get_theme_mod( 'colormag_header_image_link', 0 ) == 1 ) { ?>
					</a>
					<?php
				}
			}
		}
	}

endif;

if ( ! function_exists( 'colormag_top_header_bar_display' ) ) :

	/**
	 * Function to display the top header bar
	 *
	 * @since ColorMag 1.2.2
	 */
	function colormag_top_header_bar_display() {
		if ( get_theme_mod( 'colormag_breaking_news', 0 ) == 1 || get_theme_mod( 'colormag_date_display', 0 ) == 1 || get_theme_mod( 'colormag_social_link_activate', 0 ) == 1 ) :
			?>
			<div class="news-bar">
				<div class="inner-wrap clearfix">
					<?php
					if ( get_theme_mod( 'colormag_date_display', 0 ) == 1 ) {
						colormag_date_display();
					}
					?>

					<?php
					if ( get_theme_mod( 'colormag_breaking_news', 0 ) == 1 ) {
						colormag_breaking_news();
					}
					?>

					<?php
					if ( ( get_theme_mod( 'colormag_social_link_activate', 0 ) == 1 ) && ( ( get_theme_mod( 'colormag_social_link_location_option', 'both' ) == 'both' ) || ( get_theme_mod( 'colormag_social_link_location_option', 'both' ) == 'header' ) ) ) {
						colormag_social_links();
					}
					?>
				</div>
			</div>
		<?php
		endif;
	}

endif;

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
								colormag_the_custom_logo();
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

				<?php if ( get_theme_mod( 'colormag_random_post_in_menu', 0 ) == 1 ) { ?>
					<?php colormag_random_post(); ?>
				<?php } ?>

				<?php if ( get_theme_mod( 'colormag_search_icon_in_menu', 0 ) == 1 ) { ?>
					<i class="fa fa-search search-top"></i>
					<div class="search-form-top">
						<?php get_search_form(); ?>
					</div>
				<?php } ?>
			</div>
		</nav>

		<?php
	}

endif;
