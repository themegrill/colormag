<?php
/**
 * Random Post widget.
 *
 * @package    ThemeGrill
 * @subpackage ColorMag
 * @since      ColorMag 1.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Random Post widget.
 *
 * Class colormag_random_post_widget
 */
class colormag_random_post_widget extends ColorMag_Widget {

	/**
	 * Constructor.
	 */
	public function __construct() {

		$this->widget_cssclass    = 'cm-random-post-widget cm-featured-posts';
		$this->widget_description = esc_html__( 'Displays the random posts from your site. Suitable for the Right/Left sidebar.', 'colormag' );
		$this->widget_name        = esc_html__( 'TG: Random Posts Widget', 'colormag' );
		$this->settings           = array(
			'title'  => array(
				'type'    => 'text',
				'default' => '',
				'label'   => esc_html__( 'Title:', 'colormag' ),
			),
			'number' => array(
				'type'    => 'number',
				'default' => 4,
				'label'   => esc_html__( 'Number of random posts to display:', 'colormag' ),
			),
		);

		parent::__construct();

	}

	/**
	 * Output widget.
	 *
	 * @param array $args     Arguments.
	 * @param array $instance Widget instance.
	 *
	 * @see WP_Widget
	 */
	public function widget( $args, $instance ) {

		global $post;
		$title  = apply_filters( 'widget_title', isset( $instance['title'] ) ? $instance['title'] : '' );
		$number = empty( $instance['number'] ) ? 4 : $instance['number'];

		// Adding the excluding post function.
		$post__not_in = colormag_exclude_duplicate_posts();

		$query_args = array(
			'posts_per_page'      => $number,
			'post_type'           => 'post',
			'ignore_sticky_posts' => true,
			'orderby'             => 'rand',
			'no_found_rows'       => true,
			'post__not_in'        => $post__not_in,
		);

		$get_featured_posts = new WP_Query( $query_args );

		colormag_append_excluded_duplicate_posts( $get_featured_posts );

		$this->widget_start( $args );
		?>

		<?php
		$featured = 'colormag-featured-post-small';

		// Displays the widget title.
		if ( ! empty( $title ) ) {
			echo $args['before_title'] . esc_html( $title ) . $args['after_title']; // phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped
		}
		?>

		<div class="cm-random-posts">
			<?php
			while ( $get_featured_posts->have_posts() ) :
				$get_featured_posts->the_post();
				?>

				<div class="cm-post">
					<?php
					if ( has_post_thumbnail() ) {
						$this->the_post_thumbnail( $post->ID, $featured, 'tabbed-images' );
					}
					?>

					<div class="cm-post-content">
						<?php
						// Displays the post title.
						$this->the_title();

						// Displays the post meta.
						$this->entry_meta();
						?>
					</div>
				</div>

				<?php
			endwhile;
			// Reset Post Data.
			wp_reset_postdata();
			?>
		</div>

		<?php
		$this->widget_end( $args );

	}

}
