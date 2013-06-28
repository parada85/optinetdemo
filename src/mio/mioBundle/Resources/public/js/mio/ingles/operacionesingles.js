$(document).ready(function () {
	var redondeo=0;

				$('#añadirapedido').live('click', function () {				
				var nTds = $('td', this.parentNode.parentNode);
				
				var aPos = tablapedido.fnGetPosition(this.parentNode.parentNode);
        		var id = $(nTds[0]).text();
            var descripcion = $(nTds[1]).text();
            var stock = parseInt($(nTds[2]).text());
            var precio = parseFloat($(nTds[6]).text());
            var cantidad = parseInt(this.parentNode.firstChild.value);
				var cantidad1;            
				var chivato=0;
				
				if (cantidad == 0 || this.parentNode.firstChild.value == "" || isNaN(this.parentNode.firstChild.value) )
					$( "#error" ).wijdialog( "open" );
            else
            {
				//mirar aver si esta abajo para unirlo.
				var tdtabla4 = $('td',tabla4.fnGetNodes());
				
				for ( var i=0 ; i<parseInt(tdtabla4.length); i=i+6 ){	
						if ($(tdtabla4[i]).text() == id){
						   chivato=1;
							cantidad1 =  parseInt($(tdtabla4[i+2]).text());
							tabla4.fnUpdate( cantidad1+cantidad + " unit/s", i/6, 2 );
							tabla4.fnUpdate( (cantidad1+cantidad)*precio + " €", i/6, 4 );
							var antes=$('#totalventa').val();
							$("#totalventa").html(antes + (cantidad1+cantidad)*precio);
					}
				}            
            if (chivato==0){
            	redondeo = cantidad*precio;
				redondeo =Math.round(redondeo*100)/100 ;			
				tabla4.fnAddData( [id,descripcion,cantidad + " unit/s",precio + " €",redondeo + " €",'<div class="sumar1">Add up</div><div class="restar1">Subtract</div><div class="eliminar1">Remove</div>']);
				antes = parseFloat($('#totalventa').html());
				redondeo = antes + (cantidad)*precio;
				redondeo = Math.round(redondeo*100)/100;	
				$("#totalventa").html(redondeo);
				$(".sumar1").button({icons:{primary: 'ui-icon-plusthick'}});
				$(".restar1").button({icons:{primary: 'ui-icon-minusthick'}});
				$(".eliminar1").button({icons:{primary: 'ui-icon-trash'}});
				
					}				
				}
				this.parentNode.firstChild.value= ""; // dejo el campo vacio
				} )

				$('#añadirreserva').live('click', function () {				
				var nTds = $('td', this.parentNode.parentNode);
				
				var aPos = tabla3.fnGetPosition(this.parentNode.parentNode);
        		var id = $(nTds[0]).text();
            var descripcion = $(nTds[1]).text();
            var stock = parseInt($(nTds[2]).text());
            var stockreservado = parseInt($(nTds[3]).text());
            var precio = parseFloat($(nTds[5]).text());
            var cantidad = parseFloat(this.parentNode.firstChild.value);
				var cantidad1;            
				var chivato=0;
				if (this.parentNode.firstChild.value == "" || isNaN(this.parentNode.firstChild.value)  || cantidad < stock )
					$( "#error" ).wijdialog( "open" );
            else
            {
				//mirar aver si esta abajo para unirlo.
				var tdtabla4 = $('td',tabla4.fnGetNodes());
				
				for ( var i=0 ; i<parseInt(tdtabla4.length); i=i+7 ){	
						if ($(tdtabla4[i]).text() == id){
						   chivato=1;
							cantidad1 =  parseFloat($(tdtabla4[i+2]).text());
							redondeo = (cantidad1+cantidad)*precio;
							redondeo = Math.round(redondeo*100)/100;

							tabla4.fnUpdate( cantidad1+cantidad + " unit/s", i/7, 2 );
							tabla4.fnUpdate( redondeo + " €", i/7, 4 );
							tabla3.fnUpdate( cantidad1 + cantidad + " unit/s", aPos, 4 );
							antes = parseFloat($('#totalventa').html());
							redondeo = antes + (cantidad)*precio;
							redondeo = Math.round(redondeo*100)/100;	
							$("#totalventa").html(redondeo);
					}
				}            
            if (chivato==0){
            tabla3.fnUpdate( stockreservado + cantidad + " unit/s", aPos, 4 );
            	redondeo = cantidad*precio;
				redondeo =Math.round(redondeo*100)/100 ;			
				tabla4.fnAddData( [id,descripcion,cantidad + " unit/s",precio + " €",redondeo + " €",'<div class="sumarreserva">Add Up</div><div class="restarreserva">Subtract</div><div class="eliminarreserva">Remove</div>']);
				var antes=$('#totalventa').text();
				redondeo = Math.round((parseFloat(antes) + redondeo)*100)/100;
				$("#totalventa").html(redondeo);
							
				$(".sumarreserva").button({icons:{primary: 'ui-icon-plusthick'}});
				$(".restarreserva").button({icons:{primary: 'ui-icon-minusthick'}});
				$(".eliminarreserva").button({icons:{primary: 'ui-icon-trash'}});
				
					}				
				}
				this.parentNode.firstChild.value= ""; // dejo el campo vacio
				} )
				
				
				$('#añadir').live('click', function () {		
				var nTds = $('td', this.parentNode.parentNode);
				
				var aPos = tabla1.fnGetPosition(this.parentNode.parentNode);
        		var id = $(nTds[0]).text();
            var descripcion = $(nTds[1]).text();
            var stock = parseInt($(nTds[2]).text());
            var precio = parseFloat($(nTds[5]).text());
            var cantidad = parseInt(this.parentNode.firstChild.value);
				var cantidad1;            
				var chivato=0;
				
				if (cantidad <= 0 || stock < cantidad || this.parentNode.firstChild.value == "" || isNaN(this.parentNode.firstChild.value) )
					$( "#error" ).wijdialog( "open" );
            else
            {
				//mirar aver si esta abajo para unirlo.
				var tdtabla2 = $('td',tabla2.fnGetNodes());
				
				for ( var i=0 ; i<parseInt(tdtabla2.length); i=i+6 ){	
						if ($(tdtabla2[i]).text() == id){
						   chivato=1;
							cantidad1 =  parseInt($(tdtabla2[i+2]).text());
							tabla2.fnUpdate( cantidad1+cantidad + " unit/s", i/11, 2 );
							redondeo = (cantidad1+cantidad)*precio;
							redondeo = Math.round(redondeo*100)/100;	
							tabla2.fnUpdate( redondeo +" €", i/11, 4 );
							tabla1.fnUpdate( stock-cantidad + " unit/s", aPos, 2 );
							antes = parseFloat($('#totalventa').html());
							redondeo = antes + (cantidad)*precio;
							redondeo = Math.round(redondeo*100)/100;	
							$("#totalventa").html(redondeo);
					}
				}            
            if (chivato==0){
            tabla1.fnUpdate( stock-cantidad + " unit/s", aPos, 2 );
            	redondeo = cantidad*precio;
				redondeo =Math.round(redondeo*100)/100 ;			
				tabla2.fnAddData( [id,descripcion,cantidad + " unit/s",precio + " €",redondeo + " €",'<div class="sumar">Add up</div><div class="restar">Subtract</div><div class="eliminar">Remove</div>']);
				var antes=$('#totalventa').text();
				redondeo = Math.round((parseFloat(antes) + redondeo)*100)/100;
				$("#totalventa").html(redondeo);
				$(".sumar").button({icons:{primary: 'ui-icon-plusthick'}});
				$(".restar").button({icons:{primary: 'ui-icon-minusthick'}});
				$(".eliminar").button({icons:{primary: 'ui-icon-trash'}});
				
					}			
				}
				this.parentNode.firstChild.value= ""; // dejo el campo vacio
				//tabla2.fnDraw();
				} )
				
				$('.eliminar').live('click', function () {
				
				var tdtabla2 = $('td', this.parentNode.parentNode);
				var cantidad2 = parseInt($(tdtabla2[2]).text());
				var precio = parseFloat($(tdtabla2[3]).text());
				var id = parseInt($(tdtabla2[0]).text());

				var tdtabla1 = $('td',tabla1.fnGetNodes());

				for ( var i=0 ; i<parseInt(tdtabla1.length); i=i+8 ){
						if ($(tdtabla1[i]).text() == id){
							stock =  parseInt($(tdtabla1[i+2]).text());
							tabla1.fnUpdate( stock+cantidad2 + " unit/s", i/8, 2 );
							var antes=$('#totalventa').text();
							redondeo =Math.round((parseFloat(antes)-cantidad2*precio)*100)/100;
							$("#totalventa").html(redondeo);
					}
				}
				var aPos = tabla2.fnGetPosition(this.parentNode);				
				tabla2.fnDeleteRow(aPos[0]);
				}
				)
				
				$('.restar').live('click', function () {
				
				var tdtabla2 = $('td', this.parentNode.parentNode);
				var aPos = tabla2.fnGetPosition(this.parentNode.parentNode);
				
				
				tabla2.fnUpdate( parseInt($(tdtabla2[2]).text())-1 + " unit/s", aPos, 2 );
				
				var id = parseInt($(tdtabla2[0]).text());
				
				var tdtabla1 = $('td',tabla1.fnGetNodes());
				
				for ( var i=0 ; i<parseInt(tdtabla1.length); i=i+8 ){	
						if ($(tdtabla1[i]).text() == id){
							stock =  parseInt($(tdtabla1[i+2]).text());
							tabla1.fnUpdate( stock+1 + " unit/s", i/8, 2 );
							redondeo = parseFloat($(tdtabla2[4]).text()) - parseFloat($(tdtabla2[3]).text());
							redondeo =Math.round(redondeo*100)/100;	
							tabla2.fnUpdate(redondeo + " €", aPos, 4 );
							var antes=$('#totalventa').text();
							var cant = parseFloat($(tdtabla2[3]).text());
							redondeo =Math.round((parseFloat(antes)-cant)*100)/100;	
							$("#totalventa").html(redondeo);
					}
				}
				if (parseInt($(tdtabla2[2]).text()) == 0)//si al restar se queda en 0 elimino la fila
					tabla2.fnDeleteRow(aPos);		
				
				}
				)
				
				$('.sumar').live('click', function () {
				
				var tdtabla2 = $('td', this.parentNode.parentNode);
				var aPos = tabla2.fnGetPosition(this.parentNode.parentNode);
				
				var id = parseInt($(tdtabla2[0]).text());
				
				var tdtabla1 = $('td',tabla1.fnGetNodes());
				
				for ( var i=0 ; i<parseInt(tdtabla1.length); i=i+8 ){	
						if ($(tdtabla1[i]).text() == id){
							stock =  parseInt($(tdtabla1[i+2]).text());
							if (stock > 0){
								tabla1.fnUpdate( stock-1 + " unit/s", i/8, 2 );
								tabla2.fnUpdate( parseInt($(tdtabla2[2]).text())+1 + " unit/s", aPos, 2 );
								redondeo = parseFloat($(tdtabla2[4]).text()) + parseFloat($(tdtabla2[3]).text());
								redondeo =Math.round(redondeo*100)/100;	
								tabla2.fnUpdate(redondeo + " €", aPos, 4 );
								var antes=$('#totalventa').text();
								var cant = parseFloat($(tdtabla2[3]).text());
								redondeo =Math.round((parseFloat(antes)+cant)*100)/100;	
								$("#totalventa").html(redondeo);
								}
						}
					}
				}
				)
				
				$('.eliminarreserva').live('click', function () {
				var tdtabla4 = $('td', this.parentNode.parentNode);
				var cantidad2 = parseInt($(tdtabla4[2]).text());
				var precio = parseFloat($(tdtabla4[3]).text());
				var id = parseInt($(tdtabla4[0]).text());

				var tdtabla3 = $('td',tabla3.fnGetNodes());
				for ( var i=0 ; i < parseInt(tdtabla3.length); i=i+9 ){
						if ($(tdtabla3[i]).text() == id){
							var stockreservado =  parseInt($(tdtabla3[i+3]).text());
							tabla3.fnUpdate( stockreservado - cantidad2 + " unit/s", i/9, 4 );
							var antes=$('#totalventa').text();
							redondeo =Math.round((parseFloat(antes)-cantidad2*precio)*100)/100;
							$("#totalventa").html(redondeo);
					}
				}
				var aPos = tabla4.fnGetPosition(this.parentNode);				
				tabla4.fnDeleteRow(aPos[0]);
				}
				)
				
				$('.restarreserva').live('click', function () {
				var tdtabla4 = $('td', this.parentNode.parentNode);
				var aPos = tabla4.fnGetPosition(this.parentNode.parentNode);
				tabla4.fnUpdate( parseInt($(tdtabla4[2]).text())-1 + " unit/s", aPos, 2 );
				var id = parseInt($(tdtabla4[0]).text());
				var tdtabla3 = $('td',tabla3.fnGetNodes());
				
				for ( var i=0 ; i<parseInt(tdtabla3.length); i=i+8 ){
						if ($(tdtabla3[i]).text() == id){
							stockreservado =  parseInt($(tdtabla3[i+3]).text());
							tabla3.fnUpdate( stockreservado -1 + " unit/s", i/8, 4 );
							redondeo = parseFloat($(tdtabla4[4]).text()) - parseFloat($(tdtabla4[3]).text());
							redondeo =Math.round(redondeo*100)/100;	
							tabla4.fnUpdate(redondeo + " €", aPos, 4 );
							var antes=$('#totalventa').text();
							var cant = parseFloat($(tdtabla4[3]).text());
							redondeo =Math.round((parseFloat(antes)-cant)*100)/100;	
							$("#totalventa").html(redondeo);
					}
				}
				if (parseInt($(tdtabla4[2]).text()) == 0)//si al restar se queda en 0 elimino la fila
					tabla4.fnDeleteRow(aPos);		
				
				}
				)
				
				$('.sumarreserva').live('click', function () {
				var tdtabla4 = $('td', this.parentNode.parentNode);
				var aPos = tabla4.fnGetPosition(this.parentNode.parentNode);
				tabla4.fnUpdate( parseInt($(tdtabla4[2]).text())+1 + " unit/s", aPos, 2 );
				var id = parseInt($(tdtabla4[0]).text());
				var tdtabla3 = $('td',tabla3.fnGetNodes());
				
				for ( var i=0 ; i<parseInt(tdtabla3.length); i=i+8 ){
						if ($(tdtabla3[i]).text() == id){
							stockreservado =  parseInt($(tdtabla3[i+3]).text());
							tabla3.fnUpdate( stockreservado +1 + " unit/s", i/8, 4 );
							redondeo = parseFloat($(tdtabla4[4]).text()) + parseFloat($(tdtabla4[3]).text());
							redondeo =Math.round(redondeo*100)/100;	
							tabla4.fnUpdate(redondeo + " €", aPos, 4 );
							var antes=$('#totalventa').text();
							var cant = parseFloat($(tdtabla4[3]).text());
							redondeo =Math.round((parseFloat(antes)+cant)*100)/100;	
							$("#totalventa").html(redondeo);
						}
					}
				}
				)
					
			  //botones de pedido abajo			
				$('.eliminar1').live('click', function () {
					var aPos = tabla4.fnGetPosition(this.parentNode);				
					tabla4.fnDeleteRow(aPos[0]);
					var tdtabla4 = $('td', this.parentNode.parentNode);
					var cantidad2 = parseInt($(tdtabla4[2]).text());
					var precio = parseFloat($(tdtabla4[3]).text());
					var antes = $('#totalventa').text();
					redondeo =Math.round((parseFloat(antes)-cantidad2*precio)*100)/100;
					$("#totalventa").html(redondeo);
					}
				)
				
				$('.restar1').live('click', function () {
					var tdtabla4 = $('td', this.parentNode.parentNode);
					var aPos = tabla4.fnGetPosition(this.parentNode.parentNode);
					tabla4.fnUpdate( parseInt($(tdtabla4[2]).text())-1 + " unit/s", aPos, 2 );
					redondeo = parseFloat($(tdtabla4[4]).text()) - parseFloat($(tdtabla4[3]).text());
					redondeo =Math.round(redondeo*100)/100;	
					tabla4.fnUpdate(redondeo + " €", aPos, 4 );
				    var antes = $('#totalventa').text();
					var cant = parseFloat($(tdtabla4[3]).text());
					redondeo = Math.round((parseFloat(antes)-cant)*100)/100;	
					$("#totalventa").html(redondeo);
					if (parseInt($(tdtabla4[2]).text()) == 0)//si al restar se queda en 0 elimino la fila
						tabla4.fnDeleteRow(aPos);
					}
				)
				
				$('.sumar1').live('click', function () {
					var tdtabla4 = $('td', this.parentNode.parentNode);
					var aPos = tabla4.fnGetPosition(this.parentNode.parentNode);
					tabla4.fnUpdate( parseInt($(tdtabla4[2]).text())+1 + " unit/s", aPos, 2 );
					redondeo = parseFloat($(tdtabla4[4]).text()) + parseFloat($(tdtabla4[3]).text());
					redondeo =Math.round(redondeo*100)/100;
					tabla4.fnUpdate(redondeo + " €", aPos, 4 );
					var antes = $('#totalventa').text();
					var cant = parseFloat($(tdtabla4[3]).text());
					redondeo = Math.round((parseFloat(antes)+cant)*100)/100;	
					$("#totalventa").html(redondeo);
					}
				)
			});