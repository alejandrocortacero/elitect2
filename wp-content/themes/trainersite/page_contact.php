<?php /* Template Name: Contact page */ defined( 'ABSPATH' ) or die( 'Wrong Access' ); ?><?php get_header( 'noopen' ); ?>
<?php if( have_posts() ) : the_post(); ?>
	<?php if( class_exists( 'JLCContact' ) ) : ?>
		<div class="container-fluid contact-container square-mesh">
			<div class="container">
				<div class="row">
					<nav class="col-xxs-12 col-xs-12">
						<?php TrainerSiteTheme::print_breadcrumbs(); ?>
					</nav>
				</div>
				<div class="row">
					<?php if( false ) :?>
						<div class="col-xs-12 col-sm-6 contact-places-col">
							<?php get_template_part( 'templates/contact', 'places' ); ?>
						</div>
					<?php endif; ?>
					<div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-6 col-md-offset-3 contact-col">
						<div class="contact">
							<h1 class="text-center"><?php the_title(); ?></h1>
							<?php echo JLCContact::get_contact_form(); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php $content = get_the_content(); ?>
		<?php if( !empty( $content ) ) : ?>
		<div class="container">
			<div class="row">
				<div class="col-xs-12 page-content">
					<?php echo $content; ?>
				</div>
			</div>
		</div>
		<?php endif; ?>
	<?php else: ?>
		<div class="container">
			<div class="row">
				<nav class="col-xxs-12 col-xs-12">
					<?php TrainerSiteTheme::print_breadcrumbs(); ?>
				</nav>
			</div>
		</div>
		<?php $content = get_the_content(); ?>
		<?php if( !empty( $content ) ) : ?>
		<div class="container">
			<div class="row">
				<div class="col-xs-12 page-content">
					<?php echo $content; ?>
				</div>
			</div>
		</div>
		<?php endif; ?>
	<?php endif; ?>
<?php else : ?>
	<h1><?php echo esc_html( __( 'Not found.', TrainerSiteTheme::TEXT_DOMAIN ) ); ?></h1>
<?php endif; ?>
<?php get_footer( 'noclose' ); ?>
