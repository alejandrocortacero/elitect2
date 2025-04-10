"use strict";

var jlcFormsRecaptchaCallback = function(){

	jQuery('.jlc-google-captcha').each(function(ind,elem){
		var id = jQuery(elem).attr('id');
		grecaptcha.render(document.getElementById(id), {
			'sitekey' : JLCCustomFormGoogleCaptchasNamespace.sitekey
		});	
	});
};
