<?php defined( 'ABSPATH' ) or die('Wrong Access!'); 

if( !is_super_admin() && !EliteTrainerSiteTheme::is_site_trainer() )
{
	wp_redirect( get_site_url() );
	exit;
}

$show_preset_training = false;

$user = wp_get_current_user();
$objectives = EpointPersonalTrainerMapper::get_trainer_objectives( $user->ID );
$environments = EpointPersonalTrainerMapper::get_trainer_environments( $user->ID );

wp_enqueue_script( 'elitetrainersite-training-gallery-js', get_template_directory_uri() . '/js/training-gallery.js', array( 'jquery', 'elitetrainersite-navigation-js' ), '1.0', true );
wp_localize_script(
	'elitetrainersite-training-gallery-js',
	'EliteTrainerSiteTrainingGalleryNS',
	array(
		'trainingTabCookie' => EliteTrainerSiteTheme::TRAINING_TAB_COOKIE
	)
);

setCookie( EliteTrainerSiteTheme::LAST_PAGE_COOKIE, 'trainer-training-gallery', time() + 24*60*60*1000, '/' );

add_filter( 'body_class', function( $classes, $class ) { $classes[] = 'page-trainer-training-list'; return $classes; }, 10, 2 );

if( EliteTrainerSiteTheme::must_show_duplicate_training_confirmation() )
	add_filter( 'body_class', function( $classes, $class ) { $classes[] = 'must-confirm-training-duplication'; return $classes; }, 10, 2 );

if( EliteTrainerSiteTheme::must_show_delete_training_confirmation() )
	add_filter( 'body_class', function( $classes, $class ) { $classes[] = 'must-confirm-training-deletion'; return $classes; }, 10, 2 );

if( EliteTrainerSiteTheme::must_show_edit_training_confirmation() )
	add_filter( 'body_class', function( $classes, $class ) { $classes[] = 'must-confirm-training-edition'; return $classes; }, 10, 2 );


$last_duplicated_training = isset( $_COOKIE[EliteTrainerSiteTheme::TRAINING_LAST_DUPLICATED_COOKIE] ) ? (int)$_COOKIE[EliteTrainerSiteTheme::TRAINING_LAST_DUPLICATED_COOKIE] : null;
if( $last_duplicated_training )
{
	setCookie( EliteTrainerSiteTheme::TRAINING_LAST_DUPLICATED_COOKIE, '', time() + 24*60*60*1000, '/' );
}

?><?php get_header( 'noopen' ); ?>
<div class="container">
	<?php if( have_posts() ) : the_post(); ?>
		<div class="row">
			<div class="col-xxs-12 col-xs-12">
				<div class="row">
					<div class="col-xs-12 page-content">
						<h1 style="display:flex;justify-content:space-between;align-items:flex-start;">Galería de entrenamientos <a class="btn btn-primary pull-right" href="<?php echo EliteTrainerSiteTheme::get_creation_zone_url(); ?>" rel="nofollow">Volver al panel principal</a></h1>
					<?php if( class_exists( 'EpointPersonalTrainer', false ) ) : ?>
						<div class="tools-bar">
							<div class="training-tools">
								<a class="btn btn-primary create-training" href="<?php echo EliteTrainerSiteTheme::get_edit_training_url( null ); ?>" rel="nofollow"><span class="text">Nuevo entrenamiento</span><?php if( false ) : ?><span class="glyphicon glyphicon-plus"></span><?php endif; ?></a>
							</div>
							<?php EliteTrainerSiteTheme::print_training_filters(); ?>
						</div>
						<ul class="nav nav-tabs" id="training-gallery-tabs" role="tablist">
							<li role="presentation" class="active"><a href="#user-training" aria-controls="user-training" role="tab" data-toggle="tab">Asignados</a></li>
							<li role="presentation"><a href="#my-training-templates" aria-controls="my-training-templates" role="tab" data-toggle="tab">Mis plantillas</a></li>
							<?php if( $show_preset_training ) : ?><li role="presentation"><a href="#preset-training-templates" aria-controls="preset-training-templates" role="tab" data-toggle="tab">Predefinidos</a></li><?php endif; ?>
						</ul>

						<div class="tab-content" id="training-gallery-tabs-content">

							<div role="tabpanel" class="tab-pane active" id="user-training">
								<div class="training-templates">
								<?php $training_templates = EpointPersonalTrainerMapper::get_trainer_assigned_training( $user->ID ); ?>

									<br />
									<p>Aquí tienes todos los entrenamientos asignados actualmente a tus clientes.</p>

									<div class="table-responsive"><table class="table table-striped items-table">
										<thead><tr>
											<th>Nombre</th>
											<th>Para</th>
											<?php if( false ) : ?><th>Descripción</th><?php endif; ?>
