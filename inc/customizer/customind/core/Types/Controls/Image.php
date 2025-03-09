<?php
/**
 * Image control class.
 */
namespace Customind\Core\Types\Controls;

/**
 * Image control class.
 */
class Image extends AbstractControl {

	/**
	 * {@inheritDoc}
	 */
	public $type = 'customind-image';

	/**
	 * Select label.
	 *
	 * @var string|null
	 */
	public $select_label;

	/**
	 * Crop.
	 *
	 * @var array|null
	 */
	public $crop;

	/**
	 * {@inheritDoc}
	 */
	public function __construct( $manager, $id, $args = [] ) {
		parent::__construct( $manager, $id, $args );
		$this->crop         = $args['crop'] ?? null;
		$this->select_label = $args['select_label'] ?? null;
	}

	/**
	 * {@inheritDoc}
	 */
	protected function json_allowed_props() {
		return array_merge(
			parent::json_allowed_props(),
			[
				'crop',
				'select_label',
			]
		);
	}
}
