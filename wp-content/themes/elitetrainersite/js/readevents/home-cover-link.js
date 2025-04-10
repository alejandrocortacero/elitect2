"use strict";
(function($){
	$(document).on('eliteTrainerThemeUpdateHomeCoverButton', function(evt,args){
		$('.home-cover .home-cover-col .left .join-link-layer .join-link .inner-text').text(args.homeCoverButtonText);

		$('div.modal').modal('hide');
	});
})(jQuery);

