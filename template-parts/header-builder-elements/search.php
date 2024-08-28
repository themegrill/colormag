<?php
// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

?>

<div class="zak-header-action <?php zakra_css_class( 'zakra_header_search_class' ); ?>">
	<a href="#" class="zak-header-search__toggle">
		<?php zakra_get_icon( 'magnifying-glass' ); ?>
	</a>
	<?php get_search_form( true ); ?>
</div>
