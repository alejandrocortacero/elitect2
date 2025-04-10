"use strict";

(function($){
	var jlcGoogleCaptchasInit = function(){

		if( typeof window.grecaptcha == 'undefined' ||
			typeof window.grecaptcha.render == 'undefined' )
		{
			setTimeout(jlcGoogleCaptchasInit,1000);
		}
		else
		{
			$('.jlc-google-captcha').each(function(ind,elem){
				var id = jQuery(elem).attr('id');
				grecaptcha.render(document.getElementById(id), {
					'sitekey' : JLCCustomFormGoogleCaptchasNamespace.sitekey
				});	
					
			});
		}
	};
	$(document).ready(jlcGoogleCaptchasInit);
})(jQuery);
