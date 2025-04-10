"use strict";

(function($){

function eliteTrainerSiteFilterExerciseCategories(selected)
{
	if( selected == 'all' )
	{
		$('.exercises .exercise').removeClass('hide-row');
	}
	else
	{
		$('.exercises .exercise').addClass('hide-row');
		$('.exercises .exercise.exercise-category-' + selected).removeClass('hide-row');
	}
}

$(document).ready(function(){
	$('.exercise-category-filter').change(function(evt){
		var filter = $(evt.currentTarget);
		var selected = filter.val();

		var cookieName = EliteTrainerSiteExerciseFiltersNS.filterExerciseCategoryCookie;

		var d = new Date();
		d.setTime(d.getTime() + (24*60*60*1000));
		document.cookie = cookieName + "=" + selected + "; expires=" + d.toUTCString() + "; path=/";

		eliteTrainerSiteFilterExerciseCategories(selected);
	});	

	var categoriesCookieValue = EliteThemeNavigation.getCookie(EliteTrainerSiteExerciseFiltersNS.filterExerciseCategoryCookie);
	if( categoriesCookieValue == '' )
		categoriesCookieValue = 'all';

	$('.exercise-category-filter').val(categoriesCookieValue);
	eliteTrainerSiteFilterExerciseCategories(categoriesCookieValue);
});

})(jQuery);
