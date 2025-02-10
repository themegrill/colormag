<?php

// Arguments for post query.
$args = array(
	'posts_per_page'         => 1,
	'post_type'              => 'post',
	'ignore_sticky_posts'    => true,
	'orderby'                => 'rand',
	'no_found_rows'          => true,
	'update_post_meta_cache' => false,
	'update_post_term_cache' => false,
);

$get_random_post = new WP_Query( $args );
?>

	<div class="cm-random-post">
		<?php
		while ( $get_random_post->have_posts() ) :
			$get_random_post->the_post();
			?>
			<a href="<?php the_permalink(); ?>" title="<?php esc_attr_e( 'View a random post', 'colormag' ); ?>">
				<?php colormag_get_icon( 'random-fill' ); ?>
			</a>
		<?php endwhile; ?>
	</div>

<?php
// Reset Post Data.
wp_reset_postdata();
