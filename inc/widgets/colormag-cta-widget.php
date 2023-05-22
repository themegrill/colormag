<?php
/**
 * Call To Action Widget.
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
 * Call To Action Widget.
 *
 * Class colormag_cta_widget
 */
class colormag_cta_widget extends ColorMag_Widget {

	/**
	 * Constructor.
	 */
	public function __construct() {

		$this->widget_cssclass    = 'widget_call_to_action';
		$this->widget_description = esc_html__( 'Display Call To Action Widget.', 'colormag' );
		$this->widget_name        = esc_html__( 'TG: Call To Action', 'colormag' );
		$this->settings           = array(
			'background_image' => array(
				'type'    => 'image',
				'default' => '',
				'label'   => esc_html__( 'Background Image ', 'colormag' ),
			),
			'title'            => array(
				'type'    => 'text',
				'default' => '',
				'label'   => esc_html__( 'Title:', 'colormag' ),
			),
			'text'             => array(
				'type'    => 'textarea',
				'default' => '',
				'label'   => esc_html__( 'Description', 'colormag' ),
			),
			'btn_text'         => array(
				'type'    => 'text',
				'default' => '',
				'label'   => esc_html__( 'Button Text:', 'colormag' ),
			),
			'btn_link'         => array(
				'type'    => 'url',
				'default' => '',
				'label'   => esc_html__( 'Button URL:', 'colormag' ),
			),
			'new_tab'          => array(
				'type'    => 'checkbox',
				'default' => 0,
				'label'   => esc_html__( 'Open in new tab', 'colormag' ),
			),
			'align'            => array(
				'type'    => 'select',
				'default' => 'call-to-action--left',
				'label'   => esc_html__( 'Text Align:', 'colormag' ),
				'choices' => array(
					'call-to-action--left'   => esc_html__( 'Left', 'colormag' ),
					'call-to-action--center' => esc_html__( 'Center', 'colormag' ),
					'call-to-action--right'  => esc_html__( 'Right', 'colormag' ),
				),
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

		$background_image = isset( $instance['background_image'] ) ? $instance['background_image'] : '';
		$title            = apply_filters( 'widget_title', isset( $instance['title'] ) ? $instance['title'] : '' );
		$text             = isset( $instance['text'] ) ? $instance['text'] : '';
		$btn_link         = isset( $instance['btn_link'] ) ? $instance['btn_link'] : '';
		$btn_text         = isset( $instance['btn_text'] ) ? $instance['btn_text'] : '';
		$new_tab          = ! empty( $instance['new_tab'] ) ? 'target="_blank"' : '';
		$align            = isset( $instance['align'] ) ? $instance['align'] : 'call-to-action--left';

		// For WPML plugin compatibility, register string.
		if ( function_exists( 'icl_register_string' ) ) {
			icl_register_string( 'ColorMag Pro', 'TG: CTA Description' . $this->id, $text );
			icl_register_string( 'ColorMag Pro', 'TG: CTA Button Text' . $this->id, $btn_text );
			icl_register_string( 'ColorMag Pro', 'TG: CTA Button URL' . $this->id, $btn_link );
			icl_register_string( 'ColorMag Pro', 'TG: CTA Background Image' . $this->id, $background_image );
		}

		// For WPML plugin compatibility, assign variable to converted string.
		if ( function_exists( 'icl_t' ) ) {
			$text             = icl_t( 'ColorMag Pro', 'TG: CTA Description' . $this->id, $text );
			$btn_text         = icl_t( 'ColorMag Pro', 'TG: CTA Button Text' . $this->id, $btn_text );
			$btn_link         = icl_t( 'ColorMag Pro', 'TG: CTA Button URL' . $this->id, $btn_link );
			$background_image = icl_t( 'ColorMag Pro', 'TG: CTA Background Image' . $this->id, $background_image );
		}

		$style = '';
		if ( ! empty( $background_image ) ) {
			$style = " style=background-image:url({$background_image})";
		}

		$this->widget_start( $args );
		?>

		<div class="call-to-action"<?php echo esc_attr( $style ); ?>>
			<div class="call-to-action-border <?php echo esc_attr( $align ); ?>">
				<?php if ( ! empty( $title ) ) : ?>
					<h3 class="call-to-action__title"><?php echo esc_html( $title ); ?></h3>
				<?php endif; ?>

				<?php if ( ! empty( $text ) ) : ?>
					<div class="call-to-action-content">
						<p><?php echo esc_html( $text ); ?></p>
					</div>
				<?php endif; ?>

				<?php if ( ! empty( $btn_link ) ) : ?>
					<a href="<?php echo esc_url( $btn_link ); ?>"
					   class="btn--primary" <?php echo esc_attr( $new_tab ); ?>
					>
						<?php echo esc_html( $btn_text ); ?>
					</a>
				<?php endif; ?>
			</div>
		</div>

		<?php
		$this->widget_end( $args );

	}

}
