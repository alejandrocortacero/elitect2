"use strict";

(function($){
	$(document).ready(function(){
		$('.confirm-delete-member').click(function(evt){
			evt.preventDefault();

			var button = $(evt.currentTarget);
			var member = button.data('member');
			
			var ajaxData = {
				'action':EpointPersonalTrainerDeleteMembersFilterNS.deleteMemberAction,
				'member':member
			};

			$.ajax({
				url:EpointPersonalTrainerDeleteMembersFilterNS.ajaxUrl,
				data:ajaxData,
				method:'POST',
				complete:function(){
					$('.modal').modal('hide');
					$('.search-members-form input[type="reset"]').click();
				},
				success:function(a,b,c){
					//l.html(a);
				}
			});
		});

		$('.confirm-deactivate-member').click(function(evt){
			evt.preventDefault();

			var button = $(evt.currentTarget);
			var member = button.data('member');
			
			var ajaxData = {
				'action':EpointPersonalTrainerDeleteMembersFilterNS.deactivateMemberAction,
				'member':member
			};

			$.ajax({
				url:EpointPersonalTrainerDeleteMembersFilterNS.ajaxUrl,
				data:ajaxData,
				method:'POST',
				complete:function(){
					$('.modal').modal('hide');
					$('.search-members-form input[type="reset"]').click();
				},
				success:function(a,b,c){
					//l.html(a);
				}
			});
		});

		$('.confirm-reactivate-member').click(function(evt){
			evt.preventDefault();

			var button = $(evt.currentTarget);
			var member = button.data('member');
			
			var ajaxData = {
				'action':EpointPersonalTrainerDeleteMembersFilterNS.reactivateMemberAction,
				'member':member
			};

			$.ajax({
				url:EpointPersonalTrainerDeleteMembersFilterNS.ajaxUrl,
				data:ajaxData,
				method:'POST',
				complete:function(){
					$('.modal').modal('hide');
					$('.search-members-form input[type="reset"]').click();
				},
				success:function(a,b,c){
					//l.html(a);
				}
			});
		});
	});
})(jQuery);

