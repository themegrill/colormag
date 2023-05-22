/**
 * @param {string} controlId
 * @param {string} selector
 * @param {string} cssProperty
 *
 */

colormagGenerateCSS( 'colormag_site_title_color', '.cm-site-title a', 'color' )
colormagGenerateCSS( 'colormag_site_title_hover_color', '.cm-site-title a:hover', 'color' )
colormagGenerateCSS( 'colormag_site_tagline_color', '.cm-site-description', 'color' )
colormagGenerateCSS( 'colormag_top_bar_border_bottom_color', '.cm-top-bar', 'border-bottom-color' )

colormagGenerateDimensionCSS( 'colormag_primary_menu_dimension_padding', '.cm-primary-nav a', 'padding' );
colormagGenerateDimensionCSS( 'colormag_main_header_dimension_padding', '.cm-primary-nav', 'padding' );

colormagGenerateSliderCSS( 'colormag_top_bar_border_bottom_size', '.cm-top-bar', 'border-bottom-width');

colormagGenerateTypographyCSS( 'colormag_site_title_typography', '.cm-site-title');
colormagGenerateTypographyCSS( 'colormag_site_tagline_typography', '.cm-site-description');
colormagGenerateTypographyCSS( 'colormag_news_ticker_label_typography', '.breaking-news .breaking-news-latest');
colormagGenerateTypographyCSS( 'colormag_news_ticker_content_typography', '.breaking-news ul li a');
colormagGenerateTypographyCSS( 'colormag_primary_menu_typography', '.cm-primary-nav ul li a');
colormagGenerateTypographyCSS( 'colormag_primary_sub_menu_typography', '.cm-primary-nav ul li ul li a');
colormagGenerateTypographyCSS( 'colormag_post_title_typography', '.cm-posts .post .entry-title');
colormagGenerateTypographyCSS( 'colormag_comment_title_typography', '.comments-title, .comment-reply-title, #respond h3#reply-title');
colormagGenerateTypographyCSS( 'colormag_post_meta_typography', '.cm-posts .post .cm-post-content .cm-below-entry-meta .cm-post-date a, .cm-posts .post .cm-post-content .cm-below-entry-meta .cm-author, .cm-posts .post .cm-post-content .cm-below-entry-meta .cm-author a, .cm-posts .post .cm-post-content .cm-below-entry-meta .cm-post-views a, .cm-posts .post .cm-post-content .cm-below-entry-meta .cm-tag-links a, .cm-posts .post .cm-post-content .cm-below-entry-meta .cm-comments-link a, .cm-posts .post .cm-post-content .cm-below-entry-meta .cm-edit-link a, .cm-posts .post .cm-post-content .cm-below-entry-meta .cm-edit-link i, .cm-posts .post .cm-post-content .cm-below-entry-meta .cm-post-views, .cm-posts .post .cm-post-content .cm-below-entry-meta .reading-time, .cm-posts .post .cm-post-content .cm-below-entry-meta .reading-time::before');
colormagGenerateTypographyCSS( 'colormag_page_title_typography', '.type-page .entry-title');
colormagGenerateTypographyCSS( 'colormag_footer_widget_title_typography', '.footer-widgets-area .widget-title');
colormagGenerateTypographyCSS( 'colormag_footer_widget_content_typography', '#colophon, #colophon p');
colormagGenerateTypographyCSS( 'colormag_footer_copyright_typography', '.footer-socket-wrapper .copyright');
colormagGenerateTypographyCSS( 'colormag_footer_menu_typography', '.footer-menu a');
