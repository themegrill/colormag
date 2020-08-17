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

		$this->widget_cssclass             = 'widget_featured_slider widget_featured_meta';
		$this->widget_description          = esc_html__( 'Display latest posts or posts of specific category, which will be used as the slider.', 'colormag' );
		$this->widget_name                 = esc_html__( 'TG: Featured Category Slider', 'colormag' );
		$this->customize_selective_refresh = false;
		$this->settings                    = array(
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
				),
			),
			'category' => array(
				'type'    => 'dropdown_categories',
				'default' => '',
				'label'   => esc_html__( 'Select category', 'colormag' ),
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

		// Create the posts query.
		$get_featured_posts = $this->query_posts( $number, $type, $category );

		$this->widget_start( $args );
		?>

		<div class="widget_featured_slider_inner_wrap clearfix">
			<?php $featured = 'colormag-featured-image'; ?>

			<div class="widget_slider_area_rotate">
				<?php
				$i = 1;
				while ( $get_featured_posts->have_posts() ) :
					$get_featured_posts->the_post();

					$classes = 'single-slide displaynone';
					if ( 1 == $i ) {
						$classes = 'single-slide displayblock';
					}
					?>

					<div class="<?php echo esc_attr( $classes ); ?>">
						<?php
						if ( has_post_thumbnail() ) {
							$this->the_post_thumbnail( $post->ID, $featured, 'slider-featured-image' );
						} else {
							?>
							<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
								<img
									src="<?php echo esc_url( get_template_directory_uri() . '/img/slider-featured-image.png' ); ?>"
									alt=""
								/>
							</a>
						<?php } ?>

						<div class="slide-content">
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
					$i++;
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
