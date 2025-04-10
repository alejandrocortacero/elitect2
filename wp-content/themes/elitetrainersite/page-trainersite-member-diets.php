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


$trainer_restrictions = EpointPersonalTrainerMapper::get_trainer_diet_restrictions( $trainer_id );
$trainer_objectives = EpointPersonalTrainerMapper::get_trainer_diet_objectives( $trainer_id );

add_filter( 'body_class', function( $classes, $class ){ $classes[] = 'page-view-member-diets'; return $classes; }, 10, 2 );

 ?><?php get_header( 'noopen' ); ?>
<div class="container">
	<?php if( $member && have_posts() ) : the_post(); ?>
		<div class="row">
			<div class="col-xxs-12 col-xs-12">
				<p class="text-right"><a class="btn btn-primary" href="<?php echo EliteTrainerSiteTheme::get_my_account_url(); ?>">Volver al perfil</a></p>
				<h1 class="text-center">Dietas de <?php echo esc_html( $member->display_name ); ?></h1>
				<?php if( class_exists( 'EpointPersonalTrainer', false ) ) : ?>
					<?php $diet_items = EpointPersonalTrainerMapper::get_user_diets( $member_id, null, null, 'start', 'desc' ); ?>
					<?php if( !empty( $diet_items ) ) : ?>
						<?php foreach( $diet_items as $tt ) : ?>
							<?php include( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'templates', 'member-diet-row.php' ) ) ); ?>
						<?php endforeach; ?>

					<?php else : ?>
						<p>No hay dietas asignadas.</p>
					<?php endif; ?>

				<?php endif; ?>
			</div>
		</div>
	<?php else : ?>
		<h1><?php echo esc_html( __( 'Not found.', EliteTrainerSiteTheme::TEXT_DOMAIN ) ); ?></h1>
	<?php endif; ?>
</div>

