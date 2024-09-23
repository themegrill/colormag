<?php
/**
 * Hook trait.
 */

namespace Customind\Core\Traits;

trait Hook {

	public static $hook_name = 'customind:';

	/**
	 * Adds a callback function to an action hook.
	 *
	 * @param string                $hook_name     The name of the filter to add the callback to.
	 * @param callable|string|array $callback      The callback to be run when the filter is applied.
	 * @param int                   $priority      Optional. Used to specify the order in which the functions
	 *                                                  associated with a particular filter are executed.
	 *                                                  Lower numbers correspond with earlier execution,
	 *                                                  and functions with the same priority are executed
	 *                                                  in the order in which they were added to the filter. Default 10.
	 * @param int                   $accepted_args Optional. The number of arguments the function accepts. Default 1.
	 *
	 * @return true Always returns true.
	 */
	public function add_action( string $hook_name, $callback, int $priority = 10, int $accepted_args = 1 ): bool {
		$hook_name = self::$hook_name . $hook_name;
		return add_action( $hook_name, $callback, $priority, $accepted_args );
	}

	/**
	 * Adds a callback function to a filter hook.
	 *
	 * @param string                $hook_name     The name of the filter to add the callback to.
	 * @param callable|string|array $callback      The callback to be run when the filter is applied.
	 * @param int                   $priority      Optional. Used to specify the order in which the functions
	 *                                                  associated with a particular filter are executed.
	 *                                                  Lower numbers correspond with earlier execution,
	 *                                                  and functions with the same priority are executed
	 *                                                  in the order in which they were added to the filter. Default 10.
	 * @param int                   $accepted_args Optional. The number of arguments the function accepts. Default 1.
	 *
	 * @return true Always returns true.
	 */
	public function add_filter( string $hook_name, $callback, int $priority = 10, int $accepted_args = 1 ): bool {
		$hook_name = self::$hook_name . $hook_name;
		return add_filter( $hook_name, $callback, $priority, $accepted_args );
	}

	/**
	 * Removes a callback function from an action hook.
	 *
	 * This can be used to remove default functions attached to a specific filter
	 * hook and possibly replace them with a substitute.
	 *
	 * To remove a hook, the `$callback` and `$priority` arguments must match
	 * when the hook was added. This goes for both filters and actions. No warning
	 * will be given on removal failure.
	 *
	 * @param string                $hook_name The filter hook to which the function to be removed is hooked.
	 * @param callable|string|array $callback  The callback to be removed from running when the filter is applied.
	 *                                         This function can be called unconditionally to speculatively remove
	 *                                         a callback that may or may not exist.
	 * @param int                   $priority  Optional. The exact priority used when adding the original
	 *                                                           filter callback. Default 10.
	 * @return bool Whether the function existed before it was removed.
	 */
	public function remove_action( string $hook_name, $callback, int $priority = 10 ): bool {
		$hook_name = self::$hook_name . $hook_name;
		return $this->remove_filter( $hook_name, $callback, $priority );
	}

	/**
	 * Removes a callback function from a filter hook.
	 *
	 * This can be used to remove default functions attached to a specific filter
	 * hook and possibly replace them with a substitute.
	 *
	 * To remove a hook, the `$callback` and `$priority` arguments must match
	 * when the hook was added. This goes for both filters and actions. No warning
	 * will be given on removal failure.
	 *
	 * @param string                $hook_name The filter hook to which the function to be removed is hooked.
	 * @param callable|string|array $callback  The callback to be removed from running when the filter is applied.
	 *                                         This function can be called unconditionally to speculatively remove
	 *                                         a callback that may or may not exist.
	 * @param int                   $priority  Optional. The exact priority used when adding the original
	 *                                         filter callback. Default 10.
	 * @return bool Whether the function existed before it was removed.
	 */
	public function remove_filter( string $hook_name, $callback, int $priority = 10 ): bool {
		$hook_name = self::$hook_name . $hook_name;
		return remove_filter( $hook_name, $callback, $priority );
	}


	/**
	 * Do action with customind as prefix.
	 *
	 * @param mixed ...$args Arguments.
	 * @return void
	 */
	public function do_action( ...$args ) {
		$hook_name = array_shift( $args );

		if ( is_null( $hook_name ) ) {
			return;
		}

		$hook_name = self::$hook_name . $hook_name;

		do_action_ref_array( $hook_name, array_merge( [], $args ) );
	}

	/**
	 * Apply filters with customind as prefix.
	 *
	 * @param mixed ...$args Arguments.
	 * @return mixed|void
	 */
	public function apply_filters( ...$args ) {
		$hook_name = array_shift( $args );

		if ( is_null( $hook_name ) ) {
			return false;
		}

		$hook_name = self::$hook_name . $hook_name;

		return apply_filters_ref_array( $hook_name, array_merge( [], $args ) );
	}
}
