<?php
/**
 * ColorMag dynamic CSS generation file for theme options.
 *
 * Class ColorMag_Dynamic_CSS
 *
 * @package ColorMag
 *
 * @since   ColorMag 3.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * ColorMag dynamic CSS generation file for theme options.
 *
 * Class ColorMag_Dynamic_CSS
 */
class ColorMag_Dynamic_CSS {

	/**
	 * Return dynamic CSS output.
	 *
	 * @param string $dynamic_css          Dynamic CSS.
	 * @param string $dynamic_css_filtered Dynamic CSS Filters.
	 *
	 * @return string Generated CSS.
	 */
	public static function render_output( $dynamic_css, $dynamic_css_filtered = '' ) {

		/**
		 * Variable declarations.
		 */

		// Top bar color options
		$breaking_news_label_background_color = get_theme_mod( 'colormag_news_ticker_label_background', '#55ac55' );

		$breaking_news_label_typography_default = array(
			'font-family' => 'default',
			'font-weight' => 600,
			'font-size'   => array(
				'desktop' => array(
					'size' => '14',
					'unit' => 'px',
				),
				'tablet'  => array(
					'size' => '',
					'unit' => '',
				),
				'mobile'  => array(
					'size' => '',
					'unit' => '',
				),
			),
		);

		$breaking_news_content_typography_default = array(
			'font-family' => 'default',
			'font-weight' => 600,
			'font-size'   => array(
				'desktop' => array(
					'size' => '14',
					'unit' => 'px',
				),
				'tablet'  => array(
					'size' => '',
					'unit' => '',
				),
				'mobile'  => array(
					'size' => '',
					'unit' => '',
				),
			),
		);

		// Top bar typography option.
		$breaking_news_label_typography   = get_theme_mod( 'colormag_news_ticker_label_typography', $breaking_news_label_typography_default );
		$breaking_news_content_typography = get_theme_mod( 'colormag_news_ticker_content_typography', $breaking_news_content_typography_default );

		// Header options.

		$primary_menu_text_color                  = get_theme_mod( 'colormag_primary_menu_text_color', '' );
		$primary_menu_selected_hovered_text_color = get_theme_mod( 'colormag_primary_menu_selected_hovered_text_color', '' );
		$primary_menu_top_border_color            = get_theme_mod( 'colormag_primary_menu_top_border_color', '#207daf' );

		$header_background_default       = array(
			'background-color'      => '#ffffff',
			'background-image'      => '',
			'background-position'   => 'center center',
			'background-size'       => 'auto',
			'background-attachment' => 'scroll',
			'background-repeat'     => 'repeat',
		);

		$primary_menu_background_default     = array(
			'background-color'      => '#27272A',
			'background-image'      => '',
			'background-position'   => 'center center',
			'background-size'       => 'auto',
			'background-attachment' => 'scroll',
			'background-repeat'     => 'repeat',
		);
		$primary_sub_menu_background_default = array(
			'background-color'      => '#232323',
			'background-image'      => '',
			'background-position'   => 'center center',
			'background-size'       => 'auto',
			'background-attachment' => 'scroll',
			'background-repeat'     => 'repeat',
		);
		$primary_menu_typography_default     = array(
			'font-family' => 'default',
			'font-weight' => 600,
			'font-size'   => array(
				'desktop' => array(
					'size' => '14',
					'unit' => 'px',
				),
				'tablet'  => array(
					'size' => '',
					'unit' => '',
				),
				'mobile'  => array(
					'size' => '',
					'unit' => '',
				),
			),
		);
		$primary_sub_menu_typography_default = array(
			'font-size' => array(
				'desktop' => array(
					'size' => '14',
					'unit' => 'px',
				),
				'tablet'  => array(
					'size' => '',
					'unit' => '',
				),
				'mobile'  => array(
					'size' => '',
					'unit' => '',
				),
			),
		);

		$header_background           = get_theme_mod( 'colormag_main_header_background', $header_background_default );
		$primary_menu_background     = get_theme_mod( 'colormag_primary_menu_background', $primary_menu_background_default );
		$primary_sub_menu_background = get_theme_mod( 'colormag_primary_sub_menu_background', $primary_sub_menu_background_default );
		$primary_menu_typography     = get_theme_mod( 'colormag_primary_menu_typography', $primary_menu_typography_default );
		$primary_sub_menu_typography = get_theme_mod( 'colormag_primary_sub_menu_typography', $primary_sub_menu_typography_default );
		$primary_menu_logo_height    = get_theme_mod( 'colormag_primary_menu_logo_height', '' );
		$primary_menu_logo_spacing   = get_theme_mod( 'colormag_primary_menu_logo_spacing', '' );

		// Post/Page/Blog options.
		$post_title_color = get_theme_mod( 'colormag_post_title_color', '#333333' );
		$page_title_color = get_theme_mod( 'colormag_page_title_color', '#333333' );
		$post_meta_color  = get_theme_mod( 'colormag_post_meta_color', '#71717A' );

		$post_title_typography_default = array(
			'font-size' => array(
				'desktop' => array(
					'size' => '32',
					'unit' => 'px',
				),
				'tablet'  => array(
					'size' => '',
					'unit' => '',
				),
				'mobile'  => array(
					'size' => '',
					'unit' => '',
				),
			),
		);
		$page_title_typography_default = array(
			'font-size' => array(
				'desktop' => array(
					'size' => '34',
					'unit' => 'px',
				),
				'tablet'  => array(
					'size' => '',
					'unit' => '',
				),
				'mobile'  => array(
					'size' => '',
					'unit' => '',
				),
			),
		);
		$post_meta_typography_default  = array(
			'font-size' => array(
				'desktop' => array(
					'size' => '12',
					'unit' => 'px',
				),
				'tablet'  => array(
					'size' => '',
					'unit' => '',
				),
				'mobile'  => array(
					'size' => '',
					'unit' => '',
				),
			),
		);

		$post_title_typography = get_theme_mod( 'colormag_post_title_typography', $post_title_typography_default );
		$page_title_typography = get_theme_mod( 'colormag_page_title_typography', $page_title_typography_default );
		$post_meta_typography  = get_theme_mod( 'colormag_post_meta_typography', $post_meta_typography_default );

		// Footer options.
		$footer_copyright_color                       = get_theme_mod( 'colormag_footer_copyright_text_color', '#F4F4F5' );
		$footer_copyright_link_color                  = get_theme_mod( 'colormag_footer_copyright_link_text_color', '#289dcc' );
		$footer_menu_color                            = get_theme_mod( 'colormag_footer_menu_color', '#b1b6b6' );
		$footer_menu_hover_color                      = get_theme_mod( 'colormag_footer_menu_hover_color', '#207daf' );
		$footer_widget_title_color                    = get_theme_mod( 'colormag_footer_widget_title_color', '#ffffff' );
		$footer_widget_content_color                  = get_theme_mod( 'colormag_footer_widget_content_color', '#ffffff' );
		$footer_widget_content_link_text_color        = get_theme_mod( 'colormag_footer_widget_content_link_text_color', '#ffffff' );
		$footer_widget_content_link_text_hover_color  = get_theme_mod( 'colormag_footer_widget_content_link_text_hover_color', '#207daf' );
		$footer_background_default                    = array(
			'background-color'      => '',
			'background-image'      => '',
			'background-position'   => 'center center',
			'background-size'       => 'auto',
			'background-attachment' => 'scroll',
			'background-repeat'     => 'repeat',
		);
		$footer_copyright_background_default          = array(
			'background-color'      => '',
			'background-image'      => '',
			'background-position'   => 'center center',
			'background-size'       => 'auto',
			'background-attachment' => 'scroll',
			'background-repeat'     => 'repeat',
		);
		$footer_copyright_typography_default          = array(
			'font-size' => array(
				'desktop' => array(
					'size' => '14',
					'unit' => 'px',
				),
				'tablet'  => array(
					'size' => '',
					'unit' => '',
				),
				'mobile'  => array(
					'size' => '',
					'unit' => '',
				),
			),
		);
		$footer_menu_typography_default               = array(
			'font-size' => array(
				'desktop' => array(
					'size' => '14',
					'unit' => 'px',
				),
				'tablet'  => array(
					'size' => '',
					'unit' => '',
				),
				'mobile'  => array(
					'size' => '',
					'unit' => '',
				),
			),
		);
		$footer_sidebar_area_background_default       = array(
			'background-color'      => '',
			'background-image'      => '',
			'background-position'   => 'center center',
			'background-size'       => 'auto',
			'background-attachment' => 'scroll',
			'background-repeat'     => 'repeat',
		);
		$footer_upper_sidebar_area_background_default = array(
			'background-color'      => '#2c2e34',
			'background-image'      => '',
			'background-position'   => 'center center',
			'background-size'       => 'auto',
			'background-attachment' => 'scroll',
			'background-repeat'     => 'repeat',
		);
		$footer_background                            = get_theme_mod( 'colormag_footer_background', $footer_background_default );
		$footer_copyright_background                  = get_theme_mod( 'colormag_footer_copyright_background', $footer_copyright_background_default );
		$footer_copyright_typography                  = get_theme_mod( 'colormag_footer_copyright_typography', $footer_copyright_typography_default );
		$footer_menu_typography                       = get_theme_mod( 'colormag_footer_menu_typography', $footer_menu_typography_default );
		$footer_sidebar_area_background               = get_theme_mod( 'colormag_footer_sidebar_area_background_setting', $footer_sidebar_area_background_default );
		$footer_upper_sidebar_area_background         = get_theme_mod( 'colormag_footer_upper_sidebar_area_background_setting', $footer_upper_sidebar_area_background_default );

		/**
		 * Color options.
		 */

		/**
		 * Button.
		 */

		/**
		 * Typography options.
		 */
		$comment_title_typography_default         = array(
			'font-size' => array(
				'desktop' => array(
					'size' => '24',
					'unit' => 'px',
				),
				'tablet'  => array(
					'size' => '',
					'unit' => '',
				),
				'mobile'  => array(
					'size' => '',
					'unit' => '',
				),
			),
		);
		$footer_widget_title_typography_default   = array(
			'font-size' => array(
				'desktop' => array(
					'size' => '18',
					'unit' => 'px',
				),
				'tablet'  => array(
					'size' => '',
					'unit' => '',
				),
				'mobile'  => array(
					'size' => '',
					'unit' => '',
				),
			),
		);
		$footer_widget_content_typography_default = array(
			'font-size' => array(
				'desktop' => array(
					'size' => '14',
					'unit' => 'px',
				),
				'tablet'  => array(
					'size' => '',
					'unit' => '',
				),
				'mobile'  => array(
					'size' => '',
					'unit' => '',
				),
			),
		);
		$comment_title_typography                 = get_theme_mod( 'colormag_comment_title_typography', $comment_title_typography_default );
		$footer_widget_title_typography           = get_theme_mod( 'colormag_footer_widget_title_typography', $footer_widget_title_typography_default );
		$footer_widget_content_typography         = get_theme_mod( 'colormag_footer_widget_content_typography', $footer_widget_content_typography_default );

		// Generate dynamic CSS.
		$parse_css = '';

		// For primary color option.
		$primary_color = get_theme_mod( 'colormag_primary_color', '#207daf' );

		$primary_color_css = array(
			'.colormag-button,
			blockquote, button,
			input[type=reset],
			input[type=button],
			input[type=submit],
			.cm-home-icon.front_page_on,
			.cm-post-categories a,
			.cm-primary-nav a:hover,
			.cm-primary-nav ul li ul li a:hover,
			.cm-primary-nav ul li ul li:hover>a,
			.cm-primary-nav ul li.current-menu-ancestor>a,
			.cm-primary-nav ul li.current-menu-item ul li a:hover,
			.cm-primary-nav ul li.current-menu-item>a,
			.cm-primary-nav ul li.current_page_ancestor>a,
			.cm-primary-nav ul li.current_page_item>a,
			.cm-primary-nav ul li:hover>a,
			.cm-mobile-nav li a:hover,
			.cm-layout-2 .cm-primary-nav ul ul.sub-menu li:hover > a,
			.cm-layout-2 .cm-primary-nav ul ul.sub-menu li.current-menu-ancestor > a,
			.cm-layout-2 .cm-primary-nav ul ul.sub-menu li.current-menu-item > a,
			.colormag-header-clean #cm-primary-nav .cm-menu-toggle:hover,
			.cm-header .cm-mobile-nav li:hover > a, .cm-header .cm-mobile-nav li.current-page-ancestor > a,
			.cm-header .cm-mobile-nav li.current-menu-ancestor > a,
			.cm-header .cm-mobile-nav li.current-page-item > a,
			.cm-header .cm-mobile-nav li.current-menu-item > a,
			.cm-primary-nav ul li.focus > a,
			.cm-layout-2 .cm-primary-nav ul ul.sub-menu li.focus > a,
			.cm-mobile-nav .current-menu-item>a, .cm-mobile-nav .current_page_item>a,
			.colormag-header-clean .cm-mobile-nav li:hover > a,
			.colormag-header-clean .cm-mobile-nav li.current-page-ancestor > a,
			.colormag-header-clean .cm-mobile-nav li.current-menu-ancestor > a,
			.colormag-header-clean .cm-mobile-nav li.current-page-item > a,
			.colormag-header-clean .cm-mobile-nav li.current-menu-item > a,
			.fa.search-top:hover,
			.widget_call_to_action .btn--primary,
			.colormag-footer--classic .cm-footer-cols .cm-row .cm-widget-title span::before,
			.colormag-footer--classic-bordered .cm-footer-cols .cm-row .cm-widget-title span::before,
			.cm-featured-posts .cm-widget-title span,
			.cm-featured-category-slider-widget .cm-slide-content .cm-entry-header-meta .cm-post-categories a,
			.cm-highlighted-posts .cm-post-content .cm-entry-header-meta .cm-post-categories a,
			.cm-category-slide-next, .cm-category-slide-prev, .slide-next,
			.slide-prev, .cm-tabbed-widget ul li, .cm-posts .wp-pagenavi .current,
			.cm-posts .wp-pagenavi a:hover, .cm-secondary .cm-widget-title span,
			.cm-posts .post .cm-post-content .cm-entry-header-meta .cm-post-categories a,
			.cm-page-header .cm-page-title span, .entry-meta .post-format i,
			.format-link, .cm-entry-button, .infinite-scroll .tg-infinite-scroll,
			.no-more-post-text, .pagination span,
			.comments-area .comment-author-link span,
			.cm-footer-cols .cm-row .cm-widget-title span,
			.advertisement_above_footer .cm-widget-title span,
			.error, .cm-primary .cm-widget-title span,
			.related-posts-wrapper.style-three .cm-post-content .cm-entry-title a:hover:before,
			.cm-slider-area .cm-widget-title span,
			.cm-beside-slider-widget .cm-widget-title span,
			.top-full-width-sidebar .cm-widget-title span,
			.wp-block-quote, .wp-block-quote.is-style-large,
			.wp-block-quote.has-text-align-right,
			.page-numbers .current, .search-wrap button,
			.cm-error-404 .cm-btn, .widget h2, .wp-block-search button,
			.widget a::before, .cm-post-date a::before,
			.byline a::before,
			.colormag-footer--classic-bordered .cm-widget-title::before' => array(
				'background-color' => esc_html( $primary_color ),
			),

			'a,
			.cm-layout-2 #cm-primary-nav .fa.search-top:hover,
			.cm-layout-2 #cm-primary-nav.cm-mobile-nav .cm-random-post a:hover .fa-random,
			.cm-layout-2 #cm-primary-nav.cm-primary-nav .cm-random-post a:hover .fa-random,
			.cm-layout-2 .breaking-news .newsticker a:hover,
			.cm-layout-2 .cm-primary-nav ul li.current-menu-item > a,
			.cm-layout-2 .cm-primary-nav ul li.current_page_item > a,
			.cm-layout-2 .cm-primary-nav ul li:hover > a,
			.cm-layout-2 .cm-primary-nav ul li.focus > a
			.dark-skin .cm-layout-2-style-1 #cm-primary-nav.cm-primary-nav .cm-home-icon:hover .fa,
			.byline a:hover, .comments a:hover, .cm-edit-link a:hover, .cm-post-date a:hover,
			.social-links:not(.cm-header-actions .social-links) i.fa:hover, .tag-links a:hover,
			.colormag-header-clean .social-links li:hover i.fa, .cm-layout-2-style-1 .social-links li:hover i.fa,
			.colormag-header-clean .breaking-news .newsticker a:hover, .widget_featured_posts .article-content .cm-entry-title a:hover,
			.widget_featured_slider .slide-content .cm-below-entry-meta .byline a:hover,
			.widget_featured_slider .slide-content .cm-below-entry-meta .comments a:hover,
			.widget_featured_slider .slide-content .cm-below-entry-meta .cm-post-date a:hover,
			.widget_featured_slider .slide-content .cm-entry-title a:hover,
			.widget_block_picture_news.widget_featured_posts .article-content .cm-entry-title a:hover,
			.widget_highlighted_posts .article-content .cm-below-entry-meta .byline a:hover,
			.widget_highlighted_posts .article-content .cm-below-entry-meta .comments a:hover,
			.widget_highlighted_posts .article-content .cm-below-entry-meta .cm-post-date a:hover,
			.widget_highlighted_posts .article-content .cm-entry-title a:hover, i.fa-arrow-up, i.fa-arrow-down,
			.cm-site-title a, #content .post .article-content .cm-entry-title a:hover, .entry-meta .byline i,
			.entry-meta .cat-links i, .entry-meta a, .post .cm-entry-title a:hover, .search .cm-entry-title a:hover,
			.entry-meta .comments-link a:hover, .entry-meta .cm-edit-link a:hover, .entry-meta .cm-post-date a:hover,
			.entry-meta .tag-links a:hover, .single #content .tags a:hover, .count, .next a:hover, .previous a:hover,
			.related-posts-main-title .fa, .single-related-posts .article-content .cm-entry-title a:hover,
			.pagination a span:hover,
			#content .comments-area a.comment-cm-edit-link:hover, #content .comments-area a.comment-permalink:hover,
			#content .comments-area article header cite a:hover, .comments-area .comment-author-link a:hover,
			.comment .comment-reply-link:hover,
			.nav-next a, .nav-previous a,
			#cm-footer .cm-footer-menu ul li a:hover,
			.cm-footer-cols .cm-row a:hover, a#scroll-up i, .related-posts-wrapper-flyout .cm-entry-title a:hover,
			.human-diff-time .human-diff-time-display:hover,
			.mzb-featured-categories .mzb-post-title a, .mzb-tab-post .mzb-post-title a,
			.mzb-post-list .mzb-post-title a, .mzb-featured-posts .mzb-post-title a,
			.mzb-featured-categories .mzb-post-title a, .cm-layout-2-style-1 #cm-primary-nav .fa:hover,
			.cm-footer-bar a,
			.cm-post-date a:hover,
			.cm-author a:hover,
			.cm-comments-link a:hover,
			.tag-links a:hover,
			.cm-edit-link a:hover,
			.cm-footer-bar .copyright a,
			.cm-featured-posts .cm-entry-title a:hover,
			.cm-posts .post .cm-post-content .cm-entry-title a:hover,
			.cm-posts .post .single-title-above .cm-entry-title a:hover,
			.cm-layout-2 .cm-primary-nav ul li:hover > a,
			.cm-layout-2 #cm-primary-nav .fa:hover' => array(
				'color' => esc_html( $primary_color ),
			),

