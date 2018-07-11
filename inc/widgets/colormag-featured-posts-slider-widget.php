<?php
/**
 * Featured Posts widget
 */

class colormag_featured_posts_slider_widget extends WP_Widget {

	function __construct() {
		$widget_ops  = array(
			'classname'   => 'widget_featured_slider widget_featured_meta',
			'description' => __( 'Display latest posts or posts of specific category, which will be used as the slider.', 'colormag' ),
		);
		$control_ops = array( 'width' => 200, 'height' => 250 );
		parent::__construct( false, $name = __( 'TG: Featured Category Slider', 'colormag' ), $widget_ops );
	}

	function form( $instance ) {
		$tg_defaults['number']   = 4;
		$tg_defaults['type']     = 'latest';
		$tg_defaults['category'] = '';
		$instance                = wp_parse_args( ( array ) $instance, $tg_defaults );
		$number                  = $instance['number'];
		$type                    = $instance['type'];
		$category                = $instance['category'];
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of posts to display:', 'colormag' ); ?></label>
			<input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo $number; ?>" size="3" />
		</p>

		<p>
			<input type="radio" <?php checked( $type, 'latest' ) ?> id="<?php echo $this->get_field_id( 'type' ); ?>" name="<?php echo $this->get_field_name( 'type' ); ?>" value="latest" /><?php _e( 'Show latest Posts', 'colormag' ); ?>
			<br />
			<input type="radio" <?php checked( $type, 'category' ) ?> id="<?php echo $this->get_field_id( 'type' ); ?>" name="<?php echo $this->get_field_name( 'type' ); ?>" value="category" /><?php _e( 'Show posts from a category', 'colormag' ); ?>
			<br /></p>

		<p>
			<label for="<?php echo $this->get_field_id( 'category' ); ?>"><?php _e( 'Select category', 'colormag' ); ?>
				:</label>
			<?php wp_dropdown_categories( array(
				'show_option_none' => ' ',
				'name'             => $this->get_field_name( 'category' ),
				'selected'         => $category,
			) ); ?>
		</p>

		<?php
	}

	function update( $new_instance, $old_instance ) {
		$instance             = $old_instance;
		$instance['number']   = absint( $new_instance['number'] );
		$instance['type']     = $new_instance['type'];
		$instance['category'] = $new_instance['category'];

		return $instance;
	}

	function widget( $args, $instance ) {
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
			'no_found_rows'       => true,
			'post_status'         => $post_status,
		);

		// Display posts from category.
		if ( $type == 'category' ) {
			$args['category__in'] = $category;
		}

		$get_featured_posts = new WP_Query( $args );

		echo $before_widget;
		?>
		<?php $featured = 'colormag-featured-image'; ?>
		<div class="widget_slider_area_rotate">
			<?php
			$i = 1;
			while ( $get_featured_posts->have_posts() ):$get_featured_posts->the_post();

				if ( $i == 1 ) {
					$classes = "single-slide displayblock";
				} else {
					$classes = "single-slide displaynone";
				}
				?>
				<div class="<?php echo $classes; ?>">
					<?php
					if ( has_post_thumbnail() ) {
						$image           = '';
						$thumbnail_id    = get_post_thumbnail_id( $post->ID );
						$image_alt_text  = get_post_meta( $thumbnail_id, '_wp_attachment_image_alt', true );
						$title_attribute = get_the_title( $post->ID );
						if ( empty( $image_alt_text ) ) {
							$image_alt_text = $title_attribute;
						}
						$image .= '<figure class="slider-featured-image">';
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
							<img src="<?php echo get_template_directory_uri(); ?>/img/slider-featured-image.png">
						</a>
					<?php }
					?>
					<div class="slide-content">
						<?php colormag_colored_category(); ?>
						<h3 class="entry-title">
							<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
						</h3>
						<div class="below-entry-meta">
							<?php
							$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
							$time_string = sprintf( $time_string, esc_attr( get_the_date( 'c' ) ), esc_html( get_the_date() )
							);
							printf( __( '<span class="posted-on"><a href="%1$s" title="%2$s" rel="bookmark"><i class="fa fa-calendar-o"></i> %3$s</a></span>', 'colormag' ), esc_url( get_permalink() ), esc_attr( get_the_time() ), $time_string
							);
							?>
							<span class="byline"><span class="author vcard"><i class="fa fa-user"></i><a class="url fn n" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" title="<?php echo get_the_author(); ?>"><?php echo esc_html( get_the_author() ); ?></a></span></span>
							<span class="comments"><i class="fa fa-comment"></i><?php comments_popup_link( '0', '1', '%' ); ?></span>
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
