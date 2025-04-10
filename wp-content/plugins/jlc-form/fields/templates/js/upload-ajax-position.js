"use strict";
/*
function jlcCustomFormUploadAjaxImagePositionSet(l,x,y)
{
	var preview = l.find('.jlc-custom-form-upload-ajax-image-field-preview');
	//var xWidth = l.width() * .05;
	//var yHeight = l.height() * .05;
	var img = l.find('.jlc-custom-form-upload-ajax-image-field-img');
	var xWidth = img.width() * .05;
	var yHeight = img.height() * .05;
console.log(yHeight);
	var xn = (x - 50.0) * xWidth / 100;
	var yn = (y - 50.0) * yHeight / 100;
	console.log( l.find('.jlc-custom-form-upload-ajax-img-id').attr('id') + ': ' + yn + '=(' + y + ' - 50.0) * ' + yHeight + ' /100');
	img.css('left', xn + 'px');
	img.css('top', yn + 'px');

	//var xn = (x - 50.0) / 10;
	//var yn = (y - 50.0) / 10;
	//img.css('left', xn + '%');
//	img.css('top', yn + '%');

}
*/
function jlcCustomFormUploadAjaxImagePositionSet(l,x,y)
{
	//var preview = l.find('.jlc-custom-form-upload-ajax-image-field-preview');
	var il = l.find('.jlc-custom-form-upload-ajax-image-field-img-layer');
//console.log( 'Setting:' + x + ' ' + 'y' );
	il.css('background-position', x + '% ' + y + '%');
}

function jlcCustomFormUploadAjaxImagePositionMove(l,dir)
{
	var pl = l.find('.jlc-custom-form-upload-ajax-image-field-img-layer');
	var xF = l.find('.jlc-custom-form-upload-ajax-img-x');
	var yF = l.find('.jlc-custom-form-upload-ajax-img-y');
	var x = parseFloat(xF.val());
	var y = parseFloat(yF.val());
	if( isNaN( x ) )
		x = 50;
	if( isNaN( y ) )
		y = 50;

	switch(dir)
	{
		case 'left':
			x -= 10;
			break;
		case 'right':
			x += 10;
			break;
		case 'up':
			y -= 10;
			break;
		case 'down':
			y += 10;
			break;
		default:
	}

	if( x < 0 ) x = 0;
	if( x > 100 ) x = 100;
	if( y < 0 ) y = 0;
	if( y > 100 ) y = 100;

	//pl.css('background-position', x + '% ' + y + '%');
	xF.val(x);
	yF.val(y);

	jlcCustomFormUploadAjaxImagePositionSet(l,x,y);
}

(function($){


	$(document).ready(function(){

		$('.jlc-custom-form-upload-ajax-image-position-field').each(function(ind,elem){
			var l = $(elem);
			jlcCustomFormUploadAjaxImagePositionMove(l,'');
		});

		$('.jlc-custom-form-upload-ajax-image-position-field .jlc-custom-form-move-image').click(function(evt){
			evt.preventDefault();

			var b = $(evt.currentTarget);
			var dir = b.data('to');
			var l = b.closest('.jlc-custom-form-upload-ajax-image-position-field');

			jlcCustomFormUploadAjaxImagePositionMove(l,dir);
		});
	});
})(jQuery);
