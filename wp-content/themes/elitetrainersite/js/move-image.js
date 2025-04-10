"use strict";

(function($){
	$('.move-image-arrow').click(function(evt,args){

		evt.preventDefault();
		var b = $(evt.currentTarget);

		b.prop('disabled',true);
		b.siblings('.move-image-arrow').prop('disabled',true);

		var direction = b.data('direction');

		var postData = {
			'action':EliteTrainerSiteStyleNS.moveImageAction,
			'section':'homecoverbg',
			'direction':direction
		};

		$.ajax({
			url: EliteTrainerSiteStyleNS.adminUrl,
			type: 'POST',
			data: postData,
			//contentType: false,
			//processData: false,
			complete:function(){
				b.prop('disabled',false);
				b.siblings('.move-image-arrow').prop('disabled',false);
			},
			success: function(a,b,c){
				$(document).trigger('eliteTrainerThemeUpdateStyle');
			},
		});

	});
})(jQuery);


