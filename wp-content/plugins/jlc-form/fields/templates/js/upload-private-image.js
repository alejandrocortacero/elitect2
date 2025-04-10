"use strict";

(function($){
	$(document).ready(function(){
		$('.jlc-custom-form-upload-private-image-wrapper input[type="file"]').change(function(evt){
			const field = evt.currentTarget;
			const file = field.files[0];
			if (file) {
				const fileReader = new FileReader();
				const preview = $(field).closest('.jlc-custom-form-upload-private-image-wrapper').find('.jlc-custom-form-upload-private-image-preview img');
				fileReader.readAsDataURL(file);
				fileReader.addEventListener( "load", function(){
					//imgPreview.style.display = "block";
					//preview.innerHTML = '<img src="' + this.result + '" />';
					preview.prop('src', this.result);
				});    

				$(field).data('has-value',true);
				$(field).trigger('jlc-custom-form-upload-private-image-changed');
			}
		});
	});
})(jQuery);
