<?php
/**
 * This file loads the content partially for support on Auto Load Next Post plugin.
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( have_posts() ) :

	// Load content before the loop.
	do_action( 'alnp_load_before_loop' );

	/**
	 * Hook: colormag_before_single_post_page_loop.
	 */
	do_action( 'colormag_before_single_post_page_loop' );

	// Check that there are posts to load.
	while ( have_posts() ) :
		the_post();

		// Load content before the post content.
		do_action( 'alnp_load_before_content' );

		// Load the content part for single post.
		get_template_part( 'template-parts/content', 'single' );

		// Load content after the loop.
		do_action( 'alnp_load_after_loop' );

		if ( true === apply_filters( 'colormag_single_post_page_navigation_filter', true ) ) :
			if ( 0 == get_theme_mod( 'colormag_enable_post_navigation', 0 ) ) :
				get_template_part( 'navigation', 'single' );
			endif;
		endif;

		/**
		 * Functions hooked into colormag_action_after_single_post_content action.
		 *
		 * @hooked colormag_author_bio - 10
		 * @hooked colormag_social_share - 15
		 * @hooked colormag_related_posts - 20
		 */
		do_action( 'colormag_action_after_single_post_content' );

		// Load content after the post content.
		do_action( 'alnp_load_after_content' );

		// End the loop.
	endwhile;

	/**
	 * Hook: colormag_after_singl_poste_page_loop.
	 */
	do_action( 'colormag_after_single_post_page_loop' );

else :

	// Load content if there are no more posts.
	do_action( 'alnp_no_more_posts' );

endif;
