<?php
/**
 * ColorMag customizer class for theme customize partials.
 *
 * Class ColorMag_Customizer_Partials
 *
 * @package    ThemeGrill
 * @subpackage ColorMag
 * @since      ColorMag 3.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * ColorMag customizer class for theme customize partials.
 *
 * Class ColorMag_Customizer_Partials
 */
class ColorMag_Customizer_Partials {

	/**
	 * Render the date in the header for selective refresh partial.
	 *
	 * @return void
	 */
	public static function render_current_date() {

		// Return if date display is disabled.
		if ( false == get_theme_mod( 'colormag_date_display', false ) ) {
			return;
		}
		?>

		<div class="date-in-header">
			<?php
			if ( 'theme_default' == get_theme_mod( 'colormag_date_display_type', 'theme_default' ) ) {
				echo esc_html( date_i18n( 'l, F j, Y' ) );
			} elseif ( 'wordpress_date_setting' == get_theme_mod( 'colormag_date_display_type', 'theme_default' ) ) {
				echo esc_html( date_i18n( get_option( 'date_format' ) ) );
			}
			?>
		</div>

		<?php
	}

	/**
	 * Render the breaking news display type for selective refresh partial.
	 *
	 * @return void
	 */
	public static function render_date_display_type() {

		// Return if date display option is not enabled.
		if ( false == get_theme_mod( 'colormag_date_display', false ) ) {
			return;
		}

		if ( 'theme_default' == get_theme_mod( 'colormag_date_display_type', 'theme_default' ) ) {
			echo esc_html( date_i18n( 'l, F j, Y' ) );
		} elseif ( 'wordpress_date_setting' == get_theme_mod( 'colormag_date_display_type', 'theme_default' ) ) {
			echo esc_html( date_i18n( get_option( 'date_format' ) ) );
		}
	}

	/**
	 * Render the random post for selective refresh partial.
	 *
	 * @return void
	 */
	public static function render_random_post() {

		// Bail out if random post in menu is not activated.
		if ( 0 == get_theme_mod( 'colormag_enable_random_post', 0 ) ) {
			return;
		}

		$get_random_post = new WP_Query(
			array(
				'posts_per_page'         => 1,
				'post_type'              => 'post',
				'ignore_sticky_posts'    => true,
				'orderby'                => 'rand',
				'no_found_rows'          => true,
				'update_post_meta_cache' => false,
				'update_post_term_cache' => false,
			)
		);
		?>

		<div class="cm-random-post">
			<?php
			while ( $get_random_post->have_posts() ) :
				$get_random_post->the_post();
				?>
				<a href="<?php the_permalink(); ?>" title="<?php esc_attr_e( 'View a random post', 'colormag' ); ?>"><i
							class="fa fa-random"></i></a>
			<?php endwhile; ?>
		</div>

		<?php
		// Reset Post Data.
		wp_reset_postdata();
	}

	/**
	 * Render the footer copyright information for selective refresh partial.
	 *
	 * @return void
	 */
	public static function render_footer_copyright_text() {
		$default_footer_value      = get_theme_mod(
			'colormag_footer_copyright',
			esc_html__( 'Copyright &copy; ', 'colormag' ) . '[the-year] [site-link]. ' . esc_html__( 'All rights reserved.', 'colormag' ) . '<br>' . esc_html__( 'Theme: ', 'colormag' ) . '[tg-link]' . esc_html__( ' by ThemeGrill. Powered by ', 'colormag' ) . '[wp-link].'
		);
		$colormag_footer_copyright = $default_footer_value;

		echo do_shortcode( $colormag_footer_copyright );
	}

	/**
	 * Render the site title for the selective refresh partial.
	 *
	 * @return void
	 */
	public static function render_customize_partial_blogname() {
		bloginfo( 'name' );
	}

	/**
	 * Render the site tagline for the selective refresh partial.
	 *
	 * @return void
	 */
	public static function render_customize_partial_blogdescription() {
		bloginfo( 'description' );
	}
}
