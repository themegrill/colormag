<?php
/**
 * Social share button template part.
 *
 * @package    ThemeGrill
 * @subpackage ColorMag
 * @since      ColorMag 1.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<div class="share-buttons">
	<span class="share"><?php esc_html_e( 'Share This Post:', 'colormag' ); ?></span>

	<?php if ( 1 === get_theme_mod( 'colormag_enable_social_share_twitter', 1 ) ) { ?>
		<div class="box">
			<div id="twitter" class="twitter-share share" data-share="twitter-share">
				<i class="fa fa-twitter"></i>
			</div>
		</div>
	<?php } ?>

	<?php if ( 1 === get_theme_mod( 'colormag_enable_social_share_facebook', 1 ) ) { ?>
		<div class="box">
			<div id="facebook" class="facebook-share share" data-share="facebook-share">
				<i class="fa fa-facebook-square"></i>
			</div>
		</div>
	<?php } ?>

	<?php if ( 1 === get_theme_mod( 'colormag_enable_social_share_pinterest', 1 ) ) { ?>
		<div class="box">
			<div id="pinterest" class="pinterest-share share" data-share="pinterest-share">
				<i class="fa fa-pinterest"></i>
			</div>
		</div>
	<?php } ?>
</div>
