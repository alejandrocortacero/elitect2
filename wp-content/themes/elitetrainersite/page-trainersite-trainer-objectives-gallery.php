<?php defined( 'ABSPATH' ) or die('Wrong Access!'); 

if( !is_super_admin() && !EliteTrainerSiteTheme::is_site_trainer() )
{
	wp_redirect( get_site_url() );
	exit;
}

$user = wp_get_current_user();

wp_enqueue_script( 'elitetrainersite-trainer-objectives-gallery-js', get_template_directory_uri() . '/js/training-objectives-gallery.js', array( 'jquery', 'elitetrainersite-navigation-js' ), '1.0', true );
wp_localize_script(
	'elitetrainersite-trainer-objectives-gallery-js',
	'EliteTrainerSiteTrainingObjectivesGalleryNS',
	array(
		'trainingObjectivesTabCookie' => EliteTrainerSiteTheme::TRAINING_OBJECTIVES_TAB_COOKIE
	)
);

?><?php get_header( 'noopen' ); ?>
<div class="container">
	<?php if( have_posts() ) : the_post(); ?>
		<div class="row">
			<div class="col-xxs-12 col-xs-12">
				<div class="row">
					<div class="col-xs-12 page-content">
						<h1>Objetivos y entornos <a class="btn btn-primary pull-right" href="<?php echo EliteTrainerSiteTheme::get_creation_zone_url(); ?>" rel="nofollow">Volver al panel principal</a></h1>
					<?php if( class_exists( 'EpointPersonalTrainer', false ) ) : ?>
						<ul class="nav nav-tabs" role="tablist" id="training-objectives-gallery-tabs">
							<li role="presentation" class="active"><a href="#objectives" aria-controls="objectives" role="tab" data-toggle="tab">Objetivos</a></li>
							<li role="presentation"><a href="#environments" aria-controls="environments" role="tab" data-toggle="tab">Entornos</a></li>
						</ul>

						<div class="tab-content">

							<div role="tabpanel" class="tab-pane active" id="objectives">
								<div class="objectives-layer">
								<?php $objectives = EpointPersonalTrainerMapper::get_trainer_objectives( $user->ID ); ?>

									<p><a class="btn btn-primary" href="<?php echo EliteTrainerSiteTheme::get_edit_objective_url( null ); ?>" rel="nofollow">Nuevo objetivo</a></p>
									<div class="table-responsive"><table class="table table-striped">
										<thead><tr>
											<th>Nombre</th>
											<th></th>
										</tr></thead>
										<tbody>
										<?php foreach( $objectives as $ob ) : ?>
											<tr>
			<td><a href="<?php echo EliteTrainerSiteTheme::get_edit_objective_url( $ob->ID ); ?>"><?php echo $ob->name; ?></a></td>
			<td>
			<?php if( EliteTrainerSiteTheme::is_site_trainer() ) : ?>
				<a href="<?php echo admin_url( 'admin-post.php' ); ?>?action=<?php echo EliteTrainerSiteTheme::DELETE_OBJECTIVE_ACTION; ?>&objective=<?php echo $ob->ID; ?>"><span class="glyphicon glyphicon-trash"></span></a>
			<?php endif; ?>
			</td>

											</tr>
										<?php endforeach; ?>
										</tbody>
									</table></div>

								</div>
							</div>

							<div role="tabpanel" class="tab-pane" id="environments">
								<div class="environments-layer">
								<?php $environments = EpointPersonalTrainerMapper::get_trainer_environments( $user->ID ); ?>

									<p><a class="btn btn-primary" href="<?php echo EliteTrainerSiteTheme::get_edit_environment_url( null ); ?>" rel="nofollow">Nuevo entorno</a></p>
									<div class="table-responsive"><table class="table table-striped">
										<thead><tr>
											<th>Nombre</th>
											<th></th>
										</tr></thead>
										<tbody>
										<?php foreach( $environments as $en ) : ?>
											<tr>
			<td><a href="<?php echo EliteTrainerSiteTheme::get_edit_environment_url( $en->ID ); ?>"><?php echo $en->name; ?></a></td>
			<td>
			<?php if( EliteTrainerSiteTheme::is_site_trainer() ) : ?>
				<a href="<?php echo admin_url( 'admin-post.php' ); ?>?action=<?php echo EliteTrainerSiteTheme::DELETE_ENVIRONMENT_ACTION; ?>&environment=<?php echo $en->ID; ?>"><span class="glyphicon glyphicon-trash"></span></a>
			<?php endif; ?>
			</td>

											</tr>
										<?php endforeach; ?>
										</tbody>
									</table></div>

								</div>
							</div>

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
