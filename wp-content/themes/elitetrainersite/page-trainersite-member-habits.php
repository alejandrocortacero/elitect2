<?php defined( 'ABSPATH' ) or die('Wrong Access!');

if( !EpointPersonalTrainer::is_site_client() && !EpointPersonalTrainer::is_site_trainer() )
{
	wp_redirect( get_site_url() );
	exit;
}

$member = wp_get_current_user();

//$habits = get_user_meta( $member->ID, 'personal_trainer_user_habits', true );
//$habits_observations = get_user_meta( $member->ID, 'personal_trainer_user_habits_observations', true );


add_filter( 'body_class', function( $classes, $class ){ $classes[] = 'page-user-habits'; return $classes; }, 10, 2 );

 ?><?php get_header( 'noopen' ); ?>
<div class="container">
	<?php if( have_posts() ) : the_post(); ?>
		<div class="row">
			<div class="col-xxs-12 col-xs-12">
				<div class="row">
					<div class="col-xs-12 page-content">
					<?php if( class_exists( 'EpointPersonalTrainer', false ) ) : ?>
						<h1>Tus hábitos de comidas actuales <a class="btn btn-primary pull-right" href="<?php echo EliteTrainerSiteTheme::get_my_account_url(); ?>">Volver al perfil</a></h1>
						<p>Esta hoja de horarios esta destinada a conocer los habitos actuales de tus comidas (sean los que sean). Indica a que hora sueles hacer las diferentes comidas y en que consisten.</p>
						<div class="user-habits-layer">
							<?php echo EpointPersonalTrainerPublic::get_user_habits_form( $member->ID ); ?>
						</div>
					<?php endif; //class_exists ?>
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
			empty( get_user_meta( get_current_user_id(), 'personal_trainer_user_habits', true ) )
			 ) : ?>
	<?php get_template_part( 'templates/first-modals/member', 'habits' ); ?>
<?php endif; ?>
<?php get_footer( 'noclose' ); ?>
