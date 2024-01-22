<?php
/**
 * ColorMag custom WP_Query functions.
 *
 * @package    ThemeGrill
 * @subpackage ColorMag
 * @since      ColorMag 3.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


if ( ! function_exists( 'colormag_breaking_news' ) ) :

	/**
	 * Breaking News/Latest Posts ticker section in the header.
	 */
	function colormag_breaking_news() {

		$post_status = 'publish';
		if ( 1 == get_option( 'fresh_site' ) ) {
			$post_status = array( 'auto-draft', 'publish' );
		}

		// Arguments for post query.
		$args = array(
			'posts_per_page'      => 5,
			'post_type'           => 'post',
			'ignore_sticky_posts' => true,
			'post_status'         => $post_status,
		);

		$get_featured_posts = new WP_Query( $args );
		?>

		<div class="breaking-news">
			<strong class="breaking-news-latest"><?php esc_html_e( 'Latest:', 'colormag' ); ?></strong>

			<ul class="newsticker">
				<?php
				while ( $get_featured_posts->have_posts() ) :
					$get_featured_posts->the_post();
					?>
					<li>
						<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
							<?php the_title(); ?>
						</a>
					</li>
				<?php endwhile; ?>
			</ul>
		</div>

		<?php
		// Reset Post Data.
		wp_reset_postdata();

	}

endif;


if ( ! function_exists( 'colormag_random_post' ) ) :

	/**
	 * Random post icon in menu.
	 */
	function colormag_random_post() {

		// Bail out if random post in menu is not activated.
		if ( 0 == get_theme_mod( 'colormag_enable_random_post', 0 ) ) {
			return;
		}

		// Arguments for post query.
		$args = array(
			'posts_per_page'         => 1,
			'post_type'              => 'post',
			'ignore_sticky_posts'    => true,
			'orderby'                => 'rand',
			'no_found_rows'          => true,
			'update_post_meta_cache' => false,
			'update_post_term_cache' => false,
		);

		$get_random_post = new WP_Query( $args );
		?>

		<div class="cm-random-post">
			<?php
			while ( $get_random_post->have_posts() ) :
				$get_random_post->the_post();
				?>
				<a href="<?php the_permalink(); ?>" title="<?php esc_attr_e( 'View a random post', 'colormag' ); ?>">
					<?php colormag_get_icon( 'random-fill' ); ?>
				</a>
			<?php endwhile; ?>
		</div>

		<?php
		// Reset Post Data.
		wp_reset_postdata();

	}

endif;


if ( ! function_exists( 'colormag_related_posts_function' ) ) :

	/**
	 * Query for the related posts.
	 */
	function colormag_related_posts_function() {

		wp_reset_postdata();
		global $post;

		// Define shared post arguments.
		$args = array(
			'no_found_rows'          => true,
			'update_post_meta_cache' => false,
			'update_post_term_cache' => false,
			'ignore_sticky_posts'    => 1,
			'orderby'                => 'rand',
			'post__not_in'           => array( $post->ID ),
			'posts_per_page'         => 3,
		);

		// Related by categories.
		if ( 'categories' == get_theme_mod( 'colormag_related_posts_query', 'categories' ) ) {
			$cats                 = wp_get_post_categories( $post->ID, array( 'fields' => 'ids' ) );
			$args['category__in'] = $cats;
		}

		// Related by tags.
		if ( 'tags' == get_theme_mod( 'colormag_related_posts_query', 'categories' ) ) {
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

endif;
