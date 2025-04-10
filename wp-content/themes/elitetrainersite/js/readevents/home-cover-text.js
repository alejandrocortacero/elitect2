"use strict";
(function($){
	$(document).ready(function(){
		$('#home-cover-modal button[name="send"]').click(function(evt){
			evt.preventDefault();
			tinyMCE.triggerSave();
			$(evt.currentTarget).closest('form').submit();
		});
	});
	$(document).on('eliteTrainerThemeUpdateHomeCoverText', function(evt,args){
		$('.home-cover .home-cover-col .left .text .editable').html(args.homeCoverText.replace(/\\"/g,'"'));

		$('div.modal').modal('hide');
	});
})(jQuery);
