(function($){
	function submitButtonPressed(evt)
	{
		if( typeof tinyMCE !== 'undefined' )
		{
			tinyMCE.triggerSave();
		}
	}
	$(document).ready(function(){
		$('#addtag #submit').mousedown(submitButtonPressed);
		$('#addtag #submit').keydown(submitButtonPressed);
	});
})(jQuery);
