$(document).ready(function () {
	
	Highcharts.setOptions({
	    lang: {
		months: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 
		'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
		weekdays: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sabado'],
		shortMonths: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
		downloadPNG: "Descarga PNG",
		downloadPDF: "Descarga PDF",
		downloadJPEG: "Descarga JPEG",
		downloadSVG: "Descarga SVG",
		exportButtonTitle: "Exportar gráfico",
		printButtonTitle: "Imprimir gráfico",
		rangeSelectorFrom: "Desde",
		rangeSelectorTo: "Hasta",
		thousandsSep: ".",
		decimalPoint: ","
		},
    global: {
        useUTC: false
    }
});

$( "#tabs" ).bind( "tabscreate", function(event, ui) {

	$.getJSON(Routing.generate('graficasajax', { id: 1 }), function(data) {
	  var ventas = [];
	  var reservas = [];
	  var apartados = [];
	  var devoluciones = [];
	  var pedidos = [];
	  var citas = [];
 	  var categories = [];

  			$.each(data, function(index, value) {
  	 			categories.push(data[index].username);
    			ventas.push(data[index].nventas);
    			reservas.push(data[index].nreservas);
    			apartados.push(data[index].napartados);
    			devoluciones.push(data[index].ndevoluciones);
    			citas.push(data[index].ncitas);
    			pedidos.push(data[index].npedidos);
  			});
  				//chart.series[0].setData(ventas);
  				//chart.series[1].setData(reservas);
  				//chart.series[2].setData(devoluciones);
  				//chart.xAxis[0].setCategories(categories);
	
	chart = new Highcharts.Chart({
		chart: {
			renderTo: 'container',
			type: 'column',
			borderWidth: 2,
            borderRadius: 10
		},
		title: {
			text: 'Número de operaciones de los empleados'
		},
		xAxis: {
			categories: categories
			},
		yAxis: {
			min: 0,
			title: {
				text: 'Numero'
			}
		},
		legend: {
			layout: 'vertical',
			backgroundColor: '#FFFFFF',
			align: 'left',
			verticalAlign: 'top',
			x: 0,
			y: 100,
			floating: false,
			shadow: true
		},
		tooltip: {
			formatter: function() {
				return ''+
					'<b>'+'Empleado:'+this.x +'</b>'+'<br/>'+ this.y;
			}
		},
		plotOptions: {
			column: {
				pointPadding: 0.2,
				borderWidth: 0
			}
		},
			series: [{
			name: 'Ventas',
			data: ventas,
			dataLabels: {
				enabled: true
			}
		}, {
			name:'Devoluciones',
			data: devoluciones,
					dataLabels: {
				enabled: true
			}
		}, {
			name: 'Reservas',
			data: reservas,
					dataLabels: {
				enabled: true
			}
		}, {
			name:'Apartados',
			data: apartados,
					dataLabels: {
				enabled: true
			}
		}, {
			name:'Pedidos',
			data: pedidos,
					dataLabels: {
				enabled: true
			}
		}, {
			name:'Citas',
			data: citas,
					dataLabels: {
				enabled: true
			}
		}],
		exporting: {
        filename: 'Estadísticas-de-empleados'
    }
	});
	
	});
});

$('#tabs').bind('tabsselect', function(event, ui) {
	
	if (ui.index==0){
		$.getJSON(Routing.generate('graficasajax', { id: 1 }), function(data) {
	  var ventas = [];
	  var reservas = [];
	  var apartados = [];
	  var devoluciones = [];
	  var pedidos = [];
	  var citas = [];
 	  var categories = [];

  			$.each(data, function(index, value) {
  	 			categories.push(data[index].username);
    			ventas.push(data[index].nventas);
    			reservas.push(data[index].nreservas);
    			apartados.push(data[index].napartados);
    			devoluciones.push(data[index].ndevoluciones);
    			citas.push(data[index].ncitas);
    			pedidos.push(data[index].npedidos);
  			});
  				//chart.series[0].setData(ventas);
  				//chart.series[1].setData(reservas);
  				//chart.series[2].setData(devoluciones);
  				//chart.xAxis[0].setCategories(categories);
	
	chart = new Highcharts.Chart({
		chart: {
			renderTo: 'container',
			type: 'column',
			borderWidth: 2,
            borderRadius: 10
		},
		title: {
			text: 'Número de operaciones de los empleados'
		},
		xAxis: {
			categories: categories
			},
		yAxis: {
			min: 0,
			title: {
				text: 'Numero'
			}
		},
		legend: {
			layout: 'vertical',
			backgroundColor: '#FFFFFF',
			align: 'left',
			verticalAlign: 'top',
			x: 0,
			y: 100,
			floating: false,
			shadow: true
		},
		tooltip: {
			formatter: function() {
				return ''+
					'<b>'+'Empleado:'+this.x +'</b>'+'<br/>'+ this.y;
			}
		},
		plotOptions: {
			column: {
				pointPadding: 0.2,
				borderWidth: 0
			}
		},
			series: [{
			name: 'Ventas',
			data: ventas,
			dataLabels: {
				enabled: true
			}
		}, {
			name:'Devoluciones',
			data: devoluciones,
					dataLabels: {
				enabled: true
			}
		}, {
			name: 'Reservas',
			data: reservas,
					dataLabels: {
				enabled: true
			}
		}, {
			name:'Apartados',
			data: apartados,
					dataLabels: {
				enabled: true
			}
		}, {
			name:'Pedidos',
			data: pedidos,
					dataLabels: {
				enabled: true
			}
		}, {
			name:'Citas',
			data: citas,
					dataLabels: {
				enabled: true
			}
		}],
		exporting: {
        filename: 'Estadísticas-de-empleados'
    }
	});
	
	});
	
}
	
	if (ui.index==1){

    var seriesOptions = [],
		vector = [],
		vector1 = [],
		vector2 = [],
		vector3 = [],
		yAxisOptions = [],
		seriesCounter = 0,
		names = ['ventas','reservas','apartados','devoluciones'],
		colors = Highcharts.getOptions().colors;

	$.each(names, function(i, name) {
			if (i == 0){
			$.getJSON(Routing.generate('graficasajax', { id: name }), function(data) {
				$.each(data, function(key, value){
   	 			vector.push([value.fecha, value.total]);
			});

			seriesOptions[i] = {
				name: name,
				data: vector,
				marker : {
					enabled : true,
					radius : 3
				},
				shadow : true
			};
			seriesCounter++;
			if (seriesCounter == names.length) {
				createChart();
			}

		});
		}
		if (i==1){
			$.getJSON(Routing.generate('graficasajax', { id: name }), function(data) {
				$.each(data, function(key, value){
   	 			vector1.push([value.fecha, value.total]);
			});

			seriesOptions[i] = {
				name: name,
				data: vector1,
				marker : {
					enabled : true,
					radius : 3
				},
				shadow : true
			};
			seriesCounter++;
			if (seriesCounter == names.length) {
				createChart();
			}

		});
		}
		if (i==2){
			$.getJSON(Routing.generate('graficasajax', { id: name }), function(data) {
				$.each(data, function(key, value){
   	 			vector2.push([value.fecha, value.total]);
			});

			seriesOptions[i] = {
				name: name,
				data: vector2,
				marker : {
					enabled : true,
					radius : 3
				},
				shadow : true
			};
			seriesCounter++;
			if (seriesCounter == names.length) {
				createChart();
			}

		});
		}
		if (i==3){
			$.getJSON(Routing.generate('graficasajax', { id: name }), function(data) {
				$.each(data, function(key, value){
   	 			vector3.push([value.fecha, value.total]);
			});

			seriesOptions[i] = {
				name: name,
				data: vector3,
				marker : {
					enabled : true,
					radius : 3
				},
				shadow : true
			};
			seriesCounter++;
			if (seriesCounter == names.length) {
				createChart();
			}

		});
		}
	});

	function createChart() {
        chart5 = new Highcharts.StockChart({
            chart: {
                renderTo: 'container1',
                borderWidth: 2,
            	borderRadius: 10
            },
            title: {
                text: 'Operaciones realizadas por los empleados'
            },
            xAxis: {
                type: 'datetime'
            },
            yAxis: {
        		labels: {
            	formatter: function() {
                	return this.value;
            		}
        		}
    		},
            legend: {
	            layout: 'vertical',
				backgroundColor: '#FFFFFF',
				align: 'left',
				verticalAlign: 'top',
				enabled: true,
				x: 0,
				y: 100,
				floating: false,
				shadow: true
            },
			series : seriesOptions
		});
	}
}


if (ui.index==2){

$.getJSON(Routing.generate('graficasajax', { id: 2 }), function(data) {
	
	var vector = [];
	$.each(data, function(key, value){
    vector.push([value.username, value.total]);
		});
		
        chart3 = new Highcharts.Chart({
            chart: {
                renderTo: 'container2',
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                borderWidth: 2,
            	borderRadius: 10
            },
            title: {
                text: 'Porcentaje de ventas de los empleados'
            },
            tooltip: {
                formatter: function() {
                    return '<b>'+ this.point.name +'</b>: '+ Math.round(this.percentage) +' %';
                }
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
								enabled: true,
								color: '#000000',
								connectorColor: '#000000',
								formatter: function() {
								return '<b>'+ this.point.name +'</b>: '+ Math.round(this.percentage) +' %';}
										}
							},
                 showInLegend: true
            },

            series: [{
                type: 'pie',
                name: 'Browser share',
                data: vector
            }]

        });

    });
}

if (ui.index==3){
	
    $.getJSON(Routing.generate('graficasajax', { id: 3 }), function(data) {

 		 var cantidad = [];
 		 var categories = [];

  				$.each(data, function(index, value) {
  	 				categories.push(data[index].descripcion);
    				cantidad.push(data[index].cantidad);
  				});
	
	chart5 = new Highcharts.Chart({
		chart: {
			renderTo: 'container3',
			type: 'column',
			borderWidth: 2,
            borderRadius: 10
		},
		title: {
			text: 'Productos más vendidos'
		},
		xAxis: {
			title: {
				text: 'Productos'
			},
			categories: categories
		},
		yAxis: {
			min: 0,
			title: {
				text: 'Cantidades'
			},
			labels: {
				formatter: function() {
					return this.value; // clean, unformatted number for year
				}
			}
		},
		legend: {
			enabled: false
		},
		tooltip: {
			formatter: function() {
				return ''+
					'<b>'+'Producto: '+this.x +'</b>'+'<br/>'+ this.y+ ' unidad/es';
			}
		},
		plotOptions: {
			column: {
				pointPadding: 0.3,
				borderWidth: 1
			}
		},
			series: [{
			name: 'Ventas',
			data: cantidad,
			dataLabels: {
				enabled: true
			}
		}],
		exporting: {
        filename: 'Productos más vendidos'
    }
	});
});
}

if (ui.index==4){

	$.getJSON(Routing.generate('graficasajax', { id: 2 }), function(data) {

 		 var dinero = [];
 		 var categories = [];

  				$.each(data, function(index, value) {
  	 				categories.push(data[index].username);
    				dinero.push(data[index].total);
  				});
	
	chart2 = new Highcharts.Chart({
		chart: {
			renderTo: 'container4',
			type: 'column',
			borderWidth: 2,
            borderRadius: 10
		},
		title: {
			text: 'Facturación de los empleados'
		},
		xAxis: {
			categories: categories,
			title: {
				text: 'Empleados'
			}
		},
		yAxis: {
			min: 0,
			title: {
				text: 'Euros'
			},
			labels: {
				formatter: function() {
					return this.value; // clean, unformatted number for year
				}
			}
		},
		legend: {
			enabled: false
		},
		tooltip: {
			formatter: function() {
				return ''+
					'<b>'+'Empleado: '+this.x +'</b>'+'<br/>'+ this.y+ ' euros';
			}
		},
		plotOptions: {
			column: {
				pointPadding: 0.3,
				borderWidth: 1
			}
		},
			series: [{
			name: 'Ventas',
			data: dinero,
			dataLabels: {
				enabled: true
			}
		}],
		exporting: {
        filename: 'Facturacion-de-empleados'
    }
	});
});

}
if (ui.index == 5){

	var vector1 = [];
	$.getJSON(Routing.generate('graficasajax', { id: 4 }), function(data) {
	var vector1 = [];
	$.each(data, function(key, value){
    vector1.push([value.fecha, value.total]);
		});

chart6 = new Highcharts.StockChart({
		    chart: {
		        renderTo: 'container5',
		        borderWidth: 2,
            	borderRadius: 10
		    },
		    rangeSelector: {
		        selected: 4
		    },
		    title : {
				text : 'Total facturado'
			},
		    yAxis: {
		    	labels: {
            	formatter: function() {
                	return this.value;
            		}
        		},
		    	plotLines: [{
		    		value: 0,
		    		width: 2,
		    		color: 'silver'
		    	}]
		    },

		    series : [{
				name : 'Facturado',
				data : vector1,
				marker : {
					enabled : true,
					radius : 3
				},
				shadow : true
			}]
			});
	});
}

if (ui.index == 6){

	var vector1 = [];
	$.getJSON(Routing.generate('graficasajax', { id: 5 }), function(data) {
	var vector1 = [];
	$.each(data, function(key, value){
    vector1.push([value.fecha, value.total]);
		});

chart7 = new Highcharts.StockChart({
		    chart: {
		        renderTo: 'container6',
		        borderWidth: 2,
            	borderRadius: 10
		    },
		    rangeSelector: {
		        selected: 4
		    },
		    title : {
				text : 'Total facturado acumulado'
			},
		    yAxis: {
        		labels: {
            	formatter: function() {
                	return this.value;
            		}
        		},
		    	plotLines: [{
		    		value: 0,
		    		width: 2,
		    		color: 'silver'
		    	}]
		    },

		    series : [{
				name : 'Facturado acumulado',
				data : vector1,
				marker : {
					enabled : true,
					radius : 3
				},
				shadow : true
			}]
			});
	});
}

if (ui.index == 7){

	var vector1 = [];
	$.getJSON(Routing.generate('graficasajax', { id: 6 }), function(data) {
	var vector1 = [];
	$.each(data, function(key, value){
    vector1.push([value.fecha, value.total]);
		});

chart8 = new Highcharts.StockChart({
		    chart: {
		        renderTo: 'container7',
		        borderWidth: 2,
            	borderRadius: 10
		    },
		    rangeSelector: {
		        selected: 4
		    },
		    title : {
				text : 'Total Beneficio'
			},
		    yAxis: {
        		labels: {
            	formatter: function() {
                	return this.value;
            		}
        		},
		    	plotLines: [{
		    		value: 0,
		    		width: 2,
		    		color: 'silver'
		    	}]
		    },

		    series : [{
				name : 'Beneficio',
				data : vector1,
				marker : {
					enabled : true,
					radius : 3
				},
				shadow : true
			}]
			});
	});
}

if (ui.index == 8){

	var vector1 = [];
	$.getJSON(Routing.generate('graficasajax', { id: 7 }), function(data) {
	var vector1 = [];
	$.each(data, function(key, value){
    vector1.push([value.fecha, value.total]);
		});

chart9 = new Highcharts.StockChart({
		    chart: {
		        renderTo: 'container8',
		        borderWidth: 2,
            	borderRadius: 10
		    },
		    rangeSelector: {
		        selected: 4
		    },
		    title : {
				text : 'Total Beneficio acumulado'
			},
		    yAxis: {
        		labels: {
            	formatter: function() {
                	return Highcharts.numberFormat(this.value, 0, ',', '');
            		}
        		},
		    	plotLines: [{
		    		value: 0,
		    		width: 2,
		    		color: 'silver'
		    	}]
		    },

		    series : [{
				name : 'Beneficio acumulado',
				data : vector1,
				marker : {
					enabled : true,
					radius : 3
				},
				shadow : true
			}]
			});
	});
}

if (ui.index==9){
		$.getJSON(Routing.generate('graficasajax', { id: 8 }), function(data) {
	  var confirmados = [];
	  var noconfirmados = [];
 	  var categories = [];

  			$.each(data, function(index, value) {
  	 			categories.push(data[index].username);
    			confirmados.push(data[index].confirmado);
    			noconfirmados.push(data[index].noconfirmado);
  			});
	
	chart10 = new Highcharts.Chart({
		chart: {
			renderTo: 'container9',
			type: 'column',
			borderWidth: 2,
            borderRadius: 10
		},
		title: {
			text: 'Arqueos de los empleados'
		},
		xAxis: {
			categories: categories
			},
		yAxis: {
			min: 0,
			title: {
				text: 'Numero'
			}
		},
		legend: {
			layout: 'vertical',
			backgroundColor: '#FFFFFF',
			align: 'left',
			verticalAlign: 'top',
			x: 0,
			y: 100,
			floating: false,
			shadow: true
		},
		tooltip: {
			formatter: function() {
				return ''+
					'<b>'+'Empleado:'+this.x +'</b>'+'<br/>'+ this.y;
			}
		},
		plotOptions: {
			column: {
				pointPadding: 0.2,
				borderWidth: 0
			}
		},
		colors: [
   'green', 
   '#FA476E']
   ,
			series: [{
			name: 'Confirmados',
			data: confirmados,
			dataLabels: {
				enabled: true
			}
		}, {
			name:'No confirmados',
			data: noconfirmados,
					dataLabels: {
				enabled: true
			}
		}],
		exporting: {
        filename: 'Arqueos-de-empleados'
    }
	});
	
	});
}
})


