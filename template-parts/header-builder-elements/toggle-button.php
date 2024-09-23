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
?>

<p class="cm-menu-toggle" aria-expanded="false">
						<?php colormag_get_icon( 'bars' ); ?>
						<?php colormag_get_icon( 'x-mark' ); ?>
	</p>
<?php
get_template_part( 'template-parts/header/primary-menu/main-navigation' );
?>
