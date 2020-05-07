<?php
/**
 * The template for displaying Archive page.
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
			if ( have_posts() ) :

				/**
				 * Functions hooked into colormag_action_archive_header action.
				 *
				 * @hooked colormag_archive_header - 10
				 */
				do_action( 'colormag_action_archive_header' );
				?>

				<div class="article-container">

					<?php while ( have_posts() ) : the_post(); ?>

						<?php get_template_part( 'content', 'archive' ); ?>

					<?php endwhile; ?>

				</div>

				<?php get_template_part( 'navigation', 'archive' ); ?>

			<?php else : ?>

				<?php get_template_part( 'no-results', 'archive' ); ?>

			<?php endif; ?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php
colormag_sidebar_select();

/**
 * Hook: colormag_after_body_content.
 */
do_action( 'colormag_after_body_content' );

get_footer();
