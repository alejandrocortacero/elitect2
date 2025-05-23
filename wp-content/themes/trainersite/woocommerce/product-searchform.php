<?php
/**
 * The template for displaying product search form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/product-searchform.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<form role="search" method="get" class="woocommerce-product-search form-inline" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<div class="form-group">
		<div class="ui-widget">
			<input type="hidden" name="post_type" value="product" />
			<input type="search" id="<?php echo $unique_id; ?>" class="search-field form-control" placeholder="<?php echo esc_attr( __( 'Search &hellip;', TrainerSiteTheme::TEXT_DOMAIN ) ); ?>" aria-label="<?php echo esc_attr( __( 'Search text', TrainerSiteTheme::TEXT_DOMAIN ) ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
		</div>
	</div>
	<button type="submit" class="search-submit btn btn-default"><span class="glyphicon glyphicon-search"></span><span class="sr-only"><?php echo esc_attr( __( 'Search', TrainerSiteTheme::TEXT_DOMAIN ) ); ?></span></button>
</form>
