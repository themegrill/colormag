<?php
/**
 * 125x125 Advertisement Ads Widget.
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
 * 125x125 Advertisement Ads Widget.
 *
 * Class colormag_125x125_advertisement_widget
 */
class colormag_125x125_advertisement_widget extends ColorMag_Widget {

	/**
	 * Constructor.
	 */
	public function __construct() {

		$this->widget_cssclass    = 'widget_125x125_advertisement';
		$this->widget_description = esc_html__( 'Add your 125x125 Advertisement here', 'colormag' );
		$this->widget_name        = esc_html__( 'TG: 125x125 Advertisement', 'colormag' );
		$this->settings           = array(
			'title'                => array(
				'type'    => 'text',
				'default' => '',
				'label'   => esc_html__( 'Title:', 'colormag' ),
			),
			'image_addition_label' => array(
				'type'    => 'custom',
				'default' => '',
				'label'   => esc_html__( 'Add your Advertisement 125x125 Images Here', 'colormag' ),
			),
			'125x125_image_link_1' => array(
				'type'    => 'url',
				'default' => '',
				'label'   => esc_html__( 'Advertisement Image Link ', 'colormag' ) . 1,
			),
			'125x125_image_url_1'  => array(
				'type'    => 'image',
				'default' => '',
				'label'   => esc_html__( 'Advertisement Image ', 'colormag' ) . 1,
			),
			'125x125_image_link_2' => array(
				'type'    => 'url',
				'default' => '',
				'label'   => esc_html__( 'Advertisement Image Link ', 'colormag' ) . 2,
			),
			'125x125_image_url_2'  => array(
				'type'    => 'image',
				'default' => '',
				'label'   => esc_html__( 'Advertisement Image ', 'colormag' ) . 2,
			),
			'125x125_image_link_3' => array(
				'type'    => 'url',
				'default' => '',
				'label'   => esc_html__( 'Advertisement Image Link ', 'colormag' ) . 3,
			),
			'125x125_image_url_3'  => array(
				'type'    => 'image',
				'default' => '',
				'label'   => esc_html__( 'Advertisement Image ', 'colormag' ) . 3,
			),
			'125x125_image_link_4' => array(
				'type'    => 'url',
				'default' => '',
				'label'   => esc_html__( 'Advertisement Image Link ', 'colormag' ) . 4,
			),
			'125x125_image_url_4'  => array(
				'type'    => 'image',
				'default' => '',
				'label'   => esc_html__( 'Advertisement Image ', 'colormag' ) . 4,
			),
			'125x125_image_link_5' => array(
				'type'    => 'url',
				'default' => '',
				'label'   => esc_html__( 'Advertisement Image Link ', 'colormag' ) . 5,
			),
			'125x125_image_url_5'  => array(
				'type'    => 'image',
				'default' => '',
				'label'   => esc_html__( 'Advertisement Image ', 'colormag' ) . 5,
			),
			'125x125_image_link_6' => array(
				'type'    => 'url',
				'default' => '',
				'label'   => esc_html__( 'Advertisement Image Link ', 'colormag' ) . 6,
			),
			'125x125_image_url_6'  => array(
				'type'    => 'image',
				'default' => '',
				'label'   => esc_html__( 'Advertisement Image ', 'colormag' ) . 6,
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

		$title       = apply_filters( 'widget_title', isset( $instance['title'] ) ? $instance['title'] : '' );
		$image_array = array();
		$link_array  = array();

		for ( $i = 1; $i < 7; $i ++ ) {
			$image_link = isset( $instance[ '125x125_image_link_' . $i ] ) ? $instance[ '125x125_image_link_' . $i ] : '';
			$image_url  = isset( $instance[ '125x125_image_url_' . $i ] ) ? $instance[ '125x125_image_url_' . $i ] : '';
			array_push( $link_array, $image_link );
			array_push( $image_array, $image_url );
		}

		$this->widget_start( $args );
		?>

		<div class="advertisement_125x125">
			<?php if ( ! empty( $title ) ) { ?>
				<div class="advertisement-title">
					<?php echo $args['before_title'] . esc_html( $title ) . $args['after_title']; // phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped ?>
				</div>
				<?php
			}

			$output = '';

			if ( ! empty( $image_array ) ) {
				$output .= '<div class="advertisement-content">';

				for ( $i = 1; $i < 7; $i ++ ) {
					$j = $i - 1;

					if ( ! empty( $image_array[ $j ] ) ) {
						$image_id  = attachment_url_to_postid( $image_array[ $j ] );
						$image_alt = get_post_meta( $image_id, '_wp_attachment_image_alt', true );

						if ( ! empty( $link_array[ $j ] ) ) {
							$output .= '<a href="' . $link_array[ $j ] . '" class="single_ad_125x125" target="_blank" rel="nofollow">';
							$output .= '<img src="' . $image_array[ $j ] . '" width="125" height="125" alt="' . $image_alt . '">';
							$output .= '</a>';
						} else {
							$output .= '<img src="' . $image_array[ $j ] . '" width="125" height="125" alt="' . $image_alt . '">';
						}
					}
				}

				$output .= '</div>';

				echo $output; // phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped
			}
			?>
		</div>

		<?php
		$this->widget_end( $args );

	}

}
