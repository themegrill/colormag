<?php
/**
 * Extend WP_Customize_Control to add the slider control.
 *
 * Class ColorMag_Slider_Control
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
 * Class to extend WP_Customize_Control to add the slider customize control.
 *
 * Class ColorMag_Slider_Control
 */
class ColorMag_Slider_Control extends ColorMag_Customize_Base_Additional_Control
{

	/**
	 * Control's Type.
	 *
	 * @var string
	 */
	public $type = 'colormag-slider';

	/**
	 * Suffix for slider.
	 *
	 * @var string
	 */
	public $suffix = '';

	/**
	 * Refresh the parameters passed to the JavaScript via JSON.
	 *
	 * @see WP_Customize_Control::to_json()
	 */
	public function to_json()
	{

		parent::to_json();

		$this->json[ 'default' ] = $this->setting->default;

		if ( isset( $this->default ) ) {
			$this->json[ 'default' ] = $this->default;
		}
		$this->json[ 'value' ] = $this->value();

		$this->json[ 'link' ]        = $this->get_link();
		$this->json[ 'id' ]          = $this->id;
		$this->json[ 'label' ]       = esc_html( $this->label );
		$this->json[ 'description' ] = $this->description;

		$this->json[ 'suffix' ] = $this->suffix;

		$slider_attribute = $this->input_attrs;

		$slider_unit      = isset( $this->value()['unit'] ) ? $this->value()['unit'] : array_keys( $slider_attribute )[0];

		$this->json['input_attrs'] = array_merge(
			$this->input_attrs,
			array(
				'attributes'        => $slider_attribute[ $slider_unit ],
				'attributes_config' => $slider_attribute,
			)
		);

	}

	/**
	 * An Underscore (JS) template for this control's content (but not its container).
	 *
	 * Class variables for this control class are available in the `data` JS object;
	 * export custom variables by overriding {@see WP_Customize_Control::to_json()}.
	 *
	 * @see WP_Customize_Control::print_template()
	 */
	protected function content_template()
	{
		?>
        <div class="slider-label">
            <# if ( data.label ) { #>
            <div class="slider-label-unit-wrapper">
                <div class="customizer-text">
                    <div class="label-switcher-wrapper">
                        <span class="customize-control-label">{{{ data.label }}}</span>
                    </div>
                    <div class="unit-wrapper">
                        <div class="input-wrapper">
                            <select class="slider-unit" name="unit" value="" <# if(_.size(data.suffix) === 1) { #> disabled <# } #>>
                                <# _.each(data.suffix, function( suffix ) {  #>
                                <option value="{{ suffix }}"
                                <# if ( data.value[ 'unit' ] == suffix ) { #> Selected <# } #> >{{suffix}}
                                </option>
                                <# }) #>
                            </select>
                            <div class="colormag-slider-reset">
                                <span class="dashicons dashicons-image-rotate"
                                      title="<?php esc_attr_e( 'Back to default', 'colormag' ); ?>">
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <# } #>

            <div class="wrapper">
                <div class="control slider-wrapper">
                    <span class="colormag-warning" ></span>
                    <div class="range">
                        <input
                               type="range"
                               value="{{ data.value[ 'size' ] }}"
                               data-reset_value="{{ data.default[ 'size' ] }}"
                               data-reset_unit="{{ data.default[ 'unit' ] }}"
                               min="{{{ data.input_attrs.attributes['min'] }}}"
                               max="{{{ data.input_attrs.attributes['max'] }}}"
                               step="{{{ data.input_attrs.attributes['step'] }}}"
                               class="colormag-progress"
                        />
                    </div>
                    <div class="size colormag-range-value">
                        <div class="input-wrapper">
                            <input type="number" data-name="{{ data.name }}"
                                   min="{{{ data.input_attrs.attributes['min'] }}}"
                                   max="{{{ data.input_attrs.attributes['max'] }}}"
                                   step="{{{ data.input_attrs.attributes['step'] }}}"
                            <# if ( data.value['size'] ) { #>
                            value="{{ data.value['size'] }}"
                            <# } else { #>
                            value="{{ data.default['size'] }}"
                            <# } #>
                            />
                        </div>
                    </div>
                </div>

                <input class="slider-hidden-value"
                       value="{{ JSON.stringify( data.value ) }}"
                       type="hidden" {{{ data.link }}}
                >

            </div>
        </div>
		<?php
	}

	/**
	 * Don't render the control content from PHP, as it's rendered via JS on load.
	 */
	public function render_content()
	{
	}

}
