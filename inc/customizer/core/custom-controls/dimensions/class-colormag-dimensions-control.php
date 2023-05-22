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
	 * Suffix for Dimension.
	 *
	 * @var array
	 */
	public $suffix = array();

	/**
	 * Refresh the parameters passed to the JavaScript via JSON.
	 *
	 * @see WP_Customize_Control::to_json()
	 */
	public function to_json() {

		parent::to_json();

		$this->json['default'] = isset( $this->default ) ? $this->default : $this->setting->default;
		$this->json['value']   = $this->value();
		$this->json['suffix']  = $this->suffix;
		$this->json['link']    = $this->get_link();
		$this->json['choices'] = $this->choices;
		$this->json['id']      = $this->id;
		$this->json['sides']   = array(
			'top'    => __( 'Top', 'colormag' ),
			'right'  => __( 'Right', 'colormag' ),
			'bottom' => __( 'Bottom', 'colormag' ),
			'left'   => __( 'Left', 'colormag' ),
		);

	}

	/**
	 * Renders the Underscore template for this control.
	 *
	 * @see    WP_Customize_Control::print_template()
	 * @return void
	 */
	protected function content_template() {
		?>

		<div class="colormag-dimension-wrapper">
			<input type="hidden" value='{{{ "object" === typeof data.value ? JSON.stringify( data.value ) : data.value  }}}' id="colormag_dimensions_{{{ data.id }}}" name="colormag_dimensions_{{{ data.id }}}">
			<# if ( data.label ) { #>
			<div class="dimension-label-unit-wrapper">
				<div class="label-switcher-wrapper">
					<span class="customize-control-label">{{{ data.label }}}</span>
				</div>
				<div class="unit-wrapper">
					<div class="input-wrapper">
						<select class="dimension-unit" name="unit" data-type="unit" value="">
							<# _.each( data.suffix, function( suffix ) { #>
							<option value="{{ suffix }}" {{{ data.value.unit && data.value.unit == suffix ? 'selected' : '' }}}>{{{ suffix }}}</option>
							<# } ); #>
						</select>
						<div class="colormag-dimensions-reset">
							<span class="dashicons dashicons-image-rotate"
								title="<?php esc_attr_e( 'Back to default', 'colormag' ); ?>">
							</span>
						</div>
					</div>
				</div>
			</div>
			<# } #>
			<# if ( data.description ) { #>
				<span class="description customize-control-description">{{{ data.description }}}</span>
			<# } #>
			<div class="wrapper">
                <div class="control">
					<# _.each( data.sides, function( label, key ) { #>
						<label for="{{ key }}" class="{{ key }}">
							<input type="number"
                                   id="{{ key }}"
                                   data-type="{{{ key }}}"
                                   value="{{{ data.value[ key ] ? data.value[ key ] : data.default[ key ] }}}"
							<h5>{{{ label }}}</h5>
						</label>
					<# } ) #>
					<button class="colormag-binding">
						<svg xmlns="http://www.w3.org/2000/svg" data-name="Layer 1" viewBox="0 0 24 24">
							<path d="M12 22a5 5 0 0 1-5-5v-2.5a.83.83 0 0 1 .83-.83.84.84 0 0 1 .84.83V17a3.33 3.33 0 0 0 6.66 0v-2.5a.84.84 0 0 1 .84-.83.83.83 0 0 1 .83.83V17a5 5 0 0 1-5 5Zm4.17-11.67a.84.84 0 0 1-.84-.83V7a3.33 3.33 0 0 0-6.66 0v2.5a.84.84 0 0 1-.84.83A.83.83 0 0 1 7 9.5V7a5 5 0 0 1 10 0v2.5a.83.83 0 0 1-.83.83Zm-3.34 5V8.67a.83.83 0 1 0-1.66 0v6.66a.83.83 0 1 0 1.66 0Z"/>
						</svg>
					</button>
				</div>
			</div>
		</div>
		<?php
	}

	/**
	 * Don't render the control content from PHP, as it's rendered via JS on load.
	 */
	protected function render_content() {}
}
