<?php defined( 'ABSPATH' ) or die('Wrong Access!'); 

$member = wp_get_current_user();

 ?><?php get_header( 'noopen' ); ?>
<div class="container">
	<?php if( have_posts() ) : the_post(); ?>
		<div class="row">
			<div class="col-xxs-12 col-xs-12">
				<div class="row">
					<div class="col-xs-12 page-content">
						<h1>Cuestionario personal <a class="btn btn-primary pull-right" href="<?php echo EliteTrainerSiteTheme::get_my_account_url(); ?>">Volver al perfil</a></h1>
						<p>¡Hola <?php echo esc_html( $member->first_name ); ?>! Necesitamos que rellenes el siguiente cuestionario antes de continuar. Así podremos estudiar tu caso y crear un plan totalmente personalizado. ¡Gracias!</p>
					<?php if( class_exists( 'EpointPersonalTrainer', false ) ) : ?>
						<?php echo EpointPersonalTrainerPublic::get_personal_questionnaire_form(); ?>
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
<?php if( class_exists( 'EpointPersonalTrainer', false ) &&
			EpointPersonalTrainer::is_site_client() &&
			( $info = EpointPersonalTrainer::get_user_personal_info( get_current_user_id() ) ) &&
			!$info->has_filled_personal_questionnaire() ) : ?>
	<?php get_template_part( 'templates/first-modals/personal', 'questionnaire' ); ?>
<?php endif; ?>
<?php get_footer( 'noclose' ); ?>
