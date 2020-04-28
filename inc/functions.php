<?php
/**
 * ColorMag functions and definitions
 *
 * This file contains all the functions and it's defination that particularly can't be
 * in other files.
 *
 * @package    ThemeGrill
 * @subpackage ColorMag
 * @since      ColorMag 1.0
 */

add_filter( 'body_class', 'colormag_body_class' );
/**
 * Filter the body_class
 *
 * Throwing different body class for the different layouts in the body tag
 */
function colormag_body_class( $classes ) {
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
	$colormag_default_layout = get_theme_mod( 'colormag_default_layout', 'right_sidebar' );

	$colormag_default_page_layout = get_theme_mod( 'colormag_default_page_layout', 'right_sidebar' );
	$colormag_default_post_layout = get_theme_mod( 'colormag_default_single_posts_layout', 'right_sidebar' );

	if ( $layout_meta == 'default_layout' ) {
		if ( is_page() ) {
			if ( $colormag_default_page_layout == 'right_sidebar' ) {
				$classes[] = '';
			} elseif ( $colormag_default_page_layout == 'left_sidebar' ) {
				$classes[] = 'left-sidebar';
			} elseif ( $colormag_default_page_layout == 'no_sidebar_full_width' ) {
				$classes[] = 'no-sidebar-full-width';
			} elseif ( $colormag_default_page_layout == 'no_sidebar_content_centered' ) {
				$classes[] = 'no-sidebar';
			}
		} elseif ( is_single() ) {
			if ( $colormag_default_post_layout == 'right_sidebar' ) {
				$classes[] = '';
			} elseif ( $colormag_default_post_layout == 'left_sidebar' ) {
				$classes[] = 'left-sidebar';
			} elseif ( $colormag_default_post_layout == 'no_sidebar_full_width' ) {
				$classes[] = 'no-sidebar-full-width';
			} elseif ( $colormag_default_post_layout == 'no_sidebar_content_centered' ) {
				$classes[] = 'no-sidebar';
			}
		} elseif ( $colormag_default_layout == 'right_sidebar' ) {
			$classes[] = '';
		} elseif ( $colormag_default_layout == 'left_sidebar' ) {
			$classes[] = 'left-sidebar';
		} elseif ( $colormag_default_layout == 'no_sidebar_full_width' ) {
			$classes[] = 'no-sidebar-full-width';
		} elseif ( $colormag_default_layout == 'no_sidebar_content_centered' ) {
			$classes[] = 'no-sidebar';
		}
	} elseif ( $layout_meta == 'right_sidebar' ) {
		$classes[] = '';
	} elseif ( $layout_meta == 'left_sidebar' ) {
		$classes[] = 'left-sidebar';
	} elseif ( $layout_meta == 'no_sidebar_full_width' ) {
		$classes[] = 'no-sidebar-full-width';
	} elseif ( $layout_meta == 'no_sidebar_content_centered' ) {
		$classes[] = 'no-sidebar';
	}

	if ( get_theme_mod( 'colormag_site_layout', 'wide_layout' ) == 'wide_layout' ) {
		$classes[] = 'wide';
	} elseif ( get_theme_mod( 'colormag_site_layout', 'wide_layout' ) == 'boxed_layout' ) {
		$classes[] = '';
	}

	if ( get_theme_mod( 'colormag_responsive_menu', 0 ) == 1 ) {
		$classes[] = 'better-responsive-menu';
	}

	// Add body class for body skin type
	if ( get_theme_mod( 'colormag_color_skin_setting', 'white' ) == 'dark' ) {
		$classes[] = 'dark-skin';
	}

	return $classes;
}

/****************************************************************************************/

