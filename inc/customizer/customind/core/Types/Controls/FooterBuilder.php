<?php
/**
 * Footer builder control class.
 */
namespace Customind\Core\Types\Controls;

/**
 * Footer builder control class.
 */
class FooterBuilder extends AbstractControl {

	/**
	 * {@inheritDoc}
	 */
	public $type = 'customind-footer-builder';

	/**
	 * Builder components.
	 *
	 * @var array
	 */
	public $components;

	/**
	 * Builder areas.
	 *
	 * @var array
	 */
	public $areas;

	public $top_row_controls    = [];
	public $main_row_controls   = [];
	public $bottom_row_controls = [];

	/**
	 * {@inheritDoc}
	 */
	public function __construct( $manager, $id, $args = [] ) {
		parent::__construct( $manager, $id, $args );
		$this->components          = $args['components'] ?? [];
		$this->areas               = $args['areas'] ?? [];
		$this->top_row_controls    = $args['top_row_controls'] ?? [];
		$this->main_row_controls   = $args['main_row_controls'] ?? [];
		$this->bottom_row_controls = $args['bottom_row_controls'] ?? [];
	}

	/**
	 * {@inheritDoc}
	 */
	protected function json_allowed_props() {
		return array_merge(
			parent::json_allowed_props(),
			[
				'components',
				'areas',
				'top_row_controls',
				'main_row_controls',
				'bottom_row_controls',
			]
		);
	}
}
