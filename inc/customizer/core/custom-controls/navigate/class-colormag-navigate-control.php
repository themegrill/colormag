<?php
/**
 * Extend WP_Customize_Control to add the navigate control.
 *
 * Class ColorMag_Navigate_Control
 *
 * @package    ThemeGrill
 * @subpackage ColorMag
 * @since      ColorMag 3.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class to extend WP_Customize_Control to add the navigate customize control.
 *
 * Class ColorMag_Navigate_Control
 */
class ColorMag_Navigate_Control extends ColorMag_Customize_Base_Additional_Control {

	/**
	 * Control's Type.
	 *
	 * @var string
	 */
	public $type = 'colormag-navigate';

	public $navigate_info = array();

	/**
	 * Refresh the parameters passed to the JavaScript via JSON.
	 *
	 * @see WP_Customize_Control::to_json()
	 */
	public function to_json() {

		parent::to_json();

		$this->json['label']       = esc_html( $this->label );
		$this->json['description'] = $this->description;
		$this->json['navigate_info']    = $this->navigate_info;

	}

	/**
	 * An Underscore (JS) template for this control's content (but not its container).
	 *
	 * Class variables for this control class are available in the `data` JS object;
	 * export custom variables by overriding {@see WP_Customize_Control::to_json()}.
	 *
	 * @see    WP_Customize_Control::print_template()
	 *
	 * @access protected
	 */
	protected function content_template() {
		?>
		<div class="customize-control-content tg-navigate">
			<?php
			echo sprintf(
				/* Translators: %1$s: Anchor tag open, %2$s: Customizer section name %3$s: Anchor tag close */
				esc_html__(
					'%1$s Click here to edit %2$s features %3$s',
					'colormag'
				),
				'<a data-section="{{{ data.navigate_info.target_id }}}" href="#">',
				'{{{ data.navigate_info.target_label }}}',
				'</a>'
			);
			?>
		</div>
		<?php
	}

	/**
	 * Don't render the control content from PHP, as it's rendered via JS on load.
	 */
	public function render_content() {

	}
}
