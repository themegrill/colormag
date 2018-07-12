<?php
/**
 * 300x250 Advertisement Ads
 */

class colormag_300x250_advertisement_widget extends WP_Widget {

	function __construct() {
		$widget_ops  = array(
			'classname'                   => 'widget_300x250_advertisement',
			'description'                 => __( 'Add your 300x250 Advertisement here', 'colormag' ),
			'customize_selective_refresh' => true,
		);
		$control_ops = array( 'width' => 200, 'height' => 250 );
		parent::__construct( false, $name = __( 'TG: 300x250 Advertisement', 'colormag' ), $widget_ops );
	}

	function form( $instance ) {
		$instance = wp_parse_args( ( array ) $instance, array(
			'title'              => '',
			'300x250_image_url'  => '',
			'300x250_image_link' => '',
		) );
		$title    = esc_attr( $instance['title'] );

		$image_link = '300x250_image_link';
		$image_url  = '300x250_image_url';

		$instance[ $image_link ] = esc_url( $instance[ $image_link ] );
		$instance[ $image_url ]  = esc_url( $instance[ $image_url ] );
		?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'colormag' ); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
		</p>
		<label><?php _e( 'Add your Advertisement 300x250 Images Here', 'colormag' ); ?></label>
		<p>
			<label for="<?php echo $this->get_field_id( $image_link ); ?>"> <?php _e( 'Advertisement Image Link ', 'colormag' ); ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( $image_link ); ?>" name="<?php echo $this->get_field_name( $image_link ); ?>" value="<?php echo $instance[ $image_link ]; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( $image_url ); ?>"> <?php _e( 'Advertisement Image ', 'colormag' ); ?></label>
		<div class="media-uploader" id="<?php echo $this->get_field_id( $image_url ); ?>">
			<div class="custom_media_preview">
				<?php if ( $instance[ $image_url ] != '' ) : ?>
					<img class="custom_media_preview_default" src="<?php echo esc_url( $instance[ $image_url ] ); ?>" style="max-width:100%;" />
				<?php endif; ?>
			</div>
			<input type="text" class="widefat custom_media_input" id="<?php echo $this->get_field_id( $image_url ); ?>" name="<?php echo $this->get_field_name( $image_url ); ?>" value="<?php echo esc_url( $instance[ $image_url ] ); ?>" style="margin-top:5px;" />
			<button class="custom_media_upload button button-secondary button-large" id="<?php echo $this->get_field_id( $image_url ); ?>" data-choose="<?php esc_attr_e( 'Choose an image', 'colormag' ); ?>" data-update="<?php esc_attr_e( 'Use image', 'colormag' ); ?>" style="width:100%;margin-top:6px;margin-right:30px;"><?php esc_html_e( 'Select an Image', 'colormag' ); ?></button>
		</div>
		</p>

		<?php
	}

	function update( $new_instance, $old_instance ) {
		$instance          = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );

		$image_link = '300x250_image_link';
		$image_url  = '300x250_image_url';

		$instance[ $image_link ] = esc_url_raw( $new_instance[ $image_link ] );
		$instance[ $image_url ]  = esc_url_raw( $new_instance[ $image_url ] );

		return $instance;
	}

	function widget( $args, $instance ) {
		extract( $args );
		extract( $instance );

		$title = isset( $instance['title'] ) ? $instance['title'] : '';

		$image_link = '300x250_image_link';
		$image_url  = '300x250_image_url';

		$image_link = isset( $instance[ $image_link ] ) ? $instance[ $image_link ] : '';
		$image_url  = isset( $instance[ $image_url ] ) ? $instance[ $image_url ] : '';

		echo $before_widget;
		?>

		<div class="advertisement_300x250">
			<?php if ( ! empty( $title ) ) { ?>
				<div class="advertisement-title">
					<?php echo $before_title . esc_html( $title ) . $after_title; ?>
				</div>
				<?php
			}
			$output = '';
			if ( ! empty( $image_url ) ) {
				$image_id  = attachment_url_to_postid( $image_url );
				$image_alt = get_post_meta( $image_id, '_wp_attachment_image_alt', true );
				$output    .= '<div class="advertisement-content">';
				if ( ! empty( $image_link ) ) {
					$output .= '<a href="' . $image_link . '" class="single_ad_300x250" target="_blank" rel="nofollow">
                                    <img src="' . $image_url . '" width="300" height="250" alt="' . $image_alt . '">
                           </a>';
				} else {
					$output .= '<img src="' . $image_url . '" width="300" height="250" alt="' . $image_alt . '">';
				}
				$output .= '</div>';
				echo $output;
			}
			?>
		</div>
		<?php
		echo $after_widget;
	}

}
