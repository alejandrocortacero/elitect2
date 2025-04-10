"use strict";
(function($){
function jlcCustomFormBackgroundTransformColor(hex,opacity)
{
	var c;
    if(/^#([A-Fa-f0-9]{3}){1,2}$/.test(hex)){
        c= hex.substring(1).split('');
        if(c.length== 3){
            c= [c[0], c[0], c[1], c[1], c[2], c[2]];
        }
        c= '0x'+c.join('');
        return 'rgba('+[(c>>16)&255, (c>>8)&255, c&255].join(',')+',' + opacity + ')';
    }

	return 'rgba(0,0,0,1)';
}
function jlcCustomFormBackgroundUpdate(f)
{
	var s = f.find('.jlc-custom-form-background-select-type');
	var color0 = f.find('.jlc-custom-form-background-color-0');
	var color1 = f.find('.jlc-custom-form-background-color-1');
	var color0opacity = f.find('.jlc-custom-form-background-color-0-opacity').val();
	var color1opacity = f.find('.jlc-custom-form-background-color-1-opacity').val();

	if( isNaN(parseFloat(color0opacity)) || !isFinite(color0opacity) )
		color0opacity = 1;
	if( isNaN(parseFloat(color1opacity)) || !isFinite(color1opacity) )
		color1opacity = 1;

	var c0 = jlcCustomFormBackgroundTransformColor(color0.val(), color0opacity);
	var c1 = jlcCustomFormBackgroundTransformColor(color1.val(), color1opacity);
	

	var l1 = color1.closest('.color-col');

	if( s.val() == 'gradient' )
	{
		f.find('.jlc-custom-form-background-preview-inner').css('background-color',c0);
		f.find('.jlc-custom-form-background-preview-inner').css('background-image','linear-gradient(to right, ' + c0 + ' 0, ' + c1 + ' 100%)');
		l1.removeClass('hidden-field');
	}
	else if( s.val() == 'gradient_v' )
	{
		f.find('.jlc-custom-form-background-preview-inner').css('background-color',c0);
		f.find('.jlc-custom-form-background-preview-inner').css('background-image','linear-gradient(to bottom, ' + c0 + ' 0, ' + c1 + ' 100%)');
		l1.removeClass('hidden-field');
	}
	else
	{
		f.find('.jlc-custom-form-background-preview-inner').css('background-color',c0);
		f.find('.jlc-custom-form-background-preview-inner').css('background-image','none');
		l1.addClass('hidden-field');
	}
}
$(document).ready(function(){
	$('.jlc-custom-form-background-field .jlc-custom-form-background-select-type').change(function(evt){
		var s = $(evt.currentTarget);
		var f = s.closest('.jlc-custom-form-background-field');

		jlcCustomFormBackgroundUpdate(f);
	});

	$('.jlc-custom-form-background-field .jlc-custom-form-background-color-0').change(function(evt){
		var color0 = $(evt.currentTarget);
		var f = color0.closest('.jlc-custom-form-background-field');
		jlcCustomFormBackgroundUpdate(f);
	});

	$('.jlc-custom-form-background-field .jlc-custom-form-background-color-1').change(function(evt){
		var color1 = $(evt.currentTarget);
		var f = color1.closest('.jlc-custom-form-background-field');

		jlcCustomFormBackgroundUpdate(f);
	});

	$('.jlc-custom-form-background-field .jlc-custom-form-background-color-0-opacity[type!="hidden"]').on('input',function(evt){
		var color0 = $(evt.currentTarget);
		var f = color0.closest('.jlc-custom-form-background-field');
		jlcCustomFormBackgroundUpdate(f);
	});

	$('.jlc-custom-form-background-field .jlc-custom-form-background-color-1-opacity[type!="hidden"]').on('input',function(evt){
		var color1 = $(evt.currentTarget);
		var f = color1.closest('.jlc-custom-form-background-field');

		jlcCustomFormBackgroundUpdate(f);
	});

console.log($('.jlc-custom-form-background-field .jlc-custom-form-background-color-0-opacity[type="hidden"]'));
	$('.jlc-custom-form-background-field .jlc-custom-form-background-color-0-opacity[type="hidden"]').change(function(evt){
console.log('xxxxx');
		var color0 = $(evt.currentTarget);
		var f = color0.closest('.jlc-custom-form-background-field');
		jlcCustomFormBackgroundUpdate(f);
	});

	$('.jlc-custom-form-background-field .jlc-custom-form-background-color-1-opacity[type="hidden"]').change(function(evt){
		var color1 = $(evt.currentTarget);
		var f = color1.closest('.jlc-custom-form-background-field');

		jlcCustomFormBackgroundUpdate(f);
	});

	$('.jlc-custom-form-background-field').each(function(ind,elem){
		var f = $(elem);
		jlcCustomFormBackgroundUpdate(f);
	});
});
})(jQuery);
