"use strict";
(function($){
	$(document).on('eliteTrainerThemeUpdateTargetCoverTitle', function(evt,args){
		$('.target-container .target-col .content .target-title-layer h2').text(args.targetCoverTitle);

		$('div.modal').modal('hide');
	});
})(jQuery);
