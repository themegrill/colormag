<?php
/**
 * Featured Posts (Style 7).
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
 * Featured Posts (Style 7).
 *
 * Class colormag_ticker_news_widget
 */
class colormag_ticker_news_widget extends ColorMag_Widget {

	/**
	 * Constructor.
	 */
	public function __construct() {

		$this->widget_cssclass             = 'cm-featured-posts cm-featured-posts--style-7';
		$this->widget_description          = esc_html__( 'Display latest posts or posts of specific category.', 'colormag' );
		$this->widget_name                 = esc_html__( 'TG: Featured Posts (Style 7)', 'colormag' );
		$this->customize_selective_refresh = false;
		$this->settings                    = array(
			'widget_layout'            => array(
				'type'      => 'custom',
				'default'   => '',
				'label'     => esc_html__( 'Layout will be as below:', 'colormag' ),
				'image_url' => get_template_directory_uri() . '/assets/img/style-7.jpg',
			),
			'title'                    => array(
				'type'    => 'text',
				'default' => '',
				'label'   => esc_html__( 'Title:', 'colormag' ),
			),
			'text'                     => array(
				'type'    => 'textarea',
				'default' => '',
				'label'   => esc_html__( 'Description', 'colormag' ),
			),
			'number'                   => array(
				'type'    => 'number',
				'default' => 5,
				'label'   => esc_html__( 'Number of posts to display:', 'colormag' ),
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
			'popup'                    => array(
				'type'    => 'checkbox',
				'default' => '0',
				'label'   => esc_html__( 'Check to display the content in the popup', 'colormag' ),
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
			'slider_speed'             => array(
				'type'    => 'number',
				'default' => 50000,
				'label'   => esc_html__( 'Transition Speed Time (in ms):', 'colormag' ),
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
			wp_enqueue_script( 'colormag-bxslider' );
		}

		global $post;
		$title           = apply_filters( 'widget_title', isset( $instance['title'] ) ? $instance['title'] : '' );
		$text            = isset( $instance['text'] ) ? $instance['text'] : '';
		$number          = empty( $instance['number'] ) ? 5 : $instance['number'];
		$type            = isset( $instance['type'] ) ? $instance['type'] : 'latest';
		$category        = isset( $instance['category'] ) ? $instance['category'] : '';
		$popup_link      = ! empty( $instance['popup'] ) ? true : false;
		$random_posts    = ! empty( $instance['random_posts'] ) ? 'true' : 'false';
		$child_category  = ! empty( $instance['child_category'] ) ? 'true' : 'false';
		$tag             = isset( $instance['tag'] ) ? $instance['tag'] : '';
		$author          = isset( $instance['author'] ) ? $instance['author'] : '';
		$view_all_button = ! empty( $instance['view_all_button'] ) ? 'true' : 'false';
		$slider_speed    = empty( $instance['slider_speed'] ) ? 50000 : $instance['slider_speed'];

		// Enqueue the required magnific popup JS for this widget.
		if ( ( true === $popup_link ) && ( is_active_widget( false, false, $this->id_base ) || is_customize_preview() || ColorMag_Utils::colormag_elementor_active_page_check() ) ) {
			wp_enqueue_script( 'colormag-featured-image-popup' );
			wp_enqueue_style( 'colormag-featured-image-popup-css' );
		}

		// For WPML plugin compatibility, register string.
		if ( function_exists( 'icl_register_string' ) ) {
			icl_register_string( 'ColorMag Pro', 'TG: Featured Posts (Style 7) Description' . $this->id, $text );
		}

		// For WPML plugin compatibility, assign variable to converted string.
		if ( function_exists( 'icl_t' ) ) {
			$text = icl_t( 'ColorMag Pro', 'TG: Featured Posts (Style 7) Description' . $this->id, $text );
		}

		// Create the posts query.
		$get_featured_posts = $this->query_posts( $number, $type, $category, $tag, $author, $random_posts, $child_category );

		colormag_append_excluded_duplicate_posts( $get_featured_posts );

		$this->widget_start( $args );
		?>

		<?php
		$featured    = 'colormag-default-news';
		$link_enable = ! $popup_link;

		// Displays the widget title.
		$this->widget_title( $title, $type, $category, $view_all_button );

		// Display the description.
		$this->widget_description( $text );
		?>

		<div id="category_slider_<?php echo esc_attr( $this->id ); ?>" class="cm-image-ticker-news"
		     data-speed="<?php echo esc_attr( $slider_speed ); ?>"
		>
			<?php
			while ( $get_featured_posts->have_posts() ) :
				$get_featured_posts->the_post();
				?>

				<div class="cm-post">
					<?php
					if ( true === $popup_link ) {
						echo '<a href="' . esc_url( get_the_permalink() ) . '" data-fragment=".cm-posts" class="colormag-ticker-news-popup-link">';
					}

					if ( has_post_thumbnail() ) {
						$this->the_post_thumbnail( $post->ID, $featured, '', $link_enable );
					}

					if ( true === $popup_link ) {
						echo '</a>';
					}
					?>

					<div class="cm-post-content">
						<?php
						colormag_colored_category();

						// Displays the post title.
						$this->the_title();
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
