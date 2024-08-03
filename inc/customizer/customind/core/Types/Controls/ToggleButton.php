<?php
/**
 * Toggle button control class.
 */

namespace Customind\Core\Types\Controls;

/**
 * Toggle button control class.
 */
class ToggleButton extends AbstractControl {

	/**
	 * {@inheritDoc}
	 */
	public $type = 'customind-toggle-button';

	/**
	 * Allow multiple selection.
	 *
	 * @var boolean
	 */
	public $multiple = false;

	/**
	 * Allow responsive toggle button.
	 *
	 * @var boolean
	 */
	public $responsive = false;

	/**
	 * Allow html.
	 *
	 * @var boolean
	 */
	public $has_html = false;

	/**
	 * Columns.
	 *
	 * @var boolean
	 */
	public $columns = 3;

	/**
	 * {@inheritDoc}
	 */
	public function __construct(
		$id,
		$manager,
		$args = []
	) {
		parent::__construct( $id, $manager, $args );
		$this->multiple   = $args['multiple'] ?? false;
		$this->responsive = $args['responsive'] ?? false;
		$this->has_html   = $args['has_html'] ?? false;
		$this->columns    = $args['columns'] ?? 3;
	}

	/**
	 * {@inheritDoc}
	 */
	protected function json_allowed_props() {
		return array_merge(
			parent::json_allowed_props(),
			[
				'responsive',
				'multiple',
				'has_html',
				'columns',
			]
		);
	}
}
