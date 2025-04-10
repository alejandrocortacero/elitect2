<?php defined( 'ABSPATH' ) or die('Wrong Access!');

if( !EpointPersonalTrainer::is_site_client()/* || !EpointPersonalTrainer::is_site_trainer()*/ )
{
	wp_redirect( get_site_url() );
	exit;
}


$member = wp_get_current_user();
$member_id = $member->ID;

$admin_users = get_users( array( 'role' => EpointPersonalTrainer::TRAINER_ROLE ) );
$trainer_id = null;
if( is_array( $admin_users ) && !empty( $admin_users ) )
{
	$trainer_obj = current( $admin_users );
	$trainer_id = $trainer_obj->ID;
}


$trainer_environments = EpointPersonalTrainerMapper::get_trainer_environments( $trainer_id );
$trainer_objectives = EpointPersonalTrainerMapper::get_trainer_objectives( $trainer_id );

add_filter( 'body_class', function( $classes, $class ){ $classes[] = 'page-view-member-training'; return $classes; }, 10, 2 );

 ?><?php get_header( 'noopen' ); ?>
<div class="container">
	<?php if( $member && have_posts() ) : the_post(); ?>
		<div class="row">
			<div class="col-xxs-12 col-xs-12">
				<div class="row">
					<div class="col-xs-12 page-content">
						<p class="text-right"><a class="btn btn-primary" href="<?php echo EliteTrainerSiteTheme::get_my_account_url(); ?>">Volver al perfil</a></p>
						<h1>Mis entrenamientos</h1>
					<?php if( class_exists( 'EpointPersonalTrainer', false ) ) : ?>
						<?php $training_items = EpointPersonalTrainerMapper::get_user_training_items( $member_id, null, null, 'start', 'desc' ); ?>
						<?php if( !empty( $training_items ) ) : ?>
							<?php foreach( $training_items as $tt ) : ?>
								<?php include( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'templates', 'member-training-row.php' ) ) ); ?>
							<?php endforeach; ?>

						<?php else : ?>
							<p>No hay entrenamientos asignados.</p>
						<?php endif; ?>


						
					<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	<?php else : ?>
		<h1><?php echo esc_html( __( 'Not found.', EliteTrainerSiteTheme::TEXT_DOMAIN ) ); ?></h1>
	<?php endif; ?>
</div>

<?php get_footer( 'noclose' ); ?>
