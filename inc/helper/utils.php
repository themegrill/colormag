<?php

if ( ! function_exists( 'colormag_footer_builder_copyright' ) ) {

	/**
	 * Get Copyright text.
	 *
	 * @param string $section 'one' or 'two' only should be passed as param.
	 *
	 * @return array|string|string[]|null
	 */
	function colormag_footer_builder_copyright() {

		$default = sprintf(
		/* translators: 1: Current Year, 2: Site Name, 3: Theme Link, 4: WordPress Link. */
			esc_html__( 'Copyright &copy; %1$s %2$s. Powered by %3$s and %4$s.', 'colormag' ),
			'{the-year}',
			'{site-link}',
			'{theme-link}',
			'{wp-link}'
		);

		$content      = get_theme_mod( 'colormag_footer_copyright', $default );
		$theme_author = apply_filters(
			'colormag_theme_author',
			array(
				'theme_name'       => __( 'ColorMag', 'colormag' ),
				'theme_author_url' => 'https://themegrill.com/themes/colormag/',
			)
		);
		$site_link    = '<a href="' . esc_url( home_url( '/' ) ) . '" title="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '" >' . get_bloginfo( 'name', 'display' ) . '</a>';
		$theme_link   = '<a href="' . esc_url( $theme_author['theme_author_url'] ) . '" target="_blank" title="' . esc_attr( $theme_author['theme_name'] ) . '" rel="nofollow">' . $theme_author['theme_name'] . '</a>';
		$wp_link      = '<a href="' . esc_url( 'https://wordpress.org/' ) . '" target="_blank" title="' . esc_attr__( 'WordPress', 'colormag' ) . '" rel="nofollow">' . __( 'WordPress', 'colormag' ) . '</a>';

		if ( $content || is_customize_preview() ) {
			$content = str_replace( '{the-year}', date_i18n( 'Y' ), $content );
			$content = str_replace( '{site-link}', $site_link, $content );
			$content = str_replace( '{theme-link}', $theme_link, $content );
			$content = str_replace( '{wp-link}', $wp_link, $content );
		}

		return $content;
	}
}
