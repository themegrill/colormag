<?php
/**
 * Header hooks.
 *
 * @package ColorMag
 *
 * TODO: @since
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'colormag_doctype' ) ) :

	/**
	 * Header doctype
	 */
	function colormag_doctype() {
		?>
		<!doctype html>
		<html <?php language_attributes(); ?>>
		<?php
	}
endif;

add_action( 'colormag_action_doctype', 'colormag_doctype', 10 );

if ( ! function_exists( 'colormag_head' ) ) :

	/**
	 * HTML Head.
	 */
	function colormag_head() {
		?>
		<meta charset="<?php bloginfo( 'charset' ); ?>"/>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="profile" href="http://gmpg.org/xfn/11"/>
		<?php
	}

endif;

add_action( 'colormag_action_head', 'colormag_head', 10 );

if ( ! function_exists( 'colormag_background_image_clickable' ) ) :

	/**
	 * Background image clickable.
	 */
	function colormag_background_image_clickable() {

		$background_image_url_link = get_theme_mod( 'colormag_background_image_link' );

		if ( $background_image_url_link ) {
			echo '<a href="' . esc_url( $background_image_url_link ) . '" class="background-image-clickable" target="_blank"></a>';
		}
	}

endif;

add_action( 'colormag_action_before', 'colormag_background_image_clickable', 5 );

if ( ! function_exists( 'colormag_page_start' ) ) :

	/**
	 * Page start.
	 */
	function colormag_page_start() {
		?>
		<div id="page" class="hfeed site">
		<?php
	}

endif;

add_action( 'colormag_action_before', 'colormag_page_start', 10 );

if ( ! function_exists( 'colormag_skip_content_link' ) ) :

	/**
	 * Skip content link.
	 */
	function colormag_skip_content_link() {
		?>
		<a class="skip-link screen-reader-text" href="#main"><?php esc_html_e( 'Skip to content', 'colormag' ); ?></a>
		<?php
	}

endif;

add_action( 'colormag_action_before', 'colormag_skip_content_link', 15 );

if ( ! function_exists( 'colormag_header_markup' ) ) :

	/**
	 * Adds ColorMag header markup.
	 *
	 * @return void
	 */
	function colormag_header_markup() {

		/**
		 * Hook: colormag_before_header.
		 */
		do_action( 'colormag_before_header' );
		?>

		<?php
		/**
		 * Functions hooked into colormag_action_before_header action.
		 *
		 * @hooked colormag_header_start - 10
		 */
		do_action( 'colormag_action_before_header' );
		?>

		<?php
		/**
		 * Functions hooked into colormag_action_header_top action.
		 *
		 * @hooked colormag_header_top - 10
		 */
		do_action( 'colormag_action_header_top' );
		?>

		<?php
		/**
		 * Functions hooked into colormag_action_before_inner_header action.
		 *
		 * @hooked colormag_header_nav_container_start - 10
		 */
		do_action( 'colormag_action_before_inner_header' );
		?>

		<?php
		/**
		 * Functions hooked into colormag_action_header action.
		 *
		 * @hooked colormag_header - 10
		 */
		do_action( 'colormag_action_header' );
		?>

		<?php
		/**
		 * Functions hooked into colormag_action_after_inner_header action.
		 *
		 * @hooked colormag_header_image_before_nav_container_end - 5
		 * @hooked colormag_header_nav_container_end - 10
		 */
		do_action( 'colormag_action_after_inner_header' );
		?>

		<?php
		/**
		 * Functions hooked into colormag_action_after_header action.
		 *
		 * @hooked colormag_header_end - 10
		 */
		do_action( 'colormag_action_after_header' );
		?>

		<?php
		/**
		 * Hook: colormag_after_header.
		 */
		do_action( 'colormag_after_header' );
	}

endif;

add_action( 'colormag_header', 'colormag_header_markup' );

if ( ! function_exists( 'colormag_header_start' ) ) :

	/**
	 * Header starts.
	 */
	function colormag_header_start() {
		?>
	<header id="cm-masthead" class="<?php colormag_css_class( 'colormag_header_class' ); ?>">
		<?php
	}

endif;
if ( ! colormag_maybe_enable_builder() ){
add_action( 'colormag_action_before_header', 'colormag_header_start', 10 );
}

