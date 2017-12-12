<?php
/**
 * Custom functions to be used within Elementor plugin
 *
 * @package    ThemeGrill
 * @subpackage ColorMag
 * @since      ColorMag 1.2.3
 */

/**
 * Return the values of all the categories of the posts
 * present in the site
 *
 * @return array of category ids and its respective names
 *
 * @since ColorMag 1.2.3
 */
function colormag_elementor_categories() {
	$categories = get_categories();

	foreach ( $categories as $category ) {
		$output[ $category->term_id ] = $category->name;
	}

	return $output;
}

/**
 * Colormag_Elementor required setups
 * Particularly used for registering post thumbnail size and others
 *
 * Hooked in after_setup_theme
 *
 * @since ColorMag 2.2.3
 */
function colormag_elementor_setup() {

	// Cropping the images to different sizes to be used in the theme for Elementor
	// For the block widgets
	add_image_size( 'colormag-elementor-block-extra-large-thumbnail', 1155, 480, true );
	
	// Cropping the images to different sizes to be used in the theme for Elementor
	// For the grid widgets
	add_image_size( 'colormag-elementor-grid-large-thumbnail', 600, 417, true );
	add_image_size( 'colormag-elementor-grid-small-thumbnail', 285, 450, true );
	add_image_size( 'colormag-elementor-grid-medium-large-thumbnail', 575, 198, true );
}

add_action( 'after_setup_theme', 'colormag_elementor_setup' );

if ( ! function_exists( 'colormag_elementor_widgets_meta' ) ) :

	/**
	 * Display the posts meta for use within Elementor widgets
	 *
	 * @since ColorMag 1.2.3
	 */
	function colormag_elementor_widgets_meta() {
		?>

		<div class="tg-module-meta">
			<?php
			$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
			if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
				$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
			}
			$time_string = sprintf( $time_string,
				esc_attr( get_the_date( 'c' ) ),
				esc_html( get_the_date() ),
				esc_attr( get_the_modified_date( 'c' ) ),
				esc_html( get_the_modified_date() )
			);
			?>

			<span class="tg-post-date entry-date">
				<?php echo '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'; ?>
			</span>

			<span class="tg-post-auther-name author vcard">
				<?php echo '<a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a>'; ?>
			</span>

			<span class="tg-module-comments">
				<?php comments_popup_link( '0', '1', '%' ); ?>
			</span>
		</div>

		<?php
	}

endif;

if ( ! function_exists( 'colormag_elementor_styles' ) ) {

	/**
	 * Loads styles on elementor editor
	 *
	 * @since ColorMag 1.2.3
	 */
	function colormag_elementor_styles() {
		wp_enqueue_style( 'colormag-econs', get_template_directory_uri() . '/inc/elementor/assets/css/colormag-econs.css', false, '1.0' );
	}

}

add_action( 'elementor/editor/after_enqueue_styles', 'colormag_elementor_styles' );


if ( ! function_exists( 'colormag_elementor_colored_category' ) ) :

	/**
	 * Display/Returns the category names for Elementor widgets
	 *
	 * @since ColorMag 1.2.3
	 */
	function colormag_elementor_colored_category( $display = 1 ) {
		global $post;
		$categories = get_the_category();
		$separator  = '&nbsp;';
		$output     = '';

		if ( $categories ) {
			$output .= '<div class="tg-post-categories">';
			foreach ( $categories as $category ) {
				$color_code = colormag_category_color( get_cat_id( $category->cat_name ) );
				if ( ! empty( $color_code ) ) {
					$output .= '<a href="' . get_category_link( $category->term_id ) . '" style="background:' . colormag_category_color( get_cat_id( $category->cat_name ) ) . '" class="tg-post-category" rel="category tag">' . $category->cat_name . '</a>' . $separator;
				} else {
					$output .= '<a href="' . get_category_link( $category->term_id ) . '" class="tg-post-category" rel="category tag">' . $category->cat_name . '</a>' . $separator;
				}
			}
			$output .= '</div>';

			if ( $display == 0 ) {
				$output = trim( $output, $separator );
			}
			if ( $display == 1 ) {
				echo trim( $output, $separator );
			}
		}

		if ( $display == 0 ) {
			return $output;
		}
	}

endif;
