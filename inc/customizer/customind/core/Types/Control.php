<?php
/**
 * Control class.
 *
 * @since x.x.x
 */

namespace Customind\Core\Types;

use Customind\Core\Sanitization;
use Customind\Core\Traits\Hook;

defined( 'ABSPATH' ) || exit;

/**
 * Class Control.
 */
class Control extends \WP_Customize_Control {

	use Hook;

	const DEFAULT_TYPE = 'text';

	const VALID_TYPES = array(
		'customind-text',
		'customind-background',
		'customind-border',
		'customind-checkbox',
		'customind-switch',
		'customind-color',
		'customind-dimensions',
		'customind-radio',
		'customind-slider',
		'customind-textarea',
		'customind-typography',
		'customind-typography-preset',
		'customind-date',
		'customind-sortable',
		'customind-image',
		'customind-editor',
		'customind-select',
		'customind-toggle-button',
		'customind-visibility-button',
		'customind-color-group',
		'customind-accordion',
		'customind-title',
		'customind-divider',
		'customind-gradient',
		'customind-radio-image',
		'customind-fontawesome',
		'customind-builder',
		'customind-color-palette',
		'customind-navigation',
		'customind-image',
		'customind-upsell',
		'customind-upgrade',
		'customind-socials',
		'customind-preset',
		'customind-builder-migration',
		'customind-heading',
	);

	const GROUP_TYPES = array(
		'customind-color-group',
		'customind-accordion',
		'customind-tab-group',
	);

	public $sub_controls = array();

	/**
	 * Is sub control.
	 *
	 * @var boolean
	 */
	public $is_sub_control = false;

	/**
	 * Builder rows.
	 *
	 * @var array|null
	 */
	public $rows = null;

	/**
	 * Builder components.
	 *
	 * @var array|null
	 */
	public $components = null;

	/**
	 * Mobile builder componetns.
	 *
	 * @var array|null
	 */
	public $mobile_components = null;

	/**
	 * Builder panel.
	 *
	 * @var array|null
	 */
	public $panel = null;

	/**
	 * Mobile section for builder.
	 *
	 * @var array|null
	 */
	public $mobile_section = null;

	/**
	 * Holds the Google fonts.
	 *
	 * @var null|array
	 */
	public $fonts;

	/**
	 * Holds the CSS selectors and properties.
	 *
	 * @var null|array
	 */
	public $css;

	/**
	 * Builder areas.
	 *
	 * @var array|null
	 */
	public $areas;

	/**
	 * {@inheritdoc}
	 *
	 * @param WP_Customize_Manager $manager Customizer bootstrap instance.
	 * @param string               $id      Control ID.
	 * @param array                $args    Args.
	 * @param boolean               $is_sub_control Sub controls.
	 */
	public function __construct( $manager, $id, $args = array(), $is_sub_control = false ) {
		$args                 = $this->prepare_control_args( $id, $args );
		$this->is_sub_control = $is_sub_control;

		$this->register_sub_controls( $manager, $args );
		$this->add_selective_refresh( $manager, $id, $args );
		parent::__construct( $manager, $id, $args );

		if ( isset( $args['fonts'] ) ) {
			$this->fonts = $args['fonts'];
		}
		if ( isset( $args['css'] ) ) {
			$this->css = $args['css'];
		}
	}

	/**
	 * Register sub controls.
	 *
	 * @param array $args
	 * @return void
	 */
	protected function register_sub_controls( $manager, $args ) {
		if ( empty( $args['sub_controls'] ) || ! in_array( $args['type'], self::GROUP_TYPES, true ) ) {
			return;
		}
		foreach ( $args['sub_controls'] as $sub_control_id => $sub_control_args ) {
			$manager->add_setting(
				$sub_control_id,
				array(
					'default'           => $sub_control_args['default'] ?? '',
					'transport'         => $sub_control_args['transport'] ?? 'refresh',
					'type'              => 'theme_mod',
					'sanitize_callback' => ( new Sanitization() )->get_sanitization_callback( $sub_control_args['type'] ),
				)
			);
			$sub_control = new self( $manager, $sub_control_id, $sub_control_args, true );
			$manager->add_control( $sub_control );
			$this->sub_controls[] = $sub_control->json();
		}
	}

	/**
	 * Prepare control args.
	 *
	 * @param string $id
	 * @param array $args
	 * @return array
	 */
	protected function prepare_control_args( $id, $args ) {
		if ( ! isset( $args['type'] ) || ! in_array( $args['type'], self::VALID_TYPES, true ) ) {
			$args['type'] = self::DEFAULT_TYPE;
		}

		if ( 'customind-builder' === $args['type'] ) {
			$this->rows              = $args['rows'] ?? array();
			$this->components        = $args['components'] ?? array();
			$this->panel             = $args['panel'] ?? null;
			$this->mobile_components = $args['mobile_components'] ?? array();
			$this->areas             = $args['areas'] ?? array();
			$this->mobile_section    = $args['mobile_section'] ?? null;
		}

		$control_args = array(
			'label'       => $args['title'] ?? '',
			'title'       => $args['title'] ?? '',
			'description' => $args['description'] ?? '',
			'section'     => $args['section'] ?? '',
			'settings'    => $id,
			'type'        => $args['type'],
			'choices'     => $args['choices'] ?? array(),
			'priority'    => $args['priority'] ?? 10,
			'input_attrs' => $args['input_attrs'] ?? array(),
			'capability'  => 'edit_theme_options',
			'tab'         => $args['tab'] ?? '',
		);

		if ( in_array( $args['type'], self::GROUP_TYPES, true ) ) {
			$control_args['sub_controls'] = $args['sub_controls'] ?? array();
		}

		return $this->apply_filters( "{$this->type}:control:args", $control_args, $this );
	}

	/**
	 * Add selective refresh support for the control.
	 *
	 * @param WP_Customize_Manager $manager Customizer bootstrap instance.
	 * @param string               $id      Control ID.
	 * @param array                $args    Args.
	 */
	protected function add_selective_refresh( $manager, $id, $args ) {
		if ( ! isset( $args['partial'] ) || ! isset( $manager->selective_refresh ) ) {
			return;
		}
		$manager->selective_refresh->add_partial(
			$id,
			array(
				'selector'            => $args['partial']['selector'] ?? '',
				'render_callback'     => $args['partial']['render_callback'] ?? null,
				'container_inclusive' => $args['partial']['container_inclusive'] ?? false,
			)
		);
	}

	/**
	 * {@inheritDoc}
	 */
	public function json() {
		$json = wp_array_slice_assoc(
			(array) $this,
			array(
				'type',
				'priority',
				'tab',
				'section',
				'label',
				'type',
				'description',
				'instance_number',
				'id',
				'choices',
				'css',
				'fonts',
				'is_sub_control',
				'rows',
				'components',
				'mobile_components',
				'mobile_section',
				'panel',
				'areas',
			)
		);
		if ( in_array( $this->type, self::GROUP_TYPES, true ) ) {
			$json['sub_controls'] = $this->sub_controls;
		}
		$json['active']  = $this->active();
		$json['content'] = $this->get_content();

		foreach ( $this->settings as $key => $setting ) {
			$json['settings'][ $key ] = $setting->id;
		}

		$json['default']    = $this->default ?? $this->setting->default;
		$json['inputAttrs'] = $this->input_attrs;
		$json['value']      = $this->value();
		$json['link']       = $this->get_link();

		return $json;
	}

	/**
	 * {@inheritDoc}
	 *
	 * Content will be rendered via JS.
	 *
	 * @see WP_Customize_Control::render_content()
	 */
	public function render_content() {}
}
