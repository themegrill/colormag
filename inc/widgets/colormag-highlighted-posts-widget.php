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

		$this->widget_cssclass    = 'widget_highlighted_posts widget_featured_meta';
		$this->widget_description = esc_html__( 'Display latest posts or posts of specific category. Suitable for the Area Beside Slider Sidebar.', 'colormag' );
		$this->widget_id          = false;
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
		extract( $args );
		extract( $instance );

		global $post;
		$number   = empty( $instance['number'] ) ? 4 : $instance['number'];
		$type     = isset( $instance['type'] ) ? $instance['type'] : 'latest';
		$category = isset( $instance['category'] ) ? $instance['category'] : '';

		$post_status = 'publish';
		if ( get_option( 'fresh_site' ) == 1 ) {
			$post_status = array( 'auto-draft', 'publish' );
		}

		$args = array(
			'posts_per_page'      => $number,
			'post_type'           => 'post',
			'ignore_sticky_posts' => true,
			'post_status'         => $post_status,
			'no_found_rows'       => true,
		);

		// Display from category chosen.
		if ( $type == 'category' ) {
			$args['category__in'] = $category;
		}

		$get_featured_posts = new WP_Query( $args );

		echo $before_widget;
		?>
		<div class="widget_highlighted_post_area">
			<?php $featured = 'colormag-highlighted-post'; ?>
			<?php
			$i = 1;
			while ( $get_featured_posts->have_posts() ):$get_featured_posts->the_post();
				?>
				<div class="single-article">
					<?php
					if ( has_post_thumbnail() ) {
						$image           = '';
						$thumbnail_id    = get_post_thumbnail_id( $post->ID );
						$image_alt_text  = get_post_meta( $thumbnail_id, '_wp_attachment_image_alt', true );
						$title_attribute = get_the_title( $post->ID );
						if ( empty( $image_alt_text ) ) {
							$image_alt_text = $title_attribute;
						}
						$image .= '<figure class="highlights-featured-image">';
						$image .= '<a href="' . get_permalink() . '" title="' . the_title( '', '', false ) . '">';
						$image .= get_the_post_thumbnail( $post->ID, $featured, array(
								'title' => esc_attr( $title_attribute ),
								'alt'   => esc_attr( $image_alt_text ),
							) ) . '</a>';
						$image .= '</figure>';
						echo $image;
					} else {
						?>
						<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
							<img src="<?php echo get_template_directory_uri(); ?>/img/highlights-featured-image.png">
						</a>
					<?php }
					?>
					<div class="article-content">
						<?php colormag_colored_category(); ?>
						<h3 class="entry-title">
							<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
						</h3>
						<div class="below-entry-meta">
							<?php
							$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
							if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
								$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
							}
							$time_string = sprintf( $time_string,
								esc_attr( get_the_date( 'c' ) ),
								esc_html( get_the_date() ),
								esc_attr( get_the_modified_date( 'c' ) ),
								esc_html( get_the_modified_date() )
							);
							printf( __( '<span class="posted-on"><a href="%1$s" title="%2$s" rel="bookmark"><i class="fa fa-calendar-o"></i> %3$s</a></span>', 'colormag' ), esc_url( get_permalink() ), esc_attr( get_the_time() ), $time_string
							);
							?>
							<span class="byline"><span class="author vcard"><i class="fa fa-user"></i><a class="url fn n" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" title="<?php echo get_the_author(); ?>"><?php echo esc_html( get_the_author() ); ?></a></span></span>
							<?php if ( ! post_password_required() && comments_open() ) { ?>
								<span class="comments"><i class="fa fa-comment"></i><?php comments_popup_link( '0', '1', '%' ); ?></span>
							<?php } ?>
						</div>
					</div>

				</div>
				<?php
				$i ++;
			endwhile;
			// Reset Post Data
			wp_reset_query();
			?>
		</div>
		<?php
		echo $after_widget;
	}

}
