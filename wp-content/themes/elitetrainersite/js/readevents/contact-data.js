"use strict";

(function($){
	$(document).on('eliteTrainerThemeUpdateContactData', function(evt,args){
/*
		$('.phone-layer a .number').text(args.tel);
		$('.phone-layer a').prop('href','tel:' + args.telcode);
*/
		$('a.tel-link .number').text(args.tel);
		$('a.tel-link').prop('href','tel:' + args.telcode);
		$('a.whatsapp-link .number').text(args.tel);
		//$('a.whatsapp-link').prop('href','whatsapp://send/?phone=' + args.telcode + '&text&source&data&app_absent');
		$('a.whatsapp-link').prop('href','https://api.whatsapp.com/send?phone=+34' + args.telcode);
		

		$('div.modal').modal('hide');
	});
})(jQuery);
