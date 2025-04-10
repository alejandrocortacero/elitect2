<?php defined( 'ABSPATH' ) or die('Wrong Access!');

if( !is_super_admin() && !EliteTrainerSiteTheme::is_site_trainer() )
{
	wp_redirect( get_site_url() );
	exit;
}


add_filter( 'body_class', function( $classes, $class ){ $classes[] = 'page-trainer-creation-zone'; $classes[] = 'page-trainer-edit-member'; return $classes; }, 10, 2 );

 ?><?php get_header( 'noopen' ); ?>
<div class="container">
	<?php if( have_posts() ) : the_post(); ?>
		<div class="row">
			<div class="col-xxs-12 col-xs-12">
				<div class="row">
					<div class="col-xs-12 page-content">
<div class="row">
	<div class="col-xs-12">
		<div class="shadow-box">
			<h3>Alimentación</h3>
			<p><a href="<?php echo EliteTrainerSiteTheme::get_diets_list_url(); ?>" class="btn btn-primary" rel="nofollow">Galería, añadir o modificar dietas <span class="glyphicon glyphicon-chevron-right"></span></span></a></p>
			<p><a href="<?php echo EliteTrainerSiteTheme::get_food_list_url(); ?>" class="btn btn-primary" rel="nofollow">Añadir o modificar alimentos y categorías <span class="glyphicon glyphicon-chevron-right"></span></span></a></p>
			<p><a href="<?php echo EliteTrainerSiteTheme::get_diet_objectives_list_url(); ?>" class="btn btn-primary" rel="nofollow">Añadir o modificar restricciones y objetivos <span class="glyphicon glyphicon-chevron-right"></span></span></a></p>
		</div>
		<div class="shadow-box">
			<h3>Entrenamientos</h3>
			<p><a href="<?php echo EliteTrainerSiteTheme::get_training_list_url(); ?>" class="btn btn-primary" rel="nofollow">Galería, añadir o modificar entrenamientos <span class="glyphicon glyphicon-chevron-right"></span></span></a></p>
			<p><a href="<?php echo EliteTrainerSiteTheme::get_exercises_list_url(); ?>" class="btn btn-primary" rel="nofollow">Añadir o modificar ejercicios y categorías<span class="glyphicon glyphicon-chevron-right"></span></span></a></p>
			<p><a href="<?php echo EliteTrainerSiteTheme::get_objectives_list_url(); ?>" class="btn btn-primary" rel="nofollow">Añadir o modificar entornos y objetivos <span class="glyphicon glyphicon-chevron-right"></span></span></a></p>
		</div>
		<div class="shadow-box">
			<h3>Evolución</h3>
			<p><a href="<?php echo EliteTrainerSiteTheme::get_trainer_body_measures_url(); ?>" class="btn btn-primary" rel="nofollow">Añadir o modificar zonas de medidas corporales <span class="glyphicon glyphicon-chevron-right"></span></span></a></p>
			<p><a href="<?php echo EliteTrainerSiteTheme::get_trainer_strength_exercises_url(); ?>" class="btn btn-primary" rel="nofollow">Añadir o modificar ejercicios de fuerza <span class="glyphicon glyphicon-chevron-right"></span></span></a></p>
			<p><a href="<?php echo EliteTrainerSiteTheme::get_trainer_speed_exercises_url(); ?>" class="btn btn-primary" rel="nofollow">Añadir o modificar ejercicios de velocidad <span class="glyphicon glyphicon-chevron-right"></span></span></a></p>
			<p><a href="<?php echo EliteTrainerSiteTheme::get_trainer_distance_exercises_url(); ?>" class="btn btn-primary" rel="nofollow">Añadir o modificar ejercicios de distancia <span class="glyphicon glyphicon-chevron-right"></span></span></a></p>
		</div>
	</div>
</div>
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
