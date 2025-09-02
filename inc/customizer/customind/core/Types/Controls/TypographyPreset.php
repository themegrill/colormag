<?php
/**
 * Typography control class.
 */

namespace Customind\Core\Types\Controls;

/**
 * Typography control class.
 */
class TypographyPreset extends AbstractControl {

	/**
	 * {@inheritDoc}
	 */
	public $type = 'customind-typography-preset';

	/**
	 * Allowed properties.
	 *
	 * @var string
	 */
	public $allowed_properties;
	public $heading_id;
	public $body_id;

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
		$this->heading_id         = $args['heading_id'] ?? '';
		$this->body_id            = $args['body_id'] ?? '';
	}

	/**
	 * {@inheritDoc}
	 */
	protected function json_allowed_props() {
		return array_merge(
			parent::json_allowed_props(),
			[
				'allowed_properties',
				'body_id',
				'heading_id',
			]
		);
	}
}
