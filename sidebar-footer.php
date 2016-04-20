<?php
/**
 * The Sidebar containing the footer widget areas.
 *
 * @package ThemeGrill
 * @subpackage ColorMag
 * @since ColorMag 1.0
 */
?>

<?php
/**
 * The footer widget area is triggered if any of the areas
 * have widgets. So let's check that first.
 *
 * If none of the sidebars have widgets, then let's bail early.
 */
if( !is_active_sidebar( 'colormag_footer_sidebar_one' ) &&
	!is_active_sidebar( 'colormag_footer_sidebar_two' ) &&
   !is_active_sidebar( 'colormag_footer_sidebar_three' ) &&
   !is_active_sidebar( 'colormag_footer_sidebar_four' ) ) {
	return;
}
?>
<div class="footer-widgets-wrapper">
	<div class="inner-wrap">
		<div class="footer-widgets-area clearfix">
         <div class="tg-footer-main-widget">
   			<div class="tg-first-footer-widget">
   				<?php
   				if ( !dynamic_sidebar( 'colormag_footer_sidebar_one' ) ):
   				endif;
   				?>
   			</div>
         </div>
         <div class="tg-footer-other-widgets">
   			<div class="tg-second-footer-widget">
   				<?php
   				if ( !dynamic_sidebar( 'colormag_footer_sidebar_two' ) ):
   				endif;
   				?>
   			</div>
            <div class="tg-third-footer-widget">
               <?php
               if ( !dynamic_sidebar( 'colormag_footer_sidebar_three' ) ):
               endif;
               ?>
            </div>
            <div class="tg-fourth-footer-widget">
               <?php
               if ( !dynamic_sidebar( 'colormag_footer_sidebar_four' ) ):
               endif;
               ?>
            </div>
         </div>
		</div>
	</div>
</div>