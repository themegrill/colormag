<?php
/**
 * Mobile toggle icon template file.
 *
 * @package colormag
 *
 * @since 3.0.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
$builder                = get_theme_mod( 'colormag_header_builder', colormag_header_default_builder() )
?>

<div class="cm-mobile-nav-container">
	<button type="button" class="cm-menu-toggle" aria-expanded="false">
		<?php colormag_get_icon( 'bars' ); ?>
		<?php colormag_get_icon( 'x-mark' ); ?>
	</button>

	<nav id="cm-mobile-nav" class="cm-mobile-nav cm-mobile-open-container">
		<?php
		echo '<div id="cm-mobile-header-row" class="cm-mobile-header-row">';
		foreach ( $builder['offset'] as $cols ) {

			if ( isset( $cols ) ) {
				get_template_part( "template-parts/header-builder-elements/$cols", '' );
			}
		}
		echo '</div>';

		?>
	</nav><!-- #cm-mobile-nav -->
</div>
