<?php
/**
 * Theme Single Post Section for our theme.
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

	/**
	 * Hook: colormag_before_content_area.
	 *
	 * @hooked colormag_pro_before_content_area (two sidebar select) - 10
	 */
	do_action( 'colormag_before_content_area' );
	?>

	<div id="cm-primary" class="cm-primary">
		<div class="cm-posts clearfix<?php echo esc_attr( apply_filters( 'colormag_single_posts_class', '' ) ); ?>">

			<?php
			/**
			 * Hook: colormag_before_single_loop.
			 *
			 * @hooked colormag_pro_before_single_loop (autoload posts wrapper open) - 10
			 */
			do_action( 'colormag_before_single_loop' );

			/**
			 * Hook: colormag_before_single_post_page_loop.
			 */
			do_action( 'colormag_before_single_post_page_loop' );

			while ( have_posts() ) :
				the_post();

				get_template_part( 'template-parts/content', 'single' );
			endwhile;

			/**
			 * Hook: colormag_after_single_post_page_loop.
			 */
			do_action( 'colormag_after_single_post_page_loop' );
			?>
		</div><!-- .cm-posts -->
		<?php

		if ( true === apply_filters( 'colormag_single_post_page_navigation_filter', true ) ) :
			if ( true === apply_filters( 'colormag_enable_post_navigation', true ) ) :
				get_template_part( 'navigation', 'single' );
			endif;
		endif;

		if ( ! class_exists( 'Auto_Load_Next_Post' ) ) :

			/**
			 * Functions hooked into colormag_action_after_single_post_content action.
			 *
			 * @hooked colormag_author_bio - 10
			 * @hooked colormag_related_posts - 20
			 */
			do_action( 'colormag_action_after_single_post_content' );

		endif;

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

		/**
		 * Hook: colormag_after_single_loop.
		 *
		 * @hooked colormag_pro_after_single_loop (autoload posts wrapper close + next post load) - 10
		 */
		do_action( 'colormag_after_single_loop' );
		?>
	</div><!-- #cm-primary -->

	<?php

	colormag_sidebar_select();
	?>
</div>

<?php
/**
 * Hook: colormag_after_body_content.
 */
do_action( 'colormag_after_body_content' );

get_footer();
