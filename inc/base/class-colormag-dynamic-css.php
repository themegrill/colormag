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

		// Header options.
		$header_background_default       = array(
			'background-color'      => '#ffffff',
			'background-image'      => '',
			'background-position'   => 'center center',
			'background-size'       => 'auto',
			'background-attachment' => 'scroll',
			'background-repeat'     => 'repeat',
		);

		$header_background           = get_theme_mod( 'colormag_main_header_background', $header_background_default );

		// Header options.
		$outside_container_background_default       = array(
			'background-color'      => '#ffffff',
			'background-image'      => '',
			'background-position'   => 'center center',
			'background-size'       => 'auto',
			'background-attachment' => 'scroll',
			'background-repeat'     => 'repeat',
		);

		$outside_container_background         = get_theme_mod( 'colormag_outside_container_background', $outside_container_background_default );

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
		$footer_sidebar_area_background               = get_theme_mod( 'colormag_footer_sidebar_area_background_setting', $footer_sidebar_area_background_default );
		$footer_upper_sidebar_area_background         = get_theme_mod( 'colormag_footer_upper_sidebar_area_background_setting', $footer_upper_sidebar_area_background_default );



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

		/**
		 * Header options.
		 */
		// Background.
		$parse_css .= colormag_parse_background_css( $header_background_default, $header_background, '.cm-header' );

		// Background.
		$parse_css .= colormag_parse_background_css( $outside_container_background_default, $outside_container_background, 'body' );

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

		// Footer sidebar area background.
		$parse_css .= colormag_parse_background_css( $footer_sidebar_area_background_default, $footer_sidebar_area_background, '.cm-footer-cols' );

		// Footer upper sidebar area background.
		$parse_css .= colormag_parse_background_css( $footer_upper_sidebar_area_background_default, $footer_upper_sidebar_area_background, '#cm-footer .cm-upper-footer-cols .widget' );

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

}
