<?php
/**
 * Dimensions control class.
 */
namespace Customind\Core\Types\Controls;

/**
 * Dimensions control class.
 */
class Dimensions extends AbstractControl {

	/**
	 * {@inheritDoc}
	 */
	public $type = 'customind-dimensions';

	/**
	 * Responsive support for the dimension.
	 *
	 * @var [type]
	 */
	public $responsive;

	/**
	 * Units for the dimension.
	 *
	 * @var [type]
	 */
	public $units;

	/**
	 * Default unit for the dimension.
	 *
	 * @var [type]
	 */
	public $default_unit;

	/**
	 * Dimension type.
	 *
	 * @var string
	 */
	public $dimension_type;

	/**
	 * {@inheritDoc}
	 */
	public function __construct(
		$id,
		$manager,
		$args = []
	) {
		parent::__construct( $id, $manager, $args );
		$this->responsive     = $args['responsive'] ?? false;
		$this->units          = $args['units'] ?? [];
		$this->default_unit   = $args['default_unit'] ?? 'px';
		$this->dimension_type = $args['dimension_type'] ?? '';
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
				'dimensions_type',
			]
		);
	}
}
