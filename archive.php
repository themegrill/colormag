<?php
/**
 * The template for displaying Archive page.
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

	<?php colormag_two_sidebar_select(); ?>

		<div id="cm-primary" class="cm-primary">

			<?php

			$grid_layout = get_theme_mod( 'colormag_blog_layout', 'layout-1' );

			$layout1_style = get_theme_mod( 'colormag_blog_layout_1_style', 'style-1' );

			$layout2_style = get_theme_mod( 'colormag_blog_layout_2_style', 'style-1' );

			$grid_col = get_theme_mod( 'colormag_grid_layout_column', '2' );

			$style = '';

			if ( 'layout-1' === $grid_layout ) {
				$style = 'cm-' . $grid_layout . '-' . $layout1_style;
			} elseif ( 'layout-2' === $grid_layout ) {
				$style = 'cm-' . $grid_layout . '-' . $layout2_style;
			}

			$col = '';

			if ( 'layout-2' === $grid_layout ) {
				$col = 'col-' . $grid_col;
			}

			/**
			 * Functions hooked into colormag_action_archive_header action.
			 *
			 * @hooked colormag_archive_header - 10
			 */
			do_action( 'colormag_action_archive_header' );
			?>
			<?php
			$pagination_type  = get_theme_mod( 'colormag_pagination_type', 'default' );
			$pagination_class = '';

			if ( 'infinite_scroll' === $pagination_type ) {
				$pagination_class .= 'tg-infinite-scroll-container';
			}
			?>
			<div class="cm-posts <?php echo esc_attr( 'cm-' . $grid_layout . ' ' . $style  . ' ' . $col . ' ' . $pagination_class ); ?>" >
				<?php
				if ( have_posts() ) :

					/**
					 * Hook: colormag_before_archive_page_loop.
					 */
					do_action( 'colormag_before_archive_page_loop' );
					?>

					<?php
					$pagination_type  = get_theme_mod( 'colormag_pagination_type', 'default' );
					$pagination_class = '';

					if ( 'infinite_scroll' === $pagination_type ) {
						$pagination_class .= 'tg-infinite-scroll-container';
					}
					?>
					<?php echo esc_attr( $pagination_class ); ?>
						<?php
						while ( have_posts() ) :
							the_post();

							/**
							 * Include the Post-Type-specific template for the content.
							 * If you want to override this in a child theme, then include a file
							 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
							 */
							get_template_part( 'template-parts/content', 'archive' );
						endwhile;
						?>

					<?php
					/**
					 * Hook: colormag_after_archive_page_loop.
					 */
					do_action( 'colormag_after_archive_page_loop' );

					colormag_pagination();

				else :
					if ( true === apply_filters( 'colormag_archive_page_no_results_filter', true ) ) {
						get_template_part( 'template-parts/no-results', 'archive' );
					}
				endif; // if ( have_posts() ) :
				?>
			</div><!-- .cm-posts -->

			<?php colormag_infinite_scroll(); ?>
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
