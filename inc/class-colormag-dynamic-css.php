<?php
/**
 * ColorMag dynamic CSS generation file for theme options.
 *
 * Class ColorMag_Dynamic_CSS
 *
 * @package    ThemeGrill
 * @subpackage ColorMag
 * @since      ColorMag 2.0.0
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
		// Primary color.
		$primary_color = get_theme_mod( 'colormag_primary_color', '#289dcc' );
		$primary_dark  = colormag_darkcolor( $primary_color, - 30 );


		// Generate dynamic CSS.
		$parse_css = '';


		// For primary color option.
		$primary_color_css = array(
			'.colormag-button,blockquote,button,input[type=reset],input[type=button],input[type=submit],#masthead.colormag-header-clean #site-navigation.main-small-navigation .menu-toggle,.fa.search-top:hover,#masthead.colormag-header-classic #site-navigation.main-small-navigation .menu-toggle,.main-navigation ul li.focus > a,#masthead.colormag-header-classic .main-navigation ul ul.sub-menu li.focus > a,.home-icon.front_page_on,.main-navigation a:hover,.main-navigation ul li ul li a:hover,.main-navigation ul li ul li:hover>a,.main-navigation ul li.current-menu-ancestor>a,.main-navigation ul li.current-menu-item ul li a:hover,.main-navigation ul li.current-menu-item>a,.main-navigation ul li.current_page_ancestor>a,.main-navigation ul li.current_page_item>a,.main-navigation ul li:hover>a,.main-small-navigation li a:hover,.site-header .menu-toggle:hover,#masthead.colormag-header-classic .main-navigation ul ul.sub-menu li:hover > a,#masthead.colormag-header-classic .main-navigation ul ul.sub-menu li.current-menu-ancestor > a,#masthead.colormag-header-classic .main-navigation ul ul.sub-menu li.current-menu-item > a,#masthead .main-small-navigation li:hover > a,#masthead .main-small-navigation li.current-page-ancestor > a,#masthead .main-small-navigation li.current-menu-ancestor > a,#masthead .main-small-navigation li.current-page-item > a,#masthead .main-small-navigation li.current-menu-item > a,.main-small-navigation .current-menu-item>a,.main-small-navigation .current_page_item > a,.promo-button-area a:hover,#content .wp-pagenavi .current,#content .wp-pagenavi a:hover,.format-link .entry-content a,.pagination span,.comments-area .comment-author-link span,#secondary .widget-title span,.footer-widgets-area .widget-title span,.colormag-footer--classic .footer-widgets-area .widget-title span::before,.advertisement_above_footer .widget-title span,#content .post .article-content .above-entry-meta .cat-links a,.page-header .page-title span,.entry-meta .post-format i,.more-link,.no-post-thumbnail,.widget_featured_slider .slide-content .above-entry-meta .cat-links a,.widget_highlighted_posts .article-content .above-entry-meta .cat-links a,.widget_featured_posts .article-content .above-entry-meta .cat-links a,.widget_featured_posts .widget-title span,.widget_slider_area .widget-title span,.widget_beside_slider .widget-title span,.wp-block-quote,.wp-block-quote.is-style-large,.wp-block-quote.has-text-align-right' => array(
				'background-color' => esc_html( $primary_color ),
			),

			'#site-title a,.next a:hover,.previous a:hover,.social-links i.fa:hover,a,#masthead.colormag-header-clean .social-links li:hover i.fa,#masthead.colormag-header-classic .social-links li:hover i.fa,#masthead.colormag-header-clean .breaking-news .newsticker a:hover,#masthead.colormag-header-classic .breaking-news .newsticker a:hover,#masthead.colormag-header-classic #site-navigation .fa.search-top:hover,#masthead.colormag-header-classic #site-navigation.main-navigation .random-post a:hover .fa-random,.dark-skin #masthead.colormag-header-classic #site-navigation.main-navigation .home-icon:hover .fa,#masthead .main-small-navigation li:hover > .sub-toggle i,.better-responsive-menu #masthead .main-small-navigation .sub-toggle.active .fa,#masthead.colormag-header-classic .main-navigation .home-icon a:hover .fa,.pagination a span:hover,#content .comments-area a.comment-edit-link:hover,#content .comments-area a.comment-permalink:hover,#content .comments-area article header cite a:hover,.comments-area .comment-author-link a:hover,.comment .comment-reply-link:hover,.nav-next a,.nav-previous a,.footer-widgets-area a:hover,a#scroll-up i,#content .post .article-content .entry-title a:hover,.entry-meta .byline i,.entry-meta .cat-links i,.entry-meta a,.post .entry-title a:hover,.search .entry-title a:hover,.entry-meta .comments-link a:hover,.entry-meta .edit-link a:hover,.entry-meta .posted-on a:hover,.entry-meta .tag-links a:hover,.single #content .tags a:hover,.post-box .entry-meta .cat-links a:hover,.post-box .entry-meta .posted-on a:hover,.post.post-box .entry-title a:hover,.widget_featured_slider .slide-content .below-entry-meta .byline a:hover,.widget_featured_slider .slide-content .below-entry-meta .comments a:hover,.widget_featured_slider .slide-content .below-entry-meta .posted-on a:hover,.widget_featured_slider .slide-content .entry-title a:hover,.byline a:hover,.comments a:hover,.edit-link a:hover,.posted-on a:hover,.tag-links a:hover,.widget_highlighted_posts .article-content .below-entry-meta .byline a:hover,.widget_highlighted_posts .article-content .below-entry-meta .comments a:hover,.widget_highlighted_posts .article-content .below-entry-meta .posted-on a:hover,.widget_highlighted_posts .article-content .entry-title a:hover,.widget_featured_posts .article-content .entry-title a:hover,.related-posts-main-title .fa,.single-related-posts .article-content .entry-title a:hover' => array(
				'color' => esc_html( $primary_color ),
			),

			'#site-navigation' => array(
				'border-top-color' => esc_html( $primary_color ),
			),

			'#masthead.colormag-header-classic .main-navigation ul ul.sub-menu li:hover,#masthead.colormag-header-classic .main-navigation ul ul.sub-menu li.current-menu-ancestor,#masthead.colormag-header-classic .main-navigation ul ul.sub-menu li.current-menu-item,#masthead.colormag-header-classic #site-navigation .menu-toggle,#masthead.colormag-header-classic #site-navigation .menu-toggle:hover,#masthead.colormag-header-classic .main-navigation ul > li:hover > a,#masthead.colormag-header-classic .main-navigation ul > li.current-menu-item > a,#masthead.colormag-header-classic .main-navigation ul > li.current-menu-ancestor > a,#masthead.colormag-header-classic .main-navigation ul li.focus > a,.promo-button-area a:hover,.pagination a span:hover' => array(
				'border-color' => esc_html( $primary_color ),
			),

			'#secondary .widget-title,.footer-widgets-area .widget-title,.advertisement_above_footer .widget-title,.page-header .page-title,.widget_featured_posts .widget-title,.widget_slider_area .widget-title,.widget_beside_slider .widget-title' => array(
				'border-bottom-color' => esc_html( $primary_color ),
			),
		);

		$parse_css .= colormag_parse_css( '#289dcc', $primary_color, $primary_color_css );

		$primary_dark_color_css = array(
			'.better-responsive-menu .sub-toggle' => array(
				'background-color' => esc_html( $primary_dark ),
			),
		);

		$parse_css .= colormag_parse_css( '#289dcc', $primary_color, $primary_dark_color_css, '', 768 );

		// Primary color for Elementor.
		if ( defined( 'ELEMENTOR_VERSION' ) ) {

			$primary_color_elementor_css = array(
				'.elementor .elementor-widget-wrap .tg-module-wrapper .module-title' => array(
					'border-bottom-color' => esc_html( $primary_color ),
				),

				'.elementor .elementor-widget-wrap .tg-module-wrapper .module-title span,.elementor .elementor-widget-wrap .tg-module-wrapper .tg-post-category' => array(
					'background-color' => esc_html( $primary_color ),
				),

				'.elementor .elementor-widget-wrap .tg-module-wrapper .tg-module-meta .tg-module-comments a:hover,.elementor .elementor-widget-wrap .tg-module-wrapper .tg-module-meta .tg-post-auther-name a:hover,.elementor .elementor-widget-wrap .tg-module-wrapper .tg-module-meta .tg-post-date a:hover,.elementor .elementor-widget-wrap .tg-module-wrapper .tg-module-title:hover a,.elementor .elementor-widget-wrap .tg-module-wrapper.tg-module-grid .tg_module_grid .tg-module-info .tg-module-meta a:hover' => array(
					'color' => esc_html( $primary_color ),
				),
			);

			$parse_css .= colormag_parse_css( '#289dcc', $primary_color, $primary_color_elementor_css );

		}


		// Add the custom CSS rendered dynamically, which is static.
		$parse_css .= self::render_custom_output();


		$parse_css .= $dynamic_css;

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

}

return new ColorMag_Dynamic_CSS();
