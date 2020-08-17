<?php
/**
 * The template part for displaying navigation.
 *
 * @package    ThemeGrill
 * @subpackage ColorMag
 * @since      ColorMag 1.0
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
			<ul class="default-wp-page clearfix">
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
		<ul class="default-wp-page clearfix">
			<li class="previous"><?php previous_image_link( false, esc_html__( '&larr; Previous', 'colormag' ) ); ?></li>
			<li class="next"><?php next_image_link( false, esc_html__( 'Next &rarr;', 'colormag' ) ); ?></li>
		</ul>
		<?php
	else :
		?>

		<ul class="default-wp-page clearfix">
			<li class="previous"><?php previous_post_link( '%link', '<span class="meta-nav">' . esc_html_x( '&larr;', 'Previous post link', 'colormag' ) . '</span> %title' ); ?></li>
			<li class="next"><?php next_post_link( '%link', '%title <span class="meta-nav">' . esc_html_x( '&rarr;', 'Next post link', 'colormag' ) . '</span>' ); ?></li>
		</ul>

		<?php
	endif;

endif;
