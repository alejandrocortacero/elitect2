"use strict";

(function($){

$(document).ready(function(){
	$('#exercises-gallery-tabs > li > a').click(function(evt){
		var tab = $(evt.currentTarget);
		var selected = tab.attr('href');

		var cookieName = EliteTrainerSiteExercisesGalleryNS.exerciseTabCookie;

		var d = new Date();
		d.setTime(d.getTime() + (24*60*60*1000));
		document.cookie = cookieName + "=" + selected + "; expires=" + d.toUTCString() + "; path=/";

	});	

	var exerciseTabCookieValue = EliteThemeNavigation.getCookie(EliteTrainerSiteExercisesGalleryNS.exerciseTabCookie);
	if( exerciseTabCookieValue != '' )
	{
		$('#exercises-gallery-tabs > li > a[href="' + exerciseTabCookieValue + '"]').tab('show');
	}
});

/*
// Ni terminado ni en uso
	$(document).ready(function(){
		$('.duplicate-exercise').click(function(evt){
			evt.preventDefault();

			var l = $(evt.currentTarget);
			var e = l.data('exercise');

			$.ajax({
				url: EliteTrainerSiteExercisesNS.adminUrl,
				type: 'POST',
				data: {'exercice':e,'action':EliteTrainerSiteExerciseNS.duplicateExerciseAction},
				complete:function(){
				},
				success: function(a,b,c){
					var a = JSON.parse(a);
					if( typeof a.url != 'undefined' )
					{
						var url = a.url != '' ? a.url : JLCCustomFormUploadAjaxNS.blankImageUrl;

						cf.find('.jlc-custom-form-upload-ajax-image-field-img').prop('src',url);
						cf.find('.jlc-custom-form-upload-ajax-image-field-img-layer').css('background-image','url("' + url + '")');
					}
				}
			});
		});
	});
*/
})(jQuery);
