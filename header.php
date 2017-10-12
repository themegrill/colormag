<?php
/**
 * Theme Header Section for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main" class="clearfix"> <div class="inner-wrap">
 *
 * @package ThemeGrill
 * @subpackage ColorMag
 * @since ColorMag 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="profile" href="http://gmpg.org/xfn/11" />
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
		<?php
		/**
		 * This hook is important for wordpress plugins and other many things
		 */
		wp_head();
		?>
	</head>

	<body <?php body_class(); ?>>
		<?php do_action( 'colormag_before' ); ?>
		<div id="page" class="hfeed site">
			<?php do_action( 'colormag_before_header' ); ?>
			<header id="masthead" class="site-header clearfix">
				<div id="header-text-nav-container" class="clearfix">
					
					<?php colormag_top_header_bar_display(); // Display the top header bar ?>

					<?php
					if ( get_theme_mod( 'colormag_header_image_position', 'position_two' ) == 'position_one' ) {
						colormag_render_header_image();
					}
					?>

					<?php colormag_middle_header_bar_display(); // Display the middle header bar ?>

					<?php
					if ( get_theme_mod( 'colormag_header_image_position', 'position_two' ) == 'position_two' ) {
						colormag_render_header_image();
					}
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
							<h4 class="menu-toggle"></h4>
							<?php
							if ( has_nav_menu( 'primary' ) ) {
								wp_nav_menu( array( 'theme_location' => 'primary', 'container_class' => 'menu-primary-container', 'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>' ) );
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

				</div><!-- #header-text-nav-container -->

				<?php
				if ( get_theme_mod( 'colormag_header_image_position', 'position_two' ) == 'position_three' ) {
					colormag_render_header_image();
				}
				?>

			</header>
			<?php do_action( 'colormag_after_header' ); ?>
			<?php do_action( 'colormag_before_main' ); ?>
			<div id="main" class="clearfix">
				<div class="inner-wrap clearfix">