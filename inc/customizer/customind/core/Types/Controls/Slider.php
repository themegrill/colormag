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
	 * {@inheritDoc}
	 */
	public function __construct(
		$id,
		$manager,
		$args = []
	) {
		parent::__construct( $id, $manager, $args );
		$this->responsive   = $args['responsive'] ?? false;
		$this->units        = $args['units'] ?? [];
		$this->default_unit = $args['default_unit'] ?? 'px';
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
			]
		);
	}
}
