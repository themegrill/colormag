/**
 * ColorMag starter-content "fresh site" notice.
 *
 * On a fresh site, WordPress core itself stages the starter pages (Home
 * and Blog) and their Header/Footer Builder chrome (see
 * class-colormag-starter-content.php) the moment the Customizer loads,
 * through the plain declarative add_theme_support('starter-content', ...)
 * array — no extra staging call needed here. This notice just lets the
 * user choose what happens to what's already staged:
 *
 *  - Keep the starter pages    : publish the changeset as-is, same as
 *                                  clicking the Customizer's own Publish
 *                                  button.
 *  - Start with a clean slate  : trash the current changeset (core's own
 *                                  "Discard changes" action — otherwise
 *                                  the same auto-draft changeset would
 *                                  just get reused, and Home/Blog could
 *                                  still end up published later), then
 *                                  flip 'fresh_site' off so core's
 *                                  starter-content importer never stages
 *                                  anything again, then reload.
 *
 * Both actions disable BOTH buttons while in flight (not just the one
 * clicked) so a publish and a discard can never race each other.
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

		var $buttons = $card.find( '.colormag-sc-keep, .colormag-sc-clean' );

		function hideCard() {
			$card.slideUp( 150, function () {
				$card.remove();
			} );
		}

		// Whatever publishes the changeset — our own Keep button below, OR
		// the Customizer's own native Publish button — this fires. Covers
		// both, so the card never sticks around offering "clean slate" for
		// content that's already been published another way.
		api.bind( 'saved', function ( response ) {
			if ( response && 'publish' === response.changeset_status ) {
				hideCard();
			}
		} );

		// Same thing clicking the Customizer's own Publish button does — a
		// single click instead of "choose, then go find Publish too". The
		// card itself is removed by the 'saved' handler above once the
		// publish is actually confirmed; on failure (expired nonce, lost
		// connection, a client-side validation error) both buttons are
		// re-enabled so nothing looks silently lost.
		$card.on( 'click', '.colormag-sc-keep', function () {
			$buttons.prop( 'disabled', true );

			var status = api.state( 'selectedChangesetStatus' );
			if ( status ) {
				status.set( 'publish' );
			}

			if ( ! api.previewer ) {
				hideCard();
				return;
			}

			api.previewer.save().fail( function () {
				$buttons.prop( 'disabled', false );
			} );
		} );

		// Clean slate: trash the current changeset first — via core's own
		// customize_trash action (same request shape core's own "Discard
		// changes" button sends, including the changeset UUID so the
		// right changeset is targeted), so the staged Home/Blog pages
		// can't be resurrected by a later Customizer session reusing the
		// same auto-draft changeset (WordPress reuses it by default when
		// changeset branching is off). "Nothing to trash yet" is treated
		// as success too: it just means nothing was staged yet, which is
		// already the clean-slate outcome. Only then flip 'fresh_site' and
		// reload; on any other failure, re-enable both buttons so the user
		// can retry.
		$card.on( 'click', '.colormag-sc-clean', function () {
			$buttons.prop( 'disabled', true );

			var trashNonce = ( api.settings.nonce || {} ).trash;

			function dismissAndReload() {
				$.post(
					window.ajaxurl,
					{
						action: 'colormag_dismiss_starter_content',
						nonce: data.nonce,
					}
				).done( function ( response ) {
					if ( response && response.success ) {
						window.location.reload();
					} else {
						$buttons.prop( 'disabled', false );
					}
				} ).fail( function () {
					$buttons.prop( 'disabled', false );
				} );
			}

			if ( ! trashNonce ) {
				dismissAndReload();
				return;
			}

			$.post(
				window.ajaxurl,
				{
					action: 'customize_trash',
					customize_changeset_uuid: api.settings.changeset.uuid,
					nonce: trashNonce,
				}
			).done( function ( response ) {
				var nothingToTrash = response && response.data && 'non_existent_changeset' === response.data.code;
				if ( ( response && response.success ) || nothingToTrash ) {
					dismissAndReload();
				} else {
					$buttons.prop( 'disabled', false );
				}
			} ).fail( function () {
				$buttons.prop( 'disabled', false );
			} );
		} );
	} );
} )( wp.customize, jQuery );
