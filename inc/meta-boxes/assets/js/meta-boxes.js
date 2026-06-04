/**
 * Meta boxes JS for toggle meta box options.
 *
 * @package ColorMag
 */

/**
 * For video post format.
 */
jQuery( document ).ready(
	function () {

		// Hide the div by default.
		jQuery( '#post-video-url' ).hide();

		// If post format is selected, then, display the respective div.
		if ( jQuery( '#post-format-video' ).is( ':checked' ) ) {
			jQuery( '#post-video-url' ).show();
		}

		// Hiding the default post format type input box by default.
		jQuery( 'input[name="post_format"]' ).change(
			function () {
				jQuery( '#post-video-url' ).hide();
			}
		);

		// If post format is selected, then, display the respective input div.
		jQuery( 'input#post-format-video' ).change(
			function () {
				jQuery( '#post-video-url' ).show();
			}
		);

	}
);

jQuery( window ).on(
	'load',
	function() {

		var post_format_load = jQuery( 'select[id^="post-format-selector"] option:selected' ).attr( 'value' );

		// Proceed only if Gutenberg editor is available.
		if ( post_format_load ) {

			// Display Video URL meta box on page load if Video post format is already chosen.
			if ( 'video' === post_format_load ) {
				jQuery( '#post-video-url' ).show();
			} else {
				jQuery( '#post-video-url' ).hide();
			}

			// Display Video URL meta box on post format change and if  Video post format is chosen.
			jQuery( document ).on(
				'change',
				'select[id*="post-format"]',
				function () {
					var post_format_change = this.value;

					if ( 'video' === post_format_change ) {
						jQuery( '#post-video-url' ).show();
					} else {
						jQuery( '#post-video-url' ).hide();
					}
				}
			);
		}

	}
);

/**
 * Tabs and other settings.
 */
(
	function ( $ ) {

		// Generate tabs.
		var metaBoxWrap = $( '#page-settings-tabs-wrapper' );
		metaBoxWrap.tabs();

	}
)( jQuery );
