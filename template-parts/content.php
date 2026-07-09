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
$archive_search_layout = get_theme_mod( 'colormag_blog_layout', 'layout-1' );

$image_popup_id  = get_post_thumbnail_id();
$image_popup_url = wp_get_attachment_url( $image_popup_id );

/**
 * Filter: colormag_content_featured_image_args.
 *
 * Pro uses this to control the featured image size and lightbox behaviour.
 * The free theme keeps the default featured image size and a simple permalink
 * link wrapper.
 *
 * @param array $args {
 *     Featured image arguments.
 *
 *     @type string $size           Image size to render.
 *     @type bool   $lightbox        Whether the single lightbox is enabled.
 *     @type bool   $lightbox_blog   Whether the archive lightbox is enabled.
 *     @type string $popup_url       Attachment URL for the lightbox.
 *     @type bool   $caption         Whether to render the image caption.
 * }
 */
$featured_image_args = apply_filters(
	'colormag_content_featured_image_args',
	array(
		'size'          => $featured_image_size,
		'lightbox'      => false,
		'lightbox_blog' => false,
		'popup_url'     => $image_popup_url,
		'caption'       => false,
	)
);

$featured_image_size = $featured_image_args['size'];

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( array( $class_name_layout_two ) ); ?><?php do_action( 'colormag_content_article_attrs' ); ?>>
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

				<?php if ( $featured_image_args['lightbox'] && is_single() ) : ?>
					<a href="<?php echo esc_url( $featured_image_args['popup_url'] ); ?>" class="image-popup">
						<?php the_post_thumbnail( 'colormag-featured-image' ); ?>
					</a>
				<?php elseif ( $featured_image_args['lightbox_blog'] && ( is_archive() || is_front_page() || is_home() ) ) : ?>
					<a href="<?php echo esc_url( $featured_image_args['popup_url'] ); ?>" class="image-popup-blog">
						<?php the_post_thumbnail( 'colormag-featured-image' ); ?>
					</a>
				<?php else : ?>
					<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
						<?php the_post_thumbnail( $featured_image_size ); ?>
						<?php if ( has_post_format( 'video' ) ) : ?>
							<span class="play-button-wrapper">
								<i class="fa fa-play" aria-hidden="true"></i>
							</span>
						<?php endif; ?>
					</a>
				<?php endif; ?>

				<?php if ( $featured_image_args['caption'] && get_post( get_post_thumbnail_id() )->post_excerpt ) : ?>
					<span class="featured-image-caption">
						<?php echo wp_kses_post( get_post( get_post_thumbnail_id() )->post_excerpt ); ?>
					</span>
				<?php endif; ?>
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

	/**
	 * Filter: colormag_entry_meta_args.
	 *
	 * Arguments passed to colormag_entry_meta() within the archive loop.
	 * Pro enables the full post meta and reading time display.
	 *
	 * @param array $args [ $full_post_meta, $reading_time_display, $type ].
	 */
	$entry_meta_args = apply_filters(
		'colormag_entry_meta_args',
		array( false, false, 'blog' )
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
			} elseif ( 'title' === $content_order ) {

				get_template_part( 'template-parts/entry/entry', 'header' );
			} elseif ( 'meta' === $content_order ) {

				colormag_entry_meta( $entry_meta_args[0], $entry_meta_args[1], $entry_meta_args[2] );
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
