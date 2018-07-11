<?php
/**
 * Contains all the functions related to sidebar and widget.
 *
 * @package    ThemeGrill
 * @subpackage ColorMag
 * @since      ColorMag 1.0
 */
add_action( 'widgets_init', 'colormag_widgets_init' );

/**
 * Function to register the widget areas(sidebar) and widgets.
 */
function colormag_widgets_init() {

	/**
	 * Registering widget areas for front page
	 */
	// Registering main right sidebar
	register_sidebar( array(
		'name'          => esc_html__( 'Right Sidebar', 'colormag' ),
		'id'            => 'colormag_right_sidebar',
		'description'   => esc_html__( 'Shows widgets at Right side.', 'colormag' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s clearfix">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title"><span>',
		'after_title'   => '</span></h3>',
	) );

	// Registering main left sidebar
	register_sidebar( array(
		'name'          => esc_html__( 'Left Sidebar', 'colormag' ),
		'id'            => 'colormag_left_sidebar',
		'description'   => esc_html__( 'Shows widgets at Left side.', 'colormag' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s clearfix">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title"><span>',
		'after_title'   => '</span></h3>',
	) );

	// Registering Header sidebar
	register_sidebar( array(
		'name'          => esc_html__( 'Header Sidebar', 'colormag' ),
		'id'            => 'colormag_header_sidebar',
		'description'   => esc_html__( 'Shows widgets in header section just above the main navigation menu.', 'colormag' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s clearfix">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	// registering the Front Page: Slider Area Sidebar
	register_sidebar( array(
		'name'          => esc_html__( 'Front Page: Slider Area', 'colormag' ),
		'id'            => 'colormag_front_page_slider_area',
		'description'   => esc_html__( 'Show widget just below menu. Suitable for TG: Featured Category Slider.', 'colormag' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s clearfix">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title"><span>',
		'after_title'   => '</span></h3>',
	) );

	// registering the Front Page: Area beside slider Sidebar
	register_sidebar( array(
		'name'          => esc_html__( 'Front Page: Area beside slider', 'colormag' ),
		'id'            => 'colormag_front_page_area_beside_slider',
		'description'   => esc_html__( 'Show widget beside the slider. Suitable for TG: Highlighted Posts.', 'colormag' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s clearfix">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title"><span>',
		'after_title'   => '</span></h3>',
	) );

	// registering the Front Page: Content Top Section Sidebar
	register_sidebar( array(
		'name'          => esc_html__( 'Front Page: Content Top Section', 'colormag' ),
		'id'            => 'colormag_front_page_content_top_section',
		'description'   => esc_html__( 'Content Top Section', 'colormag' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s clearfix">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title"><span>',
		'after_title'   => '</span></h3>',
	) );

	// registering the Front Page: Content Middle Left Section Sidebar
	register_sidebar( array(
		'name'          => esc_html__( 'Front Page: Content Middle Left Section', 'colormag' ),
		'id'            => 'colormag_front_page_content_middle_left_section',
		'description'   => esc_html__( 'Content Middle Left Section', 'colormag' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s clearfix">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title"><span>',
		'after_title'   => '</span></h3>',
	) );

	// registering the Front Page: Content Middle Right Section Sidebar
	register_sidebar( array(
		'name'          => esc_html__( 'Front Page: Content Middle Right Section', 'colormag' ),
		'id'            => 'colormag_front_page_content_middle_right_section',
		'description'   => esc_html__( 'Content Middle Right Section', 'colormag' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s clearfix">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title"><span>',
		'after_title'   => '</span></h3>',
	) );

	// registering the Front Page: Content Bottom Section Sidebar
	register_sidebar( array(
		'name'          => esc_html__( 'Front Page: Content Bottom Section', 'colormag' ),
		'id'            => 'colormag_front_page_content_bottom_section',
		'description'   => esc_html__( 'Content Bottom Section', 'colormag' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s clearfix">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title"><span>',
		'after_title'   => '</span></h3>',
	) );

	// Registering contact Page sidebar
	register_sidebar( array(
		'name'          => esc_html__( 'Contact Page Sidebar', 'colormag' ),
		'id'            => 'colormag_contact_page_sidebar',
		'description'   => esc_html__( 'Shows widgets on Contact Page Template.', 'colormag' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s clearfix">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title"><span>',
		'after_title'   => '</span></h3>',
	) );

	// Registering Error 404 Page sidebar
	register_sidebar( array(
		'name'          => esc_html__( 'Error 404 Page Sidebar', 'colormag' ),
		'id'            => 'colormag_error_404_page_sidebar',
		'description'   => esc_html__( 'Shows widgets on Error 404 page.', 'colormag' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s clearfix">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title"><span>',
		'after_title'   => '</span></h3>',
	) );

	// Registering advertisement above footer sidebar
	register_sidebar( array(
		'name'          => esc_html__( 'Advertisement Above The Footer', 'colormag' ),
		'id'            => 'colormag_advertisement_above_the_footer_sidebar',
		'description'   => esc_html__( 'Shows widgets just above the footer, suitable for TG: 728x90 Advertisement widget.', 'colormag' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s clearfix">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title"><span>',
		'after_title'   => '</span></h3>',
	) );

	// Registering footer sidebar one
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Sidebar One', 'colormag' ),
		'id'            => 'colormag_footer_sidebar_one',
		'description'   => esc_html__( 'Shows widgets at footer sidebar one.', 'colormag' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s clearfix">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title"><span>',
		'after_title'   => '</span></h3>',
	) );

	// Registering footer sidebar two
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Sidebar Two', 'colormag' ),
		'id'            => 'colormag_footer_sidebar_two',
		'description'   => esc_html__( 'Shows widgets at footer sidebar two.', 'colormag' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s clearfix">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title"><span>',
		'after_title'   => '</span></h3>',
	) );

	// Registering footer sidebar three
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Sidebar Three', 'colormag' ),
		'id'            => 'colormag_footer_sidebar_three',
		'description'   => esc_html__( 'Shows widgets at footer sidebar three.', 'colormag' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s clearfix">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title"><span>',
		'after_title'   => '</span></h3>',
	) );

	// Registering footer sidebar four
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Sidebar Four', 'colormag' ),
		'id'            => 'colormag_footer_sidebar_four',
		'description'   => esc_html__( 'Shows widgets at footer sidebar four.', 'colormag' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s clearfix">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title"><span>',
		'after_title'   => '</span></h3>',
	) );

	register_widget( 'colormag_featured_posts_slider_widget' );
	register_widget( 'colormag_highlighted_posts_widget' );
	register_widget( 'colormag_featured_posts_widget' );
	register_widget( 'colormag_featured_posts_vertical_widget' );
	register_widget( 'colormag_728x90_advertisement_widget' );
	register_widget( 'colormag_300x250_advertisement_widget' );
	register_widget( 'colormag_125x125_advertisement_widget' );
}

// Require file for TG: Featured Category Slider widget.
require COLORMAG_WIDGETS_DIR . '/colormag-featured-posts-slider-widget.php';

// Require file for TG: Highlighted Posts.
require COLORMAG_WIDGETS_DIR . '/colormag-highlighted-posts-widget.php';

// Require file for TG: Featured Posts (Style 1).
require COLORMAG_WIDGETS_DIR . '/colormag-featured-posts-widget.php';

// Require file for TG: Featured Posts (Style 2).
require COLORMAG_WIDGETS_DIR . '/colormag-featured-posts-vertical-widget.php';

// Require file for TG: 300x250 Advertisement.
require COLORMAG_WIDGETS_DIR . '/colormag-300x250-advertisement-widget.php';

// Require file for TG: 728x90 Advertisement.
require COLORMAG_WIDGETS_DIR . '/colormag-728x90-advertisement-widget.php';


/**
 * 125x125 Advertisement Ads
 */
class colormag_125x125_advertisement_widget extends WP_Widget {

	function __construct() {
		$widget_ops  = array(
			'classname'                   => 'widget_125x125_advertisement',
			'description'                 => __( 'Add your 125x125 Advertisement here', 'colormag' ),
			'customize_selective_refresh' => true,
		);
		$control_ops = array( 'width' => 200, 'height' => 250 );
		parent::__construct( false, $name = __( 'TG: 125x125 Advertisement', 'colormag' ), $widget_ops );
	}

	function form( $instance ) {
		$instance = wp_parse_args( ( array ) $instance, array(
			'title'                => '',
			'125x125_image_url_1'  => '',
			'125x125_image_url_2'  => '',
			'125x125_image_url_3'  => '',
			'125x125_image_url_4'  => '',
			'125x125_image_url_5'  => '',
			'125x125_image_url_6'  => '',
			'125x125_image_link_1' => '',
			'125x125_image_link_2' => '',
			'125x125_image_link_3' => '',
			'125x125_image_link_4' => '',
			'125x125_image_link_5' => '',
			'125x125_image_link_6' => '',
		) );
		$title    = esc_attr( $instance['title'] );
		for ( $i = 1; $i < 7; $i ++ ) {
			$image_link = '125x125_image_link_' . $i;
			$image_url  = '125x125_image_url_' . $i;

			$instance[ $image_link ] = esc_url( $instance[ $image_link ] );
			$instance[ $image_url ]  = esc_url( $instance[ $image_url ] );
		}
		?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'colormag' ); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
		</p>
		<label><?php _e( 'Add your Advertisement 125x125 Images Here', 'colormag' ); ?></label>
		<?php
		for ( $i = 1; $i < 7; $i ++ ) {
			$image_link = '125x125_image_link_' . $i;
			$image_url  = '125x125_image_url_' . $i;
			?>
			<p>
				<label for="<?php echo $this->get_field_id( $image_link ); ?>"> <?php _e( 'Advertisement Image Link ', 'colormag' );
					echo $i; ?></label>
				<input type="text" class="widefat" id="<?php echo $this->get_field_id( $image_link ); ?>" name="<?php echo $this->get_field_name( $image_link ); ?>" value="<?php echo $instance[ $image_link ]; ?>" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( $image_url ); ?>"> <?php _e( 'Advertisement Image ', 'colormag' );
					echo $i; ?></label>
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
		<?php } ?>

		<?php
	}

	function update( $new_instance, $old_instance ) {
		$instance          = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		for ( $i = 1; $i < 7; $i ++ ) {
			$image_link = '125x125_image_link_' . $i;
			$image_url  = '125x125_image_url_' . $i;

			$instance[ $image_link ] = esc_url_raw( $new_instance[ $image_link ] );
			$instance[ $image_url ]  = esc_url_raw( $new_instance[ $image_url ] );
		}

		return $instance;
	}

	function widget( $args, $instance ) {
		extract( $args );
		extract( $instance );

		$title       = isset( $instance['title'] ) ? $instance['title'] : '';
		$image_array = array();
		$link_array  = array();

		for ( $i = 1; $i < 7; $i ++ ) {
			$image_link = '125x125_image_link_' . $i;
			$image_url  = '125x125_image_url_' . $i;

			$image_link = isset( $instance[ $image_link ] ) ? $instance[ $image_link ] : '';
			$image_url  = isset( $instance[ $image_url ] ) ? $instance[ $image_url ] : '';
			if ( ! empty( $image_link ) ) {
				array_push( $link_array, $image_link );
			}
			if ( ! empty( $image_url ) ) {
				array_push( $image_array, $image_url );
			}
		}
		echo $before_widget;
		?>

		<div class="advertisement_125x125">
			<?php if ( ! empty( $title ) ) { ?>
				<div class="advertisement-title">
					<?php echo $before_title . esc_html( $title ) . $after_title; ?>
				</div>
				<?php
			}
			$output = '';
			if ( ! empty( $image_array ) ) {
				$image_id  = attachment_url_to_postid( $image_url );
				$image_alt = get_post_meta( $image_id, '_wp_attachment_image_alt', true );
				$output    .= '<div class="advertisement-content">';
				for ( $i = 1; $i < 7; $i ++ ) {
					$j = $i - 1;
					if ( ! empty( $image_array[ $j ] ) ) {
						if ( ! empty( $link_array[ $j ] ) ) {
							$output .= '<a href="' . $link_array[ $j ] . '" class="single_ad_125x125" target="_blank" rel="nofollow">
                                 <img src="' . $image_array[ $j ] . '" width="125" height="125" alt="' . $image_alt . '">
                              </a>';
						} else {
							$output .= '<img src="' . $image_array[ $j ] . '" width="125" height="125" alt="' . $image_alt . '">';
						}
					}
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

/* * ************************************************************************************* */
?>
