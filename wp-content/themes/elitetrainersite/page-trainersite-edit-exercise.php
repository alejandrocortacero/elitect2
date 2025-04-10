<?php defined( 'ABSPATH' ) or die('Wrong Access!'); 

if( !is_super_admin() && !EliteTrainerSiteTheme::is_site_trainer() )
{
	wp_redirect( get_site_url() );
	exit;
}

$user = wp_get_current_user();

$exercise_id = isset( $_GET['exercise'] ) ? (int)$_GET['exercise'] : null;
$exercise = $exercise_id && class_exists( 'EpointPersonalTrainerMapper', false ) ? EpointPersonalTrainerMapper::get_exercise( $exercise_id ) : null;

?><?php get_header( 'noopen' ); ?>
<div class="container">
	<?php if( have_posts() ) : the_post(); ?>
		<div class="row">
			<div class="col-xxs-12 col-xs-12">
				<div class="row">
					<div class="col-xs-12 page-content">
						<h1><?php if( $exercise ) : ?><?php echo esc_html( $exercise->name ); ?><?php else : ?>Nuevo ejercicio<?php endif; ?> <a class="btn btn-primary pull-right" href="<?php echo EliteTrainerSiteTheme::get_exercises_list_url(); ?>" rel="nofollow">Volver a la lista</a></h1>
					<?php if( class_exists( 'EpointPersonalTrainer', false ) ) : ?>

						<?php echo EpointPersonalTrainerPublic::get_edit_exercise_form( $exercise_id ); ?>

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
