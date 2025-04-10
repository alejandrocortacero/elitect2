<?php defined( 'ABSPATH' ) or die('Wrong Access!'); 

if( !is_super_admin() && !EliteTrainerSiteTheme::is_site_trainer() )
{
	wp_redirect( get_site_url() );
	exit;
}

$user = wp_get_current_user();

$diet_id = isset( $_GET['diet'] ) ? (int)$_GET['diet'] : null;
$diet = $diet_id && class_exists( 'EpointPersonalTrainerMapper', false ) ? EpointPersonalTrainerMapper::get_diet( $diet_id ) : null;

$referer = !empty( $_SERVER['HTTP_REFERER'] ) ? $_SERVER['HTTP_REFERER'] : '';
$from_member = preg_match( '/trainersite-user-diets/', $referer );

?><?php get_header( 'noopen' ); ?>
<div class="container">
	<?php if( have_posts() ) : the_post(); ?>
		<div class="row">
			<div class="col-xxs-12 col-xs-12">
				<div class="row">
					<div class="col-xs-12 page-content">
<?php if( false ) : ?>
						<?php if( $diet && $diet->start && $diet->end && $diet->user && ( $diet_user = get_user_by( 'ID', $diet->user ) ) ) : ?>
							<h1><?php if( $diet ) : ?><?php echo esc_html( $diet->name ); ?><?php else : ?>Nueva dieta<?php endif; ?> <a class="btn btn-primary pull-right" href="<?php echo EliteTrainerSiteTheme::get_edit_member_url( $diet->user ); ?>" rel="nofollow">Volver al perfil</a></h1>
						<?php else : ?>
							<h1><?php if( $diet ) : ?><?php echo esc_html( $diet->name ); ?><?php else : ?>Nueva dieta<?php endif; ?> <a class="btn btn-primary pull-right" href="<?php echo EliteTrainerSiteTheme::get_diets_list_url(); ?>" rel="nofollow">Volver a la lista</a></h1>
						<?php endif; ?>
<?php endif; ?>
							<h1><?php if( $diet ) : ?><?php echo esc_html( $diet->name ); ?><?php else : ?>Nueva dieta<?php endif; ?> <?php if( $from_member ) : ?><a class="btn btn-primary pull-right" href="<?php echo EliteTrainerSiteTheme::get_user_diets_url( $diet->user ); ?>" rel="nofollow">Volver al perfil</a><?php else : ?><a class="btn btn-primary pull-right" href="<?php echo EliteTrainerSiteTheme::get_diets_list_url(); ?>" rel="nofollow">Volver a la lista</a><?php endif; ?></h1>
						<?php if( $diet && $diet->start && $diet->end && $diet->user && ( $diet_user = get_user_by( 'ID', $diet->user ) ) ) : ?><p class="alert alert-info"><?php echo esc_html( sprintf( 'Dieta asignada a %s del %s al %s', $diet_user->display_name, strftime( '%d/%m/%Y', strtotime( $diet->start ) ), strftime( '%d/%m/%Y', strtotime( $diet->end ) ) ) ); ?>. Si desea conservar esta dieta para este usuario, pruebe a duplicarla o asisgnarla desde el perfil del destinatario.<?php if( false ) : ?><a href="<?php echo EliteTrainerSiteTheme::get_edit_member_url( $diet->user ); ?>" rel="nofollow" class="btn btn-primary pull-right">Ver usuario</a><?php endif; ?></p><?php endif; ?>
						
					<?php if( class_exists( 'EpointPersonalTrainer', false ) ) : ?>

						<?php echo EpointPersonalTrainerPublic::get_edit_diet_form( $diet_id ); ?>

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

