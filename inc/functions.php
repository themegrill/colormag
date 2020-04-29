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
			$cats                 = wp_get_post_categories( $post->ID, array( 'fields' => 'ids' ) );
			$args['category__in'] = $cats;
		}
		// Related by tags
		if ( get_theme_mod( 'colormag_related_posts', 'categories' ) == 'tags' ) {
			$tags            = wp_get_post_tags( $post->ID, array( 'fields' => 'ids' ) );
			$args['tag__in'] = $tags;

			// If no tags added, return.
			if ( ! $tags ) {
				$break = true;
			}
		}

		$query = ! isset( $break ) ? new WP_Query( $args ) : new WP_Query();

		return $query;
	}

}
