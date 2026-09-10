/**
 * ColorMag starter-content "fresh site" notice.
 *
 * On a fresh site, WordPress core itself stages the starter homepage and
 * its Header/Footer Builder chrome (see class-colormag-starter-content.php)
 * the moment the Customizer loads, through the plain declarative
 * add_theme_support('starter-content', ...) array — no extra staging call
 * needed here. This notice just lets the user choose what happens to
 * what's already staged:
 *
 *  - Keep the starter homepage : publish the changeset as-is, same as
 *                                  clicking the Customizer's own Publish
 *                                  button.
 *  - Start with a clean slate  : flip the 'fresh_site' option off and
 *                                  reload. WordPress core's own starter-
 *                                  content importer only ever runs while
 *                                  that option is set, so the next
 *                                  Customizer load never stages anything
 *                                  again — nothing to manually undo.
 *
 * @package ColorMag
 */
( function ( api, $ ) {
	'use strict';

	api.bind( 'ready', function () {

		var data = window.colormagStarterContent || {};

		var $card = $(
			'<div class="colormag-sc-notice">' +
				'<h3></h3>' +
				'<p></p>' +
				'<button type="button" class="button button-primary colormag-sc-keep"></button>' +
				'<button type="button" class="button colormag-sc-clean"></button>' +
				'<p class="colormag-sc-note"></p>' +
			'</div>'
		);

		// Use text() so localized strings are inserted safely.
		$card.find( 'h3' ).text( data.title || '' );
		$card.find( 'p' ).first().text( data.message || '' );
		$card.find( '.colormag-sc-keep' ).text( data.keep || '' );
		$card.find( '.colormag-sc-clean' ).text( data.clean || '' );
		$card.find( '.colormag-sc-note' ).text( data.note || '' );

		$( '#customize-theme-controls' ).prepend( $card );

		// Only show on the root (first) screen — hide as soon as the user
		// navigates into any panel or section, restore it when they go back.
		var toggleCardVisibility = function () {
			var expanded = api.state( 'expandedPanel' ).get() || api.state( 'expandedSection' ).get();
			$card.toggle( ! expanded );
		};

		api.state( 'expandedPanel' ).bind( toggleCardVisibility );
		api.state( 'expandedSection' ).bind( toggleCardVisibility );
		toggleCardVisibility();

		// Same thing clicking the Customizer's own Publish button does — a
		// single click instead of "choose, then go find Publish too".
		$card.on( 'click', '.colormag-sc-keep', function () {
			$( this ).prop( 'disabled', true );

			var status = api.state( 'selectedChangesetStatus' );
			if ( status ) {
				status.set( 'publish' );
			}
			if ( api.previewer ) {
				api.previewer.save();
			}

			$card.slideUp( 150, function () {
				$card.remove();
			} );
		} );

		// Clean slate: nothing to unstage client-side — flipping 'fresh_site'
		// server-side and reloading is enough, since core never stages the
		// starter content again once that option is off.
		$card.on( 'click', '.colormag-sc-clean', function () {
			$( this ).prop( 'disabled', true );

			$.post(
				window.ajaxurl,
				{
					action: 'colormag_dismiss_starter_content',
					nonce: data.nonce,
				}
			).always( function () {
				window.location.reload();
			} );
		} );
	} );
} )( wp.customize, jQuery );
