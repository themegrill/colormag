<?php
/**
 * The template used for displaying single post content in single.php
 *
 * @package ColorMag
 *
 * @since   ColorMag 1.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$image_popup_id  = get_post_thumbnail_id();
$image_popup_url = wp_get_attachment_url( $image_popup_id );

/**
 * Filter: colormag_single_featured_image_position.
 *
 * Pro lets the user place the featured image before or after the post content.
 * The free theme always keeps the featured image before the content.
 *
 * @param string $position Either 'before_content' or 'after_content'.
 */
$featured_image_position = apply_filters( 'colormag_single_featured_image_position', 'before_content' );

if ( 'after_content' === $featured_image_position ) {
	$single_orders = get_theme_mod(
		'colormag_single_post_elements',
		array(
			'category',
			'title',
			'meta',
			'post_format',
			'content',
		)
	);
} else {
	$single_orders = get_theme_mod(
		'colormag_single_post_elements',
		array(
			'post_format',
			'category',
			'title',
			'meta',
			'content',
		)
	);
}

/**
 * Filter: colormag_single_featured_image_size.
 *
 * The image size used for the single post featured image. Pro maps this to the
 * colormag_blog_featured_image_size theme mod.
 *
 * @param string $size The featured image size.
 */
$single_featured_image_size = apply_filters( 'colormag_single_featured_image_size', 'colormag-featured-image' );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?><?php do_action( 'colormag_content_single_article_attrs' ); ?>>
	<?php
	/**
	 * Hook: colormag_before_post_content.
	 */
	do_action( 'colormag_before_post_content' );

	/**
	 * Hook: colormag_before_single_post_page_loop.
	 */
	do_action( 'colormag_before_single_post_page_loop' );
	?>

	<div class="cm-post-content">
		<?php
		foreach ( $single_orders as $key => $single_order ) {

			if ( 'post_format' === $single_order ) {

				if ( ! has_post_format( array( 'gallery', 'video' ) ) ) :
					if ( true == get_theme_mod( 'colormag_enable_featured_image', true ) && has_post_thumbnail() ) :
						?>
						<div class="cm-featured-image"<?php do_action( 'colormag_content_single_image_attrs' ); ?>>
							<?php if ( 1 == get_theme_mod( 'colormag_enable_lightbox', 0 ) ) : ?>
								<a href="<?php echo esc_url( $image_popup_url ); ?>" class="image-popup"><?php the_post_thumbnail( $single_featured_image_size ); ?></a>
								<?php
							else :
								the_post_thumbnail( $single_featured_image_size );
							endif;

							/**
							 * Hook: colormag_content_single_image_meta.
							 *
							 * Pro outputs the schema image meta tag here.
							 */
							do_action( 'colormag_content_single_image_meta' );
							?>
						</div>

						<?php if ( 1 == get_theme_mod( 'colormag_enable_featured_image_caption', 0 ) && get_post( get_post_thumbnail_id() )->post_excerpt ) : ?>
							<span class="featured-image-caption">
								<?php echo wp_kses_post( get_post( get_post_thumbnail_id() )->post_excerpt ); ?>
							</span>
							<?php
						endif;
					endif;
				endif;

				if ( get_post_format() && ! has_post_format( 'video' ) ) :
					get_template_part( 'template-parts/content/post-formats' );
				endif;

				if ( has_post_format( 'video' ) ) :
					$video_post_url = get_post_meta( $post->ID, 'video_url', true );

					if ( ! empty( $video_post_url ) ) :
						?>
						<div class="fitvids-video">
							<?php
							$embed_code = wp_oembed_get( $video_post_url );

							echo wp_kses(
								$embed_code,
								array(
									'iframe' => array(
										'title'           => true,
										'width'           => true,
										'height'          => true,
										'src'             => true,
										'frameborder'     => true,
										'allow'           => true,
										'referrerpolicy'  => true,
										'allowfullscreen' => true,
									),
								)
							);
							?>
						</div>
						<?php
					endif;
				endif;

			} elseif ( 'category' === $single_order ) {

				colormag_colored_category();
			} elseif ( 'meta' === $single_order ) {

				colormag_entry_meta( true, true, 'single_post' );
			} elseif ( 'title' === $single_order ) {

				get_template_part( 'template-parts/entry/entry', 'header' );
			} elseif ( 'content' === $single_order ) {

				get_template_part( 'template-parts/entry/entry', 'summary' );
			}
		}
		?>

	</div>

	<?php colormag_post_view_setup( get_the_ID() ); ?>

	<?php
	/**
	 * Hook: colormag_after_single_post_page_loop.
	 */
	do_action( 'colormag_after_single_post_page_loop' );

	/**
	 * Hook: colormag_after_post_content.
	 */
	do_action( 'colormag_after_post_content' );
	?>
</article>
