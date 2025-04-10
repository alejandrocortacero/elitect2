<?php defined( 'ABSPATH' ) or die('Wrong Access!');
$member_id = isset( $_GET['member'] ) ? (int)$_GET['member'] : null;
$member = get_user_by( 'ID', $member_id );

$trainer_id = get_current_user_id();
$trainer_environments = EpointPersonalTrainerMapper::get_trainer_environments( $trainer_id );
$trainer_objectives = EpointPersonalTrainerMapper::get_trainer_objectives( $trainer_id );

setCookie( EliteTrainerSiteTheme::LAST_PAGE_COOKIE, 'view-member-training', time() + 24*60*60*1000, '/' );

add_filter( 'body_class', function( $classes, $class ){ $classes[] = 'page-view-member-training'; return $classes; }, 10, 2 );

 ?><?php get_header( 'noopen' ); ?>
<div class="container">
	<?php if( $member && have_posts() ) : the_post(); ?>
		<div class="row">
			<div class="col-xxs-12 col-xs-12 user-training-col">
				<div class="row">
					<div class="col-xs-12 page-content">
						<p class="text-right"><a class="btn btn-primary" href="<?php echo EliteTrainerSiteTheme::get_edit_member_url( $member_id ); ?>">Volver al perfil</a></p>
						<h1 class="text-center">
							<span>Entrenamientos de <?php echo esc_html( $member->display_name ); ?></span>
							<?php EliteTrainerSiteThemeCustomizer::print_edit_button( 'usertrainingstyle' ); ?>
						</h1>
					<?php if( class_exists( 'EpointPersonalTrainer', false ) ) : ?>
						<?php $training_items = EpointPersonalTrainerMapper::get_user_training_items( $member_id, null, null, 'start', 'desc' ); ?>
						<?php if( !empty( $training_items ) ) : ?>
							<?php foreach( $training_items as $tt ) : ?>
								<?php include( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'templates', 'member-training-row.php' ) ) ); ?>
							<?php endforeach; ?>

						<?php else : ?>
							<p>No hay entrenamientos asignados.</p>
						<?php endif; ?>

						<?php include( implode( DIRECTORY_SEPARATOR, array( __DIR__, 'templates', 'member-assign-training.php' ) ) ); ?>

						
					<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	<?php else : ?>
		<h1><?php echo esc_html( __( 'Not found.', EliteTrainerSiteTheme::TEXT_DOMAIN ) ); ?></h1>
	<?php endif; ?>
</div>

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
	  var modal = $(this);
	  var button = $(event.relatedTarget);
	  //var trainingId = button.data('training');
	  var trainingId = button.siblings('.select-training-input').val();
	  if(trainingId == '')
	  {
		modal.modal('hide');
		return;
	  }


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
})(jQuery);
</script>

<script type="text/javascript">
(function($){
	$('.hide-training').click(function(evt){
		evt.preventDefault();
		var l = $(evt.currentTarget);

		if( l.data('active') )
		{
			if( confirm( 'Si utilizas esta opción, tu cliente no podra ver este entrenamiento.' ) )
				window.location = l.attr('href');
		}
		else
		{
			window.location = l.attr('href');
		}
	});
})(jQuery);
</script>

