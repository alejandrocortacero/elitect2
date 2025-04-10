"use strict";

(function($){

	$(document).ready(function(){

		$('.jlc-custom-form-upload-ajax-image-multiple-field .buttons button.jlc-custom-form-remove-image').click(function(evt){
			evt.preventDefault();

			var t = $(evt.currentTarget);
			var p = t.closest('.jlc-custom-form-upload-ajax-image-multiple-field');
			p.removeClass('set');
			p.find('.jlc-custom-form-upload-ajax-image-field-img').prop('src',JLCCustomFormUploadAjaxNS.blankImageUrl);
			p.find('.jlc-custom-form-upload-ajax-image-field-img-layer').css('background-image','url("' + JLCCustomFormUploadAjaxNS.blankImageUrl + '")');
			//p.find('input[type="hidden"]').val('');
			p.find('input.jlc-custom-form-upload-ajax-img-id').val('');
		});

		$('.jlc-custom-form-upload-ajax-image-field .buttons button.jlc-custom-form-add-image, .jlc-custom-form-upload-ajax-image-field .buttons button.jlc-custom-form-change-image').click(function(evt){
			evt.preventDefault();
			var t = $(evt.currentTarget);
			var p = t.closest('.jlc-custom-form-upload-ajax-image-field');
			p.find('input[type="file"]').click();
			
		});

		$('.jlc-custom-form-upload-ajax-image-field input[type="file"]').change(function(evt){
			//TODO: add compatibility without formData
			var tf = $(evt.currentTarget);
			var form = tf.closest('form');
			var formId = form.find('input[name="jlc_custom_form"]').val();
			var cc = tf.closest('.jlc-custom-form-upload-ajax-image-field');
			cc.addClass('loading');
			var wpAction = JLCCustomFormUploadAjaxNS.action.replace('%s',formId);
			//wpAction = wpAction.replace('%s',cc.find('input[type="hidden"]').attr('name'));
			var fName = cc.find('input.jlc-custom-form-upload-ajax-img-id').attr('name');
			fName = fName.replace(/\[.*\]/,'');//remove array parameter for image with position
			wpAction = wpAction.replace('%s',fName);

			var fd = new FormData();
			var files = tf[0].files[0];

//TODO: use methods in ajax.js to send values
			fd.append(JLCCustomFormUploadAjaxNS.fieldName,files);
			fd.append('action',wpAction);
			fd.append('jlc_custom_form',formId);

			$.ajax({
				url: JLCCustomFormUploadAjaxNS.adminUrl,
				type: 'POST',
				data: fd,
				contentType: false,
				processData: false,
				complete:function(){
					cc.removeClass('loading');
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
							case 'updateAjaxImageUploadField':
								var res = JSON.parse(r[i].data);

								var l = tf.closest('.jlc-custom-form-upload-ajax-image-field');
								l.find('.jlc-custom-form-upload-ajax-image-field-img').prop('src',res.url);
								l.find('.jlc-custom-form-upload-ajax-image-field-img-layer').css('background-image','url("' + res.url + '")');
								//l.find('input[type="hidden"]').val(res.id);
								l.find('input.jlc-custom-form-upload-ajax-img-id').val(res.id);
								l.addClass('set');

								var imgLayer = l.find('.jlc-custom-form-upload-ajax-image-field-img-layer');

								JLCCustomFormUploadAjaxImage.setAttributes(imgLayer,res.width,res.height);
								


								break;
							default:
								JLCCustomForm.readAjaxResponse(r,i,tf);
						}
					}
				},
			});
		});

	});

})(jQuery);

