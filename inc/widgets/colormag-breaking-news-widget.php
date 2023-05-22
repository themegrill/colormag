<?php
/**
 * Breaking News widget.
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
 * Breaking News widget.
 *
 * Class colormag_breaking_news_widget
 */
class colormag_breaking_news_widget extends ColorMag_Widget {

	/**
	 * Constructor.
	 */
	public function __construct() {

		$this->widget_cssclass             = 'cm-breaking-news-colormag-widget cm-featured-posts';
		$this->widget_description          = esc_html__( 'Displays the breaking news in the news ticker way. Suitable for the Right/Left Sidebar', 'colormag' );
		$this->widget_name                 = esc_html__( 'TG: Breaking News Widget', 'colormag' );
		$this->customize_selective_refresh = false;
		$this->settings                    = array(
			'title'                    => array(
				'type'    => 'text',
				'default' => '',
				'label'   => esc_html__( 'Title:', 'colormag' ),
			),
			'number'                   => array(
				'type'    => 'number',
				'default' => 4,
				'label'   => esc_html__( 'Number of recent posts to show as the breaking news:', 'colormag' ),
			),
			'type'                     => array(
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
			'category'                 => array(
				'type'    => 'dropdown_categories',
				'default' => '',
				'label'   => esc_html__( 'Select category', 'colormag' ),
			),
			'tag'                      => array(
				'type'    => 'dropdown_tags',
				'default' => '',
				'label'   => esc_html__( 'Select tag', 'colormag' ),
			),
			'author'                   => array(
				'type'    => 'dropdown_users',
				'default' => '',
				'label'   => esc_html__( 'Select author', 'colormag' ),
			),
			'random_posts'             => array(
				'type'    => 'checkbox',
				'default' => '0',
				'label'   => esc_html__( 'Check to display the random post from either the chosen category or from latest post.', 'colormag' ),
			),
			'child_category'           => array(
				'type'    => 'checkbox',
				'default' => '0',
				'label'   => esc_html__( 'Check to display the posts from child category of the chosen category.', 'colormag' ),
			),
			'view_all_button'          => array(
				'type'    => 'checkbox',
				'default' => '0',
				'label'   => esc_html__( 'Check to display the view all button to link that button to the specific category chosen in this widget.', 'colormag' ),
			),
			'slider_options_label'     => array(
				'type'    => 'custom',
				'default' => '',
				'label'   => '<h2>' . esc_html__( 'Slider Options', 'colormag' ) . '</h2>',
			),
			'slider_options_separator' => array(
				'type'    => 'separator',
				'default' => '',
			),
			'slide_direction'          => array(
				'type'    => 'select',
				'default' => 'up',
				'label'   => esc_html__( 'Slide Direction:', 'colormag' ),
				'choices' => array(
					'up'   => esc_html__( 'Up', 'colormag' ),
					'down' => esc_html__( 'Down', 'colormag' ),
				),
			),
			'slide_duration'           => array(
				'type'    => 'number',
				'default' => 4000,
				'label'   => esc_html__( 'Slide Duration Time (in ms):', 'colormag' ),
			),
			'slide_row_height'         => array(
				'type'    => 'number',
				'default' => 100,
				'label'   => esc_html__( 'Slide Row Height (in px):', 'colormag' ),
			),
			'slide_max_rows'           => array(
				'type'    => 'number',
				'default' => 3,
				'label'   => esc_html__( 'Maximum Slide Rows:', 'colormag' ),
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

		// Enqueue the required JS for this widget.
		if ( is_active_widget( false, false, $this->id_base ) || is_customize_preview() || ColorMag_Utils::colormag_elementor_active_page_check() ) {
			wp_enqueue_script( 'colormag-news-ticker' );
		}

		global $post;
		$number           = empty( $instance['number'] ) ? 4 : $instance['number'];
		$title            = apply_filters( 'widget_title', isset( $instance['title'] ) ? $instance['title'] : '' );
		$type             = isset( $instance['type'] ) ? $instance['type'] : 'latest';
		$category         = isset( $instance['category'] ) ? $instance['category'] : '';
		$random_posts     = ! empty( $instance['random_posts'] ) ? 'true' : 'false';
		$child_category   = ! empty( $instance['child_category'] ) ? 'true' : 'false';
		$tag              = isset( $instance['tag'] ) ? $instance['tag'] : '';
		$author           = isset( $instance['author'] ) ? $instance['author'] : '';
		$view_all_button  = ! empty( $instance['view_all_button'] ) ? 'true' : 'false';
		$slide_direction  = isset( $instance['slide_direction'] ) ? $instance['slide_direction'] : 'up';
		$slide_duration   = empty( $instance['slide_duration'] ) ? 4000 : $instance['slide_duration'];
		$slide_row_height = empty( $instance['slide_row_height'] ) ? 100 : $instance['slide_row_height'];
		$slide_max_rows   = empty( $instance['slide_max_rows'] ) ? 3 : $instance['slide_max_rows'];

		// Create the posts query.
		$get_featured_posts = $this->query_posts( $number, $type, $category, $tag, $author, $random_posts, $child_category );

		$this->widget_start( $args );
		?>

		<?php
		$featured = 'colormag-featured-post-small';

		// Displays the widget title.
		$this->widget_title( $title, $type, $category, $view_all_button );
		?>

		<div class="cm-breaking-news">
			<i class="fa fa-arrow-up" id="breaking-news-widget-prev_<?php echo esc_attr( $this->id ); ?>"></i>
			<ul id="breaking-news-widget_<?php echo esc_attr( $this->id ); ?>" class="cm-breaking-news-slider-widget"
			    data-direction="<?php echo esc_attr( $slide_direction ); ?>"
			    data-duration="<?php echo esc_attr( $slide_duration ); ?>"
			    data-rowheight="<?php echo esc_attr( $slide_row_height ); ?>"
			    data-maxrows="<?php echo esc_attr( $slide_max_rows ); ?>"
			>
				<?php
				while ( $get_featured_posts->have_posts() ) :
					$get_featured_posts->the_post();
					?>

					<li class="cm-post">
						<div class="cm-featured-image">

							<?php
								if ( has_post_thumbnail() ) {
									$this->the_post_thumbnail( $post->ID, $featured, 'tabbed-images' );
								}
							?>
						</div>

						<div class="cm-post-content">
							<?php
							// Displays the post title.
							$this->the_title();

							// Displays the post meta.
							$this->entry_meta();
							?>
						</div>
					</li>

					<?php
				endwhile;
				// Reset Post Data.
				wp_reset_postdata();
				?>
			</ul>
			<i class="fa fa-arrow-down" id="breaking-news-widget-next_<?php echo esc_attr( $this->id ); ?>"></i>
		</div>

		<?php
		$this->widget_end( $args );

	}

}
