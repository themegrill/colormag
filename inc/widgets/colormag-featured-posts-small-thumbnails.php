<?php
/**
 * TG: Featured Posts (Style 3) widget.
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
 * TG: Featured Posts (Style 3) widget.
 *
 * Class colormag_featured_posts_small_thumbnails
 */
class colormag_featured_posts_small_thumbnails extends ColorMag_Widget {

	/**
	 * Constructor.
	 */
	public function __construct() {

		$this->widget_cssclass    = 'cm-featured-posts cm-featured-posts--style-3';
		$this->widget_description = esc_html__( 'Display latest posts or posts of specific category.', 'colormag' );
		$this->widget_name        = esc_html__( 'TG: Featured Posts (Style 3)', 'colormag' );
		$this->settings           = array(
			'widget_layout'   => array(
				'type'      => 'custom',
				'default'   => '',
				'label'     => esc_html__( 'Layout will be as below:', 'colormag' ),
				'image_url' => get_template_directory_uri() . '/assets/img/style-3.jpg',
			),
			'title'           => array(
				'type'    => 'text',
				'default' => '',
				'label'   => esc_html__( 'Title:', 'colormag' ),
			),
			'text'            => array(
				'type'    => 'textarea',
				'default' => '',
				'label'   => esc_html__( 'Description', 'colormag' ),
			),
			'number'          => array(
				'type'    => 'number',
				'default' => 4,
				'label'   => esc_html__( 'Number of posts to display:', 'colormag' ),
			),
			'type'            => array(
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
			'category'        => array(
				'type'    => 'dropdown_categories',
				'default' => '',
				'label'   => esc_html__( 'Select category', 'colormag' ),
			),
			'tag'             => array(
				'type'    => 'dropdown_tags',
				'default' => '',
				'label'   => esc_html__( 'Select tag', 'colormag' ),
			),
			'author'          => array(
				'type'    => 'dropdown_users',
				'default' => '',
				'label'   => esc_html__( 'Select author', 'colormag' ),
			),
			'random_posts'    => array(
				'type'    => 'checkbox',
				'default' => '0',
				'label'   => esc_html__( 'Check to display the random post from either the chosen category or from latest post.', 'colormag' ),
			),
			'child_category'  => array(
				'type'    => 'checkbox',
				'default' => '0',
				'label'   => esc_html__( 'Check to display the posts from child category of the chosen category.', 'colormag' ),
			),
			'view_all_button' => array(
				'type'    => 'checkbox',
				'default' => '0',
				'label'   => esc_html__( 'Check to display the view all button to link that button to the specific category chosen in this widget.', 'colormag' ),
			),
			'ajax_load_more'  => array(
				'type'    => 'checkbox',
				'default' => '0',
				'label'   => esc_html__( 'Check to display the ajax load more button to load further posts from chosen category or from latest post.', 'colormag' ),
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
		$title           = apply_filters( 'widget_title', isset( $instance['title'] ) ? $instance['title'] : '' );
		$text            = isset( $instance['text'] ) ? $instance['text'] : '';
		$number          = empty( $instance['number'] ) ? 4 : $instance['number'];
		$type            = isset( $instance['type'] ) ? $instance['type'] : 'latest';
		$category        = isset( $instance['category'] ) ? $instance['category'] : '';
		$random_posts    = ! empty( $instance['random_posts'] ) ? 'true' : 'false';
		$ajax_load_more  = ! empty( $instance['ajax_load_more'] ) ? 'true' : 'false';
		$child_category  = ! empty( $instance['child_category'] ) ? 'true' : 'false';
		$tag             = isset( $instance['tag'] ) ? $instance['tag'] : '';
		$author          = isset( $instance['author'] ) ? $instance['author'] : '';
		$view_all_button = ! empty( $instance['view_all_button'] ) ? 'true' : 'false';

		// For WPML plugin compatibility, register string.
		if ( function_exists( 'icl_register_string' ) ) {
			icl_register_string( 'ColorMag Pro', 'TG: Featured Posts (Style 3) Description' . $this->id, $text );
		}

		// For WPML plugin compatibility, assign variable to converted string.
		if ( function_exists( 'icl_t' ) ) {
			$text = icl_t( 'ColorMag Pro', 'TG: Featured Posts (Style 3) Description' . $this->id, $text );
		}

		// Create the posts query.
		$get_featured_posts = $this->query_posts( $number, $type, $category, $tag, $author, $random_posts, $child_category );

		colormag_append_excluded_duplicate_posts( $get_featured_posts );

		$this->widget_start( $args );
		?>

		<?php
		// Displays the widget title.
		$this->widget_title( $title, $type, $category, $view_all_button );

		// Display the description.
		$this->widget_description( $text );
		?>
		<div class="cm-posts">
			<?php
			$featured = 'colormag-featured-post-small';
			while ( $get_featured_posts->have_posts() ) :
				$get_featured_posts->the_post();
				?>

				<div class="cm-post">
					<?php
					if ( has_post_thumbnail() ) {
						$this->the_post_thumbnail( $post->ID, $featured );
					}

					if ( has_post_format( 'video' ) && ! ( has_post_thumbnail() ) ) :
						$video_post_url = get_post_meta( $post->ID, 'video_url', true );?>

						<div class="fitvids-video">
							<?php
							$embed_code = wp_oembed_get( $video_post_url );

							echo $embed_code; // phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped
							?>
						</div>
					<?php
					endif;
					?>

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
			?>
		</div>
		<?php
		// Reset Post Data.
		wp_reset_postdata();

		if ( 'latest' == $type ) {
			$category = '-1';
			$tag      = '-1';
		}

		// For display of child category posts.
		$child_category_display = 0;
		if ( 'true' == $child_category ) {
			$child_category_display = 1;
		}

		if ( 'true' == $ajax_load_more ) {
			?>
			<div class="tg-ajax-btn-wrapper">
				<div id="tg-append-ajax-data-<?php echo esc_attr( $this->id ); ?>" class="tg-append-ajax-datas"></div>

				<div class="tg-front-post-load-more btn-wrapper" id="tg-ajax-btn-<?php echo esc_attr( $this->id ); ?>"
				     data-category='<?php echo esc_attr( $category ); ?>'
				     data-child_category='<?php echo esc_attr( $child_category_display ); ?>'
				     data-random="<?php echo esc_attr( $random_posts ); ?>"
				     data-number="<?php echo esc_attr( $number ); ?>"
				     data-tag="<?php echo esc_attr( $tag ); ?>"
				     data-type="<?php echo esc_attr( $type ); ?>"
				     data-author="<?php echo esc_attr( $author ); ?>"
				>
					<span class="transition5 btn btn-view-all"><?php esc_html_e( 'Load More', 'colormag' ); ?></span>
					<img src="<?php echo esc_url( admin_url( '/images/wpspin_light.gif' ) ); ?>" class="waiting"
					     id="tg-ajax-loading-icon-<?php echo esc_attr( $this->id ); ?>" style="display: none;"
					/>
				</div><!-- .tg-front-post-load-more -->
			</div>
		<?php } ?>

		<?php
		$this->widget_end( $args );

	}

}
