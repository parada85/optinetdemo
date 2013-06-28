        $(document).ready(function () {
        	
        	// para mostrar la tabla de las citas
        	$('#mostrartabla').live('click', function () {
        		$("#tabladetalle").wijdialog('open');
        		if ($(this).text() == 'Ocultar tabla'){
        			$("#tabladetalle").wijdialog('close');
        			$(this).button( "option", "label", "Mostrar tabla" );
						$(this).css('color','');
						$('#tablacitasdiv').hide();
				}
				else{
						tablacitas.fnReloadAjax();
						$(this).button( "option", "label", "Ocultar tabla" );
						$(this).css("color","red");
						$('#tablacitasdiv').css("display", "block");
						$(".th").click();//para las tablas hagan el colapse bien
						var oTableTools = TableTools.fnGetInstance('tablacitas' );
						oTableTools.fnResizeButtons();
					}
				})

        	$('#mostrartablafestivo').live('click', function () {
        		$("#tabladetalle").wijdialog({width: 500});
        		$("#tabladetalle").wijdialog('open');
        		if ($(this).text() == 'Ocultar tabla'){
        			$("#tabladetalle").wijdialog('close');
        			$(this).button( "option", "label", "Mostrar tabla" );
						$(this).css('color','');
						$('#tablafestivosdiv').hide();
				}
				else{
						tablafestivos.fnReloadAjax();
						$(this).button( "option", "label", "Ocultar tabla" );
						$(this).css("color","red");
						$('#tablafestivosdiv').css("display", "block");
						$(".th").click();
						var oTableTools = TableTools.fnGetInstance('tablafestivos' );
						oTableTools.fnResizeButtons();
					}
				})

        	$('#btablapermiso').live('click', function () {
        		if ($(this).text() == 'Ocultar tabla'){
        			$(this).button( "option", "label", "Mostrar tabla" );
						$(this).css('color','');
						$('#vacaciones').show();
						$('#vacaciones').fullCalendar( 'refetchEvents' );
						$('#tablapermisosdiv').hide();
				}
				else{
						tablapermisos.fnReloadAjax();
						$(this).button( "option", "label", "Ocultar tabla" );
						$(this).css("color","red");
						$('#vacaciones').hide();
						$('#tablapermisosdiv').show();
						$('#tablapermisosdiv').css("display", "block");
						$(".th").click();//para las tablas hagan el colapse bien
						var oTableTools = TableTools.fnGetInstance('tablapermisos' );
						oTableTools.fnResizeButtons();
					}
				})

        	$('#mostrartabla1').live('click', function () {
        		$("#tabladetalle").wijdialog('open');
        		if ($(this).text() == 'Ocultar tabla'){
        			$("#tabladetalle").wijdialog('close');
        			$(this).button( "option", "label", "Mostrar tabla" );
						$(this).css('color','');
						$('#tablaarqueos').hide();
						$('.select_filter').wijdropdown('refresh');
				}
				else{
						$(this).button( "option", "label", "Ocultar tabla" );
						$(this).css("color","red");
						$('#tablaarqueos').show();
						$('.select_filter').wijdropdown('refresh');
						$(".th").click();//para las tablas hagan el colapse bien
						var oTableTools = TableTools.fnGetInstance('tablalistaarqueo');
						oTableTools.fnResizeButtons();
					}
				})

        	//para mostrar las devoluciones en listar ventas
        	$('.fechas').change(function () {
    				//$('.divajax').removeClass('margen');
    				$("#detalles").wijdialog('open');
					$('.divajax1').show();
					$('.divajax').show();
					$('.divajax2').hide();
					var nTds = $('td', this.parentNode.parentNode.parentNode.parentNode);
					var id = $(nTds[0]).text();
					var id_devolucion = $(this).val();
					$('.detalleventa').css("color","");
					$('.detalleventa').button( "option", "label", "Detalle" );
					$('.apartado').button("option", "label", "Apartado");
					$('.reserva').button("option", "label", "Reserva");
					$('.apartado').css("color","");
					$('.reserva').css("color","");
					var valor = $(this).val();
    				$('.fechas').val(0);
					$('.fechas').wijdropdown('refresh');
					$(this).val(valor);
					$(this).wijdropdown('refresh');
					if(id_devolucion == ""){
						$('.divajax1').hide();
						$('.divajax').hide();
						$("#detalles").wijdialog('close');
					}
					else{
						$('.divajax span').html("Productos de la venta: " + id);
						var url = Routing.generate('facturapdf', { id: id });
						$('.divajax .id1').html("<a class='fancybox botondocumento' href="+ url +">Documento</a>");
						$('.divajax1 span').html("Productos de la devolución: " + id_devolucion);
						var url = Routing.generate('documentodevolucionpdf', { id: id_devolucion });
						$('.divajax1 .id1').html("<a class='fancybox botondocumento' href="+ url +">Documento</a>");

						$('.botondocumento').button({icons:{primary: 'ui-icon-document'}});
						var ruta1 = Routing.generate('productosventa', { operacionid: id });
						productosventa.fnReloadAjax(ruta1);
						var ruta = Routing.generate('productosdevolucion', { operacionid: id_devolucion });
						productosdevolucion.fnReloadAjax(ruta);
					}

				})
        		$('.detallepedido').live('click', function () {
        			$("#detalles").wijdialog('open');
        			$('.divajax1 ,.divajax2, .divajax').hide();
					if ($(this).text() == 'Ocultar'){
						$("#detalles").wijdialog('close');
						$('.divajaxpedido').hide();
						$(this).button( "option", "label", "Detalle" );
						$(this).css('color','');
						}
					else{
						//$('.divajaxpedido').addClass('margen');
						$('.divajaxpedido').show();
						$('.divajaxpedido').css("color","");
						$(this).css("color","red");
						var id = $(this).attr("id");
						if (id == null){//no estoy en admin
							var nTds = $('td', this.parentNode.parentNode);
							id = $(nTds[0]).text();
							info = 'Productos del pedido: '+ id + ' Fecha: '+ $(nTds[2]).text() + ' Total: ' + $(nTds[4]).text();
						}
						else{
							var nTds = $('td', this.parentNode.parentNode);
							info = 'Productos del pedido: '+ id;
        				}
						var ruta = Routing.generate('productospedido', { id: id });
						productospedido.fnReloadAjax(ruta);
						var nTds = $('td', this.parentNode.parentNode);
						$('.id').html(info);
						var url = Routing.generate('pedidopdf', { id: id });
						$('.id1').html("<a class='fancybox botondocumento' href="+ url +">Documento</a>");
						$('.botondocumento').button({icons:{primary: 'ui-icon-document'}});
						$('.detallepedido, .detalleventa, .detallereserva, .detalledevolucion').button( "option", "label", "Detalle" );
						$('.detallepedido, .detalleventa, .detallereserva, .detalledevolucion').css("color","");
						$(this).css("color","red");
						$(this).button( "option", "label", "Ocultar" );
					}
				})
				
        		//para mostrar los detalles de las operaciones
				$('.detalleventa').live('click', function () {
					$("#detalles").wijdialog('open');
					$('.divajax1 ,.divajax2, .divajaxpedido').hide();
					$('.fechas').val(0);
					$('.fechas').wijdropdown('refresh');
					var nTds = $('td', this.parentNode.parentNode);
					if ($(this).text() == 'Ocultar'){
						$("#detalles").wijdialog('close');
						$('.divajax,.divajax1,.divajax2').hide();
						$('.detalleventa, .detallereserva').button( "option", "label", "Detalle" );
						$('.apartado').button("option", "label", "Apartado");
						$('.reserva').button("option", "label", "Reserva");
						$(this).css('color','');
						}
					else{
						$('.divajax').show();
						$('.detalleventa, .detallereserva, .detalledevolucion, .detallepedido').css("color","");
						$('.detalleventa, .detallereserva, .detalledevolucion, .detallepedido').button( "option", "label", "Detalle" );
						$(this).css("color","red");
						var id = $(this).attr("id");
						if (id == null){
							var nTds = $('td', this.parentNode.parentNode);
							id = $(nTds[0]).text();
							info = 'Productos de la venta: '+ id + ' Fecha: '+ $(nTds[3]).text() + ' Total: ' + $(nTds[4]).text();
						}
						else{
							var nTds = $('td', this.parentNode.parentNode);
							info = 'Productos de la venta: '+ id;
        				}
						$('.id').html(info);
						var url = Routing.generate('facturapdf', { id: id });
						$('.id1').html("<a class='fancybox botondocumento' href="+ url +">Documento</a>");
						$('.botondocumento').button({icons:{primary: 'ui-icon-document'}});
						var ruta = Routing.generate('productosventa', { operacionid: id });
						productosventa.fnReloadAjax(ruta);
						$('.apartado').button("option", "label", "Apartado");
						$('.reserva').button("option", "label", "Reserva");
						$(this).button( "option", "label", "Ocultar" );
					}
				})

        		$('.detallereserva').live('click', function () {
        			$("#detalles").wijdialog('open');
					$('.divajax1,.divajax, .divajaxpedido').hide();
					$('.fechas').val(0);
					$('.fechas').wijdropdown('refresh');
					if ($(this).text() == 'Ocultar'){
						$("#detalles").wijdialog('close');
						$('.divajax,.divajax1,.divajax2').hide();
						$('.detalleventa, .detallereserva').button( "option", "label", "Detalle" );
						$('.apartado').button("option", "label", "Apartado");
						$('.reserva').button("option", "label", "Reserva");
						$(this).css('color','');
						}
					else{
						$('.divajax2').show();
						$('.detalleventa, .detallereserva, .detalledevolucion').css("color","");
						$('.detalleventa, .detallereserva, .detalledevolucion').button( "option", "label", "Detalle" );
						$(this).css("color","red");
						var id = $(this).attr("id");
						if (id == null){
							var nTds = $('td', this.parentNode.parentNode);
							id = $(nTds[0]).text();
							info = 'Productos de reserva/apartado: '+ id + ' Fecha: '+ $(nTds[3]).text() + ' Total: ' + $(nTds[4]).text();
						}
						else{
							var nTds = $('td', this.parentNode.parentNode);
							info = 'Productos de reserva/apartado: '+ id;
        				}
						$('.id').html(info);
						var url = Routing.generate('reservapdf', { id: id });
						$('.id1').html("<a class='fancybox botondocumento' href="+ url +">Documento</a>");
						$('.botondocumento').button({icons:{primary: 'ui-icon-document'}});
						var ruta = Routing.generate('productosreserva', { operacionid: id });
						productosreserva.fnReloadAjax(ruta);
						$('.apartado').button("option", "label", "Apartado");
						$('.reserva').button("option", "label", "Reserva");
						$(this).button( "option", "label", "Ocultar" );
					}
				})

				$('.detalledevolucion').live('click', function () {
					$("#detalles").wijdialog('open');
					$('.divajax2,.divajaxpedido').hide();
					$('.fechas').val(0);
					$('.fechas').wijdropdown('refresh');
					if ($(this).text() == 'Ocultar'){
						$("#detalles").wijdialog('close');
						$('.divajax,.divajax1,.divajax2').hide();
						$(this).button( "option", "label", "Detalle" );
						$(this).css('color','');
						}
					else{
						$('.detalleventa, .detallereserva, .detalledevolucion, .detallepedido').css("color","");
						$('.detalleventa, .detallereserva, .detalledevolucion, .detallepedido').button( "option", "label", "Detalle" );
						$(this).css("color","red");
						var id = $(this).attr("id");// si el atributo tiene un id estoy en admin sino estoy en lista devolucion (problema ocultar id en tabla cambios)
						if (id == null){
							//$('.divajax,.divajax,.divajax2').removeClass('margen');
							$('.divajax1,.divajax').show();
							var nTds = $('td', this.parentNode.parentNode);
							id = $(nTds[0]).text();
							$('.divajax .id').html('Productos de la venta: '+ $(this).attr("class").split(' ')[0]);
							$('.divajax1 .id').html('Productos de la devolución: '+ id + ' Fecha:' + $(nTds[3]).text() + ' Total:' + $(nTds[4]).text());
							//$('.divajax span').html($(this).attr("class").split(' ')[0]);
							var url = Routing.generate('facturapdf', { id: $(this).attr("class").split(' ')[0] });
							$('.divajax .id1').html("<a class='fancybox botondocumento' href="+ url +">Documento</a>");
							//$('.divajax1 span').html(id);
							var url = Routing.generate('documentodevolucionpdf', { id: id });
							$('.divajax1 .id1').html("<a class='fancybox botondocumento' href="+ url +">Documento</a>");

							$('.botondocumento').button({icons:{primary: 'ui-icon-document'}});
							var ruta1 = Routing.generate('productosventa', { operacionid: $(this).attr("class").split(' ')[0] });
							productosventa.fnReloadAjax(ruta1);
							var ruta = Routing.generate('productosdevolucion', { operacionid: id });
							productosdevolucion.fnReloadAjax(ruta);
							$('.detalledevolucion').button( "option", "label", "Detalle" );
							$(this).button( "option", "label", "Ocultar" );
						}
						else{
							var nTds = $('td', this.parentNode.parentNode);
							$('.divajax1').show();
							$('.divajax').hide();
							$('.id').html('Productos de la devolución: '+ id);
							var url = Routing.generate('documentodevolucionpdf', { id: id });
							$('.divajax1 .id1').html("<a class='fancybox botondocumento' href="+ url +">Documento</a>");
							$('.botondocumento').button({icons:{primary: 'ui-icon-document'}});
							var ruta = Routing.generate('productosdevolucion', { operacionid: id });
								productosdevolucion.fnReloadAjax(ruta);
								$('.detalledevolucion').button( "option", "label", "Detalle" );
								$(this).button( "option", "label", "Ocultar" );
						}

					}
				})
				
				$('.mostrarproductos').live('click', function () {
					$("#detalles1").wijdialog('open');
					if ($(this).text() == 'Ocultar'){
						$("#detalles1").wijdialog('close');
						$(this).button( "option", "label", "Productos" );
						$(this).css('color','');
						}
					else{
						$('.mostrarproductos').css("color","");
						$(this).css("color","red");
						var idfamilia = $(this).attr("id");
						var nTds = $('td', this.parentNode.parentNode);
						$('.id').html('Productos de la familia: ' + $(nTds[0]).text());
						var ruta = Routing.generate('ajaxproductos', { idfamilia: idfamilia });
						ajaxproductos.fnReloadAjax(ruta);
						$('.mostrarproductos').button( "option", "label", "Productos" );
						$(this).button( "option", "label", "Ocultar" );
					}
				})
				//para mostrar productos en listar proveedores
				$('.mostrarproductos1').live('click', function () {
					$('.divproductosreservados').hide();
					$('.divproductos').show();
					$("#detalles1").wijdialog('open');
					if ($(this).text() == 'Ocultar'){
						$("#detalles1").wijdialog('close');
						$(this).button( "option", "label", "Productos" );
						$(this).css('color','');
						}
					else{
						$('.mostrarproductos1').css("color","");
						$(this).css("color","red");
						var nTds = $('td', this.parentNode.parentNode);
						nombre = $(nTds[0]).text();
						$('.id').html('Productos del proveedor: '+ nombre);
						var idproveedor = $(this).attr("id");
						var ruta = Routing.generate('ajaxproductos1', { idproveedor: idproveedor });
						ajaxproductos.fnReloadAjax(ruta);
						$('.mostrarproductos1').button( "option", "label", "Productos" );
						$('.mostrarproductos2').button( "option", "label", "Reservados" );
						$('.mostrarproductos2').css('color','');
						$(this).button( "option", "label", "Ocultar" );
					}
				})

				//para mostrar productos en listar proveedores reservados
				$('.mostrarproductos2').live('click', function () {
					$('.divproductos').hide();
					$('.divproductosreservados').show();
					$("#detalles1").wijdialog('open');
					if ($(this).text() == 'Ocultar'){
						$("#detalles1").wijdialog('close');
						$(this).button( "option", "label", "Reservados" );
						$(this).css('color','');
						}
					else{
						$('.mostrarproductos2').css("color","");
						$(this).css("color","red");
						var nTds = $('td', this.parentNode.parentNode);
						nombre = $(nTds[0]).text();
						$('.id').html('Productos reservados al proveedor: '+ nombre);
						var idproveedor = $(this).attr("id");
						var ruta = Routing.generate('ajaxproductos2', { idproveedor: idproveedor });
						ajaxproductosreservados.fnReloadAjax(ruta);
						$('.mostrarproductos1').button( "option", "label", "Productos" );
						$('.mostrarproductos1').css('color','');
						$('.mostrarproductos2').button( "option", "label", "Reservados" );
						$(this).button( "option", "label", "Ocultar" );
					}
				})
		});
