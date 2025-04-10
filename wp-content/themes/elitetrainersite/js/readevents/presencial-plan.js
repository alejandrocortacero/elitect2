"use strict";
(function($){
	$(document).on('eliteTrainerThemeUpdatePresencialPlan', function(evt,args){
		$('.plans-container .presencial-col .price .quantity').text(args.presencialPlanPrice);
		//$('.plans-container .presencial-col .desc').text(args.presencialPlanDesc);

		$('div.modal').modal('hide');
	});
})(jQuery);

