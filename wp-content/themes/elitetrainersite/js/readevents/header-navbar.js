"use strict";

(function($){
	$(document).on('eliteTrainerThemeUpdateHeaderNavbar', function(evt,args){
		$('.navbar-header .text .site-title').text(args.siteTitle);
		$('.navbar-header .text .site-description').text(args.siteSubtitle);
		$('.navbar-header .logo img').prop('src',args.headerLogoUrl + '?azar=' + (new Date().getTime()));

		$('div.modal').modal('hide');
	});

})(jQuery);
