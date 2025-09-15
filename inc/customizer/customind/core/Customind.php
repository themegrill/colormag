<?php
/**
 * Undocumented class
 */

namespace Customind\Core;

use Customind\Core\Factories\TypeFactory;
use Customind\Core\Traits\Hook;
use Customind\Core\Types\UpgradeSection;
use Customind\Core\Types\UpsellSection;

class Customind {

	use Hook;

	/**
	 * Holds all sections.
	 *
	 * @var array Sections.
	 */
	private $sections = [];

	/**
	 * Holds all panels.
	 *
	 * @var array Panels.
	 */
	private $panels = [];

	/**
	 * Holds control condition.
	 *
	 * @var array
	 */
	private $condition = [];

	/**
	 * Holds all option controls.
	 *
	 * @var array
	 */
	private $controls = [];

	/**
	 * Hold control conditions.
	 *
	 * @var array
	 */
	private $conditions = [];

	/**
	 * Fontawesome version.
	 *
	 * @var string
	 */
	private $fontawesome_version = 'v6';

	/**
	 * Builder panels.
	 *
	 * @var array
	 */
	private $builder_panels = [];

	/**
	 * CSS var prefix.
	 *
	 * @var string
	 */
	private $css_var_prefix = 'customind';

	/**
	 * I18n data.
	 *
	 * @var array
	 */
	private $i18n_data = [
		'domain' => '',
		'path'   => null,
	];

	/**
	 * @var array<string,string>
	 */
	private $section_i18n = [
		'customizing-action' => 'Customizing &#9656; %s',
		'customizing'        => 'Customizing',
	];

	private $typography_controls_ids = [];

	private $tabs = [];

	/**
	 * Constructor.
	 */
	public function __construct() {
		$this->init_hooks();
	}

	/**
	 * Init hooks.
	 *
	 * @return void
	 */
	public function init_hooks() {
		add_action( 'customize_controls_enqueue_scripts', [ $this, 'enqueue_scripts' ], 999 );
		add_action( 'customize_register', [ $this, 'register' ], 999 );
		add_action( 'customize_preview_init', [ $this, 'enqueue_preview_scripts' ], 999 );
		add_action( 'customize_save_after', [ $this, 'on_save' ] );
		add_action( 'wp_head', [ $this, 'enqueue_custom_fonts' ] );
		add_action( 'after_setup_theme', [ $this, 'init_google_fonts_url' ] );

		$this->add_action( 'register:control', [ $this, 'process_settings' ], 10, 3 );
		$this->add_action( 'register:control', [ $this, 'process_builder_panels' ], 10, 3 );
		$this->add_action( 'customize:save', [ $this, 'update_google_fonts_url' ] );

		$this->add_filter( 'controls', [ $this, 'process_tabs' ] );
	}

	public function process_tabs( $controls ) {
		$section_tabs_map = [];
		$control_tabs_map = [];

		foreach ( $controls as $id => $args ) {
			if ( isset( $args['type'] ) && 'customind-tabs' === $args['type'] && isset( $args['section'] ) ) {
				$section = $args['section'];
				if ( isset( $section_tabs_map[ $section ] ) ) {
						throw new \Exception(
							sprintf(
								'Only one tabs control is allowed per section. Section "%s" has multiple tabs controls.',
								esc_html( $section )
							)
						);
				}
				$section_tabs_map[ $section ] = $id;
			} elseif ( isset( $args['tab_group'], $args['tab'] ) ) {
				$tab_group                        = $args['tab_group'];
				$tab                              = $args['tab'];
				$control_tabs_map[ $tab_group ][] = [
					'id'  => $id,
					'tab' => $tab,
				];
			}
		}

		$this->tabs = $control_tabs_map;

		return $controls;
	}

	/**
	 * Enqueue custom fonts.
	 *
	 * This function retrieves custom fonts CSS, registers a new style for local fonts,
	 * enqueues the style, and adds the CSS inline if it is not empty.
	 * Also enqueues Google Fonts used by typography controls.
	 *
	 * @return void
	 */
	public function enqueue_custom_fonts() {
		// Enqueue custom fonts from Magazine Blocks Pro
		$css = get_custom_fonts_css();
		if ( ! empty( $css ) ) {
			wp_register_style( 'customind-local-fonts', false );
			wp_enqueue_style( 'customind-local-fonts' );
			wp_add_inline_style( 'customind-local-fonts', $css );
		}
	}

