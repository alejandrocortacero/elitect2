"use strict";

(function($){

function getObjectivesFromCookie()
{
	var objectivesCookieValue = EliteThemeNavigation.getCookie(EliteTrainerSiteTrainingFiltersNS.filterTrainingObjectivesCookie);
	var objectives = objectivesCookieValue.split(',');

	var e;
	while( ( e = objectives.indexOf('') ) != -1 )
		objectives.splice(e,1);

	return objectives;
}
function getEnvironmentsFromCookie()
{
	var environmentsCookieValue = EliteThemeNavigation.getCookie(EliteTrainerSiteTrainingFiltersNS.filterTrainingEnvironmentsCookie);
	var environments = environmentsCookieValue.split(',');

	var e;
	while( ( e = environments.indexOf('') ) != -1 )
		environments.splice(e,1);

	return environments;
}

function eliteTrainerSiteFilterTraining()
{
	var objectives = getObjectivesFromCookie();
	var environments = getEnvironmentsFromCookie();

	if( !objectives.length && !environments.length )
	{
		$('.training-templates .training-template').removeClass('hide-row');
	}
	else
	{
		$('.training-templates .training-template').addClass('hide-row');
		var str = '';

		for( var i in objectives )
			str += '.training-has-objective-' + objectives[i];

		for( var i in environments )
			str += '.training-has-environment-' + environments[i];

		$('.training-templates .training-template' + str).removeClass('hide-row');;
	}
}

$(document).ready(function(){
	$('.training-filters-toggler').click(function(evt){
		//var t = $(evt.currentTarget);
		var t = $('.training-filters-toggler');
		if( t.hasClass('on') )
		{
			t.removeClass('on');
			$('.training-filters').removeClass('on');
		}
		else
		{
			t.addClass('on');
			$('.training-filters').addClass('on');
		}
	});

	$('.training-objectives-filter input[type="checkbox"]').change(function(evt){
		var filter = $(evt.currentTarget);
		var checked = filter.prop('checked');
		var objective = filter.attr('data-objective');

		var cookieName = EliteTrainerSiteTrainingFiltersNS.filterTrainingObjectivesCookie;
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

		eliteTrainerSiteFilterTraining();
	});	

	$('.training-environments-filter input[type="checkbox"]').change(function(evt){
		var filter = $(evt.currentTarget);
		var checked = filter.prop('checked');
		var environment = filter.attr('data-environment');

		var cookieName = EliteTrainerSiteTrainingFiltersNS.filterTrainingEnvironmentsCookie;
		var cookieValue = EliteThemeNavigation.getCookie(cookieName);
		var environments = cookieValue.split(',');

		if( checked )
		{
			if( environments.indexOf(environment) == -1 )
			{
				environments.push(environment);
				cookieValue = environments.join(',');	

				var d = new Date();
				d.setTime(d.getTime() + (24*60*60*1000));
				document.cookie = cookieName + "=" + cookieValue + "; expires=" + d.toUTCString() + "; path=/";
			}
		}
		else
		{
			if( environments.indexOf(environment) != -1 )
			{
				environments.splice(environments.indexOf(environment),1);
				cookieValue = environments.join(',');	

				var d = new Date();
				d.setTime(d.getTime() + (24*60*60*1000));
				document.cookie = cookieName + "=" + cookieValue + "; expires=" + d.toUTCString() + "; path=/";
			}
		}

		eliteTrainerSiteFilterTraining();
	});	


	var objectivesCookieValue = EliteThemeNavigation.getCookie(EliteTrainerSiteTrainingFiltersNS.filterTrainingObjectivesCookie);
	var objectives = objectivesCookieValue.split(',');

	$('.training-filters .training-objectives-filter input[type="checkbox"]').each(function(ind,elem){
		var c = $(elem);
		var v = c.attr('data-objective');
		c.prop('checked', objectives.indexOf(v) != -1 );
	});

	var environmentsCookieValue = EliteThemeNavigation.getCookie(EliteTrainerSiteTrainingFiltersNS.filterTrainingEnvironmentsCookie);
	var environments = environmentsCookieValue.split(',');

	$('.training-filters .training-environments-filter input[type="checkbox"]').each(function(ind,elem){
		var c = $(elem);
		var v = c.attr('data-environment');
		c.prop('checked', environments.indexOf(v) != -1 );
	});

	eliteTrainerSiteFilterTraining();
});

})(jQuery);

