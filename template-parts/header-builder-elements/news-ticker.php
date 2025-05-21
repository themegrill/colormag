<?php
$post_status = 'publish';
if ( 1 == get_option( 'fresh_site' ) ) {
	$post_status = array( 'auto-draft', 'publish' );
}

// Arguments for post query.
$args = array(
	'posts_per_page'      => 5,
	'post_type'           => 'post',
	'ignore_sticky_posts' => true,
	'post_status'         => $post_status,
);

$news_ticker_label = get_theme_mod( 'colormag_news_ticker_label', 'Latest:' );

$get_featured_posts = new WP_Query( $args );
?>

	<div class="breaking-news">
		<strong class="breaking-news-latest"><?php echo esc_html( $news_ticker_label ); ?></strong>

		<ul class="newsticker">
			<?php
			while ( $get_featured_posts->have_posts() ) :
				$get_featured_posts->the_post();
				?>
				<li>
					<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
						<?php the_title(); ?>
					</a>
				</li>
			<?php endwhile; ?>
		</ul>
	</div>

<?php
// Reset Post Data.
wp_reset_postdata();
