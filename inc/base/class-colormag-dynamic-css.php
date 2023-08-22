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
defined( 'ABSPATH' ) || exit;

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

		// Generate dynamic CSS.
		$parse_css = '';

		/**
		 * Global.
		 */

		// Primary Color.
		$primary_color = get_theme_mod( 'colormag_primary_color', '#207daf' );

		$primary_color_css = array(
			'.colormag-button,
			blockquote, button,
			input[type=reset],
			input[type=button],
			input[type=submit],
			.cm-home-icon.front_page_on,
			.cm-post-categories a,
			.cm-primary-nav ul li ul li:hover,
			.cm-primary-nav ul li.current-menu-item,
			.cm-primary-nav ul li.current_page_ancestor,
			.cm-primary-nav ul li.current-menu-ancestor,
			.cm-primary-nav ul li.current_page_item,
			.cm-primary-nav ul li:hover,
			.cm-primary-nav ul li.focus,
			.cm-mobile-nav li a:hover,
			.colormag-header-clean #cm-primary-nav .cm-menu-toggle:hover,
			.cm-header .cm-mobile-nav li:hover,
			.cm-header .cm-mobile-nav li.current-page-ancestor,
			.cm-header .cm-mobile-nav li.current-menu-ancestor,
			.cm-header .cm-mobile-nav li.current-page-item,
			.cm-header .cm-mobile-nav li.current-menu-item,
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
			.cm-error-404 .cm-btn, .widget .wp-block-heading, .wp-block-search button,
			.widget a::before, .cm-post-date a::before,
			.byline a::before,
			.colormag-footer--classic-bordered .cm-widget-title::before,
			.wp-block-button__link,
			#cm-tertiary .cm-widget-title span,
			.link-pagination .post-page-numbers.current,
			.wp-block-query-pagination-numbers .page-numbers.current,
			.wp-element-button,
			.wp-block-button .wp-block-button__link,
			.wp-element-button,
			.cm-layout-2 .cm-primary-nav ul ul.sub-menu li:hover,
			.cm-layout-2 .cm-primary-nav ul ul.sub-menu li.current-menu-ancestor,
			.cm-layout-2 .cm-primary-nav ul ul.sub-menu li.current-menu-item,
			.cm-layout-2 .cm-primary-nav ul ul.sub-menu li.focus,
			.search-wrap button,
			.page-numbers .current,
			.wp-block-search .wp-element-button:hover' => array(
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
			.social-links:not(.cm-header-actions .social-links) i.fa:hover, .cm-tag-links a:hover,
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
			.entry-meta .cm-tag-links a:hover, .single #content .tags a:hover, .count, .next a:hover, .previous a:hover,
			.related-posts-main-title .fa, .single-related-posts .article-content .cm-entry-title a:hover,
			.pagination a span:hover,
			#content .comments-area a.comment-cm-edit-link:hover, #content .comments-area a.comment-permalink:hover,
			#content .comments-area article header cite a:hover, .comments-area .comment-author-link a:hover,
			.comment .comment-reply-link:hover,
			.nav-next a, .nav-previous a,
			#cm-footer .cm-footer-menu ul li a:hover,
			.cm-footer-cols .cm-row a:hover, a#scroll-up i, .related-posts-wrapper-flyout .cm-entry-title a:hover,
			.human-diff-time .human-diff-time-display:hover,
			.cm-layout-2-style-1 #cm-primary-nav .fa:hover,
			.cm-footer-bar a,
			.cm-post-date a:hover,
			.cm-author a:hover,
			.cm-comments-link a:hover,
			.cm-tag-links a:hover,
			.cm-edit-link a:hover,
			.cm-footer-bar .copyright a,
			.cm-featured-posts .cm-entry-title a:hover,
			.cm-posts .post .cm-post-content .cm-entry-title a:hover,
			.cm-posts .post .single-title-above .cm-entry-title a:hover,
			.cm-layout-2 .cm-primary-nav ul li:hover > a,
			.cm-layout-2 #cm-primary-nav .fa:hover,
			.cm-entry-title a:hover,
			button:hover, input[type="button"]:hover,
			input[type="reset"]:hover,
			input[type="submit"]:hover,
			.wp-block-button .wp-block-button__link:hover,
			.cm-button:hover,
			.wp-element-button:hover,
			li.product .added_to_cart:hover,
			.comments-area .comment-permalink:hover,
			.cm-footer-bar-area .cm-footer-bar__2 a'
			=> array(
				'color' => esc_html( $primary_color ),
			),

			'#cm-primary-nav,
			.cm-contained .cm-header-2 .cm-row'
			=> array(
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
			button,
			input[type="button"],
			input[type="reset"],
			input[type="submit"],
			.wp-block-button .wp-block-button__link,
			.cm-button,
			.wp-element-button,
			li.product .added_to_cart'
			=> array(
				'border-color' => esc_html( $primary_color ),
			),

			'.cm-secondary .cm-widget-title,
			#cm-tertiary .cm-widget-title,
			.widget_featured_posts .widget-title,
			#secondary .widget-title,
			#cm-tertiary .widget-title,
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
			.cm-layout-2 .cm-primary-nav ul > li.current-menu-item > a'
			=> array(
				'border-bottom-color' => esc_html( $primary_color ),
			),
		);

		$parse_css .= colormag_parse_css( '#207daf', $primary_color, $primary_color_css );

		// Top bar options.
		$top_bar_background_color     = get_theme_mod( 'colormag_top_bar_background_color', '#fff' );
		$top_bar_background_color_css = array(
			'.cm-top-bar' => array(
				'background-color' => esc_html( $top_bar_background_color ),
			),
		);
		$parse_css                   .= colormag_parse_css( '#fff', $top_bar_background_color, $top_bar_background_color_css );

		// Post content background.
		$post_content_background_default = array(
			'background-color'      => '#ffffff',
			'background-image'      => '',
			'background-position'   => 'center center',
			'background-size'       => 'auto',
			'background-attachment' => 'scroll',
			'background-repeat'     => 'repeat',
		);
		$post_content_background         = get_theme_mod( 'colormag_inside_container_background', $post_content_background_default );
		$parse_css                      .= colormag_parse_background_css( $post_content_background_default, $post_content_background, '.cm-content' );

		// Main header options.
		$header_background_default = array(
			'background-color'      => '',
			'background-image'      => '',
			'background-position'   => 'center center',
			'background-size'       => 'auto',
			'background-attachment' => 'scroll',
			'background-repeat'     => 'repeat',
		);
		$header_background         = get_theme_mod( 'colormag_main_header_background', $header_background_default );
		$parse_css                .= colormag_parse_background_css( $header_background_default, $header_background, '.cm-header-1, .dark-skin .cm-header-1' );

		// Primary menu options.
		$primary_menu_background_default = array(
			'background-color'      => '#27272A',
			'background-image'      => '',
			'background-position'   => 'center center',
			'background-size'       => 'auto',
			'background-attachment' => 'scroll',
			'background-repeat'     => 'repeat',
		);
		$primary_menu_background         = get_theme_mod( 'colormag_primary_menu_background', $primary_menu_background_default );
		$parse_css                      .= colormag_parse_background_css( $primary_menu_background_default, $primary_menu_background, '#cm-primary-nav, .cm-layout-2 #cm-primary-nav' );

		$primary_menu_top_border_color     = get_theme_mod( 'colormag_primary_menu_top_border_color', '#207daf' );
		$primary_menu_top_border_color_css = array(
			'#cm-primary-nav' => array(
				'border-top-color' => esc_html( $primary_menu_top_border_color ),
			),
		);
		$parse_css                        .= colormag_parse_css( '#207daf', $primary_menu_top_border_color, $primary_menu_top_border_color_css );

		$primary_menu_text_color     = get_theme_mod( 'colormag_primary_menu_text_color', '' );
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
			'.cm-layout-2 .cm-primary-nav .cm-submenu-toggle .cm-icon,
		.cm-primary-nav .cm-submenu-toggle .cm-icon'      => array(
			'fill' => esc_html( $primary_menu_text_color ),
			),
		);
		$parse_css                  .= colormag_parse_css( '', $primary_menu_text_color, $primary_menu_text_color_css );

		$primary_menu_selected_hovered_text_color     = get_theme_mod( 'colormag_primary_menu_selected_hovered_text_color', '' );
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
			'.cm-layout-2 .cm-primary-nav li:hover > .cm-submenu-toggle .cm-icon,
			.cm-primary-nav li:hover > .cm-submenu-toggle .cm-icon
		'      => array(
				'fill' => esc_html( $primary_menu_selected_hovered_text_color ),
			),
		);
		$parse_css                                   .= colormag_parse_css( '', $primary_menu_selected_hovered_text_color, $primary_menu_selected_hovered_text_color_css );

		$primary_sub_menu_background_default = array(
			'background-color'      => '#232323',
			'background-image'      => '',
			'background-position'   => 'center center',
			'background-size'       => 'auto',
			'background-attachment' => 'scroll',
			'background-repeat'     => 'repeat',
		);
		$primary_sub_menu_background         = get_theme_mod( 'colormag_primary_sub_menu_background', $primary_sub_menu_background_default );
		$parse_css                          .= colormag_parse_background_css( $primary_sub_menu_background_default, $primary_sub_menu_background, '.cm-primary-nav .sub-menu, .cm-primary-nav .children' );

	// Header action color option
		$header_action_icon_color             = get_theme_mod( 'colormag_header_action_icon_color', '#fff' );
		$header_action_icon_color_css = array(
			'.fa.search-top' => array(
				'color' => esc_html( $header_action_icon_color ),
			),

			'.cm-primary-nav .cm-random-post a svg,
			.cm-mobile-nav .cm-random-post a svg' => array(
				'fill' => esc_html( $header_action_icon_color ),
			),
		);
		$parse_css .= colormag_parse_css( '#fff', $header_action_icon_color, $header_action_icon_color_css );

		$header_action_icon_hover_color             = get_theme_mod( 'colormag_header_action_icon_hover_color', '' );
		$header_action_icon_hover_color_css = array(
			'.fa.search-top:hover' => array(
				'color' => esc_html( $header_action_icon_hover_color ),
			),

			'.cm-primary-nav .cm-random-post a:hover > svg,
			.cm-mobile-nav .cm-random-post a:hover > svg' => array(
				'fill' => esc_html( $header_action_icon_hover_color ),
			),
		);
		$parse_css .= colormag_parse_css( '#fff', $header_action_icon_hover_color, $header_action_icon_hover_color_css );

	// Footer column options.
	$footer_background_default = array(
		'background-color'      => '',
		'background-image'      => '',
		'background-position'   => 'center center',
		'background-size'       => 'auto',
		'background-attachment' => 'scroll',
		'background-repeat'     => 'repeat',
	);
	$footer_background         = get_theme_mod( 'colormag_footer_background', $footer_background_default );
	$parse_css                .= colormag_parse_background_css( $footer_background_default, $footer_background, '.cm-footer-cols' );

		// Mobile menu toggle color.
		$mobile_menu_toggle_color = get_theme_mod( 'colormag_mobile_menu_toggle_icon_color', '#fff' );

		$mobile_menu_toggle_color_css = array(
			'.cm-header .cm-menu-toggle svg,
			.cm-header .cm-menu-toggle svg' => array(
			'fill' => esc_html( $mobile_menu_toggle_color ),
			),
		);

		$parse_css .= colormag_parse_css( '#333333', $mobile_menu_toggle_color, $mobile_menu_toggle_color_css );

		// Footer column options.
		$footer_background_default = array(
			'background-color'      => '',
			'background-image'      => '',
			'background-position'   => 'center center',
			'background-size'       => 'auto',
			'background-attachment' => 'scroll',
			'background-repeat'     => 'repeat',
		);
		$footer_background         = get_theme_mod( 'colormag_footer_background', $footer_background_default );
		$parse_css                .= colormag_parse_background_css( $footer_background_default, $footer_background, '.cm-footer-cols' );

		$footer_upper_background_default = array(
			'background-color'      => '',
			'background-image'      => '',
			'background-position'   => 'center center',
			'background-size'       => 'auto',
			'background-attachment' => 'scroll',
			'background-repeat'     => 'repeat',
		);
		$footer_upper_background         = get_theme_mod( 'colormag_upper_footer_background', $footer_upper_background_default );
		$parse_css                      .= colormag_parse_background_css( $footer_upper_background_default, $footer_upper_background, '.cm-footer .cm-upper-footer-cols .widget' );

		// Footer bar options.
		$footer_copyright_background_default = array(
			'background-color'      => '',
			'background-image'      => '',
			'background-position'   => 'center center',
			'background-size'       => 'auto',
			'background-attachment' => 'scroll',
			'background-repeat'     => 'repeat',
		);
		$footer_copyright_background         = get_theme_mod( 'colormag_footer_copyright_background', $footer_copyright_background_default );
		$parse_css                          .= colormag_parse_background_css( $footer_copyright_background_default, $footer_copyright_background, '.cm-footer-bar' );

		$footer_copyright_color     = get_theme_mod( 'colormag_footer_copyright_text_color', '#F4F4F5' );
		$footer_copyright_color_css = array(
			'.cm-footer-bar-area .cm-footer-bar__2' => array(
				'color' => esc_html( $footer_copyright_color ),
			),
		);
		$parse_css                 .= colormag_parse_css( '#F4F4F5', $footer_copyright_color, $footer_copyright_color_css );

		$footer_copyright_link_color     = get_theme_mod( 'colormag_footer_copyright_link_text_color', '#207daf' );
		$footer_copyright_link_color_css = array(
			'.cm-footer-bar-area .cm-footer-bar__2 a' => array(
				'color' => esc_html( $footer_copyright_link_color ),
			),
		);
		$parse_css                      .= colormag_parse_css( '##207daf', $footer_copyright_link_color, $footer_copyright_link_color_css );

		// Primary color for Elementor.
		if ( defined( 'ELEMENTOR_VERSION' ) ) {

			$primary_color_elementor_css = array(
				'.elementor .elementor-widget-wrap .tg-module-wrapper .module-title span,
			.elementor .elementor-widget-wrap .tg-module-wrapper .tg-post-category,
			.elementor .elementor-widget-wrap .tg-module-wrapper.tg-module-block.tg-module-block--style-5 .tg_module_block .read-more,
				.elementor .elementor-widget-wrap .tg-module-wrapper tg-module-block.tg-module-block--style-10 .tg_module_block.tg_module_block--list-small:before'
				=> array(
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
			.elementor .elementor-widget-wrap .tg-module-wrapper.tg-module-block.tg-module-block--style-10 .tg_module_block--white .tg-module-comments a:hover'
				=> array(
					'color' => esc_html( $primary_color ),
				),

				'.elementor .elementor-widget-wrap .tg-trending-news .swiper-controls .swiper-button-next:hover,
			.elementor .elementor-widget-wrap .tg-trending-news .swiper-controls .swiper-button-prev:hover'
				=> array(
					'border-color' => esc_html( $primary_color ),
				),
			);

			$parse_css .= colormag_parse_css( '#207daf', $primary_color, $primary_color_elementor_css );

		}

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

		// Generate dynamic CSS.
		$colormag_custom_css = '';

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

		return $parse_css;

	}

	/**
	 * Return dynamic CSS output.
	 *
	 * @param string $dynamic_css Dynamic CSS.
	 * @param string $dynamic_css_filtered Dynamic CSS Filters.
	 *
	 * @return string Generated CSS.
	 */
	public static function render_wc_output( $dynamic_css, $dynamic_css_filtered = '' ) {

		// Generate dynamic CSS.
		$parse_wc_css     = $dynamic_css;
		$wc_primary_color = get_theme_mod( 'colormag_primary_color', '#207daf' );

		$wc_primary_color_css = array(
			'.woocommerce-cart .actions .button,
			li.product .added_to_cart:hover'
			=> array(
				'border-color' => esc_html( $wc_primary_color ),
			),

			'li.product .added_to_cart,
			.woocommerce-MyAccount-navigation ul .is-active a'
			=> array(
				'background-color' => esc_html( $wc_primary_color ),
			),

			'.woocommerce-cart .actions .button[aria-disabled="true"]'
			=> array(
				'background-color' => esc_html( $wc_primary_color ),
				'border-color'     => esc_html( $wc_primary_color ),
			),

			'.product-subtotal,
			.woocommerce-cart .actions .button,
			li.product .added_to_cart:hover,
			.stock.in-stock,
			.woocommerce-MyAccount-navigation ul li a:hover,
			.woocommerce-MyAccount-navigation ul li a:focus'
			=> array(
				'color' => esc_html( $wc_primary_color ),
			),
		);

		$parse_wc_css .= colormag_parse_css( '#207daf', $wc_primary_color, $wc_primary_color_css );

		return $parse_wc_css;
	}
}
