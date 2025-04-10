"use strict";
(function($){
	$(document).on('eliteTrainerThemeUpdateHomeCoverTitle', function(evt,args){
		$('.home-cover .home-cover-col .sup .title-layer .title').text(args.homeCoverTitle);

		$('div.modal').modal('hide');
	});
})(jQuery);