<?php foreach( $objectives as $objective ) : ?>
<th class="text-center"><?php echo esc_html( $objective->name ); ?></th>
<?php endforeach; ?>
<?php foreach( $environments as $environment ) : ?>
<th class="text-center"><?php echo esc_html( $environment->name ); ?></th>
<?php endforeach; ?>
											<th></th>
										</tr></thead>
										<tbody>
										<?php foreach( $training_templates as $tt ) : ?>
											<tr class="training-template <?php if( $last_duplicated_training == $tt->ID ) : ?>new-duplicated<?php endif; ?> <?php if( !$tt->active ) : ?>training-inactive<?php endif; ?> <?php foreach( $objectives as $objective ) : ?><?php if( EpointPersonalTrainerMapper::is_training_objective( $tt->ID, $objective->ID ) ) : ?> training-has-objective-<?php echo esc_attr( $objective->ID ); ?> <?php endif; ?><?php endforeach; ?> <?php foreach( $environments as $environment ) : ?><?php if( EpointPersonalTrainerMapper::is_training_environment( $tt->ID, $environment->ID ) ) : ?> training-has-environment-<?php echo esc_attr( $environment->ID ); ?> <?php endif; ?><?php endforeach; ?>">
			<td class="small-full-width">
				<a class="edit-training" data-usertraining="<?php echo $tt->user ? 'true' : 'false'; ?>" href="<?php echo EliteTrainerSiteTheme::get_edit_training_url( $tt->ID ); ?>"><?php echo $tt->name; ?></a>
				<a href="#" data-link="<?php echo EliteTrainerSiteTheme::get_edit_training_url( $tt->ID ); ?>" data-duplicate-link="<?php echo admin_url( 'admin-post.php' ); ?>?action=<?php echo EliteTrainerSiteTheme::DUPLICATE_TRAINING_ACTION; ?>&training=<?php echo $tt->ID; ?>&after=edit" data-toggle="modal" data-target="#confirm-training-edition" title="Editar" data-training="<?php echo esc_attr( $tt->ID ); ?>" data-usertraining="<?php echo $tt->user ? 'true' : 'false'; ?>" class="confirm-training-edition"><?php echo $tt->name; ?></a>
			</td>
			<td class="small-full-width">
				<?php $client = get_user_by( 'ID', $tt->user ); ?>
				<a href="<?php echo EliteTrainerSiteTheme::get_edit_member_url( $client->ID ); ?>"><?php echo $client->display_name; ?></a>
			</td>
			<?php if( false ) : ?><td><?php echo esc_html( $tt->description ); ?></td><?php endif; ?>