	/**
	 * Initialize Google Fonts URL if not exists.
	 *
	 * @return void
	 */
	public function init_google_fonts_url() {
		$cached_fonts_url = get_option( '_customind_google_fonts_url', '' );
		if ( empty( $cached_fonts_url ) && ! empty( $this->typography_controls_ids ) ) {
			// Generate initial Google Fonts URL based on current typography control values
			$fonts = [];
			foreach ( $this->typography_controls_ids as $id ) {
				$value = get_theme_mod( $id );
				if ( empty( $value['font-family'] ) || 'default' === strtolower( $value['font-family'] ) ) {
					continue;
				}
				$family           = $value['font-family'];
				$weight           = $value['font-weight'] ?? 400;
				$weight           = (int) $weight;
				$fonts[ $family ] = isset( $fonts[ $family ] )
					? ( in_array( $weight, $fonts[ $family ], true )
					? $fonts[ $family ]
					: array_merge( $fonts[ $family ], [ $weight ] ) )
					: [ $weight ];
			}

			if ( ! empty( $fonts ) ) {
				$families  = array_keys( $fonts );
				$fonts_url = add_query_arg(
					[
						'family' => implode(
							'|',
							array_map(
								function ( $f ) use ( $fonts ) {
									return str_replace( ' ', '+', $f ) . ':' . implode( ',', array_unique( $fonts[ $f ] ) );
								},
								$families
							)
						),
					],
					'https://fonts.googleapis.com/css'
				);
				update_option( '_customind_google_fonts_url', $fonts_url );
			}
		}
	}

	/**
	 * On save.
	 *
	 * @param \WP_Customize_Manager $wp_customize
	 * @return void
	 */
	public function on_save( $wp_customize ) {
		$action = 'save-customize_' . $wp_customize->get_stylesheet();
		if (
			! check_ajax_referer( $action, 'nonce', false ) ||
			! isset( $_POST['customized'] )
		) {
			wp_send_json_error( 'invalid_nonce' );
		}
		$data = json_decode( sanitize_textarea_field( wp_unslash( $_POST['customized'] ) ), true );
		$this->do_action( 'customize:save', $wp_customize, $data );
	}

	/**
	 * Update google fonts url.
	 *
	 * @param \WP_Customize_Manager $manager
	 * @return void
	 */
	public function update_google_fonts_url( $manager ) {
		if ( empty( $this->typography_controls_ids ) ) {
			return;
		}
		$fonts = [];
		foreach ( $this->typography_controls_ids as $id ) {
			$control = $manager->get_control( $id );
			if ( ! $control ) {
				continue;
			}
			$value = $control->value();
			if ( empty( $value['font-family'] ) || 'default' === strtolower( $value['font-family'] ) ) {
				continue;
			}
			$family           = $value['font-family'];
			$weight           = $value['font-weight'] ?? 400;
			$weight           = (int) $weight;
			$fonts[ $family ] = isset( $fonts[ $family ] )
					? ( in_array( $weight, $fonts[ $family ], true )
					? $fonts[ $family ]
					: array_merge( $fonts[ $family ], [ $weight ] ) )
					: [ $weight ];
		}
		if ( empty( $fonts ) ) {
			return;
		}
		$families  = array_keys( $fonts );
		$fonts_url = add_query_arg(
			[
				'family' => implode(
					'|',
					array_map(
						function ( $f ) use ( $fonts ) {
							return str_replace( ' ', '+', $f ) . ':' . implode( ',', array_unique( $fonts[ $f ] ) );
						},
						$families
					)
				),
			],
			'https://fonts.googleapis.com/css'
		);
		if ( empty( $fonts_url ) ) {
			delete_option( '_customind_google_fonts_url' );
			return;
		}
		update_option( '_customind_google_fonts_url', $fonts_url );
	}

	/**
	 * Register section, panels, controls.
	 *
	 * @param \WP_Customize_Manager $wp_customize
	 * @return void
	 */
	public function register( $wp_customize ) {
		$this->register_items( $wp_customize, 'panel' );
		$this->register_items( $wp_customize, 'section' );
		$this->register_items( $wp_customize, 'control' );
		$wp_customize->register_section_type( UpsellSection::class );
		$wp_customize->register_section_type( UpgradeSection::class );
		$this->process_typography_controls();
	}

