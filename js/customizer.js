/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function ( $ ) {

	// Site title
	wp.customize( 'blogname', function ( value ) {
		value.bind( function ( to ) {
			$( '#site-title a' ).text( to );
		} );
	} );

	// Site description.
	wp.customize( 'blogdescription', function ( value ) {
		value.bind( function ( to ) {
			$( '#site-description' ).text( to );
		} );
	} );

	// Site Layout Option
	wp.customize( 'colormag_site_layout', function ( value ) {
		value.bind( function ( layout ) {
				var site_layout = layout;

				if ( site_layout === 'wide_layout' ) {
					$( 'body' ).addClass( 'wide' );
				} else if ( site_layout === 'boxed_layout' ) {
					$( 'body' ).removeClass( 'wide' );
				}
			}
		);
	} );

	// Primary Color Option
	wp.customize( 'colormag_primary_color', function ( value ) {
		value.bind( function ( primaryColor ) {
			// Store internal style for primary color
			var primaryColorStyle = '<style id="colormag-internal-primary-color">' +
				'.colormag-button,blockquote,button,input[type=reset],input[type=button],input[type=submit], ' +
				'#masthead.colormag-header-clean #site-navigation.main-small-navigation .menu-toggle{background-color:' + primaryColor + '}' +
				'#site-title a,.next a:hover,.previous a:hover,.social-links i.fa:hover,a, ' +
				'#masthead.colormag-header-clean .social-links li:hover i.fa, ' +
				'#masthead.colormag-header-classic .social-links li:hover i.fa, ' +
				'#masthead.colormag-header-clean .breaking-news .newsticker a:hover, ' +
				'#masthead.colormag-header-classic .breaking-news .newsticker a:hover, ' +
				'#masthead.colormag-header-classic #site-navigation .fa.search-top:hover, ' +
				'#masthead.colormag-header-classic #site-navigation .random-post a:hover .fa-random, ' +
				'.better-responsive-menu #masthead .main-small-navigation li:hover > .sub-toggle i, ' +
				'.better-responsive-menu #masthead .main-small-navigation .sub-toggle.active .fa {color:' + primaryColor + '}' +
				'.fa.search-top:hover, ' +
				'#masthead.colormag-header-classic #site-navigation.main-small-navigation .menu-toggle {background-color:' + primaryColor + '}' +
				'#site-navigation{border-top:4px solid ' + primaryColor + '}' +
				'.home-icon.front_page_on,.main-navigation a:hover,.main-navigation ul li ul li a:hover,' +
				'.main-navigation ul li ul li:hover>a, ' +
				'.main-navigation ul li.current-menu-ancestor>a,.main-navigation ul li.current-menu-item ul li a:hover, ' +
				'.main-navigation ul li.current-menu-item>a,.main-navigation ul li.current_page_ancestor>a, ' +
				'.main-navigation ul li.current_page_item>a, ' +
				'.main-navigation ul li:hover>a,.main-small-navigation li a:hover,.site-header .menu-toggle:hover,' +
				'#masthead.colormag-header-classic .main-navigation ul ul.sub-menu li:hover > a, ' +
				'#masthead.colormag-header-classic .main-navigation ul ul.sub-menu li.current-menu-ancestor > a, ' +
				'#masthead.colormag-header-classic .main-navigation ul ul.sub-menu li.current-menu-item > a, ' +
				'#masthead .main-small-navigation li:hover > a, ' +
				'#masthead .main-small-navigation li.current-page-ancestor > a, ' +
				'#masthead .main-small-navigation li.current-menu-ancestor > a, ' +
				'#masthead .main-small-navigation li.current-page-item > a, ' +
				'#masthead .main-small-navigation li.current-menu-item > a {background-color:' + primaryColor + '}' +
				'.main-small-navigation .current-menu-item>a,' +
				'.main-small-navigation .current_page_item>a {background:' + primaryColor + '}' +
				'#masthead.colormag-header-classic .main-navigation ul ul.sub-menu li:hover, ' +
				'#masthead.colormag-header-classic .main-navigation ul ul.sub-menu li.current-menu-ancestor, ' +
				'#masthead.colormag-header-classic .main-navigation ul ul.sub-menu li.current-menu-item, ' +
				'#masthead.colormag-header-classic #site-navigation.main-small-navigation .menu-toggle, ' +
				'#masthead.colormag-header-classic #site-navigation .menu-toggle:hover, ' +
				'#masthead.colormag-header-classic .main-navigation ul > li:hover > a, ' +
				'#masthead.colormag-header-classic .main-navigation ul > li.current-menu-item > a, ' +
				'#masthead.colormag-header-classic .main-navigation ul > li.current-menu-ancestor > a, ' +
				'#masthead.colormag-header-classic .main-navigation ul li.focus > a {border-color:' + primaryColor + ' }' +
				'.promo-button-area a:hover{border:2px solid ' + primaryColor + ';' + 'background-color:' + primaryColor + '}' +
				'#content .wp-pagenavi .current,#content .wp-pagenavi a:hover,.format-link .entry-content a,' +
				'.pagination span{background-color:' + primaryColor + '}' +
				'.pagination a span:hover{color:' + primaryColor + ';' + 'border-color:' + primaryColor + '}' +
				'#content .comments-area a.comment-edit-link:hover,#content .comments-area a.comment-permalink:hover,' +
				'#content .comments-area article header cite a:hover,.comments-area .comment-author-link a:hover{color:' + primaryColor + '}' +
				'.comments-area .comment-author-link span{background-color:' + primaryColor + '}' +
				'.comment .comment-reply-link:hover,.nav-next a,.nav-previous a{color:' + primaryColor + '}' +
				'#secondary .widget-title{border-bottom:2px solid ' + primaryColor + '}' +
				'#secondary .widget-title span{background-color:' + primaryColor + '}' +
				'.footer-widgets-area .widget-title{border-bottom:2px solid ' + primaryColor + '}' +
				'.footer-widgets-area .widget-title span,.colormag-footer--classic .footer-widgets-area .widget-title span::before{background-color:' + primaryColor + '}' +
				'.footer-widgets-area a:hover{color:' + primaryColor + '}' +
				'.advertisement_above_footer .widget-title{border-bottom:2px solid ' + primaryColor + '}' +
				'.advertisement_above_footer .widget-title span{background-color:' + primaryColor + '}' +
				'a#scroll-up i{color:' + primaryColor + '}' +
				'.page-header .page-title{border-bottom:2px solid ' + primaryColor + '}' +
				'#content .post .article-content .above-entry-meta .cat-links a,.page-header .page-title span{background-color:' + primaryColor + '}' +
				'#content .post .article-content .entry-title a:hover,.entry-meta .byline i,.entry-meta .cat-links i,.entry-meta a,.post .entry-title a:hover,.search .entry-title a:hover{color:' + primaryColor + '}' +
				'.entry-meta .post-format i{background-color:' + primaryColor + '}' +
				'.entry-meta .comments-link a:hover,.entry-meta .edit-link a:hover,.entry-meta .posted-on a:hover,.entry-meta .tag-links a:hover,.single #content .tags a:hover{color:' + primaryColor + '}' +
				'.more-link,.no-post-thumbnail{background-color:' + primaryColor + '}' +
				'.post-box .entry-meta .cat-links a:hover,.post-box .entry-meta .posted-on a:hover,.post.post-box .entry-title a:hover{color:' + primaryColor + '}' +
				'.widget_featured_slider .slide-content .above-entry-meta .cat-links a{background-color:' + primaryColor + '}' +
				'.widget_featured_slider .slide-content .below-entry-meta .byline a:hover,.widget_featured_slider .slide-content .below-entry-meta .comments a:hover,.widget_featured_slider .slide-content .below-entry-meta .posted-on a:hover,.widget_featured_slider .slide-content .entry-title a:hover{color:' + primaryColor + '}' +
				'.widget_highlighted_posts .article-content .above-entry-meta .cat-links a{background-color:' + primaryColor + '}' +
				'.byline a:hover,.comments a:hover,.edit-link a:hover,.posted-on a:hover,.tag-links a:hover,.widget_highlighted_posts .article-content .below-entry-meta .byline a:hover,.widget_highlighted_posts .article-content .below-entry-meta .comments a:hover,.widget_highlighted_posts .article-content .below-entry-meta .posted-on a:hover,.widget_highlighted_posts .article-content .entry-title a:hover{color:' + primaryColor + '}' +
				'.widget_featured_posts .article-content .above-entry-meta .cat-links a{background-color:' + primaryColor + '}' +
				'.widget_featured_posts .article-content .entry-title a:hover{color:' + primaryColor + '}' +
				'.widget_featured_posts .widget-title{border-bottom:2px solid ' + primaryColor + '}' +
				'.widget_featured_posts .widget-title span{background-color:' + primaryColor + '}' +
				'.related-posts-main-title .fa,.single-related-posts .article-content .entry-title a:hover{color:' + primaryColor + '}' +
				'@media (max-width: 768px) {.better-responsive-menu .sub-toggle{background-color:' + primaryColor + '}}' +
				'.elementor .tg-module-wrapper .module-title{border-bottom:1px solid ' + primaryColor + '}' +
				'.elementor .tg-module-wrapper .module-title span,.elementor .tg-module-wrapper .tg-post-category{background-color:' + primaryColor + '}' +
				'.elementor .tg-module-wrapper .tg-module-meta .tg-module-comments a:hover,.elementor .tg-module-wrapper .tg-module-meta .tg-post-auther-name a:hover,.elementor .tg-module-wrapper .tg-module-meta .tg-post-date a:hover,.elementor .tg-module-wrapper .tg-module-title:hover a,.elementor .tg-module-wrapper.tg-module-grid .tg_module_grid .tg-module-info .tg-module-meta a:hover{color:' + primaryColor + '}' +
				'</style>';

			// Remove previously create internal style and add new one.
			$( 'head #colormag-internal-primary-color' ).remove();
			$( 'head' ).append( primaryColorStyle );
		} );
	} );

	// Footer Main Area Display Type
	wp.customize( 'colormag_main_footer_layout_display_type', function ( value ) {
		value.bind( function ( layout ) {
				var display_type = layout;

				if ( display_type === 'type_two' ) {
					$( '#colophon' ).removeClass( 'colormag-footer--classic-bordered' ).addClass( 'colormag-footer--classic' );
				} else if ( display_type === 'type_one' ) {
					$( '#colophon' ).removeClass( 'colormag-footer--classic colormag-footer--classic-bordered' );
				}
			}
		);
	} );

} )( jQuery );
