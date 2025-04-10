"use strict";
(function($){
	$(document).ready(function(){
		$('input[type="checkbox"][data-days-field]').each(function(ind,elem){
			var inp = $(elem);
			if(inp.is(':checked'))
			{
				$('#' + inp.data('days-field')).closest('.form-group').show();
			}
			else
			{
				$('#' + inp.data('days-field')).closest('.form-group').hide();
			}
		});
		$('input[type="checkbox"][data-days-field]').change(function(evt){
			var inp = $(evt.currentTarget);
			if(inp.is(':checked'))
			{
				$('#' + inp.data('days-field')).closest('.form-group').show();
			}
			else
			{
				$('#' + inp.data('days-field')).closest('.form-group').hide();
			}
		});
	});
})(jQuery);
