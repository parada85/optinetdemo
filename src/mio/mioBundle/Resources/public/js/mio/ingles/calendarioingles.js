$(document).ready(function () {

var citas = Routing.generate('listarcitascalendario',{id: 0});
var arqueos = Routing.generate('listararqueoscalendario',{idemp: 0});


$('#calendarioarqueo').fullCalendar(
            {
                defaultView: 'month'
          ,
          columnFormat:{
             month: 'dddd'
        },
        titleFormat:{
            week: "d[ yyyy]{ '&#8212;'[ MMM] d MMMM yyyy}", // Sep 7 - 13 2009
            day: 'dddd, d MMMM yyyy'
          },
          height:600,
        axisFormat:'HH:mm',
            theme: true,
            height:450,
            defaultEventMinutes: 120,
            weekends:false,
             header: {
                    left: 'prev,next today',
                    center: 'title'
                    },
             eventSources: [
        {
            url: arqueos
        }]
        ,
          eventRender: function(event, element) {
                element.qtip({
                  content: 'Hour: '+ event.hora + '<br/>' + 'Make for: ' + event.empleado,
                  show: {
                  effect: function(offset) {
                    $(this).slideDown(400); // "this" refers to the tooltip
                  }
                }
                  });
          if(event.efectivocontado!=null){
                var difboleta = event.boletascontado - event.boletas;
                var difefectivo = event.efectivocontado - event.efectivo;
                 difefectivo = Math.round(difefectivo*100)/100;
                element.find('.fc-event-title').append("<br/> Boletas: " + event.boletas + " Count: " + event.boletascontado + " Difference :"+ difboleta);
                element.find('.fc-event-title').append("<br/> Cash: " + event.efectivo + " Count: " + event.efectivocontado + " Difference :"+ difefectivo);
              }
              } 
  });

 $('#calendar').fullCalendar(//calendario citas
            {
                defaultView: 'agendaWeek'
          ,
          columnFormat:{
            week: 'dddd d/M',
            day: 'dddd d/M'  // Monday 9/7
        },
        titleFormat:{
            week: "d[ yyyy]{ '&#8212;'[ MMM] d MMMM yyyy}", // Sep 7 - 13 2009
            day: 'dddd, d MMMM yyyy'
          }
        ,
        axisFormat:'HH:mm',

                theme: true
                ,
                height: 9999999999,
                allDaySlot:false,
                firstHour: 9,
                droppable: true,
                editable: true,
                disableResizing: true
                ,
                defaultEventMinutes: 30
                ,
                minTime:9
                ,
                maxTime:20
                ,
                weekends:false
                ,
             header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'agendaWeek,agendaDay'
                    },
                     eventSources: [
        {
            url: citas
        },
        
        {
          url: Routing.generate('festivosajax'), // use the `url` property
            color: 'red'
        }],
        eventDrop: function (event, dayDelta, minuteDelta, allDay, revertFunc, jsEvent, ui, view){
          var dia = new Date();
       if (event.start < dia){
        $("#erroranterior").wijdialog('open');
        setTimeout(function() {$(".qtip").remove();}, 1000)
        $('#calendar').fullCalendar( 'refetchEvents' );
      }
      else{
            var cliente,seleccionmedico;
            date = event.start;
            var m = date.getMonth() + 1;
            var d = date.getDate();
            var y = date.getFullYear(); 
            var t = date.toLocaleTimeString().toLowerCase().replace(/:\d\d ([ap]m) .+$/,' $1');
            var fecha =  d + '-' + m + '-' + y  + ' ' + t;

            $.ajax({data: { fecha: fecha },
            url: Routing.generate('comprobarcitafestivo'),
            success: function(data) {
              if (data == 1){
                  $.getJSON(Routing.generate('obtenerdatoscita'),{ citaid: event.id }, function(data) {
                  $.each(data, function(index, value) {
                    cliente = data[index].cliente;
                    seleccionmedico = data[index].medico;
                    $.ajax({
                    data: { fecha: fecha, medico: seleccionmedico, cliente : cliente },
                    url: Routing.generate('comprobarcita'),
                    success: function(data) {
                      if (data == 1){
                         $.ajax({
                          data: { fecha: fecha, medico: seleccionmedico,},
                          url: Routing.generate('comprobarmedico1'),
                          success: function(data) {
                          if (data == 1){
                            $.ajax({
                                data: { fecha: fecha, idcita: event.id },
                                url: Routing.generate('modificarcita')
                                  });
                                setTimeout(function() {
                                  $('#calendar').fullCalendar( 'refetchEvents' );
                                   tablacitas.fnReloadAjax();
                                  }, 1000)
                          }
                          else{
                          $('#errorcita').wijdialog('open');
                          $('#calendar').fullCalendar( 'refetchEvents' );
                          }
                        }
                      })
                        }
                        else{
                          $('#errorcita').wijdialog('open');
                          $('#calendar').fullCalendar( 'refetchEvents' );
                          }
                        $(".qtip").remove();
                        }
                      });

                  })
                })
                   }
                   else{
                    $('#calendar').fullCalendar( 'refetchEvents' );
                    $(".qtip").remove();
                  }
                 }
              })
              }
                },
              eventRender: function(event, element) {
              if (event.empleado !=null){// es una cita y no un festivo
                if (event.color == 'black')
                  element.draggable({ disabled: true });
                element.qtip({
                  content: event.fecha + '<br/>' + 'Make for: ' + event.empleado,
                  show: {
                  effect: function(offset) {
                    $(this).slideDown(400); // "this" refers to the tooltip
                  }
                }
                  });
                element.find('.fc-event-title').append(" " + event.apellido1+ "<br/>" + event.contacto);
              }
        },
     dayClick: function(date, allDay, jsEvent, view) {
      var dia = new Date();
       if (date < dia)
        $("#erroranterior").wijdialog('open');
      else{
        var m = date.getMonth() + 1;
        var d = date.getDate();
        var y = date.getFullYear(); 
        var t = date.toLocaleTimeString().toLowerCase().replace(/:\d\d ([ap]m) .+$/,' $1');
        var fecha = y + '-' + m + '-' + d + ' ' + t;
          //pantalla lista de medicos y clientes.
          $('#dialogonuevacita').data('fecha',fecha);
          $('#fechadialogo').html('Date: '+ d + '/' + m + '/' + y + ' ' + t);
          //comprobar que no sea festivo
          $.ajax({data: { fecha: fecha },
            url: Routing.generate('comprobarcitafestivo'),
            success: function(data) {
              if (data == 1){
                $(".selectmedico").remove();
                $.getJSON(Routing.generate('comprobarmedico'),{ fecha: fecha }, function(data) {
                  $.each(data, function(index, value) {
                    //alert(data[index].id);
                    //alert(data[index].nombre);
                    $("#seleccionmedico").append("<option class='selectmedico' value='" + data[index].id + "'>" + data[index].nombre + "</option>");
                  })
                })
              //$("#seleccionmedico").wijdropdown("refresh");
              $("#dialogonuevacita").wijdialog('open');
              $(".th").click();
                }
              }
            });
      }
    },
    eventClick: function(calEvent, jsEvent, view) {
        if (calEvent.title!="Holiday" && calEvent.color!='black'){
          $('#calendardialogedit').data('idcita',calEvent.id);
          $("#calendardialogedit").wijdialog('open');
        }
        if (calEvent.color == 'black'){
          $.fancybox.open({
          href: Routing.generate('informepdf',{id : calEvent.informe}),
          type: 'iframe'
          });
        }
    }
  });

$('.calendar').fullCalendar('option', 'aspectRatio', 1.8);

$('#calendar1').fullCalendar(//calendario festivos
            {
                defaultView: 'month'
          ,
          columnFormat:{
             month: 'dddd'
        },
        titleFormat:{
            week: "d[ yyyy]{ '&#8212;'[ MMM] d MMMM yyyy}", // Sep 7 - 13 2009
            day: 'dddd, d MMMM yyyy'
          },
          height:600,
        axisFormat:'HH:mm',
            theme: true,
            height:450,
            defaultEventMinutes: 120,
            weekends:false,
             header: {
                    left: 'prev,next today',
                    center: 'title'
                    },
            events: Routing.generate('festivosajax')
        ,
        eventColor: 'red',
     dayClick: function(date, allDay, jsEvent, view) {
      var existe = 0;
        var m = date.getMonth() + 1;
        var d = date.getDate();
        var y = date.getFullYear(); 
        var t = date.toLocaleTimeString().toLowerCase().replace(/:\d\d ([ap]m) .+$/,' $1');
        var fecha =  y + '-' + m + '-' + d  + ' ' + '09:00:00';
        $('#festivos').data('fecha',fecha);
        $("#festivos").wijdialog('open');
    },
    eventClick: function(calEvent, jsEvent, view) {
          $('#borrarfestivo').data('idfestivo',calEvent.id);
          $("#borrarfestivo").wijdialog('open');
        }
  });

$('#calendar1').fullCalendar('option', 'aspectRatio', 1.8);

$('#calendar2').fullCalendar(
            {
            defaultView: 'agendaWeek',
            buttonText: {
              today:    'Hoy',
              week:     'Semana',
              day:      'Dia'
            },
            columnFormat:{
              week: 'dddd d/M',
              day: 'dddd d/M'  // Monday 9/7
            },
            titleFormat:{
              week: "d[ yyyy]{ '&#8212;'[ MMM] d MMMM yyyy}", // Sep 7 - 13 2009
              day: 'dddd, d MMMM yyyy'
           }
            ,
            axisFormat:'HH:mm',

                theme: true
                ,
                height:600,
                allDaySlot:false,
                firstHour: 9
                ,
                defaultEventMinutes: 30
                ,
                minTime:9
                ,
                maxTime:20
                ,
                weekends:false
                ,
             header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'agendaWeek,agendaDay'
                    },
                     eventSources: [
        {
            url: Routing.generate('listarcitascalendario',{id: $('#medicoinforme').text()})
        },
        {
          url: Routing.generate('festivosajax'), // use the `url` property
            color: 'red',    // an option!
        }],
              eventRender: function(event, element) {
                if (event.empleado !=null){// es una cita y no un festivo
                element.qtip({
                  content: event.fecha + '<br/>' + 'Make for: ' + event.empleado,
                  show: {
                  effect: function(offset) {
                    $(this).slideDown(400); // "this" refers to the tooltip
                  }
                }
                  });
                element.find('.fc-event-title').append(" " + event.apellido1+ "<br/>" + event.contacto);
              }
        },
    eventClick: function(calEvent, jsEvent, view) {
      if (calEvent.informe == 'NO'){
        var url = Routing.generate('informe_new',{id: calEvent.id,id1: calEvent.id});
        window.location = url;
        }
      else
      $.fancybox.open({
        href: Routing.generate('informepdf',{id : calEvent.informe}),
        type: 'iframe'
        });
      }
  });

