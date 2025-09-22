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

		$full_search_width_default = array(
			'size' => '',
			'unit' => 'px',
		);

		$full_width_search = get_theme_mod( 'colormag_header_search_width', $full_search_width_default );

		$parse_css .= colormag_parse_slider_css(
			$full_search_width_default,
			$full_width_search,
			'.cm-search-icon-in-input-right .search-wrap,.cm-search-box .search-wrap',
			'width'
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

		$search_border_width_default = array(
			'top'    => '',
			'right'  => '',
			'bottom' => '',
			'left'   => '',
			'unit'   => 'px',
		);

		$full_search_border_width = get_theme_mod( 'colormag_header_search_border_width', $search_border_width_default );

		$parse_css .= colormag_parse_dimension_css(
			$search_border_width_default,
			$full_search_border_width,
			'.cm-search-icon-in-input-right .search-wrap input',
			'border-width'
		);

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

		$content_area_padding_default = array(
			'top'    => '60',
			'right'  => '',
			'bottom' => '60',
			'left'   => '',
			'unit'   => 'px',
		);

		$content_area_padding = get_theme_mod( 'colormag_content_area_padding', $content_area_padding_default );

		$parse_css .= colormag_parse_dimension_css(
			$content_area_padding_default,
			$content_area_padding,
			'.cm-content',
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
		$parse_css                      .= colormag_parse_background_css( $outside_background_default, $outside_background, 'body,body.boxed' );

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

			$color_palette_default = array(
				'id'     => 'preset-5',
				'name'   => 'Preset 5',
				'colors' => array(
					'cm-color-1' => '#257BC1',
					'cm-color-2' => '#2270B0',
					'cm-color-3' => '#FFFFFF',
					'cm-color-4' => '#F9FEFD',
					'cm-color-5' => '#27272A',
					'cm-color-6' => '#16181A',
					'cm-color-7' => '#8F8F8F',
					'cm-color-8' => '#FFFFFF',
					'cm-color-9' => '#C7C7C7',
				),
			);

			// Color palette.
			$color_palette = get_theme_mod( 'colormag_color_palette', $color_palette_default );

			if ( empty( $color_palette ) ) {
				$parse_css .= ' :root{
				--cm-color-1: inherit;
				--cm-color-2: inherit;
				--cm-color-3: inherit;
				--cm-color-4: inherit;
				--cm-color-5: inherit;
				--cm-color-6: inherit;
				--cm-color-7: inherit;
				--cm-color-8: inherit;
				--cm-color-9: inherit;
			}';
			} else {
				$parse_css .= sprintf(
					' :root{%s}',
					array_reduce(
						array_keys( $color_palette['colors'] ?? [] ),
						function ( $acc, $curr ) use ( $color_palette ) {
							$acc .= "--{$curr}: {$color_palette['colors'][$curr]};";

							return $acc;
						},
						''
					)
				);
			}

		}

		// Add the custom CSS rendered dynamically, which is static.
		$parse_css .= self::render_custom_output();
		$parse_css .= ColorMag_Dynamic_Builder_CSS::render_builder_output( $parse_css );

		$parse_css .= $dynamic_css;

		$parse_css .= self::colormag_editor_block_css();
		$parse_css .= self::generate_color_palette_css_variables();

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
	 * Generate CSS variables for ColorMag color palette.
	 *
	 * @return string Generated CSS variables.
	 */
	public static function generate_color_palette_css_variables() {
		$global_palette = get_theme_mod(
			'colormag_color_palette',
			array(
				'id'     => 'preset-5',
				'name'   => 'Default',
				'colors' => array(
					'cm-color-1' => '#257BC1',
					'cm-color-2' => '#2270B0',
					'cm-color-3' => '#FFFFFF',
					'cm-color-4' => '#F9FEFD',
					'cm-color-5' => '#27272A',
					'cm-color-6' => '#16181A',
					'cm-color-7' => '#8F8F8F',
					'cm-color-8' => '#FFFFFF',
					'cm-color-9' => '#C7C7C7',
				),
			)
		);

		if ( empty( $global_palette ) ) {
			$css = ':root{
				--wp--preset--color--cm-color-1: inherit;
				--wp--preset--color--cm-color-2: inherit;
				--wp--preset--color--cm-color-3: inherit;
				--wp--preset--color--cm-color-4: inherit;
				--wp--preset--color--cm-color-5: inherit;
				--wp--preset--color--cm-color-6: inherit;
				--wp--preset--color--cm-color-7: inherit;
				--wp--preset--color--cm-color-8: inherit;
				--wp--preset--color--cm-color-9: inherit;
			}';
		} else {
			$css = ':root {';

			if ( isset( $global_palette['colors'] ) && is_array( $global_palette['colors'] ) ) {
				foreach ( $global_palette['colors'] as $color_key => $color_value ) {
					// Generate WordPress preset color variables
					$css .= '--wp--preset--color--' . $color_key . ':' . $color_value . ';';
				}
			}

			$css .= '}';
		}



		return $css;
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