	/**
	 * Register items.
	 *
	 * @param \WP_Customize_Manager $wp_customize
	 * @param string $type
	 * @return void
	 */
	private function register_items( $wp_customize, $type ) {
		$items = $this->apply_filters( "{$type}s", $this->{"{$type}s"} );
		if ( empty( $items ) ) {
			return;
		}
		$is_control = 'control' === $type;
		foreach ( $items as $id => $args ) {
			if ( $is_control ) {
				$_type = $args['type'] ?? '';
			} elseif ( 'upsell-section' === ( $args['type'] ?? '' ) ) {
				$_type        = 'customind-upsell-section';
				$args['type'] = 'customind-upsell-section';
			} elseif ( 'upgrade-section' === ( $args['type'] ?? '' ) ) {
				$_type        = 'customind-upgrade-section';
				$args['type'] = 'customind-upgrade-section';
			} else {
				$_type = $args['type'] ?? "customind-$type";
			}
			$this->do_action( "register:{$type}", $id, $wp_customize, $args );
			$item = TypeFactory::create( $_type, $wp_customize, $id, $args );
			$wp_customize->{"add_$type"}( $item );
		}
	}

	/**
	 * Process typography controls.
	 *
	 * @param array $control_args
	 * @return void
	 */
	protected function process_typography_controls( $control_args = [] ) {
		$control_args = empty( $control_args ) ? $this->controls : $control_args;
		foreach ( $control_args as $key => $args ) {
			if ( empty( $args['type'] ) ) {
				continue;
			}
			if ( 'customind-typography' === $args['type'] && ! in_array( $key, $this->typography_controls_ids, true ) ) {
				$allowed_props = $args['input_attrs']['allowedProperties'] ?? [];
				if ( empty( $allowed_props ) || in_array( 'font-family', $allowed_props, true ) ) {
					$this->typography_controls_ids[] = $key;
				}
			}
			if ( isset( $args['sub_controls'] ) ) {
				$this->process_typography_controls( $args['sub_controls'] );
			}
		}
	}

	/**
	 * Register builder sections.
	 *
	 * @param string $id
	 * @param string $type
	 * @param \WP_Customize_Manager $wp_customize
	 * @param array $args
	 * @return void
	 */
	public function process_builder_panels( $id, $wp_customize, $args ) {
		if (
			empty( $args['type'] ) ||
			! in_array( $args['type'], [ 'customind-header-builder', 'customind-footer-builder' ], true ) ||
			empty( $args['section'] )
		) {
			return;
		}

		$section = $args['section'];

		if ( ! isset( $this->sections[ $section ] ) ) {
			return;
		}
		$panel = $this->sections[ $section ]['panel'] ?? false;
		if ( ! $panel || ! isset( $this->panels[ $panel ] ) ) {
			return;
		}
		$this->builder_panels[] = [
			'panel'   => $panel,
			'section' => $section,
			'control' => $id,
		];
	}

	/**
	 * Process customize setting.
	 *
	 * @param string $id
	 * @param string $type
	 * @param \WP_Customize_Manager $wp_customize
	 * @param array $args
	 * @return void
	 */
	public function process_settings( $id, $wp_customize, $args ) {
		$this->process_conditions( $id, $args );
		$wp_customize->add_setting(
			$id,
			[
				'default'           => $args['default'] ?? '',
				'transport'         => $args['transport'] ?? 'refresh',
				'type'              => 'theme_mod',
				'sanitize_callback' => Sanitization::get_sanitization_callback( $args['type'] ),
			]
		);
	}

	/**
	 * Process conditions.
	 *
	 * @param string $id
	 * @param array $args
	 * @return void
	 */
	protected function process_conditions( $id, $args ) {
		if ( isset( $args['condition'] ) ) {
			$this->condition[ $id ] = $args['condition'];
		}
		if ( isset( $args['conditions'] ) ) {
			$this->conditions[ $id ] = $args['conditions'];
		}

		if ( isset( $args['sub_controls'] ) ) {
			foreach ( $args['sub_controls'] as $i => $a ) {
				$this->process_conditions( $i, $a );
			}
		}
	}

