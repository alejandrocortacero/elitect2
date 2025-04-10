<?php defined( 'ABSPATH' ) or die('Wrong Access!'); 
//add_filter( 'body_class', function( $classes ){ $classes[] = 'no-padding';return $classes; } );

$training_id = isset( $_GET['training'] ) ? (int)$_GET['training'] : null;
$training = $training_id && class_exists( 'EpointPersonalTrainerMapper', false ) ? EpointPersonalTrainerMapper::get_training( $training_id ) : null;

$referer = !empty( $_SERVER['HTTP_REFERER'] ) ? $_SERVER['HTTP_REFERER'] : '';
$from_member = preg_match( '/trainersite-view-member-training/', $referer );

$trainer_id = get_current_user_id();
$member_id = $training ? $training->user : null;

$trainer_environments = EpointPersonalTrainerMapper::get_trainer_environments( $trainer_id );
$trainer_objectives = EpointPersonalTrainerMapper::get_trainer_objectives( $trainer_id );

$training_exercises = $training ? EpointPersonalTrainerMapper::get_training_exercises( $training->ID ) : null;

$saved_cookie = !empty( $_COOKIE['updated-training'] ) ? $_COOKIE['updated-training'] : null;
if( $saved_cookie )  setCookie( 'updated-training', '', time() - 3600 );

$training_items = EpointPersonalTrainerMapper::get_preset_training_items();

$page_url = get_permalink( get_option( PersonalTrainerTheme::SUPERTRAINER_PAGE_TRAINING_KEY ) );

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

wp_enqueue_script(
	'elitetrainertheme-old-style-training-editor-script',
	get_template_directory_uri() . '/js/old-style-training-editor.js',
	array( 'jquery' ),
	PersonalTrainerTheme::get_version(),
	true
);
wp_localize_script(
	'elitetrainertheme-old-style-training-editor-script',
	'OldStyleTrainingEditorNS',
	array(
		'ajaxUrl' => admin_url( 'admin-ajax.php' ),
		'cloneExerciseAction' => EpointPersonalTrainerPublic::GET_CLONE_EXERCISE_AND_ASSING_FORM_ACTION
	)
);
?><?php
get_header('noopen');
?>
<?php if( empty( $_GET['training'] ) ) : ?>
<div class="container">
	<div class="row">
		<div class="col-xs-12">
			<h1 class="text-center">Entrenamientos - Super</h1>
			<p><a href="<?php echo $page_url; ?>?training=new">Nuevo</a></p>
			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th>Nombre</th>
					</tr>
				</thead>
				<tbody>
				<?php foreach( $training_items as $tt ) : ?>
					<tr>
						<td><a href="<?php echo $page_url; ?>?training=<?php echo $tt->ID; ?>"><?php echo esc_html( $tt->name ); ?></a></td>
					</tr>
				<?php endforeach; ?>
				</tbody>
			</table>
				
		</div>
	</div>
</div>
<?php else : ?>
<?php
$training = $_GET['training'] != 'new' ? EpointPersonalTrainerMapper::get_training( (int)$_GET['training'] ) : null;
?>
<?php if( !$training  || ( $training && !$training->trainer ) ) : ?>
<?php
?>
<div class="container old-style-editor-container">
	<div class="row">
		<div class="col-xs-12">
			<h1><?php if( $training ) : ?><?php echo esc_html( $training->name ); ?><?php else : ?>Nuevo entrenamiento<?php endif; ?></h1>

			<?php if( $saved_cookie ) : ?>
				<p class="alert alert-success"><?php if( $saved_cookie == 'created' ) : ?>Entrenamiento creado satisfactoriamente<?php else : ?>Entrenamiento guardado satisfactoriamente<?php endif; ?></p>
			<?php endif; ?>

<?php //EDITOR ?>
					<div class="row edit-training-row">

