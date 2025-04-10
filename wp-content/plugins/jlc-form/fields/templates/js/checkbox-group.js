"use strict";

var JLCCustomFormCheckboxGroup = new function(){

	var $ = jQuery;
	var me = this;

	this.validateRequired = function(f)
	{
		var v = true;
		f.find('.jlc-custom-form-checkbox-group[required]').each(function(ind,elem){
			var e = $(elem);
			var c = e.find('input[type="checkbox"]:checked');
			if( !c.length )
			{
				e.addClass('has-error');
				$("body,html").animate({
					scrollTop: e.offset().top
					},
					800
				);
				v = false;
				return false;
			}
		});

		return v;
	};

	JLCCustomFormGlobal.addExtraValidator(me.validateRequired);

	$(document).ready(function(){
		$('.jlc-custom-form-checkbox-group[required] input[type="checkbox"]').change(function(evt){
			var c = $(evt.currentTarget);
			var l = c.closest('.jlc-custom-form-checkbox-group');
			if(l.hasClass('has-error'))
			{
				var s = l.find('input[type="checkbox"]:checked');
				if(s.length)
					l.removeClass('has-error');
			}
		});
	});
};