<?php foreach( $objectives as $objective ) : ?>
<td class="text-center"><?php if( EpointPersonalTrainerMapper::is_training_objective( $tt->ID, $objective->ID ) ) : ?><span class="glyphicon glyphicon-ok"></span><span class="cell-label"><?php echo esc_html( $objective->name ); ?></span><?php endif; ?></td>
<?php endforeach; ?>
<?php foreach( $environments as $environment ) : ?>
<td class="text-center"><?php if( EpointPersonalTrainerMapper::is_training_environment( $tt->ID, $environment->ID ) ) : ?><span class="glyphicon glyphicon-ok"></span><span class="cell-label"><?php echo esc_html( $environment->name ); ?></span><?php endif; ?></td>
<?php endforeach; ?>
			<td class="actions three">
			<?php if( EliteTrainerSiteTheme::is_site_trainer() ) : ?>
				<a class="preview-training" href="#" data-toggle="modal" data-target="#preview-training-modal" data-training="<?php echo esc_attr( $tt->ID ); ?>"><span class="glyphicon glyphicon-eye-open"></span></a>
				<a href="<?php echo EliteTrainerSiteTheme::get_edit_training_url( $tt->ID ); ?>" class="edit-training" data-training="<?php echo $tt->ID; ?>" data-usertraining="<?php echo $tt->user ? 'true' : 'false'; ?>" title="Editar"><span class="glyphicon glyphicon-edit"></span></a>
				<a href="#" data-link="<?php echo EliteTrainerSiteTheme::get_edit_training_url( $tt->ID ); ?>" data-duplicate-link="<?php echo admin_url( 'admin-post.php' ); ?>?action=<?php echo EliteTrainerSiteTheme::DUPLICATE_TRAINING_ACTION; ?>&training=<?php echo $tt->ID; ?>&after=edit" data-toggle="modal" data-target="#confirm-training-edition" title="Editar" data-training="<?php echo esc_attr( $tt->ID ); ?>" data-usertraining="<?php echo $tt->user ? 'true' : 'false'; ?>" class="confirm-training-edition"><span class="glyphicon glyphicon-edit"></span></a>
				<a href="#" data-toggle="modal" data-target="#confirm-training-duplication" title="Duplicar" data-training="<?php echo esc_attr( $tt->ID ); ?>" class="confirm-training-duplication"><span class="glyphicon glyphicon-duplicate"></span></a>
				<a href="<?php echo admin_url( 'admin-post.php' ); ?>?action=<?php echo EliteTrainerSiteTheme::DUPLICATE_TRAINING_ACTION; ?>&training=<?php echo $tt->ID; ?>" class="duplicate-training" data-training="<?php echo $tt->ID; ?>"><span class="glyphicon glyphicon-duplicate"></span></a>
				<a href="#" data-toggle="modal" data-target="#confirm-training-deletion" title="Eliminar" data-training="<?php echo esc_attr( $tt->ID ); ?>" class="confirm-training-deletion"><span class="glyphicon glyphicon-trash"></span></a>
				<a class="delete-training" href="<?php echo admin_url( 'admin-post.php' ); ?>?action=<?php echo EliteTrainerSiteTheme::DELETE_TRAINING_ACTION; ?>&training=<?php echo $tt->ID; ?>"><span class="glyphicon glyphicon-trash"></span></a>
			<?php endif; ?>
			</td>

											</tr>
										<?php endforeach; ?>
										</tbody>
									</table></div>

								</div>
							</div>

							<div role="tabpanel" class="tab-pane" id="my-training-templates">
								<div class="training-templates">
								<?php $training_templates = EpointPersonalTrainerMapper::get_trainer_training_templates( $user->ID ); ?>

									<br />
									<p>Aquí tienes todos los entrenamientos creados o duplicados desde aquí. También están los duplicados tras ser asignados a un cliente.</p>
									<div class="table-responsive"><table class="table table-striped items-table">
										<thead><tr>
											<th>Nombre</th>
											<?php if( false ) : ?><th>Descripción</th><?php endif; ?>
<?php foreach( $objectives as $objective ) : ?>
<th class="text-center"><?php echo esc_html( $objective->name ); ?></th>
<?php endforeach; ?>
<?php foreach( $environments as $environment ) : ?>
<th class="text-center"><?php echo esc_html( $environment->name ); ?></th>
<?php endforeach; ?>
											<th></th>
										</tr></thead>
										<tbody>
										<?php foreach( $training_templates as $tt ) : ?>
											<tr class="training-template <?php if( $last_duplicated_training == $tt->ID ) : ?>new-duplicated<?php endif; ?> <?php foreach( $objectives as $objective ) : ?><?php if( EpointPersonalTrainerMapper::is_training_objective( $tt->ID, $objective->ID ) ) : ?> training-has-objective-<?php echo esc_attr( $objective->ID ); ?> <?php endif; ?><?php endforeach; ?> <?php foreach( $environments as $environment ) : ?><?php if( EpointPersonalTrainerMapper::is_training_environment( $tt->ID, $environment->ID ) ) : ?> training-has-environment-<?php echo esc_attr( $environment->ID ); ?> <?php endif; ?><?php endforeach; ?>">
			<td class="small-full-width">
				<?php if( false )  :?><a href="<?php echo EliteTrainerSiteTheme::get_edit_training_url( $tt->ID ); ?>"><?php echo $tt->name; ?></a><?php endif; ?>
				<a class="edit-training" data-usertraining="<?php echo $tt->user ? 'true' : 'false'; ?>" href="<?php echo EliteTrainerSiteTheme::get_edit_training_url( $tt->ID ); ?>"><?php echo $tt->name; ?></a>
				<a href="#" data-link="<?php echo EliteTrainerSiteTheme::get_edit_training_url( $tt->ID ); ?>" data-toggle="modal" data-target="#confirm-training-edition" title="Editar" data-training="<?php echo esc_attr( $tt->ID ); ?>" data-usertraining="<?php echo $tt->user ? 'true' : 'false'; ?>" class="confirm-training-edition"><?php echo $tt->name; ?></a>

			</td>


			<?php if( false ) : ?><td><?php echo esc_html( $tt->description ); ?></td><?php endif; ?>
