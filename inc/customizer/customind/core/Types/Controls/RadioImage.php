<?php
/**
 * Radio image control class.
 */
namespace Customind\Core\Types\Controls;

/**
 * Radio image control class.
 */
class RadioImage extends AbstractControl {
	/**
	 * {@inheritDoc}
	 */
	public $type = 'customind-radio-image';

	public $columns = 2;

	public $popover= false;

	/**
	 * {@inheritDoc}
	 */
	public function __construct(
		$id,
		$manager,
		$args = []
	) {
		parent::__construct( $id, $manager, $args );
		$this->columns = $args['columns'] ?? 2;
		$this->popover = $args['popover'] ?? false;
	}

	/**
	 * {@inheritDoc}
	 */
	protected function json_allowed_props() {
		return array_merge(
			parent::json_allowed_props(),
			[
				'columns',
				'popover',
			]
		);
	}
}

