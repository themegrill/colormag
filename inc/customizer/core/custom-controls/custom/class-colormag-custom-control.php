<?php
/**
 * Extend WP_Customize_Control to add custom control.
 *
 * Class ColorMag_Custom_Control
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
 * Class to extend WP_Customize_Control to add custom customize control.
 *
 * Class ColorMag_Custom_Control
 */
class ColorMag_Custom_Control extends ColorMag_Customize_Base_Additional_Control {

	/**
	 * Control's Type.
	 *
	 * @var string
	 */
	public $type = 'colormag-custom';

	/**
	 * Custom information for this control.
	 *
	 * @var string
	 */
	public $info = '';

	/**
	 * Custom links for this control.
	 *
	 * @var array
	 */
	public $links = array();

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

		$this->json['info']  = $this->info;
		$this->json['links'] = $this->links;

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

		<# if ( data.info ) { #>
		<div class="colormag-custom-info">
			{{{ data.info }}}
		</div>
		<# } #>

		<# if ( data.links ) { #>
		<ul class="colormag-custom-links">
			<# _.each( data.links, function( links, id ) { #>
			<li><a href="{{{ links.url }}}" target="_blank">{{{ links.text }}}</a></li>
			<# } ) #>
		</ul>
		<# } #>

		<?php
	}

	/**
	 * Don't render the control content from PHP, as it's rendered via JS on load.
	 */
	public function render_content() {
	}

}
