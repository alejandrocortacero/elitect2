"use strict";

var JLCCustomFormUploadAjaxImage = new function(){

	var $ = jQuery;

	this.setAttributes = function(imgLayer,w,h){
		var l = imgLayer.closest('.jlc-custom-form-upload-ajax-image-field');

		if( typeof w == 'undefined' )
			w = parseInt( imgLayer.data('image-width') );
		if( typeof h == 'undefined' )
			h = parseInt( imgLayer.data('image-height') );

		if( imgLayer.length > 0 && w > 0 && h > 0 )
		{
			
			var ilW = imgLayer.width();
			var ilH = imgLayer.height();

			if( ilW > 0 && ilH > 0 )
			{
				var ilR = ilW * 1.0 / ilH;
				var iR = w * 1.0 / h;	

				if( w > h )
				{
					l.addClass('img-horizontal').removeClass('img-vertical');
				}
				else
				{
					l.removeClass('img-horizontal').addClass('img-vertical');
				}

				if( ilR < iR )
				{
					l.addClass('hide-vertical-controls').removeClass('hide-horizontal-controls');
				}
				else if( ilR > iR )
				{
					l.removeClass('hide-vertical-controls').addClass('hide-horizontal-controls');
				}
				else
				{
					l.removeClass('hide-vertical-controls').removeClass('hide-horizontal-controls');
				}
			}
		}
	};

	this.unsetImage = function(fi)
	{
		fi.removeClass('set');
		fi.find('.jlc-custom-form-upload-ajax-image-field-img').prop('src',JLCCustomFormUploadAjaxNS.blankImageUrl);
		fi.find('.jlc-custom-form-upload-ajax-image-field-img-layer').css('background-image','url("' + JLCCustomFormUploadAjaxNS.blankImageUrl + '")');
		fi.find('input.jlc-custom-form-upload-ajax-img-id').val('').trigger('change');
	};

	this.removeButtonClicked = function(evt)
	{
		evt.preventDefault();

		var t = $(evt.currentTarget);
		var p = t.closest('.jlc-custom-form-upload-ajax-image-field');

		JLCCustomFormUploadAjaxImage.unsetImage(p);
/*
		p.removeClass('set');
		p.find('.jlc-custom-form-upload-ajax-image-field-img').prop('src',JLCCustomFormUploadAjaxNS.blankImageUrl);
		p.find('.jlc-custom-form-upload-ajax-image-field-img-layer').css('background-image','url("' + JLCCustomFormUploadAjaxNS.blankImageUrl + '")');
		//p.find('input[type="hidden"]').val('');
		p.find('input.jlc-custom-form-upload-ajax-img-id').val('').trigger('change');
*/
	};

	this.changeButtonClicked = function(evt)
	{
		evt.preventDefault();
		var t = $(evt.currentTarget);
		var p = t.closest('.jlc-custom-form-upload-ajax-image-field');
		p.find('input[type="file"]').click();
	};

	this.fileInputChanged = function(evt)
	{
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
							l.find('input.jlc-custom-form-upload-ajax-img-id').val(res.id).trigger('change');
							l.addClass('set');

							var imgLayer = l.find('.jlc-custom-form-upload-ajax-image-field-img-layer');

							JLCCustomFormUploadAjaxImage.setAttributes(imgLayer,res.width,res.height);
							
							l.trigger('imageUploaded');


							break;
						default:
							JLCCustomForm.readAjaxResponse(r,i,form);
					}
				}
			},
		});
	};

	this.checkImageInInput = function(inp)
	{
		var p = inp.closest('.jlc-custom-form-upload-ajax-image-field');

		var form = inp.closest('form');
		var formId = form.find('input[name="jlc_custom_form"]').val();

		var act = JLCCustomFormUploadAjaxNS.checkImageExistsAction;
		act = act.replace('%s',formId);
		act = act.replace('%s',inp.attr('name'));
		act = act.replace(/\[.*\]/, '' );
		
		var fd = { 'action': act };
		fd[JLCCustomFormUploadAjaxNS.checkImageExistsFieldName] = inp.val();
		fd['jlc_custom_form'] = formId;

		$.ajax({
			url: JLCCustomFormUploadAjaxNS.adminUrl,
			type: 'POST',
			data: fd,
			beforeSend:function(){
				p.removeClass('loading');
			},
			complete:function(){
				p.removeClass('loading');
			},
			success: function(a,b,c){

				var r = JLCCustomForm.parseWPAjax(a);

				if( !r )
					return;

				for( var i in r )
				{
					var action = r[i].action;
					switch(action)
					{
						case 'getAjaxImageUploadFieldUrl':
							var res = JSON.parse(r[i].data);

							if( res.exists )
							{
								p.find('.jlc-custom-form-upload-ajax-image-field-img').prop('src',res.url);
								p.find('.jlc-custom-form-upload-ajax-image-field-img-layer').css('background-image','url("' + res.url + '")');
								p.addClass('set');
							}
							else
							{
								//inp.val('').trigger('change');
								JLCCustomFormUploadAjaxImage.unsetImage(p);
							}

							p.trigger('imageChecked');

							//p.find('.jlc-custom-form-upload-ajax-image-field-img').prop('src',res.url);
							//p.find('.jlc-custom-form-upload-ajax-image-field-img-layer').css('background-image','url("' + res.url + '")');

							//var imgLayer = p.find('.jlc-custom-form-upload-ajax-image-field-img-layer');
							//JLCCustomFormUploadAjaxImage.setAttributes(imgLayer,res.width,res.height);

							break;
						default:
							JLCCustomForm.readAjaxResponse(r,i,form);
					}
				}
			}
		});
	};

	this.checkValueAtRefresh = function(p)
	{
		var inp = p.find('input.jlc-custom-form-upload-ajax-img-id');

		if( !p.hasClass('set') )
		{
			if( inp.val() != '' )
			{
				JLCCustomFormUploadAjaxImage.checkImageInInput(inp);
			}
		}
		else
		{
			if( inp.val() == '' )
			{
				JLCCustomFormUploadAjaxImage.unsetImage(p);
			}
			else if( inp.val() != inp.data('default-image') )
			{
				JLCCustomFormUploadAjaxImage.checkImageInInput(inp);
			}
		}
	};

	this.initialize = function(c) //c is the container with fields to initialize
	{
		$(c).find('.jlc-custom-form-upload-ajax-image-field .jlc-custom-form-upload-ajax-image-field-img-layer').each(function(ind,elem){
			JLCCustomFormUploadAjaxImage.setAttributes($(elem));
		});

		$(c).find('.jlc-custom-form-upload-ajax-image-field .buttons button.jlc-custom-form-remove-image').click(JLCCustomFormUploadAjaxImage.removeButtonClicked);

		$(c).find('.jlc-custom-form-upload-ajax-image-field .buttons button.jlc-custom-form-add-image, .jlc-custom-form-upload-ajax-image-field .buttons button.jlc-custom-form-change-image').click(JLCCustomFormUploadAjaxImage.changeButtonClicked);

		$(c).find('.jlc-custom-form-upload-ajax-image-field input[type="file"]').change(JLCCustomFormUploadAjaxImage.fileInputChanged);

		//JLCCustomFormUploadAjaxImage.checkValueAtRefresh($(c).find('.jlc-custom-form-upload-ajax-image-field'));
		$(c).find('.jlc-custom-form-upload-ajax-image-field').each(function(ind,elem){
			JLCCustomFormUploadAjaxImage.checkValueAtRefresh($(elem));
		});
	};
};

(function($){

	$(document).ready(function(){

		JLCCustomFormUploadAjaxImage.initialize(document);

	});

})(jQuery);
