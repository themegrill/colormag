<?php
/**
 * ColorMag customizer class for theme customize options.
 *
 * Class ColorMag_Customizer
 *
 * @package    ThemeGrill
 * @subpackage ColorMag
 * @since      ColorMag 2.0.0
 */

/**
 * ColorMag customizer class.
 *
 * Class ColorMag_Customizer
 */
class ColorMag_Customizer {

	/**
	 * Customizer setup constructor.
	 *
	 * ColorMag_Customizer constructor.
	 */
	public function __construct() {

		// Include the custom extending customize panels and sections files for customize options.
		add_action( 'customize_register', array( $this, 'customize_custom_panels_sections_includes' ) );

		// Include the custom controls for customize options.
		add_action( 'customize_register', array( $this, 'customize_custom_controls_includes' ) );

		// Register ColorMag customize panels, sections and controls type.
		add_action( 'customize_register', array( $this, 'register_panels_sections_controls' ) );

		// Include the required files for Customize option.
		add_action( 'customize_register', array( $this, 'customize_options_file_include' ) );

		// Include the required customize options.
		add_action( 'customize_register', array( $this, 'get_customizer_configurations' ) );

		// Include the required register customize settings array.
		add_action( 'customize_register', array( $this, 'register_customize_settings' ) );

		// Include the required customizer sanitizations, callbacks and partials files.
		add_action( 'customize_register', array( $this, 'customize_sanitize_callback_include' ) );

		// Enqueue the preview JS for customize options.
		add_action( 'customize_preview_init', array( $this, 'customize_preview_js' ) );

	}

	/**
	 * Include the required files for extending the custom Customize controls.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function customize_custom_panels_sections_includes( $wp_customize ) {

		// Include the required customizer nested panels and sections files.
		require COLORMAG_CUSTOMIZER_DIR . '/extend-customizer/class-colormag-wp-customize-panel.php';
		require COLORMAG_CUSTOMIZER_DIR . '/extend-customizer/class-colormag-wp-customize-section.php';
		require COLORMAG_CUSTOMIZER_DIR . '/extend-customizer/class-colormag-upsell-section.php';

	}

	/**
	 * Include the required files for extending the custom Customize controls.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function customize_custom_controls_includes( $wp_customize ) {

		// Include the customize base controls file.
		require COLORMAG_CUSTOMIZER_DIR . '/custom-controls/class-colormag-customize-base-control.php';

		// Include the required customize controls file.
		require COLORMAG_CUSTOMIZER_DIR . '/custom-controls/radio-image/class-colormag-radio-image-control.php';

	}

	/**
	 * Register ColorMag customize panels, sections and controls type.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function register_panels_sections_controls( $wp_customize ) {

		// Register panels and sections.
		$wp_customize->register_panel_type( 'ColorMag_WP_Customize_Panel' );
		$wp_customize->register_section_type( 'ColorMag_WP_Customize_Section' );
		$wp_customize->register_section_type( 'ColorMag_Upsell_Section' );

		// Register controls.

	}

	/**
	 * Include the required files for Customize option.
	 */
	public function customize_options_file_include() {

		// Include the customize base option file.
		require COLORMAG_CUSTOMIZER_DIR . '/options/class-colormag-customize-base-option.php';

		// Include the required customize section and panels register file.
		require COLORMAG_CUSTOMIZER_DIR . '/class-colormag-customizer-register-sections-panels.php';

		// Include the required customize upsell button file.
		require COLORMAG_CUSTOMIZER_DIR . '/class-colormag-customizer-upsell-button.php';

		// Include the required customize options file.
		require COLORMAG_CUSTOMIZER_DIR . '/options/header/class-colormag-customize-header-options.php';
		require COLORMAG_CUSTOMIZER_DIR . '/options/design/class-colormag-customize-design-options.php';
		require COLORMAG_CUSTOMIZER_DIR . '/options/social/class-colormag-customize-social-options.php';
		require COLORMAG_CUSTOMIZER_DIR . '/options/footer/class-colormag-customize-footer-options.php';
		require COLORMAG_CUSTOMIZER_DIR . '/options/additional/class-colormag-customize-additional-options.php';
		require COLORMAG_CUSTOMIZER_DIR . '/options/category-color/class-colormag-customize-category-color-options.php';
		require COLORMAG_CUSTOMIZER_DIR . '/options/override-defaults/class-colormag-customize-override-defaults-options.php';

	}

	/**
	 * Include the required customize options.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 *
	 * @return array Customizer options for registering panels, sections as well as controls.
	 */
	public function get_customizer_configurations( $wp_customize ) {

		return apply_filters( 'colormag_customizer_options', array(), $wp_customize );

	}

	/**
	 * Return default values for the Customize Configurations.
	 *
	 * @return array
	 */
	public function get_colormag_customizer_default_configuration() {

		$default_configuration = array(
			'priority'             => null,
			'title'                => null,
			'label'                => null,
			'name'                 => null,
			'type'                 => null,
			'description'          => null,
			'capability'           => 'edit_theme_options',
			'datastore_type'       => 'theme_mod',
			'settings'             => null,
			'active_callback'      => null,
			'sanitize_callback'    => null,
			'sanitize_js_callback' => null,
			'theme_supports'       => null,
			'transport'            => null,
			'default'              => null,
			'selector'             => null,
		);

		return apply_filters( 'colormag_customizer_default_configuration', $default_configuration );

	}