	/**
	 * Add controls.
	 *
	 * @param array $args
	 * @return void
	 */
	public function add_controls( $args ) {
		$this->add_items( $args, 'controls' );
	}

	/**
	 * Add items.
	 *
	 * @param array $args
	 * @param string $type
	 * @return void
	 */
	private function add_items( array $args, $type ) {
		foreach ( $args as $key => $arg ) {
			if ( isset( $arg['type'] ) && ( 'upgrade-section' === $arg['type'] || 'upsell-section' === $arg['type'] ) ) {
				$this->sections[ $key ] = $arg;
				continue;
			}
			$this->$type[ $key ] = $arg;
		}
	}

	/**
	 * Add Panels.
	 *
	 * @param array $args
	 * @return void
	 */
	public function add_panels( $args ) {
		$this->add_items( $args, 'panels' );
	}

	/**
	 * Add sections.
	 *
	 * @param array $args
	 * @return void
	 */
	public function add_sections( $args ) {
		$this->add_items( $args, 'sections' );
	}

	/**
	 * Enqueue scripts.
	 *
	 * @return void
	 */
	public function enqueue_scripts() {

		$custom_fonts     = [];
		$asset            = $this->get_asset( 'customind' );
		$fontawesome_path = $this->get_asset_url( 'all.min.css', "assets/fontawesome/{$this->get_fontawesome_version()}/css", false );

		wp_enqueue_style( 'fontawesome', $fontawesome_path, [], $this->fontawesome_version );
		wp_enqueue_style( 'customind', $this->get_asset_url( 'customind.css' ), [ 'wp-components' ], $asset['version'] );
		// Support RTL.
		wp_style_add_data( 'customind', 'rtl', 'replace' );
		wp_enqueue_script( 'customind', $this->get_asset_url( 'customind.js' ), array_merge( $asset['dependencies'] ), $asset['version'], true );

		if ( ! empty( $this->i18n_data['domain'] ) && ! empty( $this->i18n_data['path'] ) ) {
			wp_set_script_translations( 'customind', $this->i18n_data['domain'], $this->i18n_data['path'] );
		}

		// Custom fonts from Magazine Blocks Pro.
		if ( function_exists( 'magazine_blocks_pro_get_fonts' ) ) {
			$custom_fonts = magazine_blocks_pro_get_fonts();
		}

		wp_localize_script(
			'customind',
			'__CUSTOMIND__',
			apply_filters(
				'customind_setting_data',
				[
					'googleFonts'           => $this->get_google_fonts(),
					'customFonts'           => $custom_fonts,
					'fontawesome'           => $this->get_fontawesome(),
					'condition'             => $this->get_condition(),
					'conditions'            => $this->get_conditions(),
					'builderPanels'         => $this->get_builder_panels(),
					'cssVarPrefix'          => $this->get_css_var_prefix(),
					'colorPaletteControlId' => $this->get_color_palette_control_id(),
					'tabs'                  => $this->tabs,
				]
			)
		);
	}

	/**
	 * Get asset.
	 *
	 * @param string $prefix
	 * @return array
	 */
	public function get_asset( $prefix ) {
		$asset_file = dirname( __DIR__ ) . DIRECTORY_SEPARATOR . 'build' . DIRECTORY_SEPARATOR . $prefix . '.asset.php';
		if ( file_exists( $asset_file ) ) {
			return require $asset_file;
		}
		return [
			'dependencies' => [],
			'version'      => CUSTOMIND_VERSION,
		];
	}

	/**
	 * Get asset url.
	 *
	 * @param string $filename
	 * @param string $directory
	 * @param boolean $dev
	 * @return string
	 */
	public function get_asset_url( $filename, $directory = 'build', $dev = true ) {
		if ( defined( 'CUSTOMIND_IS_DEVELOPMENT' ) && CUSTOMIND_IS_DEVELOPMENT && $dev ) {
			return 'http://localhost:8887/' . $filename;
		}
		$filepath      = dirname( __DIR__ ) . DIRECTORY_SEPARATOR . $directory . DIRECTORY_SEPARATOR . $filename;
		$filepath      = str_replace( '\\', '/', $filepath );
		$relative_path = substr( $filepath, strpos( $filepath, 'wp-content' ) );
		return site_url( $relative_path );
	}