if ( ! function_exists( 'colormag_sidebar_select' ) ) :
	/**
	 * Function to select the sidebar
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
		$colormag_default_layout = get_theme_mod( 'colormag_default_layout', 'right_sidebar' );

		$colormag_default_page_layout = get_theme_mod( 'colormag_default_page_layout', 'right_sidebar' );
		$colormag_default_post_layout = get_theme_mod( 'colormag_default_single_posts_layout', 'right_sidebar' );

		if ( $layout_meta == 'default_layout' ) {
			if ( is_page() ) {
				if ( $colormag_default_page_layout == 'right_sidebar' ) {
					get_sidebar();
				} elseif ( $colormag_default_page_layout == 'left_sidebar' ) {
					get_sidebar( 'left' );
				}
			}
			if ( is_single() ) {
				if ( $colormag_default_post_layout == 'right_sidebar' ) {
					get_sidebar();
				} elseif ( $colormag_default_post_layout == 'left_sidebar' ) {
					get_sidebar( 'left' );
				}
			} elseif ( $colormag_default_layout == 'right_sidebar' ) {
				get_sidebar();
			} elseif ( $colormag_default_layout == 'left_sidebar' ) {
				get_sidebar( 'left' );
			}
		} elseif ( $layout_meta == 'right_sidebar' ) {
			get_sidebar();
		} elseif ( $layout_meta == 'left_sidebar' ) {
			get_sidebar( 'left' );
		}
	}
endif;

/****************************************************************************************/

/****************************************************************************************/

add_action( 'wp_head', 'colormag_custom_css', 100 );
/**
 * Hooks the Custom Internal CSS to head section
 */
function colormag_custom_css() {
	$colormag_internal_css = '';

	if ( ! empty( $colormag_internal_css ) ) {
		echo '<!-- ' . get_bloginfo( 'name' ) . ' Internal Styles -->';
		?>
		<style type="text/css"><?php echo $colormag_internal_css; ?></style>
		<?php
	}
}

/**************************************************************************************/

add_action( 'colormag_footer_copyright', 'colormag_footer_copyright', 10 );
/**
 * function to show the footer info, copyright information
 */
if ( ! function_exists( 'colormag_footer_copyright' ) ) :
	function colormag_footer_copyright() {
		$site_link = '<a href="' . esc_url( home_url( '/' ) ) . '" title="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '" ><span>' . get_bloginfo( 'name', 'display' ) . '</span></a>';

		$wp_link = '<a href="https://wordpress.org" target="_blank" title="' . esc_attr__( 'WordPress', 'colormag' ) . '"><span>' . __( 'WordPress', 'colormag' ) . '</span></a>';

		$tg_link = '<a href="https://themegrill.com/themes/colormag" target="_blank" title="' . esc_attr__( 'ThemeGrill', 'colormag' ) . '" rel="author"><span>' . __( 'ThemeGrill', 'colormag' ) . '</span></a>';

		$default_footer_value = sprintf( __( 'Copyright &copy; %1$s %2$s. All rights reserved.', 'colormag' ), date( 'Y' ), $site_link ) . '<br>' . sprintf( __( 'Theme: %1$s by %2$s.', 'colormag' ), 'ColorMag', $tg_link ) . ' ' . sprintf( __( 'Powered by %s.', 'colormag' ), $wp_link );

		$colormag_footer_copyright = '<div class="copyright">' . $default_footer_value . '</div>';
		echo $colormag_footer_copyright;
	}
endif;


/**************************************************************************************/

/*
 * Breaking News/Latest Posts ticker section in the header
 */
if ( ! function_exists( 'colormag_breaking_news' ) ) :
	function colormag_breaking_news() {
		$post_status = 'publish';
		if ( get_option( 'fresh_site' ) == 1 ) {
			$post_status = array( 'auto-draft', 'publish' );
		}

		$get_featured_posts = new WP_Query( array(
			'posts_per_page'      => 5,
			'post_type'           => 'post',
			'ignore_sticky_posts' => true,
			'post_status'         => $post_status,
		) );
		?>
		<div class="breaking-news">
			<strong class="breaking-news-latest"><?php _e( 'Latest:', 'colormag' ); ?></strong>
			<ul class="newsticker">
				<?php while ( $get_featured_posts->have_posts() ):$get_featured_posts->the_post(); ?>
					<li>
						<a href="<?php the_permalink(); ?>"
						   title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
					</li>
				<?php endwhile; ?>
			</ul>
		</div>
		<?php
		// Reset Post Data
		wp_reset_query();
	}
endif;

/**************************************************************************************/

