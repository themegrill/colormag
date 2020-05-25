<?php
/**
 * Header top options.
 *
 * @package colormag
 */

defined( 'ABSPATH' ) || exit;

/**
 * Class ColorMag_Customize_Base_Option
 */
class ColorMag_Customize_Base_Option {

	/**
	 * Array to create customizer options.
	 *
	 * @var array
	 */
	protected $elements = array();

	/**
	 * Active callback array provided in $elements array.
	 *
	 * @var array
	 */
	protected $active_callback_old = array();

	/**
	 * Record the count of array provided for active callback.
	 *
	 * @var int
	 */
	protected $ac_arr_count = 0;

	/**
	 * Record the count of evaluate() method called.
	 *
	 * @var int
	 */
	private $count_evaluate = 0;

	/**
	 * Setting's default values.
	 *
	 * @var array
	 */
	protected $ac_default = array();

	/**
	 * ColorMag_Customize_Base_Option constructor.
	 */
	public function __construct() {

		// Register customizer options.
		add_action( 'customize_register', array( $this, 'colormag_customizer_options' ) );
		// Generate styles from customizer inputs.
		add_action( 'wp_enqueue_scripts', array( $this, 'colormag_enqueue_style' ) );
		// Get array of elements for particular class.
		$this->elements = $this->elements();

	}

	/**
	 * Provides an array of Menu slug => name for dropdown.
	 *
	 * @return array
	 */
	protected function get_menu_options() {

		$all_menus            = get_terms(
			array(
				'taxonomy'   => 'nav_menu',
				'hide_empty' => true,
			)
		);
		$menu_options         = array();
		$menu_options['none'] = esc_html__( 'None', 'colormag' );

		foreach ( $all_menus as $menu_item ) {
			$menu_options[ $menu_item->slug ] = esc_html( $menu_item->name );
		}

		return $menu_options;

	}

	/**
	 * Register customizer option.
	 *
	 * @param WP_Customize_Manager $wp_customize Manager instance.
	 */
	public function colormag_customizer_options( $wp_customize ) {

		// Loop through array elements.
		foreach ( $this->elements as $el_key => $el_data ) :

			/**
			 * Setting.
			 */
			$setting_args      = $el_data['setting'] ? $el_data['setting'] : array();
			$default           = isset( $setting_args['default'] ) ? $setting_args['default'] : '';
			$option_type       = isset( $el_data['setting']['type'] ) ? $el_data['setting']['type'] : 'theme_mod';
			$sanitize_callback = isset( $setting_args['sanitize_callback'] ) ? $setting_args['sanitize_callback'] : '';

			$wp_customize->add_setting(
				$el_key,
				array(
					'default'           => $default,
					'type'              => $option_type,
					'capability'        => 'edit_theme_options',
					'sanitize_callback' => $sanitize_callback,
				)
			);

			/**
			 * Control.
			 */
			$control_args = $el_data['control'];
			$control_type = $control_args['type'];
			// Is custom control?
			$is_custom_control       = ( isset( $control_args['is_default_type'] ) && true === $control_args['is_default_type'] ) ? $control_args['is_default_type'] : 0;
			$control_args['setting'] = $el_key;

			// If array provided for active callback modify it to function reference.
			if ( isset( $control_args['active_callback'] ) && is_array( $control_args['active_callback'] ) && count( $control_args['active_callback'] ) ) {
				$this->active_callback_old[] = $control_args['active_callback'];
				$cb_setting_id               = $this->active_callback_old[ $this->ac_arr_count ][0]['setting'];
				$this->ac_default[]          = isset( $wp_customize->get_setting( $cb_setting_id )->default ) ?
					$wp_customize->get_setting( $cb_setting_id )->default : '';

				$control_args['active_callback'] = array( $this, 'evaluate' );
				$this->ac_arr_count++;
			}

			// If custom control, unset type and use object, else...
			if ( ! $is_custom_control ) {
				unset( $control_args['type'] );
				$control_type_uc = implode( '_', array_map( 'ucfirst', explode( '_', $control_type ) ) );
				$control_type    = 'ColorMag_Customize_' . $control_type_uc . '_Control';
				if ( class_exists( $control_type ) ) {
					$wp_customize->add_control( new $control_type( $wp_customize, $el_key, $control_args ) );
				}
			} else {
				$wp_customize->add_control( $el_key, $control_args );
			}

		endforeach;

	}

