"use strict";

(function($){
	function updatedVideoField(evt)
	{
		var f = $(evt.currentTarget);
		var v = f.val();
		var m,r;
		
		m = v.match(/^https:\/\/youtu\.be\/(.*)$/);
		if( m )
		{
			r = '<iframe width="560" height="315" src="https://www.youtube.com/embed/' + m[1] + '" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
		}
		else if( ( m = v.match(/^https:\/\/vimeo\.com\/(.*)$/) ) )
		{
			r = '<iframe src="https://player.vimeo.com/video/' + m[1] + '" width="640" height="360" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>';
		}
		else
		{
			r = '';
		}

		$('.personal-training-exercise-video-preview').html(r);
	}
	$(document).ready(function() {
		//$('#video').on('change', updatedVideoField);
		$('#video').on('input', updatedVideoField);
		$('#video').trigger('input');
	});
})(jQuery);

