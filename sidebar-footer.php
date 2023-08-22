<?php
/**
 * The Sidebar containing the footer widget areas.
 *
 * @package ColorMag
 *
 * @since   ColorMag 1.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * The footer widget area is triggered if any of the areas have widgets. So let's check that first.
 *
 * If none of the sidebars have widgets, then let's bail early.
 */
if ( ! is_active_sidebar( 'colormag_footer_sidebar_one' ) &&
     ! is_active_sidebar( 'colormag_footer_sidebar_two' ) &&
     ! is_active_sidebar( 'colormag_footer_sidebar_three' ) &&
     ! is_active_sidebar( 'colormag_footer_sidebar_four' ) &&
     ! is_active_sidebar( 'colormag_footer_sidebar_one_upper' ) &&
     ! is_active_sidebar( 'colormag_footer_sidebar_two_upper' ) &&
     ! is_active_sidebar( 'colormag_footer_sidebar_three_upper' ) &&
     ! is_active_sidebar( 'colormag_footer_sidebar_full_width' ) ) {
	return;
}
?>

<div class="cm-footer-cols">
	<div class="cm-container">
		<div class="cm-row">
			<?php if ( is_active_sidebar( 'colormag_footer_sidebar_one_upper' ) || is_active_sidebar( 'colormag_footer_sidebar_two_upper' ) || is_active_sidebar( 'colormag_footer_sidebar_three_upper' ) ) : ?>
				<div class="cm-upper-footer-cols">
					<div class="cm-upper-footer-col cm-upper-footer-col--1">
						<?php dynamic_sidebar( 'colormag_footer_sidebar_one_upper' ); ?>
					</div>
					<div class="cm-upper-footer-col cm-upper-footer-col--2">
						<?php dynamic_sidebar( 'colormag_footer_sidebar_two_upper' ); ?>
					</div>
					<div class="cm-upper-footer-col cm-upper-footer-col--3">
						<?php dynamic_sidebar( 'colormag_footer_sidebar_three_upper' ); ?>
					</div>
				</div>
			<?php endif; ?>

			<?php if ( is_active_sidebar( 'colormag_footer_sidebar_one' ) || is_active_sidebar( 'colormag_footer_sidebar_two' ) || is_active_sidebar( 'colormag_footer_sidebar_three' ) || is_active_sidebar( 'colormag_footer_sidebar_four' ) ) : ?>
			<div class="cm-lower-footer-cols">
				<div class="cm-lower-footer-col cm-lower-footer-col--1">
					<?php dynamic_sidebar( 'colormag_footer_sidebar_one' ); ?>
				</div>

				<div class="cm-lower-footer-col cm-lower-footer-col--2">
					<?php dynamic_sidebar( 'colormag_footer_sidebar_two' ); ?>
				</div>
				<div class="cm-lower-footer-col cm-lower-footer-col--3">
					<?php dynamic_sidebar( 'colormag_footer_sidebar_three' ); ?>
				</div>
				<div class="cm-lower-footer-col cm-lower-footer-col--4">
					<?php dynamic_sidebar( 'colormag_footer_sidebar_four' ); ?>
				</div>
			</div>
			<?php endif; ?>

		</div>
	</div>
</div>
