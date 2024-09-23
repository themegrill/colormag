<?php

namespace Customind\Core\Types\Controls;

class Accordion extends AbstractGroupControl {
	public $type = 'customind-accordion';

	public $collapsible;

	public function __construct(
		$id,
		$manager,
		$args = []
	) {
		parent::__construct( $id, $manager, $args );
		$this->collapsible = $args['collapsible'] ?? true;
	}

	protected function json_allowed_props() {
		return array_merge(
			parent::json_allowed_props(),
			[
				'collapsible',
			]
		);
	}
}
