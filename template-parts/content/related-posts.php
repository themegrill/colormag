<?php
/**
 * Related posts featured display.
 *
 * @package    ThemeGrill
 * @subpackage ColorMag
 * @since      ColorMag 1.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$related_posts = colormag_related_posts_function();

if ( $related_posts->have_posts() ) :
	?>

	<div class="related-posts-wrapper">

		<h3 class="related-posts-main-title">
			<i class="fa fa-thumbs-up"></i><span><?php echo esc_html( __( 'You May Also Like', 'colormag' ) ); ?></span>
		</h3>

		<div class="related-posts">

			<?php
			while ( $related_posts->have_posts() ) :
				$related_posts->the_post();
				?>
				<div class="single-related-posts">

					<?php if ( has_post_thumbnail() ) : ?>
						<div class="related-posts-thumbnail">
							<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
								<?php the_post_thumbnail( 'colormag-featured-post-medium' ); ?>
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
