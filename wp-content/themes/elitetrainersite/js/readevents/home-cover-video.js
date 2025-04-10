"use strict";
(function($){
	$(document).on('eliteTrainerThemeUpdateHomeCoverVideo', function(evt,args){
		var v = args.homeCoverVideo.replace(/\\/g,'');

		$('.home-cover .home-cover-col .right .video').html(v);
		$('.archive-cases-container .video-layer .video').html(v);

		$('div.modal').modal('hide');
	});
})(jQuery);