$('#calendar2').fullCalendar('option', 'aspectRatio', 1.8);


$('#vacaciones').fullCalendar(
            {
            defaultView: 'month'
            ,
            columnFormat:{
              week: 'dddd d/M',
              day: 'dddd d/M',  // Monday 9/7
              month: 'dddd'
            },
            titleFormat:{
              week: "d[ yyyy]{ '&#8212;'[ MMM] d MMMM yyyy}", // Sep 7 - 13 2009
              day: 'dddd, d MMMM yyyy'
           }
            ,
            axisFormat:'HH:mm',

                theme: true
                ,
                height:600,
                firstDay:1,
                allDaySlot:false,
                editable: true,
                droppable: true, // this allows things to be dropped onto the calendar !!!
             header: {
                    left: 'prev,next today',
                    center: 'title'
                    },
                     eventSources: [
        {
            url: Routing.generate('listarpermisoscalendario'),
        },
        {
          url: Routing.generate('festivosajax'), // use the `url` property
            color: 'red',    // an option!
        }],
        
        drop: function(date, allDay, jsEvent, ui) { // this function is called when something is dropped
                // retrieve the dropped element's stored Event Object
                var originalEventObject = $(this).data('eventObject');
                // we need to copy it, so that multiple events don't have a reference to the same object
                var copiedEventObject = $.extend({}, originalEventObject);
                // assign it the date that was reported
                copiedEventObject.start = date;
                copiedEventObject.allDay = allDay;
                $(this).effect('pulsate');

                var m = date.getMonth() + 1;
                var d = date.getDate();
                var y = date.getFullYear(); 
                var t = date.toLocaleTimeString().toLowerCase().replace(/:\d\d ([ap]m) .+$/,' $1');
                var fecha =  y + '-' + m + '-' + d + ' ' + '09:00:00';

                    $.ajax({
                    data: { fecha: fecha, empleado: copiedEventObject.title , tipo: copiedEventObject.tipo ,fin: 'null',daydelta: 'no', chivato:'no'},
                    url: Routing.generate('comprobarpermiso'),
                    success: function(data) {
                      if (data == 1){
                              $.ajax
                                  ({
                                      url: Routing.generate('guardarpermiso'),
                                      data: { empleado: copiedEventObject.title , tipo : copiedEventObject.tipo, inicio: fecha, fin: 'null'}
                                  });

                              setTimeout(function() {//esperar un segundo para que de tiempo a guardar.
                                    $('#vacaciones').fullCalendar( 'refetchEvents' );
                                      }, 1000)
                            }
                        else
                          if (data == 2)
                              alert("El empleado ya tiene ese tipo de vacaciones en este año");
                          else
                              alert("Error el empleado tiene un permiso en esa fecha");
                          }
                        })
                  },

      eventDrop: function (event, dayDelta, minuteDelta, allDay, revertFunc, jsEvent, ui, view)
                {
                   var fin = event.end;

                   if (event.end == null)
                    fin = 'null';

                   $.ajax({
                    data: { fecha: event.start,fin : fin ,empleado: event.title, tipo: event.tipo ,daydelta: 'no', chivato:'si' },
                    url: Routing.generate('comprobarpermiso'),
                    success: function(data) {
                      if (data == 1){
                            $.ajax({url: Routing.generate('borrarpermiso',{id: event.id})});
                            $.ajax
                                  ({
                                      url: Routing.generate('guardarpermiso'),
                                      data: { empleado: event.title , tipo : event.tipo, inicio: event.start, fin: fin}
                                  });
                                }
                              else
                                alert("Error el empleado tiene un permiso en esa fecha");
                            }
                          })
            setTimeout(function() {//esperar un segundo para que de tiempo a guardar.
              $('#vacaciones').fullCalendar( 'refetchEvents' );
                }, 1000)
        },

    eventResize: function (event, dayDelta, minuteDelta, allDay, revertFunc, jsEvent, ui, view)
                {
                  var fin = event.end;

                   if (event.end == null)
                    fin = 'null';

                  if (dayDelta > 0 ){
                        $.ajax({
                          data: { fecha: event.start,fin : fin ,empleado: event.title, tipo: event.tipo , daydelta: dayDelta-1,chivato:'no' },
                          url: Routing.generate('comprobarpermiso'),
                          success: function(data) {
                            if (data == 1){
                                  $.ajax({url: Routing.generate('borrarpermiso',{id: event.id})});
                                  $.ajax
                                        ({
                                            url: Routing.generate('guardarpermiso'),
                                            data: { empleado: event.title , tipo : event.tipo, inicio: event.start, fin: fin}
                                        });
                                      }
                                    else
                                      alert("Error el empleado tiene un permiso en esa fecha");
                                  }
                                })
                  setTimeout(function() {//esperar un segundo para que de tiempo a guardar.
                    $('#vacaciones').fullCalendar( 'refetchEvents' );
                      }, 1000)
                }
                else{
                  $.ajax({url: Routing.generate('borrarpermiso',{id: event.id})});
                  $.ajax
                       ({
                       url: Routing.generate('guardarpermiso'),
                       data: { empleado: event.title , tipo : event.tipo, inicio: event.start, fin: fin}
                        });
                   }
                
            },
        eventClick: function(calEvent, jsEvent, view) {

           if (calEvent.title != "Holiday"){
              $('#borrarpermiso').data('idpermiso',calEvent.id);
              $("#borrarpermiso").wijdialog('open');
            }
      }
  });