/*
 * Display the date in the header
 */
if ( ! function_exists( 'colormag_date_display' ) ) :
	function colormag_date_display() {
		if ( get_theme_mod( 'colormag_date_display', 0 ) == 0 ) {
			return;
		} ?>

		<div class="date-in-header">
			<?php
			if ( get_theme_mod( 'colormag_date_display_type', 'theme_default' ) == 'theme_default' ) {
				echo date_i18n( 'l, F j, Y' );
			} elseif ( get_theme_mod( 'colormag_date_display_type', 'theme_default' ) == 'wordpress_date_setting' ) {
				echo date_i18n( get_option( 'date_format' ) );
			}
			?>
		</div>

		<?php
	}
endif;

/**************************************************************************************/

/*
 * Random Post in header
 */
if ( ! function_exists( 'colormag_random_post' ) ) :
	function colormag_random_post() {
		// Bail out if random post in menu is not activated
		if ( get_theme_mod( 'colormag_random_post_in_menu', 0 ) == 0 ) {
			return;
		}

		$get_random_post = new WP_Query( array(
			'posts_per_page'      => 1,
			'post_type'           => 'post',
			'ignore_sticky_posts' => true,
			'orderby'             => 'rand',
		) );
		?>
		<div class="random-post">
			<?php while ( $get_random_post->have_posts() ):$get_random_post->the_post(); ?>
				<a href="<?php the_permalink(); ?>" title="<?php _e( 'View a random post', 'colormag' ); ?>"><i
							class="fa fa-random"></i></a>
			<?php endwhile; ?>
		</div>
		<?php
		// Reset Post Data
		wp_reset_query();
	}
endif;

/**************************************************************************************/

/*
 * Display the related posts
 */
if ( ! function_exists( 'colormag_related_posts_function' ) ) {

	function colormag_related_posts_function() {
		wp_reset_postdata();
		global $post;

		// Define shared post arguments
		$args = array(
			'no_found_rows'          => true,
			'update_post_meta_cache' => false,
			'update_post_term_cache' => false,
			'ignore_sticky_posts'    => 1,
			'orderby'                => 'rand',
			'post__not_in'           => array( $post->ID ),
			'posts_per_page'         => 3,
		);
		// Related by categories
		if ( get_theme_mod( 'colormag_related_posts', 'categories' ) == 'categories' ) {

			$cats = get_post_meta( $post->ID, 'related-posts', true );

			if ( ! $cats ) {
				$cats                 = wp_get_post_categories( $post->ID, array( 'fields' => 'ids' ) );
				$args['category__in'] = $cats;
			} else {
				$args['cat'] = $cats;
			}
		}
		// Related by tags
		if ( get_theme_mod( 'colormag_related_posts', 'categories' ) == 'tags' ) {

			$tags = get_post_meta( $post->ID, 'related-posts', true );

			if ( ! $tags ) {
				$tags            = wp_get_post_tags( $post->ID, array( 'fields' => 'ids' ) );
				$args['tag__in'] = $tags;
			} else {
				$args['tag_slug__in'] = explode( ',', $tags );
			}
			if ( ! $tags ) {
				$break = true;
			}
		}

		$query = ! isset( $break ) ? new WP_Query( $args ) : new WP_Query();

		return $query;
	}

}

/**************************************************************************************/

/*
 * Category Color for widgets and other
 */
if ( ! function_exists( 'colormag_colored_category' ) ) :
	function colormag_colored_category() {
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
			echo trim( $output, $separator );
		}
	}
endif;

/**************************************************************************************/

/*
 * Creating responsive video for posts/pages
 */
if ( ! function_exists( 'colormag_responsive_video' ) ) :
	function colormag_responsive_video( $html, $url, $attr, $post_ID ) {
		return '<div class="fitvids-video">' . $html . '</div>';
	}

	add_filter( 'embed_oembed_html', 'colormag_responsive_video', 10, 4 );
endif;

/**************************************************************************************/

/*
 * Use of the hooks for Category Color in the archive titles
 */
