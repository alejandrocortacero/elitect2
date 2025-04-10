"use strict";

var JLCCustomFormUploadAjaxCropper = new function(){

	var $ = jQuery;
	var me = this;

	this.initializeCropper = function(fff)
	{
		if(fff.hasClass('set'))
		{
			//var jcropInstance = fff.prop('jcrop-instance');
			//if(jcropInstance) jcropInstance.destroy();
			var image = fff.find('.jlc-custom-form-upload-ajax-image-field-img');
			var src = image.attr('src');
			if( src.indexOf('?') != -1 )
				src = src.substring(0,src.indexOf('?'));

			src += '?time=' + Date.now();
			image.attr('src',src);
			

		//	jcropInstance = $.Jcrop( fff.find('.jlc-custom-form-upload-ajax-image-field-img'),abrir_llave
			var jcropInstance = fff.find('.jlc-custom-form-upload-ajax-image-field-img').Jcrop({

				allowSelect: true,
				allowMove: true,
				allowResize: true,
				fixedSupport: 0,
				//aspectRatio: 1,
				onSelect: function (c) {
				var size;
					size = { x: c.x, y: c.y, 
							w: c.w, h: c.h };
					var img = fff.find('.jlc-custom-form-upload-ajax-image-field-img');
					var iw = img.width();
					var ih = img.height();
					
					fff.find('.jlc-custom-form-upload-ajax-img-x').val(c.x/iw);
					fff.find('.jlc-custom-form-upload-ajax-img-y').val(c.y/ih);
					fff.find('.jlc-custom-form-upload-ajax-img-w').val(c.w/iw);
					fff.find('.jlc-custom-form-upload-ajax-img-h').val(c.h/ih);
					//$("#cropBtnID").css( "visibility", "visible");
				}//end onSelect
			});//end Jcrop method

			//jcropInstance.data('Jcrop').destroy();

			//fff.prop('jcrop-instance',jcropInstance);
		}
	};

	this.refreshCropper = function(fi)
	{
		var oldImg = fi.find('.jlc-custom-form-upload-ajax-image-field-img');

		//if(fi.prop('jcrop-instance'))
		if(oldImg.data('Jcrop'))
		{
			//var img = fi.find('.jlc-custom-form-upload-ajax-image-field-img').clone();
			var newImg = $(oldImg[0].outerHTML);
			newImg.removeAttr('style');
			var newImgSrc = newImg.attr('src');
			if( newImgSrc.indexOf('?') != -1 )
				newImgSrc = newImgSrc.substring(0,newImgSrc.indexOf('?'));

			newImgSrc += '?time=' + Date.now();
			newImg.attr('src',newImgSrc);
			
	//		fi.prop('jcrop-instance').destroy();
			//fi.prop('jcrop-instance',null);
			oldImg.data('Jcrop').destroy();
			//fi.find('.jlc-custom-form-upload-ajax-image-field-preview').prepend(img);
			oldImg.replaceWith(newImg);

			fi.find('.jlc-custom-form-upload-ajax-img-x').val('');
			fi.find('.jlc-custom-form-upload-ajax-img-y').val('');
			fi.find('.jlc-custom-form-upload-ajax-img-w').val('');
			fi.find('.jlc-custom-form-upload-ajax-img-h').val('');
		}

		me.initializeCropper(fi);
	};

	this.initializeCroppers = function(c){
		$(c).find('.jlc-custom-form-upload-ajax-image-cropper-field').each(function(ind,elem){
			var field = $(elem);

			field.find('.jlc-custom-form-upload-ajax-img-id').change(function(evt){
				var inp = $(evt.currentTarget);
				if( inp.val() == '' )
				{
					var fi = inp.closest('.jlc-custom-form-upload-ajax-image-cropper-field');
					var img = fi.find('.jlc-custom-form-upload-ajax-image-field-img');
					if(img.data('Jcrop'))
					{
						//field.prop('jcrop-instance').destroy();
						img.data('Jcrop').destroy();
						img.removeAttr('style');
						//fi.find('.jlc-custom-form-upload-ajax-image-field-preview').prepend(img);

					}
					fi.find('.jlc-custom-form-upload-ajax-img-x').val('');
					fi.find('.jlc-custom-form-upload-ajax-img-y').val('');
					fi.find('.jlc-custom-form-upload-ajax-img-w').val('');
					fi.find('.jlc-custom-form-upload-ajax-img-h').val('');

					//field.prop('jcrop-instance',null);
				}
			});

			field.on('imageUploaded',function(evt) {
				var fi = $(evt.currentTarget);
				me.refreshCropper(field);
			});

			field.on('imageChecked',function(evt) {
				var fi = $(evt.currentTarget);
				me.refreshCropper(field);
			});

			field.closest('form').on('jlccustomformAjaxSuccessEnd', function(evt){
				me.refreshCropper(field);
			});

			me.initializeCropper(field);

		});
	};

	$(document).ready(function(){
		JLCCustomFormUploadAjaxCropper.initializeCroppers(document);
	});
};
