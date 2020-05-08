<?php
/**
 * The template used for displaying single post content in single.php
 *
 * @package    ThemeGrill
 * @subpackage ColorMag
 * @since      ColorMag 1.0
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
	if ( ! has_post_format( array( 'gallery' ) ) ) :
		if ( 0 == get_theme_mod( 'colormag_featured_image_show', 0 ) && has_post_thumbnail() ) :
			?>
			<div class="featured-image">
				<?php if ( 1 == get_theme_mod( 'colormag_featured_image_popup', 0 ) ) : ?>
					<a href="<?php echo esc_url( $image_popup_url ); ?>" class="image-popup"><?php the_post_thumbnail( 'colormag-featured-image' ); ?></a>
					<?php
				else :
					the_post_thumbnail( 'colormag-featured-image' );
				endif;
				?>
			</div>
			<?php
		endif;
	endif;
	?>

	<div class="article-content clearfix">

		<?php
		if ( get_post_format() ) :
			get_template_part( 'inc/post-formats' );
		endif;

		colormag_colored_category();
		?>

		<header class="entry-header">
			<h1 class="entry-title">
				<?php the_title(); ?>
			</h1>
		</header>

		<?php colormag_entry_meta(); ?>

		<div class="entry-content clearfix">
			<?php
			the_content();

			wp_link_pages(
				array(
					'before'      => '<div style="clear: both;"></div><div class="pagination clearfix">' . esc_html__( 'Pages:', 'colormag' ),
					'after'       => '</div>',
					'link_before' => '<span>',
					'link_after'  => '</span>',
				)
			);
			?>
		</div>

	</div>

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