if ( ! function_exists( 'colormag_header_main' ) ) :

	/**
	 * Header main area.
	 */
	function colormag_header_main() {

		get_template_part( 'template-parts/header/header-main' );
	}

endif;

add_action( 'colormag_action_header', 'colormag_header_main', 10 );

if ( ! function_exists( 'colormag_header_one' ) ) :

	/**
	 * Function to display the middle header bar.
	 *
	 * @since ColorMag 2.2.1
	 */
	function colormag_header_one() {
		?>

	<div id="cm-header-1" class="cm-header-1">
		<div class="cm-container">
			<div class="cm-row">

				<div class="cm-header-col-1">
					<?php get_template_part( 'template-parts/header/site-branding/site-branding' ); ?>
				</div><!-- .cm-header-col-1 -->

				<div class="cm-header-col-2">
					<?php
					if ( is_active_sidebar( 'colormag_header_sidebar' ) ) {
						?>
					<div id="header-right-sidebar" class="clearfix">
						<?php dynamic_sidebar( 'colormag_header_sidebar' ); ?>
					</div>
						<?php
					}
					?>
			</div><!-- .cm-header-col-2 -->

		</div>
	</div>
</div>
		<?php
	}

endif;

	add_action( 'colormag_header_one', 'colormag_header_one' );

if ( ! function_exists( 'colormag_header_two' ) ) :

	/**
	 * Function to display the middle header bar.
	 *
	 * @since ColorMag 2.2.1
	 */
	function colormag_header_two() {

		$random_post_icon = get_theme_mod( 'colormag_enable_random_post', 0 );
		$search_icon      = get_theme_mod( 'colormag_enable_search', 0 );

		if ( function_exists( 'max_mega_menu_is_enabled' ) && max_mega_menu_is_enabled( 'primary' ) ) :
			?>

	<div class="mega-menu-integrate">
		<div class="inner-wrap clearfix">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'primary',
					)
				);
				?>
		</div>
	</div>

		<?php else : ?>

<div id="cm-header-2" class="cm-header-2">
	<nav id="cm-primary-nav" class="cm-primary-nav">
		<div class="cm-container">
			<div class="cm-row">
				<?php
				if ( 'home-icon' === get_theme_mod( 'colormag_menu_icon_logo', 'none' ) ) {
					$home_icon_class = 'cm-home-icon';

					if ( is_front_page() ) {
						$home_icon_class = 'cm-home-icon front_page_on';
					}
					?>

				<div class="<?php echo esc_attr( $home_icon_class ); ?>">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>"
						title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"
					>
						<?php colormag_get_icon( 'home' ); ?>
					</a>
				</div>
				<?php } ?>

							<?php

							if ( 1 == $random_post_icon || 1 == $search_icon ) {
								?>
				<div class="cm-header-actions">
								<?php

								// Displays the random post.
								if ( 1 == $random_post_icon ) {
									colormag_random_post();
								}

								// Displays the search icon.
								if ( 1 == $search_icon ) {
									?>
					<div class="cm-top-search">
						<i class="fa fa-search search-top"></i>
						<div class="search-form-top">
									<?php get_search_form(); ?>
						</div>
					</div>
					<?php } ?>
				</div>
				<?php } ?>

					<p class="cm-menu-toggle" aria-expanded="false">
						<?php colormag_get_icon( 'bars' ); ?>
						<?php colormag_get_icon( 'x-mark' ); ?>
					</p>
					<?php
						get_template_part(
							'template-parts/header/primary-menu/main-navigation',
							null,
							array(
								'id'    => 'cm-primary-nav',
								'class' => 'cm-primary-nav',
							)
						);
					?>

			</div>
		</div>
	</nav>
</div>
			<?php
		endif;
	}

endif;

	add_action( 'colormag_header_two', 'colormag_header_two' );

if ( ! function_exists( 'colormag_header_image_before_nav_container_end' ) ) :

	/**
	 * Display the header image just before the header closes.
	 */
	function colormag_header_image_before_nav_container_end() {
		$colormag_header_media_position = get_theme_mod( 'colormag_header_media_position', 'position-two' );

		if ( 'position-three' === $colormag_header_media_position ) {
			the_custom_header_markup();
		}
	}

