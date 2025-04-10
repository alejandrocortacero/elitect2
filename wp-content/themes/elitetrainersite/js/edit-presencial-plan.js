"use strict";

(function($){
	$('#edit-presencial-plan-modal').on('show.bs.modal', function (event) {
		//console.log('hola');
		var button = $(event.relatedTarget); // Button that triggered the modal
		var planId = button.data('plan'); // Extract info from data-* attributes

		var title = '', desc = '', times = '', prices = '', valoration = '';
		if (planId != '') {
			title = $('.presencial-plans-container .plan-row[data-plan="' + planId + '"] .title').html();
			desc = $('.presencial-plans-container .plan-row[data-plan="' + planId + '"] .desc').html();
			times = $('.presencial-plans-container .plan-row[data-plan="' + planId + '"] .times').html();
			prices = $('.presencial-plans-container .plan-row[data-plan="' + planId + '"] .prices').html();
			valoration = $('.presencial-plans-container .plan-row[data-plan="' + planId + '"] .valoration').data('valoration');
		}

		// If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
		// Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
		var modal = $(this);
		//modal.find('.modal-title').text('New message to ' + recipient)
		modal.find('.modal-body input[name="plan"]').val(planId);
		modal.find('.modal-body input[name="presencialplantitle"]').val(title);
		modal.find('.modal-body input[name="presencialplandesc"]').val(desc);
		modal.find('.modal-body input[name="presencialplantimes"]').val(times);
		modal.find('.modal-body input[name="presencialplanprices"]').val(prices);
		modal.find('.modal-body input[name="valoration"]').val(valoration);
		// modal.find('.modal-body input[name="casedesc"]').val(comment);


		var editor = tinymce.get('presencialplantitle');
		console.log('Editor for title:', editor);
		if (editor) editor.setContent(title);


		editor = tinymce.get('presencialplandesc');
		if( editor )
			editor.setContent(desc);

		editor = tinymce.get('presencialplantimes');
		if( editor )
			editor.setContent(times);

		editor = tinymce.get('presencialplanprices');
		if( editor )
			editor.setContent(prices);

		// var modal = $(this);
		// modal.find('.modal-body input[name="plan"]').val(planId);
		//
		// // Ensure TinyMCE editors are updated
		// var editor = tinymce.get('presencialplantitle');
		// if (editor) editor.setContent(title);
		//
		// editor = tinymce.get('presencialplandesc');
		// if (editor) editor.setContent(desc);
		//
		// editor = tinymce.get('presencialplantimes');
		// if (editor) editor.setContent(times);
		//
		// editor = tinymce.get('presencialplanprices');
		// if (editor) editor.setContent(prices);

		// mark


	});

	$('.edit-presencial-plan-form button[name="send"]').click(function(evt){
		tinyMCE.triggerSave();

		$(evt.currentTarget).closest('form').find('.alert').remove();

		var fields = {
			'presencialplantitle':'El tipo no puede estar vacío',
			'presencialplandesc':'El campo "Incluye" no puede estar vacío.',
			'presencialplantimes':'El campo "Clases" no puede estar vacío.',
			'presencialplanprices':'El campo "Precios" no puede estar vacío.'
		};
		var editor = null, c = null;
		for( var i in fields )
		{
			editor = tinymce.get(i);
			c = editor.getContent();
			if( c.trim().length < 1 )
			{
				var h = '<div class="alert alert-danger">' + fields[i] + '</div>';
				var hh = $(evt.currentTarget).closest('form').prepend(h);

				$('#edit-presencial-plan-modal').animate({
					scrollTop: hh.offset().top
				}, 1000);

				return;
			}
		}

		$(evt.currentTarget).closest('form').submit();
	});
})(jQuery);