<?php
/**
 * Contains all the fucntions and components related to header part.
 *
 * @package ThemeGrill
 * @subpackage ColorMag
 * @since ColorMag 1.0
 */

/****************************************************************************************/

if ( ! function_exists( 'colormag_social_links' ) ) :
/**
 * This function is for social links display on header
 *
 * Get links through Theme Options
 */
function colormag_social_links() {

   $colormag_social_links = array( 'colormag_social_facebook' 	=> __( 'Facebook', 'colormag' ),
									'colormag_social_twitter' 		=> __( 'Twitter', 'colormag' ),
									'colormag_social_googleplus' 	=> __( 'Google-Plus' , 'colormag' ),
									'colormag_social_instagram' 	=> __( 'Instagram', 'colormag' ),
									'colormag_social_pinterest' 	=> __( 'Pinterest', 'colormag' ),
									'colormag_social_youtube' 		=> __( 'YouTube', 'colormag' )
							 	);
	?>
	<div class="social-links clearfix">
		<ul>
		<?php
			$i=0;
			$colormag_links_output = '';
			foreach( $colormag_social_links as $key => $value ) {
				$link = get_theme_mod( $key , '' );
				if ( !empty( $link ) ) {
					if ( get_theme_mod( $key.'_checkbox', 0 ) == 1 ) { $new_tab = 'target="_blank"'; } else { $new_tab = ''; }
					$colormag_links_output .=
						'<li><a href="'.esc_url( $link ).'" '.$new_tab.'><i class="fa fa-'.strtolower($value).'"></i></a></li>';
				}
				$i++;
			}
			echo $colormag_links_output;
		?>
		</ul>
	</div><!-- .social-links -->
	<?php
}
endif;

/****************************************************************************************/

if ( ! function_exists( 'colormag_render_header_image' ) ) :
/**
 * Shows the small info text on top header part
 */
function colormag_render_header_image() {
	$header_image = get_header_image();
	if( !empty( $header_image ) ) {
		if(get_theme_mod('colormag_header_image_link', 0) == 1) {
		?>
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
		<?php
		}
		?>
		<div class="header-image-wrap"><img src="<?php echo esc_url( $header_image ); ?>" class="header-image" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"></div>
	<?php
		if(get_theme_mod('colormag_header_image_link', 0) == 1) {
		?>
		</a>
		<?php
		}
	}
}
endif;
?>