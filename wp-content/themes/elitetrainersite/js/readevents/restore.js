"use strict";
(function($){

	function personalTrainerUpdateBackground(f) {
		var s = f.find('.jlc-custom-form-background-select-type'); 	var color0 = f.find('.jlc-custom-form-background-color-0'); 	var color1 = f.find('.jlc-custom-form-background-color-1');  	if( s.val() == 'gradient' ) 	{ 		f.find('.jlc-custom-form-background-preview-inner').css('background-color',color0.val()); 		f.find('.jlc-custom-form-background-preview-inner').css('background-image','linear-gradient(to right, ' + color0.val() + ' 0, ' + color1.val() + ' 100%)'); 		color1.removeClass('hidden-field'); 	} 	else if( s.val() == 'gradient_v' ) 	{ 		f.find('.jlc-custom-form-background-preview-inner').css('background-color',color0.val()); 		f.find('.jlc-custom-form-background-preview-inner').css('background-image','linear-gradient(to bottom, ' + color0.val() + ' 0, ' + color1.val() + ' 100%)'); 		color1.removeClass('hidden-field'); 	} 	else 	{ 		f.find('.jlc-custom-form-background-preview-inner').css('background-color',color0.val()); 		f.find('.jlc-custom-form-background-preview-inner').css('background-image','none'); 		color1.addClass('hidden-field'); 	} }

	$(document).ready(function(){
		$('input[name="restore_val"]').val('0');

		$('button[name="restore"]').click(function(evt){
			evt.preventDefault();
			evt.stopPropagation();
			var f = $(evt.currentTarget).closest('form');
			f.find('input[name="restore_val"]').val("1");
			//console.log(f);
			f.submit();
		});
	});

	$(document).on('eliteTrainerThemeRestoreForm', function(evt,args){
		var f = $('input[name="jlc_custom_form"][value="' + args.formId + '"]').closest('form');
		for( var i in args.fields )
		{
			var fi = args.fields[i];
			var t = typeof fi.fieldType != 'undefined' ? fi.fieldType : null;

			if( t == 'background_field' )
			{
				var value = JSON.parse( fi.fieldValue );
				f.find('[name="' + fi.fieldName + '[type]"]').val( value.type );
				f.find('[name="' + fi.fieldName + '[color_0]"]').val( value.color_0 );
				f.find('[name="' + fi.fieldName + '[color_1]"]').val( value.color_1 );

				personalTrainerUpdateBackground(f.find('[name="' + fi.fieldName + '[type]"]').closest('.jlc-custom-form-background-field'));
			}
			else if( t == 'ajax_upload_image' )
			{
				var inp = f.find('[name="' + fi.fieldName + '"]');
				var p = inp.closest('.jlc-custom-form-upload-ajax-image-field');
				JLCCustomFormUploadAjaxImage.unsetImage(p);
			}
			else if( t == 'checkbox' )
			{
				var inp = f.find('[name="' + fi.fieldName + '"]');
				inp.prop('checked',fi.fieldValue);
			}
			else
			{
				var inp = f.find('[name="' + fi.fieldName + '"]');
				inp.val(fi.fieldValue);
			}
/*
			var tag = inp.prop('tagName');
			if( tag == 'INPUT' )
			{
				var t = inp.attr('type')	
			}
			else if( tag == 'SELECT' )
			{
			}
*/
		}

		f.find('input[name="restore_val"]').val('0');

	});
})(jQuery);

