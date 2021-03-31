<?php
/**
 * Custom template tags for this theme.
 *
 * @package    ThemeGrill
 * @subpackage ColorMag
 * @since      ColorMag 2.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'colormag_entry_meta' ) ) :

	/**
	 * Shows meta information of post.
	 *
	 * @param bool $full_post_meta Whether to display full post meta or not.
	 */
	function colormag_entry_meta( $full_post_meta = true ) {

		if ( 'post' == get_post_type() ) :

			echo '<div class="below-entry-meta">';
			?>

			<?php
			// Displays the same published and updated date if the post is never updated.
			$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

			// Displays the different published and updated date if the post is updated.
			if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
				$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
			}

			$time_string = sprintf(
				$time_string,
				esc_attr( get_the_date( 'c' ) ),
				esc_html( get_the_date() ),
				esc_attr( get_the_modified_date( 'c' ) ),
				esc_html( get_the_modified_date() )
			);

			printf(
			/* Translators: 1. Post link, 2. Post time, 3. Post date */
				__( '<span class="posted-on"><a href="%1$s" title="%2$s" rel="bookmark"><i class="fa fa-calendar-o"></i> %3$s</a></span>', 'colormag' ),
				esc_url( get_permalink() ),
				esc_attr( get_the_time() ),
				$time_string
			); // phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped
			?>

			<span class="byline">
				<span class="author vcard">
					<i class="fa fa-user"></i>
					<a class="url fn n"
					   href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"
					   title="<?php echo get_the_author(); ?>"
					>
						<?php echo esc_html( get_the_author() ); ?>
					</a>
				</span>
			</span>

			<?php if ( ! post_password_required() && comments_open() ) { ?>
				<span class="comments">
						<?php
						if ( $full_post_meta ) {
							comments_popup_link(
								__( '<i class="fa fa-comment"></i> 0 Comments', 'colormag' ),
								__( '<i class="fa fa-comment"></i> 1 Comment', 'colormag' ),
								__( '<i class="fa fa-comments"></i> % Comments', 'colormag' )
							);
						} else {
							?>
							<i class="fa fa-comment"></i><?php comments_popup_link( '0', '1', '%' ); ?>
							<?php
						}
						?>
					</span>
				<?php
			}

			if ( $full_post_meta ) {
				$tags_list = get_the_tag_list( '<span class="tag-links"><i class="fa fa-tags"></i>', __( ', ', 'colormag' ), '</span>' );

				if ( $tags_list ) {
					echo $tags_list; // phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped
				}
			}

			if ( $full_post_meta ) {
				edit_post_link( __( 'Edit', 'colormag' ), '<span class="edit-link"><i class="fa fa-edit"></i>', '</span>' );
			}

			echo '</div>';

		endif;

	}

endif;


if ( ! function_exists( 'wp_body_open' ) ) :

	/**
	 * Adds backwards compatibility for wp_body_open() introduced with WordPress 5.2.
	 *
	 * @return void
	 * @see   https://developer.wordpress.org/reference/functions/wp_body_open/
	 */
	function wp_body_open() {
		do_action( 'wp_body_open' );
	}

endif;


if ( ! function_exists( 'colormag_category_color' ) ) :

	/**
	 * Getting Category Color.
	 *
	 * @param int $wp_category_id Category id.
	 *
	 * @return string The category color.
	 */
	function colormag_category_color( $wp_category_id ) {

		$args     = array(
			'orderby'    => 'id',
			'hide_empty' => 0,
		);
		$category = get_categories( $args );

		foreach ( $category as $category_list ) {
			$color = get_theme_mod( 'colormag_category_color_' . $wp_category_id );

			return $color;
		}

	}

endif;


