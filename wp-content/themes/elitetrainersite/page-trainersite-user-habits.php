<?php defined( 'ABSPATH' ) or die('Wrong Access!');

if( !EpointPersonalTrainer::is_site_client() && !EpointPersonalTrainer::is_site_trainer() )
{
	wp_redirect( get_site_url() );
	exit;
}

$member = isset( $_GET['member'] ) ? get_user_by( 'id', (int)$_GET['member'] ) : wp_get_current_user();

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
						<h1>Hábitos de comidas de <?php echo esc_html( $member ? $member->display_name : '' ); ?> <a class="btn btn-primary pull-right" href="<?php echo EliteTrainerSiteTheme::get_edit_member_url( $member->ID ); ?>">Volver al perfil</a><?php if( false ): ?><a class="btn btn-primary pull-right" href="<?php echo EliteTrainerSiteTheme::get_members_list_url(); ?>">Volver al listado de socios</a><?php endif; ?></h1>
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
<?php get_footer( 'noclose' ); ?>


