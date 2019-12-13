<?php
/**
 * Extend WP_Customize_Control to add the editor control.
 *
 * Class ColorMag_Editor_ControlColorMag_Editor_Control
 *
 * @since 3.0.0
 */

/**
 * Class to extend WP_Customize_Control to add the editor customize control.
 *
 * Class ColorMag_Heading_Control
 */
class ColorMag_Editor_Control extends WP_Customize_Control {

	/**
	 * Control's Type.
	 *
	 * @var string
	 */
	public $type = 'colormag-editor';

	/**
	 * Refresh the parameters passed to the JavaScript via JSON.
	 *
	 * @see WP_Customize_Control::to_json()
	 */
	public function to_json() {

		parent::to_json();

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

		<div class="customizer-text">

		</div>

		<?php
	}

	/**
	 * Don't render the control content from PHP, as it's rendered via JS on load.
	 */
	public function render_content() {
	}

}
