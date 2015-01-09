$ = jQuery;

var params = $.parseJSON(params);
var data1 = params.data1;
var data2 = params.data2;
var lang = params.lang;

var labels = new Array();
var barDatasets = [];
var pieDatasets = [];
var color = 255;

var emptyImage = '<img src="'+params.siteurl+'/wp-content/plugins/simple-credits/images/empty_data.png" style="height:100%;"/>';

if (data1.length>0) {
	for ( var i = 0; i < data1.length; i++) {
		product = data1[i];
		labels.push(product['id'] + '-' + product['title']);
		pieDatasets.push({
			label : '(ID: '+product['id'] + ') - ' + product['title'],
			color : '#' + (Math.random() * 0xFFFFFF << 0).toString(16),
			value : parseInt(product['count']),
			labelAlign : 'legend'
		});
		color = parseInt(color - (255 / params.length));
	}
} else {
	$("#productsChart1").append(emptyImage);
}

if (data2.length>0) {
	for ( var i = 0; i < data2.length; i++) {
		product = data2[i];
		barDatasets.push({
			price : product['price'],
			date : product['date'],
			count : product['count']
		});
	}
} else {
	$("#productsChart2").append(emptyImage);
}

$(document).ready(function() {
	$(".positive").numeric({
		negative : false
	}, function() {
		alert("No negative values");
		this.value = "";
		this.focus();
	});

	// create chart
	AmCharts.ready(function() {
		if (data1.length>0) {
			// PIE CHART
			chart = new AmCharts.AmPieChart();
			chart.dataProvider = pieDatasets;
			chart.clipLabels = true;
			chart.hideLabelsPercent = 2;
			chart.titleField = "label";
			chart.valueField = "value";
			chart.labelsEnabled = false;

			// LEGEND
			var legend = new AmCharts.AmLegend();
			legend.align = "center"
			legend.fontSize = 12
			legend.position = "right"
			legend.switchable = true
			legend.valueText = "[[value]]"
			legend.valueWidth = 100
			legend.verticalGap = 6
			chart.addLegend(legend)

			// WRITE
			chart.write("productsChart1");
		}

		if (data2.length>0) {
			// SERIAL CHART
			chart = new AmCharts.AmSerialChart();
			chart.pathToImages = "http://www.amcharts.com/lib/images/";
			chart.autoMarginOffset = 0;
			chart.marginRight = 0;
			chart.dataProvider = barDatasets;
			chart.categoryField = "date";
			chart.startDuration = 1;

			// AXES
			// category
			var categoryAxis = chart.categoryAxis;
			categoryAxis.gridPosition = "start";

			// value
			// in case you don't want to change default settings of value axis,
			// you don't need to create it, as one value axis is created
			// automatically.
			// GRAPHS
			// column graph
			var graph1 = new AmCharts.AmGraph();
			graph1.type = "column";
			graph1.lineColor = "#5475d3";
			graph1.title = lang.credits;
			graph1.valueField = "price";
			graph1.lineAlpha = 0;
			graph1.fillAlphas = 0.85;
			chart.addGraph(graph1);

			// line
			var graph2 = new AmCharts.AmGraph();
			graph2.type = "line";
			graph2.title = lang.count;
			graph2.valueField = "count";
			graph2.lineThickness = 2;
			graph2.bullet = "round";
			chart.addGraph(graph2);

			// LEGEND
			var legend = new AmCharts.AmLegend();
			legend.align = "center"
			legend.fontSize = 12
			legend.position = "right"
			legend.switchable = true
			legend.valueText = "[[value]]"
			legend.valueWidth = 100
			legend.verticalGap = 6
			chart.addLegend(legend)

			// WRITE
			chart.write("productsChart2");
		}
	});
});