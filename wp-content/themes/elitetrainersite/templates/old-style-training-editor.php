<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );
$trainer = empty( $trainer ) ? get_user_by( 'id', $trainer_id ) : $trainer;
$member = empty( $member ) ? get_user_by( 'id', $member_id ) : $member;

wp_enqueue_script(
	'external-sortable-script',
	get_template_directory_uri() . '/js/Sortable.min.js',
	array(),
	'1.0',
	true
);
wp_enqueue_script(
	'external-sortable-training-script',
	get_template_directory_uri() . '/js/training-sortable.js',
	array('external-sortable-script'),
	'1.0',
	true
);
?>
<div class="col-xs-12 col-new-training old-style-training-editor">
	<div class="row">
		<div class="col-xs-12">
			<p class="text-center h3">Crea un nuevo entrenamiento</p>
		</div>
		<div class="col-xs-12 col-sm-4">
			<div class="select-new-training-name-layer form-group">
				<label>Nombre del entrenamiento</label>
				<input type="text" class="new-training-name-input form-control" />
			</div>
		</div>
		<div class="col-xs-12 col-sm-4">
			<div class="select-new-objectives-layer">
				<label>Objetivos</label>
				<?php foreach( $trainer_objectives as $objective ) : ?>
					<div class="checkbox">
						<input type="checkbox" value="<?php echo esc_attr( $objective->ID ); ?>" class="input-checkbox cool" id="training-objective-<?php echo esc_attr( $objective->ID ); ?>" />
						<label for="training-objective-<?php echo esc_attr( $objective->ID ); ?>"><span class="checker"></span> <?php echo esc_html( $objective->name ); ?></label>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
		<div class="col-xs-12 col-sm-4">
			<div class="select-new-environments-layer">
				<label>Entornos</label>
				<?php foreach( $trainer_environments as $environment ) : ?>
					<div class="checkbox">
						<input type="checkbox" value="<?php echo esc_attr( $environment->ID ); ?>" class="input-checkbox cool" id="training-environment-<?php echo esc_attr( $environment->ID ); ?>" />
						<label for="training-environment-<?php echo esc_attr( $environment->ID ); ?>"><span class="checker"></span> <?php echo esc_html( $environment->name ); ?></label>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
		<div class="col-xs-12">
			<div class="categories" id="categories-sortable">
			<?php $trainer_categories = EpointPersonalTrainerMapper::get_available_exercise_categories( $trainer_id ); ?>
			<?php foreach( $trainer_categories as $tcat ) : ?>
				<?php if( !empty( EpointPersonalTrainerMapper::get_exercises_in_category_objects( $tcat->ID, $trainer_id, $member_id ) ) ) : ?>
<?php if( false ) : // esta es la version que funcionaba solo al tirar del dragger ?>
				<div class="exercise-category" ondragover="event.preventDefault();jQuery(event.currentTarget).addClass('hovering');" ondragenter="jQuery(event.currentTarget).addClass('hovering');" ondragleave="jQuery(event.currentTarget).removeClass('hovering');" ondrop="jQuery('#' + event.dataTransfer.getData('element')).closest('.exercise-category').insertAfter(event.currentTarget);jQuery(event.currentTarget).removeClass('hovering');"  data-category="<?php echo esc_attr( $tcat->ID ); ?>">
					<div class="name"><div class="dragger" draggable="true" ondragstart="event.dataTransfer.setData('element', event.target.id);" id="exercise-category-<?php echo esc_attr( $tcat->ID ); ?>"><span class="glyphicon glyphicon-menu-hamburger"></span></div><button class="btn btn-primary add-exercise-in-category"><span class="glyphicon glyphicon-plus"></span></button> <div class="text"><?php echo esc_html( $tcat->name ); ?></div> </div>
<?php elseif( false ) : ?>
				<div class="exercise-category" ondragover="event.preventDefault();jQuery(event.currentTarget).addClass('hovering');" ondragenter="jQuery(event.currentTarget).addClass('hovering');" ondragleave="jQuery(event.currentTarget).removeClass('hovering');" ondrop="jQuery('#' + event.dataTransfer.getData('element')).closest('.exercise-category').insertAfter(event.currentTarget);jQuery(event.currentTarget).removeClass('hovering');"  data-category="<?php echo esc_attr( $tcat->ID ); ?>" ondragstart="event.dataTransfer.setData('element', event.target.id);" id="exercise-category-<?php echo esc_attr( $tcat->ID ); ?>" draggable="true">
					<div class="name"><div class="dragger" ><span class="glyphicon glyphicon-menu-hamburger"></span></div><button class="btn btn-primary add-exercise-in-category"><span class="glyphicon glyphicon-plus"></span></button> <div class="text"><?php echo esc_html( $tcat->name ); ?></div> </div>
