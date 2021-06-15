<?php
/**
 * Extend WP_Customize_Control to add the divider control.
 *
 * Class ColorMag_Divider_Control
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
 * Class to extend WP_Customize_Control to add the divider customize control.
 *
 * Class ColorMag_Divider_Control
 */
class ColorMag_Divider_Control extends ColorMag_Customize_Base_Additional_Control {

	/**
	 * Control's Type.
	 *
	 * @var string
	 */
	public $type = 'colormag-divider';

	/**
	 * Divider placement
	 *
	 * @var string
	 */
	public $placement = 'above';

	/**
	 * Refresh the parameters passed to the JavaScript via JSON.
	 *
	 * @see WP_Customize_Control::to_json()
	 */
	public function to_json() {

		parent::to_json();

		$this->json['label']       = esc_html( $this->label );
		$this->json['description'] = $this->description;

		$this->json['placement'] = $this->placement;

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

		<div class="divider-placement-{{ data.placement }}">
			<# if ( data.placement == 'above' ) { #>
			<hr />
			<# } #>

			<div class="customizer-text">
				<# if ( data.label ) { #>
				<span class="customize-control-title">{{{ data.label }}}</span>
				<# } #>

				<# if ( data.description ) { #>
				<span class="description customize-control-description">{{{ data.description }}}</span>
				<# } #>
			</div>

			<# if ( data.placement == 'below' ) { #>
			<hr />
			<# } #>
		</div>

		<?php
	}

}
