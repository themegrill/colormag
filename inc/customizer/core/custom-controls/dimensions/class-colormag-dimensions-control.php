<?php
/**
 * Customize Dimensions control class.
 *
 * @package colormag
 *
 * @see WP_Customize_Control
 */

/**
 * Class ColorMag_Dimensions_Control
 */
class ColorMag_Dimensions_Control extends ColorMag_Customize_Base_Additional_Control {


	/**
	 * Control's Type.
	 *
	 * @var string
	 */
	public $type = 'colormag-dimensions';

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

		$this->json['link']    = $this->get_link();
		$this->json['choices'] = $this->choices;

	}

	/**
	 * Renders the Underscore template for this control.
	 *
	 * @see    WP_Customize_Control::print_template()
	 * @return void
	 */
	protected function content_template() {
		?>

		<label>
			<# if ( data.label ) { #><span class="customize-control-title">{{{ data.label }}}</span><# } #>
			<# if ( data.description ) { #><span class="description customize-control-description">{{{ data.description }}}</span><#
			} #>
			<div class="wrapper">
				<div class="control">
					<# if ( data.default['top'] ) { #>
					<div class="top">
						<h5>Top</h5>
						<div class="input-wrapper">
							<input type="text"
							<# if ( data.value['top'] ) { #>
							value="{{ data.value['top'] }}"
							<# } else { #>
							value="{{ data.default['top'] }}"
							<# } #>
							/>

						</div>
					</div>
					<# } #>

					<# if ( data.default['right'] ) { #>
					<div class="right">
						<h5>Right</h5>
						<div class="input-wrapper">
							<input type="text"
							<# if ( data.value['right'] ) { #>
							value="{{ data.value['right'] }}"
							<# } else { #>
							value="{{ data.default['right'] }}"
							<# } #>
							/>

						</div>
					</div>
					<# } #>

					<# if ( data.default['bottom'] ) { #>
					<div class="bottom">
						<h5>Bottom</h5>
						<div class="input-wrapper">
							<input type="text"
							<# if ( data.value['bottom'] ) { #>
							value="{{ data.value['bottom'] }}"
							<# } else { #>
							value="{{ data.default['bottom'] }}"
							<# } #>
							/>

						</div>
					</div>
					<# } #>

					<# if ( data.default['left'] ) { #>
					<div class="left">
						<h5>Left</h5>
						<div class="input-wrapper">
							<input type="text"
							<# if ( data.value['left'] ) { #>
							value="{{ data.value['left'] }}"
							<# } else { #>
							value="{{ data.default['left'] }}"
							<# } #>
							/>

						</div>
					</div>
				</div>
				<# } #>

				<input class="dimensions-hidden-value"
					   value="{{ JSON.stringify( data.value ) }}"
					   type="hidden" {{{ data.link }}}
				>

			</div>
		</label>

		<?php
	}

	/**
	 * Don't render the control content from PHP, as it's rendered via JS on load.
	 */
	protected function render_content() {

	}

}
