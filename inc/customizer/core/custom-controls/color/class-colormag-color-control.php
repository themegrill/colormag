<?php
/**
 * Extend WP_Customize_Control to add the color control.
 *
 * Class ColorMag_Color_Control
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
 * Class to extend WP_Customize_Control to add the color customize control.
 *
 * Class ColorMag_Color_Control
 */
class ColorMag_Color_Control extends ColorMag_Customize_Base_Additional_Control {

	/**
	 * Control's Type.
	 *
	 * @var string
	 */
	public $type = 'colormag-color';

	/**
	 * Enqueue control related scripts/styles.
	 */
	public function enqueue() {
		parent::enqueue();

		/**
		 * Color picker strings from WordPress.
		 *
		 * Added since WordPress 5.5 has removed them causing alpha color not appearing issue.
		 */
		if ( version_compare( $GLOBALS['wp_version'], '5.5', '>=' ) ) {
			wp_localize_script(
				'wp-color-picker',
				'wpColorPickerL10n',
				array(
					'clear'            => esc_html__( 'Clear', 'colormag' ),
					'clearAriaLabel'   => esc_html__( 'Clear color', 'colormag' ),
					'defaultString'    => esc_html__( 'Default', 'colormag' ),
					'defaultAriaLabel' => esc_html__( 'Select default color', 'colormag' ),
					'pick'             => esc_html__( 'Select Color', 'colormag' ),
					'defaultLabel'     => esc_html__( 'Color value', 'colormag' ),
				)
			);
		}
	}

	/**
	 * Refresh the parameters passed to the JavaScript via JSON.
	 *
	 * @see WP_Customize_Control::to_json()
	 */
	public function to_json() {

		parent::to_json();

		$this->json['default'] = $this->setting->default;
		if ( isset( $this->default ) ) {
			$this->json['default'] = $this->default;
		}
		$this->json['value'] = $this->value();

		$this->json['link']        = $this->get_link();
		$this->json['id']          = $this->id;
		$this->json['label']       = esc_html( $this->label );
		$this->json['description'] = $this->description;

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
		<div class="customizer-wrapper">
			<div class="customizer-text">
				<# if ( data.label ) { #>
				<span class="customize-control-title">{{{ data.label }}}</span>
				<# } #>

				<# if ( data.description ) { #>
				<span class="description customize-control-description">{{{ data.description }}}</span>
				<# } #>
			</div>

			<div class="customize-control-content">
				<input class="colormag-color-picker-alpha color-picker-hex"
					   type="text"
					   data-alpha="true"
					   data-default-color="{{ data.default }}"
					   value="{{ data.value }}"
				/>
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
