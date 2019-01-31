<?php
/**
 * Theme Header Section for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main" class="clearfix"> <div class="inner-wrap">
 *
 * @package    ThemeGrill
 * @subpackage ColorMag
 * @since      ColorMag 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>"/>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11"/>
	<?php
	/**
	 * This hook is important for wordpress plugins and other many things
	 */
	wp_head();
	?>
</head>

<body <?php body_class(); ?>>

<?php do_action( 'colormag_before' ); ?>

<div id="page" class="hfeed site">
	<?php do_action( 'colormag_before_header' ); ?>

	<?php
	// Add the main total header area display type dynamic class
	$main_total_header_option_layout_class = get_theme_mod( 'colormag_main_total_header_area_display_type', 'type_one' );

	$class_name = '';
	if ( $main_total_header_option_layout_class == 'type_two' ) {
		$class_name = 'colormag-header-clean';
	} else if ( $main_total_header_option_layout_class == 'type_three' ) {
		$class_name = 'colormag-header-classic';
	}
	?>

	<header id="masthead" class="site-header clearfix <?php echo esc_attr( $class_name ); ?>">
		<div id="header-text-nav-container" class="clearfix">

			<?php colormag_top_header_bar_display(); // Display the top header bar ?>

			<?php
			if ( get_theme_mod( 'colormag_header_image_position', 'position_two' ) == 'position_one' ) {
				colormag_render_header_image();
			}
			?>

			<?php colormag_middle_header_bar_display(); // Display the middle header bar ?>

			<?php
			if ( get_theme_mod( 'colormag_header_image_position', 'position_two' ) == 'position_two' ) {
				colormag_render_header_image();
			}
			?>

			<?php colormag_below_header_bar_display(); // Display the below header bar  ?>

		</div><!-- #header-text-nav-container -->

		<?php
		if ( get_theme_mod( 'colormag_header_image_position', 'position_two' ) == 'position_three' ) {
			colormag_render_header_image();
		}
		?>

	</header>

	<?php do_action( 'colormag_after_header' ); ?>
	<?php do_action( 'colormag_before_main' ); ?>

	<div id="main" class="clearfix">
		<div class="inner-wrap clearfix">
