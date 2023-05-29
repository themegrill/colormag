/**
 * @param {string} controlId
 * @param {string} selector
 * @param {string} cssProperty
 *
 */


(function ($) {
// Site Layout Option.
	wp.customize(
		'colormag_container_layout',
		function (value) {
			value.bind(
				function (layout) {
					var site_layout = layout;

					if ('wide' === site_layout) {
						$('body').removeClass('boxed').addClass('wide');
					} else if ('boxed' === site_layout) {
						$('body').removeClass('wide').addClass('boxed');
					}
				}
			);
		}
	);
})(jQuery);


colormagGenerateDimensionCSS('colormag_primary_menu_dimension_padding', '.cm-primary-nav a', 'padding');
colormagGenerateDimensionCSS('colormag_main_header_dimension_padding', '.cm-primary-nav', 'padding');

colormagGenerateBackgroundCSS( 'colormag_outside_container_background', 'body' )