$( "#emptabs" ).bind( "tabscreate", function(event, ui) {

	$.getJSON(Routing.generate('graficasajaxemp', { id: 1 }), function(data) {
	  var cantidad = [];
 	  var categories = [];

  			$.each(data, function(index, value) {
  	 			categories.push(data[index].tipo);
    			cantidad.push(data[index].cantidad);
  			});
	
	chart = new Highcharts.Chart({
		chart: {
			renderTo: 'empcontainer',
			type: 'column'
		},
		title: {
			text: 'Operaciones de empleados'
		},
		xAxis: {
			categories: categories
			},
		yAxis: {
			min: 0,
			title: {
				text: 'Numero'
			}
		},
		legend: {
			layout: 'vertical',
			backgroundColor: '#FFFFFF',
			align: 'left',
			verticalAlign: 'top',
			x: 100,
			y: 70,
			floating: true,
			shadow: true,
			enabled: false
		},
		tooltip: {
			formatter: function() {
				return ''+
					'<b>'+'Empleado:'+this.x +'</b>'+'<br/>'+ this.y;
			}
		},
		plotOptions: {
			column: {
				point:{
					events:{
					 click:function(){
					 		if (this.x == 0)
                                window.location = Routing.generate('listaventa');
                            if (this.x == 1)
                                window.location = Routing.generate('listadevolucion'); 
                          	if (this.x == 2)
                                window.location = Routing.generate('listareserva'); 
                            if (this.x == 3)
                                window.location = Routing.generate('listaapartado'); 
                            if (this.x == 4)
                                window.location = Routing.generate('newcita'); 
                            if (this.x == 5)
                                window.location = Routing.generate('listapedido');
                     	   		}
                    		}
                    	},
				pointPadding: 0.2,
				borderWidth: 0
			},
			series: {
                colorByPoint: true
            }
		},
			series: [{
			data: cantidad,
			dataLabels: {
				enabled: true
			}
		}],
		exporting: {
        filename: 'Estadísticas-de-empleados'
    }
	});
	
	});
});