<?php foreach( $objectives as $objective ) : ?>
<td class="text-center"><?php if( EpointPersonalTrainerMapper::is_training_objective( $tt->ID, $objective->ID ) ) : ?><span class="glyphicon glyphicon-ok"></span><span class="cell-label"><?php echo esc_html( $objective->name ); ?></span><?php endif; ?></td>
<?php endforeach; ?>
<?php foreach( $environments as $environment ) : ?>
<td class="text-center"><?php if( EpointPersonalTrainerMapper::is_training_environment( $tt->ID, $environment->ID ) ) : ?><span class="glyphicon glyphicon-ok"></span><span class="cell-label"><?php echo esc_html( $environment->name ); ?></span><?php endif; ?></td>
<?php endforeach; ?>
			<td class="actions three">
			<?php if( EliteTrainerSiteTheme::is_site_trainer() ) : ?>
				<a class="preview-training" href="#" data-toggle="modal" data-target="#preview-training-modal" data-training="<?php echo esc_attr( $tt->ID ); ?>"><span class="glyphicon glyphicon-eye-open"></span></a>
				<a href="<?php echo EliteTrainerSiteTheme::get_edit_training_url( $tt->ID ); ?>" class="edit-training" data-training="<?php echo $tt->ID; ?>" data-usertraining="<?php echo $tt->user ? 'true' : 'false'; ?>" title="Editar"><span class="glyphicon glyphicon-edit"></span></a>
				<a href="#" data-link="<?php echo EliteTrainerSiteTheme::get_edit_training_url( $tt->ID ); ?>" data-toggle="modal" data-target="#confirm-training-edition" title="Editar" data-training="<?php echo esc_attr( $tt->ID ); ?>" data-usertraining="<?php echo $tt->user ? 'true' : 'false'; ?>" class="confirm-training-edition"><span class="glyphicon glyphicon-edit"></span></a>
				<a href="#" data-toggle="modal" data-target="#confirm-training-duplication" title="Duplicar" data-training="<?php echo esc_attr( $tt->ID ); ?>" class="confirm-training-duplication"><span class="glyphicon glyphicon-duplicate"></span></a>
				<a href="<?php echo admin_url( 'admin-post.php' ); ?>?action=<?php echo EliteTrainerSiteTheme::DUPLICATE_TRAINING_ACTION; ?>&training=<?php echo $tt->ID; ?>" class="duplicate-training" data-training="<?php echo $tt->ID; ?>"><span class="glyphicon glyphicon-duplicate"></span></a>
				<a href="#" data-toggle="modal" data-target="#confirm-training-deletion" title="Eliminar" data-training="<?php echo esc_attr( $tt->ID ); ?>" class="confirm-training-deletion"><span class="glyphicon glyphicon-trash"></span></a>
				<a class="delete-training" href="<?php echo admin_url( 'admin-post.php' ); ?>?action=<?php echo EliteTrainerSiteTheme::DELETE_TRAINING_ACTION; ?>&training=<?php echo $tt->ID; ?>"><span class="glyphicon glyphicon-trash"></span></a>
			<?php endif; ?>
			</td>

											</tr>
										<?php endforeach; ?>
										</tbody>
									</table></div>

								</div>
							</div>

							<?php if( $show_preset_training ) : ?>
							<div role="tabpanel" class="tab-pane" id="preset-training-templates">
								<div class="training-templates">
								<?php $training_templates = EpointPersonalTrainerMapper::get_preset_training_items(); ?>
									<br />
									<p>Aquí tienes algunos entrenamientos predefinidos. Puedes utilizarlos o duplicarlos para modificarlos posteriormente.</p>
									<div class="table-responsive"><table class="table table-striped items-table">
										<thead><tr>
											<th>Nombre</th>
											<?php if( false ) : ?><th>Descripción</th><?php endif; ?>
