<?php $related_posts = colormag_related_posts_function(); ?>

<?php if ( $related_posts->have_posts() ): ?>

<h4 class="related-posts-main-title"><i class="fa fa-thumbs-up"></i><span><?php _e('You May Also Like', 'colormag'); ?></span></h4>

<div class="related-posts clearfix">

   <?php while ( $related_posts->have_posts() ) : $related_posts->the_post(); ?>
   <div class="single-related-posts">

      <?php if ( has_post_thumbnail() ): ?>
         <div class="related-posts-thumbnail">
            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
               <?php the_post_thumbnail('colormag-featured-post-medium'); ?>
            </a>
         </div>
      <?php endif; ?>

      <div class="article-content">

         <h3 class="entry-title">
            <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a>
         </h3><!--/.post-title-->

         <div class="below-entry-meta">
            <?php
               $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
               $time_string = sprintf( $time_string,
                  esc_attr( get_the_date( 'c' ) ),
                  esc_html( get_the_date() )
               );
               printf( __( '<span class="posted-on"><a href="%1$s" title="%2$s" rel="bookmark"><i class="fa fa-calendar-o"></i> %3$s</a></span>', 'colormag' ),
                  esc_url( get_permalink() ),
                  esc_attr( get_the_time() ),
                  $time_string
               );
            ?>
            <span class="byline"><span class="author vcard"><i class="fa fa-user"></i><a class="url fn n" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" title="<?php echo get_the_author(); ?>"><?php echo esc_html( get_the_author() ); ?></a></span></span>
            <span class="comments"><i class="fa fa-comment"></i><?php comments_popup_link( '0', '1', '%' );?></span>
         </div>

      </div>

   </div><!--/.related-->
   <?php endwhile; ?>

</div><!--/.post-related-->
<?php endif; ?>

<?php wp_reset_query(); ?>