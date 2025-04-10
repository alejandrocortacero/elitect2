"use strict";

var JLCSearchForm = new function(){

	var $ = jQuery;

	this.submitForm = function(evt){
		evt.preventDefault();
		var f = $(evt.target);
		var formData = JLCCustomForm.readFields(f);

		var args = {
			beforeSend:function(){
				f.children('.alert').remove();
				//f.find('input,textarea,select,button').prop('disabled',true);
				f.children(f.data('css-selector')).addClass('searching');
			},
			complete:function(){
				//f.find('input,textarea,select,button').prop('disabled',false);
				f.children(f.data('css-selector')).removeClass('searching');
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
					var action = r[i].action;
					switch(action)
					{
						case 'refreshSearchResults':
							f.children(f.data('css-selector')).children('.content').html(r[i].data);
							break;
						default:
							JLCCustomForm.readAjaxResponse(r, i ,f);
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
		
		$.ajax(args);
	}

	$(document).ready(function(){
		$('form.jlc-search-form').off( 'submit', JLCCustomForm.submitForm );
		$('form.jlc-search-form').submit( JLCSearchForm.submitForm );
		$('form.jlc-search-form input[name="jlcsearchfield"]').on( 'input', function(evt){
			var i = $(evt.currentTarget);
			var f = i.closest('form');
			f.submit();
		});
		$('form.jlc-search-form input[name="jlcsearchfield"]').each(function(ind,elem){
			var i = $(elem);
			if( i.val() != '' )
			{
				var f = i.closest('form');
				f.submit();
			}
		});

	});

};

