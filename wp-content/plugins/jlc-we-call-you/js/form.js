"use strict";

(function(){

	function lockForm()
	{
		jQuery('#jlc_contact_form input, #jlc_contact_form select, #jlc_contact_form textarea').prop('disabled',true);
		jQuery('#jlc_contact_form button.send').prop('disabled',true).addClass('loading').children('.text').text(JLCContactForm.sending);
	}
	function unlockForm()
	{
		jQuery('#jlc_contact_form button.send').prop('disabled',false).removeClass('loading').children('.text').text(JLCContactForm.send);
		jQuery('#jlc_contact_form input, #jlc_contact_form select, #jlc_contact_form textarea').prop('disabled',false);
	}

	var $ = jQuery;
	$(document).ready(function(){
		$('#jlc_contact_form').submit(function(evt){
			evt.preventDefault();

			var formData = {};
			$('#jlc_contact_form input,#jlc_contact_form select,#jlc_contact_form textarea').each(function(ind,elem){
				formData[$(elem).attr('name')] = $(elem).val();
			});
			$.ajax({
				method:'POST',
				url:JLCContactForm.url,
				data:formData,
				beforeSend:function(){
					lockForm();
					$('#jlc_contact_form').siblings('.alert').remove();
				},
				success:function(response){
					try
					{
						var responseObj = JSON.parse(response);
						if( responseObj.code == 0 )
						{
							$('#jlc_contact_form input[type!="hidden"][type!="checkbox"][readonly!="readonly"],#jlc_contact_form textarea').val('');
							if( JLCContactForm.gtagEventConversion != '' )
							{
								gtag('event', 'conversion', {'send_to': JLCContactForm.gtagEventConversion });
							}
						}

							$('#jlc_contact_form input.unchecked').attr('checked',false);

						jQuery('#jlc_contact_form').before(responseObj.message);
					}
					catch(ex)
					{
						jQuery('#jlc_contact_form').before(JLCContactForm.errorMessage);
					}
				},
				error:function(){
					jQuery('#jlc_contact_form').before(JLCContactForm.errorMessage);
				},
				complete:function(){
					unlockForm();
				}
			});
		});
	});
})();
