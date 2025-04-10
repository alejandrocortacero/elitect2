<?php defined( 'ABSPATH' ) or die( "Wrong access" ); ?>
<?php $cart_count = PersonalTrainerThemeWooCommerce::get_cart_products_count(); ?>
<div class="cart-fixed <?php if( !$cart_count ) : ?>not-show<?php endif; ?>">
	<a class="cart-button" href="<?php echo PersonalTrainerThemeWooCommerce::get_cart_link(); ?>" rel="bookmark" title="<?php echo esc_attr( __( 'Cart', PersonalTrainerTheme::TEXT_DOMAIN ) ); ?>">
		<span class="glyphicon glyphicon-shopping-cart"></span>
		<span class="cart-count"><?php echo esc_html( $cart_count ); ?></span>
	</a>
</div>
