<?php
/**
 * The template used for displaying page content in archive pages.
 *
 * @package ColorMag
 *
 * @since   ColorMag 1.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$featured_image_size   = 'colormag-featured-image';
$class_name_layout_two = '';
$archive_search_layout = 'layout-1';

?>

<article id="post-<?php the_ID(); ?>"
	<?php post_class( array( $class_name_layout_two ) ); ?>>
	<?php
	/**
	 * Hook: colormag_before_post_content.
	 */
	do_action( 'colormag_before_post_content' );

	/**
	 * Hook: colormag_before_posts_loop.
	 */
	do_action( 'colormag_before_posts_loop' );
	?>

	<?php
	if ( ! has_post_format( array( 'gallery' ) ) ) :

		if ( has_post_thumbnail() ) :
			?>
			<div class="cm-featured-image">
				<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
					<?php the_post_thumbnail( $featured_image_size ); ?>

				<?php
				if ( has_post_format( 'video' ) ) {
					?>
						<span class="play-button-wrapper">
								<i class="fa fa-play" aria-hidden="true"></i>
						</span>
					<?php
				}
				?>
				</a>
			</div>
				<?php
		endif;

	endif;
	?>

	<?php
	$content_orders = get_theme_mod(
		'colormag_blog_post_elements',
		array(
			'post_format',
			'category',
			'meta',
			'title',
			'content',
		)
	);
	?>



	<div class="cm-post-content">
		<?php
		foreach ( $content_orders as $key => $content_order ) {

			if ( 'post_format' === $content_order ) {

				if ( get_post_format() ) :
					if ( ! has_post_format( 'video' ) ) :
						get_template_part( 'inc/post-formats' );
					endif;

					if ( has_post_format( 'video' ) && ! ( has_post_thumbnail() ) ) :

						$video_post_url = get_post_meta( $post->ID, 'video_url', true );

						if ( ! empty( $video_post_url ) ) :
							?>
							<div class="fitvids-video">
								<?php
								$embed_code = wp_oembed_get( $video_post_url );

								echo do_shortcode( $embed_code );
								?>
							</div>
							<?php
						endif;
					endif;

				endif;
			} elseif ( 'category' === $content_order ) {

				colormag_colored_category();
			} elseif ( 'meta' === $content_order ) {

				colormag_entry_meta();
			} elseif ( 'title' === $content_order ) {

				get_template_part( 'template-parts/entry/entry', 'header' );
			} elseif ( 'content' === $content_order ) {

				get_template_part( 'template-parts/entry/entry', 'summary' );
			}
		}
		?>

	</div>

	<?php
	/**
	 * Hook: colormag_after_posts_loop.
	 */
	do_action( 'colormag_after_posts_loop' );

	/**
	 * Hook: colormag_after_post_content.
	 */
	do_action( 'colormag_after_post_content' );
	?>
</article>
