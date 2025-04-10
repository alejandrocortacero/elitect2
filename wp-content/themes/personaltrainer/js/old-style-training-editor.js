"use strict";
(function($){

var draggingTrainingCategory = null;

$(document).ready(function(){
	function draggerTouchStart(evt)
	{
		evt.preventDefault();
		draggingTrainingCategory = evt.currentTarget;
		//testimoniesCarouselTouchStartX = evt.originalEvent.changedTouches[0].screenX;
	}
	function draggerTouchEnd(evt)
	{
		if( draggingTrainingCategory )
		{
			var t = evt.originalEvent.changedTouches[0];
			var elem = $(document.elementFromPoint(t.clientX, t.clientY));
			var d = $(draggingTrainingCategory).closest('.exercise-category');
			d.insertAfter(elem.hasClass('.exercise-category') ? elem : elem.closest('.exercise-category') );

			d.removeClass('hovering');
			d.siblings().removeClass('hovering');
			
		}


		draggingTrainingCategory = null;
	}

	function draggerTouchMove(evt)
	{
		if( draggingTrainingCategory )
		{
			var t = evt.originalEvent.changedTouches[0];
	//console.log($(evt.currentTarget).closest('.categories').position().top + ' - ' + $(evt.currentTarget).closest('.categories').height() );
			var n = $(document.elementFromPoint(t.clientX, t.clientY));
			n.addClass('hovering');
			n.siblings().removeClass('hovering');
		}
	}

	function eliteTrainerSiteThemeUpdateTrainingExerciseOptionsStatus(ec)
	{

		var aux = $(ec);
		if( !aux.hasClass('exercise-category' ) )
		{
			ec = $(ec.currentTarget).closest('.exercise-category');
		}

		ec.find('.exercises .exercise-select-input option').prop('disabled', false)
		var exercises = ec.find('.exercises .exercise');
		exercises.each(function(ind,elem){

			var sel = $(elem);
			var v = sel.find('.exercise-select-input').val();
if( v !== null )
{
			sel.siblings('.exercise').each(function(ind2,elem2){

				var sel2 = $(elem2);
				sel2.find('.exercise-select-input option[value="' + v + '"]').prop('disabled', true);
			});
}
		});
	}

	$('.old-style-training-editor .categories .exercise-category .name .add-exercise-in-category').click(function(evt){
		evt.preventDefault();
		var b = $(evt.currentTarget);
		var ec = b.closest('.exercise-category');
		var n = ec.find('.exercise-template').clone(true);
		n.removeClass('exercise-template').addClass('exercise');
		ec.find('.exercises').append(n);

		eliteTrainerSiteThemeUpdateTrainingExerciseOptionsStatus(ec);

		var dis = n.find('.exercise-select-input option:disabled');
		var tot = n.find('.exercise-select-input option');
		if( dis.length < tot.length )
		{
			tot.each(function(ind,elem){
				var op = $(elem);
				if(!op.prop('disabled'))
				{
					n.find('.exercise-select-input').val(op.attr('value'));
					return false;
				}
			});
		}
		else
		{
			n.remove();
		}

		eliteTrainerSiteThemeUpdateTrainingExerciseOptionsStatus(ec);
	});

	
	$('.old-style-training-editor .categories .exercise-category .exercise-select-input').change(eliteTrainerSiteThemeUpdateTrainingExerciseOptionsStatus);

	$('.old-style-training-editor .categories .exercise-category .remove-exercise-from-category').click(function(evt){
		evt.preventDefault();
		var b = $(evt.currentTarget);
		var e = b.closest('.exercise');
		var ec = e.closest('.exercise-category');
		var v = e.find('.exercise-select-input').val();
		e.remove();

		ec.find('.exercises .exercise-select-input option[value="' + v + '"]').prop('disabled', false)
	});

	$('#clone-exercise-modal').on('show.bs.modal',function(evt){
		var modal = $(this);
		var bod = modal.find('.modal-body');
		var ex = modal.data('exercise');
		var mem = modal.data('member');

		bod.html('');

		$.ajax({
			url: OldStyleTrainingEditorNS.ajaxUrl,
			type: 'POST',
			data: {'exercise':ex,'member':mem,'action':OldStyleTrainingEditorNS.cloneExerciseAction},
			complete:function(){
			},
			success: function(a,b,c){
				bod.html(a);
				bod.find('form.jlc-custom-ajax-form').submit( JLCCustomForm.submitForm );
				bod.find('.jlc-custom-ajax-field').change( JLCCustomForm.changedField );
				JLCCustomFormUploadAjaxImage.initialize(bod);
			}
		});
	});

	$(document).on('cloneAndAssingFormImageChanged',function(evt,args){
		var f = $('#clone-exercise-modal .modal-body form');
		var inp = f.find('input[name="' + args.field + '_changed"]');
		inp.val(args.image);
	});

	$(document).on('assignexercisetocategory',function(evt,args){
		var sel = $('.old-style-training-editor .categories .exercise-category[data-category="' + args.exerciseCategory + '"] select.exercise-select-input');
		sel.each(function(ind,elem){
			var s = $(elem);
			var o = s.find('option[value="' + args.exerciseId + '"]');
			if( o.length )
				o.text(args.exerciseName);
			else
				s.append('<option value="' + args.exerciseId + '">' + args.exerciseName + '</option>');

			s.val(args.exerciseId);
			$('.modal').modal('hide');
		});
	});

	$('.old-style-training-editor .categories .exercise-category .clone-exercise-for-category').click(function(evt){
		evt.preventDefault();
		var b = $(evt.currentTarget);
		var e = b.closest('.exercise');
		var ec = e.closest('.exercise-category');
		var v = e.find('.exercise-select-input').val();
		
		$('#clone-exercise-modal').data('exercise', v);
		$('#clone-exercise-modal').modal('show');
	});

	$('.exercise-category .dragger').on('touchstart',draggerTouchStart);
	$('.exercise-category').on('touchend',draggerTouchEnd);
	$('.exercise-category').on('touchmove',draggerTouchMove);
	
	// For preloaded training
	$('.exercise-category').each(function(ind,elem){
		var ec = $(elem);
		eliteTrainerSiteThemeUpdateTrainingExerciseOptionsStatus(ec);
	});
});

})(jQuery);
