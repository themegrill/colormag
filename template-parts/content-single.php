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
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
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

	<?php
	if ( ! has_post_format( array( 'gallery', 'video' ) ) ) :

		if ( true == get_theme_mod( 'colormag_enable_featured_image', true ) && has_post_thumbnail() ) :
			?>
			<div class="cm-featured-image">
				<?php if ( 1 == get_theme_mod( 'colormag_enable_lightbox', 0 ) ) : ?>
					<a href="<?php echo esc_url( $image_popup_url ); ?>" class="image-popup"><?php the_post_thumbnail( 'colormag-featured-image' ); ?></a>
					<?php
				else :
					the_post_thumbnail( 'colormag-featured-image' );
				endif; ?>
			</div>

			<?php
		endif;
	endif;

	if ( has_post_format( 'video' ) ) :
		$video_post_url = get_post_meta( $post->ID, 'video_url', true );

		if ( ! empty( $video_post_url ) ) :
			?>
			<div class="fitvids-video">
				<?php
				$embed_code = wp_oembed_get( $video_post_url );

				echo $embed_code; // phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped
				?>
			</div>
			<?php
		endif;
	endif;
	?>

	<div class="cm-post-content">
		<?php
		if ( get_post_format() && ! has_post_format( 'video' ) ) :
			get_template_part( 'template-parts/content/post-formats' );
		endif;

			colormag_colored_category();
			?>

			<?php get_template_part( 'template-parts/entry/entry', 'header' ); ?>

			<?php
			colormag_entry_meta();
		?>

		<?php get_template_part( 'template-parts/entry/entry', 'summary' ); ?>

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