endif;

	add_action( 'colormag_action_after_inner_header', 'colormag_header_image_before_nav_container_end', 5 );

if ( ! function_exists( 'colormag_header_end' ) ) :

	/**
	 * Header ends.
	 */
	function colormag_header_end() {
		?>
		</header><!-- #cm-masthead -->
		<?php
	}

endif;
if ( ! colormag_maybe_enable_builder() ){
	add_action( 'colormag_action_after_header', 'colormag_header_end', 10 );
	}

if ( ! function_exists( 'colormag_main_section_start' ) ) :

	/**
	 * Main section starts.
	 */
	function colormag_main_section_start() {
		?>
	<div id="cm-content" class="cm-content">
		<?php
	}

endif;

add_action( 'colormag_action_before_content', 'colormag_main_section_start', 10 );

if ( ! function_exists( 'colormag_front_page_full_width_sidebar' ) ) :

	/**
	 * Front page full width sidebar area.
	 */
	function colormag_front_page_full_width_sidebar() {

		if ( ( is_front_page() || is_page_template( 'page-templates/magazine.php' ) ) && ! is_page_template( 'page-templates/page-builder.php' ) && is_active_sidebar( 'colormag_front_page_top_full_width_area' ) ) :
			?>
			<div class="top-full-width-sidebar inner-wrap clearfix">
				<?php
					dynamic_sidebar( 'colormag_front_page_top_full_width_area' );
				?>
			</div>
			<?php
		endif;
	}

endif;

	add_action( 'colormag_action_before_content', 'colormag_front_page_full_width_sidebar', 20 );

if ( ! function_exists( 'colormag_main_section_inner_start' ) ) :

	/**
	 * Main section inner starts.
	 */
	function colormag_main_section_inner_start() {
		?>
		<div class="cm-container">
		<?php
	}

endif;

add_action( 'colormag_action_before_inner_content', 'colormag_main_section_inner_start', 10 );


if ( ! function_exists( 'colormag_change_logo_attr' ) ) :

	/**
	 * Change the image attributes while retina logo is set.
	 *
	 * @param $attr
	 * @param $attachment
	 * @param $size
	 *
	 * @return mixed
	 */
	function colormag_change_logo_attr( $attr, $attachment, $size ) {

		$custom_logo = get_theme_mod( 'custom_logo' );
		$retina_logo = get_theme_mod( 'colormag_retina_logo' );
		if ( $custom_logo && $retina_logo && isset( $attr['class'] ) && 'custom-logo' === $attr['class'] ) {
			$custom_logo_src = wp_get_attachment_image_src( $custom_logo, 'full' );
			if ( ! $custom_logo_src ) {
				return $attr;
			}       $custom_logo_url = $custom_logo_src[0];
			if ( is_numeric( $retina_logo ) ) {
				$retina_logo_attachment = wp_get_attachment_image_src( $retina_logo, 'full' );
				if ( isset( $retina_logo_attachment[0] ) ) {
					$retina_logo_src = $retina_logo_attachment[0];
				}
			} else {
				$retina_logo_id         = attachment_url_to_postid( $retina_logo );
				$retina_logo_attachment = wp_get_attachment_image_src( $retina_logo_id, 'full' );
				if ( isset( $retina_logo_attachment[0] ) ) {
							$retina_logo_src = $retina_logo_attachment[0];
				}
			}         if ( isset( $retina_logo_src ) ) {
				$attr['srcset'] = $custom_logo_url . ' 1x, ' . $retina_logo_src . ' 2x';
			}
		}    return $attr;
	}

endif;

add_filter( 'wp_get_attachment_image_attributes', 'colormag_change_logo_attr', 10, 3 );

