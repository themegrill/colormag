<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package ThemeGrill
 * @subpackage ColorMag
 * @since ColorMag 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php do_action( 'colormag_before_post_content' ); ?>

	<?php if ( ( get_theme_mod( 'colormag_featured_image_single_page_show', 1 ) == 1 ) && ( has_post_thumbnail() ) ) { ?>
		<div class="featured-image">
			<?php the_post_thumbnail( 'colormag-featured-image' ); ?>
		</div>
	<?php } ?>

	<header class="entry-header">
      <?php if ( is_front_page() ) : ?>
   		<h2 class="entry-title">
   			<?php the_title(); ?>
   		</h2>
      <?php else : ?>
         <h1 class="entry-title">
            <?php the_title(); ?>
         </h1>
      <?php endif; ?>
	</header>

	<div class="entry-content clearfix">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before'            => '<div style="clear: both;"></div><div class="pagination clearfix">'.__( 'Pages:', 'colormag' ),
				'after'             => '</div>',
				'link_before'       => '<span>',
				'link_after'        => '</span>'
	      ) );
		?>
	</div>

	<div class="entry-footer">
		<?php edit_post_link( __( 'Edit', 'colormag' ), '<span class="edit-link"><i class="fa fa-edit"></i>', '</span>' ); ?>
	</div>

	<?php do_action( 'colormag_after_post_content' ); ?>
</article>
