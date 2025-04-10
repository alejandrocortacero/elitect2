"use strict";

(function($){
	function epointPersonalTrainerCleanLoadsMessages()
	{
		$('.loads[data-exercise][data-training] .form-group').removeClass('has-success').removeClass('has-error');
	}

	$(document).ready(function(){
		JLCCustomFormGlobal.addAjaxResponseReader(function(r,i,f){
			var a = r[i];
			if( a.action == 'exercise_training_loads_error' )
			{
				var b = JSON.parse(r[i].data);
				$('.loads[data-exercise="' + b.exercise  + '"][data-training="' + b.training + '"] .form-group').removeClass('has-success').addClass('has-error');
				return true;
			}
			else if( a.action == 'exercise_training_loads_updated' )
			{
				var b = JSON.parse(r[i].data);
				$('.loads[data-exercise="' + b.exercise  + '"][data-training="' + b.training + '"] .form-group').addClass('has-success').removeClass('has-error');
				setTimeout(epointPersonalTrainerCleanLoadsMessages,2000);
				return true;
			}

			return false;
		});

	});
})(jQuery);
