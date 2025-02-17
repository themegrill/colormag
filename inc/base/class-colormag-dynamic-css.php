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
	 * @param string $dynamic_css Dynamic CSS.
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
			.format-link .cm-entry-summary a, .cm-entry-button, .infinite-scroll .tg-infinite-scroll,
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
			.cm-footer-builder .cm-widget-title span,
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
			.cm-contained .cm-header-2 .cm-row, .cm-header-builder.cm-full-width .cm-main-header .cm-header-bottom-row'
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
			.cm-footer-builder .cm-widget-title,
			.cm-layout-2 .cm-primary-nav ul > li.current-menu-item > a'
			=> array(
				'border-bottom-color' => esc_html( $primary_color ),
			),
		);

		$parse_css .= colormag_parse_css( '#207daf', $primary_color, $primary_color_css );

		// Base color
		$text_color     = get_theme_mod( 'colormag_base_color', '' );
		$text_color_css = array(
			'body' => array(
				'color' => esc_html( $text_color ),
			),
		);
		$parse_css     .= colormag_parse_css( '', $text_color, $text_color_css );

		// Box shadow color
		$box_shadow_color     = get_theme_mod( 'colormag_box_shadow_color', '' );
		$box_shadow_color_css = array(
			'.cm-posts .post' => array(
				'box-shadow' => '0px 0px 2px 0px ' . esc_html( $box_shadow_color ),
			),
		);
		$parse_css           .= colormag_parse_css( '', $box_shadow_color, $box_shadow_color_css );

		// Link colors.
		$link_color_normal     = get_theme_mod( 'colormag_link_color', '' );
		$link_color_normal_css = array(
			'.cm-entry-summary a' => array(
				'color' => esc_html( $link_color_normal ),
			),
		);
		$parse_css            .= colormag_parse_css( '', $link_color_normal, $link_color_normal_css );

		// Link hover color.
		$link_color_hover     = get_theme_mod( 'colormag_link_hover_color', '' );
		$link_color_hover_css = array(
			'.cm-entry-summary a:hover,
			.pagebuilder-content a:hover, .pagebuilder-content a:hover' => array(
	'color' => esc_html( $link_color_hover ),
),
		);
		$parse_css           .= colormag_parse_css( '', $link_color_hover, $link_color_hover_css );

		/**
		 * Typography options.
		 */
		$base_typography_default             = array(
			'font-family'    => 'default',
			'font-weight'    => 'regular',
			'subsets'        => array( 'latin' ),
			'font-size'      => array(
				'desktop' => array(
					'size' => '15',
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
			'line-height'    => array(
				'desktop' => array(
					'size' => '1.6',
					'unit' => '-',
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
			'font-style'     => 'normal',
			'text-transform' => 'none',
		);
		$headings_typography_default         = array(
			'font-family'    => 'default',
			'font-weight'    => 'regular',
			'subsets'        => array( 'latin' ),
			'line-height'    => array(
				'desktop' => array(
					'size' => '1.2',
					'unit' => '-',
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
			'letter-spacing' => array(
				'desktop' => array(
					'size' => '',
					'unit' => '',
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
			'font-style'     => 'inherit',
			'text-transform' => 'none',
		);
		$heading_h1_typography_default       = array(
			'font-family'    => 'default',
			'font-weight'    => 'regular',
			'subsets'        => array( 'latin' ),
			'font-size'      => array(
				'desktop' => array(
					'size' => '36',
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
			'line-height'    => array(
				'desktop' => array(
					'size' => '1.2',
					'unit' => '-',
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
			'letter-spacing' => array(
				'desktop' => array(
					'size' => '',
					'unit' => '',
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
			'font-style'     => 'normal',
			'text-transform' => 'none',
		);
		$heading_h2_typography_default       = array(
			'font-family'    => 'default',
			'font-weight'    => 'regular',
			'subsets'        => array( 'latin' ),
			'font-size'      => array(
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
			'line-height'    => array(
				'desktop' => array(
					'size' => '1.2',
					'unit' => '-',
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
			'letter-spacing' => array(
				'desktop' => array(
					'size' => '',
					'unit' => '',
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
			'font-style'     => 'normal',
			'text-transform' => 'none',
		);
		$heading_h3_typography_default       = array(
			'font-family'    => 'default',
			'font-weight'    => 'regular',
			'subsets'        => array( 'latin' ),
			'font-size'      => array(
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
			'line-height'    => array(
				'desktop' => array(
					'size' => '1.2',
					'unit' => '-',
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
			'letter-spacing' => array(
				'desktop' => array(
					'size' => '',
					'unit' => '',
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
			'font-style'     => 'normal',
			'text-transform' => 'none',
		);
		$heading_h4_typography_default       = array(
			'font-family' => 'default',
			'font-weight' => 'regular',
			'subsets'     => array( 'latin' ),
			'font-size'   => array(
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
			'line-height' => array(
				'desktop' => array(
					'size' => '1.2',
					'unit' => '-',
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
		$heading_h5_typography_default       = array(
			'font-family' => 'default',
			'font-weight' => 'regular',
			'subsets'     => array( 'latin' ),
			'font-size'   => array(
				'desktop' => array(
					'size' => '22',
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
			'line-height' => array(
				'desktop' => array(
					'size' => '1.2',
					'unit' => '-',
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
		$heading_h6_typography_default       = array(
			'font-family' => 'default',
			'font-weight' => 'regular',
			'subsets'     => array( 'latin' ),
			'font-size'   => array(
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
			'line-height' => array(
				'desktop' => array(
					'size' => '1.2',
					'unit' => '-',
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
		$site_title_typography_default       = array(
			'font-family' => 'default',
			'font-size'   => array(
				'desktop' => array(
					'size' => '40',
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
		$site_tagline_typography_default     = array(
			'font-family' => 'default',
			'font-size'   => array(
				'desktop' => array(
					'size' => '16',
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
		$post_title_typography_default       = array(
			'font-family'    => 'default',
			'font-weight'    => 'regular',
			'font-size'      => array(
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
			'line-height'    => array(
				'desktop' => array(
					'size' => '1.3',
					'unit' => '-',
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
			'font-style'     => 'normal',
			'text-transform' => 'none',
		);

		$single_post_title_typography_default       = array(
			'font-family'    => 'default',
			'font-weight'    => 'regular',
			'font-size'      => array(
				'desktop' => array(
					'size' => '',
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
			'line-height'    => array(
				'desktop' => array(
					'size' => '1.3',
					'unit' => '-',
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
			'font-style'     => 'normal',
			'text-transform' => 'none',
		);

		$base_typography             = get_theme_mod( 'colormag_base_typography', $base_typography_default );
		$headings_typography         = get_theme_mod( 'colormag_headings_typography', $headings_typography_default );
		$heading_h1_typography       = get_theme_mod( 'colormag_h1_typography', $heading_h1_typography_default );
		$heading_h2_typography       = get_theme_mod( 'colormag_h2_typography', $heading_h2_typography_default );
		$heading_h3_typography       = get_theme_mod( 'colormag_h3_typography', $heading_h3_typography_default );
		$heading_h4_typography       = get_theme_mod( 'colormag_h4_typography', $heading_h4_typography_default );
		$heading_h5_typography       = get_theme_mod( 'colormag_h5_typography', $heading_h5_typography_default );
		$heading_h6_typography       = get_theme_mod( 'colormag_h6_typography', $heading_h6_typography_default );
		$site_title_typography       = get_theme_mod( 'colormag_site_title_typography', $site_title_typography_default );
		$site_tagline_typography     = get_theme_mod( 'colormag_site_tagline_typography', $site_tagline_typography_default );
		$primary_menu_typography     = get_theme_mod( 'colormag_primary_menu_typography', $primary_menu_typography_default );
		$mobile_menu_typography     = get_theme_mod( 'colormag_mobile_menu_typography', $primary_menu_typography_default );
		$primary_sub_menu_typography = get_theme_mod( 'colormag_primary_sub_menu_typography', $primary_sub_menu_typography_default );
		$mobile_sub_menu_typography = get_theme_mod( 'colormag_mobile_sub_menu_typography', $primary_sub_menu_typography_default );
		$post_title_typography       = get_theme_mod( 'colormag_blog_post_title_typography', $post_title_typography_default );
		$single_post_title_typography       = get_theme_mod( 'colormag_single_post_title_typography', $single_post_title_typography_default );

		/**
		 * Typography.
		 */
		// Base typography.
		$parse_css .= colormag_parse_typography_css(
			$base_typography_default,
			$base_typography,
			'body,
			button,
			input,
			select,
			textarea,
			blockquote p,
			.entry-meta,
			.cm-entry-button,
			dl,
			.previous a,
			.next a,
			.nav-previous a,
			.nav-next a,
			#respond h3#reply-title #cancel-comment-reply-link,
			#respond form input[type="text"],
			#respond form textarea,
			.cm-secondary .widget,
			.cm-error-404 .widget,
			.cm-entry-summary p',
			array(
				'tablet' => 768,
				'mobile' => 600,
			)
		);

		// Headings typography.
		$parse_css .= colormag_parse_typography_css(
			$headings_typography_default,
			$headings_typography,
			'h1 ,h2, h3, h4, h5, h6',
			array(
				'tablet' => 768,
				'mobile' => 600,
			)
		);

		// Heading H1 typography.
		$parse_css .= colormag_parse_typography_css(
			$heading_h1_typography_default,
			$heading_h1_typography,
			'h1',
			array(
				'tablet' => 768,
				'mobile' => 600,
			)
		);

		// Heading H2 typography.
		$parse_css .= colormag_parse_typography_css(
			$heading_h2_typography_default,
			$heading_h2_typography,
			'h2',
			array(
				'tablet' => 768,
				'mobile' => 600,
			)
		);

		// Heading H3 typography.
		$parse_css .= colormag_parse_typography_css(
			$heading_h3_typography_default,
			$heading_h3_typography,
			'h3',
			array(
				'tablet' => 768,
				'mobile' => 600,
			)
		);

		// Heading H4 typography.
		$parse_css .= colormag_parse_typography_css(
			$heading_h4_typography_default,
			$heading_h4_typography,
			'h4',
			array(
				'tablet' => 768,
				'mobile' => 600,
			)
		);

		// Heading H5 typography.
		$parse_css .= colormag_parse_typography_css(
			$heading_h5_typography_default,
			$heading_h5_typography,
			'h5',
			array(
				'tablet' => 768,
				'mobile' => 600,
			)
		);

		// Heading H6 typography.
		$parse_css .= colormag_parse_typography_css(
			$heading_h6_typography_default,
			$heading_h6_typography,
			'h6',
			array(
				'tablet' => 768,
				'mobile' => 600,
			)
		);

		// Post title typography.
		$parse_css .= colormag_parse_typography_css(
			$post_title_typography_default,
			$post_title_typography,
			'.cm-entry-title',
			array(
				'tablet' => 768,
				'mobile' => 600,
			)
		);

		// Single post title typography.
		$parse_css .= colormag_parse_typography_css(
			$single_post_title_typography_default,
			$single_post_title_typography,
			'.single .cm-entry-header .cm-entry-title',
			array(
				'tablet' => 768,
				'mobile' => 600,
			)
		);

		// Site title typography.
		$parse_css .= colormag_parse_typography_css(
			$site_title_typography_default,
			$site_title_typography,
			'.cm-site-title',
			array(
				'tablet' => 768,
				'mobile' => 600,
			)
		);

		// Site tagline typography.
		$parse_css .= colormag_parse_typography_css(
			$site_tagline_typography_default,
			$site_tagline_typography,
			'.cm-site-description',
			array(
				'tablet' => 768,
				'mobile' => 600,
			)
		);

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

		// Mobile menu typography.
		$parse_css .= colormag_parse_typography_css(
			$primary_menu_typography_default,
			$mobile_menu_typography,
			'.cm-mobile-nav ul li a',
			array(
				'tablet' => 768,
				'mobile' => 600,
			)
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

		// Mobile menu typography.
		$parse_css .= colormag_parse_typography_css(
			$primary_sub_menu_typography_default,
			$mobile_sub_menu_typography,
			'.cm-mobile-nav ul li ul li a',
			array(
				'tablet' => 768,
				'mobile' => 600,
			)
		);

		// Site title color.
		$site_title_color = get_theme_mod( 'colormag_site_title_color', '' );

		$site_title_color_css = array(
			'.cm-site-title a' => array(
				'color' => esc_html( $site_title_color ),
			),
		);

		$parse_css .= colormag_parse_css( '', $site_title_color, $site_title_color_css );

		// Site title hover color.
		$site_title_hover_color = get_theme_mod( 'colormag_site_title_hover_color', '' );

		$site_title_hover_color_css = array(
			'.cm-site-title a:hover' => array(
				'color' => esc_html( $site_title_hover_color ),
			),
		);

		$parse_css .= colormag_parse_css( '', $site_title_hover_color, $site_title_hover_color_css );

		// Site tagline color.
		$site_tagline_color = get_theme_mod( 'colormag_site_tagline_color', '' );

		$site_tagline_color_css = array(
			'.cm-site-description' => array(
				'color' => esc_html( $site_tagline_color ),
			),
		);

		$parse_css .= colormag_parse_css( '', $site_tagline_color, $site_tagline_color_css );

		/**
		 * Sidebar width.
		 */
		$sidebar_width_default = array(
			'size' => 30,
			'unit' => '%',
		);

		$sidebar_width = get_theme_mod( 'colormag_sidebar_width', $sidebar_width_default );

		$content_width_css = array(
			'.cm-primary' => array(
				'width' => ( 100 - (float) $sidebar_width['size'] ) . '%',
			),
		);

		$parse_css .= '@media screen and (min-width: 992px) {';
		$parse_css .= colormag_parse_css( 70, ( 100 - (float) $sidebar_width['size'] ), $content_width_css );
		$parse_css .= colormag_parse_slider_css(
			$sidebar_width_default,
			$sidebar_width,
			'.cm-secondary ',
			'width'
		);
		$parse_css .= '}';

		/**
		 * Primary menu top border width.
		 */
		$primary_menu_width_default = array(
			'size' => '4',
			'unit' => 'px',
		);

		$primary_menu_width = get_theme_mod( 'colormag_primary_menu_top_border_width', $primary_menu_width_default );

		$parse_css .= colormag_parse_slider_css(
			$primary_menu_width_default,
			$primary_menu_width,
			'#cm-primary-nav',
			'border-top-width'
		);

		// Button text color.
		$button_text_color = get_theme_mod( 'colormag_button_color', '' );

		$button_text_color_css = array(
			'.colormag-button,
			input[type="reset"],
			input[type="button"],
			input[type="submit"],
			button,
			.cm-entry-button span,
			.wp-block-button .wp-block-button__link' => array(
		'color' => esc_html( $button_text_color ),
		),
		);

		$parse_css .= colormag_parse_css( '', $button_text_color, $button_text_color_css );

		// Button text hover color.
		$button_hover_text_color = get_theme_mod( 'colormag_button_hover_color', '' );

		$button_hover_text_color_css = array(
			'.colormag-button:hover,
			input[type="reset"]:hover,
			input[type="button"]:hover,
			input[type="submit"]:hover,
			button:hover,
			.cm-entry-button span:hover,
			.wp-block-button .wp-block-button__link:hover' => array(
		'color' => esc_html( $button_hover_text_color ),
		),
		);

		$parse_css .= colormag_parse_css( '', $button_hover_text_color, $button_hover_text_color_css );

		// Button background color.
		$button_background_color = get_theme_mod( 'colormag_button_background_color', '' );

		$button_background_color_css = array(
			'.colormag-button,
			input[type="reset"],
			input[type="button"],
			input[type="submit"],
			button,
			.cm-entry-button span,
			.wp-block-button .wp-block-button__link' => array(
		'background-color' => esc_html( $button_background_color ),
		),
		);

		$parse_css .= colormag_parse_css( '#207daf', $button_background_color, $button_background_color_css );

		// Button background hover color.
		$button_background_hover_color = get_theme_mod( 'colormag_button_background_hover_color', '' );

		$button_background_hover_color_css = array(
			'.colormag-button:hover,
			input[type="reset"]:hover,
			input[type="button"]:hover,
			input[type="submit"]:hover,
			button:hover,
			.cm-entry-button span:hover,
			.wp-block-button .wp-block-button__link:hover' => array(
		'background-color' => esc_html( $button_background_hover_color ),
		),
		);

		$parse_css .= colormag_parse_css( '', $button_background_hover_color, $button_background_hover_color_css );

		// Footer widget title color.
		$footer_widget_title_color = get_theme_mod( 'colormag_footer_widget_title_color', '' );

		$footer_widget_title_color_css = array(
			'.cm-footer-cols .cm-row .cm-widget-title span' => array(
				'color' => esc_html( $footer_widget_title_color ),
			),
		);

		$parse_css .= colormag_parse_css( '', $footer_widget_title_color, $footer_widget_title_color_css );

		// Footer content color.
		$footer_widget_content_color = get_theme_mod( 'colormag_footer_widget_content_color', '' );

		$footer_widget_content_color_css = array(
			'.cm-footer-cols .cm-row,
			.cm-footer-cols .cm-row p' => array(
		'color' => esc_html( $footer_widget_content_color ),
		),
		);

		$parse_css .= colormag_parse_css( '', $footer_widget_content_color, $footer_widget_content_color_css );

		// Footer Widget link color.
		$footer_widget_link_color = get_theme_mod( 'colormag_footer_widget_content_link_text_color', '' );

		$footer_widget_link_color_css = array(
			'.cm-footer-cols .cm-row a' => array(
				'color' => esc_html( $footer_widget_link_color ),
			),
		);

		$parse_css .= colormag_parse_css( '', $footer_widget_link_color, $footer_widget_link_color_css );

		// Footer Widget link hover color.
		$footer_widget_link_hover_color = get_theme_mod( 'colormag_footer_widget_content_link_text_hover_color', '' );

		$footer_widget_link_hover_color_css = array(
			'.cm-footer-cols .cm-row a:hover' => array(
				'color' => esc_html( $footer_widget_link_hover_color ),
			),
		);

		$parse_css .= colormag_parse_css( '', $footer_widget_link_hover_color, $footer_widget_link_hover_color_css );

		/**
		 * Button.
		 */
		$button_padding_default = array(
			'top'    => '',
			'right'  => '',
			'bottom' => '',
			'left'   => '',
			'unit'   => 'px',
		);

		$button_padding = get_theme_mod( 'colormag_button_dimension_padding', $button_padding_default );

		$parse_css .= colormag_parse_dimension_css(
			$button_padding_default,
			$button_padding,
			'.colormag-button,
			input[type="reset"],
			input[type="button"],
			input[type="submit"],
			button,
			.cm-entry-button span,
			.wp-block-button .wp-block-button__link',
			'padding'
		);

		// Border radius.
		$button_border_radius_default = array(
			'size' => 3,
			'unit' => 'px',
		);

		$button_border_radius = get_theme_mod( 'colormag_button_border_radius', '' );

		$parse_css .= colormag_parse_slider_css(
			$button_border_radius_default,
			$button_border_radius,
			'.cm-entry-button span,.colormag-button, input[type="reset"], input[type="button"], input[type="submit"], button, .more-link, .wp-block-button .wp-block-button__link',
			'border-radius'
		);

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

		// Outside Background
		$outside_background_default = array(
			'background-color'      => '',
			'background-image'      => '',
			'background-position'   => 'center center',
			'background-size'       => 'auto',
			'background-attachment' => 'scroll',
			'background-repeat'     => 'repeat',
		);
		$outside_background         = get_theme_mod( 'colormag_outside_container_background', $outside_background_default );
		$parse_css                      .= colormag_parse_background_css( $outside_background_default, $outside_background, 'body' );

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
		$parse_css                      .= colormag_parse_background_css( $primary_menu_background_default, $primary_menu_background, '.cm-mobile-nav li, #cm-primary-nav, .cm-layout-2 #cm-primary-nav, .cm-header .cm-main-header .cm-primary-nav .cm-row, .cm-home-icon.front_page_on' );

		$primary_menu_top_border_color     = get_theme_mod( 'colormag_primary_menu_top_border_color', '#207daf' );
		$primary_menu_top_border_color_css = array(
			'#cm-primary-nav' => array(
				'border-top-color' => esc_html( $primary_menu_top_border_color ),
			),
		);
		$parse_css                        .= colormag_parse_css( '#207daf', $primary_menu_top_border_color, $primary_menu_top_border_color_css );

		$header_primary_menu_text_color     = get_theme_mod( 'colormag_primary_menu_text_color', '' );
		$header_primary_menu_text_color_css = array(
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
	'color' => esc_html( $header_primary_menu_text_color ),
),
			'.cm-layout-2 .cm-primary-nav .cm-submenu-toggle .cm-icon,
		.cm-primary-nav .cm-submenu-toggle .cm-icon'      => array(
		'fill' => esc_html( $header_primary_menu_text_color ),
		),
		);
		$parse_css                  .= colormag_parse_css( '', $header_primary_menu_text_color, $header_primary_menu_text_color_css );

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
		' => array(
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

		$mobile_sub_menu_background_default = array(
			'background-color'      => '#232323',
			'background-image'      => '',
			'background-position'   => 'center center',
			'background-size'       => 'auto',
			'background-attachment' => 'scroll',
			'background-repeat'     => 'repeat',
		);
		$mobile_sub_menu_background         = get_theme_mod( 'colormag_mobile_sub_menu_background', $mobile_sub_menu_background_default );
		$parse_css                          .= colormag_parse_background_css( $mobile_sub_menu_background_default, $mobile_sub_menu_background, '.cm-mobile-nav .sub-menu,.cm-mobile-nav .sub-menu li, .cm-mobile-nav .children' );

		// Header action color option
		$header_action_icon_color     = get_theme_mod( 'colormag_header_action_icon_color', '#fff' );
		$header_action_icon_color_css = array(
			'.fa.search-top'                      => array(
				'color' => esc_html( $header_action_icon_color ),
			),

			'.cm-primary-nav .cm-random-post a svg,
			.cm-mobile-nav .cm-random-post a svg' => array(
		'fill' => esc_html( $header_action_icon_color ),
		),
		);
		$parse_css .= colormag_parse_css( '#fff', $header_action_icon_color, $header_action_icon_color_css );

		$header_action_icon_hover_color     = get_theme_mod( 'colormag_header_action_icon_hover_color', '' );
		$header_action_icon_hover_color_css = array(
			'.fa.search-top:hover'                        => array(
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

		$mobile_menu_text_color     = get_theme_mod( 'colormag_mobile_menu_text_color', '' );
		$mobile_menu_text_color_css = array(
			'.cm-mobile-nav a,
		.cm-mobile-nav ul li ul li a,
		.cm-mobile-nav ul li.current-menu-item ul li a,
		.cm-mobile-nav ul li ul li.current-menu-item a,
		.cm-mobile-nav ul li.current_page_ancestor ul li a,
		.cm-mobile-nav ul li.current-menu-ancestor ul li a,
		.cm-mobile-nav ul li.current_page_item ul li a,
		.cm-mobile-nav li.menu-item-has-children>a::after,
		.cm-mobile-nav li.page_item_has_children>a::after,
		.cm-layout-2-style-1 .cm-mobile-nav a,
		.cm-layout-2-style-1 .cm-mobile-nav ul > li > a' => array(
				'color' => esc_html( $mobile_menu_text_color ),
			),
			'.cm-layout-2 .cm-mobile-nav .cm-submenu-toggle .cm-icon,
		.cm-mobile-nav .cm-submenu-toggle .cm-icon'      => array(
				'fill' => esc_html( $mobile_menu_text_color ),
			),
		);
		$parse_css                  .= colormag_parse_css( '', $mobile_menu_text_color, $mobile_menu_text_color_css );

		$mobile_menu_selected_hovered_text_color     = get_theme_mod( 'colormag_mobile_menu_selected_hovered_text_color', '' );
		$mobile_menu_selected_hovered_text_color_css = array(
			'.cm-mobile-nav a:hover,
		.cm-mobile-nav ul li.current-menu-item a,
		.cm-mobile-nav ul li ul li.current-menu-item a,
		.cm-mobile-nav ul li.current_page_ancestor a,
		.cm-mobile-nav ul li.current-menu-ancestor a,
		.cm-mobile-nav ul li.current_page_item a, .cm-mobile-nav ul li:hover>a,
		.cm-mobile-nav ul li ul li a:hover, .cm-mobile-nav ul li ul li:hover>a,
		.cm-mobile-nav ul li.current-menu-item ul li a:hover,
		.cm-mobile-nav li.page_item_has_children.current-menu-item>a::after,
		.cm-layout-2-style-1 .cm-mobile-nav ul li:hover > a' => array(
				'color' => esc_html( $mobile_menu_selected_hovered_text_color ),
			),
			'.cm-layout-2 .cm-mobile-nav li:hover > .cm-submenu-toggle .cm-icon,
			.cm-mobile-nav li:hover > .cm-submenu-toggle .cm-icon
		' => array(
				'fill' => esc_html( $mobile_menu_selected_hovered_text_color ),
			),
		);
		$parse_css                                   .= colormag_parse_css( '', $mobile_menu_selected_hovered_text_color, $mobile_menu_selected_hovered_text_color_css );

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
		$parse_css .= self::render_builder_output($parse_css);

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
	 * @param string|array $output_value Updated value.
	 * @param string $selector CSS selector.
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

	/**
	 * Return dynamic CSS output.
	 *
	 * @param string $dynamic_css Dynamic CSS.
	 * @param string $dynamic_css_filtered Dynamic CSS Filters.
	 *
	 * @return string Generated CSS.
	 */
	public static function render_builder_output( $dynamic_css, $dynamic_css_filtered = '' ) {

		// Generate dynamic CSS.
		$parse_builder_css = $dynamic_css;

		$date_color = get_theme_mod('colormag_date_color', '');

		$date_color_css = array(
			'.cm-header-builder .date-in-header' => array(
				'color' => esc_html( $date_color ),
			),
		);
		$parse_builder_css           .= colormag_parse_css( '', $date_color, $date_color_css );

		$date_typography_default = array(
			'font-family'    => 'default',
			'font-weight'    => 'regular',
			'subsets'        => array( 'latin' ),
			'font-size'      => array(
				'desktop' => array(
					'size' => '',
					'unit' => 'px',
				),
				'tablet'  => array(
					'size' => '',
					'unit' => 'px',
				),
				'mobile'  => array(
					'size' => '',
					'unit' => 'px',
				),
			),
			'line-height'    => array(
				'desktop' => array(
					'size' => '',
					'unit' => '-',
				),
				'tablet'  => array(
					'size' => '',
					'unit' => '-',
				),
				'mobile'  => array(
					'size' => '',
					'unit' => '-',
				),
			),
			'font-style'     => 'normal',
			'text-transform' => 'none',
		);
		$date_typography             = get_theme_mod( 'colormag_date_typography', $date_typography_default );
		$parse_builder_css .= colormag_parse_typography_css(
			$date_typography_default,
			$date_typography,
			'.cm-header-builder .date-in-header',
			array(
				'tablet' => 768,
				'mobile' => 600,
			)
		);

		$news_ticker_color = get_theme_mod('colormag_news_ticker_color', '');

		$news_ticker_color_css = array(
			'.cm-header-builder .breaking-news-latest' => array(
				'color' => esc_html( $news_ticker_color ),
			),
		);
		$parse_builder_css           .= colormag_parse_css( '', $news_ticker_color, $news_ticker_color_css );

		$news_ticker_link_color = get_theme_mod('colormag_news_ticker_link_color', '');
		$news_ticker_link_color_css = array(
			'.cm-header-builder .newsticker li a' => array(
				'color' => esc_html( $news_ticker_link_color ),
			),
		);
		$parse_builder_css           .= colormag_parse_css( '', $news_ticker_link_color, $news_ticker_link_color_css );

		$news_ticker_typography_default = array(
			'font-family'    => 'default',
			'font-weight'    => 'regular',
			'subsets'        => array( 'latin' ),
			'font-size'      => array(
				'desktop' => array(
					'size' => '',
					'unit' => 'px',
				),
				'tablet'  => array(
					'size' => '',
					'unit' => 'px',
				),
				'mobile'  => array(
					'size' => '',
					'unit' => 'px',
				),
			),
			'line-height'    => array(
				'desktop' => array(
					'size' => '',
					'unit' => '-',
				),
				'tablet'  => array(
					'size' => '',
					'unit' => '-',
				),
				'mobile'  => array(
					'size' => '',
					'unit' => '-',
				),
			),
			'font-style'     => 'normal',
			'text-transform' => 'none',
		);
		$news_ticker_typography             = get_theme_mod( 'colormag_news_ticker_typography', $news_ticker_typography_default );
		$parse_builder_css .= colormag_parse_typography_css(
			$news_ticker_typography_default,
			$news_ticker_typography,
			'.cm-header-builder .breaking-news-latest',
			array(
				'tablet' => 768,
				'mobile' => 600,
			)
		);

		// Header html 1 color.
		$header_html_1_text_color     = get_theme_mod( 'colormag_header_html_1_text_color', '' );
		$header_html_1_text_color_css = array(
			'.cm-header-builder .cm-html-1 *' => array(
				'color' => esc_html( $header_html_1_text_color ),
			),
		);
		$parse_builder_css                          .= colormag_parse_css( '', $header_html_1_text_color, $header_html_1_text_color_css );

		// Header html 1 link color.
		$header_html_1_link_color     = get_theme_mod( 'colormag_header_html_1_link_color', '' );
		$header_html_1_link_color_css = array(
			'.cm-header-builder .cm-html-1 a' => array(
				'color' => esc_html( $header_html_1_link_color ),
			),
		);
		$parse_builder_css                          .= colormag_parse_css( '', $header_html_1_link_color, $header_html_1_link_color_css );

		// Header html 1 link hover color.
		$header_html_1_link_hover_color     = get_theme_mod( 'colormag_header_html_1_link_hover_color', '' );
		$header_html_1_link_hover_color_css = array(
			'.cm-header-builder .cm-html-1 a:hover' => array(
				'color' => esc_html( $header_html_1_link_hover_color ),
			),
		);
		$parse_builder_css                          .= colormag_parse_css( '', $header_html_1_link_hover_color, $header_html_1_link_hover_color_css );

		// Header html 1 font size.
		$header_html_1_font_size_default = array(
			'size' => '',
			'unit' => 'px',
		);

		$header_html_1_font_size = get_theme_mod( 'colormag_header_html_1_font_size', $header_html_1_font_size_default );

		$parse_builder_css .= colormag_parse_slider_css(
			$header_html_1_font_size_default,
			$header_html_1_font_size,
			'.cm-header-builder .cm-html-1 *',
			'font-size'
		);

		// Header html 1 margin.
		$header_html_1_margin_default = array(
			'top'    => '',
			'right'  => '',
			'bottom' => '',
			'left'   => '',
			'unit'   => 'px',
		);

		$header_html_1_margin = get_theme_mod( 'colormag_header_html_1_margin', $header_html_1_margin_default );

		$parse_builder_css .= colormag_parse_dimension_css(
			$header_html_1_margin_default,
			$header_html_1_margin,
			'.cm-header-builder .cm-html-1',
			'margin'
		);

		// Header button text color.
		$header_button_text_color     = get_theme_mod( 'colormag_header_button_color', '#ffffff' );
		$header_button_text_color_css = array(
			'.cm-header-builder .cm-header-buttons .cm-header-button .cm-button' => array(
				'color' => esc_html( $header_button_text_color ),
			),
		);
		$parse_builder_css                    .= colormag_parse_css( '#ffffff', $header_button_text_color, $header_button_text_color_css );

		// Header button hover text color.
		$header_button_hover_text_color     = get_theme_mod( 'colormag_header_button_hover_color', '#ffffff' );
		$header_button_hover_text_color_css = array(
			'.cm-header-builder .cm-header-buttons .cm-header-button .cm-button:hover' => array(
				'color' => esc_html( $header_button_hover_text_color ),
			),
		);
		$parse_builder_css                          .= colormag_parse_css( '#ffffff', $header_button_hover_text_color, $header_button_hover_text_color_css );

		// Header background color.
		$header_button_background_color     = get_theme_mod( 'colormag_header_button_background_color', '#027abb' );
		$header_button_background_color_css = array(
			'.cm-header-builder .cm-header-buttons .cm-header-button .cm-button' => array(
				'background-color' => esc_html( $header_button_background_color ),
			),
		);
		$parse_builder_css                          .= colormag_parse_css( '#027abb', $header_button_background_color, $header_button_background_color_css );

		// Header button hover background color.
		$header_button_background_hover_color     = get_theme_mod( 'colormag_header_button_background_hover_color', '' );
		$header_button_background_hover_color_css = array(
			'.cm-header-builder .cm-header-buttons .cm-header-button .cm-button:hover' => array(
				'background-color' => esc_html( $header_button_background_hover_color ),
			),
		);
		$parse_builder_css                                .= colormag_parse_css( '#ffffff', $header_button_background_hover_color, $header_button_background_hover_color_css );

		// Header button padding.
		$header_button_padding_default = array(
			'top'    => '5',
			'right'  => '10',
			'bottom' => '5',
			'left'   => '10',
			'unit'   => 'px',
		);

		$header_button_padding = get_theme_mod( 'colormag_header_button_padding', $header_button_padding_default );

		$parse_builder_css .= colormag_parse_dimension_css(
			$header_button_padding_default,
			$header_button_padding,
			'.cm-header-builder .cm-header-buttons .cm-header-button .cm-button',
			'padding'
		);

		// Header button border width.
		$header_button_border_width_default = array(
			'top'    => '',
			'right'  => '',
			'bottom' => '',
			'left'   => '',
			'unit'   => 'px',
		);

		$header_button_border_width = get_theme_mod( 'colormag_header_button_border_width', $header_button_border_width_default );

		$parse_builder_css .= colormag_parse_dimension_css(
			$header_button_border_width_default,
			$header_button_border_width,
			'.cm-header-builder .cm-header-buttons .cm-header-button .cm-button',
			'border-width'
		);

		// Header button border color.
		$header_button_border_color     = get_theme_mod( 'colormag_header_button_border_color', '' );
		$header_button_border_color_css = array(
			'.cm-header-builder .cm-header-buttons .cm-header-button .cm-button' => array(
				'border-color' => esc_html( $header_button_border_color ),
			),
		);
		$parse_builder_css                          .= colormag_parse_css( '', $header_button_border_color, $header_button_border_color_css );

		// Header button radius.
		$header_button_border_radius_default = array(
			'size' => 0,
			'unit' => 'px',
		);

		$header_button_border_radius = get_theme_mod( 'colormag_header_button_border_radius', $header_button_border_radius_default );

		$parse_builder_css .= colormag_parse_slider_css(
			$header_button_border_radius_default,
			$header_button_border_radius,
			'.cm-header-builder .cm-header-buttons .cm-header-button .cm-button',
			'border-radius'
		);

		/**
		 * Header top area height.
		 */
		$header_top_area_height_default = array(
			'size' => 0,
			'unit' => 'px',
		);

		$header_top_area_height = get_theme_mod( 'colormag_header_top_area_height', $header_top_area_height_default );

		$parse_builder_css .= colormag_parse_slider_css(
			$header_top_area_height_default,
			$header_top_area_height,
			'.cm-header-builder .cm-top-row',
			'height'
		);

		/**
		 * Header top area container.
		 */
		$header_top_area_container_default = array(
			'size' => 0,
			'unit' => 'px',
		);

		$header_top_area_container = get_theme_mod( 'colormag_header_top_area_container', $header_top_area_container_default );

		$parse_builder_css .= colormag_parse_slider_css(
			$header_top_area_container_default,
			$header_top_area_container,
			'.cm-header-builder .cm-header-top-row .cm-container',
			'max-width'
		);

		// Header top area background.
		$header_top_area_background_default = array(
			'background-color'      => '',
			'background-image'      => '',
			'background-repeat'     => 'repeat',
			'background-position'   => 'center center',
			'background-size'       => 'contain',
			'background-attachment' => 'scroll',
		);
		$header_top_area_background         = get_theme_mod( 'colormag_header_top_area_background', $header_top_area_background_default );
		$parse_builder_css                           .= colormag_parse_background_css( $header_top_area_background_default, $header_top_area_background, '.cm-header-builder .cm-header-top-row' );

		// Header top area padding.
		$header_top_area_padding_default = array(
			'top'    => '14',
			'right'  => '0',
			'bottom' => '14',
			'left'   => '0',
			'unit'   => 'px',
		);

		$header_top_area_padding = get_theme_mod( 'colormag_header_top_area_padding', $header_top_area_padding_default );

		$parse_builder_css .= colormag_parse_dimension_css(
			$header_top_area_padding_default,
			$header_top_area_padding,
			'.cm-header-builder .cm-header-top-row',
			'padding'
		);

		// Header top area border width.
		$header_top_area_border_width_default = array(
			'top'    => '0',
			'right'  => '0',
			'bottom' => '0',
			'left'   => '0',
			'unit'   => 'px',
		);

		$header_top_area_border_width = get_theme_mod( 'colormag_header_top_area_border_width', $header_top_area_border_width_default );

		$parse_builder_css .= colormag_parse_dimension_css(
			$header_top_area_border_width_default,
			$header_top_area_border_width,
			'.cm-header-builder .cm-header-top-row',
			'border-width'
		);

		$header_top_area_border_color     = get_theme_mod( 'colormag_header_top_area_border_color', '#FAFAFA' );
		$header_top_area_border_color_css = array(
			'.cm-header-builder .cm-header-top-row' => array(
				'border-color' => esc_html( $header_top_area_border_color ),
			),
		);
		$parse_builder_css                   .= colormag_parse_css( '#FAFAFA', $header_top_area_border_color, $header_top_area_border_color_css );

		// Header top area color.
		$header_top_area_color     = get_theme_mod( 'colormag_header_top_area_color', '' );
		$header_top_area_color_css = array(
			'.cm-header-builder .cm-header-top-row' => array(
				'color' => esc_html( $header_top_area_color ),
			),
		);
		$parse_builder_css                   .= colormag_parse_css( '', $header_top_area_color, $header_top_area_color_css );

		/**
		 * Header main area height.
		 */
		$header_main_area_height_default = array(
			'size' => 0,
			'unit' => 'px',
		);

		$header_main_area_height = get_theme_mod( 'colormag_header_main_area_height', $header_main_area_height_default );

		$parse_builder_css .= colormag_parse_slider_css(
			$header_main_area_height_default,
			$header_main_area_height,
			'.cm-header-builder .cm-main-row',
			'height'
		);

		/**
		 * Header main area container.
		 */
		$header_main_area_container_default = array(
			'size' => 0,
			'unit' => 'px',
		);

		$header_main_area_container = get_theme_mod( 'colormag_header_main_area_container', $header_main_area_container_default );

		$parse_builder_css .= colormag_parse_slider_css(
			$header_main_area_container_default,
			$header_main_area_container,
			'.cm-header-builder .cm-header-main-row .cm-container',
			'max-width'
		);

		// Header main area background.
		$header_main_area_background_default = array(
			'background-color'      => '#FAFAFA',
			'background-image'      => '',
			'background-repeat'     => 'repeat',
			'background-position'   => 'center center',
			'background-size'       => 'contain',
			'background-attachment' => 'scroll',
		);
		$header_main_area_background         = get_theme_mod( 'colormag_header_main_area_background', $header_main_area_background_default );
		$parse_builder_css                           .= colormag_parse_background_css( $header_main_area_background_default, $header_main_area_background, '.cm-header-builder .cm-header-main-row' );

		// Header main area padding.
		$header_main_area_padding_default = array(
			'top'    => '20',
			'right'  => '20',
			'bottom' => '20',
			'left'   => '20',
			'unit'   => 'px',
		);

		$header_main_area_padding = get_theme_mod( 'colormag_header_main_area_padding', $header_main_area_padding_default );

		$parse_builder_css .= colormag_parse_dimension_css(
			$header_main_area_padding_default,
			$header_main_area_padding,
			'.cm-header-builder .cm-header-main-row',
			'padding'
		);

		// Header main area padding.
		$header_main_area_margin_default = array(
			'top'    => '',
			'right'  => '',
			'bottom' => '',
			'left'   => '',
			'unit'   => 'px',
		);

		$header_main_area_margin = get_theme_mod( 'colormag_header_main_area_margin', $header_main_area_margin_default );

		$parse_builder_css .= colormag_parse_dimension_css(
			$header_main_area_margin_default,
			$header_main_area_margin,
			'.cm-header-builder .cm-header-main-row',
			'margin'
		);

		// Header main area padding.
		$header_main_area_border_width_default = array(
			'top'    => '0',
			'right'  => '0',
			'bottom' => '1',
			'left'   => '0',
			'unit'   => 'px',
		);

		$header_main_area_border_width = get_theme_mod( 'colormag_header_main_area_border_width', $header_main_area_border_width_default );

		$parse_builder_css .= colormag_parse_dimension_css(
			$header_main_area_border_width_default,
			$header_main_area_border_width,
			'.cm-header-builder .cm-header-main-row',
			'border-width'
		);

		$header_main_area_border_color     = get_theme_mod( 'colormag_header_main_area_border_color', '#E4E4E7' );
		$header_main_area_border_color_css = array(
			'.cm-header-builder .cm-header-main-row' => array(
				'border-color' => esc_html( $header_main_area_border_color ),
			),
		);
		$parse_builder_css                   .= colormag_parse_css( '#E4E4E7', $header_main_area_border_color, $header_main_area_border_color_css );

		$header_main_area_color     = get_theme_mod( 'colormag_header_main_area_color', '' );
		$header_main_area_color_css = array(
			'.cm-header-builder .cm-header-main-row' => array(
				'color' => esc_html( $header_main_area_color ),
			),
		);
		$parse_builder_css                   .= colormag_parse_css( '', $header_main_area_color, $header_main_area_color_css );

		/**
		 * Header bottom area height.
		 */
		$header_bottom_area_height_default = array(
			'size' => 0,
			'unit' => 'px',
		);

		$header_bottom_area_height = get_theme_mod( 'colormag_header_bottom_area_height', $header_bottom_area_height_default );

		$parse_builder_css .= colormag_parse_slider_css(
			$header_bottom_area_height_default,
			$header_bottom_area_height,
			'.cm-header-builder .cm-bottom-row',
			'height'
		);

		/**
		 * Header bottom area container.
		 */
		$header_bottom_area_container_default = array(
			'size' => 0,
			'unit' => 'px',
		);

		$header_bottom_area_container = get_theme_mod( 'colormag_header_bottom_area_container', $header_bottom_area_container_default );

		$parse_builder_css .= colormag_parse_slider_css(
			$header_bottom_area_container_default,
			$header_bottom_area_container,
			'.cm-header-builder .cm-header-bottom-row .cm-container',
			'max-width'
		);

		// Header bottom area background.
		$header_bottom_area_width = get_theme_mod('colormag_main_header_width_setting', 'full-width');
		if ( 'contained' === $header_bottom_area_width ){
			$bottom_header_background_selector = '.cm-header-builder.cm-contained .cm-header-bottom-row .cm-container .cm-bottom-row';
		} else {
			$bottom_header_background_selector = '.cm-header-builder.cm-full-width .cm-desktop-row.cm-main-header .cm-header-bottom-row';
		}

		$header_bottom_area_background_default = array(
			'background-color'      => '#27272A',
			'background-image'      => '',
			'background-repeat'     => 'repeat',
			'background-position'   => 'center center',
			'background-size'       => 'contain',
			'background-attachment' => 'scroll',
		);
		$header_bottom_area_background         = get_theme_mod( 'colormag_header_bottom_area_background', $header_bottom_area_background_default );
		$parse_builder_css                           .= colormag_parse_background_css( $header_bottom_area_background_default, $header_bottom_area_background, $bottom_header_background_selector );

		// Header bottom area padding.
		$header_bottom_area_padding_default = array(
			'top'    => '',
			'right'  => '',
			'bottom' => '',
			'left'   => '',
			'unit'   => 'px',
		);

		$header_bottom_area_padding = get_theme_mod( 'colormag_header_bottom_area_padding', $header_bottom_area_padding_default );

		$parse_builder_css .= colormag_parse_dimension_css(
			$header_bottom_area_padding_default,
			$header_bottom_area_padding,
			$bottom_header_background_selector,
			'padding'
		);

		// Header bottom area padding.
		$header_bottom_area_margin_default = array(
			'top'    => '',
			'right'  => '',
			'bottom' => '',
			'left'   => '',
			'unit'   => 'px',
		);

		$header_bottom_area_margin = get_theme_mod( 'colormag_header_bottom_area_margin', $header_bottom_area_margin_default );

		$parse_builder_css .= colormag_parse_dimension_css(
			$header_bottom_area_margin_default,
			$header_bottom_area_margin,
			$bottom_header_background_selector,
			'margin'
		);

		// Header bottom area padding.
		$header_bottom_area_border_width_default = array(
			'top'    => '0',
			'right'  => '0',
			'bottom' => '0',
			'left'   => '0',
			'unit'   => 'px',
		);

		$header_bottom_area_border_width = get_theme_mod( 'colormag_header_bottom_area_border_width', $header_bottom_area_border_width_default );

		$parse_builder_css .= colormag_parse_dimension_css(
			$header_bottom_area_border_width_default,
			$header_bottom_area_border_width,
			$bottom_header_background_selector,
			'border-width'
		);

		$header_bottom_area_border_color     = get_theme_mod( 'colormag_header_bottom_area_border_color', '' );
		$header_bottom_area_border_color_css = array(
			$bottom_header_background_selector => array(
				'border-color' => esc_html( $header_bottom_area_border_color ),
			),
		);
		$parse_builder_css                   .= colormag_parse_css( '', $header_bottom_area_border_color, $header_bottom_area_border_color_css );

		// Header bottom area color.
		$header_bottom_area_color     = get_theme_mod( 'colormag_header_bottom_area_color', '' );
		$header_bottom_area_color_css = array(
			$bottom_header_background_selector => array(
				'color' => esc_html( $header_bottom_area_color ),
			),
		);
		$parse_builder_css                   .= colormag_parse_css( '', $header_bottom_area_color, $header_bottom_area_color_css );

		$header_primary_menu_text_color     = get_theme_mod( 'colormag_header_primary_menu_text_color', '' );
		$header_primary_menu_text_color_css = array(
			'.cm-header-builder .cm-primary-nav ul li a' => array(
				'color' => esc_html( $header_primary_menu_text_color ),
			),
			'.cm-header-builder .cm-primary-nav .cm-submenu-toggle .cm-icon'      => array(
				'fill' => esc_html( $header_primary_menu_text_color ),
			),
		);
		$parse_builder_css                  .= colormag_parse_css( '', $header_primary_menu_text_color, $header_primary_menu_text_color_css );

		$header_primary_menu_selected_hovered_text_color     = get_theme_mod( 'colormag_header_primary_menu_selected_hovered_text_color', '' );
		$header_primary_menu_selected_hovered_text_color_css = array(
			'.cm-header-builder .cm-primary-nav ul li:hover > a' => array(
				'color' => esc_html( $header_primary_menu_selected_hovered_text_color ),
			),
			'.cm-header-builder .cm-primary-nav li:hover > .cm-submenu-toggle .cm-icon' => array(
				'fill' => esc_html( $header_primary_menu_selected_hovered_text_color ),
			),
		);
		$parse_builder_css                                   .= colormag_parse_css( '', $header_primary_menu_selected_hovered_text_color, $header_primary_menu_selected_hovered_text_color_css );

		$header_primary_menu_selected_hover_bg     = get_theme_mod( 'colormag_header_primary_menu_hover_background', '' );
		$header_primary_menu_selected_hover_bg_css = array(
			'.cm-header-builder .cm-primary-nav ul li:hover' => array(
				'background' => esc_html( $header_primary_menu_selected_hover_bg ),
			),
		);
		$parse_builder_css                                   .= colormag_parse_css( '', $header_primary_menu_selected_hover_bg, $header_primary_menu_selected_hover_bg_css );


		$header_primary_sub_menu_background_default = array(
			'background-color'      => '#232323',
			'background-image'      => '',
			'background-position'   => 'center center',
			'background-size'       => 'auto',
			'background-attachment' => 'scroll',
			'background-repeat'     => 'repeat',
		);
		$header_primary_sub_menu_background         = get_theme_mod( 'colormag_header_primary_sub_menu_background', $header_primary_sub_menu_background_default );
		$parse_builder_css                          .= colormag_parse_background_css( $header_primary_sub_menu_background_default, $header_primary_sub_menu_background, '.cm-header-builder .cm-primary-nav .sub-menu, .cm-header-builder .cm-primary-nav .children' );

		$header_primary_menu_typography_default     = array(
			'font-family' => 'default',
			'font-weight' => '600',
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
		$header_primary_sub_menu_typography_default = array(
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
		$header_primary_menu_typography     = get_theme_mod( 'colormag_header_primary_menu_typography', $header_primary_menu_typography_default );
		$header_primary_sub_menu_typography = get_theme_mod( 'colormag_header_primary_sub_menu_typography', $header_primary_sub_menu_typography_default );

		// Primary menu typography.
		$parse_builder_css .= colormag_parse_typography_css(
			$header_primary_menu_typography_default,
			$header_primary_menu_typography,
			'.cm-header-builder .cm-primary-nav > ul > li > a',
			array(
				'tablet' => 768,
				'mobile' => 600,
			)
		);

		// Primary sub menu typography.
		$parse_builder_css .= colormag_parse_typography_css(
			$header_primary_sub_menu_typography_default,
			$header_primary_sub_menu_typography,
			'.cm-header-builder .cm-primary-nav ul li ul li a',
			array(
				'tablet' => 768,
				'mobile' => 600,
			)
		);

		// Secondary menu.
		$header_secondary_menu_text_color     = get_theme_mod( 'colormag_header_secondary_menu_text_color', '' );
		$header_secondary_menu_text_color_css = array(
			'.cm-header-builder .cm-secondary-nav ul li a' => array(
				'color' => esc_html( $header_secondary_menu_text_color ),
			),
			'.cm-header-builder .cm-secondary-nav ul li .cm-submenu-toggle .cm-icon'      => array(
				'fill' => esc_html( $header_secondary_menu_text_color ),
			),
		);
		$parse_builder_css                  .= colormag_parse_css( '', $header_secondary_menu_text_color, $header_secondary_menu_text_color_css );

		$header_secondary_menu_selected_hovered_text_color     = get_theme_mod( 'colormag_header_secondary_menu_selected_hovered_text_color', '' );
		$header_secondary_menu_selected_hovered_text_color_css = array(
			'.cm-header-builder .cm-secondary-nav ul li:hover > a' => array(
				'color' => esc_html( $header_secondary_menu_selected_hovered_text_color ),
			),
			'.cm-header-builder .cm-secondary-nav ul li:hover > .cm-submenu-toggle .cm-icon' => array(
				'fill' => esc_html( $header_secondary_menu_selected_hovered_text_color ),
			),
		);
		$parse_builder_css                                   .= colormag_parse_css( '', $header_secondary_menu_selected_hovered_text_color, $header_secondary_menu_selected_hovered_text_color_css );

		$header_secondary_menu_selected_hover_bg     = get_theme_mod( 'colormag_header_secondary_menu_hover_background', '' );
		$header_secondary_menu_selected_hover_bg_css = array(
			'.cm-header-builder .cm-secondary-nav ul li:hover' => array(
				'color' => esc_html( $header_secondary_menu_selected_hover_bg ),
			),
		);
		$parse_builder_css                                   .= colormag_parse_css( '', $header_secondary_menu_selected_hover_bg, $header_secondary_menu_selected_hover_bg_css );

		$header_secondary_sub_menu_background_default = array(
			'background-color'      => '#232323',
			'background-image'      => '',
			'background-position'   => 'center center',
			'background-size'       => 'auto',
			'background-attachment' => 'scroll',
			'background-repeat'     => 'repeat',
		);
		$header_secondary_sub_menu_background         = get_theme_mod( 'colormag_header_secondary_sub_menu_background', $header_secondary_sub_menu_background_default );
		$parse_builder_css                          .= colormag_parse_background_css( $header_secondary_sub_menu_background_default, $header_secondary_sub_menu_background, '.cm-header-builder nav.cm-secondary-nav ul.sub-menu, .cm-header-builder .cm-secondary-nav .children' );

		$header_secondary_menu_typography_default     = array(
			'font-family' => 'default',
			'font-weight' => '600',
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
		$header_secondary_sub_menu_typography_default = array(
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

		// secondary menu typography.
		$header_secondary_menu_typography     = get_theme_mod( 'colormag_header_secondary_menu_typography', $header_secondary_menu_typography_default );
		$parse_builder_css .= colormag_parse_typography_css(
			$header_secondary_menu_typography_default,
			$header_secondary_menu_typography,
			'.cm-header-builder .cm-secondary-nav ul li a',
			array(
				'tablet' => 768,
				'mobile' => 600,
			)
		);

		// secondary sub menu typography.
		$header_secondary_sub_menu_typography = get_theme_mod( 'colormag_header_secondary_sub_menu_typography', $header_secondary_sub_menu_typography_default );
		$parse_builder_css .= colormag_parse_typography_css(
			$header_secondary_sub_menu_typography_default,
			$header_secondary_sub_menu_typography,
			'.cm-header-builder .cm-secondary-nav ul li ul li a',
			array(
				'tablet' => 768,
				'mobile' => 600,
			)
		);

		// Header search icon color.
		$header_search_icon_color     = get_theme_mod( 'colormag_header_search_icon_color', '' );
		$header_search_icon_color_css = array(
			'.cm-header-builder .cm-top-search .search-top::before' => array(
				'color' => esc_html( $header_search_icon_color ),
			),
		);
		$parse_builder_css                                   .= colormag_parse_css( '', $header_search_icon_color, $header_search_icon_color_css );

		// Header search icon hover color.
		$header_search_icon_hover_color     = get_theme_mod( 'colormag_header_search_icon_hover_color', '' );
		$header_search_icon_hover_color_css = array(
			'.cm-header-builder .cm-top-search:hover > .search-top::before' => array(
				'color' => esc_html( $header_search_icon_hover_color ),
			),
		);
		$parse_builder_css                                   .= colormag_parse_css( '', $header_search_icon_hover_color, $header_search_icon_hover_color_css );

		// Header search text color.
		$header_search_text_color     = get_theme_mod( 'colormag_header_search_text_color', '' );
		$header_search_text_color_css = array(
			'.cm-header-builder .cm-top-search .search-form-top input' => array(
				'color' => esc_html( $header_search_text_color ),
			),
		);
		$parse_builder_css                                   .= colormag_parse_css( '', $header_search_text_color, $header_search_text_color_css );

		// Header search background color.
		$header_search_background         = get_theme_mod( 'colormag_header_search_background', '' );
		$header_search_background_css = array(
			'.cm-header-builder .cm-top-search .search-form-top input, .cm-header-builder .cm-top-search .search-form-top' => array(
				'background-color' => esc_html( $header_search_background ),
			),
			'.cm-header-builder .search-form-top.show::before' => array(
				'border-bottom-color' => esc_html( $header_search_background ),
			),
		);
		$parse_builder_css                                   .= colormag_parse_css( '', $header_search_background, $header_search_background_css );

		// Header builder widget title color.
		$header_widget_title_color     = get_theme_mod( 'colormag_widget_1_title_color', '' );
		$header_widget_title_color_css = array(
			'.cm-header-builder .widget.widget-colormag_header_sidebar .widget-title' => array(
				'color' => esc_html( $header_widget_title_color ),
			),
		);
		$parse_builder_css                               .= colormag_parse_css( '', $header_widget_title_color, $header_widget_title_color_css );

		// Header builder widget content color.
		$header_widget_content_color     = get_theme_mod( 'colormag_widget_1_content_color', '' );
		$header_widget_content_color_css = array(
			'.cm-header-builder .widget.widget-colormag_header_sidebar' => array(
				'color' => esc_html( $header_widget_content_color ),
			),
		);
		$parse_builder_css                               .= colormag_parse_css( '', $header_widget_content_color, $header_widget_content_color_css );

		// Header builder widget link color.
		$header_widget_link_color     = get_theme_mod( 'colormag_widget_1_link_color', '' );
		$header_widget_link_color_css = array(
			'.cm-header-builder .widget.widget-colormag_header_sidebar a' => array(
				'color' => esc_html( $header_widget_link_color ),
			),
		);
		$parse_builder_css                               .= colormag_parse_css( '', $header_widget_link_color, $header_widget_link_color_css );

		// Header builder widget title typography.
		$header_widget_1_title_typography_default = array(
			'font-family'    => 'default',
			'font-weight'    => '400',
			'font-size'      => array(
				'desktop' => array(
					'size' => '2',
					'unit' => 'rem',
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
			'line-height'    => array(
				'desktop' => array(
					'size' => '1.3',
					'unit' => '-',
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
			'font-style'     => 'normal',
			'text-transform' => 'none',
		);

		$header_widget_1_title_typography = get_theme_mod( 'colormag_widget_1_title_typography', $header_widget_1_title_typography_default );

		$parse_builder_css .= colormag_parse_typography_css(
			$header_widget_1_title_typography_default,
			$header_widget_1_title_typography,
			'.cm-header-builder .widget.widget-colormag_header_sidebar .widget-title',
			array(
				'tablet' => 768,
				'mobile' => 600,
			)
		);

		// Header builder widget content typography.
		$header_widget_1_content_typography_default = array(
			'font-family'    => 'default',
			'font-weight'    => '400',
			'font-size'      => array(
				'desktop' => array(
					'size' => '2',
					'unit' => 'rem',
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
			'line-height'    => array(
				'desktop' => array(
					'size' => '1.3',
					'unit' => '-',
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
			'font-style'     => 'normal',
			'text-transform' => 'none',
		);

		$header_widget_1_content_typography = get_theme_mod( 'colormag_widget_1_content_typography', $header_widget_1_content_typography_default );

		$parse_builder_css .= colormag_parse_typography_css(
			$header_widget_1_content_typography_default,
			$header_widget_1_content_typography,
			'.cm-header-builder .widget.widget-colormag_header_sidebar',
			array(
				'tablet' => 768,
				'mobile' => 600,
			)
		);

		// Header builder widget 2 title color.
		$header_widget_2_title_color     = get_theme_mod( 'colormag_widget_2_title_color', '' );
		$header_widget_2_title_color_css = array(
			'.cm-header-builder .widget.widget-header-sidebar-2 .widget-title' => array(
				'color' => esc_html( $header_widget_2_title_color ),
			),
		);
		$parse_builder_css                               .= colormag_parse_css( '', $header_widget_2_title_color, $header_widget_2_title_color_css );

		// Header builder widget 2 content color.
		$header_widget_2_content_color     = get_theme_mod( 'colormag_widget_2_content_color', '' );
		$header_widget_2_content_color_css = array(
			'.cm-header-builder .widget.widget-header-sidebar-2' => array(
				'color' => esc_html( $header_widget_2_content_color ),
			),
		);
		$parse_builder_css                               .= colormag_parse_css( '', $header_widget_2_content_color, $header_widget_2_content_color_css );

		// Header builder widget 2 link color.
		$header_widget_2_link_color     = get_theme_mod( 'colormag_widget_2_link_color', '' );
		$header_widget_2_link_color_css = array(
			'.cm-header-builder .widget.widget-header-sidebar-2 a' => array(
				'color' => esc_html( $header_widget_2_link_color ),
			),
		);
		$parse_builder_css                               .= colormag_parse_css( '', $header_widget_2_link_color, $header_widget_2_link_color_css );

		// Header builder widget title typography.
		$header_widget_2_title_typography_default = array(
			'font-family'    => 'default',
			'font-weight'    => '400',
			'font-size'      => array(
				'desktop' => array(
					'size' => '2',
					'unit' => 'rem',
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
			'line-height'    => array(
				'desktop' => array(
					'size' => '1.3',
					'unit' => '-',
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
			'font-style'     => 'normal',
			'text-transform' => 'none',
		);

		$header_widget_2_title_typography = get_theme_mod( 'colormag_widget_2_title_typography', $header_widget_2_title_typography_default );

		$parse_builder_css .= colormag_parse_typography_css(
			$header_widget_2_title_typography_default,
			$header_widget_2_title_typography,
			'.cm-header-builder .widget.widget-header-sidebar-2 .widget-title',
			array(
				'tablet' => 768,
				'mobile' => 600,
			)
		);

		// Header builder widget content typography.
		$header_widget_2_content_typography_default = array(
			'font-family'    => 'default',
			'font-weight'    => '400',
			'font-size'      => array(
				'desktop' => array(
					'size' => '2',
					'unit' => 'rem',
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
			'line-height'    => array(
				'desktop' => array(
					'size' => '1.3',
					'unit' => '-',
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
			'font-style'     => 'normal',
			'text-transform' => 'none',
		);

		$header_widget_2_content_typography = get_theme_mod( 'colormag_widget_2_content_typography', $header_widget_2_content_typography_default );

		$parse_builder_css .= colormag_parse_typography_css(
			$header_widget_2_content_typography_default,
			$header_widget_2_content_typography,
			'.cm-header-builder .widget.widget-header-sidebar-2',
			array(
				'tablet' => 768,
				'mobile' => 600,
			)
		);

		// Header random icon color.
		$header_random_icon_color     = get_theme_mod( 'colormag_header_random_icon_color', '' );
		$header_random_icon_color_css = array(
			'.cm-header-builder .cm-random-post .cm-icon--random-fill' => array(
				'fill' => esc_html( $header_random_icon_color ),
			),
		);
		$parse_builder_css                                   .= colormag_parse_css( '', $header_random_icon_color, $header_random_icon_color_css );

		// Header random icon hover color.
		$header_random_icon_hover_color     = get_theme_mod( 'colormag_header_random_icon_hover_color', '' );
		$header_random_icon_hover_color_css = array(
			'.cm-header-builder .cm-random-post:hover > .cm-icon--random-fill' => array(
				'fill' => esc_html( $header_random_icon_hover_color ),
			),
		);
		$parse_builder_css                                   .= colormag_parse_css( '', $header_random_icon_hover_color, $header_random_icon_hover_color_css );


		// Header home icon color.
		$header_random_icon_color     = get_theme_mod( 'colormag_header_home_icon_color', '' );
		$header_random_icon_color_css = array(
			'.cm-header-builder .cm-home-icon .cm-icon--home' => array(
				'fill' => esc_html( $header_random_icon_color ),
			),
		);
		$parse_builder_css                                   .= colormag_parse_css( '', $header_random_icon_color, $header_random_icon_color_css );

		// Footer builder widget title color.
		$footer_widget_title_color     = get_theme_mod( 'colormag_footer_widget_1_title_color', '' );
		$footer_widget_title_color_css = array(
			'.cm-footer-builder .widget.widget-colormag_footer_sidebar_one_upper .widget-title' => array(
				'color' => esc_html( $footer_widget_title_color ),
			),
		);
		$parse_builder_css                               .= colormag_parse_css( '', $footer_widget_title_color, $footer_widget_title_color_css );

		// Footer builder widget content color.
		$footer_widget_content_color     = get_theme_mod( 'colormag_footer_widget_1_content_color', '' );
		$footer_widget_content_color_css = array(
			'.cm-footer-builder .widget.widget-colormag_footer_sidebar_one_upper' => array(
				'color' => esc_html( $footer_widget_content_color ),
			),
		);
		$parse_builder_css                               .= colormag_parse_css( '', $footer_widget_content_color, $footer_widget_content_color_css );

		// Footer builder widget link color.
		$footer_widget_link_color     = get_theme_mod( 'colormag_footer_widget_1_link_color', '' );
		$footer_widget_link_color_css = array(
			'.cm-footer-builder .widget.widget-colormag_footer_sidebar_one_upper a' => array(
				'color' => esc_html( $footer_widget_link_color ),
			),
		);
		$parse_builder_css                               .= colormag_parse_css( '', $footer_widget_link_color, $footer_widget_link_color_css );

		// Footer builder widget link hover color.
		$footer_widget_link_hover_color     = get_theme_mod( 'colormag_footer_widget_1_link_hover_color', '' );
		$footer_widget_link_hover_color_css = array(
			'.cm-footer-builder .widget.widget-colormag_footer_sidebar_one_upper a:hover' => array(
				'color' => esc_html( $footer_widget_link_hover_color ),
			),
		);
		$parse_builder_css                               .= colormag_parse_css( '', $footer_widget_link_hover_color, $footer_widget_link_hover_color_css );


		// Footer builder widget title typography.
		$footer_widget_1_title_typography_default = array(
			'font-family'    => 'default',
			'font-weight'    => '400',
			'font-size'      => array(
				'desktop' => array(
					'size' => '2',
					'unit' => 'rem',
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
			'line-height'    => array(
				'desktop' => array(
					'size' => '1.3',
					'unit' => '-',
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
			'font-style'     => 'normal',
			'text-transform' => 'none',
		);
		$footer_widget_1_title_typography = get_theme_mod( 'colormag_footer_widget_1_title_typography', $footer_widget_1_title_typography_default );
		$parse_builder_css .= colormag_parse_typography_css(
			$footer_widget_1_title_typography_default,
			$footer_widget_1_title_typography,
			'.cm-footer-builder .widget.widget-colormag_footer_sidebar_one_upper .widget-title',
			array(
				'tablet' => 768,
				'mobile' => 600,
			)
		);

		// Footer builder widget content typography.
		$footer_widget_1_content_typography_default = array(
			'font-family'    => 'default',
			'font-weight'    => '400',
			'font-size'      => array(
				'desktop' => array(
					'size' => '2',
					'unit' => 'rem',
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
			'line-height'    => array(
				'desktop' => array(
					'size' => '1.3',
					'unit' => '-',
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
			'font-style'     => 'normal',
			'text-transform' => 'none',
		);
		$footer_widget_1_content_typography = get_theme_mod( 'colormag_footer_widget_1_content_typography', $footer_widget_1_content_typography_default );
		$parse_builder_css .= colormag_parse_typography_css(
			$footer_widget_1_content_typography_default,
			$footer_widget_1_content_typography,
			'.cm-footer-builder .widget.widget-colormag_footer_sidebar_one_upper',
			array(
				'tablet' => 768,
				'mobile' => 600,
			)
		);

		// Footer builder widget 2 title color.
		$footer_widget_2_title_color     = get_theme_mod( 'colormag_footer_widget_2_title_color', '' );
		$footer_widget_2_title_color_css = array(
			'.cm-footer-builder .widget.widget-colormag_footer_sidebar_two_upper .widget-title' => array(
				'color' => esc_html( $footer_widget_2_title_color ),
			),
		);
		$parse_builder_css                               .= colormag_parse_css( '', $footer_widget_2_title_color, $footer_widget_2_title_color_css );

		// Footer builder widget 2 content color.
		$footer_widget_2_content_color     = get_theme_mod( 'colormag_footer_widget_2_content_color', '' );
		$footer_widget_2_content_color_css = array(
			'.cm-footer-builder .widget.widget-colormag_footer_sidebar_two_upper' => array(
				'color' => esc_html( $footer_widget_2_content_color ),
			),
		);
		$parse_builder_css                               .= colormag_parse_css( '', $footer_widget_2_content_color, $footer_widget_2_content_color_css );

		// Footer builder widget 2 link color.
		$footer_widget_2_link_color     = get_theme_mod( 'colormag_footer_widget_2_link_color', '' );
		$footer_widget_2_link_color_css = array(
			'.cm-footer-builder .widget.widget-colormag_footer_sidebar_two_upper a' => array(
				'color' => esc_html( $footer_widget_2_link_color ),
			),
		);
		$parse_builder_css                               .= colormag_parse_css( '', $footer_widget_2_link_color, $footer_widget_2_link_color_css );

		// Footer builder widget 2 link hover color.
		$footer_widget_2_link_hover_color     = get_theme_mod( 'colormag_footer_widget_2_link_hover_color', '' );
		$footer_widget_2_link_hover_color_css = array(
			'.cm-footer-builder .widget.widget-colormag_footer_sidebar_two_upper a:hover' => array(
				'color' => esc_html( $footer_widget_2_link_hover_color ),
			),
		);
		$parse_builder_css                               .= colormag_parse_css( '', $footer_widget_2_link_hover_color, $footer_widget_2_link_hover_color_css );

		// Footer builder widget 2 title typography.
		$footer_widget_2_title_typography_default = array(
			'font-family'    => 'default',
			'font-weight'    => '400',
			'font-size'      => array(
				'desktop' => array(
					'size' => '2',
					'unit' => 'rem',
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
			'line-height'    => array(
				'desktop' => array(
					'size' => '1.3',
					'unit' => '-',
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
			'font-style'     => 'normal',
			'text-transform' => 'none',
		);
		$footer_widget_2_title_typography = get_theme_mod( 'colormag_footer_widget_2_title_typography', $footer_widget_2_title_typography_default );
		$parse_builder_css .= colormag_parse_typography_css(
			$footer_widget_2_title_typography_default,
			$footer_widget_2_title_typography,
			'.cm-footer-builder .widget.widget-colormag_footer_sidebar_two_upper .widget-title',
			array(
				'tablet' => 768,
				'mobile' => 600,
			)
		);

		// Footer builder widget 2 content typography.
		$footer_widget_2_content_typography_default = array(
			'font-family'    => 'default',
			'font-weight'    => '400',
			'font-size'      => array(
				'desktop' => array(
					'size' => '2',
					'unit' => 'rem',
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
			'line-height'    => array(
				'desktop' => array(
					'size' => '1.3',
					'unit' => '-',
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
			'font-style'     => 'normal',
			'text-transform' => 'none',
		);
		$footer_widget_2_content_typography = get_theme_mod( 'colormag_footer_widget_2_content_typography', $footer_widget_2_content_typography_default );
		$parse_builder_css .= colormag_parse_typography_css(
			$footer_widget_2_content_typography_default,
			$footer_widget_2_content_typography,
			'.cm-footer-builder .widget.widget-colormag_footer_sidebar_two_upper',
			array(
				'tablet' => 768,
				'mobile' => 600,
			)
		);

		// Footer builder widget 3 title color.
		$footer_widget_3_title_color     = get_theme_mod( 'colormag_footer_widget_3_title_color', '' );
		$footer_widget_3_title_color_css = array(
			'.cm-footer-builder .widget.widget-colormag_footer_sidebar_three_upper .widget-title' => array(
				'color' => esc_html( $footer_widget_3_title_color ),
			),
		);
		$parse_builder_css                               .= colormag_parse_css( '', $footer_widget_3_title_color, $footer_widget_3_title_color_css );

		// Footer builder widget 3 content color.
		$footer_widget_3_content_color     = get_theme_mod( 'colormag_footer_widget_3_content_color', '' );
		$footer_widget_3_content_color_css = array(
			'.cm-footer-builder .widget.widget-colormag_footer_sidebar_three_upper' => array(
				'color' => esc_html( $footer_widget_3_content_color ),
			),
		);
		$parse_builder_css                               .= colormag_parse_css( '', $footer_widget_3_content_color, $footer_widget_3_content_color_css );

		// Footer builder widget 3 link color.
		$footer_widget_3_link_color     = get_theme_mod( 'colormag_footer_widget_3_link_color', '' );
		$footer_widget_3_link_color_css = array(
			'.cm-footer-builder .widget.widget-colormag_footer_sidebar_three_upper a' => array(
				'color' => esc_html( $footer_widget_3_link_color ),
			),
		);
		$parse_builder_css                               .= colormag_parse_css( '', $footer_widget_3_link_color, $footer_widget_3_link_color_css );

		// Footer builder widget 3 link hover color.
		$footer_widget_3_link_hover_color     = get_theme_mod( 'colormag_footer_widget_3_link_hover_color', '' );
		$footer_widget_3_link_hover_color_css = array(
			'.cm-footer-builder .widget.widget-colormag_footer_sidebar_three_upper a:hover' => array(
				'color' => esc_html( $footer_widget_3_link_hover_color ),
			),
		);
		$parse_builder_css                               .= colormag_parse_css( '', $footer_widget_3_link_hover_color, $footer_widget_3_link_hover_color_css );


		// Footer builder widget 3 title typography.
		$footer_widget_3_title_typography_default = array(
			'font-family'    => 'default',
			'font-weight'    => '400',
			'font-size'      => array(
				'desktop' => array(
					'size' => '3',
					'unit' => 'rem',
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
			'line-height'    => array(
				'desktop' => array(
					'size' => '1.3',
					'unit' => '-',
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
			'font-style'     => 'normal',
			'text-transform' => 'none',
		);

		$footer_widget_3_title_typography = get_theme_mod( 'colormag_footer_widget_3_title_typography', $footer_widget_3_title_typography_default );

		$parse_builder_css .= colormag_parse_typography_css(
			$footer_widget_3_title_typography_default,
			$footer_widget_3_title_typography,
			'.cm-footer-builder .widget.widget-colormag_footer_sidebar_three_upper .widget-title',
			array(
				'tablet' => 768,
				'mobile' => 600,
			)
		);

		// Footer builder widget 3 content typography.
		$footer_widget_3_content_typography_default = array(
			'font-family'    => 'default',
			'font-weight'    => '400',
			'font-size'      => array(
				'desktop' => array(
					'size' => '3',
					'unit' => 'rem',
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
			'line-height'    => array(
				'desktop' => array(
					'size' => '1.3',
					'unit' => '-',
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
			'font-style'     => 'normal',
			'text-transform' => 'none',
		);

		$footer_widget_3_content_typography = get_theme_mod( 'colormag_footer_widget_3_content_typography', $footer_widget_3_content_typography_default );

		$parse_builder_css .= colormag_parse_typography_css(
			$footer_widget_3_content_typography_default,
			$footer_widget_3_content_typography,
			'.cm-footer-builder .widget.widget-colormag_footer_sidebar_three_upper',
			array(
				'tablet' => 768,
				'mobile' => 600,
			)
		);

		// Footer builder widget 4 title color.
		$footer_widget_4_title_color     = get_theme_mod( 'colormag_footer_widget_4_title_color', '' );
		$footer_widget_4_title_color_css = array(
			'.cm-footer-builder .widget.widget-colormag_footer_sidebar_one .widget-title' => array(
				'color' => esc_html( $footer_widget_4_title_color ),
			),
		);
		$parse_builder_css                               .= colormag_parse_css( '', $footer_widget_4_title_color, $footer_widget_4_title_color_css );

		// Footer builder widget 4 content color.
		$footer_widget_4_content_color     = get_theme_mod( 'colormag_footer_widget_4_content_color', '' );
		$footer_widget_4_content_color_css = array(
			'.cm-footer-builder .widget.widget-colormag_footer_sidebar_one' => array(
				'color' => esc_html( $footer_widget_4_content_color ),
			),
		);
		$parse_builder_css                               .= colormag_parse_css( '', $footer_widget_4_content_color, $footer_widget_4_content_color_css );

		// Footer builder widget 4 link color.
		$footer_widget_4_link_color     = get_theme_mod( 'colormag_footer_widget_4_link_color', '' );
		$footer_widget_4_link_color_css = array(
			'.cm-footer-builder .widget.widget-colormag_footer_sidebar_one a' => array(
				'color' => esc_html( $footer_widget_4_link_color ),
			),
		);
		$parse_builder_css                               .= colormag_parse_css( '', $footer_widget_4_link_color, $footer_widget_4_link_color_css );

		// Footer builder widget 4 link hover color.
		$footer_widget_4_link_hover_color     = get_theme_mod( 'colormag_footer_widget_4_link_hover_color', '' );
		$footer_widget_4_link_hover_color_css = array(
			'.cm-footer-builder .widget.widget-colormag_footer_sidebar_one a:hover' => array(
				'color' => esc_html( $footer_widget_4_link_hover_color ),
			),
		);
		$parse_builder_css                               .= colormag_parse_css( '', $footer_widget_4_link_hover_color, $footer_widget_4_link_hover_color_css );

		// Footer builder widget 4 title typography.
		$footer_widget_4_title_typography_default = array(
			'font-family'    => 'default',
			'font-weight'    => '400',
			'font-size'      => array(
				'desktop' => array(
					'size' => '4',
					'unit' => 'rem',
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
			'line-height'    => array(
				'desktop' => array(
					'size' => '1.3',
					'unit' => '-',
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
			'font-style'     => 'normal',
			'text-transform' => 'none',
		);

		$footer_widget_4_title_typography = get_theme_mod( 'colormag_footer_widget_4_title_typography', $footer_widget_4_title_typography_default );

		$parse_builder_css .= colormag_parse_typography_css(
			$footer_widget_4_title_typography_default,
			$footer_widget_4_title_typography,
			'.cm-footer-builder .widget.widget-colormag_footer_sidebar_one .widget-title',
			array(
				'tablet' => 768,
				'mobile' => 600,
			)
		);

		// Footer builder widget 4 content typography.
		$footer_widget_4_content_typography_default = array(
			'font-family'    => 'default',
			'font-weight'    => '400',
			'font-size'      => array(
				'desktop' => array(
					'size' => '4',
					'unit' => 'rem',
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
			'line-height'    => array(
				'desktop' => array(
					'size' => '1.3',
					'unit' => '-',
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
			'font-style'     => 'normal',
			'text-transform' => 'none',
		);

		$footer_widget_4_content_typography = get_theme_mod( 'colormag_footer_widget_4_content_typography', $footer_widget_4_content_typography_default );

		$parse_builder_css .= colormag_parse_typography_css(
			$footer_widget_4_content_typography_default,
			$footer_widget_4_content_typography,
			'.cm-footer-builder .widget.widget-colormag_footer_sidebar_one',
			array(
				'tablet' => 768,
				'mobile' => 600,
			)
		);

		// Footer builder widget 5 title color.
		$footer_widget_5_title_color     = get_theme_mod( 'colormag_footer_widget_5_title_color', '' );
		$footer_widget_5_title_color_css = array(
			'.cm-footer-builder .widget.widget-colormag_footer_sidebar_two .widget-title' => array(
				'color' => esc_html( $footer_widget_5_title_color ),
			),
		);
		$parse_builder_css                               .= colormag_parse_css( '', $footer_widget_5_title_color, $footer_widget_5_title_color_css );

		// Footer builder widget 5 content color.
		$footer_widget_5_content_color     = get_theme_mod( 'colormag_footer_widget_5_content_color', '' );
		$footer_widget_5_content_color_css = array(
			'.cm-footer-builder .widget.widget-colormag_footer_sidebar_two' => array(
				'color' => esc_html( $footer_widget_5_content_color ),
			),
		);
		$parse_builder_css                               .= colormag_parse_css( '', $footer_widget_5_content_color, $footer_widget_5_content_color_css );

		// Footer builder widget 5 link color.
		$footer_widget_5_link_color     = get_theme_mod( 'colormag_footer_widget_5_link_color', '' );
		$footer_widget_5_link_color_css = array(
			'.cm-footer-builder .widget.widget-colormag_footer_sidebar_two a' => array(
				'color' => esc_html( $footer_widget_5_link_color ),
			),
		);
		$parse_builder_css                               .= colormag_parse_css( '', $footer_widget_5_link_color, $footer_widget_5_link_color_css );

		// Footer builder widget 5 link hover color.
		$footer_widget_5_link_hover_color     = get_theme_mod( 'colormag_footer_widget_5_link_hover_color', '' );
		$footer_widget_5_link_hover_color_css = array(
			'.cm-footer-builder .widget.widget-colormag_footer_sidebar_two a:hover' => array(
				'color' => esc_html( $footer_widget_5_link_hover_color ),
			),
		);
		$parse_builder_css                               .= colormag_parse_css( '', $footer_widget_5_link_hover_color, $footer_widget_5_link_hover_color_css );

		// Footer builder widget 5 title typography.
		$footer_widget_5_title_typography_default = array(
			'font-family'    => 'default',
			'font-weight'    => '400',
			'font-size'      => array(
				'desktop' => array(
					'size' => '5',
					'unit' => 'rem',
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
			'line-height'    => array(
				'desktop' => array(
					'size' => '1.3',
					'unit' => '-',
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
			'font-style'     => 'normal',
			'text-transform' => 'none',
		);
		$footer_widget_5_title_typography = get_theme_mod( 'colormag_footer_widget_5_title_typography', $footer_widget_5_title_typography_default );
		$parse_builder_css .= colormag_parse_typography_css(
			$footer_widget_5_title_typography_default,
			$footer_widget_5_title_typography,
			'.cm-footer-builder .widget.widget-colormag_footer_sidebar_two .widget-title',
			array(
				'tablet' => 768,
				'mobile' => 600,
			)
		);

		// Footer builder widget 5 content typography.
		$footer_widget_5_content_typography_default = array(
			'font-family'    => 'default',
			'font-weight'    => '400',
			'font-size'      => array(
				'desktop' => array(
					'size' => '5',
					'unit' => 'rem',
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
			'line-height'    => array(
				'desktop' => array(
					'size' => '1.3',
					'unit' => '-',
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
			'font-style'     => 'normal',
			'text-transform' => 'none',
		);
		$footer_widget_5_content_typography = get_theme_mod( 'colormag_footer_widget_5_content_typography', $footer_widget_5_content_typography_default );
		$parse_builder_css .= colormag_parse_typography_css(
			$footer_widget_5_content_typography_default,
			$footer_widget_5_content_typography,
			'.cm-footer-builder .widget.widget-colormag_footer_sidebar_two',
			array(
				'tablet' => 768,
				'mobile' => 600,
			)
		);

		// Footer builder widget 6 title color.
		$footer_widget_6_title_color     = get_theme_mod( 'colormag_footer_widget_6_title_color', '' );
		$footer_widget_6_title_color_css = array(
			'.cm-footer-builder .widget.widget-colormag_footer_sidebar_three .widget-title' => array(
				'color' => esc_html( $footer_widget_6_title_color ),
			),
		);
		$parse_builder_css                               .= colormag_parse_css( '', $footer_widget_6_title_color, $footer_widget_6_title_color_css );

		// Footer builder widget 6 content color.
		$footer_widget_6_content_color     = get_theme_mod( 'colormag_footer_widget_6_content_color', '' );
		$footer_widget_6_content_color_css = array(
			'.cm-footer-builder .widget.widget-colormag_footer_sidebar_three' => array(
				'color' => esc_html( $footer_widget_6_content_color ),
			),
		);
		$parse_builder_css                               .= colormag_parse_css( '', $footer_widget_6_content_color, $footer_widget_6_content_color_css );

		// Footer builder widget 6 link color.
		$footer_widget_6_link_color     = get_theme_mod( 'colormag_footer_widget_6_link_color', '' );
		$footer_widget_6_link_color_css = array(
			'.cm-footer-builder .widget.widget-colormag_footer_sidebar_three a' => array(
				'color' => esc_html( $footer_widget_6_link_color ),
			),
		);
		$parse_builder_css                               .= colormag_parse_css( '', $footer_widget_6_link_color, $footer_widget_6_link_color_css );

		// Footer builder widget 6 link hover color.
		$footer_widget_6_link_hover_color     = get_theme_mod( 'colormag_footer_widget_6_link_hover_color', '' );
		$footer_widget_6_link_hover_color_css = array(
			'.cm-footer-builder .widget.widget-colormag_footer_sidebar_three a:hover' => array(
				'color' => esc_html( $footer_widget_6_link_hover_color ),
			),
		);
		$parse_builder_css                               .= colormag_parse_css( '', $footer_widget_6_link_hover_color, $footer_widget_6_link_hover_color_css );

		// Footer builder widget 6 title typography.
		$footer_widget_6_title_typography_default = array(
			'font-family'    => 'default',
			'font-weight'    => '400',
			'font-size'      => array(
				'desktop' => array(
					'size' => '6',
					'unit' => 'rem',
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
			'line-height'    => array(
				'desktop' => array(
					'size' => '1.3',
					'unit' => '-',
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
			'font-style'     => 'normal',
			'text-transform' => 'none',
		);
		$footer_widget_6_title_typography = get_theme_mod( 'colormag_footer_widget_6_title_typography', $footer_widget_6_title_typography_default );
		$parse_builder_css .= colormag_parse_typography_css(
			$footer_widget_6_title_typography_default,
			$footer_widget_6_title_typography,
			'.cm-footer-builder .widget.widget-colormag_footer_sidebar_three .widget-title',
			array(
				'tablet' => 768,
				'mobile' => 600,
			)
		);

		// Footer builder widget 6 content typography.
		$footer_widget_6_content_typography_default = array(
			'font-family'    => 'default',
			'font-weight'    => '400',
			'font-size'      => array(
				'desktop' => array(
					'size' => '6',
					'unit' => 'rem',
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
			'line-height'    => array(
				'desktop' => array(
					'size' => '1.3',
					'unit' => '-',
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
			'font-style'     => 'normal',
			'text-transform' => 'none',
		);
		$footer_widget_6_content_typography = get_theme_mod( 'colormag_footer_widget_6_content_typography', $footer_widget_6_content_typography_default );
		$parse_builder_css .= colormag_parse_typography_css(
			$footer_widget_6_content_typography_default,
			$footer_widget_6_content_typography,
			'.cm-footer-builder .widget.widget-colormag_footer_sidebar_three',
			array(
				'tablet' => 768,
				'mobile' => 600,
			)
		);

		// Footer builder widget 7 title color.
		$footer_widget_7_title_color     = get_theme_mod( 'colormag_footer_widget_7_title_color', '' );
		$footer_widget_7_title_color_css = array(
			'.cm-footer-builder .widget.widget-colormag_footer_sidebar_four .widget-title' => array(
				'color' => esc_html( $footer_widget_7_title_color ),
			),
		);
		$parse_builder_css                               .= colormag_parse_css( '', $footer_widget_7_title_color, $footer_widget_7_title_color_css );

		// Footer builder widget 7 content color.
		$footer_widget_7_content_color     = get_theme_mod( 'colormag_footer_widget_7_content_color', '' );
		$footer_widget_7_content_color_css = array(
			'.cm-footer-builder .widget.widget-colormag_footer_sidebar_four' => array(
				'color' => esc_html( $footer_widget_7_content_color ),
			),
		);
		$parse_builder_css                               .= colormag_parse_css( '', $footer_widget_7_content_color, $footer_widget_7_content_color_css );

		// Footer builder widget 7 link color.
		$footer_widget_7_link_color     = get_theme_mod( 'colormag_footer_widget_7_link_color', '' );
		$footer_widget_7_link_color_css = array(
			'.cm-footer-builder .widget.widget-colormag_footer_sidebar_four a' => array(
				'color' => esc_html( $footer_widget_7_link_color ),
			),
		);
		$parse_builder_css                               .= colormag_parse_css( '', $footer_widget_7_link_color, $footer_widget_7_link_color_css );

		// Footer builder widget 7 link hover color.
		$footer_widget_7_link_hover_color     = get_theme_mod( 'colormag_footer_widget_7_link_hover_color', '' );
		$footer_widget_7_link_hover_color_css = array(
			'.cm-footer-builder .widget.widget-colormag_footer_sidebar_four a:hover' => array(
				'color' => esc_html( $footer_widget_7_link_hover_color ),
			),
		);
		$parse_builder_css                               .= colormag_parse_css( '', $footer_widget_7_link_hover_color, $footer_widget_7_link_hover_color_css );

		// Footer builder widget 7 title typography.
		$footer_widget_7_title_typography_default = array(
			'font-family'    => 'default',
			'font-weight'    => '400',
			'font-size'      => array(
				'desktop' => array(
					'size' => '6',
					'unit' => 'rem',
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
			'line-height'    => array(
				'desktop' => array(
					'size' => '1.3',
					'unit' => '-',
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
			'font-style'     => 'normal',
			'text-transform' => 'none',
		);
		$footer_widget_7_title_typography = get_theme_mod( 'colormag_footer_widget_7_title_typography', $footer_widget_7_title_typography_default );
		$parse_builder_css .= colormag_parse_typography_css(
			$footer_widget_7_title_typography_default,
			$footer_widget_7_title_typography,
			'.cm-footer-builder .widget.widget-colormag_footer_sidebar_four .widget-title',
			array(
				'tablet' => 768,
				'mobile' => 600,
			)
		);

		// Footer builder widget 7 content typography.
		$footer_widget_7_content_typography_default = array(
			'font-family'    => 'default',
			'font-weight'    => '400',
			'font-size'      => array(
				'desktop' => array(
					'size' => '6',
					'unit' => 'rem',
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
			'line-height'    => array(
				'desktop' => array(
					'size' => '1.3',
					'unit' => '-',
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
			'font-style'     => 'normal',
			'text-transform' => 'none',
		);
		$footer_widget_7_content_typography = get_theme_mod( 'colormag_footer_widget_7_content_typography', $footer_widget_7_content_typography_default );
		$parse_builder_css .= colormag_parse_typography_css(
			$footer_widget_7_content_typography_default,
			$footer_widget_7_content_typography,
			'.cm-footer-builder .widget.widget-colormag_footer_sidebar_four',
			array(
				'tablet' => 768,
				'mobile' => 600,
			)
		);

		//
		// Footer builder html 1 color.
		$footer_html_1_text_color     = get_theme_mod( 'colormag_footer_html_1_text_color', '' );
		$footer_html_1_text_color_css = array(
			'.cm-footer-builder .cm-html-1 *' => array(
				'color' => esc_html( $footer_html_1_text_color ),
			),
		);
		$parse_builder_css                          .= colormag_parse_css( '', $footer_html_1_text_color, $footer_html_1_text_color_css );

		// Footer builder html 1 link color.
		$footer_html_1_link_color     = get_theme_mod( 'colormag_footer_html_1_link_color', '' );
		$footer_html_1_link_color_css = array(
			'.cm-footer-builder .cm-html-1 a' => array(
				'color' => esc_html( $footer_html_1_link_color ),
			),
		);
		$parse_builder_css                          .= colormag_parse_css( '', $footer_html_1_link_color, $footer_html_1_link_color_css );

		// Footer builder html 1 link hover color.
		$footer_html_1_link_hover_color     = get_theme_mod( 'colormag_footer_html_1_link_hover_color', '' );
		$footer_html_1_link_hover_color_css = array(
			'.cm-footer-builder .cm-html-1 a:hover' => array(
				'color' => esc_html( $footer_html_1_link_hover_color ),
			),
		);
		$parse_builder_css                          .= colormag_parse_css( '', $footer_html_1_link_hover_color, $footer_html_1_link_hover_color_css );

		// Footer builder html 1 font size.
		$footer_html_1_font_size_default = array(
			'size' => '',
			'unit' => 'px',
		);

		$footer_html_1_font_size = get_theme_mod( 'colormag_footer_html_1_font_size', $footer_html_1_font_size_default );

		$parse_builder_css .= colormag_parse_slider_css(
			$footer_html_1_font_size_default,
			$footer_html_1_font_size,
			'.cm-footer-builder .cm-html-1 *',
			'font-size'
		);

		// Footer builder html 1 margin.
		$footer_html_1_margin_default = array(
			'top'    => '',
			'right'  => '',
			'bottom' => '',
			'left'   => '',
			'unit'   => 'px',
		);

		$footer_html_1_margin = get_theme_mod( 'colormag_footer_html_1_margin', $footer_html_1_margin_default );

		$parse_builder_css .= colormag_parse_dimension_css(
			$footer_html_1_margin_default,
			$footer_html_1_margin,
			'.cm-footer-builder .cm-html-1',
			'margin'
		);

		// Footer builder footer menu color.
		$footer_menu_color     = get_theme_mod( 'colormag_footer_menu_color', '' );
		$footer_menu_color_css = array(
			'.cm-footer-builder .cm-footer-nav ul li a' => array(
				'color' => esc_html( $footer_menu_color ),
			),
		);
		$parse_builder_css                               .= colormag_parse_css( '', $footer_menu_color, $footer_menu_color_css );

		// Footer builder footer menu hover color.
		$footer_menu_hover_color     = get_theme_mod( 'colormag_footer_menu_hover_color', '' );
		$footer_menu_hover_color_css = array(
			'.cm-footer-builder .cm-footer-nav ul li a:hover' => array(
				'color' => esc_html( $footer_menu_hover_color ),
			),
		);
		$parse_builder_css                               .= colormag_parse_css( '', $footer_menu_hover_color, $footer_menu_hover_color_css );

		// Footer builder footer menu typography.
		$footer_menu_typography_default = array(
			'font-family'    => 'default',
			'font-weight'    => '400',
			'font-size'      => array(
				'desktop' => array(
					'size' => '4',
					'unit' => 'rem',
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
			'line-height'    => array(
				'desktop' => array(
					'size' => '1.3',
					'unit' => '-',
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
			'font-style'     => 'normal',
			'text-transform' => 'none',
		);

		$footer_menu_1_typography = get_theme_mod( 'colormag_footer_menu_1_typography', $footer_menu_typography_default );

		$parse_builder_css .= colormag_parse_typography_css(
			$footer_menu_typography_default,
			$footer_menu_1_typography,
			'.cm-footer-builder .cm-footer-nav-1 ul li a',
			array(
				'tablet' => 768,
				'mobile' => 600,
			)
		);

		// Footer builder top area container.
		$footer_top_area_container_default = array(
			'size' => 0,
			'unit' => 'px',
		);

		$footer_top_area_container = get_theme_mod( 'colormag_footer_top_area_container', $footer_top_area_container_default );

		$parse_builder_css .= colormag_parse_slider_css(
			$footer_top_area_container_default,
			$footer_top_area_container,
			'.cm-footer-builder .cm-footer-top-row .cm-container',
			'max-width'
		);

		// Footer builder top area height.
		$footer_top_area_height_default = array(
			'size' => 0,
			'unit' => 'px',
		);

		$footer_top_area_height = get_theme_mod( 'colormag_footer_top_area_height', $footer_top_area_height_default );

		$parse_builder_css .= colormag_parse_slider_css(
			$footer_top_area_height_default,
			$footer_top_area_height,
			'.cm-footer-builder .cm-top-row',
			'height'
		);

		// Footer top area background.
		$footer_top_area_background_default = array(
			'background-color'      => '',
			'background-image'      => '',
			'background-repeat'     => 'repeat',
			'background-position'   => 'center center',
			'background-size'       => 'contain',
			'background-attachment' => 'scroll',
		);
		$footer_top_area_background         = get_theme_mod( 'colormag_footer_top_area_background', $footer_top_area_background_default );
		$parse_builder_css                           .= colormag_parse_background_css( $footer_top_area_background_default, $footer_top_area_background, '.cm-footer-builder .cm-footer-top-row' );

		// Footer top area widget background.
		$footer_top_area_widget_background_default = array(
			'background-color'      => '',
			'background-image'      => '',
			'background-repeat'     => 'repeat',
			'background-position'   => 'center center',
			'background-size'       => 'contain',
			'background-attachment' => 'scroll',
		);
		$footer_top_area_widget_background         = get_theme_mod( 'colormag_footer_top_area_widget_background', $footer_top_area_widget_background_default );
		$parse_builder_css                           .= colormag_parse_background_css( $footer_top_area_widget_background_default, $footer_top_area_widget_background, '.cm-footer-builder .cm-footer-top-row .widget' );

		// Footer top area padding.
		$footer_top_area_padding_default = array(
			'top'    => '',
			'right'  => '',
			'bottom' => '',
			'left'   => '',
			'unit'   => 'px',
		);

		$footer_top_area_padding = get_theme_mod( 'colormag_footer_top_area_padding', $footer_top_area_padding_default );

		$parse_builder_css .= colormag_parse_dimension_css(
			$footer_top_area_padding_default,
			$footer_top_area_padding,
			'.cm-footer-builder .cm-footer-top-row',
			'padding'
		);

		// Footer top area margin.
		$footer_top_area_margin_default = array(
			'top'    => '',
			'right'  => '',
			'bottom' => '',
			'left'   => '',
			'unit'   => 'px',
		);

		$footer_top_area_margin = get_theme_mod( 'colormag_footer_top_area_margin', $footer_top_area_margin_default );

		$parse_builder_css .= colormag_parse_dimension_css(
			$footer_top_area_margin_default,
			$footer_top_area_margin,
			'.cm-footer-builder .cm-footer-top-row',
			'margin'
		);

		// Footer top area border width.
		$footer_top_area_border_width_default = array(
			'top'    => '0',
			'right'  => '0',
			'bottom' => '0',
			'left'   => '0',
			'unit'   => 'px',
		);

		$footer_top_area_border_width = get_theme_mod( 'colormag_footer_top_area_border_width', $footer_top_area_border_width_default );

		$parse_builder_css .= colormag_parse_dimension_css(
			$footer_top_area_border_width_default,
			$footer_top_area_border_width,
			'.cm-footer-builder .cm-footer-top-row',
			'border-width'
		);

		// Footer builder top area border color.
		$footer_top_area_border_color     = get_theme_mod( 'colormag_footer_top_area_border_color', '' );
		$footer_top_area_border_color_css = array(
			'.cm-footer-builder .cm-footer-top-row' => array(
				'border-color' => esc_html( $footer_top_area_border_color ),
			),
		);
		$parse_builder_css                   .= colormag_parse_css( '', $footer_top_area_border_color, $footer_top_area_border_color_css );

		// Footer builder main area height.
		$footer_main_area_height_default = array(

			'size' => 0,
			'unit' => 'px',
		);

		$footer_main_area_height = get_theme_mod( 'colormag_footer_main_area_height', $footer_main_area_height_default );

		$parse_builder_css .= colormag_parse_slider_css(
			$footer_main_area_height_default,
			$footer_main_area_height,
			'.cm-footer-builder .cm-main-row',
			'height'
		);

		// Footer builder main area container.
		$footer_main_area_container_default = array(
			'size' => 0,
			'unit' => 'px',
		);

		$footer_main_area_container = get_theme_mod( 'colormag_footer_main_area_container', $footer_main_area_container_default );

		$parse_builder_css .= colormag_parse_slider_css(
			$footer_main_area_container_default,
			$footer_main_area_container,
			'.cm-footer-builder .cm-footer-main-row .cm-container',
			'max-width'
		);

		// Footer builder main area background.
		$footer_main_area_background_default = array(
			'background-color'      => '',
			'background-image'      => '',
			'background-repeat'     => 'repeat',
			'background-position'   => 'center center',
			'background-size'       => 'contain',
			'background-attachment' => 'scroll',
		);
		$footer_main_area_background         = get_theme_mod( 'colormag_footer_main_area_background', $footer_main_area_background_default );
		$parse_builder_css                           .= colormag_parse_background_css( $footer_main_area_background_default, $footer_main_area_background, '.cm-footer-builder .cm-footer-main-row' );

		// Footer builder main area padding.
		$footer_main_area_padding_default = array(
			'top'    => '',
			'right'  => '',
			'bottom' => '',
			'left'   => '',
			'unit'   => 'px',
		);

		$footer_main_area_padding = get_theme_mod( 'colormag_footer_main_area_padding', $footer_main_area_padding_default );

		$parse_builder_css .= colormag_parse_dimension_css(
			$footer_main_area_padding_default,
			$footer_main_area_padding,
			'.cm-footer-builder .cm-footer-main-row',
			'padding'
		);

		// Footer builder main area margin.
		$footer_main_area_margin_default = array(
			'top'    => '',
			'right'  => '',
			'bottom' => '',
			'left'   => '',
			'unit'   => 'px',
		);

		$footer_main_area_margin = get_theme_mod( 'colormag_footer_main_area_margin', $footer_main_area_margin_default );

		$parse_builder_css .= colormag_parse_dimension_css(
			$footer_main_area_margin_default,
			$footer_main_area_margin,
			'.cm-footer-builder .cm-footer-main-row',
			'margin'
		);

		// Footer builder main area border width.
		$footer_main_area_border_width_default = array(
			'top'    => '0',
			'right'  => '0',
			'bottom' => '0',
			'left'   => '0',
			'unit'   => 'px',
		);

		$footer_main_area_border_width = get_theme_mod( 'colormag_footer_main_area_border_width', $footer_main_area_border_width_default );

		$parse_builder_css .= colormag_parse_dimension_css(
			$footer_main_area_border_width_default,
			$footer_main_area_border_width,
			'.cm-footer-builder .cm-footer-main-row',
			'border-width'
		);

		// Footer builder main area border color.
		$footer_main_area_border_color     = get_theme_mod( 'colormag_footer_main_area_border_color', '' );
		$footer_main_area_border_color_css = array(
			'.cm-footer-builder .cm-footer-main-row' => array(
				'border-color' => esc_html( $footer_main_area_border_color ),
			),
		);
		$parse_builder_css                   .= colormag_parse_css( '', $footer_main_area_border_color, $footer_main_area_border_color_css );

		// Footer builder bottom area height.
		$footer_bottom_area_height_default = array(
			'size' => 0,
			'unit' => 'px',
		);

		$footer_bottom_area_height = get_theme_mod( 'colormag_footer_bottom_area_height', $footer_bottom_area_height_default );

		$parse_builder_css .= colormag_parse_slider_css(
			$footer_bottom_area_height_default,
			$footer_bottom_area_height,
			'.cm-footer-builder .cm-bottom-row',
			'height'
		);

		// Footer builder bottom area container.
		$footer_bottom_area_container_default = array(
			'size' => 0,
			'unit' => 'px',
		);

		$footer_bottom_area_container = get_theme_mod( 'colormag_footer_bottom_area_container', $footer_bottom_area_container_default );

		$parse_builder_css .= colormag_parse_slider_css(
			$footer_bottom_area_container_default,
			$footer_bottom_area_container,
			'.cm-footer-builder .cm-footer-bottom-row .cm-container',
			'max-width'
		);

		// Footer builder bottom area background.
		$footer_bottom_area_background_default = array(
			'background-color'      => '',
			'background-image'      => '',
			'background-repeat'     => 'repeat',
			'background-position'   => 'center center',
			'background-size'       => 'contain',
			'background-attachment' => 'scroll',
		);
		$footer_bottom_area_background         = get_theme_mod( 'colormag_footer_bottom_area_background', $footer_bottom_area_background_default );
		$parse_builder_css                           .= colormag_parse_background_css( $footer_bottom_area_background_default, $footer_bottom_area_background, '.cm-footer-builder .cm-footer-bottom-row' );

		// Footer builder bottom area padding.
		$footer_bottom_area_padding_default = array(
			'top'    => '',
			'right'  => '',
			'bottom' => '',
			'left'   => '',
			'unit'   => 'px',
		);

		$footer_bottom_area_padding = get_theme_mod( 'colormag_footer_bottom_area_padding', $footer_bottom_area_padding_default );

		$parse_builder_css .= colormag_parse_dimension_css(
			$footer_bottom_area_padding_default,
			$footer_bottom_area_padding,
			'.cm-footer-builder .cm-footer-bottom-row',
			'padding'
		);

		// Footer builder bottom area margin.
		$footer_bottom_area_margin_default = array(
			'top'    => '',
			'right'  => '',
			'bottom' => '',
			'left'   => '',
			'unit'   => 'px',
		);

		$footer_bottom_area_margin = get_theme_mod( 'colormag_footer_bottom_area_margin', $footer_bottom_area_margin_default );

		$parse_builder_css .= colormag_parse_dimension_css(
			$footer_bottom_area_margin_default,
			$footer_bottom_area_margin,
			'.cm-footer-builder .cm-footer-bottom-row',
			'margin'
		);

		// Footer builder bottom area border width.
		$footer_bottom_area_border_width_default = array(
			'top'    => '0',
			'right'  => '0',
			'bottom' => '0',
			'left'   => '0',
			'unit'   => 'px',
		);

		$footer_bottom_area_border_width = get_theme_mod( 'colormag_footer_bottom_area_border_width', $footer_bottom_area_border_width_default );

		$parse_builder_css .= colormag_parse_dimension_css(
			$footer_bottom_area_border_width_default,
			$footer_bottom_area_border_width,
			'.cm-footer-builder .cm-footer-bottom-row',
			'border-width'
		);

		$footer_bottom_area_border_color     = get_theme_mod( 'colormag_footer_bottom_area_border_color', '' );
		$footer_bottom_area_border_color_css = array(
			'.cm-footer-builder .cm-footer-bottom-row' => array(
				'border-color' => esc_html( $footer_bottom_area_border_color ),
			),
		);
		$parse_builder_css                   .= colormag_parse_css( '', $footer_bottom_area_border_color, $footer_bottom_area_border_color_css );

		// Header builder site logo width.
		$header_site_logo_width_default = array(
			'size' => '',
			'unit' => 'px',
		);

		$header_site_logo_width = get_theme_mod( 'colormag_header_site_logo_height', $header_site_logo_width_default );

		$parse_builder_css .= colormag_parse_slider_css(
			$header_site_logo_width_default,
			$header_site_logo_width,
			'.cm-header-builder .cm-site-branding img',
			'width'
		);

		// Header builder site title color.
		$header_site_title_color     = get_theme_mod( 'colormag_header_site_identity_color', '' );
		$header_site_title_color_css = array(
			'.cm-header-builder .cm-site-title a' => array(
				'color' => esc_html( $header_site_title_color ),
			),
		);
		$parse_builder_css            .= colormag_parse_css( '', $header_site_title_color, $header_site_title_color_css );

		// Header builder site title hover color.
		$header_site_title_hover_color     = get_theme_mod( 'colormag_header_site_identity_hover_color', '' );
		$header_site_title_hover_color_css = array(
			'.cm-header-builder .cm-site-title a:hover' => array(
				'color' => esc_html( $header_site_title_hover_color ),
			),
		);
		$parse_builder_css            .= colormag_parse_css( '#16181a', $header_site_title_hover_color, $header_site_title_hover_color_css );

		// Header builder site title typography.
		$header_site_title_typography_default = array(
			'font-family'    => 'Default',
			'font-weight'    => 'regular',
			'font-size'      => array(
				'desktop' => array(
					'size' => '1.6',
					'unit' => 'rem',
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
			'line-height'    => array(
				'desktop' => array(
					'size' => '1.8',
					'unit' => '-',
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
			'font-style'     => 'normal',
			'text-transform' => 'none',
		);

		$header_site_title_typography = get_theme_mod( 'colormag_header_site_title_typography', $header_site_title_typography_default );

		$parse_builder_css .= colormag_parse_typography_css(
			$header_site_title_typography_default,
			$header_site_title_typography,
			'.cm-header-builder .cm-site-title a',
			array(
				'tablet' => 768,
				'mobile' => 600,
			)
		);

		// Header builder site tagline color.
		$header_site_tagline_color     = get_theme_mod( 'colormag_header_site_tagline_color', '' );
		$header_site_tagline_color_css = array(
			'.cm-header-builder .cm-site-description' => array(
				'color' => esc_html( $header_site_tagline_color ),
			),
		);
		$parse_builder_css            .= colormag_parse_css( '', $header_site_tagline_color, $header_site_tagline_color_css );

		// Header toggle color.
		$header_toggle_color     = get_theme_mod( 'colormag_header_builder_toggle_button_color', '' );
		$header_toggle_color_css = array(
			'.cm-header-builder .cm-toggle-button,.cm-header-builder .cm-mobile-row .cm-menu-toggle svg' => array(
				'fill' => esc_html( $header_toggle_color ),
			),
		);
		$parse_builder_css            .= colormag_parse_css( '', $header_toggle_color, $header_toggle_color_css );

		// Header builder site tagline typography.
		$header_site_tagline_typography_default     = array(
			'font-family'    => 'Default',
			'font-weight'    => '400',
			'subsets'        => array( 'latin' ),
			'font-size'      => array(
				'desktop' => array(
					'size' => '',
					'unit' => 'rem',
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
			'line-height'    => array(
				'desktop' => array(
					'size' => '1.8',
					'unit' => '-',
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
			'font-style'     => 'normal',
			'text-transform' => 'none',
		);
		$header_site_tagline_typography     = get_theme_mod( 'colormag_header_site_tagline_typography', $header_site_tagline_typography_default );

		// Site tagline typography.
		$parse_builder_css .= colormag_parse_typography_css(
			$header_site_tagline_typography_default,
			$header_site_tagline_typography,
			'.cm-header-builder .cm-site-description',
			array(
				'tablet' => 768,
				'mobile' => 600,
			)
		);

		// Header mobile menu color.
		$header_mobile_menu_color     = get_theme_mod( 'colormag_header_mobile_menu_item_color', '' );
		$header_mobile_menu_color_css = array(
			'.cm-header-builder .cm-mobile-nav ul li a' => array(
				'color' => esc_html( $header_mobile_menu_color ),
			),
		);
		$parse_builder_css            .= colormag_parse_css( '', $header_mobile_menu_color, $header_mobile_menu_color_css );

		// Header mobile menu hover color.
		$header_mobile_menu_hover_color     = get_theme_mod( 'colormag_header_mobile_menu_item_hover_color', '' );
		$header_mobile_menu_hover_color_css = array(
			'.cm-header-builder .cm-mobile-nav ul li:hover a' => array(
				'color' => esc_html( $header_mobile_menu_hover_color ),
			),
		);
		$parse_builder_css            .= colormag_parse_css( '', $header_mobile_menu_hover_color, $header_mobile_menu_hover_color_css );

		// Header mobile background.
		$mobile_background_default = array(
			'background-color'      => '',
			'background-image'      => '',
			'background-position'   => 'center center',
			'background-size'       => 'auto',
			'background-attachment' => 'scroll',
			'background-repeat'     => 'repeat',
		);
		$mobile_background         = get_theme_mod( 'colormag_mobile_menu_background', $mobile_background_default );
		$parse_builder_css                      .= colormag_parse_background_css( $mobile_background_default, $mobile_background, '.cm-mobile-nav ul li' );

		// Header mobile typography.
		$header_mobile_typography_default     = array(
			'font-family'    => 'Default',
			'font-weight'    => '400',
			'font-size'      => array(
				'desktop' => array(
					'size' => '1.6',
					'unit' => 'rem',
				),
				'tablet'  => array(
					'size' => '',
					'unit' => '',
				),
				'mobile'  => array(
					'size' => '1.6',
					'unit' => 'rem',
				),
			),
			'line-height'    => array(
				'desktop' => array(
					'size' => '1.8',
					'unit' => '-',
				),
				'tablet'  => array(
					'size' => '',
					'unit' => '',
				),
				'mobile'  => array(
					'size' => '1.8',
					'unit' => '-',
				),
			),
			'font-style'     => 'normal',
			'text-transform' => 'none',
		);
		$header_mobile_typography     = get_theme_mod( 'colormag_header_mobile_menu_typography', $header_mobile_typography_default );
		$parse_builder_css .= colormag_parse_typography_css(
			$header_mobile_typography_default,
			$header_mobile_typography,
			'.cm-header-builder .cm-mobile-nav ul li a',
			array(
				'tablet' => 768,
				'mobile' => 600,
			)
		);

		// Header builder mobile menu background color.
		$header_mobile_menu_background_color     = get_theme_mod( 'colormag_header_mobile_menu_background', '' );
		$header_mobile_menu_background_color_css = array(
			'.cm-mobile-nav li' => array(
				'background-color' => esc_html( $header_mobile_menu_background_color ),
			),
		);
		$parse_builder_css                       .= colormag_parse_css( '', $header_mobile_menu_background_color, $header_mobile_menu_background_color_css );


		// Footer builder area cols.
		$footer_builder_top_col = get_theme_mod('colormag_footer_top_area_cols', 4);

		$footer_builder_main_col = get_theme_mod('colormag_footer_main_area_cols', 4);

		$footer_builder_bottom_col = get_theme_mod('colormag_footer_bottom_area_cols', 2);

		$parse_builder_css .= ":root{--top-grid-columns: {$footer_builder_top_col};
			--main-grid-columns: {$footer_builder_main_col};
			--bottom-grid-columns: {$footer_builder_bottom_col};
			}";

		if ( 1 == $footer_builder_top_col ){
			$parse_builder_css .= " .cm-footer-builder .cm-top-row{justify-items: center;} ";
			$parse_builder_css .= " .cm-footer-builder .cm-top-row .cm-footer-top-1-col{ display: block;} ";
		} elseif ( 1 === $footer_builder_main_col ) {
			$parse_builder_css .= " .cm-footer-builder .cm-main-row{justify-items: center;} ";
		} elseif ( 1 === $footer_builder_bottom_col ) {
			$parse_builder_css .= " .cm-footer-builder .cm-bottom-row{justify-items: center;} ";
		}

		// Footer bottom layout alignment.
		$footer_builder_bottom_layout = get_theme_mod('colormag_footer_bottom_inner_element_layout', 'column');

		if ( ! empty( $footer_builder_bottom_layout ) ) {
			$parse_builder_css .= ".cm-footer-builder .cm-footer-bottom-row .cm-footer-col{flex-direction: $footer_builder_bottom_layout;}";
		}

		// Footer main layout alignment.
		$footer_builder_main_layout = get_theme_mod('colormag_footer_main_inner_element_layout', 'column');

		if ( ! empty( $footer_builder_main_layout ) ) {
			$parse_builder_css .= ".cm-footer-builder .cm-footer-main-row .cm-footer-col{flex-direction: $footer_builder_main_layout;}";
		}

		// Footer top layout alignment.
		$footer_builder_top_layout = get_theme_mod('colormag_footer_top_inner_element_layout', 'column');

		if ( ! empty( $footer_builder_top_layout ) ) {
			$parse_builder_css .= ".cm-footer-builder .cm-footer-top-row .cm-footer-col{flex-direction: $footer_builder_top_layout;}";
		}

		$color_palette_default = array(
			'id'     => 'preset-1',
			'name'   => 'Preset 1',
			'colors' => array(
				'colormag-color-1' => '#eaf3fb',
				'colormag-color-2' => '#bfdcf3',
				'colormag-color-3' => '#94c4eb',
				'colormag-color-4' => '#6aace2',
				'colormag-color-5' => '#257bc1',
				'colormag-color-6' => '#1d6096',
				'colormag-color-7' => '#15446b',
				'colormag-color-8' => '#0c2941',
				'colormag-color-9' => '#040e16',
			),
		);

		// Color palette.
		$color_palette = get_theme_mod('colormag_color_palette', $color_palette_default );
		$parse_builder_css .= sprintf(' :root{%s}', array_reduce( array_keys($color_palette['colors'] ?? []), function($acc, $curr) use ($color_palette) {
			$acc .= "--{$curr}: {$color_palette['colors'][$curr]};";

			return $acc;
		}, '' ));


		return $parse_builder_css;
	}
}
