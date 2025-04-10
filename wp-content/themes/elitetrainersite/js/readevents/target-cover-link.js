"use strict";
(function($){
	$(document).on('eliteTrainerThemeUpdateTargetCoverButton', function(evt,args){
		$('.target-container .target-col .content .target-link-layer a .inner-text').text(args.targetCoverButtonText);

		$('div.modal').modal('hide');
	});
})(jQuery);


