<?php
/**
 * TG: Featured Posts (Style 2) widget.
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
 * TG: Featured Posts (Style 2) widget.
 *
 * Class colormag_featured_posts_vertical_widget
 */
class colormag_featured_posts_vertical_widget extends ColorMag_Widget {

	/**
	 * Constructor.
	 */
	public function __construct() {

		$this->widget_cssclass    = 'cm-featured-posts cm-featured-posts--style-2';
		$this->widget_description = esc_html__( 'Display latest posts or posts of specific category.', 'colormag' );
		$this->widget_name        = esc_html__( 'TG: Featured Posts (Style 2)', 'colormag' );
		$this->settings           = array(
			'widget_layout' => array(
				'type'      => 'custom',
				'default'   => '',
				'label'     => esc_html__( 'Layout will be as below:', 'colormag' ),
				'image_url' => get_template_directory_uri() . '/assets/img/style-2.jpg',
			),
			'title'         => array(
				'type'    => 'text',
				'default' => '',
				'label'   => esc_html__( 'Title:', 'colormag' ),
			),
			'text'          => array(
				'type'    => 'textarea',
				'default' => '',
				'label'   => esc_html__( 'Description', 'colormag' ),
			),
			'number'        => array(
				'type'    => 'number',
				'default' => 4,
				'label'   => esc_html__( 'Number of posts to display:', 'colormag' ),
			),
			'type'          => array(
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
			'category'      => array(
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
		$title    = apply_filters( 'widget_title', isset( $instance['title'] ) ? $instance['title'] : '' );
		$text     = isset( $instance['text'] ) ? $instance['text'] : '';
		$number   = empty( $instance['number'] ) ? 4 : $instance['number'];
		$type     = isset( $instance['type'] ) ? $instance['type'] : 'latest';
		$category = isset( $instance['category'] ) ? $instance['category'] : '';
		$tag      = isset( $instance['tag'] ) ? $instance['tag'] : '';
		$author   = isset( $instance['author'] ) ? $instance['author'] : '';

		// Create the posts query.
		$get_featured_posts = $this->query_posts( $number, $type, $category, $tag, $author );

		$this->widget_start( $args );
		?>

		<?php
		// Displays the widget title.
		$this->widget_title( $title, $type, $category );

		// Display the description.
		$this->widget_description( $text );

		$i = 1;
		while ( $get_featured_posts->have_posts() ) :
			$get_featured_posts->the_post();

			if ( 1 == $i ) {
				$featured = 'colormag-featured-post-medium';
			} else {
				$featured = 'colormag-featured-post-small';
			}

			if ( 1 == $i ) {
				echo '<div class="cm-first-post">';
			} elseif ( 2 == $i ) {
				echo '<div class="cm-posts">';
			}
			?>

			<div class="cm-post">
				<?php
				if ( has_post_thumbnail() ) {
					$this->the_post_thumbnail( $post->ID, $featured );
				}
				?>

				<div class="cm-post-content">
					<?php
					colormag_colored_category();

					// Displays the post title.
					$this->the_title();

					// Displays the post meta.
					$this->entry_meta();
					?>

					<?php if ( 1 == $i ) { ?>
						<div class="cm-entry-summary">
							<?php the_excerpt(); ?>
						</div>
					<?php } ?>
				</div>
			</div>

			<?php
			if ( 1 == $i ) {
				echo '</div>';
			}
			$i ++;
		endwhile;
		if ( $i > 2 ) {
			echo '</div>';
		}

		// Reset Post Data.
		wp_reset_postdata();

		$this->widget_end( $args );

	}

}
