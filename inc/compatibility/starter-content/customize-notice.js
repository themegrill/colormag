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
		//
		// Bails the same way Clean does if core is already saving or
		// trashing: save() itself only guards against a second save
		// (rejecting with 'already_saving'), not against a native Discard
		// that's currently trashing — calling it anyway would race
		// publishing the starter content against trashing it.
		$card.on( 'click', '.colormag-sc-keep', function () {
			if ( api.state( 'saving' ).get() || api.state( 'trashing' ).get() ) {
				return;
			}

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
		//
		// core's own trashing state is set for the full two-request
		// operation (not just while our own buttons are disabled): the
		// native Publish button's own canSave check includes
		// `&& ! trashing()`, so this also blocks it from racing this
		// action — the same protection core's own previewer.trash() would
		// give, which isn't used directly here because it navigates away
		// immediately on success, before our own fresh_site dismiss call
		// would get a chance to run.
		$card.on( 'click', '.colormag-sc-clean', function () {
			// Bail rather than queue: if a native Publish is already
			// saving, waiting for it to finish would just let Home/Blog
			// publish first — trashing afterwards cannot undo that. If a
			// native Discard is already trashing, proceeding would fire a
			// redundant trash request and core may navigate away before
			// our own fresh_site dismiss call gets to run. Either way the
			// safe thing is to do nothing and leave the notice as is; the
			// user can click Clean again once the native action settles.
			if ( api.state( 'saving' ).get() || api.state( 'trashing' ).get() ) {
				return;
			}

			$buttons.prop( 'disabled', true );
			beginCleanSlate();
		} );

		function beginCleanSlate() {
			var trashNonce = ( api.settings.nonce || {} ).trash;
			var blockedNativeControls = false;

			function endBusy() {
				if ( blockedNativeControls ) {
					api.state( 'processing' ).set( api.state( 'processing' ).get() - 1 );
					api.state( 'trashing' ).set( false );
				}
				$buttons.prop( 'disabled', false );
			}

			// Drop 'changeset_uuid' before reloading — otherwise, with
			// changeset branching on (or if that param was in the URL to
			// begin with), the reload would reopen the very changeset that
			// was just trashed instead of starting a clean session. Mirrors
			// what core's own trash-success handler does to its URL.
			function reloadWithoutChangeset() {
				var urlParser = document.createElement( 'a' );
				urlParser.href = window.location.href;
				var params = api.utils.parseQueryString( urlParser.search.substr( 1 ) );
				delete params.changeset_uuid;
				urlParser.search = $.param( params );
				window.location.replace( urlParser.href );
			}

			// Only called once the changeset is confirmed gone (trashed, or
			// already was). Always reloads, even if this dismiss call
			// itself fails: re-enabling native Publish/Discard here
			// instead would let the user try to publish or re-trash a
			// changeset that no longer exists. A failed dismiss just means
			// fresh_site is still set, so the notice reappears after
			// reload and a retry finds nothing left to trash.
			function dismissAndReload() {
				$.post(
					window.ajaxurl,
					{
						action: 'colormag_dismiss_starter_content',
						nonce: data.nonce,
					}
				).always( function () {
					reloadWithoutChangeset();
				} );
			}

			if ( ! trashNonce ) {
				// No nonce means the trash request can't even be attempted
				// — treat that as a failure rather than dismissing anyway,
				// since skipping the trash would leave the staged
				// changeset (and Home/Blog) intact for a later session to
				// publish despite "clean slate" having been chosen.
				endBusy();
				return;
			}

			blockedNativeControls = true;
			api.state( 'trashing' ).set( true );
			api.state( 'processing' ).set( api.state( 'processing' ).get() + 1 );

			$.post(
				window.ajaxurl,
				{
					action: 'customize_trash',
					customize_changeset_uuid: api.settings.changeset.uuid,
					nonce: trashNonce,
				}
			).done( function ( response ) {
				// Both are acceptable preconditions for "already clean",
				// not failures: nothing was ever staged, or a retry finds
				// an earlier attempt already trashed it server-side. Core's
				// own trash client treats both the same way.
				var code = response && response.data && response.data.code;
				var alreadyClean = 'non_existent_changeset' === code || 'changeset_already_trashed' === code;
				if ( ( response && response.success ) || alreadyClean ) {
					dismissAndReload();
				} else {
					endBusy();
				}
			} ).fail( function () {
				endBusy();
			} );
		}
	} );
} )( wp.customize, jQuery );
