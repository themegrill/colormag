<?php
/**
 * HTML attribute functions and filters.
 *
 * This provides a way to hook into the attributes for specific HTML elements and create new or modify existing attributes.
 * This provide richer microdata while being forward compatible with the ever-changing Web.
 * Currently, the default microdata vocabulary supported is Schema.org.
 *
 * @package    ThemeGrill
 * @subpackage Colormag Pro
 * @since      Colormag Pro 2.1.9
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'colormag_schema_markup' ) ) :

	/**
	 * Returns schema.org markup based on context value.
	 *
	 * @param array $context The context in which it is called upon.
	 *
	 * @return string Schema.org markup.
	 */
	function colormag_schema_markup( $context = '' ) {

		// Bail out if Schema markup is disabled.
		if ( 1 != get_theme_mod( 'colormag_enable_schema_markup', '' ) ) {
			return;
		}

		// No valid context parameter? stop here.
		if ( empty( $context ) ) {
			return;
		}

		// Store markup string.
		$markup     = ' ';
		$attributes = array();

		// Let's try to fetch the right Markup.
		switch ( $context ) {

			case 'body':
				$attributes['itemscope'] = 'itemscope';
				$attributes['itemtype']  = 'http://schema.org/WebPage';

				$attributes['dir'] = is_rtl() ? 'rtl' : 'ltr';

				if ( is_singular( 'post' ) || is_home() || is_archive() ) {
					$attributes['itemtype'] = 'http://schema.org/Blog';
				} elseif ( is_search() ) {
					$attributes['itemtype'] = 'http://schema.org/SearchResultsPage';
				}

				break;

			case 'header':
				$attributes['role']      = 'banner';
				$attributes['itemscope'] = 'itemscope';
				$attributes['itemtype']  = 'http://schema.org/WPHeader';
				break;

			case 'site-title':
				$attributes['itemprop'] = 'headline';
				break;

			case 'site-description':
				$attributes['itemprop'] = 'description';
				break;

			case 'nav':
				$attributes['role']      = 'navigation';
				$attributes['itemscope'] = 'itemscope';
				$attributes['itemtype']  = 'http://schema.org/SiteNavigationElement';
				break;

			case 'content':
				$attributes['role'] = 'main';

				if ( ! is_singular( 'post' ) && ! is_home() && ! is_archive() ) {
					$attributes['itemprop'] = 'mainContentOfPage';
				}

				break;

			case 'entry':
				global $post;
				$attributes['itemscope'] = 'itemscope';
				$attributes['itemtype']  = 'http://schema.org/CreativeWork';

				// Blog Posts microdata.
				if ( 'post' === $post->post_type ) {
					$attributes['itemtype'] = 'http://schema.org/BlogPosting';

					/* Add itemprop if within the main query. */
					if ( is_main_query() && ! is_search() ) {
						$attributes['itemprop'] = 'blogPost';
					}
				}

				break;

			case 'image':
				$attributes['itemprop'] = 'image';
				$attributes['itemtype'] = 'http://schema.org/ImageObject';
				break;

			case 'author':
				$attributes['itemprop']  = 'author';
				$attributes['itemscope'] = 'itemscope';
				$attributes['itemtype']  = 'http://schema.org/Person';
				break;

			case 'entry_time':
				$attributes['itemprop'] = 'datePublished';
				break;

			case 'entry_time_modified':
				$attributes['itemprop'] = 'dateModified';
				break;

			case 'entry_title':
				$attributes['itemprop'] = 'headline';
				break;

			case 'entry_content':
				if ( 'post' === get_post_type() ) {
					$attributes['itemprop'] = 'articleBody';
				} else {
					$attributes['itemprop'] = 'text';
				}

				break;

			case 'entry_summary':
				$attributes['itemprop'] = 'description';
				break;

			case 'category':
				$attributes['itemprop'] = 'articleSection';
				break;

			case 'tag':
				$attributes['itemprop'] = 'keywords';
				break;

			case 'comment':
				$attributes['itemprop']  = 'comment';
				$attributes['itemscope'] = 'itemscope';
				$attributes['itemtype']  = 'http://schema.org/Comment';
				break;

			case 'comment_author':
				$attributes['itemprop']  = 'author';
				$attributes['itemscope'] = 'itemscope';
				$attributes['itemtype']  = 'http://schema.org/Person';
				break;

			case 'comment_time':
				$attributes['itemprop'] = 'datePublished';
				$attributes['datetime'] = get_comment_time( 'c' );
				break;

			case 'comment_link':
				$attributes['itemprop'] = 'url';
				break;

			case 'comment_content':
				$attributes['itemprop'] = 'text';
				break;

			case 'sidebar':
				$attributes['role']      = 'complementary';
				$attributes['itemscope'] = 'itemscope';
				$attributes['itemtype']  = 'http://schema.org/WPSideBar';
				break;

			case 'footer':
				$attributes['role']      = 'contentinfo';
				$attributes['itemscope'] = 'itemscope';
				$attributes['itemtype']  = 'http://schema.org/WPFooter';
				break;

		} // Switch context.

		// If we failed to fetch attributes - Let's stop.
		if ( empty( $attributes ) ) {
			return;
		}

		// Loop through the attributes.
		foreach ( $attributes as $key => $value ) {
			$markup .= $key . '="' . $value . '" ';
		}

		return $markup;

	}

