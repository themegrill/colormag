<?php
/**
 * Featured Posts (Style 6) Widget.
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
 * Featured Posts (Style 6) Widget.
 *
 * Class colormag_slider_news_widget
 */
class colormag_slider_news_widget extends ColorMag_Widget {

	/**
	 * Constructor.
	 */
	public function __construct() {

		$this->widget_cssclass    = 'cm-featured-posts cm-featured-posts--style-6';
		$this->widget_description = esc_html__( 'Display latest posts or posts of specific category.', 'colormag' );
		$this->widget_name        = esc_html__( 'TG: Featured Posts (Style 6)', 'colormag' );
		$this->settings           = array(
			'widget_layout'            => array(
				'type'      => 'custom',
				'default'   => '',
				'label'     => esc_html__( 'Layout will be as below:', 'colormag' ),
				'image_url' => get_template_directory_uri() . '/assets/img/style-6.jpg',
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
				'default' => 500,
				'label'   => esc_html__( 'Transition Speed Time (in ms):', 'colormag' ),
			),
			'slider_pause'             => array(
				'type'    => 'number',
				'default' => 4000,
				'label'   => esc_html__( 'Transition Pause Time (in ms):', 'colormag' ),
			),
			'slider_auto'              => array(
				'type'    => 'checkbox',
				'default' => '0',
				'label'   => esc_html__( 'Check to enable auto slide.', 'colormag' ),
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
		$title           = apply_filters( 'widget_title', isset( $instance['title'] ) ? $instance['title'] : '' );
		$text            = isset( $instance['text'] ) ? $instance['text'] : '';
		$number          = empty( $instance['number'] ) ? 4 : $instance['number'];
		$type            = isset( $instance['type'] ) ? $instance['type'] : 'latest';
		$category        = isset( $instance['category'] ) ? $instance['category'] : '';
		$random_posts    = ! empty( $instance['random_posts'] ) ? 'true' : 'false';
		$child_category  = ! empty( $instance['child_category'] ) ? 'true' : 'false';
		$tag             = isset( $instance['tag'] ) ? $instance['tag'] : '';
		$author          = isset( $instance['author'] ) ? $instance['author'] : '';
		$view_all_button = ! empty( $instance['view_all_button'] ) ? 'true' : 'false';
		$slider_mode     = isset( $instance['slider_mode'] ) ? $instance['slider_mode'] : 'horizontal';
		$slider_speed    = empty( $instance['slider_speed'] ) ? 500 : $instance['slider_speed'];
		$slider_pause    = empty( $instance['slider_pause'] ) ? 4000 : $instance['slider_pause'];
		$slider_auto     = ! empty( $instance['slider_auto'] ) ? 'true' : 'false';
		$slider_hover    = ! empty( $instance['slider_hover'] ) ? 'true' : 'false';

		// For WPML plugin compatibility, register string.
		if ( function_exists( 'icl_register_string' ) ) {
			icl_register_string( 'ColorMag Pro', 'TG: Featured Posts (Style 6) Description' . $this->id, $text );
		}

		// For WPML plugin compatibility, assign variable to converted string.
		if ( function_exists( 'icl_t' ) ) {
			$text = icl_t( 'ColorMag Pro', 'TG: Featured Posts (Style 6) Description' . $this->id, $text );
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

		<div class="cm-thumbnail-slider-news">
			<?php
			$i                = 1;
			$big_image_output = '';
			$thumbnail_image  = '';
			$post_count       = $get_featured_posts->post_count;
			while ( $get_featured_posts->have_posts() ) :
				$get_featured_posts->the_post();

				$j               = $i - 1;
				$title_attribute = get_the_title( $post->ID );
				if ( has_post_thumbnail() ) {
					$thumbnail_id    = get_post_thumbnail_id( $post->ID );
					$image_alt_text  = get_post_meta( $thumbnail_id, '_wp_attachment_image_alt', true );
					$title_attribute = get_the_title( $post->ID );
					$image_alt_text  = empty( $image_alt_text ) ? $title_attribute : $image_alt_text;

					// For big slider image.
					$big_image = '<a href="' . esc_url( get_permalink( $post->ID ) ) . '">';
					$big_image .= get_the_post_thumbnail(
						$post->ID,
						'colormag-featured-image',
						array(
							'title' => esc_attr( $title_attribute ),
							'alt'   => esc_attr( $image_alt_text ),
						)
					);
					$big_image .= '</a>';

					// For thumbnail slider image.
					$thumbnail_image .= '<a data-slide-index="' . esc_attr( $j ) . '" href="">';
					$thumbnail_image .= get_the_post_thumbnail(
						$post->ID,
						'colormag-default-news',
						array(
							'title' => esc_attr( $title_attribute ),
							'alt'   => esc_attr( $image_alt_text ),
						)
					);
					$thumbnail_image .= '<span class="title">' . esc_html( $title_attribute ) . '</span>';

					if ( has_post_format( 'video' ) ) {
						$thumbnail_image .= '<span class="play-button-wrapper">
								<i class="fa fa-play" aria-hidden="true"></i>
							</span>';
					}

					$thumbnail_image .= '</a>';
				} else {
					// For big slider image.
					$big_image = '<a href="' . get_permalink( $post->ID ) . '">';
					$big_image .= '<img src="' . get_template_directory_uri() . '/assets/img/thumbnail-big-slider.png">';
					$big_image .= '</a>';

					// For thumbnail slider image.
					$thumbnail_image .= '<a data-slide-index="' . esc_attr( $j ) . '" href="">';
					$thumbnail_image .= '<img src="' . get_template_directory_uri() . '/assets/img/thumbnail-small-slider.png">';
					$thumbnail_image .= '<span class="title">' . esc_html( $title_attribute ) . '</span>';
					$thumbnail_image .= '</a>';
				}

				// Large slider image display.
				$big_image_output .= '<li class="cm-post">';
				$big_image_output .= $big_image;

				if ( has_post_format( 'video' ) ) {
					$big_image_output .= '<span class="play-button-wrapper">
								<i class="fa fa-play" aria-hidden="true"></i>
							</span>';
				}

				$big_image_output .= '<div class="cm-post-content">';
				$big_image_output .= colormag_colored_category( false );
				$big_image_output .= '<h3 class="cm-entry-title">';
				$big_image_output .= '<a href="' . esc_url( get_permalink() ) . '" title="' . esc_attr( $title_attribute ) . '">';
				$big_image_output .= wp_kses_post( colormag_get_the_title( get_the_title() ) );
				$big_image_output .= '</a>';
				$big_image_output .= '</h3>';
				$big_image_output .= '</div>';
				$big_image_output .= '</li>';

				if ( $i == $number || $i == $post_count ) {
					?>
					<ul id="style6_slider_<?php echo $this->id; ?>" class="thumbnail-big-sliders"
					    data-mode="<?php echo esc_attr( $slider_mode ); ?>"
					    data-speed="<?php echo esc_attr( $slider_speed ); ?>"
					    data-pause="<?php echo esc_attr( $slider_pause ); ?>"
					    data-auto="<?php echo esc_attr( $slider_auto ); ?>"
					    data-hover="<?php echo esc_attr( $slider_hover ); ?>">
						<?php echo $big_image_output; // phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped ?>
					</ul>

					<div id="style6_pager_<?php echo esc_attr( $this->id ); ?>" class="cm-thumbnail-slider">
						<?php echo $thumbnail_image; // phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped ?>
					</div>
					<?php
				}
				$i ++;
			endwhile;
			?>
			<?php
			// Reset Post Data.
			wp_reset_postdata();
			?>
		</div>

		<?php
		$this->widget_end( $args );

	}

}
