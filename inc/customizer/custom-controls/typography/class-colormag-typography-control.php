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
class ColorMag_Typography_Control extends WP_Customize_Control {

	/**
	 * Control's Type.
	 *
	 * @var string
	 */
	public $type = 'colormag-typography';

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

		<div class="customizer-text">
			<# if ( data.label ) { #>
			<span class="customize-control-title">{{{ data.label }}}</span>
			<# } #>

			<# if ( data.description ) { #>
			<span class="description customize-control-description">{{{ data.description }}}</span>
			<# } #>
		</div>

		<?php
	}

	/**
	 * Render the control's content.
	 */
	public function render_content() {
		$this_value = $this->value();
		?>

		<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>

		<select class="colormag-typography-select" <?php $this->link(); ?>>

			<?php
			// Get Standard font options
			if ( $std_fonts = colormag_standard_fonts_array() ) { ?>
				<optgroup label="<?php esc_html_e( 'Standard Fonts', 'colormag' ); ?>">
					<?php
					// Loop through font options and add to select
					foreach ( $std_fonts as $font => $value ) { ?>
						<option
							value="<?php echo esc_html( $font ); ?>" <?php selected( $font, $this_value ); ?>><?php echo esc_html( $value ); ?></option>
					<?php } ?>
				</optgroup>
			<?php }
			?>

			<?php
			// Google font options
			if ( $google_fonts = colormag_google_fonts_array() ) { ?>
				<optgroup label="<?php esc_html_e( 'Google Fonts', 'colormag' ); ?>">
					<?php
					// Loop through font options and add to select
					foreach ( $google_fonts as $font ) { ?>
						<option
							value="<?php echo esc_html( $font ); ?>" <?php selected( $font, $this_value ); ?>><?php echo esc_html( $font ); ?></option>
					<?php } ?>
				</optgroup>
			<?php } ?>

		</select>

		<?php
	}
}