<div class="col-xs-12 col-new-training old-style-training-editor">
	<div class="row">
		<div class="col-xs-12 col-sm-4">
			<div class="select-new-training-name-layer form-group">
				<label>Nombre del entrenamiento</label>
				<input type="text" class="new-training-name-input form-control" value="<?php echo $training ? $training->name : ''; ?>" />
			</div>
		</div>
		<div class="col-xs-12 col-sm-4">
			<div class="select-new-objectives-layer">
				<label>Objetivos</label>
				<?php foreach( $trainer_objectives as $objective ) : ?>
					<div class="checkbox">
						<input type="checkbox"
							value="<?php echo esc_attr( $objective->ID ); ?>"
							class="input-checkbox cool"
							id="training-objective-<?php echo esc_attr( $objective->ID ); ?>"
							<?php if( $training && EpointPersonalTrainerMapper::is_training_objective( $training->ID, $objective->ID ) ) : ?>
								checked="checked"
							<?php endif; ?>
						/>
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
						<input type="checkbox"
							value="<?php echo esc_attr( $environment->ID ); ?>"
							class="input-checkbox cool"
							id="training-environment-<?php echo esc_attr( $environment->ID ); ?>"
							<?php if( $training && EpointPersonalTrainerMapper::is_training_environment( $training->ID, $environment->ID ) ) : ?>
								checked="checked"
							<?php endif; ?>
						/>
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
				<div class="exercise-category"
					data-category="<?php echo esc_attr( $tcat->ID ); ?>"
					id="exercise-category-<?php echo esc_attr( $tcat->ID ); ?>"
				>
					<div class="name"><div class="dragger" ><span class="glyphicon glyphicon-menu-hamburger"></span></div><button class="btn btn-primary add-exercise-in-category"><span class="glyphicon glyphicon-plus"></span></button> <div class="text"><?php echo esc_html( $tcat->name ); ?></div> </div>

					<?php $exercises_in_category = EpointPersonalTrainerMapper::get_exercises_in_category_objects( $tcat->ID, $trainer_id, $member_id ); ?>
					<?php $exercises_in_category_b = $exercises_in_category; ?>
					<div class="exercises">
					<?php if( is_array( $training_exercises ) ) : ?>
<?php foreach( $exercises_in_category_b as $c_ex ) : ?>
	<?php foreach( $training_exercises as $t_ex ) : ?>
		<?php if( $t_ex->ID == $c_ex->ID ) : ?>
				<div class="exercise">
					<div class="edit-exercise">
						<button class="btn btn-primary clone-exercise-for-category"><span class="glyphicon glyphicon-pencil"></span></button>
					</div>
					<div class="remove-layer">
						<button class="btn btn-danger remove-exercise-from-category"><span class="glyphicon glyphicon-trash"></span></button>
					</div>
					<div class="form-group select-form-group">
						<select class="form-control exercise-select-input">
						<?php foreach( $exercises_in_category as $ex ) : ?>
							<option
								value="<?php echo esc_attr( $ex->ID ); ?>"
								<?php if( $ex->ID == $t_ex->ID ) : ?>selected="selected"<?php endif; ?>
							><?php echo esc_html( $ex->name ); ?></option>
						<?php endforeach; ?>
						</select>
					</div>
					<div class="form-group input-form-group">
						<input type="text" class="form-control exercise-series-input" placeholder="Series" value="<?php echo esc_attr( $t_ex->series ); ?>" />
					</div>
					<div class="form-group input-form-group">
						<input type="text" class="form-control exercise-repetitions-input" placeholder="Reps." value="<?php echo esc_attr( $t_ex->repetitions ); ?>" />
					</div>
					<div class="form-group input-form-group">
						<input type="text" class="form-control exercise-loads-input" placeholder="Cargas" value="<?php echo esc_attr( $t_ex->loads ); ?>" />
					</div>
				</div>
			<?php break; ?>
		<?php endif; ?>
	<?php endforeach; ?>
<?php endforeach; ?>
					<?php endif; ?>
					</div>
					<div class="exercise-template">
						<div class="edit-exercise">
							<button class="btn btn-primary clone-exercise-for-category"><span class="glyphicon glyphicon-pencil"></span></button>
						</div>
						<div class="remove-layer">
							<button class="btn btn-danger remove-exercise-from-category"><span class="glyphicon glyphicon-trash"></span></button>
						</div>
						<div class="form-group select-form-group">
							<select class="form-control exercise-select-input">
							<?php foreach( $exercises_in_category as $ex ) : ?>
								<option value="<?php echo esc_attr( $ex->ID ); ?>"><?php echo esc_html( $ex->name ); ?></option>
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
			<div class="add-training-layer form-group">
				<label>Observaciones</label>
				<textarea class="new-training-observations form-control"><?php if( $training ) echo esc_html( $training->observations ); ?></textarea>

				<div class="checkbox">
					<input type="checkbox" value="yes" class="input-checkbox cool" id="duplicate-this-training">
					<label for="duplicate-this-training"><span class="checker"></span> Si desea que se genere un duplicado de este entrenamiento y se archive en su galería de entrenamientos &quot;Mis Plantillas&quot; para usar en otras ocasiones, marque el recuadro. Este duplicado podrá ser modificado desde su zona de creación sin que se vea afectado el entrenamiento original.</label>
				</div>

				<p class="text-center"><a class="btn btn-primary btn-lg save-training" data-member="<?php echo esc_attr( $member_id ); ?>" data-training="<?php echo esc_attr( $training->ID ); ?>">Guardar</a></p>
			</div>
		</div>

	</div>
