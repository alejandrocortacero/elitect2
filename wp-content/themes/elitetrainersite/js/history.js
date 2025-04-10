"use strict";
(function($){
	$(document).ready(function(){
/*
		$(document).on('eliteTrainerThemeHistoryList', function(evt,args){

			var postData = {
				'action':EliteTrainerSiteStyleNS.updateAction
			};

			$.ajax({
				url: EliteTrainerSiteStyleNS.adminUrl,
				type: 'POST',
				data: postData,
				//contentType: false,
				//processData: false,
				complete:function(){
					//cc.removeClass('loading');
				},
				success: function(a,b,c){

					$('#trainer-site-custom-style').replaceWith(a);

					$('div.modal').modal('hide');
				},
			});
		});
*/
		$(document).on('click','.history-row', function(evt,args){
			var r = $(evt.currentTarget);
			console.log(r.data());
			var f = r.closest('form');

			var fData = r.data();
			for( var i in fData )
			{
				var fi = f.find('[name="' + i + '"]');
				fi.val(fData[i]);
				if( fi.closest('.jlc-custom-form-upload-ajax-image-field').length > 0 )
				{
					var cf = fi.closest('.jlc-custom-form-upload-ajax-image-field');
					cf.addClass('loading');
					
					$.ajax({
						url: EliteTrainerSiteHistoryNS.adminUrl,
						type: 'POST',
						data: {'id':fData[i],'action':EliteTrainerSiteHistoryNS.getImageByIdAction},
						complete:function(){
							cf.removeClass('loading');
						},
						success: function(a,b,c){
							var a = JSON.parse(a);
							if( typeof a.url != 'undefined' )
							{
								var url = a.url != '' ? a.url : JLCCustomFormUploadAjaxNS.blankImageUrl;

								cf.find('.jlc-custom-form-upload-ajax-image-field-img').prop('src',url);
								cf.find('.jlc-custom-form-upload-ajax-image-field-img-layer').css('background-image','url("' + url + '")');
							}
						}
					});

				}
			}
		});

		$('.open-history').click(function(evt){
			evt.preventDefault();
	
			var b = $(evt.currentTarget);
			var f = b.closest('form');
			var fn = f.find('input[name="jlc_custom_form"]').val();

			var postData = {
				'action':EliteTrainerSiteHistoryNS.readHistoryAction,
				'form': fn
			};

			f.find('.history-table').remove();
			f.append('<div class="loading-history"><h3 class="text-center">Cargando historial...</h3></div>');

			$.ajax({
				url: EliteTrainerSiteHistoryNS.adminUrl,
				type: 'POST',
				data: postData,
				//contentType: false,
				//processData: false,
				complete:function(){
					f.find('.loading-history').remove();
					//cc.removeClass('loading');
				},
				success: function(a,b,c){

					f.append(a);
					//$('#trainer-site-custom-style').replaceWith(a);

					//$('div.modal').modal('hide');
				},
			});
		});
	});
})(jQuery);
