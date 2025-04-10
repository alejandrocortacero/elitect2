"use strict";
(function($){
	$(document).on('eliteTrainerThemeUpdateCustomHtml', function(evt,args){
		$(args.customHtmlSelector + ' .editable').html(args.customHtmlContent);

		$('div.modal').modal('hide');
	});

	$(document).ready(function(){
		$('.elitetrainersite-html-form button[name="send"]').click(function(evt){
			evt.preventDefault();
			tinyMCE.triggerSave();
			$(evt.currentTarget).closest('form').submit();
		});
	});
})(jQuery);

