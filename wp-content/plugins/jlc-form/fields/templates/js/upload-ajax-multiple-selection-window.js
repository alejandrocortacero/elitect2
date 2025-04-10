"use strict";

(function($){

	$(document).ready(function(){
		$('.jlc-custom-form-upload-ajax-image-field .buttons button.jlc-custom-form-select-image').click(function(evt){
			evt.preventDefault();

			var tf = $(evt.currentTarget);
			var form = tf.closest('form');
			var formId = form.find('input[name="jlc_custom_form"]').val();
			var cc = tf.closest('.jlc-custom-form-upload-ajax-image-field');

			var m = tf.closest('.modal');
			
			$('.modal').modal('hide');
			var w = $('#jlc-custom-form-upload-ajax-image-selection-window');
			setTimeout(function(){
				w.modal('show');
			},500);
			w.addClass('loading');

			var wpAction = JLCCustomFormUploadAjaxNS.windowAction.replace('%s',formId);
			var fName = cc.find('input.jlc-custom-form-upload-ajax-img-id').attr('name');
			fName = fName.replace(/\[.*\]/,'');//remove array parameter for image with position
			wpAction = wpAction.replace('%s',fName);

			var fd = {'action':wpAction, 'jlc_custom_form':formId};

			$.ajax({
				url: JLCCustomFormUploadAjaxNS.adminUrl,
				type: 'POST',
				data: fd,
				complete:function(){
					w.removeClass('loading');
				},
				success: function(a,b,c){

					var r = JLCCustomForm.parseWPAjax(a);

					if( !r )
						tf.prepend(JLCCustomFormAjaxNS.defaultError);

					for( var i in r )
					{
						var action = r[i].action;
						switch(action)
						{
							case 'getImages':
								var res = JSON.parse(r[i].data);
								
								var iLayer = $('#jlc-custom-form-upload-ajax-image-selection-window .images-layer');
								if( m.length > 0 )
									iLayer.data('prev',m.attr('id'));
								else
									iLayer.data('prev','');

console.log("TO SET: " + cc.find('.jlc-custom-form-upload-ajax-img-id').attr('id'));
								iLayer.data('input',cc.find('.jlc-custom-form-upload-ajax-img-id').attr('id'));

								iLayer.html('');

								for( var i in res )
									iLayer.append('<img src="' + res[i].url + '" data-post="' + res[i].id + '" class="library-image" />');
								break;
							default:
								JLCCustomForm.readAjaxResponse(r,i,tf);
						}
					}
				},
			});
		});

		$('#jlc-custom-form-upload-ajax-image-selection-window .select-image').click(function(evt){

			evt.preventDefault();
/*
			var t = $(evt.currentTarget);
			var p = t.closest('.jlc-custom-form-upload-ajax-image-field');
			p.find('input[type="file"]').click();
*/
			var iLayer = $('#jlc-custom-form-upload-ajax-image-selection-window .images-layer');
			if( iLayer.find('.library-image.selected').length > 0 )
			{
				var img = iLayer.find('.library-image.selected');
console.log("TO GET: " + iLayer.data('input') );
				var input = $('#' + iLayer.data('input'));
console.log(input);
				input.val(img.data('post'));
				input.closest('.jlc-custom-form-upload-ajax-image-field').find('.jlc-custom-form-upload-ajax-image-field-img').prop('src',img.prop('src'));
				input.closest('.jlc-custom-form-upload-ajax-image-field').find('.jlc-custom-form-upload-ajax-image-field-img-layer').css('background-image','url("' + img.prop('src') + '")');

				$(evt.currentTarget).closest('.modal').modal('hide');
				if( iLayer.data('prev') != '' )
				{
					setTimeout(function(){
						$('#' + iLayer.data('prev')).modal('show');
					},500);
				}
			}
		});

		$(document).on('click','#jlc-custom-form-upload-ajax-image-selection-window .images-layer .library-image',function(evt){
			
			var img = $(evt.currentTarget);
			img.siblings('.library-image').removeClass('selected');
			img.addClass('selected');
		});
	});
})(jQuery);

