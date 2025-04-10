"use strict";
(function(){
	var $ = jQuery;

	function personaltrainerLazyLoad()
	{
		$('.lazy-load').each(function(ind,elem){
			var layer = $(elem);
			var required = layer.data('lazy');
			if( typeof required != 'undefined' )
			{
				layer.removeClass('lazy-load');
				var loadData = {'action':PersonalTrainerLazy.lazyLoadAction,'layer': required};
				$.ajax({
					method:'POST',
					url:PersonalTrainerLazy.ajaxurl,
					data:loadData,
					success:function(response){
						layer.html(response);
					}
				});
			}
		});
	}

	$(document).ready(function(){
		if($(document).scrollTop() > 0 || $(document).height() <= $(window).height() )
		{
			personaltrainerLazyLoad();
		}
		else
		{
			$(window).scroll(personaltrainerLazyLoad);
		}
	});


})();