function colormag_colored_category_title( $title ) {
	$color_value        = colormag_category_color( get_cat_id( $title ) );
	$color_border_value = colormag_category_color( get_cat_id( $title ) );
	if ( ! empty( $color_value ) ) {
		return '<h1 class="page-title" style="border-bottom-color: ' . $color_border_value . '">' . '<span style="background-color: ' . $color_value . '">' . $title . '</span></h1>';
	} else {
		return '<h1 class="page-title"><span>' . $title . '</span></h1>';
	}
}

function colormag_category_title_function( $category_title ) {
	add_filter( 'single_cat_title', 'colormag_colored_category_title' );
}

add_action( 'colormag_category_title', 'colormag_category_title_function' );

/**************************************************************************************/

/**
 * Making the theme Woocommrece compatible
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
// Remove WooCommerce default sidebar
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );

add_filter( 'woocommerce_show_page_title', '__return_false' );

add_action( 'woocommerce_before_main_content', 'colormag_wrapper_start', 10 );
add_action( 'woocommerce_after_main_content', 'colormag_wrapper_end', 10 );

function colormag_wrapper_start() {
	echo '<div id="primary">';
}

function colormag_wrapper_end() {
	echo '</div>';
	colormag_sidebar_select();
}

// Displays the site logo
if ( ! function_exists( 'colormag_the_custom_logo' ) ) {
	/**
	 * Displays the optional custom logo.
	 */
	function colormag_the_custom_logo() {
		if ( function_exists( 'the_custom_logo' ) ) {
			the_custom_logo();
		}
	}
}

if ( ! function_exists( 'colormag_pingback_header' ) ) :

	/**
	 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
	 */
	function colormag_pingback_header() {
		if ( is_singular() && pings_open() ) {
			printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
		}
	}

endif;

add_action( 'wp_head', 'colormag_pingback_header' );

/**************************************************************************************/

if ( ! function_exists( 'colormag_comment' ) ) :
	/**
	 * Template for comments and pingbacks.
	 *
	 * Used as a callback by wp_list_comments() for displaying the comments.
	 */
	function colormag_comment( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;
		switch ( $comment->comment_type ) :

			case 'pingback' :

			case 'trackback' :
			// Display trackbacks differently than normal comments.
			?>
			<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
				<p>
					<?php _e( 'Pingback:', 'colormag' ); ?>
					<?php comment_author_link(); ?>
					<?php edit_comment_link( __( '(Edit)', 'colormag' ), '<span class="edit-link">', '</span>' ); ?>
				</p>
				<?php
				break;

			default :
				// Proceed with normal comments.
				global $post;
				?>
				<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
					<article id="comment-<?php comment_ID(); ?>" class="comment">
						<header class="comment-meta comment-author vcard">
							<?php
							echo get_avatar( $comment, 74 );
							printf( '<div class="comment-author-link"><i class="fa fa-user"></i>%1$s%2$s</div>',
								get_comment_author_link(),
								// If current post author is also comment author, make it known visually.
								( $comment->user_id === $post->post_author ) ? '<span>' . __( 'Post author', 'colormag' ) . '</span>' : ''
							);
							printf( '<div class="comment-date-time"><i class="fa fa-calendar-o"></i>%1$s</div>',
								sprintf( __( '%1$s at %2$s', 'colormag' ), get_comment_date(), get_comment_time() )
							);
							printf( '<a class="comment-permalink" href="%1$s"><i class="fa fa-link"></i>Permalink</a>', esc_url( get_comment_link( $comment->comment_ID ) ) );
							edit_comment_link();
							?>
						</header><!-- .comment-meta -->

						<?php if ( '0' == $comment->comment_approved ) : ?>
							<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'colormag' ); ?></p>
						<?php endif; ?>

						<section class="comment-content comment">
							<?php comment_text(); ?>
							<?php comment_reply_link( array_merge( $args, array(
								'reply_text' => __( 'Reply', 'colormag' ),
								'after'      => '',
								'depth'      => $depth,
								'max_depth'  => $args['max_depth'],
							) ) ); ?>
						</section><!-- .comment-content -->

	</article><!-- #comment-## -->
	<?php
	break;
	endswitch; // end comment_type check
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
