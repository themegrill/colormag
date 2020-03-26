<?php
/**
 * Extend WP_Customize_Control to include typography control.
 *
 * Class ColorMag_Typography_Control
 *
 * @package    ThemeGrill
 * @subpackage ColorMag
 * @since      ColorMag 2.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class to extend WP_Customize_Control to add the typography customize control.
 *
 * Class ColorMag_Typography_Control
 */
class ColorMag_Typography_Control extends ColorMag_Customize_Base_Additional_Control {

	/**
	 * Control's Type.
	 *
	 * @var string
	 */
	public $type = 'colormag-typography';

	/**
	 * Languages required subsets.
	 *
	 * @var array
	 */
	public $languages = array();

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

		if ( ! array_key_exists( 'fonts', $this->choices ) ) {
			$this->json['choices'] = array(
				'fonts' => array(
					'google'   => array(),
					'standard' => array(),
				),
			);
		} else {
			$this->json['choices'] = $this->choices;
		}
		$this->json['languages'] = ColorMag_Fonts::get_google_font_subsets();

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
			<# if ( data.label ) { #>
			<span class="customize-control-title">{{{ data.label }}}</span>
			<# } #>

			<# if ( data.description ) { #>
			<span class="description customize-control-description">{{{ data.description }}}</span>
			<# } #>
		</div>

		<div class="customize-control-content">

			<# if ( data.default['font-family'] ) { #>

			<# if ( data.choices['fonts'] ) { data.fonts = data.choices['fonts']; } #>
			<div class="font-family">
				<spacn class="customize-control-title"><?php esc_html_e( 'Family', 'colormag' ); ?></spacn>
				<div class="colormag-field-content">
					<select {{{ data.inputAttrs }}} id="colormag-font-family-{{{ data.id }}}"></select>
				</div>
			</div>

			<# if ( data.default['font-weight'] ) { #>
			<div class="font-weight">
				<span class="customize-control-title"><?php esc_html_e( 'Weight', 'colormag' ); ?></span>
				<div class="colormag-field-content">
					<select {{{ data.inputAttrs }}} id="colormag-font-weight-{{{ data.id }}}"></select>
				</div>
			</div>
			<# } #>

			<# } #>

			<input class="typography-hidden-value"
			       value="{{ JSON.stringify( data.value ) }}"
			       type="hidden" {{{ data.link }}}
			>

		</div>

		<?php
	}

	/**
	 * Don't render the control content from PHP, as it's rendered via JS on load.
	 */
	public function render_content() {
	}

}