<?php if( false ) : ?>
<script type="text/javascript">
(function($){
	function filterPresetTrainingItems()
	{
		var o = $('.select-objective-input').val();
		var e = $('.select-restriction-input').val();


		$.ajax({
			url: '<?php echo admin_url('admin-ajax.php'); ?>',
			type: 'POST',
			data: {'objective':o,'restriction':e,'action':'<?php echo EliteTrainerSiteTheme::GET_AVAILABLE_DIET_ITEMS_ACTION; ?>'},
			complete:function(){
			},
			success: function(a,b,c){
				var t = $('.select-diet-input');
				var a = JSON.parse(a);
				t.children('option[value!=""]').remove();
				for( var i in a )
					t.append('<option value="' + a[i].ID + '">' + a[i].name + '</option>');
			}
		});
	}

	$(document).ready(function(){

		$('.select-objective-input').change(filterPresetTrainingItems);
		$('.select-restriction-input').change(filterPresetTrainingItems);

		$('.new-diet-from').val('');

		$('.new-diet-from').change(function(evt){
			var a = $(evt.currentTarget);
			var b = a.val();
			if( b == 'yes' )
			{
				$('.col-new-diet').hide();
				$('.col-existing-diet').show();
			}
			else
			{
				$('.col-new-diet').show();
				$('.col-existing-diet').hide();
			}
		});

		$('.new-diet-start-date').change(function(evt){
			var inp = $(evt.currentTarget);
			$('form input[name="start"]').val(inp.val());
		});

		$('.new-diet-end-date').change(function(evt){
			var inp = $(evt.currentTarget);
			$('form input[name="end"]').val(inp.val());
		});

		//$('.select-objective-input').change(filterPresetDietItems);
		//$('.select-restriction-input').change(filterPresetDietItems);

		$('.assing-new-selected-diet').click(function(evt){

			evt.preventDefault();
			var t = $(evt.currentTarget);
			var dietInput = $('.select-diet-input');
			var diet = dietInput.val();
			if( diet == '' )
			{
				dietInput.focus();
				dietInput.closest('.form-group').addClass('has-error');
				$("body,html").animate( { scrollTop: dietInput.offset().top - 200 }, 800 );
				return;
			}
			var member = t.data('member');

			var observations = $('.new-selected-diet-observations').val();

			var startInput = $('.new-diet-start-date');
			var endInput = $('.new-diet-end-date');

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

			var postData = {
				'action':'<?php echo EliteTrainerSiteTheme::ASSIGN_DIET_ACTION; ?>',
				'diet': diet,
				'member': member,
				'observations': observations,
				'start': startInput.val(),
				'end': endInput.val()
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
<?php endif; ?>


<?php if( false ) : ?>
<div class="modal fade" id="remove-training-modal" tabindex="-1" role="dialog" aria-labelledby="remove-training-modal-label">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="remove-training-modal-label">Eliminar entrenamiento</h4>
      </div>
      <div class="modal-body">
			<p>¿Está seguro de eliminar este entrenamiento?</p>
			<div class="options">
				<button type="button" class="btn btn-danger confirm-training-removal" data-training="">Sí</button>
				<button type="button" class="btn" data-dismiss="modal">No</button>
			</div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
(function($){
	function filterPresetTrainingItems()
	{
		var o = $('.select-objective-input').val();
		var e = $('.select-environment-input').val();


		$.ajax({
			url: '<?php echo admin_url('admin-ajax.php'); ?>',
			type: 'POST',
			data: {'objective':o,'environment':e,'action':'<?php echo EliteTrainerSiteTheme::GET_AVAILABLE_TRAINING_ITEMS_ACTION; ?>'},
			complete:function(){
			},
			success: function(a,b,c){
				var t = $('.select-training-input');
				var a = JSON.parse(a);
				t.children('option[value!=""]').remove();
				for( var i in a )
					t.append('<option value="' + a[i].ID + '">' + a[i].name + '</option>');
			}
		});
	}

	$(document).ready(function(){

		// Training list
		$('.training-row .remove-training').click(function(evt){
			var b = $(evt.currentTarget);
			var r = b.closest('.training-row');
			var t = r.data('training');

			$('#remove-training-modal .confirm-training-removal').data('training', t);
			$('#remove-training-modal').modal('show');
		});

		$('#remove-training-modal .confirm-training-removal').click(function(evt){
			
			var b = $(evt.currentTarget);
			var t = b.data('training');

			if( t != '' )
			{
				window.location.href = '<?php echo admin_url( 'admin-post.php' ); ?>?action=<?php echo EliteTrainerSiteTheme::DELETE_TRAINING_ACTION; ?>&training=' + t;
			}
		});

		// Training form
		$('.new-training-from').val('');
		$('.select-objective-input').val('');
		$('.select-environment-input').val('');
		$('.select-training-input').val('');
		$('.new-training-from').change(function(evt){
			var a = $(evt.currentTarget);
			var b = a.val();
			if( b == 'yes' )
			{
				$('.col-new-training').hide();
				$('.col-existing-training').show();
			}
			else
			{
				$('.col-new-training').show();
				$('.col-existing-training').hide();
			}
		});
		$('.select-objective-input').change(filterPresetTrainingItems);
		$('.select-environment-input').change(filterPresetTrainingItems);

		$('.assing-new-selected-training').click(function(evt){

			evt.preventDefault();
			var t = $(evt.currentTarget);
			var trainingInput = $('.select-training-input');
			var training = trainingInput.val();
			if( training == '' )
			{
				trainingInput.focus();
				trainingInput.closest('.form-group').addClass('has-error');
				$("body,html").animate( { scrollTop: trainingInput.offset().top - 200 }, 800 );
				return;
			}
			var member = t.data('member');

			var observations = $('.new-selected-training-observations').val();

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

			var postData = {
				'action':'<?php echo EliteTrainerSiteTheme::ASSIGN_TRAINING_ACTION; ?>',
				'training': training,
				'member': member,
				'observations': observations,
				'start': startInput.val(),
				'end': endInput.val()
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


		$('.assing-new-created-training').click(function(evt){

			evt.preventDefault();
			var t = $(evt.currentTarget);
/*
			var trainingInput = $('.select-training-input');
			var training = trainingInput.val();
			if( training == '' )
			{
				trainingInput.focus();
				trainingInput.closest('.form-group').addClass('has-error');
				$("body,html").animate( { scrollTop: trainingInput.offset().top - 200 }, 800 );
				return;
			}
*/
			var member = t.data('member');

			var observations = $('.new-training-observations').val();

			var nameInput = $('.new-training-name-input');

			if( nameInput.val() == '' )
			{
				nameInput.focus();
				nameInput.closest('.form-group').addClass('has-error');
				$("body,html").animate( { scrollTop: nameInput.offset().top - 200 }, 800 );
				return;
			}

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

			var postData = {
				'action':'<?php echo EliteTrainerSiteTheme::CREATE_AND_ASSIGN_TRAINING_ACTION; ?>',
				//'training': training,
				'name': nameInput.val(),
				'objectives': objectives,
				'environments': environments,
				'exercises': exercises,
				'member': member,
				'observations': observations,
				'start': startInput.val(),
				'end': endInput.val()
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
<?php
	wp_enqueue_script(
		'elitetrainertheme-old-style-training-editor-script',
		get_template_directory_uri() . '/js/old-style-training-editor.js',
		array( 'jquery' ),
		EliteTrainerSiteTheme::get_version(),
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
?>
<?php endif; ?>
<?php //get_template_part( 'templates/contact', 'container' ); ?>
<?php get_footer( 'noclose' ); ?>


