<?php
/**
 * Typography control class.
 */

namespace Customind\Core\Types\Controls;

/**
 * Typography control class.
 */
class Typography extends AbstractControl {

	/**
	 * {@inheritDoc}
	 */
	public $type = 'customind-typography';

	/**
	 * Allowed properties.
	 *
	 * @var string
	 */
	public $allowed_properties;

	/**
	 * {@inheritDoc}
	 */
	public function __construct(
		$id,
		$manager,
		$args = []
	) {
		parent::__construct( $id, $manager, $args );
		$this->allowed_properties = $args['allowed_properties'] ?? null;
		$this->display_mode       = $args['display_mode'] ?? '';
	}

	/**
	 * {@inheritDoc}
	 */
	protected function json_allowed_props() {
		return array_merge(
			parent::json_allowed_props(),
			[
				'allowed_properties',
				'display_mode',
			]
		);
	}
}
