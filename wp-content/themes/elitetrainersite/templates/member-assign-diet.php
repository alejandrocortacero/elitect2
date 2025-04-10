<?php defined( 'ABSPATH' ) or die('Wrong Access!'); ?>
<h2 class="text-center">Asignar nueva dieta a <?php echo esc_html( $member->display_name ); ?></h2>
<div class="row assign-diet-row">
	<div class="col-xs-12 col-sm-12 col-md-4">
		<div class="form-group text-center">
			<label class="text-center">Fecha de inicio</label>
			<input type="date" class="form-control new-diet-start-date text-center" />
		</div>
	</div>
	<div class="col-xs-12 col-sm-12 col-md-4">
		<div class="form-group text-center">
			<label class="text-center">Fecha de finalización</label>
			<input type="date" class="new-diet-end-date form-control text-center" />
		</div>
	</div>
	<div class="col-xs-12 col-sm-12 col-md-4">
		<div class="form-group text-center">
			<label class="text-center">¿Desde dieta ya creada?</label>
			<select class="new-diet-from form-control">
				<option value="">Seleccionar</option>
				<option value="yes">Sí</option>
				<option value="no">No</option>
			</select>
		</div>
	</div>

	<?php include( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'inline-diet-editor.php' ) ) ); ?>

	<div class="col-xs-12 col-existing-diet">
		<div class="select-objectives-layer form-group">
			<label class="text-center h4">Selecciona un objetivo</label>
			<select class="select-objective-input form-control">
			<?php $trainer_objectives = EpointPersonalTrainerMapper::get_trainer_diet_objectives( $trainer_id ); ?>
				<option value="">Cualquiera</option>
			<?php foreach( $trainer_objectives as $objective ) : ?>
				<option value="<?php echo esc_attr( $objective->ID ); ?>"><?php echo esc_html( $objective->name ); ?></option>
			<?php endforeach; ?>
			</select>
		</div>
		<div class="select-restriction-layer form-group">
			<label class="text-center h4">Selecciona una restricción</label>
			<select class="select-restriction-input form-control">
			<?php $trainer_restrictions = EpointPersonalTrainerMapper::get_trainer_diet_restrictions( $trainer_id ); ?>
				<option value="">Cualquiera</option>
			<?php foreach( $trainer_restrictions as $restriction ) : ?>
				<option value="<?php echo esc_attr( $restriction->ID ); ?>"><?php echo esc_html( $restriction->name ); ?></option>
			<?php endforeach; ?>
			</select>
		</div>
		<div class="select-diet-layer form-group">
			<label class="text-center h4">Selecciona una dieta</label>
			<?php $trainer_diets_items = EpointPersonalTrainerMapper::get_unassigned_trainer_diets( $trainer_id, null, null, 'name', 'ASC' ); ?>
			<div style="display:flex;">
				<select class="select-diet-input form-control">
					<option value="">Selecciona una dieta</option>
				<?php foreach( $trainer_diets_items as $tt ) : ?>
					<option value="<?php echo esc_attr( $tt->ID ); ?>"><?php echo esc_html( $tt->name ); ?></option>
				<?php endforeach; ?>
				</select>
<?php if( false ) : ?>
				<button class="btn btn-default view-diet"><span class="glyphicon glyphicon-eye-open"></span></button>
				<script type="text/javascript">
					jQuery('button.view-diet').click(function(evt){
						evt.preventDefault();
						var b = jQuery(evt.currentTarget);
						var dietId = b.siblings('select').val();

						if( dietId != '' )
						{
							var baseURL = '<?php echo EliteTrainerSiteTheme::get_edit_diet_url( '***' ); ?>';
							var newURL = baseURL.replace('***',dietId);

							window.open(newURL,'_blank');
						}
					});

				</script>
<?php else : ?>
				<button class="btn btn-default view-diet" data-toggle="modal" data-target="#preview-diet-modal"><span class="glyphicon glyphicon-eye-open"></span></button>
				<script type="text/javascript">
				jQuery(document).ready(function(){
					jQuery('.view-diet').prop('disabled', jQuery('.select-diet-input').val() == '' );
					jQuery('.select-diet-input').change(function(evt){
						jQuery('.view-diet').prop('disabled', jQuery('.select-diet-input').val() == '' );
					});
				});
				</script>
<?php endif; ?>
			</div>
		</div>
		<div class="form-group">
			<label class="text-center h4">Observaciones</label>
			<textarea class="new-selected-diet-observations form-control"></textarea>
		</div>
		<p class="text-center"><a class="btn btn-primary btn-lg assing-new-selected-diet" href="#" data-member="<?php echo esc_attr( $member_id ); ?>">Asignar <span class="glyphicon glyphicon-chevron-right"></span></a></p>
	</div>
</div>

