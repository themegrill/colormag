/**
 * Image upload JS setting.
 */

jQuery( document ).ready(
	function ( $ ) {
		var file_frame;

		/**
		 * Render the stored image above its input.
		 *
		 * @param {jQuery} [$context] Container to search within. Defaults to the whole document.
		 */
		function initPreviews( $context ) {
			$context = ( $context && $context.length ) ? $context : $( document );

			$context.find( 'input.custom_media_input' ).each(
				function () {
					var preview_image  = $( this ).val(),
					    preview_target = $( this ).siblings( '.custom_media_preview' );

					// Initialize image previews.
					if ( preview_image !== '' ) {
						// Replace rather than append, so a re-render cannot stack images.
						preview_target.empty();
						preview_target.css( { display : 'block' } ).append( '<img src="' + preview_image + '" style="max-width:100%">' );
					}
				}
			);
		}

		$( document.body ).on(
			'click',
			'.custom_media_upload',
			function ( event ) {
				var $el                 = $( this );
				var file_target_input   = $el.parent().find( '.custom_media_input' );
				var file_target_preview = $el.parent().find( '.custom_media_preview' );

				event.preventDefault();

				// Create the media frame.
				file_frame = wp.media.frames.media_file = wp.media(
					{
						// Set the title of the modal.
						title  : $el.data( 'choose' ),
						button : {
							text : $el.data( 'update' )
						},
						states : [
							new wp.media.controller.Library(
								{
									title   : $el.data( 'choose' ),
									library : wp.media.query( { type : 'image' } )
								}
							)
						]
					}
				);

				// When an image is selected, run a callback.
				file_frame.on(
					'select',
					function () {
						// Get the attachment from the modal frame.
						var attachment = file_frame.state().get( 'selection' ).first().toJSON();

						// Initialize input and preview change.
						file_target_input.val( attachment.url ).change();
						file_target_preview.css( { display : 'none' } ).find( 'img' ).remove();
						file_target_preview.css( { display : 'block' } ).append( '<img src="' + attachment.url + '" style="max-width:100%">' );
					}
				);

				// Finally, open the modal.
				file_frame.open();
			}
		);

		// Media Uploader Preview.
		initPreviews();

		/*
		 * The block widget editor and the Customizer render widget forms into the
		 * DOM long after document ready, so the pass above never reaches them.
		 * WordPress fires these events with the newly rendered widget container.
		 */
		$( document ).on(
			'widget-added widget-updated',
			function ( event, widget ) {
				initPreviews( widget );
			}
		);
	}
);
