<?php defined( 'ABSPATH' ) or die('Wrong Access!'); 

if( !is_super_admin() && !EliteTrainerSiteTheme::is_site_trainer() )
{
	wp_redirect( get_site_url() );
	exit;
}

$user = wp_get_current_user();

$magnitude_id = isset( $_GET['measure'] ) ? sanitize_text_field( $_GET['measure'] ) : null;

?><?php get_header( 'noopen' ); ?>
<div class="container">
	<?php if( have_posts() ) : the_post(); ?>
		<div class="row">
			<div class="col-xxs-12 col-xs-12">
				<div class="row">
					<div class="col-xs-12 page-content">
					<?php if( !$magnitude_id ) : ?>
						<h1><a class="btn btn-primary pull-right" href="<?php echo EliteTrainerSiteTheme::get_creation_zone_url(); ?>" rel="nofollow">Volver al panel principal</a> Medidas de velocidad</h1>
						<?php if( class_exists( 'EpointPersonalTrainer', false ) ) : ?>
							<div class="body-measures-layer">
							<?php $magnitudes = EpointPersonalTrainerMapper::get_evolution_magnitudes_by_type( 'speed', $user->ID ); ?>

								<p><a class="btn btn-primary" href="<?php echo EliteTrainerSiteTheme::get_trainer_speed_exercises_url( 'new' ); ?>" rel="nofollow">Nueva medida</a></p>
								<div class="table-responsive"><table class="table table-striped items-table">
									<thead><tr>
										<th>Nombre</th>
										<th>Unidad de medida</th>
										<th></th>
									</tr></thead>
									<tbody>
									<?php foreach( $magnitudes as $m ) : ?>
										<tr>
		<td><a href="<?php echo EliteTrainerSiteTheme::get_trainer_speed_exercises_url( $m->ID ); ?>"><?php echo $m->name; ?></a></td>
		<td><?php echo esc_html( $m->unit ); ?></td>
		<td class="actions">
		<?php if( EliteTrainerSiteTheme::is_site_trainer() ) : ?>
			<a class="delete-magnitude" href="<?php echo admin_url( 'admin-post.php' ); ?>?action=<?php echo EliteTrainerSiteTheme::DELETE_EVOLUTION_MAGNITUDE_ACTION; ?>&magnitude=<?php echo $m->ID; ?>"><span class="glyphicon glyphicon-trash"></span></a>
		<?php endif; ?>
		</td>

										</tr>
									<?php endforeach; ?>
									</tbody>
								</table></div>


							</div>

						<?php endif; ?>
					
					<?php else : ?>
						<h1>
							<a class="btn btn-primary pull-right" href="<?php echo EliteTrainerSiteTheme::get_trainer_speed_exercises_url(); ?>" rel="nofollow">Volver al listado</a>
							<?php if( $magnitude_id == 'new' ) : ?>Nueva medida<?php else: ?>Editar medida<?php endif; ?>
						</h1>
						<?php if( class_exists( 'EpointPersonalTrainer', false ) ) : ?>
							<?php echo EpointPersonalTrainerPublic::get_edit_evolution_magnitude_form( $magnitude_id != 'new' ? (int)$magnitude_id : null, 'speed' ); ?>
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
<?php get_footer( 'noclose' ); ?>
