<?php
/**
 * Abstract group control.
 */
namespace Customind\Core\Types\Controls;

use Customind\Core\Factories\TypeFactory;
use Customind\Core\Sanitization;

/**
 * Abstract group control.
 */
abstract class AbstractGroupControl extends AbstractControl {

	/**
	 * Sub controls.
	 *
	 * @var array
	 */
	public $sub_controls = [];

	/**
	 * {@inheritDoc}
	 */
	public function __construct( $manager, $id, $args = [] ) {
		$this->register_sub_controls(
			$manager,
			$args
		);
		parent::__construct( $manager, $id, $args );
	}

	/**
	 * Register sub controls.
	 *
	 * @param \WP_Customize_Manager $manager
	 * @param array                 $args
	 */
	protected function register_sub_controls( $manager, $args ) {
		if ( empty( $args['sub_controls'] ) ) {
			return;
		}
		$sub_controls = $args['sub_controls'];
		uasort(
			$sub_controls,
			function ( $a, $b ) {
				$a_priority = $a['priority'] ?? 10;
				$b_priority = $b['priority'] ?? 10;
				if ( $a_priority === $b_priority ) {
					return 0;
				}
				return ( $a_priority < $b_priority ) ? -1 : 1;
			}
		);
		foreach ( $sub_controls as $sub_control_id => $sub_control_args ) {
			$sub_control_args = $this->prepare_sub_control_args( $sub_control_args );
			$manager->add_setting(
				$sub_control_id,
				[
					'default'           => $sub_control_args['default'] ?? '',
					'transport'         => $sub_control_args['transport'] ?? 'refresh',
					'type'              => 'theme_mod',
					'sanitize_callback' => ( new Sanitization() )->get_sanitization_callback( $sub_control_args['type'] ),
				]
			);
			try {
				$type        = $sub_control_args['type'];
				$sub_control = TypeFactory::create(
					$type,
					$manager,
					$sub_control_id,
					$sub_control_args
				);
				$manager->add_control( $sub_control );
				$this->sub_controls[] = $sub_control->json();
			} catch ( \InvalidArgumentException $e ) {
				_doing_it_wrong( __FUNCTION__, esc_html( $e->getMessage() ), null );
				continue;
			}
		}
	}

	/**
	 * Prepare sub control args.
	 *
	 * @param array $sub_control_args
	 * @return array
	 */
	protected function prepare_sub_control_args( $sub_control_args ) {
		$sub_control_args = array_merge(
			$sub_control_args,
			[
				'is_sub_control' => true,
			]
		);
		return $sub_control_args;
	}

	/**
	 * {@inheritDoc}
	 */
	protected function json_allowed_props() {
		return array_merge( parent::json_allowed_props(), [ 'sub_controls' ] );
	}
}
