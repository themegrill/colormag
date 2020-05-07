<?php
/**
 * Theme Page Section for our theme.
 *
 * @package    ThemeGrill
 * @subpackage ColorMag
 * @since      ColorMag 1.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

/**
 * Hook: colormag_before_body_content.
 */
do_action( 'colormag_before_body_content' );
?>

	<div id="primary">
		<div id="content" class="clearfix">
			<?php
			/**
			 * Hook: colormag_before_single_page_loop.
			 */
			do_action( 'colormag_before_single_page_loop' );

			while ( have_posts() ) :
				the_post();

				get_template_part( 'content', 'page' );

				/**
				 * Hook: colormag_before_comments_template.
				 */
				do_action( 'colormag_before_comments_template' );

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || '0' != get_comments_number() ) {
					comments_template();
				}

				/**
				 * Hook: colormag_after_comments_template.
				 */
				do_action( 'colormag_after_comments_template' );

			endwhile;

			/**
			 * Hook: colormag_after_single_page_loop.
			 */
			do_action( 'colormag_after_single_page_loop' );
			?>
		</div><!-- #content -->
	</div><!-- #primary -->

<?php
colormag_sidebar_select();

/**
 * Hook: colormag_after_body_content.
 */
do_action( 'colormag_after_body_content' );

get_footer();
