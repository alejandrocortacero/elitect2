<?php defined( 'ABSPATH' ) or die('Wrong Access!');

if( !is_super_admin() && !EliteTrainerSiteTheme::is_site_trainer() )
{
	wp_redirect( get_site_url() );
	exit;
}

$member_id = isset( $_GET['member'] ) ? (int)$_GET['member'] : null;
$member = $member_id !== null ? get_user_by( 'id', $member_id ) : null;

$objectives = EpointPersonalTrainerMapper::get_trainer_objectives( get_current_user_id() );
$environments = EpointPersonalTrainerMapper::get_trainer_environments( get_current_user_id() );

add_filter( 'body_class', function( $classes, $class ){ $classes[] = 'page-trainer-edit-member'; return $classes; }, 10, 2 );

 ?><?php get_header( 'noopen' ); ?>
<div class="container">
	<?php if( have_posts() ) : the_post(); ?>
		<div class="row">
			<div class="col-xxs-12 col-xs-12">
				<div class="row">
					<div class="col-xs-12 page-content">
<?php if( class_exists( 'EpointPersonalTrainer', false ) ) : ?>
	<?php if( !$member ) : ?>
		<?php include( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'templates', 'member-edit-new.php' ) ) ); ?>
	<?php else : ?>
		<?php if( EpointPersonalTrainer::is_site_client( $member->ID ) ) : ?>
			<?php include( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'templates', 'member-edit-existant.php' ) ) ); ?>
		<?php else : ?>
			<p>Usuario no encontrado.</p>
		<?php endif; ?>
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
<?php //get_template_part( 'templates/contact', 'container' ); ?>

<?php 
	// assing training here has been removed in templates/member-edit-existant.php
	include( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'templates', 'assign-training-modal.php' ) ) );
?>

<?php get_footer( 'noclose' ); ?>
