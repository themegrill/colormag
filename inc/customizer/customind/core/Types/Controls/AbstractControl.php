<?php
/**
 * Abstract control class.
 */

namespace Customind\Core\Types\Controls;

use Customind\Core\Traits\Hook;

/**
 * Abstract control class.
 */
abstract class AbstractControl extends \WP_Customize_Control {

	use Hook;

	/**
	 * Is sub control flag.
	 *
	 * Required to render sub controls properly.
	 *
	 * @var boolean
	 */
	public $is_sub_control = false;

	/**
	 * @var string|null
	 */
	public $tab;

	/**
	 * @var string|null
	 */
	public $tab_group;

	/**
	 * {@inheritdoc}
	 */
	public function __construct( $manager, $id, $args = [] ) {
		$this->is_sub_control = $args['is_sub_control'] ?? false;
		$this->tab_group      = $args['tab_group'] ?? null;
		$this->tab            = $args['tab'] ?? null;
		$args                 = $this->prepare_control_args( $id, $args );
		$this->add_selective_refresh( $manager, $id, $args );
		parent::__construct( $manager, $id, $args );
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
			[
				'selector'            => $args['partial']['selector'] ?? '',
				'render_callback'     => $args['partial']['render_callback'] ?? null,
				'container_inclusive' => $args['partial']['container_inclusive'] ?? false,
			]
		);
	}

	/**
	 * Prepare control args.
	 *
	 * @param string $id
	 * @param array $args
	 * @return array
	 */
	protected function prepare_control_args( $id, $args ) {
		$control_args = [
			'label'       => $args['title'] ?? '',
			'title'       => $args['title'] ?? '',
			'description' => $args['description'] ?? '',
			'section'     => $args['section'] ?? '',
			'settings'    => $id,
			'type'        => $args['type'],
			'choices'     => $args['choices'] ?? [],
			'priority'    => 'customind-tabs' === $args['type'] ? PHP_INT_MIN : $args['priority'] ?? 10,
			'input_attrs' => $args['input_attrs'] ?? [],
			'capability'  => 'edit_theme_options',
			'partial'     => $args['partial'] ?? null,
		];

		return $this->apply_filters( "{$this->type}:control:args", $control_args, $this );
	}

	/**
	 * Get allowed props for json.
	 *
	 * @return array
	 */
	protected function json_allowed_props() {
		return $this->apply_filters(
			"{$this->type}:control:json:allowed:props",
			[
				'type',
				'priority',
				'section',
				'label',
				'type',
				'description',
				'instance_number',
				'id',
				'choices',
				'is_sub_control',
				'tab_group',
				'tab',
			]
		);
	}

	/**
	 * {@inheritDoc}
	 */
	public function json() {
		$json = $this->prepare_json();
		return $this->apply_filters(
			"{$this->type}:control:json",
			$json,
			$this
		);
	}

	/**
	 * Prepare json.
	 *
	 * @return array
	 */
	protected function prepare_json() {
		$json            = wp_array_slice_assoc(
			(array) $this,
			$this->json_allowed_props()
		);
		$json['active']  = $this->active();
		$json['content'] = $this->get_content();

		foreach ( $this->settings as $key => $setting ) {
			$json['settings'][ $key ] = $setting->id;
		}
		$json['default']     = $this->default ?? $this->setting->default;
		$json['input_attrs'] = $this->input_attrs;
		$json['value']       = $this->value();
		$json['link']        = $this->get_link();
		return $this->apply_filters(
			"{$this->type}:control:json:prepare",
			$json,
			$this
		);
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
