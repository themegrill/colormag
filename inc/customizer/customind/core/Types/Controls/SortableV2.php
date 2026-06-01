<?php

namespace Customind\Core\Types\Controls;

class SortableV2 extends AbstractGroupControl {
	public $type = 'customind-sortable-v2';

	public $collapsible;

	public $choices = [];

	public function __construct(
		$manager,
		$id,
		$args = []
	) {
		// If choices are provided, register all controls from all choices
		if ( ! empty( $args['choices'] ) ) {
			$all_controls = [];
			foreach ( $args['choices'] as $choice_id => $choice ) {
				if ( ! empty( $choice['controls'] ) && is_array( $choice['controls'] ) ) {
					foreach ( $choice['controls'] as $control_id => $control_args ) {
						$all_controls[ $control_id ] = $control_args;
					}
				}
			}
			// Merge with existing sub_controls if any
			if ( ! empty( $args['sub_controls'] ) ) {
				$args['sub_controls'] = array_merge( $args['sub_controls'], $all_controls );
			} else {
				$args['sub_controls'] = $all_controls;
			}
		}

		parent::__construct( $manager, $id, $args );
		$this->collapsible = $args['collapsible'] ?? true;
		$this->choices     = $args['choices'] ?? [];
	}

	protected function json_allowed_props() {
		return array_merge(
			parent::json_allowed_props(),
			[
				'collapsible',
				'choices',
			]
		);
	}
}
