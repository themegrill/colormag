<?php
/**
 * Builder components control class.
 */

namespace Customind\Core\Types\Controls;

/**
 * Builder components control class.
 */
class BuilderComponents extends AbstractControl {

	/**
	 * {@inheritDoc}
	 */
	public $type = 'customind-builder-components';

	/**
	 * Group.
	 *
	 * @var string
	 */
	public $group = '';

	/**
	 * Context of the builder components.
	 *
	 * Either header or footer.
	 *
	 * @var string
	 */
	public $context = '';

	/**
	 * {@inheritDoc}
	 */
	public function __construct(
		$id,
		$manager,
		$args = []
	) {
		parent::__construct( $id, $manager, $args );
		$this->group   = $args['group'] ?? '';
		$this->context = $args['context'] ?? '';
	}

	/**
	 * {@inheritDoc}
	 */
	public function json_allowed_props() {
		return array_merge( parent::json_allowed_props(), [ 'group', 'context' ] );
	}
}
