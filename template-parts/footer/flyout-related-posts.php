<?php
/**
 * Flyout related posts featured display.
 *
 * @package    ThemeGrill
 * @subpackage ColorMag
 * @since      ColorMag 1.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$related_posts = colormag_flyout_related_post_query();

if ( $related_posts->have_posts() ) :
	?>

	<div id="related-posts-wrapper-flyout" class="related-posts-wrapper-flyout">

		<h4 class="related-posts-flyout-main-title">
			<span><?php echo esc_html( get_theme_mod( 'colormag_read_next_text', __( 'Read Next', 'colormag' ) ) ); ?></span>
			<span id="flyout-related-post-close" class="flyout-related-post-close">
				<i class="fa fa-times" aria-hidden="true"></i>
			</span>
		</h4>

		<div class="related-posts-flyout clearfix">

			<?php
			while ( $related_posts->have_posts() ) :
				$related_posts->the_post();
				?>
				<div class="single-related-posts-flyout">

					<?php if ( has_post_thumbnail() ) : ?>
						<div class="related-posts-thumbnail">
							<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
								<?php the_post_thumbnail( 'colormag-featured-post-small' ); ?>
							</a>
						</div>
					<?php endif; ?>

					<div class="cm-post-content">
						<h3 class="cm-entry-title">
							<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
								<?php the_title(); ?>
							</a>
						</h3><!--/.post-title-->

						<?php colormag_entry_meta( false ); ?>
					</div>

				</div><!--/.related-->
			<?php endwhile; ?>

		</div><!--/.post-related-->

	</div>
	<?php
endif;

// Reset postdata.
wp_reset_postdata();
