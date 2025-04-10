"use strict";

(function($){
	$(document).ready(function(){
		JLCCustomFormGlobal.addAjaxResponseReader(function(r,i,f){
			var a = r[i];
			if( a.action == 'refreshMembersTable' )
			{
				$('.member-search-results').html(a.data);
				return true;
			}

			return false;
		});

		$('.search-members-form input[type="reset"]').click(function(evt){
			setTimeout(function(){$('.search-members-form').submit()},100);
		});
	});
})(jQuery);
