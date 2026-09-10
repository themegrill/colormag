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
		// single click instead of "choose, then go find Publish too". Only
		// remove the card once the publish is confirmed; on failure
		// (expired nonce, lost connection, a client-side validation error)
		// leave it in place and re-enable the button so nothing looks
		// silently lost.
		$card.on( 'click', '.colormag-sc-keep', function () {
			var $button = $( this );
			$button.prop( 'disabled', true );

			var status = api.state( 'selectedChangesetStatus' );
			if ( status ) {
				status.set( 'publish' );
			}

			if ( ! api.previewer ) {
				$card.slideUp( 150, function () {
					$card.remove();
				} );
				return;
			}

			api.previewer.save().done( function () {
				$card.slideUp( 150, function () {
					$card.remove();
				} );
			} ).fail( function () {
				$button.prop( 'disabled', false );
			} );
		} );

		// Clean slate: trash the current changeset first — via core's own
		// customize_trash action, the same one behind the Customizer's own
		// "Discard changes" button — so the staged Home/Blog pages can't be
		// resurrected by a later Customizer session reusing the same
		// auto-draft changeset (WordPress reuses it by default when
		// changeset branching is off). "Nothing to trash yet" is treated
		// as success too: it just means nothing was staged yet, which is
		// already the clean-slate outcome. Only then flip 'fresh_site' and
		// reload; on any other failure, leave the notice in place and
		// re-enable the button so the user can retry.
		$card.on( 'click', '.colormag-sc-clean', function () {
			var $button = $( this );
			$button.prop( 'disabled', true );

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
						$button.prop( 'disabled', false );
					}
				} ).fail( function () {
					$button.prop( 'disabled', false );
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
					nonce: trashNonce,
				}
			).done( function ( response ) {
				var nothingToTrash = response && response.data && 'non_existent_changeset' === response.data.code;
				if ( ( response && response.success ) || nothingToTrash ) {
					dismissAndReload();
				} else {
					$button.prop( 'disabled', false );
				}
			} ).fail( function () {
				$button.prop( 'disabled', false );
			} );
		} );
	} );
} )( wp.customize, jQuery );