if ( ! function_exists( 'colormag_colored_category' ) ) :

	/**
	 * Category Color for widgets and other
	 *
	 * @param bool $echo Boolean value to echo or just return.
	 *
	 * @return mixed
	 */
	function colormag_colored_category( $echo = true ) {

		global $post;
		$categories = get_the_category();
		$separator  = '&nbsp;';
		$output     = '';

		if ( $categories ) {
			$output .= '<div class="above-entry-meta"><span class="cat-links">';

			foreach ( $categories as $category ) {
				$color_code = colormag_category_color( get_cat_id( $category->cat_name ) );
				if ( ! empty( $color_code ) ) {
					$output .= '<a href="' . get_category_link( $category->term_id ) . '" style="background:' . colormag_category_color( get_cat_id( $category->cat_name ) ) . '" rel="category tag">' . $category->cat_name . '</a>' . $separator;
				} else {
					$output .= '<a href="' . get_category_link( $category->term_id ) . '"  rel="category tag">' . $category->cat_name . '</a>' . $separator;
				}
			}

			$output .= '</span></div>';

			if ( $echo ) {
				echo trim( $output, $separator ); // phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped
			} else {
				return trim( $output, $separator );
			}
		}

	}

endif;


if ( ! function_exists( 'colormag_sidebar_select' ) ) :

	/**
	 * Function to display the sidebar selected.
	 */
	function colormag_sidebar_select() {

		global $post;

		if ( $post ) {
			$layout_meta = get_post_meta( $post->ID, 'colormag_page_layout', true );
		}

		if ( is_home() ) {
			$queried_id  = get_option( 'page_for_posts' );
			$layout_meta = get_post_meta( $queried_id, 'colormag_page_layout', true );
		}

		if ( empty( $layout_meta ) || is_archive() || is_search() ) {
			$layout_meta = 'default_layout';
		}

		$colormag_default_layout      = get_theme_mod( 'colormag_default_layout', 'right_sidebar' );
		$colormag_default_page_layout = get_theme_mod( 'colormag_default_page_layout', 'right_sidebar' );
		$colormag_default_post_layout = get_theme_mod( 'colormag_default_single_posts_layout', 'right_sidebar' );

		if ( 'default_layout' === $layout_meta ) {
			if ( is_page() ) {
				colormag_get_sidebar( $colormag_default_page_layout );
			} elseif ( is_single() ) {
				colormag_get_sidebar( $colormag_default_post_layout );
			} else {
				colormag_get_sidebar( $colormag_default_layout );
			}
		} else {
			colormag_get_sidebar( $layout_meta );
		}

	}

endif;


