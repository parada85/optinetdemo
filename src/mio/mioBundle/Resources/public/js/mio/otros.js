 $(document).ready(function () {
 
			if($.cookie("cssmio")) 
        		$("#hojaestilo").attr("href",$.cookie("cssmio"));
				
        	$('.tema').click(function () {
	    		$("#hojaestilo").attr("href",$(this).attr('rel'));
	    		$.cookie("cssmio",$(this).attr('rel'), {expires: 7, path: '/'});
    		return false;
		});

    $('#mio_miobundle_medicotype_color').minicolors({
    theme: 'bootstrap',
    swatchPosition: 'right'
});
  $('#pickers').datepicker();
    $('.notificacion,.notificacionerror').show();
    $('.notificacion').addClass('ui-state-highlight ui-corner-all');
    $('.notificacionerror').addClass('ui-state-error ui-corner-all');
    setTimeout(function() {
        $('.notificacion,.notificacionerror').hide("fade");
    }, 5000)

    $( "#sortable1, #sortable2" ).sortable({
			connectWith: ".connectedSortable"
		}).disableSelection();
		

		if ($.browser.webkit) {//remove yelloww in chrome.
    		$("input").attr('autocomplete','off');
			}

	$( "#sortable2" ).bind( "sortreceive", function(event, ui) {
	var id_producto = ui.item.attr('id');
	var id_familia = $("#fam2").val();
	//$(this).sortable('cancel');
	$.ajax({url: Routing.generate('moverfamiliaajax1'),data: {id_producto:id_producto,id_familia:id_familia}});
	$("#contarproductofam2").text(parseInt($("#contarproductofam2").text())+1);
	$("#contarproductofam1").text(parseInt($("#contarproductofam1").text())-1);
	});

	$( "#sortable1" ).bind( "sortreceive", function(event, ui) {
	var id_producto = ui.item.attr('id');
	var id_familia = $("#fam1").val();
	$.ajax({url: Routing.generate('moverfamiliaajax1'),data: {id_producto:id_producto,id_familia:id_familia}});
	$("#contarproductofam1").text(parseInt($("#contarproductofam1").text())+1);
	$("#contarproductofam2").text(parseInt($("#contarproductofam2").text())-1);
	});

			$( "#tabs,#emptabs" ).tabs();

            $("#menu1").wijmenu({orientation: "horizontal"});
       		$(".formulario > div > div > input").wijtextbox();
       		$(".formulario > div > div").addClass("ui-widget-header");
       		$(".izquierdo div").addClass("ui-widget-header");
       		$(".derecho div").addClass("ui-widget-header");
       		$("#otros div").addClass("ui-widget-header");
       		$(".formulario1 > div > span > div > input").wijtextbox();

			$("[title]").wijtooltip();
			$(".botoncarro").button({icons:{primary: 'ui-icon-cart'}});
			$(".boton").button();
			$(".botoncheck").button({icons:{primary: 'ui-icon-check'}});
			$(".botonolvidada").button({icons:{primary: 'ui-icon-key'}});
			$(".botonvolver").button({icons:{primary: 'ui-icon-arrowreturnthick-1-w'}});
			$(".botoneditar").button({icons:{primary: 'ui-icon-pencil'}});
			$(".botoneliminar").button({icons:{primary: 'ui-icon-trash'}});
			$(".botondocumento").button({icons:{primary: 'ui-icon-document'}});
			$(".botondesactivado").button({ disabled: true });
			$(":input[type='checkbox']").wijcheckbox();
			//$("#seleccionmedico").wijdropdown();
			$('.lista').wijdropdown();
			$('.select_filter').wijdropdown();
				
				$('#guardar').live('click', function () {
				
						var contador = tabla2.fnSettings().fnRecordsTotal();
						
						if ($('.entregado input').is(':visible') )
							if (contador == 0  || isNaN($('.entregado input').val()) || $('.entregado input').val() == "" || parseFloat($('.entregado input').val()) < parseFloat($('#totalventa').html()))
								$("#error").wijdialog('open');
							else
								$("#confirmar").wijdialog('open');
						else
							if (contador == 0)
								$("#error").wijdialog('open');
							else
							$("#confirmar").wijdialog('open');
				})
				
				$('#guardarpedido').live('click', function () {
					
					var contador = tabla4.fnSettings().fnRecordsTotal();
						
						if (contador==0)
							$("#error").wijdialog('open');
						else
						$("#confirmar23").wijdialog('open');
				})

				$('#passolvidado').live('click', function () {
						url = Routing.generate('passolvidado');
						window.location = url;
				})

				$('#enviarpass').live('click', function () {
					var mail = $("#mail").val();
					if (mail){
					$('#ajax-loader').show();
						$.ajax({
							url: Routing.generate('enviarmailpass'),
							data: {mail: mail},
                            success: function(data){
                            	setTimeout(function() {
                            	$('#ajax-loader').hide();
                           		if (data==1)
                            		$('#errorlogin').text('Se ha mandado un nuevo email con la contraseña');
                           		else
                           			$('#errorlogin').text('El email introducido es incorrecto');
                            		}, 1000)
                                }
                            });
					}
				})

        $('#bandera1').live('click', function () {
			window.location = Routing.generate('cambiarlocale',{idioma: 'en'});
			})
        $('#bandera0').live('click', function () {
        window.location = Routing.generate('cambiarlocale',{idioma: 'es'});
        })
					
				$('#guardarreserva').live('click', function () {

						var input = $('#adelanto').val();
						var contador = tabla4.fnSettings().fnRecordsTotal();
						var cantidad = parseFloat($('#totalventa').html());

						if (isNaN(input) || contador == 0 || input == "" || input < 0 || input > cantidad || parseFloat($('.entregado input').val()) < input)
							$("#error").wijdialog('open');
						else
							$("#confirmar8").wijdialog('open');
				})

				$('#guardarapartado').live('click', function () {

						var input = $('#adelanto').val();
						var contador = tabla2.fnSettings().fnRecordsTotal();
						var cantidad = parseFloat($('#totalventa').html());

						if (isNaN(input) || contador == 0 || input == "" || input < 0 || input > cantidad || input > parseFloat($(".entregado input").val()) )
							$("#error").wijdialog('open');
						else
							$("#confirmar29").wijdialog('open');
				})

				$('.convertiraventa').live('click', function () {
					var nTds = $('td', this.parentNode.parentNode);
					var total = parseFloat($(nTds[4]).text());
					var adelanto = parseFloat($(nTds[5]).text());
					var idreserva = parseInt($(nTds[0]).text());
					var redondeo = total-adelanto;
					redondeo = Math.round(redondeo*100)/100 ;
					$('#totaldialogo').html(redondeo);
					if (redondeo == 0){
						$('.entregado1').hide();
						$('#formapagoreserva').hide();
					}
					$('#idreserva').html(idreserva);
					$("#dialogoconvertirventa").wijdialog('open');
				})
				
				$('#contacto').live('click', function () {
						$("#mensajecontacto").wijdialog('open');
				})

				$("#productomostrar").change(function() {	
					tablalistaproductos.fnFilter($(this).val(),null,false,false,false,false);
					tablalistaproductos.fnDraw();
    			});
				
				$(".operacionescliente").change(function() {	
					window.location = $(this).val();
    			});

    			$("#fam1").change(function() {
					id_familia = $(this).val();
					seleccionado = $("#fam2").find('option:selected').val();
					var entero = '<option value="' + $("#fam2").find('option:selected').val() + '">' + $("#fam2").find('option:selected').text() + '</option>';
					$('#fam2').find('option').remove().end().append($("#fam1").html());
					$('#fam2').find('option').end().append(entero);
					$("#fam2 option[value="+seleccionado+"]").attr("selected",true);
					var val = $("#fam1 option:selected").val();
					$("#fam2 option[value='"+ val +"']").remove();
						$.getJSON(Routing.generate('moverfamiliaajax', { id: id_familia }), function(data){
						$("#sortable1 div").remove();
  						$.each(data, function(key, value) {
    						$("#sortable1").append('<div class="gelou" id="'+value.id+'"> '+ value.descripcion + '</div>');
    						$('.gelou').button();
  						});
  					$("#contarproductofam1").text(data.length);
  					})
					$("#fam2,#fam1").wijdropdown("refresh");
    			});
    			
    			$("#fam2 option:last").remove();
    			$("#fam1 option:first").remove();
    			$("#fam2 option:first,#fam1 option:last").attr("selected",true);
    			$("#fam2,#fam1").wijdropdown("refresh");

    			  $("#fam2").change(function() {	
					id_familia = $(this).val();
					seleccionado = $("#fam1").find('option:selected').val();
					var entero = '<option value="' + $("#fam1").find('option:selected').val() + '">' + $("#fam1").find('option:selected').text() + '</option>';
					$('#fam1').find('option').remove().end().append($("#fam2").html());
					$('#fam1').find('option').end().append(entero);
					$("#fam1 option[value="+seleccionado+"]").attr("selected",true);
					var val = $("#fam2 option:selected").val();
					$("#fam1 option[value='"+ val +"']").remove();
					$.getJSON(Routing.generate('moverfamiliaajax', { id: id_familia }), function(data){
					$("#sortable2 div").remove();
  					$.each(data, function(key, value) {
    					$("#sortable2").append('<div class="gelou" id='+value.id+'> '+ value.descripcion + '</div>');
    					$('.gelou').button();
  					});
  					$("#contarproductofam2").text(data.length);
  					})
					$("#fam2,#fam1").wijdropdown("refresh");
    			});

    				$('.avisada').live('click', function () {	   
			   		var nTds = $('td', this.parentNode.parentNode);
					var id = $(nTds[0]).text();
   				    $.ajax({url: Routing.generate('avisada', { id: id }) });
   				    setTimeout(function() {//esperar un segundo para que de tiempo a guardar.
                        window.location = Routing.generate('listareserva');
    					}, 1000)
					})

					$('.vervacaciones').live('click', function () {
					$("#dialogovacaciones").wijdialog('open');	   
			   		tablapermisos1.fnReloadAjax(Routing.generate('listarpermisos',{id: $(this).attr("id")}));
			   		$('#tablapermisosdiv').show();
			   		var oTableTools = TableTools.fnGetInstance('tablapermisos1' );
						oTableTools.fnResizeButtons();
					})

				$('.recepcionar').live('click', function () {
					
					 	momentoActual = new Date() ;
 						var hora = momentoActual.getHours(); 
   					var minuto = momentoActual.getMinutes(); 
   					var segundo = momentoActual.getSeconds();
   					var dia = momentoActual.getDate();
						var mes = momentoActual.getMonth()+1;
						
						var str_dia = new String (dia) ;
   					if (str_dia.length == 1) 
      	 				dia = "0" + dia;
      	 			
      	 			var str_mes = new String (mes) ;
   					if (str_mes.length == 1) 
      	 				mes = "0" + mes;
      	 					
						var	str_segundo = new String (segundo);
   					if (str_segundo.length == 1) 
      	 				segundo = "0" + segundo;

   				var  str_minuto = new String (minuto) ;
   					if (str_minuto.length == 1) 
      	 				minuto = "0" + minuto;

   	 			var str_hora = new String (hora) ;
   					if (str_hora.length == 1) 
      	 				hora = "0" + hora;
   	

   				var horaImprimible = dia + "/" + mes +"/" + momentoActual.getFullYear() +" "+ hora + ":" + minuto + ":" + segundo;
					var nTds = $('td', this.parentNode.parentNode);
					var id = $(nTds[0]).text();
          			var username = $('#chivatoempleado').text();
 					$.ajax({url: Routing.generate('recepcion'),data: {id: id}});
 					var aPos = listapedido.fnGetPosition(this.parentNode.parentNode);
 					listapedido.fnUpdate(horaImprimible,aPos,3);
 					listapedido.fnUpdate(username,aPos,6);
				})

				$('#validararqueo').live('click', function () {
					var sum = 0;
					var total = 0;
					var chi = 0;
					var i = 0;
					var dif = 0;
					arreglo = new Array(0,500,200,100,50,20,10,5,0.01,0.02,0.05,0.10,0.20,0.50,1,2);
					$("#billetes :input,#monedas :input").each(function(){
 					 	if ($(this).val() == "" || isNaN($(this).val()) ) {
 							$("#camposvacios").wijdialog('open');
 							chi = 1;
 							return false;
 						}
 						else{
 							sum += parseInt($(this).val()) * arreglo[i];
 							i=i+1;
 						}
 					})
 					if (chi != 1){
 						
 				// llamar a ajax y obtener el total d boletas y total de efectivo.
	                     $.getJSON(Routing.generate('confirmararqueo'), function(data) {
	                     	dif = Math.abs(data.sum - sum);
	  					if (dif < 1 && data.boletas == parseInt($('#boleta').val())){
	  						$.ajax({url: Routing.generate('guardararqueo'),data: {efectivo: data.sum, boletas: data.boletas, efectivocontado: sum , boletascontadas: $('#boleta').val(), confirmado:'si'}});
                            $( ".notificacion1" ).addClass("notificacion ui-state-highlight ui-corner-all").show();
                            $("#validararqueo").button({ disabled: true });
                               setTimeout(function() {
                                  $('.notificacion1').hide("fade");
                                     },5000)
	  						}
	  					else{
	  						$('#confirmar28').data('sum1',data.sum);
	  						$('#confirmar28').data('sum',sum);
	  						$('#confirmar28').data('boletas',$('#boleta').val());
	  						$('#confirmar28').data('boletas1',data.boletas);
	  						$("#confirmar28").wijdialog('open');
	  						}
	                  	});
 					}
				})

				$('#botondevolver').live('click', function () {
						$("#confirmardevolver").wijdialog('open');
				})

			$(".fancybox").fancybox({
    				'type'  :'iframe'
					})
			$(".th").click();//para las tablas hagan el colapse bien
			$(".th1").click().click();//para las tablas hagan el colapse bien

			$("#formapago,#formapagoreserva").change(function() {	
					var val = $(this).find('option:selected').val();
					if(val == 'efectivo'){
						$('.entregado,.entregado1').show("slide");
						$("#msgconvertir").show("slide");
					}
					else{
						$('.entregado,.entregado1').hide("drop");
						$("#msgconvertir").hide("drop");
					}
    			});
			$("#adelanto").keyup(function() {
				    $('.entregado input').val( this.value );
				});
			$(".entregado1 input").keyup(function() {
					if( parseFloat(this.value) > parseFloat($("#totaldialogo").html()) ){
						var redondeo = this.value - $("#totaldialogo").html();
						redondeo = Math.round(redondeo*100)/100;
				    	$('#devolucioncliente').html(redondeo);
				    	$("#msgconvertir").show();
				    }
				    else
				    	$("#msgconvertir").hide();
				});
			$('.todoscambios').live('click', function () {
					window.location = Routing.generate('cambios', {id: 0 });
			})
});