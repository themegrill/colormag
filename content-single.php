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

   <?php
      $image_popup_id = get_post_thumbnail_id();
      $image_popup_url = wp_get_attachment_url( $image_popup_id );
   ?>

   <?php if ( has_post_thumbnail() ) { ?>
      <div class="featured-image">
      <?php if (get_theme_mod('colormag_featured_image_popup', 0) == 1) { ?>
         <a href="<?php echo $image_popup_url; ?>" class="image-popup"><?php the_post_thumbnail( 'colormag-featured-image' ); ?></a>
      <?php } else { ?>
         <?php the_post_thumbnail( 'colormag-featured-image' ); ?>
      <?php } ?>
      </div>
   <?php } ?>

   <div class="article-content clearfix">

   <?php if( get_post_format() ) { get_template_part( 'inc/post-formats' ); } ?>

   <?php colormag_colored_category(); ?>

      <header class="entry-header">
   		<h1 class="entry-title">
   			<?php the_title(); ?>
   		</h1>
   	</header>

   	<?php colormag_entry_meta(); ?>

   	<div class="entry-content clearfix">
   		<?php
   			the_content();

   			wp_link_pages( array(
   				'before'            => '<div style="clear: both;"></div><div class="pagination clearfix">'.__( 'Pages:', 'colormag' ),
   				'after'             => '</div>',
   				'link_before'       => '<span>',
   				'link_after'        => '</span>'
   	      ) );
   		?>
   	</div>

   </div>

	<?php do_action( 'colormag_after_post_content' ); ?>
</article>