"use strict";
(function($){
	$(document).on('eliteTrainerThemeUpdateCustomButton', function(evt,args){
		$(args.customButtonSelector).text(args.customButtonText);

		$('div.modal').modal('hide');
	});
})(jQuery);
