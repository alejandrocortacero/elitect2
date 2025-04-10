"use strict";

(function($){


$(document).ready(function(){
	$('#diet-gallery-tabs > li > a').click(function(evt){
		var tab = $(evt.currentTarget);
		var selected = tab.attr('href');

		var cookieName = EliteTrainerSiteDietGalleryNS.dietTabCookie;

		var d = new Date();
		d.setTime(d.getTime() + (24*60*60*1000));
		document.cookie = cookieName + "=" + selected + "; expires=" + d.toUTCString() + "; path=/";

	});	

	var dietTabCookieValue = EliteThemeNavigation.getCookie(EliteTrainerSiteDietGalleryNS.dietTabCookie);
	if( dietTabCookieValue != '' )
	{
console.log(dietTabCookieValue);
		$('#diet-gallery-tabs > li > a[href="' + dietTabCookieValue + '"]').tab('show');
	}
});

})(jQuery);

