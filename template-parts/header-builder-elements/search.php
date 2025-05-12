<?php
// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$header_builder_search_type = get_theme_mod( 'colormag_header_search_type', 'normal-search' );

?>

<?php if ( 'search-box' === $header_builder_search_type ) : ?>
	<div class="cm-search-box">
		<form action="<?php echo esc_url( home_url( '/' ) ); ?>" class="search-form searchform clearfix" method="get" role="search">

			<div class="search-wrap">
				<input type="search"
					   class="s field"
					   name="s"
					   value="<?php echo get_search_query(); ?>"
					   placeholder="<?php esc_attr_e( 'Search', 'colormag' ); ?>"
				/>

				<button class="search-icon" type="submit"></button>
			</div>

		</form><!-- .searchform -->
	</div>
<?php elseif ( 'search-icon-input' === $header_builder_search_type ) : ?>
	<div class="cm-search-box cm-search-icon-in-input-right">
		<form action="<?php echo esc_url( home_url( '/' ) ); ?>" class="search-form searchform clearfix" method="get" role="search">

			<div class="search-wrap">
				<input type="search"
					   class="s field"
					   name="s"
					   value="<?php echo get_search_query(); ?>"
					   placeholder="<?php esc_attr_e( 'Search...', 'colormag' ); ?>"
				/>
				<span class="search-icon-input-right"><i class="fa fa-search"></i></span>
			</div>

		</form><!-- .searchform -->
	</div>
<?php else : ?>
	<div class="cm-top-search">
		<i class="fa fa-search search-top"></i>
		<div class="search-form-top">
			<?php get_search_form(); ?>
		</div>
	</div>
<?php endif; ?>
