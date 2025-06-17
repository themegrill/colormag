<?php
/**
 * Upgrade class.
 */

namespace Customind\Core\Types\Controls;

/**
 * Upgrade class.
 */
class Upgrade extends AbstractControl {

	/**
	 * {@inheritDoc}
	 */
	public $type = 'customind-upgrade';

	/**
	 * URL to redirect.
	 *
	 * @var string
	 */
	public $url;

	/**
	 * Description text.
	 *
	 * @var string
	 */
	public $description;

	/**
	 * Button label.
	 *
	 * @var string
	 */
	public $label;

	/**
	 * Points array.
	 *
	 * @var array
	 */
	public $points = [];

	/**
	 * {@inheritDoc}
	 */
	public function __construct(
		$id,
		$manager,
		$args = []
	) {
		parent::__construct($id, $manager, $args);
		$this->url = $args['url'] ?? '';
		$this->description = $args['description'] ?? '';
		$this->label = $args['label'] ?? '';
		$this->points = $args['points'] ?? [];
	}

	/**
	 * {@inheritDoc}
	 */
	protected function json_allowed_props() {
		return array_merge(
			parent::json_allowed_props(),
			[
				'url',
				'description',
				'label',
				'points',
			]
		);
	}
}
