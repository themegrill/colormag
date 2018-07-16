/* global pagenow */
( function( $, wp ) {
	$( function() {
		var $document = $( document );

		// Act as 'import' page to control Ajax events.
		if ( 'appearance_page_demo-importer' === pagenow ) {
			window.pagenow = 'import';
		}

		/**
		 * Click handler for importer plugins installs in the Demo Importer screen.
		 *
		 * @param {Event} event Event interface.
		 */
		$document.on( 'click', '.demo-importer .install-now', function( event ) {
			var $button = $( event.target ),
				pluginName = $( this ).data( 'name' );

			event.preventDefault();

			if ( $button.hasClass( 'updating-message' ) || $button.hasClass( 'button-disabled' ) ) {
				return;
			}

			if ( wp.updates.shouldRequestFilesystemCredentials && ! wp.updates.ajaxLocked ) {
				wp.updates.requestFilesystemCredentials( event );

				$document.on( 'credential-modal-cancel', function() {
					var $message = $( '.install-now.updating-message' );

					$message
						.removeClass( 'updating-message' )
						.text( wp.updates.l10n.installNow )
						.attr( 'aria-label', wp.updates.l10n.installNowLabel.replace( '%s', pluginName ) );

					wp.a11y.speak( wp.updates.l10n.updateCancel, 'polite' );
				} );
			}

			wp.updates.installPlugin( {
				slug: $button.data( 'slug' ),
				pagenow: pagenow,
				success: wp.updates.installImporterSuccess,
				error:   wp.updates.installImporterError
			} );
		} );
	} );
})( jQuery, window.wp );
