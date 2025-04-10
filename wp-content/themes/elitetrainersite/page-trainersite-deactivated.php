<?php defined( 'ABSPATH' ) or die('Wrong Access!'); 
 ?><?php get_header( 'noopen' ); ?>
<div class="container">
	<?php if( have_posts() ) : the_post(); ?>
		<div class="row">
			<div class="col-xxs-12 col-xs-12">
				<div class="row">
					<div class="col-xs-12 page-content">
						<h1 class="text-center">Tu cuenta está desactivada actualmente.</h1>
					</div>
				</div>
			</div>
		</div>
	<?php else : ?>
		<h1><?php echo esc_html( __( 'Not found.', EliteTrainerSiteTheme::TEXT_DOMAIN ) ); ?></h1>
	<?php endif; ?>
</div>

<?php //get_template_part( 'templates/contact', 'container' ); ?>

<?php get_footer( 'noclose' ); ?>
