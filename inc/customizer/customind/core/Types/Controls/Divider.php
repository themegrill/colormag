<?php
/**
 * Divider class.
 */
namespace Customind\Core\Types\Controls;

/**
 * Divider control class.
 */
class Divider extends AbstractControl {

	/**
	 * {@inheritDoc}
	 */
	public $type = 'customind-divider';

	/**
	 * Variant.
	 *
	 * @var string
	 */
	public $variant = 'solid';

	/**
	 * No X-spacing.
	 *
	 * @var boolean
	 */
	public $no_x_spacing = false;

	/**
	 * No Y-spacing.
	 *
	 * @var boolean
	 */
	public $no_y_spacing = false;

	/**
	 * {@inheritDoc}
	 */
	public function __construct( $manager, $id, $args = [] ) {
		parent::__construct( $manager, $id, $args );
		$this->variant      = $args['variant'] ?? 'solid';
		$this->no_x_spacing = $args['no_x_spacing'] ?? false;
		$this->no_y_spacing = $args['no_y_spacing'] ?? false;
		$this->no_border    = $args['no_border'] ?? false;
	}

	/**
	 * {@inheritDoc}
	 */
	protected function json_allowed_props() {
		return array_merge(
			parent::json_allowed_props(),
			[
				'variant',
				'no_x_spacing',
				'no_y_spacing',
				'no_border',
			]
		);
	}
}
