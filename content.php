<?php
/**
 * The template used for displaying page content in archive pages.
 *
 * @package    ThemeGrill
 * @subpackage ColorMag
 * @since      ColorMag 1.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
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
			<div class="featured-image">
				<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
					<?php the_post_thumbnail( 'colormag-featured-image' ); ?>
				</a>
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
			<h2 class="entry-title">
				<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
			</h2>
		</header>

		<?php colormag_entry_meta(); ?>

		<div class="entry-content clearfix">
			<?php the_excerpt(); ?>
			<a class="more-link" title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>">
				<span><?php esc_html_e( 'Read more', 'colormag' ); ?></span>
			</a>
		</div>

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
