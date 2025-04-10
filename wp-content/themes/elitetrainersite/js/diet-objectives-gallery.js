"use strict";

(function($){


$(document).ready(function(){
	$('#diet-objectives-gallery-tabs > li > a').click(function(evt){
		var tab = $(evt.currentTarget);
		var selected = tab.attr('href');

		var cookieName = EliteTrainerSiteDietObjectivesGalleryNS.dietObjectivesTabCookie;

		var d = new Date();
		d.setTime(d.getTime() + (24*60*60*1000));
		document.cookie = cookieName + "=" + selected + "; expires=" + d.toUTCString() + "; path=/";

	});	

	var dietObjectivesTabCookieValue = EliteThemeNavigation.getCookie(EliteTrainerSiteDietObjectivesGalleryNS.dietObjectivesTabCookie);
	if( dietObjectivesTabCookieValue != '' )
	{
		$('#diet-objectives-gallery-tabs > li > a[href="' + dietObjectivesTabCookieValue + '"]').tab('show');

	}
});

})(jQuery);



