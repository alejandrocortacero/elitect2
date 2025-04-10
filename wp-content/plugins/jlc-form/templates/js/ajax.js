"use strict";

var JLCCustomForm = new function(){

	var $ = jQuery;

	this.parseWPAjax = function(a){
		var xml = $(a);
		var responses = xml.find('response');

		if(responses.length == 0 )
			return false;

		var ret = [];
		for( var i = 0; i < responses.length; i++)
		{
			var r = $(responses[i]);
			var id = r.children().first()[0].id;

			var actionStr = r.attr('action');
			var idIndex = actionStr.lastIndexOf('_' + id);

			if(idIndex > 0)
			{
				var action = actionStr.substr( 0, idIndex );
				var responseData = r.find('response_data');
				if( responseData.length > 0 )
					ret.push({
						'id': id,
						'action': action,
						'data': responseData[0].textContent
					});
			}
		}

		return ret;
	};

	this.readFields = function(f,s){
		if( typeof FormData == 'undefined' )
		{
			var formData = {};
			f.find('input[name][type!="checkbox"],input[name][type="checkbox"]:checked,textarea[name],select[name],button[name]').each(function(ind,elem){
				formData[$(elem).attr('name')] = $(elem).val();
			});

			return formData;
		}
		else
		{
			//return new FormData(f.context);
			//return new FormData(f[0]);
			const formData = new FormData(f[0]);
			if(typeof s !== 'undefined')
			{
				const ss = $(s);
				if(ss.attr('name'))
					formData.append(ss.attr('name'),ss.val());
			}

			return formData;
		}
	};

	this.changedField = function(evt){
		evt.preventDefault();
		var field = $(evt.target);
		var f = field.closest('form');
		if( !f.length )
			return;

		var formData = JLCCustomForm.readFields(f);
		if( typeof FormData == 'undefined' )
		{
			formData['jlc_custom_form_field'] = field.attr('name');
			formData['action'] = formData['action'] + '_field';
		}
		else
		{
			formData.append('jlc_custom_form_field',field.attr('name'));
			formData.append('action',formData.get('action') + '_field');
		}

		var args = {
			beforeSend:function(){f.children('.alert').remove();f.find('input,textarea,select,button').prop('disabled',true);},
			complete:function(){f.find('input,textarea,select,button').prop('disabled',false);},
			data: formData,
			dataType: 'xml',
			error:function(a,b,c){
				f.prepend(JLCCustomFormAjaxNS.defaultError);
			},
			method: 'POST',
			success:function(a,b,c){
				var r = JLCCustomForm.parseWPAjax(a);

				if( !r )
					f.prepend(JLCCustomFormAjaxNS.defaultFieldError);

				for( var i in r )
				{
					var action = r[i].action;
					switch(action)
					{
						case 'prepend':
							//what.prepend(r[i].data);
							break;
						case 'append':
							//what.append(r[i].data);
							break;
						case 'replaceWith':
							var newElem = $(r[i].data);
							var newSelect = newElem.find('select');
							var selectId = newSelect.attr('id');

							$('#' + selectId ).replaceWith(newSelect);

							$('#' + selectId + '.jlc-custom-ajax-field').change( JLCCustomForm.changedField );
							break;
						case 'replaceHTML':
							var newElem = $(r[i].data);
							var selectId = newElem.attr('id');

							$('#' + selectId ).replaceWith(newElem);
							break;
						case 'updateValues':
							var values = JSON.parse(r[i].data);
							for(var j in values)
							{
								f.find('#' + j).val(values[j]);
							}
							break;
						default:
					}
				}
			},
			url: JLCCustomFormAjaxNS.adminUrl
		};

		if( typeof FormData != 'undefined' )
		{
			args['processData'] = false;
			args['contentType'] = false;
		}
		
		$.ajax( args );
	}

	this.readAjaxResponse = function(r, i, f)
	{
		var action = r[i].action;
		switch(action)
		{
			case 'prepend':
				f.prepend(r[i].data);
				break;
			case 'append':
				f.append(r[i].data);
				break;
			case 'replaceWith':
				f.replaceWith(r[i].data);
				break;
			case 'replaceForm':
				var nf = $(r[i].data);

				f.replaceWith(nf);
				//TODO: verify support for complex inpunts
				JLCCustomFormGlobal.initializeForm(nf);
				break;
			case 'event':
				try
				{
					var t = JSON.parse(r[i].data);
					f.trigger(t.name,t.args);
				}
				catch(exc)
				{
					f.prepend(JLCCustomFormAjaxNS.defaultError);
				}
				break;
			case 'redirect':
				try
				{
					var t = JSON.parse(r[i].data);
					window.location.href = t.url;
				}
				catch(exc)
				{
					f.prepend(JLCCustomFormAjaxNS.defaultError);
				}
				break;
			default:
				JLCCustomFormGlobal.notDefaultAjaxResponse(r, i, f);
		}
	}

	this.submitForm = function(evt){
		evt.preventDefault();
		var f = $(evt.target);
		var xhr = f.data('jlccustomformxhr');
		if(xhr && xhr.readyState != 4)
		{
			xhr.abort();
		}

		var formData = JLCCustomForm.readFields(f,evt.originalEvent.submitter);

		var args = {
			beforeSend:function(){
				f.children('.alert').remove();
				f.children('.notice').remove();
				f.find('input,textarea,select,button').prop('disabled',true);
				f.trigger('jlccustomformAjaxBeforeSend');
			},
			complete:function(){
				f.find('input,textarea,select,button').prop('disabled',false);
				f.trigger('jlccustomformAjaxCompleted');
			},
			data: formData,
			dataType: 'xml',
			error:function(a,b,c){
				f.prepend(JLCCustomFormAjaxNS.defaultError);
			},
			method: 'POST',
			success:function(a,b,c){
				var r = JLCCustomForm.parseWPAjax(a);

				if( !r )
					f.prepend(JLCCustomFormAjaxNS.defaultError);

				for( var i in r )
				{
					JLCCustomForm.readAjaxResponse(r, i ,f);
				}

				f.trigger('jlccustomformAjaxSuccessEnd');
			},
			url: JLCCustomFormAjaxNS.adminUrl
		};

		if( typeof FormData != 'undefined' )
		{
			args['processData'] = false;
			args['contentType'] = false;
		}
		
		xhr = $.ajax(args);
		f.data('jlccustomformxhr',xhr);
	}

	this.initializeAjaxForm = function(f)
	{
		f.submit(JLCCustomForm.submitForm);
	};

	this.initializeAjaxField = function(f)
	{
		f.change(JLCCustomForm.changedField); 
	};
/*
	$(document).ready(function(){
		$('form.jlc-custom-ajax-form').submit( JLCCustomForm.submitForm );

		$('.jlc-custom-ajax-field').change( JLCCustomForm.changedField );

	});
*/

};
