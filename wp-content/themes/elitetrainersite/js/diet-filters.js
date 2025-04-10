"use strict";

(function($){

function getObjectivesFromCookie()
{
	var objectivesCookieValue = EliteThemeNavigation.getCookie(EliteTrainerSiteDietFiltersNS.filterDietObjectivesCookie);
	var objectives = objectivesCookieValue.split(',');

	var e;
	while( ( e = objectives.indexOf('') ) != -1 )
		objectives.splice(e,1);

	return objectives;
}
function getRestrictionsFromCookie()
{
	var restrictionsCookieValue = EliteThemeNavigation.getCookie(EliteTrainerSiteDietFiltersNS.filterDietRestrictionsCookie);
	var restrictions = restrictionsCookieValue.split(',');

	var e;
	while( ( e = restrictions.indexOf('') ) != -1 )
		restrictions.splice(e,1);

	return restrictions;
}

function eliteTrainerSiteFilterDiet()
{
	var objectives = getObjectivesFromCookie();
	var restrictions = getRestrictionsFromCookie();

	if( !objectives.length && !restrictions.length )
	{
		$('.diet-templates .diet-template').removeClass('hide-row');
	}
	else
	{
		$('.diet-templates .diet-template').addClass('hide-row');
		var str = '';

		for( var i in objectives )
			str += '.diet-has-objective-' + objectives[i];

		for( var i in restrictions )
			str += '.diet-has-restriction-' + restrictions[i];

		$('.diet-templates .diet-template' + str).removeClass('hide-row');;
	}
}

$(document).ready(function(){
	$('.diet-filters-toggler').click(function(evt){
		//var t = $(evt.currentTarget);
		var t = $('.diet-filters-toggler');
		if( t.hasClass('on') )
		{
			t.removeClass('on');
			$('.diet-filters').removeClass('on');
		}
		else
		{
			t.addClass('on');
			$('.diet-filters').addClass('on');
		}
	});

	$('.diet-objectives-filter input[type="checkbox"]').change(function(evt){
		var filter = $(evt.currentTarget);
		var checked = filter.prop('checked');
		var objective = filter.attr('data-objective');

		var cookieName = EliteTrainerSiteDietFiltersNS.filterDietObjectivesCookie;
		var cookieValue = EliteThemeNavigation.getCookie(cookieName);
		var objectives = cookieValue.split(',');

		if( checked )
		{
			if( objectives.indexOf(objective) == -1 )
			{
				objectives.push(objective);
				cookieValue = objectives.join(',');	

				var d = new Date();
				d.setTime(d.getTime() + (24*60*60*1000));
				document.cookie = cookieName + "=" + cookieValue + "; expires=" + d.toUTCString() + "; path=/";
			}
		}
		else
		{
			if( objectives.indexOf(objective) != -1 )
			{
				objectives.splice(objectives.indexOf(objective),1);
				cookieValue = objectives.join(',');	

				var d = new Date();
				d.setTime(d.getTime() + (24*60*60*1000));
				document.cookie = cookieName + "=" + cookieValue + "; expires=" + d.toUTCString() + "; path=/";
			}
		}

		eliteTrainerSiteFilterDiet();
	});	

	$('.diet-restrictions-filter input[type="checkbox"]').change(function(evt){
		var filter = $(evt.currentTarget);
		var checked = filter.prop('checked');
		var restriction = filter.attr('data-restriction');

		var cookieName = EliteTrainerSiteDietFiltersNS.filterDietRestrictionsCookie;
		var cookieValue = EliteThemeNavigation.getCookie(cookieName);
		var restrictions = cookieValue.split(',');

		if( checked )
		{
			if( restrictions.indexOf(restriction) == -1 )
			{
				restrictions.push(restriction);
				cookieValue = restrictions.join(',');	

				var d = new Date();
				d.setTime(d.getTime() + (24*60*60*1000));
				document.cookie = cookieName + "=" + cookieValue + "; expires=" + d.toUTCString() + "; path=/";
			}
		}
		else
		{
			if( restrictions.indexOf(restriction) != -1 )
			{
				restrictions.splice(restrictions.indexOf(restriction),1);
				cookieValue = restrictions.join(',');	

				var d = new Date();
				d.setTime(d.getTime() + (24*60*60*1000));
				document.cookie = cookieName + "=" + cookieValue + "; expires=" + d.toUTCString() + "; path=/";
			}
		}

		eliteTrainerSiteFilterDiet();
	});	


	var objectivesCookieValue = EliteThemeNavigation.getCookie(EliteTrainerSiteDietFiltersNS.filterDietObjectivesCookie);
	var objectives = objectivesCookieValue.split(',');

	$('.diet-filters .diet-objectives-filter input[type="checkbox"]').each(function(ind,elem){
		var c = $(elem);
		var v = c.attr('data-objective');
		c.prop('checked', objectives.indexOf(v) != -1 );
	});

	var restrictionsCookieValue = EliteThemeNavigation.getCookie(EliteTrainerSiteDietFiltersNS.filterDietRestrictionsCookie);
	var restrictions = restrictionsCookieValue.split(',');

	$('.diet-filters .diet-restrictions-filter input[type="checkbox"]').each(function(ind,elem){
		var c = $(elem);
		var v = c.attr('data-restriction');
		c.prop('checked', restrictions.indexOf(v) != -1 );
	});

	eliteTrainerSiteFilterDiet();
});

})(jQuery);