<?php foreach( $objectives as $objective ) : ?>
<th class="text-center"><?php echo esc_html( $objective->name ); ?></th>
<?php endforeach; ?>
<?php foreach( $environments as $environment ) : ?>
<th class="text-center"><?php echo esc_html( $environment->name ); ?></th>
<?php endforeach; ?>
											<th></th>
										</tr></thead>
										<tbody>
										<?php foreach( $training_templates as $tt ) : ?>
											<tr class="training-template <?php if( $last_duplicated_training == $tt->ID ) : ?>new-duplicated<?php endif; ?> <?php foreach( $objectives as $objective ) : ?><?php if( EpointPersonalTrainerMapper::is_training_objective( $tt->ID, $objective->ID ) ) : ?> training-has-objective-<?php echo esc_attr( $objective->ID ); ?> <?php endif; ?><?php endforeach; ?> <?php foreach( $environments as $environment ) : ?><?php if( EpointPersonalTrainerMapper::is_training_environment( $tt->ID, $environment->ID ) ) : ?> training-has-environment-<?php echo esc_attr( $environment->ID ); ?> <?php endif; ?><?php endforeach; ?>">
			<td class="small-full-width"><a href="<?php echo EliteTrainerSiteTheme::get_edit_training_url( $tt->ID ); ?>"><?php echo $tt->name; ?></a></td>
			<?php if( false ) : ?><td><?php echo esc_html( $tt->description ); ?></td><?php endif; ?>
<?php foreach( $objectives as $objective ) : ?>
<td class="text-center"><?php if( EpointPersonalTrainerMapper::is_training_objective( $tt->ID, $objective->ID ) ) : ?><span class="glyphicon glyphicon-ok"></span><span class="cell-label"><?php echo esc_html( $objective->name ); ?></span><?php endif; ?></td>
<?php endforeach; ?>
<?php foreach( $environments as $environment ) : ?>
<td class="text-center"><?php if( EpointPersonalTrainerMapper::is_training_environment( $tt->ID, $environment->ID ) ) : ?><span class="glyphicon glyphicon-ok"></span><span class="cell-label"><?php echo esc_html( $environment->name ); ?></span><?php endif; ?></td>
<?php endforeach; ?>
			<td class="actions two">
			<?php if( EliteTrainerSiteTheme::is_site_trainer() ) : ?>
				<a class="preview-training" href="#" data-toggle="modal" data-target="#preview-training-modal" data-training="<?php echo esc_attr( $tt->ID ); ?>"><span class="glyphicon glyphicon-eye-open"></span></a>
				<?php if( false ) : ?><a href="<?php echo EliteTrainerSiteTheme::get_edit_training_url( $tt->ID ); ?>"><span class="glyphicon glyphicon-edit"></span></a><?php endif; ?>
				<a href="#" data-toggle="modal" data-target="#confirm-training-duplication" title="Duplicar" data-training="<?php echo esc_attr( $tt->ID ); ?>" class="confirm-training-duplication"><span class="glyphicon glyphicon-duplicate"></span></a>
				<a href="<?php echo admin_url( 'admin-post.php' ); ?>?action=<?php echo EliteTrainerSiteTheme::DUPLICATE_TRAINING_ACTION; ?>&training=<?php echo $tt->ID; ?>" class="duplicate-training" data-training="<?php echo $tt->ID; ?>"><span class="glyphicon glyphicon-duplicate"></span></a>
			<?php endif; ?>
			</td>

											</tr>
										<?php endforeach; ?>
										</tbody>
									</table></div>

								</div>
							</div>
							<?php endif; // show_preset_training ?>

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

