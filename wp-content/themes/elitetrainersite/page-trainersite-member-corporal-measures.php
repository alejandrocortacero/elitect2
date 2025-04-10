<?php defined( 'ABSPATH' ) or die('Wrong Access!');
$member_id = get_current_user_id();//isset( $_GET['member'] ) ? (int)$_GET['member'] : null;
$member = wp_get_current_user();//get_user_by( 'ID', $member_id );

//$trainer_id = get_current_user_id();
$admin_users = get_users( array( 'role' => EpointPersonalTrainer::TRAINER_ROLE ) );
$trainer_id = null;
if( is_array( $admin_users ) && !empty( $admin_users ) )
{
	$trainer_obj = current( $admin_users );
	$trainer_id = $trainer_obj->ID;
}

$magnitudes = $trainer_id ? EpointPersonalTrainerMapper::get_evolution_magnitudes_by_type( 'corporal', $trainer_id ) : null;

$measures = EpointPersonalTrainerMapper::get_user_evolution_values_by_type( $member_id, 'corporal' );
$observations = EpointPersonalTrainerMapper::get_user_corporal_evolution_observations( $member_id );
$dates = array();
foreach( $measures as $measure ) 
{
	if( !array_key_exists( $measure->when, $dates ) )
		$dates[$measure->when] = array();

	$dates[$measure->when][(int)$measure->magnitude] = $measure->value;
}
foreach( $observations as $ob ) 
{
	if( array_key_exists( $ob->when, $dates ) )
	{
		$dates[$ob->when]['observations'] = $ob->observations;
	}
}


add_filter( 'body_class', function( $classes, $class ){ $classes[] = 'page-member-corporal-measures'; return $classes; }, 10, 2 );

 ?><?php get_header( 'noopen' ); ?>
<div class="container">
	<?php if( $member && have_posts() ) : the_post(); ?>
		<div class="row">
			<div class="col-xxs-12 col-xs-12">
				<h1><a class="btn btn-primary pull-right" href="<?php echo EliteTrainerSiteTheme::get_my_account_url(); ?>">Volver al perfil</a> Mis medidas corporales</h1>
				<div class="row corporal-measures-row">
					<div class="col-xs-12">
						<div class="section-text">
							<div class="editable">
								<?php echo wp_kses_post(  EliteTrainerSiteThemeCustomizer::get_html_content( 'corporalmeasuresheadertext', '<p>En esta hoja apuntaremos de forma semanal pesos y medidas corporales.</p><p>De forma personalizada nos podremos en contacto contigo y juntos plantearemos la perdida o aumento de peso corporal, como también el tiempo para lograr estos objetivos de semana en semana.</p>' ) ); ?>
							</div>
						</div>
						<?php EliteTrainerSiteThemeCustomizer::print_page_image( 'corporalmeasuresheaderimage' ); ?>
					</div>
				</div>
				<?php if( !empty( $magnitudes ) && class_exists( 'EpointPersonalTrainer', false ) ) : ?>
					<?php if( !empty( $dates ) ) : ?>
						<div class="table-responsive">
<table class="table table-striped">
	<tbody>
		<thead><tr>
			<th>Fecha</th>
		<?php foreach( $magnitudes as $magnitude ) : ?>
			<th><?php echo esc_html( $magnitude->name ); ?></th>
		<?php endforeach; ?>
			<th>Observaciones</th>
		
		</tr></thead>
	<?php foreach( $dates as $date => $measures ) : ?>
		<tr>
			<td><?php echo esc_html( date( 'd/m/Y', strtotime( $date ) ) ); ?></td>
		<?php foreach( $magnitudes as $magnitude ) : ?>
			<td><?php echo isset( $measures[(int)$magnitude->ID] ) ?  esc_html( $measures[(int)$magnitude->ID] ) : '---'; ?></td>
		<?php endforeach; ?>
			<td><?php if( !empty( $measures['observations'] ) ) : ?><button type="button" class="btn btn-sm" data-toggle="popover" title="Observaciones" data-container="body" data-content="<?php echo esc_attr( $measures['observations'] ); ?>"><span class="glyphicon glyphicon-eye-open"></span></button><?php endif; ?></td>
		</tr>
	<?php endforeach; ?>
	</tbody>
</table>
						</div>

					<?php else : ?>
						<p>No se han registrado medidas aun.</p>
					<?php endif; ?>

					<hr />
					<?php echo EpointPersonalTrainerPublic::get_member_corporal_measures_form( $member_id ); ?>

				<?php endif; ?>
			</div>
		</div>
	<?php else : ?>
		<h1><?php echo esc_html( __( 'Not found.', EliteTrainerSiteTheme::TEXT_DOMAIN ) ); ?></h1>
	<?php endif; ?>
</div>

<?php //get_template_part( 'templates/contact', 'container' ); ?>

<?php if( class_exists( 'EpointPersonalTrainer', false ) &&
			EpointPersonalTrainer::is_site_client() &&
			empty( EpointPersonalTrainerMapper::get_last_user_evolution_values_by_type( get_current_user_id(), 'corporal' ) )
			 ) : ?>
	<?php get_template_part( 'templates/first-modals/member', 'corporal' ); ?>
<?php endif; ?>

<?php get_footer( 'noclose' ); ?>
