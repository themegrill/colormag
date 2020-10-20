<?php
/**
 * Extend WP_Customize_Control to add the title control.
 *
 * Class ColorMag_Title_Control
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
 * Class to extend WP_Customize_Control to add the title customize control.
 *
 * Class ColorMag_Title_Control
 */
class ColorMag_Title_Control extends ColorMag_Customize_Base_Additional_Control {

	/**
	 * Control's Type.
	 *
	 * @var string
	 */
	public $type = 'colormag-title';
	public $link = '';

	/**
	 * Refresh the parameters passed to the JavaScript via JSON.
	 *
	 * @see WP_Customize_Control::to_json()
	 */
	public function to_json() {

		parent::to_json();

		$this->json['label']       = esc_html( $this->label );
		$this->json['description'] = $this->description;
		$this->json['link']        = esc_url( $this->link );

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

        <div class="colormag-title-wrapper">
            <label class="customizer-text">
                <# if ( data.label ) { #>
                <span class="customize-control-title">{{{ data.label }}}</span>
                <# if ( data.description ) { #>
                <span class="tool-tip">
					<i class="dashicons dashicons-editor-help"></i>
					<span class="tooltip-text">{{{ data.description }}}</span>
				</span>
                <# } #>
                <# } #>
            </label>
            <# if ( data.link ) { #>
            <div class="guide-tutorial">
                <span class="control-url">
					<a href=  " {{{data.link}}} "   target="_blank">Doc</a>
				</span>
            </div>
            <# } #>
        </div>

		<?php
	}

	/**
	 * Don't render the control content from PHP, as it's rendered via JS on load.
	 */
	public function render_content() {
	}

}
