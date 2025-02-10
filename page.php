<?php
/**
 * Theme Page Section for our theme.
 *
 * @package ColorMag
 *
 * @since   ColorMag 1.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>
<div class="cm-row">
	<?php

	/**
	 * Hook: colormag_before_body_content.
	 */
	do_action( 'colormag_before_body_content' );
	?>

		<div id="cm-primary" class="cm-primary">
			<div class="cm-posts clearfix">
				<?php
				/**
				 * Hook: colormag_before_single_page_loop.
				 */
				do_action( 'colormag_before_single_page_loop' );

				while ( have_posts() ) :
					the_post();

					get_template_part( 'template-parts/content', 'page' );

					/**
					 * Hook: colormag_before_comments_template.
					 */
					do_action( 'colormag_before_comments_template' );

					/**
					 * Functions hooked into colormag_action_after_inner_content action.
					 *
					 * @hooked colormag_render_comments - 10
					 */
					do_action( 'colormag_action_comments' );

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
			</div><!-- .cm-posts -->
		</div><!-- #cm-primary -->

	<?php

	colormag_sidebar_select();

	/**
	 * Hook: colormag_after_body_content.
	 */
	do_action( 'colormag_after_body_content' );
	?>
</div>

<?php
get_footer();
