<?php
/**
 * Navigation class.
 */
namespace Customind\Core\Types\Controls;

/**
 * Navigation control class.
 */
class Navigation extends AbstractControl {

	/**
	 * {@inheritDoc}
	 */
	public $type = 'customind-navigation';

	/**
	 * To.
	 */
	public $to;

	/**
	 * Nav type.
	 */
	public $nav_type;

	/**
	 * {@inheritDoc}
	 */
	public function __construct(
		$id,
		$manager,
		$args = []
	) {
		parent::__construct( $id, $manager, $args );
		$this->to       = $args['to'] ?? '';
		$this->nav_type = $args['nav_type'] ?? 'section';
	}

	/**
	 * {@inheritDoc}
	 */
	protected function json_allowed_props() {
		return array_merge(
			parent::json_allowed_props(),
			[
				'to',
				'nav_type',
			]
		);
	}
}
