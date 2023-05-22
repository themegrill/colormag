/**
 * Dynamic loading of posts via Ajax for style 3 widget.
 */

/* global colormag_script_vars, colormag_load_more */
jQuery( document ).ready(
	function () {

		var tg_ajax_button_init = function ( tg_ajax_button, tg_ajax_button_category, tg_ajax_button_random, tg_ajax_button_number, tg_ajax_button_child_category, tg_ajax_button_tag, tg_ajax_button_author, tg_ajax_button_type, tg_append_ajax_datas, tg_ajax_loading_icon ) {

			// Load more content.
			var tg_pagenumber     = 1;
			var tg_no_more_posts  = colormag_script_vars.no_more_posts;
			var tg_category       = tg_ajax_button_category;
			var tg_number         = tg_ajax_button_number;
			var tg_random         = tg_ajax_button_random;
			var tg_child_category = tg_ajax_button_child_category;
			var tg_tag            = tg_ajax_button_tag;
			var tg_author         = tg_ajax_button_author;
			var tg_type           = tg_ajax_button_type;

			jQuery( tg_ajax_button ).on(
				'click',
				function () {
					tg_pagenumber ++;
					jQuery( tg_ajax_loading_icon ).show();
					jQuery( tg_ajax_button ).attr( 'disabled', true );

					var tg_data = {
						action            : 'get_ajax_results',
						tg_nonce          : colormag_load_more.tg_nonce,
						tg_pagenumber     : tg_pagenumber,
						tg_category       : tg_category,
						tg_number         : tg_number,
						tg_random         : tg_random,
						tg_child_category : tg_child_category,
						tg_tag            : tg_tag,
						tg_author         : tg_author,
						tg_type           : tg_type
					};

					jQuery.post(
						colormag_load_more.ajax_url,
						tg_data,
						function ( response ) {
							var tg_data = jQuery( response );

							if ( tg_data.length ) {
								jQuery( tg_append_ajax_datas ).append( tg_data );
								jQuery( tg_ajax_loading_icon ).hide();
								jQuery( tg_ajax_button ).attr( 'disabled', false );
							} else {
								jQuery( tg_ajax_loading_icon ).hide();
								jQuery( tg_ajax_button ).attr( 'disabled', true );
								jQuery( tg_ajax_button ).html( '<span>' + tg_no_more_posts + '</span>' );
							}
						}
					);

					return false;
				}
			);
		};

		var tg_ajax_button_wrapper = jQuery( '.tg-ajax-btn-wrapper' );

		jQuery( tg_ajax_button_wrapper ).each(
			function () {
				var tg_ajax_button                = '#' + jQuery( this ).children( '.tg-front-post-load-more' ).attr( 'id' );
				var tg_ajax_button_category       = jQuery( this ).children( '.tg-front-post-load-more' ).data( 'category' );
				var tg_ajax_button_random         = jQuery( this ).children( '.tg-front-post-load-more' ).data( 'random' );
				var tg_ajax_button_number         = jQuery( this ).children( '.tg-front-post-load-more' ).data( 'number' );
				var tg_ajax_button_child_category = jQuery( this ).children( '.tg-front-post-load-more' ).data( 'child_category' );
				var tg_ajax_button_tag            = jQuery( this ).children( '.tg-front-post-load-more' ).data( 'tag' );
				var tg_ajax_button_author         = jQuery( this ).children( '.tg-front-post-load-more' ).data( 'author' );
				var tg_ajax_button_type           = jQuery( this ).children( '.tg-front-post-load-more' ).data( 'type' );
				var tg_append_ajax_datas          = '#' + jQuery( this ).children( '.tg-append-ajax-datas' ).attr( 'id' );
				var tg_ajax_loading_icon          = '#' + jQuery( this ).find( '.waiting' ).attr( 'id' );

				tg_ajax_button_init( tg_ajax_button, tg_ajax_button_category, tg_ajax_button_random, tg_ajax_button_number, tg_ajax_button_child_category, tg_ajax_button_tag, tg_ajax_button_author, tg_ajax_button_type, tg_append_ajax_datas, tg_ajax_loading_icon );
			}
		);

	}
);
