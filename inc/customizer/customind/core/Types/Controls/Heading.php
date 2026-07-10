<?php
/**
 * Heading class.
 */

namespace Customind\Core\Types\Controls;

/**
 * Heading class.
 */
class Heading extends AbstractControl {

	/**
	 * {@inheritDoc}
	 */
	public $type = 'customind-heading';

	/**
	 * Always-visible info notice text shown below the heading label.
	 *
	 * @var string
	 */
	public $info_text;

	/**
	 * Whether to show a "Pro" badge with an upsell tooltip next to the label.
	 *
	 * @var bool
	 */
	public $pro;

	/**
	 * Upgrade URL used by the Pro badge tooltip's CTA button.
	 *
	 * @var string
	 */
	public $pro_url;

	/**
	 * {@inheritDoc}
	 *
	 * @param \WP_Customize_Manager $manager Customizer bootstrap instance.
	 * @param string                $id      Control ID.
	 * @param array                 $args    Arguments.
	 */
	public function __construct( $manager, $id, $args = array() ) {
		parent::__construct( $manager, $id, $args );
		$this->info_text = $args['info_text'] ?? '';
		$this->pro       = ! empty( $args['pro'] );
		$this->pro_url   = $args['pro_url'] ?? '';
	}

	/**
	 * {@inheritDoc}
	 */
	protected function json_allowed_props() {
		return array_merge(
			parent::json_allowed_props(),
			array( 'info_text', 'pro', 'pro_url' )
		);
	}
}
