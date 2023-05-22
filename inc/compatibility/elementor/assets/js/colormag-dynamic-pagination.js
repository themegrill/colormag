/**
 * Dynamic pagination in widgets.
 */
jQuery( document ).ready(
	function () {

		jQuery( 'body' ).on(
			'click',
			'.widget-pagination a',
			function ( e ) {
				e.preventDefault();

				// Current Page.
				var link, container, dataId, modWrapper;
				link = jQuery( this ).attr( 'href' );

				container = jQuery( this ).parents( '.elementor-widget-container' );

				dataId = container.closest( '.elementor-element' ).attr( 'data-id' );

				modWrapper = jQuery( this ).closest( '.tg-module-wrapper' );

				container.height( modWrapper.outerHeight() );

				modWrapper.removeClass( 'tg-fade-in' );

				// Load content.
				var result = container.load(
					link + ' [data-id="' + dataId + '"] .tg-module-wrapper',
					function () {
						jQuery( this ).css( 'height', 'auto' );
					}
				);
			}
		);

	}
);
