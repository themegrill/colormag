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

		/**
		 * Filter: colormag_post_navigation_style.
		 *
		 * The post navigation style. Pro exposes a customizer setting that allows
		 * thumbnail navigation styles (style-2, style-3).
		 */
		$navigation_style = apply_filters( 'colormag_post_navigation_style', 'style-1' );

		// Build the default (free) text navigation output.
		ob_start();
		?>
		<ul class="default-wp-page">
			<li class="previous"><?php previous_post_link( '%link', '<span class="meta-nav">' . colormag_get_icon( 'arrow-left-long', false ) . '</span> %title' ); ?></li>
			<li class="next"><?php next_post_link( '%link', '%title <span class="meta-nav">' . colormag_get_icon( 'arrow-right-long', false ) . '</span>' ); ?></li>
		</ul>
		<?php
		$default_output = ob_get_clean();

		/**
		 * Filter: colormag_post_navigation_output.
		 *
		 * Allows pro to override the navigation markup for thumbnail styles
		 * (style-2, style-3).
		 *
		 * @param string $default_output   The default text navigation markup.
		 * @param string $navigation_style The selected navigation style.
		 */
		echo apply_filters( 'colormag_post_navigation_output', $default_output, $navigation_style ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	endif;

endif;
