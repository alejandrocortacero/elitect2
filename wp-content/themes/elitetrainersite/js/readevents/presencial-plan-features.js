"use strict";
(function($){
	$(document).ready(function(){
		$('#presencial-plan-features-modal button[name="send"]').click(function(evt){
			evt.preventDefault();
			tinyMCE.triggerSave();

			$(evt.currentTarget).closest('form').submit();
		});
	});
	$(document).on('eliteTrainerThemeUpdatePresencialFeaturesText', function(evt,args){
		$('.plans-container .presencial-col .features .text').html(args.presencialFeaturesText.replace(/\\"/g,'"'));

		$('div.modal').modal('hide');
	});
})(jQuery);

