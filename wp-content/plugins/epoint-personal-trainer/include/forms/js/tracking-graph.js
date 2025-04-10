'use strict';

function epointpersonaltrainerdrawgraph( obj, part, row )
{
	var data = new google.visualization.DataTable();
	data.addColumn('date', obj.xAxisName);
	data.addColumn('number', 'value');
	var dataRows = [];
	for( var j in row.values )
	{
		var rowValue = row.values[j];
		dataRows.push([new Date(rowValue.year,rowValue.month,rowValue.day), rowValue.value]);
	}
//console.log(dataRows);

	data.addRows( dataRows );

	var wrapper = new google.visualization.ChartWrapper({
		chartType: 'LineChart',
		dataTable: data,
		options: {'title': row.name + '(' + row.unit + ')' , 'legend':'none', 'pointsVisible':true },
		containerId: 'part-' + part
	});
	wrapper.draw()
}

function epointPersonalTrainerInitializeGraphs()
{
	if( typeof( EpointPersonalTrainerGraphNS ) != 'undefined' )
	{
		epointPersonalTrainerInitializeSubGraphs(EpointPersonalTrainerGraphNS);
	}
	if( typeof( EpointPersonalTrainerGraphdistanceNS ) != 'undefined' )
	{
		epointPersonalTrainerInitializeSubGraphs(EpointPersonalTrainerGraphdistanceNS);
	}
	if( typeof( EpointPersonalTrainerGraphspeedNS ) != 'undefined' )
	{
		epointPersonalTrainerInitializeSubGraphs(EpointPersonalTrainerGraphspeedNS);
	}
	if( typeof( EpointPersonalTrainerGraphstrengthNS ) != 'undefined' )
	{
		epointPersonalTrainerInitializeSubGraphs(EpointPersonalTrainerGraphstrengthNS);
	}
}
function epointPersonalTrainerInitializeSubGraphs(obj)
{
	for( var i in obj.parts )
	{
		var part = obj.parts[i];
		var row = obj.rowsData[part];

		if( row.values.length > 0 )
			epointpersonaltrainerdrawgraph( obj, part, row );
		else
			jQuery('#part-' + part).html('<div style="position:relative;width:100%;height:100%;display:flex;justify-content:center;align-items:center;padding:20px;background-color:#ddd;"><p>No hay datos suficientes para elaborar una gráfica.</p></div>');
	}
}

jQuery(document).ready(function(){

/*
	if( typeof EpointPersonalTrainerGraphNS.parts != 'undefined' &&
		typeof EpointPersonalTrainerGraphNS.rowsData != 'undefined' )
	{
		//google.charts.load('current');

	}
*/
		google.charts.load('50');
		google.charts.setOnLoadCallback(epointPersonalTrainerInitializeGraphs);
});

