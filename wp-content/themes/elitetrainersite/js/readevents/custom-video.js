"use strict";
(function($){
	$(document).on('eliteTrainerThemeUpdateCustomVideo', function(evt,args){

		var v = args.customVideoIframe.replace(/\\/g,'');

		if(args.customVideoEnabled)
			$(args.customVideoSelector).removeClass('empty');
		else
			$(args.customVideoSelector).addClass('empty');

		$(args.customVideoSelector).html(v);

		$('div.modal').modal('hide');
	});
})(jQuery);

