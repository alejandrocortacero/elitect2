"use strict";

(function($){


$(document).ready(function(){
	$('#training-objectives-gallery-tabs > li > a').click(function(evt){
		var tab = $(evt.currentTarget);
		var selected = tab.attr('href');

		var cookieName = EliteTrainerSiteTrainingObjectivesGalleryNS.trainingObjectivesTabCookie;

		var d = new Date();
		d.setTime(d.getTime() + (24*60*60*1000));
		document.cookie = cookieName + "=" + selected + "; expires=" + d.toUTCString() + "; path=/";

	});	

	var trainingObjectivesTabCookieValue = EliteThemeNavigation.getCookie(EliteTrainerSiteTrainingObjectivesGalleryNS.trainingObjectivesTabCookie);
	if( trainingObjectivesTabCookieValue != '' )
	{
		$('#training-objectives-gallery-tabs > li > a[href="' + trainingObjectivesTabCookieValue + '"]').tab('show');

	}
});

})(jQuery);


