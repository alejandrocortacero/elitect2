"use strict";
(function($){
	$(document).on('eliteTrainerThemeUpdateCustomImage', function(evt,args){

		var v = args.customImageTag.replace(/\\/g,'');

		if(args.customImageEnabled)
			$(args.customImageSelector).removeClass('empty');
		else
			$(args.customImageSelector).addClass('empty');

		$(args.customImageSelector).html(v);

		$('div.modal').modal('hide');
	});
})(jQuery);


