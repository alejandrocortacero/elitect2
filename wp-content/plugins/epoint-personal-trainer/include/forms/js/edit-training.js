"use strict";

(function($){

function epointPersonalTrainerExerciseUpdated()
{
	var ex = [];
	var c = $('.training-exercises-editor .exercises-list .exercise');
	c.each(function(ind,elem){
		var e = $(elem);
		ex.push(e.data('exercise-id'));
	});

	var lex = epointPersonalTrainerReadTrainingExercisesInputs(ex);

	var f = $('form.edit-training-form');
	f.find('input[name="exercises"]').val(JSON.stringify(lex));
}

function epointPersonalTrainerGetExercisePosition(trainingId)
{
	var currentPos = 1;
	var l = $('.training-exercises-editor .exercises-list');
	var exs = l.find('.exercise');
	if( !exs.length )
		return 999999999;

	for( var i = 0; i < exs.length; i++ )
	{
		if($(exs[i]).data('exercise-id') == trainingId )
		{
			return currentPos;
		}
		else
		{
			currentPos++;
		}
	}

	return 999999999;
}

function epointPersonalTrainerReadTrainingExercisesInputs(ex)
{
	var l = $('.training-exercises-editor .exercises-list');
	var lex = [];
	for( var i in ex )
	{
		var ce = l.find('.exercise[data-exercise-id="' + ex[i] + '"]');
		if( ce.length )
			lex.push({
				'exercise': ex[i],
				'position': epointPersonalTrainerGetExercisePosition(ex[i]),
				'description': ce.find('.description-input').val(),
				'series': ce.find('.series-input').val(),
				'repetitions': ce.find('.repetitions-input').val(),
				'loads': ce.find('.loads-input').val()
			});
		else
			lex.push({
				'exercise': ex[i],
				'position': 999999999,
				'description': '',
				'series': 0,
				'repetitions': 0,
				'loads': 0
			});
	}
//console.log(lex);
	return lex;
}

$(document).ready(function(){

	$(document).on('click','.training-exercises-editor .exercises-list .cat-position-controls .move-up',function(evt){
		evt.preventDefault();

		var c = $(evt.currentTarget);
		var t = c.closest('.cat-layer');

		var p = t.prev('.cat-layer');

		if( p.length )
		{
			t.insertBefore(p);
			epointPersonalTrainerExerciseUpdated();
		}
	});
	$(document).on('click','.training-exercises-editor .exercises-list .cat-position-controls .move-down',function(evt){
		evt.preventDefault();

		var c = $(evt.currentTarget);
		var t = c.closest('.cat-layer');

		var n = t.next('.cat-layer');

		if( n.length )
		{
			t.insertAfter(n);
			epointPersonalTrainerExerciseUpdated();
		}
	});
	$(document).on('click','.training-exercises-editor .exercises-list .exercise-position-controls .move-up',function(evt){
		evt.preventDefault();

		var c = $(evt.currentTarget);
		var t = c.closest('.exercise');

		var p = t.prev('.exercise');

		if( p.length )
		{
			t.insertBefore(p);
			epointPersonalTrainerExerciseUpdated();
		}
	});
	$(document).on('click','.training-exercises-editor .exercises-list .exercise-position-controls .move-down',function(evt){
		evt.preventDefault();

		var c = $(evt.currentTarget);
		var t = c.closest('.exercise');

		var n = t.next('.exercise');

		if( n.length )
		{
			t.insertAfter(n);
			epointPersonalTrainerExerciseUpdated();
		}
	});

	$(document).on('input','.training-exercises-editor .exercises-list input',function(evt){
		epointPersonalTrainerExerciseUpdated();
	});

	$('.apply-training-exercises-changes').click(function(evt){
		evt.preventDefault();

		var b = $(evt.currentTarget);
		var w = b.closest('.modal-body').find('.exercises-container');
		
		var c = w.find('input[type="checkbox"][data-exercise]:checked');
		var ex = [];
		c.each(function(ind,elem){
			var e = $(elem);
			ex.push(e.data('exercise'));
		});

		var l = $('.training-exercises-editor .exercises-list');
/*
		var lex = [];
		for( var i in ex )
		{
			var ce = l.find('.exercise[data-exercise-id="' + ex[i] + '"]');
			if( ce.length )
				lex.push({
					'exercise': ex[i],
					'description': ce.find('.description-input').val(),
					'series': ce.find('.series-input').val(),
					'repetitions': ce.find('.repetitions-input').val(),
					'loads': ce.find('.loads-input').val()
				});
			else
				lex.push({
					'exercise': ex[i],
					'description': '',
					'series': 0,
					'repetitions': 0,
					'loads': 0
				});
		}
*/
		var lex = epointPersonalTrainerReadTrainingExercisesInputs(ex);
console.log(lex);

		var ajaxData = {
			'action':EpointPersonalTrainerEditTrainingNS.getTrainingExercisesAction,
			'exercises':lex
		};

		$.ajax({
			url:EpointPersonalTrainerEditTrainingNS.ajaxUrl,
			data:ajaxData,
			method:'POST',
			success:function(a,b,c){
				l.html(a);
			}
		});
			
		var f = $('form.edit-training-form');
		f.find('input[name="exercises"]').val(JSON.stringify(lex));

		$('#exercise-selector-modal').modal('hide');
	});

	//Initialization
	$('#exercise-selector-modal input[data-exercise]').prop('checked',false);
	$('.training-exercises-editor .exercises-list .exercise').each(function(ind,elem){
		var e = $(elem);
		var id = e.data('exercise-id');
		$('#exercise-selector-modal input[data-exercise="' + id + '"]').prop('checked',true);
	});
	
}); // document ready

})(jQuery);