	/**
	 * Get fontawesome version.
	 *
	 * @return string
	 */
	public function get_fontawesome_version() {
		return $this->fontawesome_version;
	}

	/**
	 * Set fontawesome version.
	 *
	 * @param string $version
	 * @return void
	 */
	public function set_fontawesome_version( $version ) {
		if ( ! in_array( $version, [ 'v6', 'v4' ], true ) ) {
			$this->fontawesome_version = 'v6';
			return;
		}
		$this->fontawesome_version = $version;
	}

	/**
	 * Get google fonts.
	 *
	 * @return array
	 */
	public function get_google_fonts() {
		$google_fonts = require dirname( __DIR__ ) . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'google-fonts.php';
		return $this->apply_filters( 'google-fonts', $google_fonts );
	}

	/**
	 * Get fontawesome.
	 *
	 * @return array
	 */
	public function get_fontawesome() {
		$fontawesome = require dirname( __DIR__ ) . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . "fontawesome-{$this->fontawesome_version}.php";
		return $this->apply_filters( 'fontawesome', $fontawesome );
	}

	/**
	 * Get condition.
	 *
	 * @return array
	 */
	public function get_condition() {
		return $this->apply_filters( 'condition', $this->condition );
	}

	/**
	 * Get conditions.
	 *
	 * @return array
	 */
	public function get_conditions() {
		return $this->apply_filters( 'conditions', $this->conditions );
	}

	/**
	 * Get builder panels.
	 *
	 * @return array
	 */
	public function get_builder_panels() {
		return $this->apply_filters( 'builder-panels', $this->builder_panels );
	}

	public function get_css_var_prefix() {
		return $this->apply_filters( 'css-var-prefix', $this->css_var_prefix );
	}

	/**
	 * $Set css var prefix.
	 *
	 * @param string $prefix
	 * @return void
	 */
	public function set_css_var_prefix( $prefix ) {
		if ( empty( $prefix ) ) {
			return;
		}
		$this->css_var_prefix = $prefix;
	}

	/**
	 * Get color palette control id.
	 *
	 * @return string|null
	 */
	private function get_color_palette_control_id( $controls = [] ) {
		$controls = empty( $controls ) ? $this->controls : $controls;
		foreach ( $controls as $key => $args ) {
			if ( 'customind-color-palette' === $args['type'] ) {
				return $key;
			}
			if ( isset( $args['sub_controls'] ) ) {
				return $this->get_color_palette_control_id( $args['sub_controls'] );
			}
		}
		return null;
	}

	/**
	 * Enqueue preview scripts.
	 *
	 * @return void
	 */
	public function enqueue_preview_scripts() {
		$asset = $this->get_asset( 'customind-preview' );
		wp_enqueue_script( 'customind-preview', $this->get_asset_url( 'customind-preview.js' ), array_merge( $asset['dependencies'], [ 'customize-preview' ] ), $asset['version'], true );
		wp_localize_script(
			'customind-preview',
			'__CUSTOMIND__PREVIEW__',
			[
				'controls' => $this->get_control_ids(),
			]
		);
	}

	/**
	 * Get control ids.
	 *
	 * @param array $controls
	 * @param array $ids
	 * @return array
	 */
	public function get_control_ids( $controls = [], $ids = [] ) {
		$controls = empty( $controls ) ? $this->controls : $controls;
		foreach ( $controls as $key => $args ) {
			$ids[] = $key;
			if ( isset( $args['sub_controls'] ) ) {
				$ids = $this->get_control_ids( $args['sub_controls'], $ids );
			}
		}
		return $ids;
	}

	/**
	 * Get i18n data.
	 *
	 * @return array
	 */
	public function get_i18n_data() {
		return $this->apply_filters( 'text-domain', $this->i18n_data );
	}

	/**
	 * Set i18n domain.
	 *
	 * @param array $domain
	 * @return void
	 */
	public function set_i18n_data( $i18n_data ) {
		$this->i18n_data = $i18n_data;
	}

	/**
	 * Get i18n data.
	 *
	 * @return array
	 */
	public function get_section_i18n() {
		return $this->apply_filters( 'section-i18n', $this->section_i18n );
	}

	/**
	 * Set i18n domain.
	 *
	 * @param array $domain
	 * @return void
	 */
	public function set_section_i18n( $i18n_data ) {
		$this->i18n_data = $i18n_data;
	}
}
