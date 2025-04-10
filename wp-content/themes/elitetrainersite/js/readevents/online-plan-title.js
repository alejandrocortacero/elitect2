"use strict";
(function($){
	$(document).on('eliteTrainerThemeUpdateOnlinePlanTitle', function(evt,args){
		$('.plans-container .online-col .type .text').text(args.onlinePlanTitle);

		$('div.modal').modal('hide');
	});
})(jQuery);
