"use strict";
(function($){
	$(document).ready(function(){
		$('#online-plan-features-modal button[name="send"]').click(function(evt){
			evt.preventDefault();
			tinyMCE.triggerSave();
			$(evt.currentTarget).closest('form').submit();
		});
	});
	$(document).on('eliteTrainerThemeUpdateOnlineFeaturesText', function(evt,args){
		$('.plans-container .online-col .features .text').html(args.onlineFeaturesText.replace(/\\"/g,'"'));

		$('div.modal').modal('hide');
	});
})(jQuery);