<?php if( EliteTrainerSiteTheme::must_show_duplicate_training_confirmation() ) : ?>
<div class="modal fade" id="confirm-training-duplication" tabindex="-1" role="dialog" aria-labelledby="confirm-training-duplication-label">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="confirm-training-duplication-label">Duplicar entrenamiento</h4>
      </div>
      <div class="modal-body">
			<p>Este entrenamiento de duplicará y aparecerá en la zona de &quot;Mis plantillas&quot;, dándote la opción de  modificar las fotos o texto o ambos y así tener un nuevo entrenamiento disponible de forma cómoda y rápida.</p>
			<p class="text-center"><a href="" class="confirm-link btn btn-primary" data-base-url="<?php echo admin_url( 'admin-post.php' ); ?>?action=<?php echo EliteTrainerSiteTheme::DUPLICATE_TRAINING_ACTION; ?>&training=" data-exercise="">Duplicar</a></p>
			<div class="checkbox">
				<input type="checkbox" id="not-show-training-duplication-confirmation" class=" input-checkbox cool" value="yes">
				<label for="not-show-training-duplication-confirmation"> <span class="checker"></span> No volver a mostrar este mensaje</label>
			</div>
      </div>
    </div>
  </div>
</div>
<?php endif; ?>

<?php if( EliteTrainerSiteTheme::must_show_delete_training_confirmation() ) : ?>
<div class="modal fade" id="confirm-training-deletion" tabindex="-1" role="dialog" aria-labelledby="confirm-training-deletion-label">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="confirm-training-deletion-label">Eliminar entrenamiento</h4>
      </div>
      <div class="modal-body">
			<p>El entrenamiento será eliminado permanentemente. ¿Desea continuar?</p>
			<p class="text-center"><a href="" class="confirm-link btn btn-primary" data-base-url="<?php echo admin_url( 'admin-post.php' ); ?>?action=<?php echo EliteTrainerSiteTheme::DELETE_TRAINING_ACTION; ?>&training=" data-exercise="">Eliminar</a></p>
			<div class="checkbox">
				<input type="checkbox" id="not-show-training-deletion-confirmation" class=" input-checkbox cool" value="yes">
				<label for="not-show-training-deletion-confirmation"> <span class="checker"></span> No volver a mostrar este mensaje</label>
			</div>
      </div>
    </div>
  </div>
</div>
<?php endif; ?>

<?php if( EliteTrainerSiteTheme::must_show_edit_training_confirmation() ) : ?>
<div class="modal fade" id="confirm-training-edition" tabindex="-1" role="dialog" aria-labelledby="confirm-training-edition-label">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="confirm-training-edition-label">Editar entrenamiento</h4>
      </div>
      <div class="modal-body">
			<p>A continuación podrá modificar las características del entrenamiento: nombre, descripción, ejercicios... ¿Desea continuar?</p>
			<p class="user-text">Éste es un entrenamiento asignado a un cliente. Las modificaciones que haga aquí, se verán reflejadas en el entrenamiento para el cliente salvo que seleccione la opción &quot;Duplicar&quot;.</p>
			<p class="text-center"><a href="" class="confirm-link btn btn-primary">Editar</a> <a href="" class="duplicate-link btn btn-primary">Duplicar</a></p>
			<div class="checkbox">
				<input type="checkbox" id="not-show-training-edition-confirmation" class=" input-checkbox cool" value="yes">
				<label for="not-show-training-edition-confirmation"> <span class="checker"></span> No volver a mostrar este mensaje</label>
			</div>
      </div>
    </div>
  </div>
</div>
<?php endif; ?>

<div class="modal fade" id="preview-training-modal" tabindex="-1" role="dialog" aria-labelledby="preview-training-modal-label">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="preview-training-modal-label">Previsualizar entrenamiento</h4>
      </div>
      <div class="modal-body">
			<p class="training"></p>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
