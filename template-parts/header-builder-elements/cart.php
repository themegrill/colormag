<?php
/**
 * Cart
 *
 * @package Zakra
 */

if ( function_exists( 'zakra_is_woocommerce_active' ) && ! zakra_is_woocommerce_active() ) {
	return;
}

?>
<div class="cm-mini-cart">
	<?php echo Zakra_WooCommerce::woocommerce_header_cart(); ?>
</div>

<?php
