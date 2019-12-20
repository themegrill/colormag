<?php
/**
 * ColorMag customizer base control class for theme customize options.
 *
 * Class ColorMag_Customize_Base_Option
 *
 * @package    ThemeGrill
 * @subpackage ColorMag
 * @since      ColorMag 2.0.0
 */

/**
 * ColorMag customizer base control class.
 *
 * Class ColorMag_Customize_Base_Control
 */
class ColorMag_Customize_Base_Control {

	/**
	 * Registered Controls.
	 *
	 * @var array
	 */
	public static $controls;

	/**
	 * Customizer base control constructor.
	 *
	 * ColorMag_Customize_Base_Control constructor.
	 */
	public function __construct() {

		// Enqueue the required scripts for the custom customize controls.
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue_customize_controls' ) );

	}

	/**
	 * Enqueue custom scripts for customize controls.
	 */
	public function enqueue_customize_controls() {

		$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

		/**
		 * Enqueue required Customize Controls CSS files.
		 */
		// Main CSS file.
		wp_enqueue_style(
			'colormag-customize-controls',
			COLORMAG_CUSTOMIZER_URL . '/custom-controls/assets/css/customize-controls' . $suffix . '.css',
			array(),
			COLORMAG_THEME_VERSION
		);

		/**
		 * Enqueue required Customize Controls JS files.
		 */
		// WP Color Picker Alpha JS library file.
		wp_enqueue_script(
			'wp-color-picker-alpha',
			COLORMAG_CUSTOMIZER_URL . '/custom-controls/assets/js/wp-color-picker-alpha' . $suffix . '.js',
			array(
				'wp-color-picker',
			),
			COLORMAG_THEME_VERSION,
			true
		);

		// Main JS file.
		wp_enqueue_script(
			'colormag-customize-controls',
			COLORMAG_CUSTOMIZER_URL . '/custom-controls/assets/js/customize-controls' . $suffix . '.js',
			array(
				'jquery',
			),
			COLORMAG_THEME_VERSION,
			true
		);

	}

	/**
	 * Add Control to self::$controls and register custom controls to WordPress Customizer.
	 *
	 * @param string $name       Slug for the control.
	 * @param array  $attributes Control Attributes.
	 *
	 * @return void
	 */
	public static function add_control( $name, $attributes ) {

		global $wp_customize;
		self::$controls[ $name ] = $attributes;

		if ( isset( $attributes['callback'] ) ) {
			$wp_customize->register_control_type( $attributes['callback'] );
		}

	}

	/**
	 * Returns control instance.
	 *
	 * @param string $control_type Control type.
	 *
	 * @return string
	 */
	public static function get_control_instance( $control_type ) {

		$control_class = self::get_control( $control_type );

		if ( isset( $control_class['callback'] ) ) {
			return class_exists( $control_class['callback'] ) ? $control_class['callback'] : false;
		}

		return false;

	}

	/**
	 * Returns control and its attributes.
	 *
	 * @param string $control_type Control type.
	 *
	 * @return array
	 */
	public static function get_control( $control_type ) {

		if ( isset( self::$controls[ $control_type ] ) ) {
			return self::$controls[ $control_type ];
		}

		return array();

	}

	/**
	 * Returns santize callback for control.
	 *
	 * @param string $control Control type for customize option.
	 *
	 * @return string
	 */
	public static function get_sanitize_callback( $control ) {

		if ( isset( self::$controls[ $control ]['sanitize_callback'] ) ) {
			return self::$controls[ $control ]['sanitize_callback'];
		}

		return false;

	}

}

return new ColorMag_Customize_Base_Control();
