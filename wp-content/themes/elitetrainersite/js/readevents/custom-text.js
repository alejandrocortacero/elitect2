"use strict";
(function($){
	$(document).on('eliteTrainerThemeUpdateCustomText', function(evt,args){
		$(args.customTextSelector).text(args.customTextText);

		$('div.modal').modal('hide');
	});
})(jQuery);