			'#cm-primary-nav,
			.cm-contained .cm-header-2 .cm-row' => array(
				'border-top-color' => esc_html( $primary_color ),
			),

			'.cm-layout-2 #cm-primary-nav,
			.cm-layout-2 .cm-primary-nav ul ul.sub-menu li:hover,
			.cm-layout-2 .cm-primary-nav ul > li:hover > a,
			.cm-layout-2 .cm-primary-nav ul > li.current-menu-item > a,
			.cm-layout-2 .cm-primary-nav ul > li.current-menu-ancestor > a,
			.cm-layout-2 .cm-primary-nav ul ul.sub-menu li.current-menu-ancestor,
			.cm-layout-2 .cm-primary-nav ul ul.sub-menu li.current-menu-item,
			.cm-layout-2 .cm-primary-nav ul ul.sub-menu li.focus,
			cm-layout-2 .cm-primary-nav ul ul.sub-menu li.current-menu-ancestor,
			cm-layout-2 .cm-primary-nav ul ul.sub-menu li.current-menu-item,
			cm-layout-2 #cm-primary-nav .cm-menu-toggle:hover,
			cm-layout-2 #cm-primary-nav.cm-mobile-nav .cm-menu-toggle,
			cm-layout-2 .cm-primary-nav ul > li:hover > a,
			cm-layout-2 .cm-primary-nav ul > li.current-menu-item > a,
			cm-layout-2 .cm-primary-nav ul > li.current-menu-ancestor > a,
			.cm-layout-2 .cm-primary-nav ul li.focus > a, .pagination a span:hover,
			.cm-error-404 .cm-btn,
			.single-post .cm-post-categories a::after,
			.widget .block-title,
			.cm-layout-2 .cm-primary-nav ul li.focus > a,
			.cm-layout-2 .cm-primary-nav ul ul.sub-menu li:hover' => array(
				'border-color' => esc_html( $primary_color ),
			),

			'.cm-secondary .cm-widget-title,
			#tertiary .cm-widget-title,
			.widget_featured_posts .widget-title,
			#secondary .widget-title,
			#tertiary .widget-title,
			.cm-page-header .cm-page-title,
			.cm-footer-cols .cm-row .widget-title,
			.advertisement_above_footer .widget-title,
			#primary .widget-title,
			.widget_slider_area .widget-title,
			.widget_beside_slider .widget-title,
			.top-full-width-sidebar .widget-title,
			.cm-footer-cols .cm-row .cm-widget-title,
			.cm-footer-bar .copyright a,
			.cm-layout-2.cm-layout-2-style-2 #cm-primary-nav,
			.cm-layout-2 .cm-primary-nav ul > li:hover > a,
			.cm-layout-2 .cm-primary-nav ul > li.current-menu-item > a' => array(
				'border-bottom-color' => esc_html( $primary_color ),
			),
		);

		$parse_css .= colormag_parse_css( '#207daf', $primary_color, $primary_color_css );

		// Primary color for Elementor.
		if ( defined( 'ELEMENTOR_VERSION' ) ) {

			$primary_color_elementor_css = array(
				'.elementor .elementor-widget-wrap .tg-module-wrapper .module-title span,
				.elementor .elementor-widget-wrap .tg-module-wrapper .tg-post-category,
				.elementor .elementor-widget-wrap .tg-module-wrapper.tg-module-block.tg-module-block--style-5 .tg_module_block .read-more, .elementor .elementor-widget-wrap .tg-module-wrapper tg-module-block.tg-module-block--style-10 .tg_module_block.tg_module_block--list-small:before' => array(
					'background-color' => esc_html( $primary_color ),
				),

				'.elementor .elementor-widget-wrap .tg-module-wrapper .tg-module-meta .tg-module-comments a:hover,
				.elementor .elementor-widget-wrap .tg-module-wrapper .tg-module-meta .tg-post-auther-name a:hover,
				.elementor .elementor-widget-wrap .tg-module-wrapper .tg-module-meta .tg-post-date a:hover,
				.elementor .elementor-widget-wrap .tg-module-wrapper .tg-module-title:hover a,
				.elementor .elementor-widget-wrap .tg-module-wrapper.tg-module-block.tg-module-block--style-7 .tg_module_block--white .tg-module-comments a:hover,
				.elementor .elementor-widget-wrap .tg-module-wrapper.tg-module-block.tg-module-block--style-7 .tg_module_block--white .tg-post-auther-name a:hover,
				.elementor .elementor-widget-wrap .tg-module-wrapper.tg-module-block.tg-module-block--style-7 .tg_module_block--white .tg-post-date a:hover,
				.elementor .elementor-widget-wrap .tg-module-wrapper.tg-module-grid .tg_module_grid .tg-module-info .tg-module-meta a:hover,
				.elementor .elementor-widget-wrap .tg-module-wrapper.tg-module-block.tg-module-block--style-7 .tg_module_block--white .tg-module-title a:hover,
				.elementor .elementor-widget-wrap .tg-trending-news .trending-news-wrapper a:hover,
				.elementor .elementor-widget-wrap .tg-trending-news .swiper-controls .swiper-button-next:hover, .elementor .elementor-widget-wrap .tg-trending-news .swiper-controls .swiper-button-prev:hover,
				.elementor .elementor-widget-wrap .tg-module-wrapper.tg-module-block.tg-module-block--style-10 .tg_module_block--white .tg-module-title a:hover,
				.elementor .elementor-widget-wrap .tg-module-wrapper.tg-module-block.tg-module-block--style-10 .tg_module_block--white .tg-post-auther-name a:hover,
				.elementor .elementor-widget-wrap .tg-module-wrapper.tg-module-block.tg-module-block--style-10 .tg_module_block--white .tg-post-date a:hover,
				.elementor .elementor-widget-wrap .tg-module-wrapper.tg-module-block.tg-module-block--style-10 .tg_module_block--white .tg-module-comments a:hover' => array(
					'color' => esc_html( $primary_color ),
				),

				'.elementor .elementor-widget-wrap .tg-trending-news .swiper-controls .swiper-button-next:hover,
				.elementor .elementor-widget-wrap .tg-trending-news .swiper-controls .swiper-button-prev:hover' => array(
					'border-color' => esc_html( $primary_color ),
				),
			);

			$parse_css .= colormag_parse_css( '#207daf', $primary_color, $primary_color_elementor_css );

		}

		//Top bar breaking news label background color.
		$breaking_news_label_background_color_css = array(
			'#main .breaking-news-latest' => array(
				'background-color' => esc_html( $breaking_news_label_background_color ),
			),
		);

		$parse_css .= colormag_parse_css( '#55ac55', $breaking_news_label_background_color, $breaking_news_label_background_color_css );

		$parse_css .= colormag_parse_typography_css(
			$breaking_news_content_typography_default,
			$breaking_news_content_typography,
			'.breaking-news ul li a',
			array(
				'tablet' => 768,
				'mobile' => 600,
			)
		);

		$parse_css .= colormag_parse_typography_css(
			$breaking_news_label_typography_default,
			$breaking_news_label_typography,
			'.breaking-news .breaking-news-latest',
			array(
				'tablet' => 768,
				'mobile' => 600,
			)
		);

		/**
		 * Header options.
		 */
		// Background.
		$parse_css .= colormag_parse_background_css( $header_background_default, $header_background, '.cm-header' );

		// Main Header
		$main_header_dimension_padding_default = array(
			'top'    => '',
			'right'  => '',
			'bottom' => '',
			'left'   => '',
			'unit'   => 'px',
		);

		$main_header_dimension_padding = get_theme_mod( 'colormag_main_header_dimension_padding', $main_header_dimension_padding_default );

		$parse_css .= colormag_parse_dimension_css(
			$main_header_dimension_padding_default,
			$main_header_dimension_padding,
			'.cm-primary-nav',
			'padding'
		);

		// Primary menu text color.
		$primary_menu_text_color_css = array(
			'.cm-primary-nav a,
			.cm-primary-nav ul li ul li a,
			.cm-primary-nav ul li.current-menu-item ul li a,
			.cm-primary-nav ul li ul li.current-menu-item a,
			.cm-primary-nav ul li.current_page_ancestor ul li a,
			.cm-primary-nav ul li.current-menu-ancestor ul li a,
			.cm-primary-nav ul li.current_page_item ul li a,
			.cm-primary-nav li.menu-item-has-children>a::after,
			.cm-primary-nav li.page_item_has_children>a::after,
			.cm-layout-2-style-1 .cm-primary-nav a,
			.cm-layout-2-style-1 .cm-primary-nav ul > li > a' => array(
				'color' => esc_html( $primary_menu_text_color ),
			),
		);

		$parse_css .= colormag_parse_css( '', $primary_menu_text_color, $primary_menu_text_color_css );

		// Primary menu text color.
		$primary_menu_selected_hovered_text_color_css = array(
			'.cm-primary-nav a:hover,
			.cm-primary-nav ul li.current-menu-item a,
			.cm-primary-nav ul li ul li.current-menu-item a,
			.cm-primary-nav ul li.current_page_ancestor a,
			.cm-primary-nav ul li.current-menu-ancestor a,
			.cm-primary-nav ul li.current_page_item a, .cm-primary-nav ul li:hover>a,
			.cm-primary-nav ul li ul li a:hover, .cm-primary-nav ul li ul li:hover>a,
			.cm-primary-nav ul li.current-menu-item ul li a:hover,
			.cm-primary-nav li.page_item_has_children.current-menu-item>a::after,
			.cm-layout-2-style-1 .cm-primary-nav ul li:hover > a' => array(
				'color' => esc_html( $primary_menu_selected_hovered_text_color ),
			),
		);

		$parse_css .= colormag_parse_css( '', $primary_menu_selected_hovered_text_color, $primary_menu_selected_hovered_text_color_css );

		// Primary menu background.
		$parse_css .= colormag_parse_background_css( $primary_menu_background_default, $primary_menu_background, '#cm-primary-nav, .colormag-header-clean #cm-primary-nav .cm-row, .colormag-header-clean--full-width #cm-primary-nav' );

		// Primary sub menu background.
		$parse_css .= colormag_parse_background_css( $primary_sub_menu_background_default, $primary_sub_menu_background, '.cm-primary-nav .sub-menu, .cm-primary-nav .children' );

		// Primary menu border top color.
		$primary_menu_top_border_color_css = array(
			'#cm-primary-nav,
			.colormag-header-clean #cm-primary-nav .cm-row,
			.cm-layout-2-style-1 #cm-primary-nav,
			.colormag-header-clean.colormag-header-clean--top #cm-primary-nav .cm-row,
			.colormag-header-clean--full-width #cm-primary-nav,
			.cm-layout-2-style-1.cm-layout-2-style-1--top #cm-primary-nav,
			.cm-layout-2.cm-layout-2-style-2 #cm-primary-nav' => array(
				'border-top-color' => esc_html( $primary_menu_top_border_color ),
			),

			'.cm-layout-2.cm-layout-2-style-2 #cm-primary-nav' => array(
				'border-bottom-color' => esc_html( $primary_menu_top_border_color ),
			),
		);

		$parse_css .= colormag_parse_css( '#207daf', $primary_menu_top_border_color, $primary_menu_top_border_color_css );

		// Primary menu typography.
		$parse_css .= colormag_parse_typography_css(
			$primary_menu_typography_default,
			$primary_menu_typography,
			'.cm-primary-nav ul li a',
			array(
				'tablet' => 768,
				'mobile' => 600,
			)
		);

		// Dimentions.
		$primary_menu_dimension_padding_default = array(
			'top'    => '10',
			'right'  => '16',
			'bottom' => '10',
			'left'   => '16',
			'unit'   => 'px',
		);

		$primary_menu_dimension_padding = get_theme_mod( 'colormag_primary_menu_dimension_padding', $primary_menu_dimension_padding_default );

		$parse_css .= colormag_parse_dimension_css(
			$primary_menu_dimension_padding_default,
			$primary_menu_dimension_padding,
			'.cm-primary-nav a',
			'padding'
		);

		// Primary sub menu typography.
		$parse_css .= colormag_parse_typography_css(
			$primary_sub_menu_typography_default,
			$primary_sub_menu_typography,
			'.cm-primary-nav ul li ul li a',
			array(
				'tablet' => 768,
				'mobile' => 600,
			)
		);

		// Primary menu logo height.
		$primary_menu_logo_height_css = array(
			'.menu-logo img' => array(
				'height' => esc_html( $primary_menu_logo_height ) . 'px',
			),
		);

		$parse_css .= colormag_parse_css( '', $primary_menu_logo_height, $primary_menu_logo_height_css );

		// Primary menu logo spacing.
		$primary_menu_logo_spacing_css = array(
			'.menu-logo a' => array(
				'margin-right' => esc_html( $primary_menu_logo_spacing ) . 'px',
			),
		);

		$parse_css .= colormag_parse_css( '', $primary_menu_logo_spacing, $primary_menu_logo_spacing_css );

		/**
		 * Post/Page/Blog options.
		 */
		// Post title color.
		$post_title_color_css = array(
			'.post .cm-entry-title,
			.cm-posts .post .cm-post-content .cm-entry-title a,
			.cm-posts .post .single-title-above .cm-entry-title a' => array(
				'color' => esc_html( $post_title_color ),
			),
		);

		$parse_css .= colormag_parse_css( '#333333', $post_title_color, $post_title_color_css );

		// Post title typography.
		$parse_css .= colormag_parse_typography_css(
			$post_title_typography_default,
			$post_title_typography,
			'.cm-posts .post .entry-title',

			array(
				'tablet' => 768,
				'mobile' => 600,
			)
		);

		// Page title color.
		$page_title_color_css = array(
			'.type-page .cm-entry-title,
			.type-page .cm-entry-title a' => array(
				'color' => esc_html( $page_title_color ),
			),
		);

		$parse_css .= colormag_parse_css( '#333333', $page_title_color, $page_title_color_css );

		// Page title typography.
		$parse_css .= colormag_parse_typography_css(
			$page_title_typography_default,
			$page_title_typography,
			'.type-page .cm-entry-title',
			array(
				'tablet' => 768,
				'mobile' => 600,
			)
		);

		// Post meta typography.
		$parse_css .= colormag_parse_typography_css(
			$post_meta_typography_default,
			$post_meta_typography,
			'.cm-posts .post .cm-post-content .cm-below-entry-meta .cm-post-date a,
			.cm-posts .post .cm-post-content .cm-below-entry-meta .cm-author,
			.cm-posts .post .cm-post-content .cm-below-entry-meta .cm-author a,
			.cm-posts .post .cm-post-content .cm-below-entry-meta .cm-post-views a,
			.cm-posts .post .cm-post-content .cm-below-entry-meta .cm-tag-links a,
			.cm-posts .post .cm-post-content .cm-below-entry-meta .cm-comments-link a,
			.cm-posts .post .cm-post-content .cm-below-entry-meta .cm-edit-link a,
			.cm-posts .post .cm-post-content .cm-below-entry-meta .cm-edit-link i,
			.cm-posts .post .cm-post-content .cm-below-entry-meta .cm-post-views,
			.cm-posts .post .cm-post-content .cm-below-entry-meta .reading-time,
			.cm-posts .post .cm-post-content .cm-below-entry-meta .reading-time::before',
			array(
				'tablet' => 768,
				'mobile' => 600,
			)
		);

		// Post meta color.
		$post_meta_color_css = array(
			'.cm-post-date a,
			.human-diff-time .human-diff-time-display,
			.cm-total-views,
			.cm-author a,
			cm-post-views,
			.total-views,
			.cm-edit-link a,
			.cm-comments-link a,
			.reading-time' => array(
				'color' => esc_html( $post_meta_color ),
			),
		);

		$parse_css .= colormag_parse_css( '#888888', $post_meta_color, $post_meta_color_css );

		/**
		 * Footer options.
		 */
		// Background.
		$parse_css .= colormag_parse_background_css( $footer_background_default, $footer_background, '#cm-footer, .cm-footer-cols' );

		// Footer copyright background.
		$parse_css .= colormag_parse_background_css( $footer_copyright_background_default, $footer_copyright_background, '.cm-footer-bar' );

		// Footer copyright color.
		$footer_copyright_color_css = array(
			'.cm-footer-bar .copyright' => array(
				'color' => esc_html( $footer_copyright_color ),
			),
		);

		$parse_css .= colormag_parse_css( '#F4F4F5', $footer_copyright_color, $footer_copyright_color_css );

		// Footer copyright link color.
		$footer_copyright_link_color_css = array(
			'.cm-footer-bar .copyright a' => array(
				'color'         => esc_html( $footer_copyright_link_color ),
			),
			'.cm-footer-bar .copyright a' => array(
				'border-bottom-color' => esc_html( $footer_copyright_link_color ),
			),
		);

		$parse_css .= colormag_parse_css( '#289dcc', $footer_copyright_link_color, $footer_copyright_link_color_css );

		// Footer menu color.
		$footer_menu_color_css = array(
			'#cm-footer .cm-footer-menu ul li a' => array(
				'color' => esc_html( $footer_menu_color ),
			),
		);

		$parse_css .= colormag_parse_css( '#b1b6b6', $footer_menu_color, $footer_menu_color_css );

		// Footer menu hover color.
		$footer_menu_hover_color_css = array(
			'#cm-footer .cm-footer-menu ul li a:hover' => array(
				'color' => esc_html( $footer_menu_hover_color ),
			),
		);

		$parse_css .= colormag_parse_css( '#207daf', $footer_menu_hover_color, $footer_menu_hover_color_css );

		// Footer copyright typography.
		$parse_css .= colormag_parse_typography_css(
			$footer_copyright_typography_default,
			$footer_copyright_typography,
			'.cm-footer-bar .copyright',
			array(
				'tablet' => 768,
				'mobile' => 600,
			)
		);

		// Footer menu typography.
		$parse_css .= colormag_parse_typography_css(
			$footer_menu_typography_default,
			$footer_menu_typography,
			'.cm-footer-menu a',
			array(
				'tablet' => 768,
				'mobile' => 600,
			)
		);

		// Footer sidebar area background.
		$parse_css .= colormag_parse_background_css( $footer_sidebar_area_background_default, $footer_sidebar_area_background, '.cm-footer-cols' );

		// Footer upper sidebar area background.
		$parse_css .= colormag_parse_background_css( $footer_upper_sidebar_area_background_default, $footer_upper_sidebar_area_background, '#cm-footer .cm-upper-footer-cols .widget' );

		// Footer widget title color.
		$footer_widget_title_color_css = array(
			'.cm-footer-cols .cm-row .cm-widget-title span' => array(
				'color' => esc_html( $footer_widget_title_color ),
			),
		);

		$parse_css .= colormag_parse_css( '#ffffff', $footer_widget_title_color, $footer_widget_title_color_css );

		// Footer widget content color.
		$footer_widget_content_color_css = array(
			'.cm-footer-cols .cm-row,
			.cm-footer-cols .cm-row p' => array(
				'color' => esc_html( $footer_widget_content_color ),
			),
		);

		$parse_css .= colormag_parse_css( '#ffffff', $footer_widget_content_color, $footer_widget_content_color_css );

		// Footer widget content link text color.
		$footer_widget_content_link_text_color_css = array(
			'.cm-footer-cols .cm-row a' => array(
				'color' => esc_html( $footer_widget_content_link_text_color ),
			),
		);

		$parse_css .= colormag_parse_css( '#ffffff', $footer_widget_content_link_text_color, $footer_widget_content_link_text_color_css );

		// Footer widget content link text hover color.
		$footer_widget_content_link_text_hover_color_css = array(
			'.cm-footer-cols .cm-row a:hover' => array(
				'color' => esc_html( $footer_widget_content_link_text_hover_color ),
			),
		);

		$parse_css .= colormag_parse_css( '#207daf', $footer_widget_content_link_text_hover_color, $footer_widget_content_link_text_hover_color_css );

		$button_border_radius_default = array(
			'size' => 3,
			'unit' => 'px',
		);

		/**
		 * Typography.
		 */
		// Comment title typography.
		$parse_css .= colormag_parse_typography_css(
			$comment_title_typography_default,
			$comment_title_typography,
			'.comments-title,
			.comment-reply-title,
			#respond h3#reply-title',
			array(
				'tablet' => 768,
				'mobile' => 600,
			)
		);

		// Footer widget title typography.
		$parse_css .= colormag_parse_typography_css(
			$footer_widget_title_typography_default,
			$footer_widget_title_typography,
			'.cm-footer-cols .cm-row .cm-widget-title',
			array(
				'tablet' => 768,
				'mobile' => 600,
			)
		);

		// Footer widget content typography.
		$parse_css .= colormag_parse_typography_css(
			$footer_widget_content_typography_default,
			$footer_widget_content_typography,
			'#cm-footer,
			#cm-footer p',
			array(
				'tablet' => 768,
				'mobile' => 600,
			)
		);

		// Add the custom CSS rendered dynamically, which is static.
		$parse_css .= self::render_custom_output();

		$parse_css .= $dynamic_css;

		$parse_css .= self::colormag_editor_block_css();

		return apply_filters( 'colormag_theme_dynamic_css', $parse_css );

	}

	/**
	 * Function to output Custom CSS code, which does not have the specific CSS design option, ie, static CSS code.
	 *
	 * @return string
	 */
	public static function render_custom_output() {

		/**
		 * Variable declarations.
		 */
		// Post metas.
		$colormag_all_entry_meta_remove      = get_theme_mod( 'colormag_all_entry_meta_remove', 0 );
		$colormag_author_entry_meta_remove   = get_theme_mod( 'colormag_author_entry_meta_remove', 0 );
		$colormag_date_entry_meta_remove     = get_theme_mod( 'colormag_date_entry_meta_remove', 0 );
		$colormag_category_entry_meta_remove = get_theme_mod( 'colormag_category_entry_meta_remove', 0 );
		$colormag_comments_entry_meta_remove = get_theme_mod( 'colormag_comments_entry_meta_remove', 0 );
		$colormag_tags_entry_meta_remove     = get_theme_mod( 'colormag_tags_entry_meta_remove', 0 );

		// Footer options.
		$footer_background_default = array(
			'background-color'      => '',
			'background-image'      => '',
			'background-position'   => 'center center',
			'background-size'       => 'auto',
			'background-attachment' => 'scroll',
			'background-repeat'     => 'repeat',
		);
		$footer_background         = get_theme_mod( 'colormag_footer_background', $footer_background_default );

		// Color in menu.
		$category_menu_color = get_theme_mod( 'colormag_enable_category_color', '' );

		// Generate dynamic CSS.
		$colormag_custom_css = '';

		/**
		 * Post metas.
		 */
		// Total post meta remove.
		if ( 1 == $colormag_all_entry_meta_remove ) {
			$colormag_custom_css .= '.cm-entry-header-meta, .cm-below-entry-meta, .tg-module-meta, .tg-cm-post-categories{display:none}';
		}

		// Author remove from post meta.
		if ( 1 == $colormag_author_entry_meta_remove ) {
			$colormag_custom_css .= '.cm-below-entry-meta .byline, .elementor .elementor-widget-wrap .tg-module-wrapper .tg-module-meta .tg-post-auther-name{display:none}';
		}

		// Date remove from post meta.
		if ( 1 == $colormag_date_entry_meta_remove ) {
			$colormag_custom_css .= '.cm-below-entry-meta .cm-post-date, .elementor .elementor-widget-wrap .tg-module-wrapper .tg-module-meta .tg-post-date{display:none}';
		}

		// Category remove from post meta.
		if ( 1 == $colormag_category_entry_meta_remove ) {
			$colormag_custom_css .= '.cm-entry-header-meta, .tg-cm-post-categories{display:none}';
		}

		// Comments remove from post meta.
		if ( 1 == $colormag_comments_entry_meta_remove ) {
			$colormag_custom_css .= '.cm-below-entry-meta .comments, .elementor .elementor-widget-wrap .tg-module-wrapper .tg-module-meta .tg-module-comments{display:none}';
		}

		// Tags remove from post meta.
		if ( 1 == $colormag_tags_entry_meta_remove ) {
			$colormag_custom_css .= '.cm-below-entry-meta .tag-links{display:none}';
		}

		/**
		 * Footer options.
		 */

		// Footer background image.
		if ( $footer_background['background-image'] ) {
			$colormag_custom_css .= '.cm-footer-cols, .cm-footer-bar, .colormag-footer--classic .cm-footer-bar{background-color:transparent}';
		}

		// Category color in menu options.
		if ( 1 == $category_menu_color ) {
			$args       = array(
				'orderby'    => 'id',
				'hide_empty' => 0,
			);
			$categories = get_categories( $args );

			$colormag_custom_css .= '.cm-primary-nav .menunav-menu>li.menu-item-object-category>a{position:relative}.cm-primary-nav .menunav-menu>li.menu-item-object-category>a::before{content:"";position:absolute;top:-4px;left:0;right:0;height:4px;z-index:10;transition:width .35s}';

			foreach ( $categories as $category ) {
				$cat_color = get_theme_mod( 'colormag_category_color_' . absint( $category->term_id ) );
				$cat_id    = $category->term_id;

				if ( $cat_color ) {
					$colormag_custom_css .= '.cm-primary-nav .menu-item-object-category.menu-item-category-' . $cat_id . '>a::before, .cm-primary-nav .menu-item-object-category.menu-item-category-' . $cat_id . ':hover>a{background:' . $cat_color . '}';
				}
			}
		}

		return $colormag_custom_css;
	}

	/**
	 * Returns the background CSS property for editor.
	 *
	 * @param string|array $default_value Default value.
	 * @param string|array $output_value  Updated value.
	 * @param string       $selector      CSS selector.
	 *
	 * @return string|void Generated CSS for background CSS property.
	 */
	public static function colormag_editor_block_css() {
		$parse_css = '';

		// Primary color.
		$primary_color     = get_theme_mod( 'colormag_primary_color', '#207daf' );
		$primary_color_css = array(
			'.mzb-featured-posts, .mzb-social-icon, .mzb-featured-categories, .mzb-social-icons-insert'
			=> array(
				'--color--light--primary' => ColorMag_Utils::adjust_color_opacity( $primary_color, 10 ),
			),

			'body'
			=> array(
				'--color--light--primary' => esc_html( $primary_color ),
				'--color--primary'        => esc_html( $primary_color ),
			),
		);

		$parse_css .= colormag_parse_css( '#207daf', $primary_color, $primary_color_css );

		// Post meta color.
		$post_meta_color     = get_theme_mod( 'colormag_post_meta_color', '#71717A' );
		$post_meta_color_css = array(
			'body' => array(
				'--color--gray' => esc_html( $post_meta_color ),
			),
		);

		$parse_css .= colormag_parse_css( '#888888', $post_meta_color, $post_meta_color_css );
		return $parse_css;

	}

}