if ( ! function_exists( 'colormag_add_submenu_icon' ) ) :

	/**
	 * Add submenu toggle icon after the menu items with submenus.
	 *
	 * @param string $item_output The menu item's starting HTML output.
	 * @param WP_Post $item Menu item data object.
	 * @param int $depth Depth of menu item. Used for padding.
	 * @param stdClass $args An object of wp_nav_menu() arguments.
	 *
	 * @return array|mixed|string|string[]
	 *
	 * TODO @since.
	 *
	 */
	function colormag_add_submenu_icon( $item_output, $item, $depth, $args ) {

		if ( 'primary' === $args->theme_location || 'menu-secondary' === $args->theme_location ) {

			if (
				in_array( 'menu-item-has-children', $item->classes, true ) ||
				in_array( 'page_item_has_children', $item->classes, true )
			) {

				$submenu_toggle_markup = '<span role="button" tabindex="0" class="cm-submenu-toggle" onkeypress="">' .
										'<svg class="cm-icon" xmlns="http://www.w3.org/2000/svg" xml:space="preserve" viewBox="0 0 24 24"><path d="M12 17.5c-.3 0-.5-.1-.7-.3l-9-9c-.4-.4-.4-1 0-1.4s1-.4 1.4 0l8.3 8.3 8.3-8.3c.4-.4 1-.4 1.4 0s.4 1 0 1.4l-9 9c-.2.2-.4.3-.7.3z"/></svg>' .
										'</span>';

				$item_output = str_replace(
					$args->link_after . '</a>',
					$args->link_after . '</a>' . $submenu_toggle_markup,
					$item_output
				);
			}
		}

		return $item_output;
	}

endif;

add_filter( 'walker_nav_menu_start_el', 'colormag_add_submenu_icon', 10, 4 );

if ( ! function_exists( 'colormag_breadcrumb' ) ) :

	/**
	 * Display the breadcrumbs provided via Yoast or BreadCrumb NavXT plugin,
	 * where BreadCrumb NavXT plugin takes precedence.
	 */
	function colormag_breadcrumb() {

		// Bail out if breadcrumb is not selected.
		if ( 1 == get_theme_mod( 'colormag_breadcrumb_enable', 0 ) ) {
			?>
		<!-- Breadcrumb display -->
		<div id="breadcrumb-wrap" class="breadcrumb-wrap" typeof="BreadcrumbList">
			<div class="inner-wrap">
			<?php
			if ( function_exists( 'breadcrumb_trail' ) ) {
				if ( ColorMag_Utils::colormag_is_woocommerce_active() && function_exists( 'is_woocommerce' ) && is_woocommerce() ) {

					// Make WC breadcrumb with the theme.
					woocommerce_breadcrumb(
						array(
							'wrap_before' => '<nav role="navigation" aria-label="' . esc_html__( 'Breadcrumbs', 'colormag' ) . '" class="breadcrumb-trail breadcrumbs">' . '<span class="breadcrumb-title">' . get_theme_mod( 'colormag_breadcrumb_label', esc_html__( 'You are here: ', 'colormag' ) ) . '</span>' . '<ul class="trail-items">',
							'wrap_after'  => '</ul></nav>',
							'before'      => '<li class="trail-item">',
							'after'       => '</li>',
							'delimiter'   => '',
						)
					);
				} else {
					do_action( 'colormag_action_breadcrumb' );
				}
			}
			?>
			</div>
		</div>
			<?php
		}
	}
endif;

	add_action( 'colormag_action_before_content', 'colormag_breadcrumb', 15 );

if ( ! function_exists( 'colormag_theme_breadcrumb' ) ) :
	/**
	 * Container starts.
	 */
	function colormag_theme_breadcrumb() {
		breadcrumb_trail(
			array(
				'show_browse' => false,
			)
		);
	}
endif;

add_action( 'colormag_action_breadcrumb', 'colormag_theme_breadcrumb', 10 );


if ( ! function_exists( 'colormag_menu_fallback' ) ) :

	/**
	 * Menu fallback for primary menu.
	 *
	 * Contains wp_list_pages to display pages created,
	 * search icons and WooCommerce cart icon.
	 */
	function colormag_menu_fallback( $args ) {

		$id    = $args['menu_id'] ?? 'cm-primary-menu';
		$class = $args['menu_class'] ?? 'cm-primary-menu';
		require get_template_directory() . '/inc/class-colormag-walker-page.php';
		$output = '<ul id="' . $id . '" class="' . $class . '">';

		$output .= wp_list_pages(
			array(
				'echo'               => false,
				'title_li'           => false,
				'walker'             => new Colormag_Walker_Page(),
				'has_children_class' => 'menu-item-has-children',
				'current_class'      => 'current-menu-item',
			)
		);

		$output .= '</ul>';

		// @codingStandardsIgnoreStart
		echo $output;
		// @codingStandardsIgnoreEnd
	}

endif;
