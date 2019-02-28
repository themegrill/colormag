/**
 * Remove activate button and replace with activation in progress button.
 *
 * @package ColorMag
 */

jQuery( document ).ready(
	function ( $ ) {
		$.pluginInstall = {
			'init' : function () {
				this.handleInstall();
				this.handleActivate();
			},

			'handleInstall' : function () {
				var self = this;
				$( 'body' ).on( 'click', '.colormag-install-plugin', function ( e ) {
					e.preventDefault();
					var button   = $( this );
					var slug     = button.attr( 'data-slug' );
					var url      = button.attr( 'href' );
					var redirect = $( button ).attr( 'data-redirect' );
					button.text( wp.updates.l10n.installing );
					button.addClass( 'updating-message' );
					wp.updates.installPlugin(
						{
							slug    : slug,
							success : function () {
								button.text( colormag_plugin_helper.activating + '...' );
								self.activatePlugin( url, redirect );
							}
						}
					);
				} );
			},

			'activatePlugin' : function ( url, redirect ) {
				if ( typeof url === 'undefined' || ! url ) {
					return;
				}
				jQuery.ajax(
					{
						async   : true,
						type    : 'GET',
						url     : url,
						success : function () {
							// Reload the page.
							if ( typeof (
								redirect
							) !== 'undefined' && redirect !== '' ) {
								window.location.replace( redirect );
							} else {
								location.reload();
							}
						},
						error   : function ( jqXHR, exception ) {
							var msg = '';
							if ( jqXHR.status === 0 ) {
								msg = 'Not connect.\n Verify Network.';
							} else if ( jqXHR.status === 404 ) {
								msg = 'Requested page not found. [404]';
							} else if ( jqXHR.status === 500 ) {
								msg = 'Internal Server Error [500].';
							} else if ( exception === 'parsererror' ) {
								msg = 'Requested JSON parse failed.';
							} else if ( exception === 'timeout' ) {
								msg = 'Time out error.';
							} else if ( exception === 'abort' ) {
								msg = 'Ajax request aborted.';
							} else {
								msg = 'Uncaught Error.\n' + jqXHR.responseText;
							}
							console.log( msg );
						}
					}
				);
			},

			'handleActivate' : function () {
				var self = this;
				$( 'body' ).on( 'click', '.activate-now', function ( e ) {
					e.preventDefault();
					var button   = $( this ),
					    url      = button.attr( 'href' );
					var redirect = button.attr( 'data-redirect' );
					button.addClass( 'updating-message' );
					button.text( colormag_plugin_helper.activating + '...' );
					self.activatePlugin( url, redirect );
				} );
			}
		};
		$.pluginInstall.init();
	}
);

/**
 * Import button
 */
jQuery( document ).ready( function ( $ ) {

	$( '.btn-get-started' ).click( function ( e ) {
		e.preventDefault();
		var extra_uri, redirect_uri, state, dismiss_nonce;

		// Show About > import button while processing.
		if ( jQuery( this ).parents( '.theme-actions' ).length ) {
			jQuery( this ).parents( '.theme-actions' ).css( 'opacity', '1' );
		}

		// Show updating gif icon.
		jQuery( this ).addClass( 'updating-message' );

		// Change button text.
		jQuery( this ).text( colormag_redirect_demo_page.btn_text );

		// Assign `TG demo importer` plugin state for processing from PHP.
		if ( $( this ).hasClass( 'tdi-activated' ) ) { // Installed and activated.
			state = 'activated';
		} else if ( $( this ).hasClass( 'tdi-installed' ) ) { // Installed but not activated.
			state = 'installed';
		} else { // Not installed.
			state = '';
		}

		var data = {
			action   : 'import_button',
			security : colormag_redirect_demo_page.nonce,
			state    : state
		};

		$.ajax( {
			type    : "POST",
			url     : ajaxurl, // URL to "wp-admin/admin-ajax.php"
			data    : data,
			success : function ( response ) {
				extra_uri = '';
				if ( jQuery( '.colormag-message-close' ).length ) {
					dismiss_nonce = jQuery( '.colormag-message-close' ).attr( 'href' ).split( '_colormag_notice_nonce=' )[1];
					extra_uri     = '&_colormag_notice_nonce=' + dismiss_nonce;
				}

				redirect_uri         = response.redirect + extra_uri;
				window.location.href = redirect_uri;
			},
			error   : function ( xhr, ajaxOptions, thrownError ) {
				console.log( thrownError );
			}
		} );

	} );
} );
