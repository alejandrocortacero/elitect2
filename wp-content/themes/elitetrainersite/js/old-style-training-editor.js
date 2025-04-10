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
			var v = null;

			if( sel.find('.exercise-select-input-preset').hasClass('active-selector') )
			{
				v = sel.find('.exercise-select-input-preset').val();
				if( v !== null )
				{
					sel.siblings('.exercise').each(function(ind2,elem2){

						var sel2 = $(elem2);
						sel2.find('.exercise-select-input-preset option[value="' + v + '"]').prop('disabled', true);
					});
				}
			}

			if( sel.find('.exercise-select-input-own').hasClass('active-selector') )
			{
				v = sel.find('.exercise-select-input-own').val();
				if( v !== null )
				{
					sel.siblings('.exercise').each(function(ind2,elem2){

						var sel2 = $(elem2);
						sel2.find('.exercise-select-input-own option[value="' + v + '"]').prop('disabled', true);
					});
				}
			}
		});

		exercises.each(function(ind,elem){
			var sel = $(elem);

			var dis = sel.find('.exercise-select-input-preset option:disabled');
			var tot = sel.find('.exercise-select-input-preset option');

			sel.find('.exercise-type-select-input option[value="preset"]').prop('disabled',dis.length >= tot.length);

			dis = sel.find('.exercise-select-input-own option:disabled');
			tot = sel.find('.exercise-select-input-own option');

			sel.find('.exercise-type-select-input option[value="own"]').prop('disabled',dis.length >= tot.length);

		});
	}

	function eliteTrainerSiteThemeExerciseTypeChanged(evt)
	{
		var ets = $(evt.currentTarget);
		var e = ets.closest('.exercise');

		if(ets.val() == 'own' )
		{
			e.find('.exercise-select-input-preset').removeClass('active-selector');
			e.find('.exercise-select-input-own').addClass('active-selector');
		}
		else
		{
			e.find('.exercise-select-input-preset').addClass('active-selector');
			e.find('.exercise-select-input-own').removeClass('active-selector');
		}
	}

	$('.old-style-training-editor .categories .exercise-category .name .add-exercise-in-category').click(function(evt){
		evt.preventDefault();
		var b = $(evt.currentTarget);
		var ec = b.closest('.exercise-category');
		var n = ec.find('.exercise-template').clone(true);
		n.removeClass('exercise-template').addClass('exercise');
		ec.find('.exercises').append(n);

		eliteTrainerSiteThemeUpdateTrainingExerciseOptionsStatus(ec);

		var dis = n.find('.exercise-select-input-preset option:disabled');
		var tot = n.find('.exercise-select-input-preset option');
		if( dis.length < tot.length )
		{
			tot.each(function(ind,elem){
				var op = $(elem);
				if(!op.prop('disabled'))
				{
					n.find('.exercise-select-input-preset').val(op.attr('value'));
					return false;
				}
			});

			n.find('.exercise-type-select-input').change(eliteTrainerSiteThemeExerciseTypeChanged);
		}
		else
		{
			n.find('.exercise-type-select-input').val('own');
			n.find('.exercise-select-input-preset').removeClass('active-selector');
			n.find('.exercise-select-input-own').addClass('active-selector');

			dis = n.find('.exercise-select-input-own option:disabled');
			tot = n.find('.exercise-select-input-own option');
			if( dis.length < tot.length )
			{
				tot.each(function(ind,elem){
					var op = $(elem);
					if(!op.prop('disabled'))
					{
						n.find('.exercise-select-input-own').val(op.attr('value'));
						return false;
					}
				});

				n.find('.exercise-type-select-input').change(eliteTrainerSiteThemeExerciseTypeChanged);
			}
			else
			{
				n.remove();
			}
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

		//ec.find('.exercises .exercise-select-input option[value="' + v + '"]').prop('disabled', false)
		eliteTrainerSiteThemeUpdateTrainingExerciseOptionsStatus(ec);
	});

	$('#clone-exercise-modal').on('show.bs.modal',function(evt){
		var modal = $(this);
		var bod = modal.find('.modal-body');
		var ex = modal.data('exercise');
		var mem = modal.data('member');
		var preclone = modal.data('preclone');

		bod.html('');

		$.ajax({
			url: OldStyleTrainingEditorNS.ajaxUrl,
			type: 'POST',
			data: {'exercise':ex,'member':mem,'action':OldStyleTrainingEditorNS.cloneExerciseAction, 'preclone':preclone},
			complete:function(){
			},
			success: function(a,b,c){
				bod.html(a);

				bod.find('form input[name="video"]').on('input',function(evt){
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

					$('.personal-training-exercise-video-preview').html(r);
				});
				bod.find('form input[name="video"]').trigger('input');

				bod.find('form.jlc-custom-ajax-form').submit( JLCCustomForm.submitForm );
				bod.find('.jlc-custom-ajax-field').change( JLCCustomForm.changedField );

				JLCCustomFormUploadAjaxImage.initialize(bod);
				JLCCustomFormUploadAjaxCropper.initializeCroppers(bod);
			}
		});
	});

	$(document).on('cloneAndAssingFormImageChanged',function(evt,args){
		var f = $('#clone-exercise-modal .modal-body form');
		var inp = f.find('input[name="' + args.field + '_changed"]');
		inp.val(args.image);
	});

	$(document).on('assignexercisetocategory',function(evt,args){
/*
		var sel = $('.old-style-training-editor .categories .exercise-category[data-category="' + args.exerciseCategory + '"] select.exercise-select-input.active-selector');

		sel.each(function(ind,elem){
			var s = $(elem);
			if( s.val() == args.oldExerciseId )
			{
				var o = s.find('option[value="' + args.exerciseId + '"]');
				if( o.length )
					o.text(args.exerciseName);
				else
					s.prepend('<option value="' + args.exerciseId + '">' + args.exerciseName + '</option>');

				s.val(args.exerciseId);
				$('.modal').modal('hide');
			}
		});
*/
		var sel = $('.old-style-training-editor .categories .exercise-category[data-category="' + args.exerciseCategory + '"] select.exercise-select-input.active-selector');

		sel.each(function(ind,elem){
			var s = $(elem);
			if( s.val() == args.oldExerciseId )
			{
				var ns = s.closest('.exercise').find('select.exercise-select-input.exercise-select-input-own');
				var o = ns.find('option[value="' + args.exerciseId + '"]');
				if( o.length )
					o.text(args.exerciseName);
				else
					ns.append('<option value="' + args.exerciseId + '">' + args.exerciseName + '</option>');

				ns.val(args.exerciseId);
				s.closest('.exercise').find('select.exercise-type-select-input').val('own');
				s.closest('.exercise').find('select.exercise-type-select-input').trigger('change');
				$('.modal').modal('hide');
			}
		});
	});

	$('.old-style-training-editor .categories .exercise-category .clone-exercise-for-category').click(function(evt){
		evt.preventDefault();
		var b = $(evt.currentTarget);
		var e = b.closest('.exercise');
		var ec = e.closest('.exercise-category');
		var v = e.find('.exercise-select-input-own').hasClass('active-selector') ? e.find('.exercise-select-input-own').val() : e.find('.exercise-select-input-preset').val();
		var op = e.find('.exercise-select-input-own').hasClass('active-selector') ? e.find('.exercise-select-input-own option[value="' + v + '"]') : e.find('.exercise-select-input-preset option[value="' + v + '"]');
		
		$('#clone-exercise-modal').data('exercise', v);
		$('#clone-exercise-modal').data('preclone', op.data('preclone') == 'yes' ? 'yes' : 'no' );
		
		$('#clone-exercise-modal').modal('show');
	});

	$('.exercise-category .dragger').on('touchstart',draggerTouchStart);
	$('.exercise-category').on('touchend',draggerTouchEnd);
	$('.exercise-category').on('touchmove',draggerTouchMove);

	$('.exercise .exercise-type-select-input').each(function(ind,elem){
		var t = $(elem);
		var e = t.closest('.exercise');
		if( e.find('.exercise-select-input-preset').hasClass('active-selector') )
			t.val('preset');
		else
			t.val('own');
	});
	$('.exercise .exercise-type-select-input').change(eliteTrainerSiteThemeExerciseTypeChanged);
	
	// For preloaded training
	$('.exercise-category').each(function(ind,elem){
		var ec = $(elem);
		eliteTrainerSiteThemeUpdateTrainingExerciseOptionsStatus(ec);
	});
});

})(jQuery);