endif;

if ( 1 == get_theme_mod( 'colormag_enable_schema_markup', '' ) ) {

	/**
	 * Schema markup for site icon and custom logo.
	 */
	function colormag_schema_publisher_html() {
		?>
		<div itemprop="publisher" itemscope itemtype="https://schema.org/Organization">
			<?php
			$site_icon_id = get_option( 'site_icon' );
			$site_logo_id = get_theme_mod( 'custom_logo' );

			if ( ! empty( $site_logo_id ) ) {
				$image = wp_get_attachment_image_src( $site_logo_id, 'full' );
				?>
				<div itemprop="logo" itemscope itemtype="https://schema.org/ImageObject">
					<meta itemprop="url" content="<?php echo esc_url( $image[0] ); ?>">
					<meta itemprop="width" content="<?php echo esc_attr( $image[1] ); ?>">
					<meta itemprop="height" content="<?php echo esc_attr( $image[2] ); ?>">
				</div>
				<?php
			} elseif ( ! empty( $site_icon_id ) ) {
				$image = wp_get_attachment_image_src( $site_icon_id, 'full' );
				?>
				<div itemprop="logo" itemscope itemtype="https://schema.org/ImageObject">
					<meta itemprop="url" content="<?php echo esc_url( $image[0] ); ?>">
					<meta itemprop="width" content="<?php echo esc_attr( $image[1] ); ?>">
					<meta itemprop="height" content="<?php echo esc_attr( $image[2] ); ?>">
				</div>
			<?php } ?>

			<meta itemprop="name" content="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
		</div>
		<?php
	}

	add_action( 'colormag_after_post_content', 'colormag_schema_publisher_html', 5 );


	/**
	 * Schema markup for modified post date.
	 */
	function colormag_schema_article_schema_fix() {
		?>
		<meta itemprop="dateModified" content="<?php echo esc_attr( get_the_modified_date( 'c' ) ); ?>">
		<meta itemscope itemprop="mainEntityOfPage" itemType="https://schema.org/WebPage" itemid="<?php echo esc_url( get_the_permalink() ); ?>">
		<?php
	}

	add_action( 'colormag_after_post_content', 'colormag_schema_article_schema_fix', 10 );


	/**
	 * Schema markup for featured image.
	 */
	function colormag_schema_post_thumbnail_image() {
		if ( has_post_thumbnail() ) {
			$image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
			?>
			<div class="meta_post_image" itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
				<meta itemprop="url" content="<?php echo esc_url( $image[0] ); ?>">
				<meta itemprop="width" content="<?php echo esc_attr( $image[1] ); ?>">
				<meta itemprop="height" content="<?php echo esc_attr( $image[2] ); ?>">
			</div>
			<?php
		}
	}

	add_action( 'colormag_after_post_content', 'colormag_schema_post_thumbnail_image', 15 );


	/**
	 * Schema markup for gravatar image.
	 *
	 * @param string $avatar Tag for the user's avatar.
	 *
	 * @return string
	 */
	function colormag_schema_get_avatar( $avatar ) {
		return preg_replace( '/(<img.*?)(\/>)/i', '$1itemprop="image" $2', $avatar );
	}

	add_filter( 'get_avatar', 'colormag_schema_get_avatar', 5 );


	/**
	 * Schema markup for comment author link.
	 *
	 * @param string $link The HTML-formatted comment author link.
	 *
	 * @return string|string[]|null
	 */
	function colormag_schema_get_comment_author_link( $link ) {
		$pattern = array(
			'/(class=[\'"])(.+?)([\'"])/i',
			'/(<a.*?)(>)/i',
			'/(<a.*?>)(.*?)(<\/a>)/i',
		);
		$replace = array(
			'$1$2 fn n$3',
			'$1 itemprop="url"$2',
			'$1<span itemprop="name">$2</span>$3',
		);

		return preg_replace( $pattern, $replace, $link );
	}

	add_filter( 'get_comment_author_link', 'colormag_schema_get_comment_author_link', 5 );


	/**
	 * Schema markup for comment popup link attributes.
	 *
	 * @param string $attr The comments link attributes..
	 *
	 * @return string
	 */
	function colormag_schema_get_comments_popup_link_attributes( $attr ) {
		return ' itemprop="discussionURL"';
	}

	add_filter( 'comments_popup_link_attributes', 'colormag_schema_get_comments_popup_link_attributes', 5 );

}
