<?php
/**
 * Extend WP_Customize_Control to add the radio image.
 *
 * Class ColorMag_Radio_Image_Control
 *
 * @since 1.3.6
 */

/**
 * Class to extend WP_Customize_Control to add the radio image customize control.
 *
 * Class ColorMag_Radio_Image_Control
 */
class ColorMag_Radio_Image_Control extends WP_Customize_Control {

	/**
	 * Control's Type.
	 *
	 * @var string
	 */
	public $type = 'colormag-radio-image';

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
		$this->json['id']      = $this->id;

		foreach ( $this->choices as $key => $value ) {
			$this->json['choices'][ $key ]        = $value['url'];
			$this->json['choices_titles'][ $key ] = $value['label'];
		}

		$this->json['inputAttrs'] = '';
		$this->json['labelStyle'] = '';
		foreach ( $this->input_attrs as $attr => $value ) {
			if ( 'style' !== $attr ) {
				$this->json['inputAttrs'] .= $attr . '="' . esc_attr( $value ) . '" ';
			} else {
				$this->json['labelStyle'] = 'style="' . esc_attr( $value ) . '" ';
			}
		}

	}

	/**
	 * An Underscore (JS) template for this control's content (but not its container).
	 *
	 * Class variables for this control class are available in the `data` JS object;
	 * export custom variables by overriding {@see WP_Customize_Control::to_json()}.
	 *
	 * @see WP_Customize_Control::print_template()
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

		<div id="input_{{ data.id }}" class="image">
			<# for ( key in data.choices ) { #>
			<input {{{ data.inputAttrs }}}
			       class="image-select"
			       type="radio"
			       value="{{ key }}"
			       name="_customize-radio-{{ data.id }}"
			       id="{{ data.id }}{{ key }}"
			       {{{ data.link }}}
			<# if ( data.value === key ) { #> checked="checked"<# } #>
			>

			<label for="{{ data.id }}{{ key }}" {{{ data.labelStyle }}} class="colormag-radio-image">
				<img src="{{{ data.choices[ key ] }}}" alt="{{{ data.choices_titles[ key ] }}}">
				<span class="image-clickable" title="{{ data.choices_titles[ key ] }}"></span>
			</label>
			<# } #>
		</div>

		<?php
	}

	public function render_content() {

		if ( empty( $this->choices ) ) {
			return;
		}

		$name = '_customize-radio-' . $this->id;
		?>
		<style>
			#colormag-img-container .colormag-radio-img-img {
				border: 3px solid #DEDEDE;
				margin: 0 5px 5px 0;
				cursor: pointer;
				border-radius: 3px;
				-moz-border-radius: 3px;
				-webkit-border-radius: 3px;
			}

			#colormag-img-container .colormag-radio-img-selected {
				border: 3px solid #AAA;
				border-radius: 3px;
				-moz-border-radius: 3px;
				-webkit-border-radius: 3px;
			}

			input[type=checkbox]:before {
				content: '';
				margin: -3px 0 0 -4px;
			}
		</style>
		<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
		<ul class="controls" id='colormag-img-container'>
			<?php
			foreach ( $this->choices as $value => $label ) :
				$class = ( $this->value() == $value ) ? 'colormag-radio-img-selected colormag-radio-img-img' : 'colormag-radio-img-img';
				?>
				<li style="display: inline;">
					<label style="margin-left: 0">
						<input <?php $this->link(); ?>style='display:none' type="radio" value="<?php echo esc_attr( $value ); ?>" name="<?php echo esc_attr( $name ); ?>" <?php
						$this->link();
						checked( $this->value(), $value );
						?> />
						<img src='<?php echo esc_html( $label ); ?>' class='<?php echo $class; ?>' />
					</label>
				</li>
			<?php
			endforeach;
			?>
		</ul>
		<script type="text/javascript">

			jQuery( document ).ready( function ( $ ) {
				$( '.controls#colormag-img-container li img' ).click( function () {
					$( '.controls#colormag-img-container li' ).each( function () {
						$( this ).find( 'img' ).removeClass( 'colormag-radio-img-selected' );
					} );
					$( this ).addClass( 'colormag-radio-img-selected' );
				} );
			} );

		</script>
		<?php
	}

}
