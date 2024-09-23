<?php

namespace Customind\Core\Types\Controls;

class Tabs extends AbstractGroupControl {

	/**
	 * {@inheritDoc}
	 */
	public $type = 'customind-tabs';

	public $tabs;

	/**
	 * {@inheritDoc}
	 */
	public function __construct(
		$id,
		$manager,
		$args = []
	) {
		parent::__construct( $id, $manager, $args );
		$this->tabs = $args['tabs'] ?? [];
	}

	/**
	 * {@inheritDoc}
	 */
	protected function json_allowed_props() {
		return array_merge(
			parent::json_allowed_props(),
			[
				'tabs',
			]
		);
	}
}