</div>



					</div>
<?php // EDITOR ?>


		</div>
	</div>
</div>
<div class="modal fade" id="clone-exercise-modal" tabindex="-1" role="dialog" aria-labelledby="clone-exercise-modal-label" data-exercise="" data-member="<?php echo esc_attr( $member_id ); ?>">
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

<script type="text/javascript">
(function($){

	$(document).ready(function(){

		$('.save-training').click(function(evt){

			evt.preventDefault();
			var t = $(evt.currentTarget);
			var member = t.data('member');
			var trainingId = t.data('training');

			var observations = $('.new-training-observations').val();

			var nameInput = $('.new-training-name-input');


			if( nameInput.val() == '' )
			{
				nameInput.focus();
				nameInput.closest('.form-group').addClass('has-error');
				$("body,html").animate( { scrollTop: nameInput.offset().top - 200 }, 800 );
				return;
			}
/*
			var startInput = $('.new-training-start-date');
			var endInput = $('.new-training-end-date');

			if( startInput.val() == '' )
			{
				startInput.focus();
				startInput.closest('.form-group').addClass('has-error');
				$("body,html").animate( { scrollTop: startInput.offset().top - 200 }, 800 );
				return;
			}
			if( endInput.val() == '' )
			{
				endInput.focus();
				endInput.closest('.form-group').addClass('has-error');
				$("body,html").animate( { scrollTop: endInput.offset().top - 200 }, 800 );
				return;
			}
*/
			var objectives = [];
			$('.select-new-objectives-layer input[type="checkbox"]:checked').each(function(ind,elem){
				objectives.push($(elem).val());
			});

			var environments = [];
			$('.select-new-environments-layer input[type="checkbox"]:checked').each(function(ind,elem){
				environments.push($(elem).val());
			});

			var exercises = {};
			$('.old-style-training-editor .exercise-category').each(function(ind,elem){
				var cat = $(elem);
				var exer = cat.find('.exercises .exercise');
				if(exer.length > 0 )
				{
					var newcat = cat.data('category');
					exercises[newcat] = {};
					exer.each(function(ind,elem){
						var newex = $(elem);
						var newexdata = {}
						newexdata['id'] = newex.find('.exercise-select-input').val();
						newexdata['series'] = newex.find('.exercise-series-input').val();
						newexdata['repetitions'] = newex.find('.exercise-repetitions-input').val();
						newexdata['loads'] = newex.find('.exercise-loads-input').val();

						exercises[newcat][newex.find('.exercise-select-input').val()] = newexdata;
					});
				}
			});

			var duplicate = $('#duplicate-this-training').is(':checked');

			var postData = {
				'action':'<?php echo PersonalTrainerTheme::SAVE_TRAINING_ACTION; ?>',
				'training': trainingId,
				'name': nameInput.val(),
				'objectives': objectives,
				'environments': environments,
				'exercises': exercises,
				'member': member,
				'observations': observations,
//				'start': startInput.val(),
//				'end': endInput.val(),
				'duplicate': duplicate ? 'yes' : 'no'
			};

			$.ajax({
				url: '<?php echo admin_url( 'admin-ajax.php' ); ?>',
				type: 'POST',
				data: postData,
				//contentType: false,
				//processData: false,
				complete:function(){
					//cc.removeClass('loading');
				},
				success: function(a,b,c){

					//var r = JLCCustomForm.parseWPAjax(a);
					//$('.assigned-training-table tbody').append(r[0].data);

					window.location.reload(true);
				},
				error: function(a,b,c)
				{
					alert('Hubo un error');
				}
			});


		});
	});
})(jQuery);
</script>

<?php endif; // trainer ?>
<?php endif; ?>
<?php get_footer('noclose'); ?>

