"use strict";

(function($){
	$(document).ready(function() {
		$('.create-user-diet-form').submit(function(evt){
			var start = $('.create-user-diet-form input[name="start"]');
			var end = $('.create-user-diet-form input[name="end"]');

			if( start.val() == '' )
			{
				evt.preventDefault();
				$('.new-diet-start-date').closest('.form-group').addClass('has-error');
				$('.new-diet-start-date').focus();
				$("body,html").animate( { scrollTop: $('.new-diet-start-date').offset().top - 200 }, 800 );
			}

			if( end.val() == '' )
			{
				evt.preventDefault();
				$('.new-diet-end-date').closest('.form-group').addClass('has-error');
				$('.new-diet-end-date').focus();
				$("body,html").animate( { scrollTop: $('.new-diet-end-date').offset().top - 200 }, 800 );
			}
		});
	});
})(jQuery);