if ( ! function_exists( 'colormag_social_links' ) ) :

	/**
	 * Displays the social links.
	 */
	function colormag_social_links() {

		// Bail out if social links is not activated.
		if ( 0 == get_theme_mod( 'colormag_social_icons_activate', 0 ) ) {
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
				/**
				 * Social links set which is static via the theme customize option.
				 */
				$i                     = 0;
				$colormag_links_output = '';
				foreach ( $colormag_social_links as $key => $value ) {
					$link = get_theme_mod( $key, '' );

					if ( ! empty( $link ) ) {
						$new_tab = '';

						// For opening link in new tab.
						if ( 1 == get_theme_mod( $key . '_checkbox', 0 ) ) {
							$new_tab = 'target="_blank"';
						}

						$colormag_links_output .= '<li><a href="' . esc_url( $link ) . '" ' . $new_tab . '><i class="fa fa-' . strtolower( $value ) . '"></i></a></li>';
					}

					$i ++;
				}

				// Displays the social links which is set static via theme customize option.
				echo $colormag_links_output; // phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped
				?>
			</ul>
		</div><!-- .social-links -->
		<?php

	}

endif;


if ( ! function_exists( 'colormag_date_display' ) ) :

	/**
	 * Display the date in the header.
	 */
	function colormag_date_display() {

		// Bail out if date in header option is disabled.
		if ( 0 == get_theme_mod( 'colormag_date_display', 0 ) ) {
			return;
		}
		?>

		<div class="date-in-header">
			<?php
			if ( 'theme_default' == get_theme_mod( 'colormag_date_display_type', 'theme_default' ) ) {
				echo esc_html( date_i18n( 'l, F j, Y' ) );
			} elseif ( 'wordpress_date_setting' == get_theme_mod( 'colormag_date_display_type', 'theme_default' ) ) {
				echo esc_html( date_i18n( get_option( 'date_format' ) ) );
			}
			?>
		</div>

		<?php
	}

endif;


if ( ! function_exists( 'colormag_top_header_bar_display' ) ) :

	/**
	 * Function to display the top header bar.
	 *
	 * @since ColorMag 1.2.2
	 */
	function colormag_top_header_bar_display() {

		$breaking_news_enable  = get_theme_mod( 'colormag_breaking_news', 0 );
		$date_display_enable   = get_theme_mod( 'colormag_date_display', 0 );
		$social_links_enable   = get_theme_mod( 'colormag_social_icons_activate', 0 );
		$social_links_location = get_theme_mod( 'colormag_social_icons_header_activate', 1 );

		if ( 1 == $date_display_enable || 1 == $breaking_news_enable || ( 1 == $social_links_enable && 1 == $social_links_location  ) ) :
			?>

			<div class="news-bar">
				<div class="inner-wrap clearfix">
					<?php
					// Displays the current date.
					if ( 1 == $date_display_enable ) {
						colormag_date_display();
					}

					// Displays the breaking news.
					if ( 1 == $breaking_news_enable ) {
						colormag_breaking_news();
					}

					// Displays the social links in header.
					if ( 1 == $social_links_enable && 1 == $social_links_location ) {
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
	 * Function to display the middle header bar.
	 *
	 * @since ColorMag 1.2.2
	 */
	function colormag_middle_header_bar_display() {

		$screen_reader       = '';
		$description         = get_bloginfo( 'description', 'display' );
		$header_display_type = get_theme_mod( 'colormag_header_logo_placement', 'header_text_only' );
		?>

		<div class="inner-wrap">
			<div id="header-text-nav-wrap" class="clearfix">

				<div id="header-left-section">
					<?php
					if ( 'show_both' === $header_display_type || 'header_logo_only' === $header_display_type ) {
						?>
						<div id="header-logo-image">
							<?php
							if ( function_exists( 'the_custom_logo' ) ) {
								the_custom_logo();
							}
							?>
						</div><!-- #header-logo-image -->
						<?php
					}

					if ( 'header_logo_only' === $header_display_type || 'disable' === ( $header_display_type ) ) {
						$screen_reader = 'screen-reader-text';
					}
					?>

					<div id="header-text" class="<?php echo esc_attr( $screen_reader ); ?>">
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
						if ( $description || is_customize_preview() ) :
							?>
							<p id="site-description">
								<?php echo $description; // phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped ?>
							</p><!-- #site-description -->
						<?php endif; ?>
					</div><!-- #header-text -->
				</div><!-- #header-left-section -->

				<div id="header-right-section">
					<?php
					if ( is_active_sidebar( 'colormag_header_sidebar' ) ) {
						?>
						<div id="header-right-sidebar" class="clearfix">
							<?php dynamic_sidebar( 'colormag_header_sidebar' ); ?>
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
	 * Function to display the middle header bar.
	 *
	 * @since ColorMag 1.2.2
	 */
	function colormag_below_header_bar_display() {

		$random_post_icon = get_theme_mod( 'colormag_random_post_in_menu', 0 );
		$search_icon      = get_theme_mod( 'colormag_search_icon_in_menu', 0 );
		?>

		<nav id="site-navigation" class="main-navigation clearfix" role="navigation">
			<div class="inner-wrap clearfix">
				<?php
				if ( 1 == get_theme_mod( 'colormag_home_icon_display', 0 ) ) {
					$home_icon_class = 'home-icon';
					if ( is_front_page() ) {
						$home_icon_class = 'home-icon front_page_on';
					}
					?>

					<div class="<?php echo esc_attr( $home_icon_class ); ?>">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>"
						   title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"
						>
							<i class="fa fa-home"></i>
						</a>
					</div>
				<?php } ?>

				<?php if ( 1 == $random_post_icon || 1 == $search_icon ) { ?>
					<div class="search-random-icons-container">
						<?php
						// Displays the random post.
						if ( 1 == $random_post_icon ) {
							colormag_random_post();
						}

						// Displays the search icon.
						if ( 1 == $search_icon ) {
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
					wp_nav_menu(
						array(
							'theme_location'  => 'primary',
							'container_class' => 'menu-primary-container',
							'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
						)
					);
				} else {
					wp_page_menu();
				}
				?>

			</div>
		</nav>

		<?php

	}

endif;


if ( ! function_exists( 'colormag_comment' ) ) :

	/**
	 * Template for comments and pingbacks.
	 *
	 * Used as a callback by wp_list_comments() for displaying the comments.
	 *
	 * @param WP_Comment $comment Comment to display.
	 * @param array      $args    An array of arguments.
	 * @param int        $depth   Depth of the current comment.
	 */
	function colormag_comment( $comment, $args, $depth ) {

		$GLOBALS['comment'] = $comment;
		switch ( $comment->comment_type ) :

			case 'pingback':
			case 'trackback':
				// Display trackbacks differently than normal comments.
				?>
				<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
				<p>
					<?php esc_html_e( 'Pingback:', 'colormag' ); ?>
					<?php comment_author_link(); ?>
					<?php edit_comment_link( __( '(Edit)', 'colormag' ), '<span class="edit-link">', '</span>' ); ?>
				</p>
				<?php
				break;

			default:
				// Proceed with normal comments.
				global $post;
				?>
				<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
					<article id="comment-<?php comment_ID(); ?>" class="comment">
						<header class="comment-meta comment-author vcard">
							<?php
							echo get_avatar( $comment, 74 );

							printf(
								'<div class="comment-author-link"><i class="fa fa-user"></i>%1$s%2$s</div>',
								get_comment_author_link(),
								// If current post author is also comment author, make it known visually.
								( $comment->user_id === $post->post_author ) ? '<span>' . esc_html__( 'Post author', 'colormag' ) . '</span>' : ''
							);

							printf(
								'<div class="comment-date-time"><i class="fa fa-calendar-o"></i>%1$s</div>',
								sprintf(
									/* Translators: 1. Comment date, 2. Comment time */
									esc_html__( '%1$s at %2$s', 'colormag' ),
									esc_html( get_comment_date() ),
									esc_html( get_comment_time() )
								)
							);

							printf(
								'<a class="comment-permalink" href="%1$s"><i class="fa fa-link"></i>' . esc_html__( 'Permalink', 'colormag' ) . '</a>',
								esc_url( get_comment_link( $comment->comment_ID ) )
							); // phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped

							edit_comment_link();
							?>
						</header><!-- .comment-meta -->

						<?php if ( '0' == $comment->comment_approved ) : ?>
							<p class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'colormag' ); ?></p>
						<?php endif; ?>

						<section class="comment-content comment">
							<?php
							comment_text();

							comment_reply_link(
								array_merge(
									$args,
									array(
										'reply_text' => esc_html__( 'Reply', 'colormag' ),
										'after'      => '',
										'depth'      => $depth,
										'max_depth'  => $args['max_depth'],
									)
								)
							);
							?>
						</section><!-- .comment-content -->

					</article><!-- #comment-## -->
				<?php
				break;

		endswitch; // End comment_type check.

	}

endif;


if ( ! function_exists( 'colormag_plugin_version_compare' ) ) :

	/**
	 * Compare user's current version of plugin.
	 *
	 * @param string $plugin_slug        The plugin slug.
	 * @param string $version_to_compare The plugin's version.
	 *
	 * @return bool
	 */
	function colormag_plugin_version_compare( $plugin_slug, $version_to_compare ) {
		$installed_plugins = get_plugins();

		// Plugin not installed.
		if ( ! isset( $installed_plugins[ $plugin_slug ] ) ) {
			return false;
		}

		$plugin_version = $installed_plugins[ $plugin_slug ]['Version'];

		return version_compare( $plugin_version, $version_to_compare, '<' );
	}

endif;
