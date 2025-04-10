<?php defined( 'ABSPATH' ) or die('Wrong Access!'); ?><?php get_header( 'noopen' ); ?>
<div class="container first-container">
	<?php EliteTrainerSiteThemeCustomizer::print_edit_button( 'pagebg' ); ?>
	<?php if( false ) : ?>
	<div class="row">
		<nav class="col-xxs-12 col-xs-12">
			<?php EliteTrainerSiteTheme::print_breadcrumbs(); ?>
		</nav>
	</div>
	<?php endif; ?>
	<?php if( have_posts() ) : the_post(); ?>
		<?php if( has_post_thumbnail() ) : ?>
		<div class="row">
			<div class="col-xs-12">
				<?php the_post_thumbnail( 'large', array ('class' => 'page-header-image' ) ); ?>
			</div>
		</div>	
		<?php endif; ?>
		<div class="row">
			<div class="col-xxs-12 col-xs-12">
				<div class="row">
					<div class="col-xs-12 page-content">
						<h1 class="text-center"><?php the_title(); ?></h1>
						<?php the_content(); ?>
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
