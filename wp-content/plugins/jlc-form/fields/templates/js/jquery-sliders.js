"use strict";

(function($){
	$(document).ready(function(){
		$('.jlc-custom-form-jquery-slider').each(function(a,b){
			b = $(b);
			var i = b.siblings('#' + b.data('input'));
			var args = {
				range:false,
				min:b.data('min'),
				max:b.data('max'),
				step:b.data('step'),
				value:i.val(),
				slide:function(event,ui){
					var t = $(event.target);
					var f = t.siblings('#' + t.data('input'));
					f.val(ui.value);
					if(f.attr('type') == 'hidden') 
						f.trigger('change');
				}
			};
			if( b.data('handle-quantity') == 'yes' )
			{
				args.create = function(event,ui){
					var t = $(event.target);
					var h = t.find('.ui-slider-handle');
					var v = b.slider('instance').value();
					h.append('<span class="quantity"></span>');
					h.first().children('.quantity').text(v);
				};
				args.slide = function(event,ui){
					var t = $(event.target);

					var f = t.siblings('#' + t.data('input'));
					f.val(ui.value);
					if(f.attr('type') == 'hidden') 
						f.trigger('change');

					var h = t.find('.ui-slider-handle');
					h.first().children('.quantity').text(ui.value);
				}
			}
			b.slider(args);
		});

		$('.jlc-custom-form-jquery-range-slider').each(function(a,b){
			b = $(b);
			var i = $('#' + b.data('input'));
			var args = {
				range:true,
				min:b.data('min'),
				max:b.data('max'),
				values:JSON.parse(i.val()),
				slide:function(event,ui){
					var t = $(event.target);
					$('#' + t.data('input')).val(JSON.stringify(ui.values));
				}
			};
			if( b.data('handle-quantity') == 'yes' )
			{
				args.create = function(event,ui){
					var t = $(event.target);
					var h = t.find('.ui-slider-handle');
					var v = b.slider('instance').values();
					h.append('<span class="quantity"></span>');
					h.first().children('.quantity').text(v[0]);
					h.last().children('.quantity').text(v[1]);
				};
				args.slide = function(event,ui){
					var t = $(event.target);
					$('#' + t.data('input')).val(JSON.stringify(ui.values));
					var h = t.find('.ui-slider-handle');
					h.first().children('.quantity').text(ui.values[0]);
					h.last().children('.quantity').text(ui.values[1]);
				}
			}
			b.slider(args);
		});
	});
})(jQuery);
