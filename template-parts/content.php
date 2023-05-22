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

if ( 'layout-1' === get_theme_mod( 'colormag_blog_layout_1_style', 'layout-1' ) || 'layout-2' === get_theme_mod( 'colormag_blog_layout_2_style', 'layout-1' ) ) {
	$featured_image_size = 'colormag-featured-post-medium';
}
?>

<article id="post-<?php the_ID(); ?>"
	<?php post_class( array( $class_name_layout_two ) ); ?>
	<?php echo colormag_schema_markup( 'entry' ); // phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped ?>>
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
				</a>
				<?php
				if ( has_post_format( 'video' ) ) {
					?>
					<span class="play-button-wrapper">
								<i class="fa fa-play" aria-hidden="true"></i>
					</span>
					<?php
				}
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
	?>

	<div class="cm-post-content">
		<?php
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

						echo $embed_code; // phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped
						?>
					</div>
					<?php
				endif;
			endif;

		endif;

		colormag_colored_category();
		?>

		<?php colormag_entry_meta(); ?>

	<?php get_template_part( 'template-parts/entry/entry', 'header' ); ?>


	<?php get_template_part( 'template-parts/entry/entry', 'summary' ); ?>

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
