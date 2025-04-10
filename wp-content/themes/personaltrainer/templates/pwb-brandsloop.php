<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );

global $product;
$product_id = $product->get_id();
$product_brands =  wp_get_post_terms($product_id, 'pwb-brand');
?>
<?php if( !empty($product_brands) ) : ?>
	<div class="personaltrainer-brands-in-loop">
	<?php foreach ($product_brands as $brand) : ?>
		<?php $brand_link = get_term_link ( $brand->term_id, 'pwb-brand' ); ?>
		<?php $attachment_id = get_term_meta( $brand->term_id, 'pwb_brand_image', 1 ); ?>
		<?php $attachment_html = wp_get_attachment_image( $attachment_id, 'personaltrainer-small-brand' ); ?>
		<?php if( !empty($attachment_html) ) : ?>
			<a href="<?php echo $brand_link; ?>" rel="bookmark"><?php echo $attachment_html; ?></a>
		<?php endif; ?>
	<?php endforeach; ?>
	</div>
<?php endif; ?>