<?php else : ?>
				<div class="exercise-category"
					data-category="<?php echo esc_attr( $tcat->ID ); ?>"
					id="exercise-category-<?php echo esc_attr( $tcat->ID ); ?>"
				>
					<div class="name"><div class="dragger" ><span class="glyphicon glyphicon-menu-hamburger"></span></div><button class="btn btn-primary add-exercise-in-category"><span class="glyphicon glyphicon-plus"></span></button> <div class="text"><?php echo esc_html( $tcat->name ); ?></div> </div>
<?php endif; ?>

					<div class="exercises">
					</div>
					<div class="exercise-template">
						<?php $exercises_in_category = EpointPersonalTrainerMapper::get_exercises_in_category_objects( $tcat->ID, $trainer_id, $member_id ); ?>
						<div class="edit-exercise">
							<button class="btn btn-primary clone-exercise-for-category"><span class="glyphicon glyphicon-pencil"></span></button>
						</div>
						<div class="remove-layer">
							<button class="btn btn-danger remove-exercise-from-category"><span class="glyphicon glyphicon-trash"></span></button>
						</div>
						<div class="form-group exercise-type-form-group">
							<select class="form-control exercise-type-select-input">
								<option value="preset" selected="selected">Predefinidos</option>
								<option value="own">Propios</option>
							</select>
						</div>
						<div class="form-group select-form-group">
							<select class="form-control exercise-select-input exercise-select-input-preset active-selector">
							<?php foreach( $exercises_in_category as $ex ) : ?>
								<?php if( !$ex->trainer ) : ?>
								<option
									value="<?php echo esc_attr( $ex->ID ); ?>"
									<?php if( !$ex->trainer ) : ?>data-preclone="true"<?php endif; ?>
								><?php echo esc_html( $ex->name ); ?></option>
								<?php endif; ?>
							<?php endforeach; ?>
							</select>
							<select class="form-control exercise-select-input exercise-select-input-own">
							<?php foreach( $exercises_in_category as $ex ) : ?>
								<?php if( $ex->trainer ) : ?>
								<option
									value="<?php echo esc_attr( $ex->ID ); ?>"
									<?php if( !$ex->trainer ) : ?>data-preclone="true"<?php endif; ?>
								><?php echo esc_html( $ex->name ); ?></option>
								<?php endif; ?>
							<?php endforeach; ?>
							</select>
						</div>
						<div class="form-group input-form-group">
							<input type="text" class="form-control exercise-series-input" placeholder="Series" />
						</div>
						<div class="form-group input-form-group">
							<input type="text" class="form-control exercise-repetitions-input" placeholder="Reps." />
						</div>
						<div class="form-group input-form-group">
							<input type="text" class="form-control exercise-loads-input" placeholder="Cargas" />
						</div>
					</div>
				</div>
				<?php endif; // !empty ?>
			<?php endforeach; ?>
			</div>
		</div>
		<div class="col-xs-12">
			<hr/>
			<h4 class="text-center">Inserta tu vídeo desde una plataforma externa:</h4><div class="video-form-icons"><a target="_blank" href="https://youtube.com" rel="external"><img style="width:80px;height:auto" src="<?php echo get_template_directory_uri(); ?>/img/icons/youtube.png" alt="youtube" /></a><a target="_blank" href="https://vimeo.com" rel="external"><img style="width:80px;height:auto" src="<?php echo  get_template_directory_uri(); ?>/img/icons/vimeo.png" alt="vimeo" /></a></div> <div class="personal-training-training-video-preview new-training-video-preview" style="margin-left:auto;margin-right:auto;width:100%;max-width:640px;"></div>
			<div class="add-training-layer form-group">
				<label>Vídeo</label>
				<input type="text" class="new-training-video form-control" data-video-preview=".new-training-video-preview" />
				<p class="help-block">Introduce el enlace que aparece en Compartir</p>
				<br />
				<label>Observaciones</label>
				<textarea class="new-training-observations form-control"></textarea>

				<div class="checkbox">
					<input type="checkbox" value="yes" class="input-checkbox cool" id="duplicate-this-training">
					<label for="duplicate-this-training"><span class="checker"></span> Si desea que se genere un duplicado de este entrenamiento y se archive en su galería de entrenamientos &quot;Mis Plantillas&quot; para usar en otras ocasiones, marque el recuadro. Este duplicado podrá ser modificado desde su zona de creación sin que se vea afectado el entrenamiento original.</label>
				</div>

				<p class="text-center"><a class="btn btn-primary btn-lg assing-new-created-training" data-member="<?php echo esc_attr( $member_id ); ?>">Asignar <span class="glyphicon glyphicon-chevron-right" href="#"></span></a></p>
			</div>
		</div>

	</div>
</div>

<div class="modal fade" id="clone-exercise-modal" tabindex="-1" role="dialog" aria-labelledby="clone-exercise-modal-label" data-exercise="" data-member="<?php echo esc_attr( $member->ID ); ?>">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="clone-exercise-modal-label">Editar ejercicio</h4>
      </div>
      <div class="modal-body">
      </div>
    </div>
  </div>
</div>

