<?php defined( 'ABSPATH' ) or die( "Wrong access" ); ?>
<div class="modal fade" id="exercise-selector-modal" tabindex="-1" role="dialog" aria-labelledby="exercise-selector-modal-label">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exercise-selector-modal-label">Selecciona ejercicios</h4>
      </div>
      <div class="modal-body">


					<div class="exercises-container">
						<ul class="nav nav-tabs" role="tablist">
							<li role="presentation" class="active"><a href="#my-exercises" aria-controls="my-exercises" role="tab" data-toggle="tab">Mis ejercicios</a></li>
							<li role="presentation"><a href="#preset-exercises" aria-controls="preset-exercises" role="tab" data-toggle="tab">Predefinidos</a></li>
						</ul>

						<div class="tab-content">
							<div role="tabpanel" class="tab-pane active" id="my-exercises">
								<div class="exercises">
								<?php $exercises = EpointPersonalTrainerMapper::get_trainer_exercises( get_current_user_id() ); ?>

									<div class="table-responsive"><table class="table table-striped">
										<thead><tr>
											<th></th>
											<th></th>
											<th></th>
											<th>Nombre</th>
											<th>Categorías</th>
										</tr></thead>
										<tbody>
										<?php foreach( $exercises as $exercise ) : ?>
											<?php $category_ids = EpointPersonalTrainerMapper::get_exercise_related_categories( $exercise->ID, true ); ?>
											<tr class="exercise <?php foreach( $category_ids as $cat_id ) : ?> exercise-category-<?php echo esc_attr( $cat_id ); ?><?php endforeach; ?>">
			<td><input type="checkbox" data-exercise="<?php echo esc_attr( $exercise->ID ); ?>" value="yes" /></td>
			<td><img src="<?php echo $this->get_exercise_image( $exercise, 'start' );  ?>" style="width:50px;" /></td>
			<td><img src="<?php echo $this->get_exercise_image( $exercise, 'end' );  ?>" style="width:50px;" /></td>
			<td><?php echo esc_html( $exercise->name ); ?></td>
			<td>
				<?php $categories = EpointPersonalTrainerMapper::get_exercise_related_categories_names( $exercise->ID ); ?>
				<?php echo implode( ', ', $categories ); ?>
			</td>
											</tr>
										<?php endforeach; ?>
										</tbody>
									</table></div>

								</div>
							</div>

							<div role="tabpanel" class="tab-pane" id="preset-exercises">
								<div class="exercises">
								<?php $exercises = EpointPersonalTrainerMapper::get_preset_exercises(); ?>

									<div class="table-responsive"><table class="table table-striped">
										<thead><tr>
											<th></th>
											<th></th>
											<th></th>
											<th>Nombre</th>
											<th>Categorías</th>
										</tr></thead>
										<tbody>
										<?php foreach( $exercises as $exercise ) : ?>
											<?php $category_ids = EpointPersonalTrainerMapper::get_exercise_related_categories( $exercise->ID, true ); ?>
											<tr class="exercise <?php foreach( $category_ids as $cat_id ) : ?> exercise-category-<?php echo esc_attr( $cat_id ); ?><?php endforeach; ?>">
			<td><input type="checkbox" data-exercise="<?php echo esc_attr( $exercise->ID ); ?>" value="yes" /></td>
			<td><img src="<?php echo $this->get_exercise_image( $exercise, 'start' );  ?>" style="width:50px;" /></td>
			<td><img src="<?php echo $this->get_exercise_image( $exercise, 'end' );  ?>" style="width:50px;" /></td>
			<td><?php echo $exercise->name; ?></td>
			<td>
				<?php $categories = EpointPersonalTrainerMapper::get_exercise_related_categories_names( $exercise->ID ); ?>
				<?php echo implode( ', ', $categories ); ?>
			</td>

											</tr>
										<?php endforeach; ?>
										</tbody>
									</table></div>
								</div>
							</div>
						</div>

					</div><?php //exercises-container ?>
		
		<p class="text-right"><a class="btn btn-primary apply-training-exercises-changes" href="#" rel="nofollow">Aplicar cambios</a></p>

      </div>
    </div>
  </div>
</div>
