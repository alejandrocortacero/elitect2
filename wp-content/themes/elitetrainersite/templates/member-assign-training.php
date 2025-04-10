<?php defined( 'ABSPATH' ) or die('Wrong Access!'); ?>
<h2 class="text-center">Asignar nuevo entrenamiento a <?php echo esc_html( $member->display_name ); ?></h2>
<div class="row assing-training-row">
	<div class="col-xs-12 col-sm-4">
		<div class="form-group text-center">
			<label class="text-center">Fecha de inicio</label>
			<input type="date" class="form-control new-training-start-date text-center" />
		</div>
	</div>
	<div class="col-xs-12 col-sm-4">
		<div class="form-group text-center">
			<label class="text-center">Fecha de finalización</label>
			<input type="date" class="new-training-end-date form-control text-center" />
		</div>
	</div>
	<div class="col-xs-12 col-sm-4">
		<div class="form-group text-center">
			<label class="text-center">¿Desde entrenamiento ya creado?</label>
			<select class="new-training-from form-control">
				<option value="">Seleccionar</option>
				<option value="yes">Sí</option>
				<option value="no">No</option>
			</select>
		</div>
	</div>

	<?php include( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'old-style-training-editor.php' ) ) ); ?>

	<div class="col-xs-12 col-existing-training">
		<div class="select-objectives-layer form-group">
			<label class="text-center h4">Selecciona un objetivo</label>
			<select class="select-objective-input form-control">
			<?php $trainer_objectives = EpointPersonalTrainerMapper::get_trainer_objectives( $trainer_id ); ?>
				<option value="">Cualquiera</option>
			<?php foreach( $trainer_objectives as $objective ) : ?>
				<option value="<?php echo esc_attr( $objective->ID ); ?>"><?php echo esc_html( $objective->name ); ?></option>
			<?php endforeach; ?>
			</select>
		</div>
		<div class="select-environments-layer form-group">
			<label class="text-center h4">Selecciona un entorno</label>
			<select class="select-environment-input form-control">
			<?php $trainer_environments = EpointPersonalTrainerMapper::get_trainer_environments( $trainer_id ); ?>
				<option value="">Cualquiera</option>
			<?php foreach( $trainer_environments as $environment ) : ?>
				<option value="<?php echo esc_attr( $environment->ID ); ?>"><?php echo esc_html( $environment->name ); ?></option>
			<?php endforeach; ?>
			</select>
		</div>
		<div class="select-training-layer form-group">
			<label class="text-center h4">Selecciona un entrenamiento</label>
			<?php $trainer_training_items = EpointPersonalTrainerMapper::get_unassigned_trainer_available_training_items( $trainer_id, null, null, 'name', 'ASC' ); ?>
			<div style="display:flex;">
				<select class="select-training-input form-control">
					<option value="">Selecciona un entrenamiento</option>
				<?php foreach( $trainer_training_items as $tt ) : ?>
					<option value="<?php echo esc_attr( $tt->ID ); ?>"><?php echo esc_html( $tt->name ); ?></option>
				<?php endforeach; ?>
				</select>
				<?php if( false ) : ?>
				<button class="btn btn-default view-training"><span class="glyphicon glyphicon-eye-open"></span></button>
				<script type="text/javascript">
					jQuery('button.view-training').click(function(evt){
						evt.preventDefault();
						var b = jQuery(evt.currentTarget);
						var trainingId = b.siblings('select').val();

						if( trainingId != '' )
						{
							var baseURL = '<?php echo EliteTrainerSiteTheme::get_edit_training_url( '***' ); ?>';
							var newURL = baseURL.replace('***',trainingId);

							window.open(newURL,'_blank');
						}
					});
				</script>
				<?php else : ?>
				<button class="btn btn-default view-training" data-toggle="modal" data-target="#preview-training-modal"><span class="glyphicon glyphicon-eye-open"></span></button>
				<script type="text/javascript">
				jQuery(document).ready(function(){
					jQuery('.view-training').prop('disabled', jQuery('.select-training-input').val() == '' );
					jQuery('.select-training-input').change(function(evt){
						jQuery('.view-training').prop('disabled', jQuery('.select-training-input').val() == '' );
					});
				});
				</script>
				<?php endif; ?>
			</div>
			<p>Aquí tienes todos los entrenamientos que tienes guardados en tu zona de plantillas, si quieres que aparezcan los predefinidos o los que tienes guardados en tu listado de asignados, solo tienes que duplicarlos desde tu zona de creación (botón de zona de creación).</p>
		</div>
		<h4 class="text-center">Inserta tu vídeo desde una plataforma externa:</h4><div class="video-form-icons"><a target="_blank" href="https://youtube.com" rel="external"><img style="width:80px;height:auto" src="<?php echo get_template_directory_uri(); ?>/img/icons/youtube.png" alt="youtube" /></a><a target="_blank" href="https://vimeo.com" rel="external"><img style="width:80px;height:auto" src="<?php echo  get_template_directory_uri(); ?>/img/icons/vimeo.png" alt="vimeo" /></a></div> <div class="personal-training-training-video-preview assigned-training-video-preview" style="margin-left:auto;margin-right:auto;width:100%;max-width:640px;"></div>
		<div class="form-group">
			<label class="text-center h4">Video</label>
			<input type="text" class="new-selected-training-video video-input-updatable form-control" value="" data-video-preview=".assigned-training-video-preview" />
		</div>
		<div class="form-group">
			<label class="text-center h4">Observaciones</label>
			<textarea class="new-selected-training-observations form-control"></textarea>
		</div>
		<p class="text-center"><a class="btn btn-primary btn-lg assing-new-selected-training" href="#" data-member="<?php echo esc_attr( $member_id ); ?>">Asignar <span class="glyphicon glyphicon-chevron-right"></span></a></p>
	</div>
</div>
