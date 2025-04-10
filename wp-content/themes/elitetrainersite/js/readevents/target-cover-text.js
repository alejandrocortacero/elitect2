"use strict";
(function($){
	$(document).ready(function(){
		$('#target-cover-text-modal button[name="send"]').click(function(evt){
			evt.preventDefault();
			tinyMCE.triggerSave();
			$(evt.currentTarget).closest('form').submit();
		});
	});
	$(document).on('eliteTrainerThemeUpdateTargetCoverText', function(evt,args){
		$('.target-container .target-col .content .inner-text .editable').html(args.targetCoverText.replace(/\\"/g,'"'));

		$('div.modal').modal('hide');
	});
})(jQuery);

