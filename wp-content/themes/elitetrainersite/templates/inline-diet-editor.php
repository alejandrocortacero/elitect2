<?php defined( 'ABSPATH' ) or die( 'Wrong Access' );
$trainer = empty( $trainer ) ? get_user_by( 'id', $trainer_id ) : $trainer;
$member = empty( $member ) ? get_user_by( 'id', $member_id ) : $member;
?>

<div class="col-xs-12 col-new-diet inline-diet-editor">
	<?php echo EpointPersonalTrainerPublic::get_create_user_diet_form( $member_id ); ?>
</div>

<?php if( false ) : ?>
<div class="col-xs-12 col-new-diet inline-diet-editor">
	<div class="row">
		<div class="col-xs-12">
			<p class="text-center h3">Crea una nueva dieta</p>
		</div>
		<div class="col-xs-12 col-sm-4">
			<div class="select-new-diet-name-layer form-group">
				<label>Nombre de la dieta</label>
				<input type="text" class="new-diet-name-input form-control" />
			</div>
		</div>
		<div class="col-xs-12 col-sm-4">
			<div class="select-new-objectives-layer">
				<label>Objetivos</label>
				<?php foreach( $trainer_objectives as $objective ) : ?>
					<div class="checkbox">
						<input type="checkbox" value="<?php echo esc_attr( $objective->ID ); ?>" class="input-checkbox cool" id="diet-objective-<?php echo esc_attr( $objective->ID ); ?>" />
						<label for="diet-objective-<?php echo esc_attr( $objective->ID ); ?>"><span class="checker"></span> <?php echo esc_html( $objective->name ); ?></label>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
		<div class="col-xs-12 col-sm-4">
			<div class="select-new-restrictions-layer">
				<label>Restricciones</label>
				<?php foreach( $trainer_restrictions as $restriction ) : ?>
					<div class="checkbox">
						<input type="checkbox" value="<?php echo esc_attr( $restriction->ID ); ?>" class="input-checkbox cool" id="diet-restriction-<?php echo esc_attr( $restriction->ID ); ?>" />
						<label for="diet-restriction-<?php echo esc_attr( $restriction->ID ); ?>"><span class="checker"></span> <?php echo esc_html( $restriction->name ); ?></label>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
		<div class="col-xs-12">
			<h3>Horarios</h3>
		</div>
		<div class="col-xs-12">
			<hr/>
			<div class="add-diet-layer form-group">
				<label>Observaciones</label>
				<textarea class="new-diet-observations form-control"></textarea>
				<p class="text-center"><a class="btn btn-primary btn-lg assing-new-created-diet" data-member="<?php echo esc_attr( $member_id ); ?>">Asignar <span class="glyphicon glyphicon-chevron-right" href="#"></span></a></p>
			</div>
		</div>

	</div>
</div>
<?php endif; ?>

<?php if( false ) : ?>
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
<?php endif; ?>
