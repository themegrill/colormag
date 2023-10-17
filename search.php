<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package ColorMag
 *
 * @since   ColorMag 1.0
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

	$pagination_enable = get_theme_mod( 'colormag_enable_pagination', 1 );
	$pagination_type   = get_theme_mod( 'colormag_pagination_type', 'default' );

	?>
		<div id="cm-primary" class="cm-primary">
			<div class="cm-posts">
				<?php if ( have_posts() ) : ?>
					<header class="cm-page-header">
						<h1 class="cm-page-title">
							<span>
								<?php
								printf(
									/* Translators: %s: Search query. */
									esc_html__( 'Search Results for: %s', 'colormag' ),
									get_search_query()
								);
								?>
							</span>
						</h1>
					</header><!-- .cm-page-header -->

					<?php
					/**
					 * Hook: colormag_before_search_results_page_loop.
					 */
					do_action( 'colormag_before_search_results_page_loop' );
					?>

					<div class="article-container">

						<?php
						while ( have_posts() ) :
							the_post();

							/**
							 * Include the Post-Type-specific template for the content.
							 * If you want to override this in a child theme, then include a file
							 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
							 */
							get_template_part( '/template-parts/content', 'archive' );
						endwhile;
						?>

					</div>

					<?php
					/**
					 * Hook: colormag_after_archive_page_loop.
					 */
					do_action( 'colormag_after_search_results_page_loop' );

				else :
					if ( true === apply_filters( 'colormag_search_results_page_no_results_filter', true ) ) {
						get_template_part( 'no-results', 'archive' );
					}
				endif;
				?>
			</div><!-- .cm-posts -->

			<?php
			if ( 1 == $pagination_enable ) :
				colormag_pagination();
			endif;
			?>

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
