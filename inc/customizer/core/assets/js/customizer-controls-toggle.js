/**
 * Customizer controls toggle.
 *
 * @package ColorMag
 */

(
	function ( $ ) {

		/* Internal shorthand */
		var api = wp.customize;

		/**
		 * Trigger hooks
		 */
		ColorMagControlTrigger = {

			/**
			 * Trigger a hook.
			 *
			 * @method triggerHook
			 * @param {String} hook The hook to trigger.
			 * @param {Array} args An array of args to pass to the hook.
			 */
			triggerHook : function ( hook, args ) {
				$( 'body' ).trigger( 'colormag-control-trigger.' + hook, args );
			},

			/**
			 * Add a hook.
			 *
			 * @method addHook
			 * @param {String} hook The hook to add.
			 * @param {Function} callback A function to call when the hook is triggered.
			 */
			addHook : function ( hook, callback ) {
				$( 'body' ).on( 'colormag-control-trigger.' + hook, callback );
			},

			/**
			 * Remove a hook.
			 *
			 * @method removeHook
			 * @param {String} hook The hook to remove.
			 * @param {Function} callback The callback function to remove.
			 */
			removeHook : function ( hook, callback ) {
				$( 'body' ).off( 'colormag-control-trigger.' + hook, callback );
			}

		};

		/**
		 * Helper class that contains data for showing and hiding controls.
		 *
		 * @class ColorMagCustomizerToggles
		 */
		ColorMagCustomizerToggles = {

			'colormag_header_image_link' : [],

		};

	}
)( jQuery );
