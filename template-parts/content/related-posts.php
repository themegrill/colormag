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

/**
 * Filter: colormag_related_posts_args.
 *
 * Pro uses this to expose the related posts style and carousel options. The
 * free theme uses a single default style with no carousel and always shows the
 * thumbnail and meta.
 *
 * @param array $args {
 *     Related posts arguments.
 *
 *     @type string $style          Related posts style slug.
 *     @type string $wrapper_class  Extra class for the wrapper element.
 *     @type string $carousel_class Extra class for the inner list element.
 *     @type bool   $show_thumbnail Whether to render the thumbnail.
 *     @type bool   $show_meta      Whether to render the entry meta.
 *     @type bool   $show_excerpt   Whether to render the excerpt.
 * }
 */
$related_posts_args = apply_filters(
	'colormag_related_posts_args',
	array(
		'style'          => '',
		'wrapper_class'  => '',
		'carousel_class' => '',
		'show_thumbnail' => true,
		'show_meta'      => true,
		'show_excerpt'   => false,
	)
);

/**
 * Filter: colormag_related_posts_heading.
 *
 * The related posts section heading text.
 *
 * @param string $heading The heading text.
 */
$related_posts_heading = apply_filters( 'colormag_related_posts_heading', esc_html__( 'You May Also Like', 'colormag' ) );

if ( $related_posts->have_posts() ) :
	?>

	<div class="related-posts-wrapper <?php echo esc_attr( $related_posts_args['wrapper_class'] ); ?>">

		<h3 class="related-posts-main-title">
			<i class="fa fa-thumbs-up"></i><span><?php echo esc_html( $related_posts_heading ); ?></span>
		</h3>

		<div class="related-posts <?php echo esc_attr( $related_posts_args['carousel_class'] ); ?>">

			<?php
			while ( $related_posts->have_posts() ) :
				$related_posts->the_post();
				?>
				<div class="single-related-posts">

					<?php if ( $related_posts_args['show_thumbnail'] && has_post_thumbnail() ) : ?>
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
						if ( $related_posts_args['show_meta'] ) :
							colormag_entry_meta( false );
						endif;

						if ( $related_posts_args['show_excerpt'] ) :
							?>
							<div class="cm-entry-summary">
								<?php the_excerpt(); ?>
							</div>
							<?php
						endif;
						?>
					</div>

				</div><!--/.related-->
			<?php endwhile; ?>

		</div><!--/.post-related-->

	</div>

	<?php
endif;

// Reset postdata.
wp_reset_postdata();
