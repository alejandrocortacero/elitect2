"use strict";

(function($){

$(document).on('jlc_calendar_day_selected',function(e,args){
	var d = args.day;
	var c = d.closest('.jlc-calendar');
	var f = c.closest('.jlc-custom-form-calendar-combo').find('.jlc-calendar-value-field');

	var s = JLCCalendar.getSelectedDate(c);

	f.val( s && s.length ? JSON.stringify(s) : '' );
});
$(document).on('jlc_calendar_day_deselected',function(e,args){
	var d = args.day;
	var c = d.closest('.jlc-calendar');
	var f = c.closest('.jlc-custom-form-calendar-combo').find('.jlc-calendar-value-field');

	var s = JLCCalendar.getSelectedDate(c);

	f.val( s && s.length ? JSON.stringify(s) : '' );
});

$(document).on('jlc_calendar_period_selected',function(e,args){
	var p = args.period;
	var c = p.closest('.jlc-calendar');
	var f = c.closest('.jlc-custom-form-calendar-combo').find('.jlc-calendar-value-field');

	var s = JLCCalendar.getSelectedDateTime(c);

	f.val(s && s.length ? JSON.stringify(s) : '');
});
$(document).on('jlc_calendar_period_deselected',function(e,args){
	var p = args.period;
	var c = p.closest('.jlc-calendar');
	var f = c.closest('.jlc-custom-form-calendar-combo').find('.jlc-calendar-value-field');

	var s = JLCCalendar.getSelectedDateTime(c);

	f.val(s && s.length ? JSON.stringify(s) : '');
});


$(document).ready(function(){

	JLCCustomFormGlobal.addExtraValidator(function(f){
		var fields = f.find('.jlc-calendar-value-field[required="required"]');
		var ret = true;
		fields.each(function(ind,elem){
			var fi = $(elem);
			if( fi.val() == '' || fi.val() == '[]' || fi.val() == '{}' )
			{
				ret = false;
				fi.closest('.jlc-custom-form-calendar-combo').addClass('error-required-field');
				return false;
			}
		});

		return ret;
	});

	$('.jlc-custom-form-calendar-combo .jlc-calendar-value-field').each(function(ind,elem){
		var f = $(elem);

		// Remove error-required-field has
		f.change(function(evt){
			var fi = $(evt.currentTarget);
			if( fi.val() != '' && fi.val() != '[]' && fi.val() == '{}' )
			{
				fi.closest('.jlc-custom-form-calendar-combo').removeClass('error-required-field');
			}
		});

		// Reload calendar if input has a different value from original
		var co = f.closest('.jlc-custom-form-calendar-combo');
		var c = co.find('.jlc-calendar');

		var v = f.val();
		//var o = f.data('original');
		var o = f.attr('data-original');

		if( v != o )
		{
			if( v.length )
			{
				try
				{
					v = JSON.parse(v);
				} catch( exc ) {}

/*
				console.log(v);
				if( typeof v == 'string' )
				{
					JLCCalendar.preselectValue(c,v);
				}
				else
				{
					for( var i in v )
						JLCCalendar.preselectValue(c,v[i]);
				}
*/

				JLCCalendar.updateCalendar(c,v);
			}
			else
			{
				JLCCalendar.updateCalendar(c,'');
				//JLCCalendar.clearAllSelections(c);
			}
		}
	});
});

})(jQuery);
