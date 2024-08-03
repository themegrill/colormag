<?php

namespace Customind\Core\Types\Controls;

class ColorPalette extends AbstractControl {
	public $type    = 'customind-color-palette';
	public $presets = [];

	public function __construct(
		$id,
		$manager,
		$args = []
	) {
		parent::__construct( $id, $manager, $args );
		$this->presets = $args['presets'] ?? [];
	}

	/**
	 * Json allowed props.
	 *
	 * @return void
	 */
	public function json_allowed_props() {
		return array_merge( parent::json_allowed_props(), [ 'presets' ] );
	}
}
