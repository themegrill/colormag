<?php
/**
 * ColorMag Video Widget.
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
 * ColorMag Video Widget.
 *
 * Class colormag_video_widget
 */
class colormag_video_widget extends ColorMag_Widget {

	/**
	 * Constructor.
	 */
	public function __construct() {

		$this->widget_cssclass    = 'widget_video_colormag';
		$this->widget_description = esc_html__( 'Add the videos here, Youtube and Vimeo Videos is only accepted for now.', 'colormag' );
		$this->widget_name        = esc_html__( 'TG: Videos', 'colormag' );
		$this->settings           = array(
			'title'      => array(
				'type'    => 'text',
				'default' => '',
				'label'   => esc_html__( 'Title:', 'colormag' ),
			),
			'link'       => array(
				'type'    => 'text',
				'default' => '',
				'label'   => esc_html__( 'Youtube Video ID:', 'colormag' ),
			),
			'vimeo_link' => array(
				'type'    => 'text',
				'default' => '',
				'label'   => esc_html__( 'Vimeo Video ID:', 'colormag' ),
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

		$title      = apply_filters( 'widget_title', isset( $instance['title'] ) ? $instance['title'] : '' );
		$link       = isset( $instance['link'] ) ? $instance['link'] : '';
		$vimeo_link = isset( $instance['vimeo_link'] ) ? $instance['vimeo_link'] : '';

		$this->widget_start( $args );
		?>

		<div class="fitvids-video">
			<?php if ( ! empty( $title ) ) { ?>
				<div class="video-title">
					<?php echo $args['before_title'] . esc_html( $title ) . $args['after_title']; // phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped ?>
				</div>
				<?php
			}

			$output = '';

			// For YouTube video display.
			if ( ! empty( $link ) ) {
				$output .= '<div class="video"><iframe src="https://www.youtube.com/embed/' . esc_attr( $link ) . '"></iframe></div>';
			}

			// For Vimeo video display.
			if ( ! empty( $vimeo_link ) ) {
				$output .= '<div class="video"><iframe src="https://player.vimeo.com/video/' . esc_attr( $vimeo_link ) . '"></iframe></div>';
			}

			echo $output; // phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped
			?>
		</div>
		<?php
		$this->widget_end( $args );

	}

}
