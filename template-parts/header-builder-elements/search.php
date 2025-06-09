<?php
	// Exit if accessed directly.
	defined( 'ABSPATH' ) || exit;

	$header_builder_search_type = get_theme_mod( 'colormag_header_search_type', 'normal-search' );

?>

	<?php if ( 'search-box' === $header_builder_search_type ) : ?>
		<div class="cm-search-box">
			<?php get_search_form(); ?>
		</div>
	<?php elseif ( 'search-icon-input' === $header_builder_search_type ) : ?>
		<div class="cm-search-box cm-search-icon-in-input-right">
			<?php
			// Use filter to modify the search form for this specific instance
			add_filter(
				'get_search_form',
				function ( $form ) {
					ob_start();
					?>
				<form action="<?php echo esc_url( home_url( '/' ) ); ?>" class="search-form searchform clearfix" method="get">
					<div class="search-wrap">
						<input type="search"
							class="s field"
							name="s"
							value="<?php echo get_search_query(); ?>"
							placeholder="<?php esc_attr_e( 'Search...', 'colormag' ); ?>"
						/>
						<span class="search-icon-input-right"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M18 11a7 7 0 1 0-14 0 7 7 0 0 0 14 0Zm2 0a8.96 8.96 0 0 1-1.97 5.616l3.677 3.677.068.076a1 1 0 0 1-1.406 1.406l-.076-.068-3.677-3.677A9 9 0 1 1 20 11Z"/></svg></span>
					</div>
				</form>
					<?php
					$custom_form = ob_get_clean();
					return $custom_form;
				},
				10,
				1
			);
			get_search_form();
			// Remove the filter after use
			remove_filter( 'get_search_form', function () {}, 10 );
		?>
		</div>
	<?php else : ?>
		<div class="cm-top-search">
			<i class="fa fa-search search-top"></i>
			<div class="search-form-top">
				<?php get_search_form(); ?>
			</div>
		</div>
	<?php endif; ?>
