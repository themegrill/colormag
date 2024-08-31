<?php
// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

?>

<div class="zak-header-action">
	<a href="#" class="zak-header-search__toggle">
<!--		--><?php //zakra_get_icon( 'magnifying-glass' ); ?>
	</a>
	<?php get_search_form( true ); ?>
</div>