$('#vacaciones').fullCalendar('option', 'aspectRatio', 1.8);


  $('#select1').change(function() {
    $('#calendar').fullCalendar( 'removeEventSource', citas );
    citas = Routing.generate('listarcitascalendario',{id: $('#select1').val()});
    $('#calendar').fullCalendar( 'addEventSource', citas );
    $('#calendar').fullCalendar( 'refetchEvents' );
    });

  $('#calendarioemparqueo').change(function() {
    $('#calendarioarqueo').fullCalendar( 'removeEventSource', arqueos );
    arqueos = Routing.generate('listararqueoscalendario',{idemp: $('#calendarioemparqueo').val()});
    $('#calendarioarqueo').fullCalendar( 'addEventSource', arqueos );
    $('#calendarioarqueo').fullCalendar( 'refetchEvents' );
    });

  $('.seleccionparacita').live('click', function () {
                var nTds = $('td', this.parentNode.parentNode);
                var id = $(nTds[0]).text();
                var fecha = $('#dialogonuevacita').data('fecha');
                $.ajax({
                    data: { fecha: fecha, medico: $('#seleccionmedico').val(), cliente : id },
                    url: Routing.generate('comprobarcita'),
                    success: function(data) {
                      if (data == 1){
                        $('#ajax-loader').show();
                        $.ajax({
                            data: { fecha: fecha, medico: $('#seleccionmedico').val(), cliente : id },
                            url: Routing.generate('guardarcita')
                              });
                            setTimeout(function() {//esperar un segundo para que de tiempo a guardar.
                              $('#calendar').fullCalendar( 'refetchEvents' );
              $('#dialogonuevacita').wijdialog('close');
              $('#ajax-loader').hide();
              tablacitas.fnReloadAjax();
                }, 1000)
                      }
                        else
                           $('#errorcita').wijdialog('open');
                        }
                    });
         })


        $('div.invierno, div.verano, div.baja').each(function() {
        
            // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
            // it doesn't need to have a start or end
            var eventObject = {
                title: $.trim($(this).text()), // use the element's text as the event title
                color : $(this).attr("id"),
                tipo : $(this).attr("class")
            };
            
            // store the Event Object in the DOM element so we can get to it later
            $(this).data('eventObject', eventObject);
            
            // make the event draggable using jQuery UI
            $(this).draggable({  
                zIndex: 999,
                revert: true,      // will cause the event to go back to its
                revertDuration: 0  //  original position after the drag
            });
            
        });


        $('.botoninvierno').live('click', function () {
            $('#borrarpermisos').data('idpermiso','invierno');
            $("#borrarpermisos").wijdialog('open');
        })
        $('.botonverano').live('click', function () {
            $('#borrarpermisos').data('idpermiso','verano');
            $("#borrarpermisos").wijdialog('open');
        })
        $('.botonbaja').live('click', function () {
            $('#borrarpermisos').data('idpermiso','baja');
            $("#borrarpermisos").wijdialog('open');
        })
});