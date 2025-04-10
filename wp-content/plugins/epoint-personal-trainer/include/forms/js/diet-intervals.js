"use strict";

(function($){
	$(document).ready(function() {
		$('.diet-interval-select').select2({
			width:'100%',
			language:{
				noResults: function()
				{
					return 'Si no encuentra un alimento, puede añadirlo en la zona de creación.';
				}
			}
		});

		$('.diet-interval-select').on('select2:select',function(evt){
			console.log(evt.params.data.text);
			var inp = $(evt.currentTarget).closest('.form-group').next('.form-group').find('input[type="text"]');
			var newText = evt.params.data.text;
			if( newText.indexOf('(') > 0 )
				newText = newText.substr( 0, newText.indexOf('(') );

			inp.val( inp.val() + ' ' + newText );
		});
	});
})(jQuery);