	/**
	 * Evaluates the active callback array.
	 *
	 * @return bool
	 */
	public function evaluate() {
		foreach ( $this->active_callback_old[ ( $this->count_evaluate ) ] as $count => $ruleset ) :

			$ac_setting_id = $ruleset['setting'];
			$operator      = $ruleset['operator'];

			$option_val = get_theme_mod( $ac_setting_id, 'text_html' );

			$check_val = $ruleset['value'];

			switch ( $operator ) {
				case '===':
					$show[] = ( $option_val === $check_val ) ? true : false;
					break;
				case '==':
					$show[] = ( $option_val == $check_val ) ? true : false;
					break;

				case '!==':
					$show[] = ( $option_val !== $check_val ) ? true : false;
					break;

				case '!=':
					$show[] = ( $option_val != $check_val ) ? true : false;
					break;

				default:
					$show[] = ( $option_val == $check_val ) ? true : false;
					break;
			}

		endforeach;

		// Evaluate final result.
		if ( isset( $show ) ) {
			$this->count_evaluate++;
			foreach ( $show as $result ) {
				if ( ! $result ) {
					return false;
				}
			}
		}

		return true;

	}

	/**
	 * Generate style to enqueue.
	 *
	 * @return string
	 */
	public function generate_style( $output_data = 'output' ) {

		$css             = '';
		$required_output = $output_data;

		foreach ( $this->elements as $el_key => $el_data ) :

			if ( isset( $el_data[ $required_output ] ) ) {
				$output = $el_data[ $required_output ];

				foreach ( $output as $output_key => $output_val ) :

					$selector    = isset( $output_val['selector'] ) ? $output_val['selector'] : '';
					$property    = isset( $output_val['property'] ) ? $output_val['property'] : '';
					$media_query = isset( $output_val['media_query'] ) ? $output_val['media_query'] : '';
					$default     = isset( $el_data['setting']['default'] ) ? $el_data['setting']['default'] : '';
					$el_val      = get_theme_mod( $el_key, $default );

					$type = $el_data['control']['type'];

					if ( 'slider' === $type ) {
						if ( isset( $el_val['slider'] ) && $default['slider'] == $el_val['slider'] ) {
							continue;
						}
					}
					if ( $el_val === $default ) {
						continue;
					}
					if ( is_array( $el_val ) ) {
						$css .= ! empty( $media_query ) ? $media_query . ' {' : '';
						$css .= $selector . '{';

						if ( 'slider' === $type ) {
							$css .= $property . ': ' . implode( array_values( $el_val ) ) . ';';
						} elseif ( 'dimensions' === $type ) {
							$css .= $property . ': ' . implode( ' ', array_values( $el_val ) ) . ';';
						} else {
							// Unset those which are not CSS properties.
							if ( ( 'typography' === $type ) ) {
								unset( $el_val['subsets'] );
								unset( $el_val['variant'] );
							}
							foreach ( $el_val as $prop => $val ) {
								if ( wp_http_validate_url( $val ) ) {
									$css .= $prop . ': url("' . esc_url( $val ) . '");';
								} else {
									$css .= $prop . ': ' . $val . ';';
								}
							}
						}
						$css .= ! empty( $media_query ) ? '}' : '';

						$css .= '}';
					} else {
						$css .= ! empty( $media_query ) ? $media_query . ' {' : '';
						$css .= $selector . '{' . $property . ': ' . $el_val . ';}';
						$css .= ! empty( $media_query ) ? '}' : '';
					}
				endforeach;

			}

		endforeach;

		return $css;

	}

	/**
	 * Enqueue generated styles.
	 */
	public function colormag_enqueue_style() {

		$output = $this->generate_style();

		wp_add_inline_style( 'colormag-style', $output );
	}

}
