$(document).ready(function () {

$("#error,#errorfestivo,#errorcita,#erroranterior,#camposvacios").wijdialog({ 
                    autoOpen: false, 
                    resizable: false,
                    width: 300,
                    buttons: { 
                    Aceptar: function () { 
                         $(this).wijdialog("close"); 
                        } 
                        }
                });


$("#dialogonuevacita").wijdialog({ 
                    autoOpen: false,
                    show: "clip",
                    hide: "clip",
                    width: 900,
                    buttons: { 
                    Cancelar: function () { 
                         $(this).wijdialog("close"); 
                        } 
                        }
                });

$("#detalles").wijdialog({ 
                    autoOpen: false,
                    hide: "clip",
                    width: 700,
                    position: "top",
                    buttons: { 
                    Aceptar: function () { 
                         $(this).wijdialog("close"); 
                        } 
                        },
                        close: function (e) {
                        $( ".botoncarro").removeClass('ui-state-hover');
                        $('.divajax,.divajax1,.divajax2,.divajaxpedido').hide();
                        $('.fechas').val(0);
                        $('.fechas').wijdropdown('refresh');
                        $('.detalleventa, .detallereserva, .detalledevolucion,.detallepedido').button( "option", "label", "Detalle" ).css('color','');
                        $('.apartado').button("option", "label", "Apartado");
                        $('.reserva').button("option", "label", "Reserva");
                        }  
                });

$("#detalles1").wijdialog({ 
                    autoOpen: false,
                    hide: "clip",
                    width: 900,
                    position: "top",
                    buttons: { 
                    Aceptar: function () { 
                         $(this).wijdialog("close"); 
                        } 
                        },
                        close: function (e) {
                        $( ".boton").removeClass('ui-state-hover');
                        $(".mostrarproductos2").button( "option", "label", "Reservados" );
                        $(".mostrarproductos,.mostrarproductos1").button( "option", "label", "Productos" );
                        $(".mostrarproductos,.mostrarproductos1,.mostrarproductos2").css('color','');
                        }  
                });

$("#tabladetalle").wijdialog({ 
                    autoOpen: false,
                    hide: "clip",
                    width: 900,
                    position: "top",
                    buttons: { 
                    Aceptar: function () { 
                         $(this).wijdialog("close"); 
                        }
                    },
                        close: function (e) {
                            $('#mostrartabla,#mostrartablafestivo,#mostrartabla1').button( "option", "label", "Mostrar tabla" ).css('color','');
                        }  
                });

$("#dialogovacaciones").wijdialog({ 
                    autoOpen: false,
                    hide: "clip",
                    width: 900,
                    buttons: { 
                    Cancelar: function () { 
                         $(this).wijdialog("close"); 
                        } 
                        }
                });

$("#dialogoconvertirventa").wijdialog({ 
                    autoOpen: false,
                    show: "clip",
                    hide: "clip",
                    width: 650,
                    height: 350,
                    buttons: {
                        Aceptar: function () {
                            if ($('.entregado1 input').is(':visible')){
                                    if(parseFloat($('.entregado1 input').val()) <  $("#totaldialogo").html() || isNaN($('.entregado1 input').val()) || $('.entregado1 input').val() == "" ){
                                        $(this).wijdialog("close");
                                        $("#error").wijdialog("open");
                                    }
                                    else{
                                        if ($("#preguntafacturareserva").is(":checked")){
                                            $.ajax({
                                            url: Routing.generate('convertiru'),
                                            data:{formapago:$("#formapagoreserva").val(),reserva: $('#idreserva').html(),totalpago:parseFloat($('.entregado1 input').val())},
                                            success: function(data) {
                                                 $.fancybox.open({
                                                        href: Routing.generate('facturapdf',{id : data}),
                                                        type: 'iframe',
                                                        afterClose  : function() {
                                                            window.location = Routing.generate('listaventa');  
                                                        }
                                                    });
                                                }
                                            });
                                           }
                                        else{
                                        $.ajax({
                                            url: Routing.generate('convertiru'),
                                            data:{formapago:$("#formapagoreserva").val(),reserva: $('#idreserva').html(),totalpago:parseFloat($('.entregado1 input').val()) }
                                            });
                                            $('.prueba').css("display","none");
                                            $('#ajax-loader').show("fade");
                                            setTimeout(function() {
                                                window.location = Routing.generate('listaventa');  
                                            }, 2000)
                                        }
                                    }
                                }
                            else{
                            if ($("#preguntafacturareserva").is(":checked")){//genera pdf 
                                        $.ajax({
                                            url: Routing.generate('convertiru'),
                                            data:{formapago:$("#formapagoreserva").val(),reserva: $('#idreserva').html(),totalpago:0},
                                            success: function(data) {
                                                 $.fancybox.open({
                                                        href: Routing.generate('facturapdf',{id : data}),
                                                        type: 'iframe',
                                                        afterClose  : function() {
                                                            window.location = Routing.generate('listaventa');  
                                                        }
                                                    });
                                                }
                                            });
                                        }
                                        else{//no genera pdf
                                            $(this).wijdialog("close");
                                            $.ajax({
                                            url: Routing.generate('convertiru'),
                                            data:{formapago:$("#formapagoreserva").val(),reserva: $('#idreserva').html(),totalpago:0}
                                            });
                                            $('.prueba').css("display","none");
                                            $('#ajax-loader').show("fade");
                                            setTimeout(function() {
                                                window.location = Routing.generate('listaventa');  
                                            }, 2000)
                                        }
                        }
                        $(this).wijdialog("close");
                    },  
                    Cancelar: function () { 
                         $(this).wijdialog("close"); 
                        } 
                        }
                });

$( "#calendardialogedit" ).wijdialog({
                autoOpen: false,
                show: "Scale",
                hide: "explode",
               resizable: false,
               buttons: {
                    'Borrar': function() {
                            var idcita = $('#calendardialogedit').data('idcita');
                            $('#calendar').fullCalendar('removeEvents',idcita);
                            var url = Routing.generate('borrarcita',{id: idcita});
                            $.ajax({url: url});
                            $(this).wijdialog('close');
                            tablacitas.fnReloadAjax();
                            return false;
                            },
                    'Cancelar': function(){
                        $(this).wijdialog('close');
                            return false;
                            }
                    }
                    });

$( "#borrarfestivo" ).wijdialog({
                autoOpen: false,
                show: "Scale",
                hide: "explode",
               resizable: false,
               buttons: {
                    'Borrar': function() {
                            var idfestivo = $('#borrarfestivo').data('idfestivo');
                            $('#calendar1').fullCalendar('removeEvents',idfestivo);
                            var url = Routing.generate('borrarfestivo',{id: idfestivo});
                            $.ajax({url: url});
                            $(this).wijdialog('close');
                            tablafestivos.fnReloadAjax();
                            return false;
                            },
                    'Cancelar': function(){
                        $(this).wijdialog('close');
                            return false;
                            }
                    }
                    });

$( "#borrarpermiso" ).wijdialog({
                autoOpen: false,
                show: "Scale",
                hide: "explode",
               resizable: false,
               buttons: {
                    'Borrar': function() {
                            var idpermiso = $('#borrarpermiso').data('idpermiso');
                            $('#vacaciones').fullCalendar('removeEvents',idpermiso);
                            $.ajax({url: Routing.generate('borrarpermiso',{id: idpermiso})});
                            $(this).wijdialog('close');
                            return false;
                            },
                    'Cancelar': function(){
                        $(this).wijdialog('close');
                            return false;
                            }
                    }
                    });

$( "#borrarpermisos" ).wijdialog({
                autoOpen: false,
                show: "Scale",
                hide: "explode",
               resizable: false,
               buttons: {
                    'Borrar': function() {
                            var idpermiso = $('#borrarpermisos').data('idpermiso');
                            $.ajax({url: Routing.generate('borrarpermiso',{id: idpermiso})});
                            setTimeout(function() {//esperar un segundo para que de tiempo a guardar
                                $('#vacaciones').fullCalendar( 'refetchEvents' );
                                tablapermisos.fnReloadAjax();
                            }, 1000)
                            $(this).wijdialog('close');
                            return false;
                            },
                    'Cancelar': function(){
                        $(this).wijdialog('close');
                            return false;
                            }
                    }
                    });

$( "#festivos" ).wijdialog({
                autoOpen: false,
                show: "Scale",
                hide: "explode",
               resizable: false,
               buttons: {
                    'Si': function() {
                    var fecha = $('#festivos').data('fecha');
                    //comprobar que no existan citas
                    $.ajax({data: {fecha: fecha},
                    url: Routing.generate('comprobarfestivo'),
                    success: function(data) {
                      if (data == 1){
                        $.ajax({data: {fecha: fecha},url: Routing.generate('guardarfestivo') });
                        setTimeout(function() {
                                $('#calendar1').fullCalendar( 'refetchEvents' );
                                tablafestivos.fnReloadAjax();
                            }, 1000)
                        }
                      else{
                            $("#errorfestivo").wijdialog('open');
                            }
                       }
                    });
                    $(this).wijdialog('close');
                    return false;
                    },
                    'No': function(){
                        $(this).wijdialog('close');
                            return false;
                            }
                    }
                    });
                    
					
		 $( "#ok" ).wijdialog({
			autoOpen: false,
				show: "Scale",
			   hide: "explode",
               resizable: false,
               buttons: {
					'Aceptar': function() {
                            $(this).wijdialog('close');
                            return false;
							}
						}
					});
	
    $("#confirmar").wijdialog({
                    autoOpen: false,
                    resizable: false,
                      open: function( event, ui ) {
                        var id = $("#formapago").find('option:selected').val();
                        if(id == 'efectivo'){
                            $(".entregado input").val();
                            var devolver = parseFloat($('.entregado input').val()) - parseFloat($('#totalventa').html());
                            devolver = Math.round(devolver*100)/100;    
                            $(".msgentregado").html(" Debe devolver " + devolver + "€ al cliente.");
                            $(".msgentregado").addClass("ui-state-highlight ui-corner-all");
                        }
                      },
                      close: function( event, ui ) {
                        $(".msgentregado").html("");
                        $(".msgentregado").removeClass("ui-state-highlight ui-corner-all");
                      },
                    buttons: {
                        'Si': function() {
                                var array=new Array();
                                        var tdtabla2 = $('td',tabla2.fnGetNodes());
                                        for ( var i=0 ; i<parseInt(tdtabla2.length); i=i+6 ){   
                                            array.push(parseInt($(tdtabla2[i]).text()));
                                            array.push(parseInt($(tdtabla2[i+2]).text()));
                                        }
                                        var url1= location.href;
                                        var array1 = url1.split("/");
                                        var cliente = array1[array1.length-1];
                                        if ($("#preguntafactura").is(":checked")){//genera pdf
                                            $(this).wijdialog('close');
                                        $.ajax({
                                            url: Routing.generate('nueva_ventau'),
                                            data:{cliente:cliente, productos:array,formapago:$("#formapago").val(),totalpago:parseFloat($('.entregado input').val())},
                                            success: function(data) {
                                                 $.fancybox.open({
                                                        href: Routing.generate('facturapdf',{id : data}),
                                                        type: 'iframe',
                                                        afterClose  : function() {
                                                            window.location = Routing.generate('listaventa');  
                                                        }
                                                    });
                                                }
                                            });
                                        }
                                        else{//no genera pdf
                                            $(this).wijdialog('close');
                                            $.ajax({
                                            url: Routing.generate('nueva_ventau'),
                                            data:{cliente:cliente, productos:array,formapago:$("#formapago").val(),totalpago:parseFloat($('.entregado input').val())}
                                            });
                                            $('.prueba').css("display","none");
                                            $('#ajax-loader').show("fade"); 
                                            setTimeout(function() {
                                                window.location = Routing.generate('listaventa');  
                                            }, 2000)
                                        }
                            //tabla2.fnClearTable(); 
                            //$("#totalventa").html(0);    
                            return true;
                        },
                        'Cancelar': function() {
                            $(this).wijdialog('close');
                            return false;
                        }
                    }
                });
            
            $("#confirmardevolver").wijdialog({
                    autoOpen: false,
                    resizable: false,
                    buttons: {
                        'Si': function() {
                                var array=new Array();
                                        var tdtabladevolucion = $('td',tabladevolucion.fnGetNodes());
                                        for ( var i=0 ; i<parseInt(tdtabladevolucion.length); i=i+7 ){
                                            if (parseInt($(tdtabladevolucion[i+6]).find("select").val()) > 0){
                                                array.push(parseInt($(tdtabladevolucion[i]).text()));
                                                array.push(parseInt($(tdtabladevolucion[i+6]).find("select").val()));
                                                array.push($(tdtabladevolucion[i+6]).find('input[type=radio]:radio:checked').val());
                                            }
                                        }
                                        var idventa = $('#chivatoidventa').text();
                                        var cliente = $('#chivatoidcliente').text();
                                        var descripcion = $('#areatexto').val();
                                        if (array.length == 0){
                                            $(this).wijdialog('close');
                                            $( ".notificacion1" ).addClass("notificacionerror ui-state-error ui-corner-all").show();
                                            setTimeout(function() {
                                                $('.notificacion1').hide("fade");
                                                },5000)
                                            }
                                        else{

                                            if ($("#preguntadocumentodevolucion").is(":checked")){//genera pdf
                                            $(this).wijdialog('close');
                                            $.ajax({
                                                url: Routing.generate('nueva_devolucionu'),
                                                data:{cliente:cliente, venta:idventa ,productos:array, descripcion: descripcion},
                                                 success: function(data) {
                                                 $.fancybox.open({
                                                        href: Routing.generate('documentodevolucionpdf',{id : data}),
                                                        type: 'iframe',
                                                        afterClose  : function() {
                                                            window.location = Routing.generate('listadevolucion');  
                                                        }
                                                    });
                                                 }
                                                });
                                            }
                                            else{
                                            $(this).wijdialog('close');
                                            $.ajax({
                                                url: Routing.generate('nueva_devolucionu'),
                                                data:{cliente:cliente, venta:idventa ,productos:array, descripcion: descripcion}
                                            });
                                            $('.prueba').css("display","none");
                                            $('#ajax-loader').show("fade"); 
                                            setTimeout(function() {
                                                window.location = Routing.generate('listadevolucion');  
                                            }, 2000)
                                            }
                                        }
                            return true;
                        },
                        'Cancelar': function() {
                            $(this).wijdialog('close');
                            return false;
                        }
                    }
                });
                
                $("#confirmar23").wijdialog({
                    autoOpen: false,
                    resizable: false,
                    buttons: {
                        'Si': function() {
                        		var array=new Array();
										var tdtabla4 = $('td',tabla4.fnGetNodes());
										for ( var i=0 ; i<parseInt(tdtabla4.length); i=i+6 ){	
											array.push(parseInt($(tdtabla4[i]).text()));
											array.push(parseInt($(tdtabla4[i+2]).text()));
										}
										var proveedor = $("#chivatoidproveedor").text();
                                        $.ajax({
                                            url: Routing.generate('nuevo_pedidou'),
                                            data:{proveedor:proveedor, productos:array}
                                            });
                                            $(this).wijdialog('close');
                                            $('.prueba').css("display","none");
                                            $('#ajax-loader').show("fade"); 
                                            setTimeout(function() {
                                                window.location = Routing.generate('listapedido');  
                                            }, 2000)
                            return true;
                        },
                        'Cancelar': function() {
                            $(this).wijdialog('close');
                            return false;
                        }
                    }
                });
                
     $("#confirmar8").wijdialog({
                    autoOpen: false,
                    resizable: false,
                    open: function( event, ui ) {
                        var id = $("#formapago").find('option:selected').val();
                        if(id == 'efectivo'){
                            $(".entregado input").val();
                            var devolver = parseFloat($('.entregado input').val()) - parseFloat($('#adelanto').val());
                            devolver = Math.round(devolver*100)/100;    
                            $(".msgentregado").html(" Debe devolver " + devolver + "€ al cliente.");
                            $(".msgentregado").addClass("ui-state-highlight ui-corner-all");
                        }
                      },
                      close: function( event, ui ) {
                        $(".msgentregado").html("");
                        $(".msgentregado").removeClass("ui-state-highlight ui-corner-all");
                      },
                    buttons: {
                        'Si': function() {
                        		var array=new Array();
										var tdtabla4 = $('td',tabla4.fnGetNodes());
										for ( var i=0 ; i<parseInt(tdtabla4.length); i=i+6 ){	
											array.push(parseInt($(tdtabla4[i]).text()));
											array.push(parseInt($(tdtabla4[i+2]).text()));
										}
										var url= location.href;
										var array1 = url.split("/");
										var cliente = array1[array1.length-1];

                                        if ($("#preguntadocumentoreserva").is(":checked")){//genera pdf
                                            $(this).wijdialog('close');
                                        $.ajax({
                                            url: Routing.generate('nueva_reservau'),
                                            data:{cliente:cliente, productos:array,formapago:$("#formapago").val(), adelanto: $('#adelanto').val() , apartado: 'no',totalpago:parseFloat($('.entregado input').val())},
                                            success: function(data) {
                                                 $.fancybox.open({
                                                        href: Routing.generate('reservapdf',{id : data}),
                                                        type: 'iframe',
                                                        afterClose  : function() {
                                                            window.location = Routing.generate('listareserva');  
                                                        }
                                                    });
                                                }
                                            });
                                        }
                                        else{//no genera pdf
                                            $(this).wijdialog('close');
                                            $.ajax({
                                            url: Routing.generate('nueva_reservau'),
                                            data:{cliente:cliente, productos:array,formapago:$("#formapago").val(), adelanto: $('#adelanto').val() , apartado: 'no',totalpago:parseFloat($('.entregado input').val())}
                                            });
                                            $('.prueba').css("display","none");
                                            $('#ajax-loader').show(); 
                                            setTimeout(function() {
                                                window.location = Routing.generate('listareserva');  
                                            }, 2000)
                                            return true;
                                        }
                        },
                        'Cancelar': function() {
                            $(this).wijdialog('close');
                            return false;
                        }
                    }
                });
                
                $("#confirmar29").wijdialog({
                    autoOpen: false,
                    resizable: false,
                    open: function( event, ui ) {
                        var id = $("#formapago").find('option:selected').val();
                        if(id == 'efectivo'){
                            $(".entregado input").val();
                            var devolver = parseFloat($('.entregado input').val()) - parseFloat($('#adelanto').val());
                            devolver = Math.round(devolver*100)/100;    
                            $(".msgentregado").html(" Debe devolver " + devolver + "€ al cliente.");
                            $(".msgentregado").addClass("ui-state-highlight ui-corner-all");
                        }
                      },
                      close: function( event, ui ) {
                        $(".msgentregado").html("");
                        $(".msgentregado").removeClass("ui-state-highlight ui-corner-all");
                      },
                    buttons: {
                        'Si': function() {
                                var array=new Array();
                                        var tdtabla2 = $('td',tabla2.fnGetNodes());
                                        for ( var i=0 ; i<parseInt(tdtabla2.length); i=i+6 ){   
                                            array.push(parseInt($(tdtabla2[i]).text()));
                                            array.push(parseInt($(tdtabla2[i+2]).text()));
                                        }
                                        var url= location.href;
                                        var array1 = url.split("/");
                                        var cliente = array1[array1.length-1];
                                        if ($("#preguntadocumentoreserva").is(":checked")){//genera pdf
                                            $(this).wijdialog('close');
                                        $.ajax({
                                            url: Routing.generate('nueva_reservau'),
                                            data:{cliente:cliente, productos:array,adelanto: parseFloat($('#adelanto').val()),formapago : $('#formapago').val(), apartado : 'si',totalpago:parseFloat($('.entregado input').val())},
                                            success: function(data) {
                                                 $.fancybox.open({
                                                        href: Routing.generate('reservapdf',{id : data}),
                                                        type: 'iframe',
                                                        afterClose  : function() {
                                                            window.location = Routing.generate('listaapartado');  
                                                        }
                                                    });
                                                }
                                            });
                                        }
                                        else{
                                            $(this).wijdialog('close');
                                            $.ajax({
                                            url: Routing.generate('nueva_reservau'),
                                            data:{cliente:cliente, productos:array,formapago:$("#formapago").val(), adelanto: parseFloat($('#adelanto').val()) , apartado: 'si',totalpago:parseFloat($('.entregado input').val())}
                                            });
                                            $('.prueba').css("display","none");
                                            $('#ajax-loader').show(); 
                                            setTimeout(function() {
                                                window.location = Routing.generate('listaapartado');  
                                            }, 2000)
                                            return true;
                                        }
                        },
                        'Cancelar': function() {
                            $(this).wijdialog('close');
                            return false;
                        }
                    }
                });
                
                $("#mensajecontacto").wijdialog({
                    autoOpen: false,
                    resizable: true,
                    height: 430,
                    width :380,
                    buttons: {
                        'Enviar': function() {
									var email = $('#email').val();
									var mensaje = $('#mensaje').val();
                                    url = Routing.generate('contacto');
									$.ajax({url: url,data: {email: email, mensaje: mensaje}});
									$(this).wijdialog('close');
									return true;                        	
                        	},
                        'Cancelar': function() {
                            $(this).wijdialog('close');
                            return false;
                        }
                    }
                });
                
              $("#confirmar1").wijdialog({
                    autoOpen: false,
                    resizable: false,
                    buttons: {
                        'Si': function() {return true;},
                        'Cancelar': function() {
                            $(this).wijdialog('close');
                            return false;
                        }
                    }
                });
                
               
               $("#confirmar2").wijdialog({
                    autoOpen: false,
                    resizable: false,
                    buttons: {
                        'Si': function() {
                        $(this).wijdialog('close');    
								document.forms["nuevousuario"].submit();
                        return true;}
                        ,
                        'Cancelar': function() {
                            $(this).wijdialog('close');
                            return false;
                        }
                    }
                });
                
                $("#confirmar3").wijdialog({
                    autoOpen: false,
                    resizable: false,
                    buttons: {
                        'Si': function() {
								document.forms["modificarusuario"].submit();                 
                                return true;
                            },
                        'Cancelar': function() {
                            $(this).wijdialog('close');
                            return false;
                        }
                    }
                });
                $("#confirmar4").wijdialog({
                    autoOpen: false,
                    resizable: false,
                    buttons: {
                        'Si': function() {
								document.forms["eliminarusuario"].submit();                 
                        return true;},
                        'Cancelar': function() {
                            $(this).wijdialog('close');
                            return false;
                        }
                    }
                });
                
                $("#confirmar5").wijdialog({
                    autoOpen: false,
                    resizable: false,
                    buttons: {
                        'Si': function() {
								document.forms["nuevoempleado"].submit();                 
                        return true;},
                        'Cancelar': function() {
                            $(this).wijdialog('close');
                            return false;
                        }
                    }
                });

                $("#confirmar25").wijdialog({
                    autoOpen: false,
                    resizable: false,
                    buttons: {
                        'Si': function() {
                                document.forms["nuevomedico"].submit();                 
                        return true;},
                        'Cancelar': function() {
                            $(this).wijdialog('close');
                            return false;
                        }
                    }
                });
                $("#confirmar17").wijdialog({
                    autoOpen: false,
                    resizable: false,
                    buttons: {
                        'Si': function() {
								document.forms["nuevoproveedor"].submit();                 
                        return true;},
                        'Cancelar': function() {
                            $(this).wijdialog('close');
                            return false;
                        }
                    }
                });
                
                $("#confirmar6").wijdialog({
                    autoOpen: false,
                    resizable: false,
                    buttons: {
                        'Si': function() {
								document.forms["modificarempleado"].submit();                 
                        return true;},
                        'Cancelar': function() {
                            $(this).wijdialog('close');
                            return false;
                        }
                    }
                });
                
                $("#confirmar26").wijdialog({
                    autoOpen: false,
                    resizable: false,
                    buttons: {
                        'Si': function() {
                                document.forms["modificarmedico"].submit();                 
                        return true;},
                        'Cancelar': function() {
                            $(this).wijdialog('close');
                            return false;
                        }
                    }
                });
                $("#confirmar7").wijdialog({
                    autoOpen: false,
                    resizable: false,
                    buttons: {
                        'Si': function() {
								document.forms["eliminarempleado"].submit();                 
                        return true;},
                        'Cancelar': function() {
                            $(this).wijdialog('close');
                            return false;
                        }
                    }
                });
                $("#confirmar15").wijdialog({
                    autoOpen: false,
                    resizable: false,
                    buttons: {
                        'Si': function() {
                        $(this).wijdialog('close');    
								document.forms["modificarproveedor"].submit();     
                        return true;}
                        ,
                        'Cancelar': function() {
                            $(this).wijdialog('close');
                            return false;
                        }
                    }
                });
                $("#confirmar16").wijdialog({
                    autoOpen: false,
                    resizable: false,
                    buttons: {
                        'Si': function() {
                        $(this).wijdialog('close');    
								document.forms["eliminarproveedor"].submit();     
                        return true;}
                        ,
                        'Cancelar': function() {
                            $(this).wijdialog('close');
                            return false;
                        }
                    }
                });
                
                $("#confirmar13").wijdialog({
                    autoOpen: false,
                    resizable: false,
                    buttons: {
                        'Si': function() {
                        $(this).wijdialog('close');    
								document.forms["eliminarproducto"].submit();     
                        return true;}
                        ,
                        'Cancelar': function() {
                            $(this).wijdialog('close');
                            return false;
                        }
                    }
                });
                $("#confirmar14").wijdialog({
                    autoOpen: false,
                    resizable: false,
                    buttons: {
                        'Si': function() {
                        $(this).wijdialog('close');    
								document.forms["modificarproducto"].submit();     
                        return true;}
                        ,
                        'Cancelar': function() {
                            $(this).wijdialog('close');
                            return false;
                        }
                    }
                });
                $("#confirmar10").wijdialog({
                    autoOpen: false,
                    resizable: false,
                    buttons: {
                        'Si': function() {
                        $(this).wijdialog('close');    
								document.forms["nuevoproducto"].submit();     
                        return true;}
                        ,
                        'Cancelar': function() {
                            $(this).wijdialog('close');
                            return false;
                        }
                    }
                });
                $("#confirmar11").wijdialog({
                    autoOpen: false,
                    resizable: false,
                    buttons: {
                        'Si': function() {
                        $(this).wijdialog('close');    
								document.forms["nuevafamilia"].submit();     
                        return true;}
                        ,
                        'Cancelar': function() {
                            $(this).wijdialog('close');
                            return false;
                        }
                    }
                });

                $("#confirmar27").wijdialog({
                    autoOpen: false,
                    resizable: false,
                    buttons: {
                        'Si': function() {
                        $(this).wijdialog('close');    
                                document.forms["nuevoinforme"].submit();     
                        return true;}
                        ,
                        'Cancelar': function() {
                            $(this).wijdialog('close');
                            return false;
                        }
                    }
                });

                $("#confirmar21").wijdialog({
                    autoOpen: false,
                    resizable: false,
                    buttons: {
                        'Si': function() {
                        $(this).wijdialog('close');    
								document.forms["eliminarfamilia"].submit();     
                        return true;}
                        ,
                        'Cancelar': function() {
                            $(this).wijdialog('close');
                            return false;
                        }
                    }
                });
                
                $("#confirmar22").wijdialog({
                    autoOpen: false,
                    resizable: false,
                    buttons: {
                        'Si': function() {
                        $(this).wijdialog('close');    
								document.forms["modificarfamilia"].submit();     
                        return true;}
                        ,
                        'Cancelar': function() {
                            $(this).wijdialog('close');
                            return false;
                        }
                    }
                });

                $("#confirmar28").wijdialog({
                    autoOpen: false,
                    resizable: false,
                    buttons: {
                        'Volver a intentarlo': function() {
                        $(this).wijdialog('close');    
                                 return true;}
                        ,
                        'Guardar': function() {
                            $(this).wijdialog('close');
                            $.ajax({url: Routing.generate('guardararqueo'),data: {efectivocontado: $('#confirmar28').data('sum'), efectivo:$('#confirmar28').data('sum1'),boletascontadas: $('#confirmar28').data('boletas'),boletas:$('#confirmar28').data('boletas1'), confirmado:'no'}});
                            $( ".notificacion1" ).addClass("notificacion ui-state-highlight ui-corner-all").show();
                            $("#validararqueo").button({ disabled: true });
                               setTimeout(function() {
                                  $('.notificacion1').hide();
                                     },5000)
                            return false;
                        }
                    }
                });
                    			
				$('#gusuario').live('click', function () {
						$("#confirmar2").wijdialog('open');
				})
				$('#gproducto').live('click', function () {
						$("#confirmar10").wijdialog('open');
				})
				$('#bmodificarfamilia').live('click', function () {
						$("#confirmar22").wijdialog('open');
				})
				$('#beliminarfamilia').live('click', function () {
						$("#confirmar21").wijdialog('open');
				})
				$('#bmodificarusuario').live('click', function () {
						$("#confirmar3").wijdialog('open');
				})
				$('#beliminarusuario').live('click', function () {
						$("#confirmar4").wijdialog('open');
				})
				$('#gempleado').live('click', function () {
						$("#confirmar5").wijdialog('open');
				})
                $('#gmedico').live('click', function () {
                        $("#confirmar25").wijdialog('open');
                })
				$('#bmodificarempleado').live('click', function () {
						$("#confirmar6").wijdialog('open');
				})
                $('#bmodificarmedico').live('click', function () {
                        $("#confirmar26").wijdialog('open');
                })
				$('#beliminarempleado').live('click', function () {
						$("#confirmar7").wijdialog('open');
				})
				$('#bmodificarproveedor').live('click', function () {
						$("#confirmar15").wijdialog('open');
				})
				$('#beliminarproveedor').live('click', function () {
						$("#confirmar16").wijdialog('open');
				})
				$('#beliminarproducto').live('click', function () {
						$("#confirmar13").wijdialog('open');
				})
				$('#bmodificarproducto').live('click', function () {
						$("#confirmar14").wijdialog('open');
				})
				$('#gproveedor').live('click', function () {
						$("#confirmar17").wijdialog('open');
				})
				$('#gfamilia').live('click', function () {
						$("#confirmar11").wijdialog('open');
				})
                $('#ginforme').live('click', function () {
                        $("#confirmar27").wijdialog('open');
                })
      });