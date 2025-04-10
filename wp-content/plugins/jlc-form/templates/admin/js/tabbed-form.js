"use strict";
(function($){
	$(document).ready(function(){
		$('.jlc-custom-form-tabbed-admin-form .nav-tab-wrapper .nav-tab').click(function(evt){
			evt.preventDefault();
			var a = $(evt.currentTarget);
			var t = a.data('target');
			var p = a.closest('.jlc-custom-form-tabbed-admin-form');

			p.find('.nav-tab').each(function(ind,elem){
				var l = $(elem);
				if(l.data('target') == t) l.addClass('nav-tab-active'); else l.removeClass('nav-tab-active');
			});
			p.find('.jlc-custom-form-tab-layer').each(function(ind,elem){
				var l = $(elem);
				if(l.data('tab') == t) l.addClass('active'); else l.removeClass('active');
			});
		});
	});
})(jQuery);
