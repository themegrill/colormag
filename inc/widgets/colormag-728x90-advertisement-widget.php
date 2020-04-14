<?php
/**
 * 728x90 Advertisement Ads Widget.
 *
 * @package    ThemeGrill
 * @subpackage ColorMag
 * @since      ColorMag 1.0.0
 */

/**
 * 728x90 Advertisement Ads Widget.
 *
 * Class colormag_728x90_advertisement_widget
 */
class colormag_728x90_advertisement_widget extends ColorMag_Widget {

	/**
	 * Constructor.
	 */
	public function __construct() {

		$this->widget_cssclass    = 'widget_728x90_advertisement';
		$this->widget_description = esc_html__( 'Add your 728x90 Advertisement here', 'colormag' );
		$this->widget_id          = false;
		$this->widget_name        = esc_html__( 'TG: 728x90 Advertisement', 'colormag' );
		$this->settings           = array(
			'title'                => array(
				'type'    => 'text',
				'default' => '',
				'label'   => esc_html__( 'Title:', 'colormag' ),
			),
			'image_addition_label' => array(
				'type'    => 'custom',
				'default' => '',
				'label'   => esc_html__( 'Add your Advertisement 728x90 Images Here', 'colormag' ),
			),
			'728x90_image_link'    => array(
				'type'    => 'url',
				'default' => '',
				'label'   => esc_html__( 'Advertisement Image Link ', 'colormag' ),
			),
			'728x90_image_url'     => array(
				'type'    => 'image',
				'default' => '',
				'label'   => esc_html__( 'Advertisement Image ', 'colormag' ),
			),
		);

		parent::__construct();

	}

	/**
	 * Output widget.
	 *
	 * @see WP_Widget
	 *
	 * @param array $args     Arguments.
	 * @param array $instance Widget instance.
	 */
	public function widget( $args, $instance ) {
		extract( $args );
		extract( $instance );

		$title = isset( $instance['title'] ) ? $instance['title'] : '';


		$image_link = '728x90_image_link';
		$image_url  = '728x90_image_url';

		$image_link = isset( $instance[ $image_link ] ) ? $instance[ $image_link ] : '';
		$image_url  = isset( $instance[ $image_url ] ) ? $instance[ $image_url ] : '';

		$this->widget_start( $args );
		?>

		<div class="advertisement_728x90">
			<?php if ( ! empty( $title ) ) { ?>
				<div class="advertisement-title">
					<?php echo $before_title . esc_html( $title ) . $after_title; ?>
				</div>
				<?php
			}
			$output    = '';
			$image_id  = attachment_url_to_postid( $image_url );
			$image_alt = get_post_meta( $image_id, '_wp_attachment_image_alt', true );
			if ( ! empty( $image_url ) ) {
				$output .= '<div class="advertisement-content">';
				if ( ! empty( $image_link ) ) {
					$image_id  = attachment_url_to_postid( $image_url );
					$image_alt = get_post_meta( $image_id, '_wp_attachment_image_alt', true );
					$output    .= '<a href="' . $image_link . '" class="single_ad_728x90" target="_blank" rel="nofollow">
                                    <img src="' . $image_url . '" width="728" height="90" alt="' . $image_alt . '">
                           </a>';
				} else {
					$output .= '<img src="' . $image_url . '" width="728" height="90" alt="' . $image_alt . '">';
				}
				$output .= '</div>';
				echo $output;
			}
			?>
		</div>
		<?php
		$this->widget_end( $args );
	}

}
