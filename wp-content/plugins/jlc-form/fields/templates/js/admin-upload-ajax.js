"use strict";

(function($){
	function JLCCustomFormSelectImage(button)
	{
		if(wp.media.frames.jlcCustomFormImageFrame) {
			wp.media.frames.jlcCustomFormImageFrame.srcButton = button;
			wp.media.frames.jlcCustomFormImageFrame.open();
			return;
		}

		wp.media.frames.jlcCustomFormImageFrame = wp.media({
			title: JLCCustomFormUploadAjaxNS.selectImage,
			multiple: false,
			library: {
				type: 'image'
			},
			button: {
				text: JLCCustomFormUploadAjaxNS.useImage
			}
		});

		wp.media.frames.jlcCustomFormImageFrame.srcButton = button;

		wp.media.frames.jlcCustomFormImageFrame.on( 'open', function() {
			var s = $(wp.media.frames.jlcCustomFormImageFrame.srcButton.parent().data('field')).val();
			if( s != '' )
				wp.media.frames.jlcCustomFormImageFrame.state().get('selection').add(wp.media.attachment(s));
		});

		wp.media.frames.jlcCustomFormImageFrame.on( 'select', function() {
			
			//var attachment = frame.state().get('selection').first().toJSON();
			var attachment = wp.media.frames.jlcCustomFormImageFrame.state().get('selection').first().toJSON();
			console.log(attachment);
			JLCCustomFormSetImage(wp.media.frames.jlcCustomFormImageFrame.srcButton,attachment);

		});

		wp.media.frames.jlcCustomFormImageFrame.open();
	}
	function JLCCustomFormSetImage(b,a)
	{
		var p = b.parent();
		$(p.data('field')).val(a.id);
		$(p.data('image')).prop('src',typeof a.sizes.thumbnail != 'undefined' && typeof a.sizes.thumbnail.url != 'undefined' ? a.sizes.thumbnail.url : a.url );
		$(p.data('control')).addClass('set');
	}

	$(document).ready(function(){
		// Script writeen under the condition of every button
		// is child of common layer with data targets defined
		$('.jlc-custom-form-remove-image').click(function(evt){
			evt.preventDefault();
			var b = $(this);
			var p = b.parent();

			$(p.data('field')).val('');
			$(p.data('image')).prop('src',JLCCustomFormUploadAjaxNS.blankImageUrl);
			$(p.data('control')).removeClass('set');
		});	

		$('.jlc-custom-form-add-image').click(function(evt){
			evt.preventDefault();
			var b = $(this);
			JLCCustomFormSelectImage(b);
		});	

		$('.jlc-custom-form-change-image').click(function(evt){
			evt.preventDefault();
			var b = $(this);
			JLCCustomFormSelectImage(b);
		});	
	
	});
})(jQuery);
