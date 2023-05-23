<?php
/**
* Template part for entry header.
*
* @link    https://developer.wordpress.org/themes/basics/template-hierarchy/
*
* @package ColorMag
* @since   @TODO
*/

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>
	<header class="cm-entry-header">
		<?php if ( is_singular() ) : ?>
		<h1 class="cm-entry-title">
			<?php the_title(); ?>
		</h1>
		<?php else : ?>
		<h2 class="cm-entry-title">
			<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
				<?php echo wp_kses_post( get_the_title() ); ?>
			</a>
		</h2>
		<?php endif; ?>
	</header>
