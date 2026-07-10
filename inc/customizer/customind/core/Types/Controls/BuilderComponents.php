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
	 * Navigation items shown in the "Settings" tab, below the used components
	 * (e.g. Sticky header, Transparent header).
	 *
	 * @var array
	 */
	public $type_items = [];

	/**
	 * Pro-only components shown (non-interactive, with a PRO badge) at the end of the
	 * "Available Components" list in the "Components" tab.
	 *
	 * @var array
	 */
	public $pro_items = [];

	/**
	 * {@inheritDoc}
	 */
	public function __construct(
		$id,
		$manager,
		$args = []
	) {
		parent::__construct( $id, $manager, $args );
		$this->group      = $args['group'] ?? '';
		$this->context    = $args['context'] ?? '';
		$this->type_items = $args['type_items'] ?? [];
		$this->pro_items  = $args['pro_items'] ?? [];
	}

	/**
	 * {@inheritDoc}
	 */
	public function json_allowed_props() {
		return array_merge( parent::json_allowed_props(), [ 'group', 'context', 'type_items', 'pro_items' ] );
	}
}
