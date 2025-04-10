"use strict";
(function($){
	$(document).on('eliteTrainerThemeUpdatePlansTitle', function(evt,args){
		$('.plans-container .title-col h2').text(args.plansTitle);

		$('div.modal').modal('hide');
	});
})(jQuery);

