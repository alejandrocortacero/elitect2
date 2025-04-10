<?php defined( 'ABSPATH' ) or die('Wrong Access!'); 

$member = wp_get_current_user();

 ?><?php get_header( 'noopen' ); ?>
<div class="container">
	<?php if( have_posts() ) : the_post(); ?>
		<div class="row">
			<div class="col-xxs-12 col-xs-12">
				<div class="row">
					<div class="col-xs-12 page-content">
						<h1>Información de entrenador</h1>
						<p>¡Hola <?php echo esc_html( $member->first_name ); ?>! Necesitamos que rellenes el siguiente cuestionario antes de continuar y así poder configurar tu sitio.</p>
						<p class="text-center visible-xs"><a class="btn btn-primary" href="#trainer-col">Soy un entrenador</a></p>
						<p class="text-center visible-xs"><a class="btn btn-primary" href="#center-col">Represento a un centro de entrenamiento</a></p>
					<?php if( class_exists( 'EpointPersonalTrainer', false ) ) : ?>
						<?php
						EpointPersonalTrainer::load_trainer_info_management();
						$trainer_info = new EpointPersonalTrainerTrainerInfo( get_current_user_id() );
						$trainer_info_attr = $trainer_info->get_attributes();
						?>
						<div class="row">
						<?php if( empty( $trainer_info_attr['company_name'] ) && empty( $trainer_info_attr['sex'] ) ) : ?>
							<div class="col-xs-12 col-sm-6" id="trainer-col">
								<h2>Formulario para entrenadores</h2>
								<?php echo EpointPersonalTrainerPublic::get_trainer_info_form(); ?>
							</div>
							<div class="col-xs-12 col-sm-6" id="center-col">
								<h2>Formulario para centros de entrenamiento</h2>
								<?php echo EpointPersonalTrainerPublic::get_training_center_info_form(); ?>
							</div>
						<?php elseif( empty( $trainer_info_attr['company_name'] ) ) : ?>
							<div class="col-xs-12 col-sm-6 col-sm-offset-3" id="trainer-col">
								<?php echo EpointPersonalTrainerPublic::get_trainer_info_form(); ?>
							</div>
						<?php else : ?>
							<div class="col-xs-12 col-sm-6 col-sm-offset-3" id="center-col">
								<?php echo EpointPersonalTrainerPublic::get_training_center_info_form(); ?>
							</div>
						<?php endif; ?>
						</div>
					<?php endif; ?>
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
