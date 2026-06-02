<?php

$ids = colormag_get_offset_random_post_ids(
	array(
		'posts_per_page'      => 1,
		'post_type'           => 'post',
		'post_status'         => 'publish',
		'ignore_sticky_posts' => true,
	),
	'colormag_random_header_post',
	2 * MINUTE_IN_SECONDS
);

$get_random_post = ! empty( $ids )
	? new WP_Query(
		array(
			'post__in'               => $ids,
			'posts_per_page'         => 1,
			'orderby'                => 'post__in',
			'no_found_rows'          => true,
			'update_post_meta_cache' => false,
			'update_post_term_cache' => false,
		)
	)
	: new WP_Query();
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