	/**
	 * Process and Register Customizer Panels, Sections, Settings and Controls.
	 *
	 * @param WP_Customize_Manager $wp_customize Reference to WP_Customize_Manager.
	 *
	 * @return void
	 */
	public function register_customize_settings( $wp_customize ) {

		$configurations = $this->get_customizer_configurations( $wp_customize );

		foreach ( $configurations as $key => $config ) {
			$config = wp_parse_args(
				$config,
				$this->get_colormag_customizer_default_configuration()
			);

			switch ( $config['type'] ) {

				case 'panel':
					// Remove `panel` type from configuration for registering it in different way.
					unset( $config['type'] );

					$this->register_panel( $config, $wp_customize );

					break;

				case 'section':
					// Remove `section` type from configuration for registering it in different way.
					unset( $config['type'] );

					$this->register_section( $config, $wp_customize );

					break;

				case 'sub-control':
					// Remove `sub-control` type from configuration for registering it in different way.
					unset( $config['type'] );

					$this->register_sub_control_setting( $config, $wp_customize );

					break;

				case 'control':
					// Remove `control` type from configuration for registering it in different way.
					unset( $config['type'] );

					$this->register_setting_control( $config, $wp_customize );

					break;
			}
		}

	}

	/**
	 * Register Customizer Panel.
	 *
	 * @param array                $config       Customize options configuration settings.
	 * @param WP_Customize_Manager $wp_customize Instance of WP_Customize_Manager.
	 *
	 * @return void
	 */
	public function register_panel( $config, $wp_customize ) {

		$wp_customize->add_panel(
			new ColorMag_WP_Customize_Panel(
				$wp_customize,
				$config['name'],
				$config
			)
		);

	}

	/**
	 * Register Customizer Section.
	 *
	 * @param array                $config       Customize options configuration settings.
	 * @param WP_Customize_Manager $wp_customize Instance of WP_Customize_Manager.
	 *
	 * @return void
	 */
	public function register_section( $config, $wp_customize ) {

		$section_callback = isset( $config['section_callback'] ) ? $config['section_callback'] : 'ColorMag_WP_Customize_Section';

		$wp_customize->add_section(
			new $section_callback(
				$wp_customize,
				$config['name'],
				$config
			)
		);

	}

	/**
	 * Register Customizer Sub Control.
	 *
	 * @param array                $config       Customize options configuration settings.
	 * @param WP_Customize_Manager $wp_customize Instance of WP_Customize_Manager.
	 *
	 * @return void
	 */
	public function register_sub_control_setting( $config, $wp_customize ) {

	}

	/**
	 * Register Customizer Control.
	 *
	 * @param array                $config       Customize options configuration settings.
	 * @param WP_Customize_Manager $wp_customize Instance of WP_Customize_Manager.
	 *
	 * @return void
	 */
	public function register_setting_control( $config, $wp_customize ) {

		// For adding settings.
		$sanitize_callback = isset( $config['sanitize_callback'] ) ? $config['sanitize_callback'] : ColorMag_Customize_Base_Control::get_sanitize_callback( $config['control'] );
		$transport         = isset( $config['transport'] ) ? $config['transport'] : 'refresh';

		$wp_customize->add_setting(
			$config['name'],
			array(
				'default'           => $config['default'],
				'type'              => $config['datastore_type'],
				'transport'         => $transport,
				'sanitize_callback' => $sanitize_callback,
			)
		);

		// For adding controls.
		$control_type   = ColorMag_Customize_Base_Control::get_control_instance( $config['control'] );
		$config['type'] = $config['control'];

		var_dump( $config['label'], $config['type'] );

		if ( false !== $control_type ) {
			$wp_customize->add_control(
				new $control_type(
					$wp_customize,
					$config['name'],
					$config
				)
			);
		} else {
			$wp_customize->add_control(
				$config['name'],
				$config
			);
		}

		// For adding selective refresh.
		$selective_refresh = isset( $config['partial'] ) ? true : false;
		$render_callback   = isset( $config['partial']['render_callback'] ) ? $config['partial']['render_callback'] : '';

		if ( $selective_refresh ) {

			if ( isset( $wp_customize->selective_refresh ) ) {
				$wp_customize->selective_refresh->add_partial(
					$config['name'],
					array(
						'selector'        => $config['partial']['selector'],
						'render_callback' => $render_callback,
					)
				);
			}

		}

	}

	/**
	 * Include the required customizer sanitization, callbacks and partials file.
	 */
	public function customize_sanitize_callback_include() {

		require_once( COLORMAG_CUSTOMIZER_DIR . '/class-colormag-customizer-sanitizes.php' );
		require_once( COLORMAG_CUSTOMIZER_DIR . '/class-colormag-customizer-callbacks.php' );
		require_once( COLORMAG_CUSTOMIZER_DIR . '/class-colormag-customizer-partials.php' );

	}

	/**
	 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
	 *
	 * @since ColorMag 2.0.0
	 */
	public function customize_preview_js() {
		wp_enqueue_script(
			'colormag-customizer',
			get_template_directory_uri() . '/js/customizer.js',
			array(
				'customize-preview',
			),
			false,
			true
		);
	}

}

return new ColorMag_Customizer();
