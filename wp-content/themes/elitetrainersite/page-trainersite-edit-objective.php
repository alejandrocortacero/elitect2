<?php defined( 'ABSPATH' ) or die('Wrong Access!'); 

if( !is_super_admin() && !EliteTrainerSiteTheme::is_site_trainer() )
{
	wp_redirect( get_site_url() );
	exit;
}

$user = wp_get_current_user();

$objective_id = isset( $_GET['objective'] ) ? (int)$_GET['objective'] : null;
$objective = $objective_id && class_exists( 'EpointPersonalTrainerMapper', false ) ? EpointPersonalTrainerMapper::get_objective( $objective_id ) : null;

?><?php get_header( 'noopen' ); ?>
<div class="container">
	<?php if( have_posts() ) : the_post(); ?>
		<div class="row">
			<div class="col-xxs-12 col-xs-12">
				<div class="row">
					<div class="col-xs-12 page-content">
						<h1><?php if( $objective ) : ?><?php echo esc_html( $objective->name ); ?><?php else : ?>Nuevo objetivo<?php endif; ?></h1>
						<p><a class="btn btn-primary" href="<?php echo EliteTrainerSiteTheme::get_objectives_list_url(); ?>" rel="nofollow">Volver a la lista</a></p>
					<?php if( class_exists( 'EpointPersonalTrainer', false ) ) : ?>

						<?php echo EpointPersonalTrainerPublic::get_edit_objective_form( $objective_id ); ?>

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
