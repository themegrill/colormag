<?php
/**
 * Highlighted Posts widget.
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
 * Highlighted Posts widget.
 *
 * Class colormag_highlighted_posts_widget
 */
class colormag_highlighted_posts_widget extends ColorMag_Widget {

	/**
	 * Constructor.
	 */
	public function __construct() {

		$this->widget_cssclass    = 'cm-highlighted-posts';
		$this->widget_description = esc_html__( 'Display latest posts or posts of specific category. Suitable for the Area Beside Slider Sidebar.', 'colormag' );
		$this->widget_name        = esc_html__( 'TG: Highlighted Posts', 'colormag' );
		$this->settings           = array(
			'number'   => array(
				'type'    => 'number',
				'default' => 4,
				'label'   => esc_html__( 'Number of posts to display:', 'colormag' ),
			),
			'type'     => array(
				'type'    => 'radio',
				'default' => 'latest',
				'label'   => '',
				'choices' => array(
					'latest'   => esc_html__( 'Show latest Posts', 'colormag' ),
					'category' => esc_html__( 'Show posts from a category', 'colormag' ),
					'tag'      => esc_html__( 'Show posts from a tag', 'colormag' ),
					'author'   => esc_html__( 'Show posts from an author', 'colormag' ),
				),
			),
			'category' => array(
				'type'    => 'dropdown_categories',
				'default' => '',
				'label'   => esc_html__( 'Select category', 'colormag' ),
			),
			'tag'      => array(
				'type'    => 'dropdown_tags',
				'default' => '',
				'label'   => esc_html__( 'Select tag', 'colormag' ),
			),
			'author'   => array(
				'type'    => 'dropdown_users',
				'default' => '',
				'label'   => esc_html__( 'Select author', 'colormag' ),
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
		$number   = empty( $instance['number'] ) ? 4 : $instance['number'];
		$type     = isset( $instance['type'] ) ? $instance['type'] : 'latest';
		$category = isset( $instance['category'] ) ? $instance['category'] : '';
		$tag      = isset( $instance['tag'] ) ? $instance['tag'] : '';
		$author   = isset( $instance['author'] ) ? $instance['author'] : '';

		// Create the posts query.
		$get_featured_posts = $this->query_posts( $number, $type, $category, $tag, $author );

		$this->widget_start( $args );
		?>

		<div class="cm-posts">
			<?php
			$featured = 'colormag-highlighted-post';
			while ( $get_featured_posts->have_posts() ) :
				$get_featured_posts->the_post();
				?>

				<div class="cm-post">
					<?php
					if ( has_post_thumbnail() ) {
						$this->the_post_thumbnail( $post->ID, $featured, 'cm-featured-image' );
					} else {
						?>
						<img
							src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/highlights-featured-image.png' ); ?>"
							alt=""
						/>
					<?php } ?>

					<div class="cm-post-content">
						<?php
						colormag_colored_category();

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
