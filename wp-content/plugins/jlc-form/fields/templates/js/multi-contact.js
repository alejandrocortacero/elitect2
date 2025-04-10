"use strict";
(function($){
// TODO: update main value when a field is updated
	$(document).ready(function(){

		$('.jlc-custom-form-multi-contact-remove').click(function(evtrm){
			evtrm.preventDefault();
			$(evtrm.currentTarget).parent().parent().parent().parent().remove();

			var field = $(evtrm.currentTarget).data('field');

			var newValue = [];
			$('.jlc-custom-form-multi-contact-table-' + field + '-stored').each(function(ind,elem){
				var newItem = {
					'city': $(elem).find('input.city').val(),
					'postcode': $(elem).find('input.postcode').val(),
					'state': $(elem).find('input.state').val(),
					'country': $(elem).find('input.country').val(),
					'address': $(elem).find('input.address').val(),
					'longitude': $(elem).find('input.longitude').val(),
					'latitude': $(elem).find('input.latitude').val(),
					'email': $(elem).find('input.email').val(),
					'phone': $(elem).find('input.phone').val()
				};
				newValue.push(newItem);
			});
			$('input[name="' + field + '"]').val(JSON.stringify(newValue));
		});

		$('.jlc-custom-form-multi-contact-add').click(function(evt){
			evt.preventDefault();
			var target = $(evt.currentTarget);
			var field = target.data('field');

			var newTable = $('.jlc-custom-form-multi-contact-table-' + field + '-new').clone();
			newTable.removeClass('jlc-custom-form-multi-contact-table-' + field + '-new').addClass('jlc-custom-form-multi-contact-table-' + field + '-stored');
			var i = 0;
			
			newTable.find('.new-contact-row th').html(JLCCustomFormMultiContactNamespace.contact);
			newTable.find('.jlc-custom-form-multi-contact-add').replaceWith('<button class="button button-default jlc-custom-form-multi-contact-remove">' + JLCCustomFormMultiContactNamespace.remove + '</button>');
			newTable.find('input').removeAttr('placeholder').removeAttr('id');
			newTable.find('.jlc-custom-form-multi-contact-remove').click(function(evtrm){evtrm.preventDefault();$(evtrm.currentTarget).parent().parent().parent().parent().remove();});
			newTable.insertBefore('.jlc-custom-form-multi-contact-table-' + field + '-new');

			$('.jlc-custom-form-multi-contact-table-' + field + '-new input').val('');
			
			var newValue = [];
			$('.jlc-custom-form-multi-contact-table-' + field + '-stored').each(function(ind,elem){
				var newItem = {
					'city': $(elem).find('input.city').val(),
					'postcode': $(elem).find('input.postcode').val(),
					'state': $(elem).find('input.state').val(),
					'country': $(elem).find('input.country').val(),
					'address': $(elem).find('input.address').val(),
					'longitude': $(elem).find('input.longitude').val(),
					'latitude': $(elem).find('input.latitude').val(),
					'email': $(elem).find('input.email').val(),
					'phone': $(elem).find('input.phone').val()
				};
				newValue.push(newItem);
			});

			$('input[name="' + field + '"]').val(JSON.stringify(newValue));
		});
	});
})(jQuery);
