"use strict";

(function($){
	$(document).ready(function(){
		$('.jlc-custom-form-stars-control .star').hover(
			function(){
				var s = $(this);
				s.addClass('highlight');
				s.prevAll().addClass('highlight');
				s.nextAll().addClass('dark');
			},
			function(){
				var s = $(this);
				s.removeClass('highlight');
				s.prevAll().removeClass('highlight');
				s.nextAll().removeClass('dark');
			}
		);

		$('.jlc-custom-form-stars-control .star').click( function(){
			var s = $(this);
			s.addClass('active');
			s.prevAll().addClass('active');
			s.nextAll().removeClass('active');

			var inp = s.closest('.jlc-custom-form-stars-control').siblings('.jlc-custom-form-stars-input');
			inp.val(s.data('star'));
			inp.trigger('change');
		});

		$('.jlc-custom-form-stars-input').each( function(ind,elem){
			var inp = $(elem);
			var c = inp.siblings('.jlc-custom-form-stars-control');
			var s = c.children('.star');
			var v = inp.val();
			v = parseInt(v);

			if( !isNaN(v) && v >= 0 )
			{
				for( var i = 1; i <= s.length; i++ )
				{
					if( i <= v )
						c.children('.star-' + i ).addClass('active');
					else
						c.children('.star-' + i ).removeClass('active');
				}
			}
			else
			{
				s.removeClass('active');
			}
		});
	});
})(jQuery);

