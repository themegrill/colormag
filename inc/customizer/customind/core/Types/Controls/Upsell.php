<?php
/**
 * Upsell class.
 */

namespace Customind\Core\Types\Controls;

/**
 * Upsell class.
 */
class Upsell extends AbstractControl {

	/**
	 * {@inheritDoc}
	 */
	public $type = 'customind-upsell';

	/**
	 * Url to redirect.
	 *
	 * @var string
	 */
	public $url;

	/**
	 * {@inheritDoc}
	 */
	public function __construct(
		$id,
		$manager,
		$args = []
	) {
		parent::__construct( $id, $manager, $args );
		$this->url = $args['url'] ?? '';
	}

	/**
	 * {@inheritDoc}
	 */
	protected function json_allowed_props() {
		return array_merge(
			parent::json_allowed_props(),
			[
				'url',
			]
		);
	}
}
