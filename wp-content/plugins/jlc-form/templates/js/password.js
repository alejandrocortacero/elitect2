"use strict";
(function($){
	$(document).ready(function(){
		$('.toggle-password-visibility').click(function(evt){
			var t = $(evt.currentTarget);

			var f = t.parent().find('input');

			if( f.prop('type') == 'password' )
				f.prop('type', 'text' );
			else
				f.prop('type', 'password' );
		});
	});
})(jQuery);
