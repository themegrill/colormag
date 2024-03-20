<?php
/**
 * 728x90 Advertisement Ads Widget.
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
 * 728x90 Advertisement Ads Widget.
 *
 * Class colormag_728x90_advertisement_widget
 */
class colormag_728x90_advertisement_widget extends ColorMag_Widget {

	/**
	 * Constructor.
	 */
	public function __construct() {

		$this->widget_cssclass    = 'cm-728x90-advertisemen-widget';
		$this->widget_description = esc_html__( 'Add your 728x90 Advertisement here', 'colormag' );
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

		$title      = apply_filters( 'widget_title', isset( $instance['title'] ) ? $instance['title'] : '' );
		$image_link = isset( $instance['728x90_image_link'] ) ? $instance['728x90_image_link'] : '';
		$image_url  = isset( $instance['728x90_image_url'] ) ? $instance['728x90_image_url'] : '';

		// For WPML plugin compatibility, register string.
		if ( function_exists( 'icl_register_string' ) ) {
			icl_register_string( 'ColorMag Pro', 'TG: 728x90 Image Link' . $this->id, $image_link );
			icl_register_string( 'ColorMag Pro', 'TG: 728x90 Image URL' . $this->id, $image_url );
		}

		// For WPML plugin compatibility, assign variable to converted string.
		if ( function_exists( 'icl_t' ) ) {
			$image_link = icl_t( 'ColorMag Pro', 'TG: 728x90 Image Link' . $this->id, $image_link );
			$image_url  = icl_t( 'ColorMag Pro', 'TG: 728x90 Image URL' . $this->id, $image_url );
		}

		$this->widget_start( $args );
		?>

		<div class="advertisement_728x90">
			<?php if ( ! empty( $title ) ) { ?>
				<div class="cm-advertisement-title">
					<?php echo wp_kses_post( $args['before_title'] ) . esc_html( $title ) . wp_kses_post( $args['after_title'] ); ?>
				</div>
				<?php
			}

			$output = '';

			if ( ! empty( $image_url ) ) {
				$image_id  = attachment_url_to_postid( $image_url );
				$image_alt = get_post_meta( $image_id, '_wp_attachment_image_alt', true );

				$output .= '<div class="cm-advertisement-content">';
				if ( ! empty( $image_link ) ) {

					$output .= '<a href="' . $image_link . '" class="single_ad_728x90" target="_blank" rel="nofollow">';
					$output .= '<img src="' . $image_url . '" width="728" height="90" alt="' . $image_alt . '">';
					$output .= '</a>';
				} else {
					$output .= '<img src="' . $image_url . '" width="728" height="90" alt="' . $image_alt . '">';
				}
				$output .= '</div>';

				echo wp_kses_post( $output );
			}
			?>
		</div>

		<?php
		$this->widget_end( $args );
	}
}
