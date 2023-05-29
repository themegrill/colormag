<?php
/**
 * Theme Index Section for ColorMag theme.
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

	$grid_layout = 'layout-2';

	$style = 'cm-layout-2-style-1';

	$col = 'col-2';

	/**
	 * Hook: colormag_before_body_content.
	 */
	do_action( 'colormag_before_body_content' );
	?>

		<div id="cm-primary" class="cm-primary">

			<div class="cm-posts <?php echo esc_attr( 'cm-' . $grid_layout . ' ' . $style  . ' ' . $col ); ?>" >
				<?php
				if ( have_posts() ) :

					/**
					 * Hook: colormag_before_index_page_loop.
					 */
					do_action( 'colormag_before_index_page_loop' );

					while ( have_posts() ) :
						the_post();

						/**
						 * Include the Post-Type-specific template for the content.
						 * If you want to override this in a child theme, then include a file
						 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
						 */
						get_template_part( 'template-parts/content', '' );
					endwhile;

					/**
					 * Hook: colormag_after_index_page_loop.
					 */
					do_action( 'colormag_after_index_page_loop' );

					colormag_pagination();

				else :

					if ( true === apply_filters( 'colormag_index_page_no_results_filter', true ) ) :
						get_template_part( 'no-results', 'none' );
					endif;

				endif;
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