<?php if( false ) : // enable clear full exercise historial ?>
<script type="text/javascript">
(function($){
	$('.clear-exercise-historial').click( function(evt) {

		evt.preventDefault();

		var but = $(evt.currentTarget);

		var e = but.data('exercise');	
		var t = but.data('training');	

		if( typeof e == 'undefined' || e == '' || typeof t == 'undefined' || t == '' )
			return;

		$.ajax({
			url: '<?php echo admin_url( 'admin-ajax.php' ); ?>',
			type: 'POST',
			data: {
				'action':'<?php echo EpointPersonalTrainerPublic::CLEAR_EXERCISE_HISTORIAL_ACTION; ?>',
				'training' : t,
				'exercise' : e
			},
			beforeSend:function(){
			},
			success:function(a,b,c){
				if( a == 'deleted' )
				{
					but.closest('.historial').find('.historial-row-prev-data').remove();
				}
			},
			error:function(a,b,c){
			}
		});
	});
})(jQuery);
</script>
<?php endif; ?>
<script type="text/javascript">
(function($){
	$('.clear-exercise-historial-element').click( function(evt) {

		evt.preventDefault();

		var but = $(evt.currentTarget);

		var e = but.data('exercise');	
		var t = but.data('training');	
		var s = but.data('saved');	

		if( typeof e == 'undefined' || e == '' || typeof t == 'undefined' || t == '' || typeof s == 'undefined' || s == '' )
			return;

		$.ajax({
			url: '<?php echo admin_url( 'admin-ajax.php' ); ?>',
			type: 'POST',
			data: {
				'action':'<?php echo EpointPersonalTrainerPublic::DELETE_EXERCISE_HISTORIAL_ELEMENT_ACTION; ?>',
				'training' : t,
				'exercise' : e,
				'saved': s
			},
			beforeSend:function(){
				but.closest('.historial-row').remove();
			},
			success:function(a,b,c){
				if( a == 'deleted' )
				{
				}
			},
			error:function(a,b,c){
			}
		});
	});
})(jQuery);
</script>


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

	function updatedVideoField(evt)
	{
		var f = $(evt.currentTarget);
		var v = f.val();
		var m,r;
		
		m = v.match(/^https:\/\/youtu\.be\/(.*)$/);
		if( m )
		{
			r = '<iframe width="560" height="315" src="https://www.youtube.com/embed/' + m[1] + '" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
		}
		else if( ( m = v.match(/^https:\/\/vimeo\.com\/(.*)$/) ) )
		{
			r = '<iframe src="https://player.vimeo.com/video/' + m[1] + '" width="640" height="360" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>';
		}
		else
		{
			r = '';
		}

		if(f.data('video-preview'))
			$(f.data('video-preview')).html(r);
		else
			$('.personal-training-training-video-preview').html(r);
	}

	$(document).ready(function(){
		$('.video-input-updatable').on('input', updatedVideoField);
		$('.video-input-updatable').trigger('input');

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
			var video = $('.new-selected-training-video').val();

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
				'video': video,
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
			var video = $('.new-training-video').val();

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
						//newexdata['id'] = newex.find('.exercise-select-input').val();
						var newexId = newex.find('.exercise-select-input-own').hasClass('active-selector') ? newex.find('.exercise-select-input-own').val() : newex.find('.exercise-select-input-preset').val();
console.log( newex.find('.exercise-select-input-own').hasClass('active-selector') + '---' + newex.find('.exercise-select-input-own').val() + '---' + newex.find('.exercise-select-input-preset').val() + '---' +  newexId);
						newexdata['id'] = newexId;
						newexdata['series'] = newex.find('.exercise-series-input').val();
						newexdata['repetitions'] = newex.find('.exercise-repetitions-input').val();
						newexdata['loads'] = newex.find('.exercise-loads-input').val();

						//exercises[newcat][newex.find('.exercise-select-input').val()] = newexdata;
						exercises[newcat][newexId] = newexdata;
					});
				}
			});

			var duplicate = $('#duplicate-this-training').is(':checked');

			var postData = {
				'action':'<?php echo EliteTrainerSiteTheme::CREATE_AND_ASSIGN_TRAINING_ACTION; ?>',
				//'training': training,
				'name': nameInput.val(),
				'objectives': objectives,
				'environments': environments,
				'exercises': exercises,
				'member': member,
				'observations': observations,
				'video': video,
				'start': startInput.val(),
				'end': endInput.val(),
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
<?php //get_template_part( 'templates/contact', 'container' ); ?>
<?php get_footer( 'noclose' ); ?>
