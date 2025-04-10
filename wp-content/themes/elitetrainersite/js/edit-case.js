"use strict";

(function($){
	$('#edit-case-modal').on('show.bs.modal', function (event) {
	//console.log('hola');
	  var button = $(event.relatedTarget); // Button that triggered the modal
	  var caseId = button.data('case'); // Extract info from data-* attributes
		var title = '';
		var comment = '';
		var before = '';
		var after = '';
		var beforeUrl = JLCCustomFormUploadAjaxNS.blankImageUrl;
		var afterUrl = JLCCustomFormUploadAjaxNS.blankImageUrl;
		if( caseId != '' )
		{
			title = $('.cases-container .row[data-case="' + caseId + '"] h3').text();
			comment = $('.cases-container .row[data-case="' + caseId + '"] .inner-text').html();
			before = $('.cases-container .row[data-case="' + caseId + '"] .real-case-photo-before').data('photo-id');
			after = $('.cases-container .row[data-case="' + caseId + '"] .real-case-photo-after').data('photo-id');
			beforeUrl = $('.cases-container .row[data-case="' + caseId + '"] .real-case-photo-before').data('photo-url');
			afterUrl = $('.cases-container .row[data-case="' + caseId + '"] .real-case-photo-after').data('photo-url');
		}
	  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
	  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
	  var modal = $(this);
	  //modal.find('.modal-title').text('New message to ' + recipient)

/*
ESTO ERA PARA CUANDO NO HABIA CROPPER
	  modal.find('.modal-body input[name="case"]').val(caseId);
	  modal.find('.modal-body input[name="title"]').val(title);
	  modal.find('.modal-body input[name="photo"]').val(before);
	  modal.find('.modal-body input[name="after"]').val(after);
	  modal.find('.modal-body input[name="photo"]').siblings('.jlc-custom-form-upload-ajax-image-field-preview').find('.jlc-custom-form-upload-ajax-image-field-img').prop('src',beforeUrl);
	  modal.find('.modal-body input[name="after"]').siblings('.jlc-custom-form-upload-ajax-image-field-preview').find('.jlc-custom-form-upload-ajax-image-field-img').prop('src',afterUrl);
console.log(afterUrl);
*/


	  modal.find('.modal-body input[name="case"]').val(caseId);
	  modal.find('.modal-body input[name="title"]').val(title);
	  modal.find('.modal-body input[name="photo[id]"]').val(before);
	  modal.find('.modal-body input[name="after[id]"]').val(after);

	  modal.find('.modal-body input[name="photo[id]"]').closest('.jlc-custom-form-upload-ajax-image-field').find('.jlc-custom-form-upload-ajax-image-field-img').prop('src',beforeUrl);
	  modal.find('.modal-body input[name="after[id]"]').closest('.jlc-custom-form-upload-ajax-image-field').find('.jlc-custom-form-upload-ajax-image-field-img').prop('src',afterUrl);
	if(before != '')
	{
		$('.modal-body input[name="photo[id]"]').closest('.jlc-custom-form-upload-ajax-image-cropper-field').addClass('set');
	}
	else
	{
		$('.modal-body input[name="photo[id]"]').closest('.jlc-custom-form-upload-ajax-image-cropper-field').removeClass('set');
	}
	if(after != '')
	{
		$('.modal-body input[name="after[id]"]').closest('.jlc-custom-form-upload-ajax-image-cropper-field').addClass('set');
	}
	else
	{
		$('.modal-body input[name="after[id]"]').closest('.jlc-custom-form-upload-ajax-image-cropper-field').removeClass('set');
	}
/*
setTimeout(function(){
//console.log($('.modal-body input[name="photo[id]"]').closest('.jlc-custom-form-upload-ajax-image-cropper-field'));
	JLCCustomFormUploadAjaxCropper.refreshCropper($('.modal-body input[name="photo[id]"]').closest('.jlc-custom-form-upload-ajax-image-cropper-field'));
	JLCCustomFormUploadAjaxCropper.refreshCropper($('.modal-body input[name="after[id]"]').closest('.jlc-custom-form-upload-ajax-image-cropper-field'));
},1000);
*/

	  //modal.find('.modal-body input[name="casedesc"]').val(comment);
		var editor = tinymce.get('casedesc');
		if( editor )
			editor.setContent(comment);

	
	});

	$('.edit-real-case-form button[name="send"]').click(function(evt){
		tinyMCE.triggerSave();

		$(evt.currentTarget).closest('form').find('.alert').remove();

		var editor = tinymce.get('casedesc');
		var c = editor.getContent();
		if( c.trim().length < 1 )
		{
			var h = '<div class="alert alert-danger">El comentario no puede estar vacío.</div>';
			var hh = $(evt.currentTarget).closest('form').prepend(h);

			$('#edit-case-modal').animate({
				scrollTop: hh.offset().top
			}, 1000);

			return;
		}

		$(evt.currentTarget).closest('form').submit();
	});
})(jQuery);