(function($){

	$('#preview-training-modal').on('show.bs.modal', function (event) {
	  var button = $(event.relatedTarget);
	  var trainingId = button.data('training');
	  var modal = $(this);

		$.ajax({
			url: '<?php echo admin_url( 'admin-ajax.php' ); ?>',
			type: 'POST',
			data: {
				'action':'<?php echo EliteTrainerSiteTheme::GET_TRAINING_PREVIEW_ACTION; ?>',
				'training' : trainingId
			},
			beforeSend:function(){
				modal.find('.modal-body').html('<p>Cargando...</p>');
			},
			success:function(a,b,c){
				modal.find('.modal-body').html(a);
			},
			error:function(a,b,c){
				modal.find('.modal-body').html('<p>Hubo un error. Inténtelo de nuevo más tarde.</p>');
			}
		});
	});


	$('#confirm-training-duplication').on('show.bs.modal', function (event) {
	  var button = $(event.relatedTarget);
	  var trainingId = button.data('training');
	  var modal = $(this);
	  var link = modal.find('.modal-body a.confirm-link');
	  link.data('training',trainingId);
	  link.prop('href',link.data('base-url') + trainingId);
	});

	$('#confirm-training-deletion').on('show.bs.modal', function (event) {
	  var button = $(event.relatedTarget);
	  var trainingId = button.data('training');
	  var modal = $(this);
	  var link = modal.find('.modal-body a.confirm-link');
	  link.data('training',trainingId);
	  link.prop('href',link.data('base-url') + trainingId);
	});

	$('#confirm-training-edition').on('show.bs.modal', function (event) {
	  var button = $(event.relatedTarget);
	  var trainingId = button.data('training');
	  var modal = $(this);

	  var link = modal.find('.modal-body a.confirm-link');
	  link.prop('href',button.data('link'));

	  var dLink = modal.find('.modal-body a.duplicate-link');
	  dLink.prop('href',button.data('duplicate-link'));

	  var userTraining = button.data('usertraining');
	  var userText = modal.find('.modal-body p.user-text');
		if( userTraining )
		{
			userText.show();
			dLink.show();
		}
		else
		{
			userText.hide();
			dLink.hide();
		}
	});

	$('#not-show-training-duplication-confirmation').change(function(evt){
		var c = $(evt.currentTarget);
		if( c.prop('checked') )
		{
			$('body').removeClass('must-confirm-training-duplication');
		}
		else
		{
			$('body').addClass('must-confirm-training-duplication');
		}

		$.ajax({
			url: '<?php echo admin_url( 'admin-ajax.php' ); ?>',
			type: 'POST',
			data: {
				'action':'<?php echo EliteTrainerSiteTheme::CONFIRM_ACTIONS_ACTION; ?>',
				'type':'training_duplication',
				'value' : c.prop('checked') ? 'no' : 'yes'
			},
			complete:function(){
			},
			success: function(a,b,c){
			}
		});
	});

	$('#not-show-training-deletion-confirmation').change(function(evt){
		var c = $(evt.currentTarget);
		if( c.prop('checked') )
		{
			$('body').removeClass('must-confirm-training-deletion');
		}
		else
		{
			$('body').addClass('must-confirm-training-deletion');
		}

		$.ajax({
			url: '<?php echo admin_url( 'admin-ajax.php' ); ?>',
			type: 'POST',
			data: {
				'action':'<?php echo EliteTrainerSiteTheme::CONFIRM_ACTIONS_ACTION; ?>',
				'type':'training_deletion',
				'value' : c.prop('checked') ? 'no' : 'yes'
			},
		});
	});


	$('#not-show-training-edition-confirmation').change(function(evt){
		var c = $(evt.currentTarget);
		if( c.prop('checked') )
		{
			$('body').removeClass('must-confirm-training-edition');
		}
		else
		{
			$('body').addClass('must-confirm-training-edition');
		}

		$.ajax({
			url: '<?php echo admin_url( 'admin-ajax.php' ); ?>',
			type: 'POST',
			data: {
				'action':'<?php echo EliteTrainerSiteTheme::CONFIRM_ACTIONS_ACTION; ?>',
				'type':'training_edition',
				'value' : c.prop('checked') ? 'no' : 'yes'
			},
		});
	});
})(jQuery);
</script>


<?php //get_template_part( 'templates/contact', 'container' ); ?>
<?php get_footer( 'noclose' ); ?>
