"use strict";

(function($){
	$(document).on('eliteTrainerThemeUpdateStyle', function(evt,args){

		var postData = {
			'action':EliteTrainerSiteStyleNS.updateAction
		};

		$.ajax({
			url: EliteTrainerSiteStyleNS.adminUrl,
			type: 'POST',
			data: postData,
			//contentType: false,
			//processData: false,
			complete:function(){
				//cc.removeClass('loading');
			},
			success: function(a,b,c){

				$('#trainer-site-custom-style').replaceWith(a);

				$('div.modal').modal('hide');
				eliteTrainerSiteSetBodyPadding();
			},
		});

	});
})(jQuery);

