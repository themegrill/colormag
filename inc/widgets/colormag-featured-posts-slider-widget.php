<?php
/**
 * Featured Category Slider widget.
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
 * Featured Category Slider widget.
 *
 * Class colormag_featured_posts_slider_widget
 */
class colormag_featured_posts_slider_widget extends ColorMag_Widget {

	/**
	 * Constructor.
	 */
	public function __construct() {

		$this->widget_cssclass             = 'cm-featured-category-slider-widget';
		$this->widget_description          = esc_html__( 'Display latest posts or posts of specific category, which will be used as the slider.', 'colormag' );
		$this->widget_name                 = esc_html__( 'TG: Featured Category Slider', 'colormag' );
		$this->customize_selective_refresh = false;
		$this->settings                    = array(
			'number'                   => array(
				'type'    => 'number',
				'default' => 4,
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
			'image_size'               => array(
				'type'    => 'radio',
				'default' => 'medium',
				'label'   => esc_html__( 'Image Size:', 'colormag' ),
				'choices' => array(
					'medium' => esc_html__( 'Image Size medium (800X445 pixels)', 'colormag' ),
					'large'  => esc_html__( 'Image Size large (1400X600 pixels, suitable for Front Page: Top Full Width Area)', 'colormag' ),
				),
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
			'post_details'             => array(
				'type'    => 'checkbox',
				'default' => 0,
				'label'   => esc_html__( 'Hide post details.', 'colormag' ),
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
			'slider_mode'              => array(
				'type'    => 'select',
				'default' => 'horizontal',
				'label'   => esc_html__( 'Slide Mode:', 'colormag' ),
				'choices' => array(
					'horizontal' => esc_html__( 'Horizontal', 'colormag' ),
					'vertical'   => esc_html__( 'Vertical', 'colormag' ),
					'fade'       => esc_html__( 'Fade', 'colormag' ),
				),
			),
			'slider_speed'             => array(
				'type'    => 'number',
				'default' => 1500,
				'label'   => esc_html__( 'Transition Speed Time (in ms):', 'colormag' ),
			),
			'slider_pause'             => array(
				'type'    => 'number',
				'default' => 5000,
				'label'   => esc_html__( 'Transition Pause Time (in ms):', 'colormag' ),
			),
			'slider_auto'              => array(
				'type'    => 'checkbox',
				'default' => '0',
				'label'   => esc_html__( 'Check to disable auto slide.', 'colormag' ),
			),
			'slider_hover'             => array(
				'type'    => 'checkbox',
				'default' => '0',
				'label'   => esc_html__( 'Check to disable auto slide when mouse hover.', 'colormag' ),
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
		$number         = empty( $instance['number'] ) ? 4 : $instance['number'];
		$type           = isset( $instance['type'] ) ? $instance['type'] : 'latest';
		$category       = isset( $instance['category'] ) ? $instance['category'] : '';
		$image_size     = isset( $instance['image_size'] ) ? $instance['image_size'] : 'medium';
		$random_posts   = ! empty( $instance['random_posts'] ) ? 'true' : 'false';
		$child_category = ! empty( $instance['child_category'] ) ? 'true' : 'false';
		$tag            = isset( $instance['tag'] ) ? $instance['tag'] : '';
		$author         = isset( $instance['author'] ) ? $instance['author'] : '';
		$slider_mode    = isset( $instance['slider_mode'] ) ? $instance['slider_mode'] : 'horizontal';
		$slider_speed   = empty( $instance['slider_speed'] ) ? 1500 : $instance['slider_speed'];
		$slider_pause   = empty( $instance['slider_pause'] ) ? 5000 : $instance['slider_pause'];
		$slider_auto    = ! empty( $instance['slider_auto'] ) ? 'false' : 'true';
		$slider_hover   = ! empty( $instance['slider_hover'] ) ? 'true' : 'false';
		$post_details   = ! empty( $instance['post_details'] ) ? true : false;

		// Create the posts query.
		$get_featured_posts = $this->query_posts( $number, $type, $category, $tag, $author, $random_posts, $child_category );

		$single_post_class = '';
		if ( '1' == $number ) {
			$single_post_class = 'single-post';
		}

		colormag_append_excluded_duplicate_posts( $get_featured_posts );

		$this->widget_start( $args );
		?>

		<div class="cm-featured-category-slider<?php echo esc_attr( $single_post_class ); ?>">
			<?php
			$featured = 'colormag-featured-image-large';
			if ( 'medium' == $image_size ) {
				$featured = 'colormag-featured-image';
			}
			?>

			<div id="category_slider_<?php echo esc_attr( $this->id ); ?>" class="cm-slider-area-rotate"
			     data-mode="<?php echo esc_attr( $slider_mode ); ?>"
			     data-speed="<?php echo esc_attr( $slider_speed ); ?>"
			     data-pause="<?php echo esc_attr( $slider_pause ); ?>"
			     data-auto="<?php echo esc_attr( $slider_auto ); ?>"
			     data-hover="<?php echo esc_attr( $slider_hover ); ?>"
			>
				<?php
				$i = 1;
				while ( $get_featured_posts->have_posts() ) :
					$get_featured_posts->the_post();

					$classes = 'cm-single-slide  displaynone';
					if ( 1 == $i ) {
						$classes = 'cm-single-slide  displayblock';
					}
					?>

					<div class="<?php echo esc_attr( $classes ); ?>">
						<?php
						if ( has_post_thumbnail() ) {
							$this->the_post_thumbnail( $post->ID, $featured, 'cm-slider-featured-image' );
						} else {
							?>
							<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
								<img
									src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/slider-featured-image.png' ); ?>"
									alt=""
								/>
							</a>
						<?php } ?>

						<?php if ( ! $post_details ) { ?>
							<div class="cm-slide-content">
								<?php
								colormag_colored_category();

								// Displays the post title.
								$this->the_title();

								// Displays the post meta.
								$this->entry_meta();
								?>
							</div>
						<?php } ?>
					</div>

					<?php
					$i ++;
				endwhile;
				// Reset Post Data.
				wp_reset_postdata();
				?>
			</div>
		</div>

		<?php
		$this->widget_end( $args );

	}

}
