<?php
/**
 * Extend WP_Customize_Control to include typography control.
 *
 * Class ColorMag_Typography_Control
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

	public $suffix = '';

	/**
	 * Languages required subsets.
	 *
	 * @var array
	 */
	public $languages = array();

	/**
	 * Enqueue control related scripts/styles.
	 */
	public function enqueue() {

		parent::enqueue();

		$standard_fonts      = $this->get_system_fonts();
		$google_fonts        = $this->get_google_fonts();
		$custom_fonts        = $this->get_custom_fonts();
		$google_font_subsets = ColorMag_Fonts::get_google_font_subsets();
		$localize_scripts    = array(
			'standardfontslabel' => esc_html__( 'Standard Fonts', 'colormag' ),
			'googlefontslabel'   => esc_html__( 'Google Fonts', 'colormag' ),
			'standard'           => $standard_fonts,
			'google'             => $google_fonts,
		);

		// If custom fonts is available,then add it for localization.
		if ( ! empty( $custom_fonts ) ) {
			$localize_scripts[ 'customfontslabel' ] = esc_html__( 'Custom Fonts', 'colormag' );
			$localize_scripts[ 'custom' ]           = $custom_fonts;
		}

		// Loading available fonts.
		wp_localize_script(
			'colormag-customize-controls',
			'ColorMagCustomizerControlTypography',
			$localize_scripts
		);

		// Loading Google font subsets.
		wp_localize_script(
			'colormag-customize-controls',
			'ColorMagCustomizerControlTypographySubsets',
			$google_font_subsets
		);

	}

	/**
	 * Formats variants.
	 *
	 * @param array $variants The variants.
	 *
	 * @return array
	 */
	protected function format_variants_array( $variants ) {

		$font_variants  = ColorMag_Fonts::get_font_variants();
		$variants_array = array();

		foreach ( $variants as $variant ) {

			if ( is_string( $variant ) ) {
				$variants_array[] = array(
					'id'    => $variant,
					'label' => isset( $font_variants[ $variant ] ) ? $font_variants[ $variant ] : $variant,
				);
			} elseif ( is_array( $variant ) && isset( $variant[ 'id' ] ) && isset( $variant[ 'label' ] ) ) {
				$variants_array[] = $variant;
			}
		}

		return $variants_array;

	}

	/**
	 * Gets standard fonts properly formatted for control.
	 */
	public function get_system_fonts() {

		$standard_fonts       = ColorMag_Fonts::get_system_fonts();
		$standard_fonts_array = array();
		$default_variants     = $this->format_variants_array(
		/**
		 * Filter for default variants.
		 *
		 * @since   1.0.0
		 */
			apply_filters(
				'colormag_default_variants',
				array(
					'regular',
					'italic',
				)
			)
		);

		foreach ( $standard_fonts as $key => $font ) {

			$standard_fonts_array[] = array(
				'family'   => $font[ 'family' ],
				'label'    => $font[ 'label' ],
				'subsets'  => array(),
				'variants' => ( isset( $font[ 'variants' ] ) ) ? $this->format_variants_array( $font[ 'variants' ] ) : $default_variants,
			);

		}

		return $standard_fonts_array;

	}

	/**
	 * Gets Google fonts properly formatted for control.
	 */
	public function get_google_fonts() {

		// Get formatted array of google fonts.
		$google_fonts          = ColorMag_Fonts::get_google_fonts();
		$font_variants         = ColorMag_Fonts::get_font_variants();
		$foogle_fonts__subsets = ColorMag_Fonts::get_google_font_subsets();
		$google_fonts_array    = array();

		foreach ( $google_fonts as $family => $args ) {

			// Get label, variants, subsets of individual font.
			$label    = ( isset( $args[ 'label' ] ) ) ? $args[ 'label' ] : $family;
			$variants = ( isset( $args[ 'variants' ] ) ) ? $args[ 'variants' ] : array( 'regular' );
			$subsets  = ( isset( $args[ 'subsets' ] ) ) ? $args[ 'subsets' ] : array();

			$available_variants = array();
			if ( is_array( $variants ) ) {
				foreach ( $variants as $variant ) {
					if ( array_key_exists( $variant, $font_variants ) ) {
						$available_variants[] = array(
							'id'    => $variant,
							'label' => $font_variants[ $variant ],
						);
					}
				}
			}

			$available_subsets = array();
			if ( is_array( $subsets ) ) {
				foreach ( $subsets as $subset ) {
					if ( array_key_exists( $subset, $foogle_fonts__subsets ) ) {
						$available_subsets[] = array(
							'id'    => $subset,
							'label' => $foogle_fonts__subsets[ $subset ],
						);
					}
				}
			}

			$google_fonts_array[] = array(
				'family'   => $family,
				'label'    => $label,
				'variants' => $available_variants,
				'subsets'  => $available_subsets,
			);

		}

		return $google_fonts_array;

	}

	/**
	 * Gets custom fonts properly formatted for control.
	 */
	public function get_custom_fonts() {

		$custom_fonts       = ColorMag_Fonts::get_custom_fonts();
		$custom_fonts_array = array();
		$default_variants   = $this->format_variants_array(
			array(
				'regular',
				'italic',
			)
		);

		foreach ( $custom_fonts as $key => $font ) {

			$custom_fonts_array[] = array(
				'family'   => $font[ 'family' ],
				'label'    => $font[ 'label' ],
				'subsets'  => array(),
				'variants' => ( isset( $font[ 'variants' ] ) ) ? $this->format_variants_array( $font[ 'variants' ] ) : $default_variants,
			);

		}

		return $custom_fonts_array;

	}

	/**
	 * Refresh the parameters passed to the JavaScript via JSON.
	 *
	 * @see WP_Customize_Control::to_json()
	 */
	public function to_json() {

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
		$this->json[ 'choices' ]     = $this->choices;
		$this->json[ 'languages' ]   = ColorMag_Fonts::get_google_font_subsets();

		$input_attrs = colormag_get_typography_input_attrs( $this->value() );

		$this->json[ 'suffix' ]         = $input_attrs[ 'suffix' ];
		$this->json[ 'default_suffix' ] = $input_attrs[ 'default_suffix' ];

		$this->json[ 'input_attrs' ] = array_merge(
			$this->input_attrs,
			$input_attrs[ 'input_attrs' ]

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
	protected function content_template() {
		?>

		<div class="customizer-text">
			<# if ( data.label ) { #>
			<span class="customize-control-label">{{{data.label }}}</span>
			<# } #>

			<# if ( data.description ) { #>
			<span class="description customize-control-description">{{{data.description }}}</span>
			<# } #>
		</div>

		<div class="customize-control-content">

			<# if ( data.default['font-family'] ) { #>
			<div class="font-family customize-group">
				<span class="customize-control-label"><?php esc_html_e( 'Family', 'colormag' ); ?></span>
				<div class="colormag-field-content">
					<select {{{ data.inputAttrs }}} id="colormag-font-family-{{{ data.id || data.name }}}"></select>
				</div>
			</div>

			<# if ( data.default['font-weight'] ) { #>
			<div class="font-weight customize-group">
				<span class="customize-control-label"><?php esc_html_e( 'Weight', 'colormag' ); ?></span>
				<div class="colormag-field-content">
					<select {{{ data.inputAttrs }}} id="colormag-font-weight-{{{ data.id || data.name }}}"></select>
				</div>
			</div>
			<# } #>

			<# if ( data.default['subsets'] ) { #>
			<div class="subsets customize-group">
				<span class="customize-control-label"><?php esc_html_e( 'Subset(s)', 'colormag' ); ?></span>
				<div class="colormag-field-content">
					<select {{{ data.inputAttrs }}} id="colormag-subsets-{{{ data.id || data.name }}}" multiple>
						<# _.each( data.value.subsets, function( subset ) { #>
						<option value="{{ subset }}" selected="selected">{{ data.languages[subset] }}</option>
						<# } ); #>
					</select>
				</div>
			</div>
			<# } #>

			<# } #>

			<# if ( data.default['font-size'] ) { #>
			<div class="font-size customize-group">
				<div class="desktop control-wrap active">
					<span class="customize-label-wrapper">
					<span class="customizer-label-switcher-wrapper">
						<span class="customize-control-label"><?php esc_html_e( 'Size', 'colormag' ); ?></span>
						<ul class="responsive-switchers">
							<li class="desktop active">
								<button type="button" class="preview-desktop" data-device="desktop">
									<i class="dashicons dashicons-desktop"></i>
								</button>
							</li>
							<li class="tablet">
								<button type="button" class="preview-tablet" data-device="tablet">
									<i class="dashicons dashicons-tablet"></i>
								</button>
							</li>
							<li class="mobile">
								<button type="button" class="preview-mobile" data-device="mobile">
									<i class="dashicons dashicons-smartphone"></i>
								</button>
							</li>
						</ul>
					</span>
					  <div class="unit-wrapper">
						  <div class="input-wrapper">
							  <select class="font-size-unit" data-device="desktop" name="unit">
								  <# _.each(data.suffix['font-size'], function( suffix ) {  #>
								  <option value="{{ suffix }}"
								    <# if(data.value['font-size'] && data.value['font-size']['desktop'] && data.value['font-size']['desktop']['unit']) { #>
											<# if ( data.value['font-size']['desktop']['unit'] == suffix ) { #> Selected <# } #>
											<# } else { #>
												<# if ( data.default_suffix['font-size'] == suffix ) { #> Selected <# } #>
											<# } #>
										>{{suffix}}
								  </option>
								  <# }) #>
							  </select>
							  <div class="colormag-font-size-reset">
									<span class="dashicons dashicons-image-rotate"
									      title="<?php esc_attr_e( 'Back to default', 'colormag' ); ?>">
									</span>
							  </div>
						  </div>
					  </div>
				</span>
					<div class="control slider-wrapper">
						<span class="colormag-warning colormag-font-size-desktop-warning"
						      id="colormag-font-size-desktop-warning"></span>
						<div class="range">
							<input
								type="range"
								class="colormag-progress"
								min="{{{ data.input_attrs.attributes['font-size']['desktop']['min'] }}}"
								max="{{{ data.input_attrs.attributes['font-size']['desktop']['max'] }}}"
								step="{{{ data.input_attrs.attributes['font-size']['desktop']['step'] }}}"
								data-reset_value="{{ data.default['font-size']['desktop']['size'] }}"
								data-reset_unit="{{ data.default['font-size']['desktop']['unit'] }}"

							<# if(data.value['font-size'] && data.value['font-size']['desktop'] &&
							data.value['font-size']['desktop']['size']) { #>
							value="{{ data.value['font-size']['desktop']['size'] }}"
							<# } else { #>
							value="{{ data.default['font-size']['desktop']['size'] }}"
							<# } #>
							/>
						</div>
						<div class="size colormag-range-value">
							<div class="input-wrapper">
								<input type="number" id="colormag-font-size-desktop-{{{ data.id || data.name }}}"
								       data-device="desktop"
								       min="{{{ data.input_attrs.attributes['font-size']['desktop']['min'] }}}"
								       max="{{{ data.input_attrs.attributes['font-size']['desktop']['max'] }}}"
								       step="{{{ data.input_attrs.attributes['font-size']['desktop']['step'] }}}"

								<# if(data.value['font-size'] && data.value['font-size']['desktop'] &&
								data.value['font-size']['desktop']['size']) { #>
								value="{{ data.value['font-size']['desktop']['size'] }}"
								<# } else { #>
								value="{{ data.default['font-size']['desktop']['size'] }}"
								<# } #>

								/>
							</div>
						</div>
					</div>
				</div>

				<div class="tablet control-wrap">
					 <span class="customize-label-wrapper">
					<span class="customizer-label-switcher-wrapper">
						<span class="customize-control-label"><?php esc_html_e( 'Size', 'colormag' ); ?></span>
						<ul class="responsive-switchers">
							<li class="desktop active">
								<button type="button" class="preview-desktop" data-device="desktop">
									<i class="dashicons dashicons-desktop"></i>
								</button>
							</li>
							<li class="tablet">
								<button type="button" class="preview-tablet" data-device="tablet">
									<i class="dashicons dashicons-tablet"></i>
								</button>
							</li>
							<li class="mobile">
								<button type="button" class="preview-mobile" data-device="mobile">
									<i class="dashicons dashicons-smartphone"></i>
								</button>
							</li>
						</ul>
					</span>
					  <div class="unit-wrapper">
							<div class="input-wrapper">
								<select class="font-size-unit" data-device="tablet" name="unit">
									<# _.each(data.suffix['font-size'], function( suffix ) { #>
									 <option value="{{ suffix }}"
										  <# if(data.value['font-size'] && data.value['font-size']['tablet'] && data.value['font-size']['tablet']['unit']) { #>
											<# if ( data.value['font-size']['tablet']['unit'] == suffix ) { #> Selected <# } #>
											<# } else { #>
												<# if ( data.default_suffix['font-size'] == suffix ) { #> Selected <# } #>
											<# } #>
										>{{suffix}}
									</option>
									<# }) #>
								</select>
								<div class="colormag-font-size-reset">
									<span class="dashicons dashicons-image-rotate"
									      title="<?php esc_attr_e( 'Back to default', 'colormag' ); ?>">
									</span>
								</div>
							</div>
						</div>
				</span>
					<div class="control slider-wrapper">
						<span class="colormag-warning colormag-font-size-tablet-warning"
						      id="colormag-font-size-tablet-warning"></span>
						<div class="range">
							<input
								type="range"
								class="colormag-progress"
								min="{{{ data.input_attrs.attributes['font-size']['tablet']['min'] }}}"
								max="{{{ data.input_attrs.attributes['font-size']['tablet']['max'] }}}"
								step="{{{ data.input_attrs.attributes['font-size']['tablet']['step'] }}}"
								data-reset_value="{{ data.default['font-size']['tablet']['size'] }}"
								data-reset_unit="{{ data.default['font-size']['tablet']['unit'] }}"

							<# if(data.value['font-size'] && data.value['font-size']['tablet'] &&
							data.value['font-size']['tablet']['size']) { #>
							value="{{ data.value['font-size']['tablet']['size'] }}"
							<# } else { #>
							value="{{ data.default['font-size']['tablet']['size'] }}"
							<# } #>
							/>
						</div>
						<div class="size colormag-range-value">
							<div class="input-wrapper">
								<input type="number" id="colormag-font-size-tablet-{{{ data.id || data.name }}}"
								       data-device="tablet"
								       min="{{{ data.input_attrs.attributes['font-size']['tablet']['min'] }}}"
								       max="{{{ data.input_attrs.attributes['font-size']['tablet']['max'] }}}"
								       step="{{{ data.input_attrs.attributes['font-size']['tablet']['step'] }}}"

								<# if(data.value['font-size'] && data.value['font-size']['tablet'] &&
								data.value['font-size']['tablet']['size']) { #>
								value="{{ data.value['font-size']['tablet']['size'] }}"
								<# } else { #>
								value="{{ data.default['font-size']['tablet']['size'] }}"
								<# } #>

								/>
							</div>
						</div>
					</div>
				</div>

				<div class="mobile control-wrap">
					 <span class="customize-label-wrapper">
					<span class="customizer-label-switcher-wrapper">
						<span class="customize-control-label"><?php esc_html_e( 'Size', 'colormag' ); ?></span>
						<ul class="responsive-switchers">
							<li class="desktop active">
								<button type="button" class="preview-desktop" data-device="desktop">
									<i class="dashicons dashicons-desktop"></i>
								</button>
							</li>
							<li class="tablet">
								<button type="button" class="preview-tablet" data-device="tablet">
									<i class="dashicons dashicons-tablet"></i>
								</button>
							</li>
							<li class="mobile">
								<button type="button" class="preview-mobile" data-device="mobile">
									<i class="dashicons dashicons-smartphone"></i>
								</button>
							</li>
						</ul>
					</span>
					 <div class="unit-wrapper">
							<div class="input-wrapper">
								<select class="font-size-unit" data-device="mobile" name="unit">
									<# _.each(data.suffix['font-size'], function( suffix ) { #>
									 <option value="{{ suffix }}"
										  <# if(data.value['font-size'] && data.value['font-size']['mobile'] && data.value['font-size']['mobile']['unit']) { #>
											<# if ( data.value['font-size']['mobile']['unit'] == suffix ) { #> Selected <# } #>
											<# } else { #>
												<# if ( data.default_suffix['font-size'] == suffix ) { #> Selected <# } #>
											<# } #>
										>{{suffix}}
									</option>
									<# }) #>
								</select>
								<div class="colormag-font-size-reset">
									<span class="dashicons dashicons-image-rotate"
									      title="<?php esc_attr_e( 'Back to default', 'colormag' ); ?>">
									</span>
								</div>
							</div>
						</div>
				</span>
					<div class="control slider-wrapper">
						<span class="colormag-warning colormag-font-size-mobile-warning"
						      id="colormag-font-size-mobile-warning"></span>
						<div class="range">
							<input
								type="range"
								class="colormag-progress"
								min="{{{ data.input_attrs.attributes['font-size']['mobile']['min'] }}}"
								max="{{{ data.input_attrs.attributes['font-size']['mobile']['max'] }}}"
								step="{{{ data.input_attrs.attributes['font-size']['mobile']['step'] }}}"
								data-reset_value="{{ data.default['font-size']['mobile']['size'] }}"
								data-reset_unit="{{ data.default['font-size']['mobile']['unit'] }}"

							<# if(data.value['font-size'] && data.value['font-size']['mobile'] &&
							data.value['font-size']['mobile']['size']) { #>
							value="{{ data.value['font-size']['mobile']['size'] }}"
							<# } else { #>
							value="{{ data.default['font-size']['mobile']['size'] }}"
							<# } #>

							/>
						</div>
						<div class="size colormag-range-value">
							<div class="input-wrapper">
								<input type="number" id="colormag-font-size-mobile-{{{ data.id || data.name }}}"
								       data-device="mobile"
								       min="{{{ data.input_attrs.attributes['font-size']['mobile']['min'] }}}"
								       max="{{{ data.input_attrs.attributes['font-size']['mobile']['max'] }}}"
								       step="{{{ data.input_attrs.attributes['font-size']['mobile']['step'] }}}"

								<# if(data.value['font-size'] && data.value['font-size']['mobile'] &&
								data.value['font-size']['mobile']['size']) { #>
								value="{{ data.value['font-size']['mobile']['size'] }}"
								<# } else { #>
								value="{{ data.default['font-size']['mobile']['size'] }}"
								<# } #>

								/>
							</div>
						</div>
					</div>
				</div>
			</div>
			<# } #>

			<# if ( data.default['line-height'] ) { #>
			<div class="line-height customize-group">
				<div class="desktop control-wrap active">
					<span class="customize-label-wrapper">
					<span class="customizer-label-switcher-wrapper">
						<span class="customize-control-label"><?php esc_html_e( 'Line Height', 'colormag' ); ?></span>
						<ul class="responsive-switchers">
							<li class="desktop active">
								<button type="button" class="preview-desktop" data-device="desktop">
									<i class="dashicons dashicons-desktop"></i>
								</button>
							</li>
							<li class="tablet">
								<button type="button" class="preview-tablet" data-device="tablet">
									<i class="dashicons dashicons-tablet"></i>
								</button>
							</li>
							<li class="mobile">
								<button type="button" class="preview-mobile" data-device="mobile">
									<i class="dashicons dashicons-smartphone"></i>
								</button>
							</li>
						</ul>
					</span>
					  <div class="unit-wrapper">
						  <div class="input-wrapper">
							  <select class="line-height-unit" data-device="desktop" name="unit">
								  <# _.each(data.suffix['line-height'], function( suffix ) {  #>
								   <option value="{{ suffix }}"
										  <# if(data.value['line-height'] && data.value['line-height']['desktop'] && data.value['line-height']['desktop']['unit']) { #>
											<# if ( data.value['line-height']['desktop']['unit'] == suffix ) { #> Selected <# } #>
											<# } else { #>
												<# if ( data.default_suffix['line-height'] == suffix ) { #> Selected <# } #>
											<# } #>
										>{{suffix}}
								  </option>
								  <# }) #>
							  </select>
							  <div class="colormag-line-height-reset">
									<span class="dashicons dashicons-image-rotate"
									      title="<?php esc_attr_e( 'Back to default', 'colormag' ); ?>">
									</span>
								</div>
						  </div>
					  </div>
				</span>
					<div class="control slider-wrapper">
						<span class="colormag-warning colormag-line-height-desktop-warning"
						      id="colormag-line-height-desktop-warning"></span>
						<div class="range">
							<input
								type="range"
								class="colormag-progress"
								min="{{{ data.input_attrs.attributes['line-height']['desktop']['min'] }}}"
								max="{{{ data.input_attrs.attributes['line-height']['desktop']['max'] }}}"
								step="{{{ data.input_attrs.attributes['line-height']['desktop']['step'] }}}"
								data-reset_value="{{ data.default['line-height']['desktop']['size'] }}"
								data-reset_unit="{{ data.default['line-height']['desktop']['unit'] }}"

							<# if(data.value['line-height'] && data.value['line-height']['desktop'] &&
							data.value['line-height']['desktop']['size']) { #>
							value="{{ data.value['line-height']['desktop']['size'] }}"
							<# } else { #>
							value="{{ data.default['line-height']['desktop']['size'] }}"
							<# } #>
							/>
						</div>
						<div class="size colormag-range-value">
							<div class="input-wrapper">
								<input type="number" id="colormag-line-height-desktop-{{{ data.id || data.name }}}"
								       data-device="desktop"
								       min="{{{ data.input_attrs.attributes['line-height']['desktop']['min'] }}}"
								       max="{{{ data.input_attrs.attributes['line-height']['desktop']['max'] }}}"
								       step="{{{ data.input_attrs.attributes['line-height']['desktop']['step'] }}}"

								<# if(data.value['line-height'] && data.value['line-height']['desktop'] &&
								data.value['line-height']['desktop']['size']) { #>
								value="{{ data.value['line-height']['desktop']['size'] }}"
								<# } else { #>
								value="{{ data.default['line-height']['desktop']['size'] }}"
								<# } #>

								/>
							</div>
						</div>
					</div>
				</div>

				<div class="tablet control-wrap">
					 <span class="customize-label-wrapper">
					<span class="customizer-label-switcher-wrapper">
						<span class="customize-control-label"><?php esc_html_e( 'Line Height', 'colormag' ); ?></span>
						<ul class="responsive-switchers">
							<li class="desktop active">
								<button type="button" class="preview-desktop" data-device="desktop">
									<i class="dashicons dashicons-desktop"></i>
								</button>
							</li>
							<li class="tablet">
								<button type="button" class="preview-tablet" data-device="tablet">
									<i class="dashicons dashicons-tablet"></i>
								</button>
							</li>
							<li class="mobile">
								<button type="button" class="preview-mobile" data-device="mobile">
									<i class="dashicons dashicons-smartphone"></i>
								</button>
							</li>
						</ul>
					</span>
					  <div class="unit-wrapper">
						  <div class="input-wrapper">
							  <select class="line-height-unit" data-device="tablet" name="unit">
								  <# _.each(data.suffix['line-height'], function( suffix ) {  #>
								   <option value="{{ suffix }}"
										   <# if(data.value['line-height'] && data.value['line-height']['tablet'] && data.value['line-height']['tablet']['unit']) { #>
											<# if ( data.value['line-height']['tablet']['unit'] == suffix ) { #> Selected <# } #>
											<# } else { #>
												<# if ( data.default_suffix['line-height'] == suffix ) { #> Selected <# } #>
											<# } #>
										>{{suffix}}
								  </option>
								  <# }) #>
							  </select>
							  <div class="colormag-line-height-reset">
									<span class="dashicons dashicons-image-rotate"
									      title="<?php esc_attr_e( 'Back to default', 'colormag' ); ?>">
									</span>
								</div>
						  </div>
					  </div>
				</span>
					<div class="control slider-wrapper">
						<span class="colormag-warning colormag-line-height-tablet-warning"
						      id="colormag-line-height-tablet-warning"></span>
						<div class="range">
							<input
								type="range"
								class="colormag-progress"
								min="{{{ data.input_attrs.attributes['line-height']['tablet']['min'] }}}"
								max="{{{ data.input_attrs.attributes['line-height']['tablet']['max'] }}}"
								step="{{{ data.input_attrs.attributes['line-height']['tablet']['step'] }}}"
								data-reset_value="{{ data.default['line-height']['tablet']['size'] }}"
								data-reset_unit="{{ data.default['line-height']['tablet']['unit'] }}"

							<# if(data.value['line-height'] && data.value['line-height']['tablet'] &&
							data.value['line-height']['tablet']['size']) { #>
							value="{{ data.value['line-height']['tablet']['size'] }}"
							<# } else { #>
							value="{{ data.default['line-height']['tablet']['size'] }}"
							<# } #>
							/>
						</div>
						<div class="size colormag-range-value">
							<div class="input-wrapper">
								<input type="number" id="colormag-line-height-tablet-{{{ data.id || data.name }}}"
								       data-device="tablet"
								       min="{{{ data.input_attrs.attributes['line-height']['tablet']['min'] }}}"
								       max="{{{ data.input_attrs.attributes['line-height']['tablet']['max'] }}}"
								       step="{{{ data.input_attrs.attributes['line-height']['tablet']['step'] }}}"

								<# if(data.value['line-height'] && data.value['line-height']['tablet'] &&
								data.value['line-height']['tablet']['size']) { #>
								value="{{ data.value['line-height']['tablet']['size'] }}"
								<# } else { #>
								value="{{ data.default['line-height']['tablet']['size'] }}"
								<# } #>

								/>
							</div>
						</div>
					</div>
				</div>

				<div class="mobile control-wrap">
					 <span class="customize-label-wrapper">
					<span class="customizer-label-switcher-wrapper">
						<span class="customize-control-label"><?php esc_html_e( 'Line Height', 'colormag' ); ?></span>
						<ul class="responsive-switchers">
							<li class="desktop active">
								<button type="button" class="preview-desktop" data-device="desktop">
									<i class="dashicons dashicons-desktop"></i>
								</button>
							</li>
							<li class="tablet">
								<button type="button" class="preview-tablet" data-device="tablet">
									<i class="dashicons dashicons-tablet"></i>
								</button>
							</li>
							<li class="mobile">
								<button type="button" class="preview-mobile" data-device="mobile">
									<i class="dashicons dashicons-smartphone"></i>
								</button>
							</li>
						</ul>
					</span>
					  <div class="unit-wrapper">
						  <div class="input-wrapper">
							  <select class="line-height-unit" data-device="mobile" name="unit">
								  <# _.each(data.suffix['line-height'], function( suffix ) {  #>
								   <option value="{{ suffix }}"
										   <# if(data.value['line-height'] && data.value['line-height']['mobile'] && data.value['line-height']['mobile']['unit']) { #>
											<# if ( data.value['line-height']['mobile']['unit'] == suffix ) { #> Selected <# } #>
											<# } else { #>
												<# if ( data.default_suffix['line-height'] == suffix ) { #> Selected <# } #>
											<# } #>
										>{{suffix}}
								  </option>
								  <# }) #>
							  </select>
							  <div class="colormag-line-height-reset">
									<span class="dashicons dashicons-image-rotate"
									      title="<?php esc_attr_e( 'Back to default', 'colormag' ); ?>">
									</span>
								</div>
						  </div>
					  </div>
				</span>
					<div class="control slider-wrapper">
						<span class="colormag-warning colormag-line-height-mobile-warning"
						      id="colormag-line-height-mobile-warning"></span>
						<div class="range">
							<input
								type="range"
								class="colormag-progress"
								min="{{{ data.input_attrs.attributes['line-height']['mobile']['min'] }}}"
								max="{{{ data.input_attrs.attributes['line-height']['mobile']['max'] }}}"
								step="{{{ data.input_attrs.attributes['line-height']['mobile']['step'] }}}"
								data-reset_value="{{ data.default['line-height']['mobile']['size'] }}"
								data-reset_unit="{{ data.default['line-height']['mobile']['unit'] }}"

							<# if(data.value['line-height'] && data.value['line-height']['mobile'] &&
							data.value['line-height']['mobile']['size']) { #>
							value="{{ data.value['line-height']['mobile']['size'] }}"
							<# } else { #>
							value="{{ data.default['line-height']['mobile']['size'] }}"
							<# } #>
							/>
						</div>
						<div class="size colormag-range-value">
							<div class="input-wrapper">
								<input type="number" id="colormag-line-height-mobile-{{{ data.id || data.name }}}"
								       data-device="mobile"
								       min="{{{ data.input_attrs.attributes['line-height']['mobile']['min'] }}}"
								       max="{{{ data.input_attrs.attributes['line-height']['mobile']['max'] }}}"
								       step="{{{ data.input_attrs.attributes['line-height']['mobile']['step'] }}}"

								<# if(data.value['line-height'] && data.value['line-height']['mobile'] &&
								data.value['line-height']['mobile']['size']) { #>
								value="{{ data.value['line-height']['mobile']['size'] }}"
								<# } else { #>
								value="{{ data.default['line-height']['mobile']['size'] }}"
								<# } #>

								/>
							</div>
						</div>
					</div>
				</div>
			</div>
			<# } #>


			<# if ( data.default['letter-spacing'] ) { #>
			<div class="letter-spacing customize-group">
				<div class="desktop control-wrap active">
					<span class="customize-label-wrapper">
					<span class="customizer-label-switcher-wrapper">
						<span
							class="customize-control-label"><?php esc_html_e( 'Letter Spacing', 'colormag' ); ?></span>
						<ul class="responsive-switchers">
							<li class="desktop active">
								<button type="button" class="preview-desktop" data-device="desktop">
									<i class="dashicons dashicons-desktop"></i>
								</button>
							</li>
							<li class="tablet">
								<button type="button" class="preview-tablet" data-device="tablet">
									<i class="dashicons dashicons-tablet"></i>
								</button>
							</li>
							<li class="mobile">
								<button type="button" class="preview-mobile" data-device="mobile">
									<i class="dashicons dashicons-smartphone"></i>
								</button>
							</li>
						</ul>
					</span>
					  <div class="unit-wrapper">
						  <div class="input-wrapper">
							  <select class="letter-spacing-unit" data-device="desktop" name="unit">

								  <# _.each(data.suffix['letter-spacing'], function( suffix ) {  #>
								   <option value="{{ suffix }}"
										   <# if(data.value['letter-spacing'] && data.value['letter-spacing']['desktop'] && data.value['letter-spacing']['desktop']['unit']) { #>
											<# if ( data.value['letter-spacing']['desktop']['unit'] == suffix ) { #> Selected <# } #>
											<# } else { #>
												<# if ( data.default_suffix['letter-spacing'] == suffix ) { #> Selected <# } #>
											<# } #>
										>{{suffix}}
								  </option>
								  <# }) #>
							  </select>
							  <div class="colormag-letter-spacing-reset">
									<span class="dashicons dashicons-image-rotate"
									      title="<?php esc_attr_e( 'Back to default', 'colormag' ); ?>">
									</span>
								</div>
						  </div>
					  </div>
				</span>
					<div class="control slider-wrapper">
						<span class="colormag-warning colormag-letter-spacing-desktop-warning"
						      id="colormag-letter-spacing-desktop-warning"></span>
						<div class="range">
							<input
								type="range"
								class="colormag-progress"
								min="{{{ data.input_attrs.attributes['letter-spacing']['desktop']['min'] }}}"
								max="{{{ data.input_attrs.attributes['letter-spacing']['desktop']['max'] }}}"
								step="{{{ data.input_attrs.attributes['letter-spacing']['desktop']['step'] }}}"
								data-reset_value="{{ data.default['letter-spacing']['desktop']['size'] }}"
								data-reset_unit="{{ data.default['letter-spacing']['desktop']['unit'] }}"

							<# if(data.value['letter-spacing'] && data.value['letter-spacing']['desktop'] &&
							data.value['letter-spacing']['desktop']['size']) { #>
							value="{{ data.value['letter-spacing']['desktop']['size'] }}"
							<# } else { #>
							value="{{ data.default['letter-spacing']['desktop']['size'] }}"
							<# } #>
							/>
						</div>
						<div class="size colormag-range-value">
							<div class="input-wrapper">
								<input type="number" id="colormag-letter-spacing-desktop-{{{ data.id || data.name }}}"
								       data-device="desktop"
								       min="{{{ data.input_attrs.attributes['letter-spacing']['desktop']['min'] }}}"
								       max="{{{ data.input_attrs.attributes['letter-spacing']['desktop']['max'] }}}"
								       step="{{{ data.input_attrs.attributes['letter-spacing']['desktop']['step'] }}}"

								<# if(data.value['letter-spacing'] && data.value['letter-spacing']['desktop'] &&
								data.value['letter-spacing']['desktop']['size']) { #>
								value="{{ data.value['letter-spacing']['desktop']['size'] }}"
								<# } else { #>
								value="{{ data.default['letter-spacing']['desktop']['size'] }}"
								<# } #>

								/>
							</div>
						</div>
					</div>
				</div>

				<div class="tablet control-wrap">
					<span class="customize-label-wrapper">
					<span class="customizer-label-switcher-wrapper">
						<span
							class="customize-control-label"><?php esc_html_e( 'Letter Spacing', 'colormag' ); ?></span>
						<ul class="responsive-switchers">
							<li class="desktop active">
								<button type="button" class="preview-desktop" data-device="desktop">
									<i class="dashicons dashicons-desktop"></i>
								</button>
							</li>
							<li class="tablet">
								<button type="button" class="preview-tablet" data-device="tablet">
									<i class="dashicons dashicons-tablet"></i>
								</button>
							</li>
							<li class="mobile">
								<button type="button" class="preview-mobile" data-device="mobile">
									<i class="dashicons dashicons-smartphone"></i>
								</button>
							</li>
						</ul>
					</span>
					  <div class="unit-wrapper">
						  <div class="input-wrapper">
							  <select class="letter-spacing-unit" data-device="tablet" name="unit">
								  <# _.each(data.suffix['letter-spacing'], function( suffix ) {  #>
								   <option value="{{ suffix }}"
								  <# if(data.value['letter-spacing'] && data.value['letter-spacing']['tablet'] && data.value['letter-spacing']['tablet']['unit']) { #>
											<# if ( data.value['letter-spacing']['tablet']['unit'] == suffix ) { #> Selected <# } #>
											<# } else { #>
												<# if ( data.default_suffix['letter-spacing'] == suffix ) { #> Selected <# } #>
											<# } #>
										>{{suffix}}
								  </option>
								  <# }) #>
							  </select>
							  <div class="colormag-letter-spacing-reset">
									<span class="dashicons dashicons-image-rotate"
									      title="<?php esc_attr_e( 'Back to default', 'colormag' ); ?>">
									</span>
								</div>
						  </div>
					  </div>
				</span>
					<div class="control slider-wrapper">
						<span class="colormag-warning colormag-letter-spacing-tablet-warning"
						      id="colormag-letter-spacing-tablet-warning"></span>
						<div class="range">
							<input
								type="range"
								class="colormag-progress"
								min="{{{ data.input_attrs.attributes['letter-spacing']['tablet']['min'] }}}"
								max="{{{ data.input_attrs.attributes['letter-spacing']['tablet']['max'] }}}"
								step="{{{ data.input_attrs.attributes['letter-spacing']['tablet']['step'] }}}"
								data-reset_value="{{ data.default['letter-spacing']['tablet']['size'] }}"
								data-reset_unit="{{ data.default['letter-spacing']['tablet']['unit'] }}"

							<# if(data.value['letter-spacing'] && data.value['letter-spacing']['tablet'] &&
							data.value['letter-spacing']['tablet']['size']) { #>
							value="{{ data.value['letter-spacing']['tablet']['size'] }}"
							<# } else { #>
							value="{{ data.default['letter-spacing']['tablet']['size'] }}"
							<# } #>
							/>
						</div>
						<div class="size colormag-range-value">
							<div class="input-wrapper">
								<input type="number" id="colormag-letter-spacing-tablet-{{{ data.id || data.name }}}"
								       data-device="tablet"
								       min="{{{ data.input_attrs.attributes['letter-spacing']['tablet']['min'] }}}"
								       max="{{{ data.input_attrs.attributes['letter-spacing']['tablet']['max'] }}}"
								       step="{{{ data.input_attrs.attributes['letter-spacing']['tablet']['step'] }}}"

								<# if(data.value['letter-spacing'] && data.value['letter-spacing']['tablet'] &&
								data.value['letter-spacing']['tablet']['size']) { #>
								value="{{ data.value['letter-spacing']['tablet']['size'] }}"
								<# } else { #>
								value="{{ data.default['letter-spacing']['tablet']['size'] }}"
								<# } #>

								/>
							</div>
						</div>
					</div>
				</div>

				<div class="mobile control-wrap">
					<span class="customize-label-wrapper">
					<span class="customizer-label-switcher-wrapper">
						<span
							class="customize-control-label"><?php esc_html_e( 'Letter Spacing', 'colormag' ); ?></span>
						<ul class="responsive-switchers">
							<li class="desktop active">
								<button type="button" class="preview-desktop" data-device="desktop">
									<i class="dashicons dashicons-desktop"></i>
								</button>
							</li>
							<li class="tablet">
								<button type="button" class="preview-tablet" data-device="tablet">
									<i class="dashicons dashicons-tablet"></i>
								</button>
							</li>
							<li class="mobile">
								<button type="button" class="preview-mobile" data-device="mobile">
									<i class="dashicons dashicons-smartphone"></i>
								</button>
							</li>
						</ul>
					</span>
					  <div class="unit-wrapper">
						  <div class="input-wrapper">
							  <select class="letter-spacing-unit" data-device="mobile" name="unit">
								  <# _.each(data.suffix['letter-spacing'], function( suffix ) {  #>
								   <option value="{{ suffix }}"
										  <# if(data.value['letter-spacing'] && data.value['letter-spacing']['mobile'] && data.value['letter-spacing']['mobile']['unit']) { #>
											<# if ( data.value['letter-spacing']['mobile']['unit'] == suffix ) { #> Selected <# } #>
											<# } else { #>
												<# if ( data.default_suffix['letter-spacing'] == suffix ) { #> Selected <# } #>
											<# } #>
										>{{suffix}}
								  </option>
								  <# }) #>
							  </select>
							  <div class="colormag-letter-spacing-reset">
									<span class="dashicons dashicons-image-rotate"
									      title="<?php esc_attr_e( 'Back to default', 'colormag' ); ?>">
									</span>
								</div>
						  </div>
					  </div>
				</span>
					<div class="control slider-wrapper">
						<span class="colormag-warning colormag-letter-spacing-mobile-warning"
						      id="colormag-letter-spacing-mobile-warning"></span>
						<div class="range">
							<input
								type="range"
								data-reset_value="{{ data.default['letter-spacing']['mobile']['size'] }}"
								class="colormag-progress"
								min="{{{ data.input_attrs.attributes['letter-spacing']['mobile']['min'] }}}"
								max="{{{ data.input_attrs.attributes['letter-spacing']['mobile']['max'] }}}"
								step="{{{ data.input_attrs.attributes['letter-spacing']['mobile']['step'] }}}"
								data-reset_value="{{ data.default['letter-spacing']['mobile']['size'] }}"
								data-reset_unit="{{ data.default['letter-spacing']['mobile']['unit'] }}"

							<# if(data.value['letter-spacing'] && data.value['letter-spacing']['mobile'] &&
							data.value['letter-spacing']['mobile']['size']) { #>
							value="{{ data.value['letter-spacing']['mobile']['size'] }}"
							<# } else { #>
							value="{{ data.default['letter-spacing']['mobile']['size'] }}"
							<# } #>
							/>
						</div>
						<div class="size colormag-range-value">
							<div class="input-wrapper">
								<input type="number" id="colormag-letter-spacing-mobile-{{{ data.id || data.name }}}"
								       data-device="mobile"
								       min="{{{ data.input_attrs.attributes['letter-spacing']['mobile']['min'] }}}"
								       max="{{{ data.input_attrs.attributes['letter-spacing']['mobile']['max'] }}}"
								       step="{{{ data.input_attrs.attributes['letter-spacing']['mobile']['step'] }}}"

								<# if(data.value['letter-spacing'] && data.value['letter-spacing']['mobile'] &&
								data.value['letter-spacing']['mobile']['size']) { #>
								value="{{ data.value['letter-spacing']['mobile']['size'] }}"
								<# } else { #>
								value="{{ data.default['letter-spacing']['mobile']['size'] }}"
								<# } #>

								/>
							</div>
						</div>
					</div>
				</div>
			</div>
			<# } #>

			<# if ( data.default['font-style'] ) { #>
			<div class="font-style customize-group">
				<span class="customize-control-label"><?php esc_html_e( 'Style', 'colormag' ); ?></span>
				<div class="colormag-field-content">
					<select {{{ data.inputAttrs }}} id="colormag-font-style-{{{ data.id || data.name }}}">
						<option value="normal"
						<# if ( 'normal' === data.value['font-style'] ) { #> selected <# }
						#>><?php esc_html_e( 'Normal', 'colormag' ); ?></option>
						<option value="italic"
						<# if ( 'italic' === data.value['font-style'] ) { #> selected <# }
						#>><?php esc_html_e( 'Italic', 'colormag' ); ?></option>
						<option value="oblique"
						<# if ( 'oblique' === data.value['font-style'] ) { #> selected <# }
						#>><?php esc_html_e( 'Oblique', 'colormag' ); ?></option>
						<option value="initial"
						<# if ( 'initial' === data.value['font-style'] ) { #> selected <# }
						#>><?php esc_html_e( 'Initial', 'colormag' ); ?></option>
						<option value="inherit"
						<# if ( 'inherit' === data.value['font-style'] ) { #> selected <# }
						#>><?php esc_html_e( 'Inherit', 'colormag' ); ?></option>
					</select>
				</div>
			</div>
			<# } #>

			<# if ( data.default['text-transform'] ) { #>
			<div class="text-transform customize-group">
				<span class="customize-control-label"><?php esc_html_e( 'Transform', 'colormag' ); ?></span>
				<div class="colormag-field-content">
					<select {{{ data.inputAttrs }}} id="colormag-text-transform-{{{ data.id || data.name }}}">
						<option value="none"
						<# if ( 'none' === data.value['text-transform'] ) { #> selected <# }
						#>><?php esc_html_e( 'None', 'colormag' ); ?></option>
						<option value="capitalize"
						<# if ( 'capitalize' === data.value['text-transform'] ) { #> selected <# }
						#>><?php esc_html_e( 'Capitalize', 'colormag' ); ?></option>
						<option value="uppercase"
						<# if ( 'uppercase' === data.value['text-transform'] ) { #> selected <# }
						#>><?php esc_html_e( 'Uppercase', 'colormag' ); ?></option>
						<option value="lowercase"
						<# if ( 'lowercase' === data.value['text-transform'] ) { #> selected <# }
						#>><?php esc_html_e( 'Lowercase', 'colormag' ); ?></option>
						<option value="initial"
						<# if ( 'initial' === data.value['text-transform'] ) { #> selected <# }
						#>><?php esc_html_e( 'Initial', 'colormag' ); ?></option>
						<option value="inherit"
						<# if ( 'inherit' === data.value['text-transform'] ) { #> selected <# }
						#>><?php esc_html_e( 'Inherit', 'colormag' ); ?></option>
					</select>
				</div>
			</div>
			<# } #>

			<# if ( data.default['text-decoration'] ) { #>
			<div class="text-decoration customize-group">
				<span class="customize-control-label"><?php esc_html_e( 'Decoration', 'colormag' ); ?></span>
				<div class="colormag-field-content">
					<select {{{ data.inputAttrs }}} id="colormag-text-decoration-{{{ data.id || data.name }}}">
						<option value="none"
						<# if ( 'none' === data.value['text-decoration'] ) { #> selected <# }
						#>><?php esc_html_e( 'None', 'colormag' ); ?></option>
						<option value="underline"
						<# if ( 'underline' === data.value['text-decoration'] ) { #> selected <# }
						#>><?php esc_html_e( 'Underline', 'colormag' ); ?></option>
						<option value="overline"
						<# if ( 'overline' === data.value['text-decoration'] ) { #> selected <# }
						#>><?php esc_html_e( 'Overline', 'colormag' ); ?></option>
						<option value="line-through"
						<# if ( 'line-through' === data.value['text-decoration'] ) { #> selected <# }
						#>><?php esc_html_e( 'Line Through', 'colormag' ); ?></option>
						<option value="initial"
						<# if ( 'initial' === data.value['text-decoration'] ) { #> selected <# }
						#>><?php esc_html_e( 'Initial', 'colormag' ); ?></option>
						<option value="inherit"
						<# if ( 'inherit' === data.value['text-decoration'] ) { #> selected <# }
						#>><?php esc_html_e( 'Inherit', 'colormag' ); ?></option>
					</select>
				</div>
			</div>
			<# } #>

			<input class="typography-hidden-value"
			       value="{{ JSON.stringify( data.value ) }}"
			       type="hidden" {{{ data.link }}}
			>

		</div>

		<?php
	}

	/**
	 * Renders the control wrapper and calls $this->render_content() for the internals.
	 */
	protected function render() {

		$id    = 'customize-control-' . str_replace( array( '[', ']' ), array( '-', '' ), $this->id );
		$class = 'customize-control has-responsive-switchers customize-control-' . $this->type;
		?>

		<li id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $class ); ?>">
			<?php $this->render_content(); ?>
		</li>

		<?php
	}

	/**
	 * Don't render the control content from PHP, as it's rendered via JS on load.
	 */
	public function render_content() {
	}

}
