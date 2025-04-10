"use strict";

(function($){
	function viewExercise(evt)
	{
		evt.preventDefault();

		var t = $(evt.currentTarget);
		var exercise = t.data('exercise');

		$.ajax({
			url:TrainerSiteExercises.url,
			method:'POST',
			data:{'action':TrainerSiteExercises.loadExerciseAction, 'exercise':exercise},
			success:function(a,b,c){
				var ex = $(a);
				$('#view-exercise').modal('show');
				$('#view-exercise .modal-body').html(ex);
				ex.find('.edit-exercise').click(editExercise);
				ex.find('.clone-exercise').click(cloneExercise);
				ex.find('.delete-exercise').click(deleteExercise);
			}
		});
	}

	function showAddNewForm(evt)
	{
		var t = $(evt.currentTarget);

		$.ajax({
			url:TrainerSiteExercises.url,
			method:'POST',
			data:{'action':TrainerSiteExercises.getNewExerciseFormAction},
			success:function(a,b,c){
				var f = $(a);
				f.submit(JLCCustomForm.submitForm);
				f.on('addtraining',readAddExerciseEvent);
				$('#edit-exercise .modal-title').text('Nuevo Ejercicio');
				$('#edit-exercise .modal-body').html(f);
				$('#edit-exercise').modal('show');
			}
		});
	}

	function editExercise(evt)
	{
		evt.preventDefault();

		var t = $(evt.currentTarget);
		var exercise = t.data('exercise');

		$('#view-exercise').modal('hide');

		$.ajax({
			url:TrainerSiteExercises.url,
			method:'POST',
			data:{'action':TrainerSiteExercises.editExerciseAction, 'exercise':exercise},
			success:function(a,b,c){
				var f = $(a);
				f.submit(JLCCustomForm.submitForm);
				f.on('updateexercise',readUpdateExerciseEvent);
				$('#edit-exercise .modal-title').text('Editar Ejercicio');
				$('#edit-exercise .modal-body').html(f);
				$('#edit-exercise').modal('show');
			}
		});
	}

	function cloneExercise(evt)
	{
		evt.preventDefault();

		var t = $(evt.currentTarget);
		var exercise = t.data('exercise');

		$.ajax({
			url:TrainerSiteExercises.url,
			method:'POST',
			data:{'action':TrainerSiteExercises.cloneExerciseAction, 'exercise':exercise},
			success:function(a,b,c){
				var ex = $(a);
				$('#my-exercises .exercises').append(ex);
				ex.click(viewExercise);
				$('#view-exercise').modal('hide');
			}
		});
	}

	function deleteExercise(evt)
	{
		evt.preventDefault();

		var t = $(evt.currentTarget);
		var exercise = t.data('exercise');

		$('#view-exercise').modal('hide');

		$.ajax({
			url:TrainerSiteExercises.url,
			method:'POST',
			data:{'action':TrainerSiteExercises.deleteExerciseAction, 'exercise':exercise},
			success:function(a,b,c){
				$('#my-exercises .exercises .exercise[data-exercise="' + a + '"]').remove();
			}
		});
	}

	///////////////////////
	// EVENTS
	///////////////////////

	function readAddExerciseEvent(evt,args)
	{
		$('#edit-exercise').modal('hide');

		$.ajax({
			url:TrainerSiteExercises.url,
			method:'POST',
			data:{'action':TrainerSiteExercises.insertExerciseAction, 'exercise':args['exercise']},
			success:function(a,b,c){
				var ex = $(a);
				$('#my-exercises .exercises').append(ex);
				ex.click(viewExercise);
				$([document.documentElement, document.body]).animate({
					scrollTop: $(ex).offset().top
				}, 1000);
			}
		});

		$('#my-exercises').tab('show');
	}
	
	function readUpdateExerciseEvent(evt,args)
	{
		$('#edit-exercise').modal('hide');

		$.ajax({
			url:TrainerSiteExercises.url,
			method:'POST',
			data:{'action':TrainerSiteExercises.insertExerciseAction, 'exercise':args['exercise']},
			success:function(a,b,c){
				var ex = $(a);
				var exId = ex.data('exercise');
				$('#my-exercises .exercises .exercise[data-exercise="' + exId + '"]').replaceWith(ex);
				ex.click(viewExercise);
			}
		});

		$('#my-exercises').tab('show');
	}

	$(document).ready(function(){
		$('.add-exercise').click(showAddNewForm);

		$('.exercise').click(viewExercise);

		$('form').on('addtraining',readAddExerciseEvent);

		$('form').on('updateexercise',readUpdateExerciseEvent);

		setInterval( function(){ $('.exercises .exercise .images').toggleClass('turned'); }, 4000 );
	});
})(jQuery);
