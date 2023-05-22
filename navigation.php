<?php
/**
 * The template part for displaying navigation.
 *
 * @package    ColorMag
 *
 * @since      ColorMag 1.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
 * Navigation for archive, home and search results pages.
 */
if ( is_archive() || is_home() || is_search() ) :

	/**
	 * Display WP-PageNavi pagination instead of theme pagination if the plugin exists.
	 */
	if ( function_exists( 'wp_pagenavi' ) ) :
		wp_pagenavi();

	else :
		global $wp_query;
		if ( $wp_query->max_num_pages > 1 ) :
			?>
			<ul class="default-wp-page">
				<li class="previous"><?php next_posts_link( esc_html__( '&larr; Previous', 'colormag' ) ); ?></li>
				<li class="next"><?php previous_posts_link( esc_html__( 'Next &rarr;', 'colormag' ) ); ?></li>
			</ul>
			<?php
		endif;
	endif;

endif;


/**
 * Navigation for single post page.
 */
if ( is_single() ) :

	if ( is_attachment() ) :
		?>
		<ul class="default-wp-page">
			<li class="previous"><?php previous_image_link( false, esc_html__( '&larr; Previous', 'colormag' ) ); ?></li>
			<li class="next"><?php next_image_link( false, esc_html__( 'Next &rarr;', 'colormag' ) ); ?></li>
		</ul>
		<?php
	else :

		if ( 'style-2' === get_theme_mod( 'colormag_post_navigation_style', 'default' ) ) :

			// For previous post.
			$prev_thumb_image = '';
			$prev_post        = get_previous_post();

			if ( $prev_post ) {
				$prev_thumb_image = get_the_post_thumbnail( $prev_post->ID, 'colormag-featured-post-small' );
			}

			// For next post.
			$next_thumb_image = '';
			$next_post        = get_next_post();

			if ( $next_post ) {
				$next_thumb_image = get_the_post_thumbnail( $next_post->ID, 'colormag-featured-post-small' );
			}
			?>

			<ul class="default-wp-page thumbnail-pagination">
				<?php if ( get_previous_post_link() ) { ?>
					<li class="previous">
						<?php previous_post_link( $prev_thumb_image . '%link', '<span class="meta-nav">' . esc_html_x( '&larr; Previous', 'Previous post link', 'colormag' ) . '</span> %title' ); ?>
					</li>
				<?php } ?>

				<?php if ( get_next_post_link() ) { ?>
					<li class="next">
						<?php next_post_link( '%link' . $next_thumb_image, '%title <span class="meta-nav">' . esc_html_x( 'Next &rarr;', 'Next post link', 'colormag' ) . '</span>' ); ?>
					</li>
				<?php } ?>
			</ul>

			<?php
		elseif ( 'style-3' === get_theme_mod( 'colormag_post_navigation_style', 'default' ) ) :

			// For previous post.
			$prev_thumb_image = '';
			$prev_post        = get_previous_post();

			if ( $prev_post ) {
				$prev_thumb_image = get_the_post_thumbnail( $prev_post->ID, 'colormag-featured-post-medium' );
			}

			// For next post.
			$next_thumb_image = '';
			$next_post        = get_next_post();

			if ( $next_post ) {
				$next_thumb_image = get_the_post_thumbnail( $next_post->ID, 'colormag-featured-post-medium' );
			}
			?>

			<ul class="default-wp-page thumbnail-background-pagination">
				<?php if ( get_previous_post_link() ) { ?>
					<li class="previous">
						<?php previous_post_link( $prev_thumb_image . '%link', '<span class="meta-nav">' . esc_html_x( '&larr; Previous', 'Previous post link', 'colormag' ) . '</span> %title' ); ?>
					</li>
				<?php } ?>

				<?php if ( get_next_post_link() ) { ?>
					<li class="next">
						<?php next_post_link( '%link' . $next_thumb_image, '<span class="meta-nav">' . esc_html_x( 'Next &rarr;', 'Next post link', 'colormag' ) . '</span> %title' ); ?>
					</li>
				<?php } ?>
			</ul>

		<?php else : ?>

			<ul class="default-wp-page">
				<li class="previous"><?php previous_post_link( '%link', '<span class="meta-nav">' . esc_html_x( '&larr;', 'Previous post link', 'colormag' ) . '</span> %title' ); ?></li>
				<li class="next"><?php next_post_link( '%link', '%title <span class="meta-nav">' . esc_html_x( '&rarr;', 'Next post link', 'colormag' ) . '</span>' ); ?></li>
			</ul>

			<?php
		endif;

	endif;

endif;
