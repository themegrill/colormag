/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function ( $ ) {

	// Site title.
	wp.customize(
		'blogname',
		function ( value ) {
			value.bind(
				function ( to ) {
					$( '#site-title a' ).text( to );
				}
			);
		}
	);

	// Site description.
	wp.customize(
		'blogdescription',
		function ( value ) {
			value.bind(
				function ( to ) {
					$( '#site-description' ).text( to );
				}
			);
		}
	);

	// Header display type.
	wp.customize(
		'colormag_header_display_type',
		function ( value ) {
			value.bind(
				function ( layout ) {
					var display_type = layout;

					if ( display_type === 'type_two' ) {
						$( 'body' ).removeClass( 'header_display_type_two' ).addClass( 'header_display_type_one' );
					} else if ( display_type === 'type_three' ) {
						$( 'body' ).removeClass( 'header_display_type_one' ).addClass( 'header_display_type_two' );
					} else if ( display_type === 'type_one' ) {
						$( 'body' ).removeClass( 'header_display_type_one header_display_type_two' );
					}
				}
			);
		}
	);

	// Site Layout Option.
	wp.customize(
		'colormag_site_layout',
		function ( value ) {
			value.bind(
				function ( layout ) {
					var site_layout = layout;

					if ( 'wide_layout' === site_layout ) {
						$( 'body' ).removeClass( 'box-layout' ).addClass( 'wide' );
					} else if ( 'boxed_layout' === site_layout ) {
						$( 'body' ).removeClass( 'wide' ).addClass( 'box-layout' );
					}
				}
			);
		}
	);

	// Footer copyright alignment.
	wp.customize(
		'colormag_footer_copyright_alignment_setting',
		function ( value ) {
			value.bind(
				function ( alignment ) {
					var alignment_type = alignment;

					if ( alignment_type === 'left' ) {
						$( '#colophon' ).removeClass( 'copyright-right copyright-center' );
					} else if ( alignment_type === 'right' ) {
						$( '#colophon' ).removeClass( 'copyright-center' ).addClass( 'copyright-right' );
					} else if ( alignment_type === 'center' ) {
						$( '#colophon' ).removeClass( 'copyright-right' ).addClass( 'copyright-center' );
					}
				}
			);
		}
	);

	// Footer Main Area Display Type.
	wp.customize(
		'colormag_main_footer_layout_display_type',
		function ( value ) {
			value.bind(
				function ( layout ) {
					var display_type = layout;

					if ( display_type === 'type_two' ) {
						$( '#colophon' ).removeClass( 'colormag-footer--classic-bordered' ).addClass( 'colormag-footer--classic' );
					} else if ( display_type === 'type_three' ) {
						$( '#colophon' ).removeClass( 'colormag-footer--classic' ).addClass( 'colormag-footer--classic-bordered' );
					} else if ( display_type === 'type_one' ) {
						$( '#colophon' ).removeClass( 'colormag-footer--classic colormag-footer--classic-bordered' );
					}
				}
			);
		}
	);

	// Remove all of the post meta.
	wp.customize(
		'colormag_all_entry_meta_remove',
		function ( value ) {
			value.bind(
				function ( to ) {
					if ( to ) {
						$( '.above-entry-meta,.below-entry-meta,.tg-module-meta,.tg-post-categories' ).css(
							{
								'display' : 'none'
							}
						);
					} else {
						$( '.above-entry-meta,.below-entry-meta,.tg-module-meta,.tg-post-categories' ).css(
							{
								'display' : 'block'
							}
						);
					}
				}
			);
		}
	);

	// Disable the author post meta only.
	wp.customize(
		'colormag_author_entry_meta_remove',
		function ( value ) {
			value.bind(
				function ( to ) {
					if ( to ) {
						$( '.below-entry-meta .byline,.tg-module-meta .tg-post-auther-name' ).css(
							{
								'display' : 'none'
							}
						);
					} else {
						$( '.below-entry-meta .byline,.tg-module-meta .tg-post-auther-name' ).css(
							{
								'display' : 'inline-block'
							}
						);
					}
				}
			);
		}
	);

	// Disable the date post meta only.
	wp.customize(
		'colormag_date_entry_meta_remove',
		function ( value ) {
			value.bind(
				function ( to ) {
					if ( to ) {
						$( '.below-entry-meta .posted-on,.tg-module-meta .tg-post-date' ).css(
							{
								'display' : 'none'
							}
						);
					} else {
						$( '.below-entry-meta .posted-on,.tg-module-meta .tg-post-date' ).css(
							{
								'display' : 'inline-block'
							}
						);
					}
				}
			);
		}
	);

	// Disable the category post meta only.
	wp.customize(
		'colormag_category_entry_meta_remove',
		function ( value ) {
			value.bind(
				function ( to ) {
					if ( to ) {
						$( '.above-entry-meta,.tg-post-categories' ).css(
							{
								'display' : 'none'
							}
						);
					} else {
						$( '.above-entry-meta,.tg-post-categories' ).css(
							{
								'display' : 'inline-block'
							}
						);
					}
				}
			);
		}
	);

	// Disable the comments post meta only.
	wp.customize(
		'colormag_comments_entry_meta_remove',
		function ( value ) {
			value.bind(
				function ( to ) {
					if ( to ) {
						$( '.below-entry-meta .comments,.tg-module-meta .tg-module-comments' ).css(
							{
								'display' : 'none'
							}
						);
					} else {
						$( '.below-entry-meta .comments,.tg-module-meta .tg-module-comments' ).css(
							{
								'display' : 'inline-block'
							}
						);
					}
				}
			);
		}
	);

	// Disable the tags post meta only.
	wp.customize(
		'colormag_tags_entry_meta_remove',
		function ( value ) {
			value.bind(
				function ( to ) {
					if ( to ) {
						$( '.below-entry-meta .tag-links' ).css(
							{
								'display' : 'none'
							}
						);
					} else {
						$( '.below-entry-meta .tag-links' ).css(
							{
								'display' : 'inline-block'
							}
						);
					}
				}
			);
		}
	);

} )( jQuery );
