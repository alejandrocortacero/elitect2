<?php defined( 'ABSPATH' ) or die('Wrong Access!'); ?>
<?php get_header(); ?>
<?php if( have_posts() ) : the_post(); ?>
		<div class="row">
			<div class="col-xs-12 woocommerce">
				<?php wc_get_template_part( 'content', 'single-product' ); ?>
			</div>
		</div>
<?php else : ?>
	<h1><?php echo esc_html( __( 'Not found.', TrainerSiteTheme::TEXT_DOMAIN ) ); ?></h1>
<?php endif; ?>
<?php get_footer(); ?>
