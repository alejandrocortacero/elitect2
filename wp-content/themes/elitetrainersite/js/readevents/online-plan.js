"use strict";
(function($){
	$(document).on('eliteTrainerThemeUpdateOnlinePlan', function(evt,args){
		$('.plans-container .online-col .price .quantity').text(args.onlinePlanPrice);
		//$('.plans-container .online-col .desc').text(args.onlinePlanDesc);

		$('div.modal').modal('hide');
	});
})(jQuery);
