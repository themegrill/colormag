<?php
/**
 * Header builder control class.
 */
namespace Customind\Core\Types\Controls;

/**
 * Header builder control class.
 */
class HeaderBuilder extends AbstractControl {

	/**
	 * {@inheritDoc}
	 */
	public $type = 'customind-header-builder';

	/**
	 * Builder components.
	 *
	 * @var array
	 */
	public $components;

	/**
	 * Builder areas.
	 *
	 * @var array
	 */
	public $areas;

	/**
	 * Mobile offset area.
	 *
	 * @var array
	 */
	public $offset_area;

	/**
	 * {@inheritDoc}
	 */
	public function __construct( $manager, $id, $args = [] ) {
		parent::__construct( $manager, $id, $args );
		$this->components  = $args['components'] ?? [];
		$this->areas       = $args['areas'] ?? [];
		$this->offset_area = $args['offset_area'] ?? [];
	}

	/**
	 * {@inheritDoc}
	 */
	protected function json_allowed_props() {
		return array_merge(
			parent::json_allowed_props(),
			[
				'components',
				'areas',
				'offset_area',
			]
		);
	}
}
