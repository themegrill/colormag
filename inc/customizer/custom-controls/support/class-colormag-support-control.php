<?php
/**
 * Extend WP_Customize_Control to add the title control.
 *
 * Class ColorMag_Support_Control
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
 * Class ColorMag_Support_Control
 */
class ColorMag_Support_Control extends ColorMag_Customize_Base_Additional_Control {

	/**
	 * Control's Type.
	 *
	 * @var string
	 */
	public $type = 'colormag-guide';
	public $doc = '';
	public $youtube = '';

	/**
	 * Refresh the parameters passed to the JavaScript via JSON.
	 *
	 * @see WP_Customize_Control::to_json()
	 */
	public function to_json() {

		parent::to_json();

		$this->json[ 'label' ]   = esc_html( $this->label );
		$this->json[ 'doc' ]     = esc_url( $this->doc );
		$this->json[ 'youtube' ] = esc_url( $this->youtube );

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

		<div class="colormag-guide-wrapper">

			<div class="guide-wrapper">
                <# if ( data.label ) { #>
				<span class="customize-control-label">
					{{{ data.label }}}
				</span>
                <# } #>
                <# if ( data.doc ) { #>
                <span class="doc-url">
					<a href=  " {{{data.doc}}} "   target="_blank">Doc</a>
				</span>
                <# } #>
                <# if ( data.youtube ) { #>
                <span class="youtube-url">
					<a href=  " {{{data.youtube}}} "   target="_blank">
                        <svg xmlns="http://www.w3.org/2000/svg" data-name="Layer 1" viewBox="0 0 24 24">
                          <path d="M21.58 7.17a2.51 2.51 0 0 0-1.77-1.78C18.25 5 12 5 12 5s-6.25 0-7.81.42a2.51 2.51 0 0 0-1.77 1.75A26.19 26.19 0 0 0 2 12a26.28 26.28 0 0 0 .42 4.85 2.47 2.47 0 0 0 1.77 1.75C5.75 19 12 19 12 19s6.25 0 7.81-.42a2.47 2.47 0 0 0 1.77-1.75A26.28 26.28 0 0 0 22 12a26.19 26.19 0 0 0-.42-4.83ZM10 15V9l5.23 3L10 15Z"/>
                        </svg>
                    </a>
				</span>
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
