<?php
/**
 * Extend WP_Customize_Control to add the title control.
 *
 * Class ColorMag_Subtitle_Control
 *
 * @package    ThemeGrill
 * @subpackage ColorMag
 * TODO        @since
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * Class to extend WP_Customize_Control to add the title customize control.
 *
 * Class ColorMag_Subtitle_Control
 */
class ColorMag_Subtitle_Control extends ColorMag_Customize_Base_Additional_Control {

	/**
	 * Control's Type.
	 *
	 * @var string
	 */
	public $type = 'colormag-subtitle';

	/**
	 * Refresh the parameters passed to the JavaScript via JSON.
	 *
	 * @see WP_Customize_Control::to_json()
	 */
	public function to_json() {

		parent::to_json();

		$this->json['label'] = esc_html( $this->label );

	}

	/**
	 * An Underscore (JS) template for this control's content (but not its container).
	 *
	 * Class variables for this control class are available in the `data` JS object;
	 * export custom variables by overriding {@see WP_Customize_Control::to_json()}.
	 *
	 * @see WP_Customize_Control::print_template()
	 */
	protected function content_template() {
		?>

		<div class="colormag-subtitle-wrapper">
			<div class="customizer-text">
				<# if ( data.label ) { #>
				<span class="customize-control-subtitle">{{{ data.label }}}</span>
				<# } #>
			</div>
		</div>

		<?php
	}

	/**
	 * Don't render the control content from PHP, as it's rendered via JS on load.
	 */
	public function render_content() {
	}

}
