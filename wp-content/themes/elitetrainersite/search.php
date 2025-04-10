<?php defined( 'ABSPATH' ) or die('Wrong Access!'); ?><?php get_header(); ?>
<div class="row">
	<div class="col-xs-12 col-sm-8 col-md-9 products-in-list">
		<h1><?php printf( __( 'Search results for &quot;%s&quot;', EliteTrainerSiteTheme::TEXT_DOMAIN ), get_search_query() ); ?></h1>
	<?php if ( false && woocommerce_product_loop() ) : ?>
		<?php

			woocommerce_product_loop_start();

				while ( have_posts() ) {
					the_post();

					/**
					 * Hook: woocommerce_shop_loop.
					 *
					 * @hooked WC_Structured_Data::generate_product_data() - 10
					 */
					do_action( 'woocommerce_shop_loop' );

					wc_get_template_part( 'content', 'product' );
				}

			woocommerce_product_loop_end();

		?>
	<?php elseif( have_posts() ) : ?>
		<?php get_template_part( 'templates/posts', 'list' ); ?>
	<?php else :?>
	<?php
		do_action( 'woocommerce_no_products_found' );
	?>
	<?php endif; ?>
	</div>
	<div class="hidden-xs col-sm-4 col-md-3">
		<?php get_sidebar( 'blog' ); ?>
	</div>
</div>
<?php get_footer(); ?>
