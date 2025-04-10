"use strict";
(function(){
	var $ = jQuery;

	function trainersiteLazyLoad()
	{
		$('.lazy-load').each(function(ind,elem){
			var layer = $(elem);
			var required = layer.data('lazy');
			if( typeof required != 'undefined' )
			{
				layer.removeClass('lazy-load');
				var loadData = {'action':TrainerSiteLazy.lazyLoadAction,'layer': required};
				$.ajax({
					method:'POST',
					url:TrainerSiteLazy.ajaxurl,
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
			trainersiteLazyLoad();
		}
		else
		{
			$(window).scroll(trainersiteLazyLoad);
		}
	});


})();
