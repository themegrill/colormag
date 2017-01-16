<?php
/**
 * Theme Single Post Section for our theme.
 *
 * @package ThemeGrill
 * @subpackage ColorMag
 * @since ColorMag 1.0
 */
get_header(); ?>

	<?php do_action( 'colormag_before_body_content' ); ?>

	<div id="primary">
		<div id="content" class="clearfix">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'single' ); ?>

			<?php endwhile; ?>

		</div><!-- #content -->

      <?php get_template_part( 'navigation', 'single' ); ?>

      <?php if ( get_the_author_meta( 'description' ) ) : ?>
         <div class="author-box">
            <div class="author-img"><?php echo get_avatar( get_the_author_meta( 'user_email' ), '100' ); ?></div>
               <h4 class="author-name"><?php the_author_meta( 'display_name' ); ?></h4>
               <p class="author-description"><?php the_author_meta( 'description' ); ?></p>
         </div>
      <?php endif; ?>

      <?php if ( get_theme_mod( 'colormag_related_posts_activate', 0 ) == 1 )
         get_template_part( 'inc/related-posts' );
      ?>

      <?php
         do_action( 'colormag_before_comments_template' );
         // If comments are open or we have at least one comment, load up the comment template
         if ( comments_open() || '0' != get_comments_number() )
            comments_template();
         do_action ( 'colormag_after_comments_template' );
      ?>

	</div><!-- #primary -->

	<?php colormag_sidebar_select(); ?>

	<?php do_action( 'colormag_after_body_content' ); ?>

<?php get_footer(); ?>