$('#emptabs').bind('tabsselect', function(event, ui) {

	if (ui.index == 0){
	
	$.getJSON(Routing.generate('graficasajaxemp', { id: 1 }), function(data) {
	  var cantidad = [];
 	  var categories = [];

  			$.each(data, function(index, value) {
  	 			categories.push(data[index].tipo);
    			cantidad.push(data[index].cantidad);
  			});
	
	chart = new Highcharts.Chart({
		chart: {
			renderTo: 'empcontainer',
			type: 'column'
		},
		title: {
			text: 'Operaciones de empleados'
		},
		xAxis: {
			categories: categories
			},
		yAxis: {
			min: 0,
			title: {
				text: 'Numero'
			}
		},
		legend: {
			layout: 'vertical',
			backgroundColor: '#FFFFFF',
			align: 'left',
			verticalAlign: 'top',
			x: 100,
			y: 70,
			floating: true,
			shadow: true,
			enabled: false
		},
		tooltip: {
			formatter: function() {
				return ''+
					'<b>'+'Empleado:'+this.x +'</b>'+'<br/>'+ this.y;
			}
		},
		plotOptions: {
			column: {
				point:{
					events:{
					 click:function(){
					 		if (this.x == 0)
                                window.location = Routing.generate('listaventa');
                            if (this.x == 1)
                                window.location = Routing.generate('listadevolucion'); 
                          	if (this.x == 2)
                                window.location = Routing.generate('listareserva'); 
                            if (this.x == 3)
                                window.location = Routing.generate('listaapartado'); 
                            if (this.x == 4)
                                window.location = Routing.generate('newcita'); 
                            if (this.x == 5)
                                window.location = Routing.generate('listapedido');
                     	   		}
                    		}
                    	},
				pointPadding: 0.2,
				borderWidth: 0
			},
			series: {
                colorByPoint: true
            }
		},
			series: [{
			data: cantidad,
			dataLabels: {
				enabled: true
			}
		}],
		exporting: {
        filename: 'Estadísticas-de-empleados'
    		}
		});//cierro el grafico
	});//cierro el json
	}//cierro la ioption

	if (ui.index == 1){

	var vector1 = [];
	$.getJSON(Routing.generate('graficasajaxemp', { id: 2 }), function(data) {
	var vector1 = [];
	$.each(data, function(key, value){
    vector1.push([value.fecha, value.total]);
		});

chart6 = new Highcharts.StockChart({
		    chart: {
		        renderTo: 'empcontainer1',
		        borderWidth: 2,
            	borderRadius: 10
		    },
		    rangeSelector: {
		        selected: 4
		    },
		    title : {
				text : 'Total facturado'
			},
		    yAxis: {
		    	labels: {
            	formatter: function() {
                	return this.value;
            		}
        		},
		    	plotLines: [{
		    		value: 0,
		    		width: 2,
		    		color: 'silver'
		    	}]
		    },

		    series : [{
				name : 'Facturado',
				data : vector1,
				marker : {
					enabled : true,
					radius : 3
				},
				shadow : true
			}]
			});
	});
}
});//cierro el tabs
});//cierro el archivo