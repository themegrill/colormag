<?php
/**
 * Slider control.
 */

namespace Customind\Core\Types\Controls;

/**
 * Slider control class.
 */
class Slider extends AbstractControl {

	/**
	 * {@inheritDoc}
	 */
	public $type = 'customind-slider';

	/**
	 * Responsive flag.
	 *
	 * @var boolean
	 */
	public $responsive;

	/**
	 * Units.
	 *
	 * @var array
	 */
	public $units;

	/**
	 * Default unit.
	 *
	 * @var string
	 */
	public $default_unit;

	/**
	 * Step increment for the slider.
	 *
	 * @var float|int
	 */
	public $step;

	/**
	 * {@inheritDoc}
	 */
	public function __construct(
		$id,
		$manager,
		$args = []
	) {
		if ( isset( $args['step'] ) && ! isset( $args['input_attrs']['step'] ) ) {
			$args['input_attrs']['step'] = $args['step'];
		}
		parent::__construct( $id, $manager, $args );
		$this->responsive   = $args['responsive'] ?? false;
		$this->units        = $args['units'] ?? [];
		$this->default_unit = $args['default_unit'] ?? 'px';
		$this->step         = $args['step'] ?? 1;
	}

	/**
	 * {@inheritDoc}
	 */
	protected function json_allowed_props() {
		return array_merge(
			parent::json_allowed_props(),
			[
				'responsive',
				'units',
				'default_unit',
				'step',
			]
		);
	}
}
