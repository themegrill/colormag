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

// Required related posts datas.
$related_posts                = colormag_related_posts_function();
$related_posts_data           = get_theme_mod( 'colormag_related_posts_style', 'style-1' );
$related_posts_class          = str_replace( '_', '-', $related_posts_data );
$related_posts_carousel_class = 'style_four' === $related_posts_data ? 'related-post-carousel' : '';

if ( $related_posts->have_posts() ) :
	?>

	<div class="related-posts-wrapper <?php echo esc_attr( $related_posts_class ); ?>">

		<h4 class="related-posts-main-title">
			<i class="fa fa-thumbs-up"></i><span><?php echo esc_html( get_theme_mod( 'colormag_you_may_also_like_text', __( 'You May Also Like', 'colormag' ) ) ); ?></span>
		</h4>

		<div class="related-posts clearfix <?php echo esc_attr( $related_posts_carousel_class ); ?>">

			<?php
			while ( $related_posts->have_posts() ) :
				$related_posts->the_post();
				?>
				<div class="single-related-posts">

					<?php if ( has_post_thumbnail() && 'style-3' != get_theme_mod( 'colormag_related_posts_style', 'style-1' ) ): ?>
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

						<?php
						if ( 'style-3' != get_theme_mod( 'colormag_related_posts_style', 'style-1' ) ) :
							colormag_entry_meta( false );
						endif;

						if ( 'style-2' == get_theme_mod( 'colormag_related_posts_style', 'style-1' ) ) {
							?>
							<div class="cm-entry-summary">
								<?php the_excerpt(); ?>
							</div>
						<?php } ?>
					</div>

				</div><!--/.related-->
			<?php endwhile; ?>

		</div><!--/.post-related-->

	</div>

	<?php
endif;

// Reset postdata.
wp_reset_postdata();
