$(document).ready(function () {

jQuery.extend( jQuery.fn.dataTableExt.oSort, {
    "formatted-num-pre": function ( a ) {
        a = (a==="-") ? 0 : a.replace( /[^\d\-\.]/g, "" );
        return parseFloat( a );
    },
 
    "formatted-num-asc": function ( a, b ) {
        return a - b;
    },
 
    "formatted-num-desc": function ( a, b ) {
        return b - a;
    }
} );


jQuery.extend( jQuery.fn.dataTableExt.oSort, {
    "date-euro-pre": function ( a ) {
        if ($.trim(a) != '') {
            var frDatea = $.trim(a).split(' ');
            var frTimea = frDatea[1].split(':');
            var frDatea2 = frDatea[0].split('/');
            var x = (frDatea2[2] + frDatea2[1] + frDatea2[0] + frTimea[0] + frTimea[1] + frTimea[2]) * 1;
        } else {
            var x = 10000000000000; // = l'an 1000 ...
        }
         
        return x;
    },
 
    "date-euro-asc": function ( a, b ) {
        return a - b;
    },
 
    "date-euro-desc": function ( a, b ) {
        return b - a;
    }
} );

TableTools.DEFAULTS.sSwfPath = "bundles/miomio/js/media/swf/copy_csv_xls_pdf.swf";

    $.fn.dataTableExt.oApi.fnReloadAjax = function ( oSettings, sNewSource, fnCallback, bStandingRedraw )
{
    if ( typeof sNewSource != 'undefined' && sNewSource != null )
    {
        oSettings.sAjaxSource = sNewSource;
    }
    this.oApi._fnProcessingDisplay( oSettings, true );
    var that = this;
    var iStart = oSettings._iDisplayStart;
    var aData = [];
 
    this.oApi._fnServerParams( oSettings, aData );
     
    oSettings.fnServerData( oSettings.sAjaxSource, aData, function(json) {
        /* Clear the old information from the table */
        that.oApi._fnClearTable( oSettings );
         
        /* Got the data - add it to the table */
        var aData =  (oSettings.sAjaxDataProp !== "") ?
            that.oApi._fnGetObjectDataFn( oSettings.sAjaxDataProp )( json ) : json;
         
        for ( var i=0 ; i<aData.length ; i++ )
        {
            that.oApi._fnAddData( oSettings, aData[i] );
        }
         
        oSettings.aiDisplay = oSettings.aiDisplayMaster.slice();
        that.fnDraw();
         
        if ( typeof bStandingRedraw != 'undefined' && bStandingRedraw === true )
        {
            oSettings._iDisplayStart = iStart;
            that.fnDraw( false );
        }
         
        that.oApi._fnProcessingDisplay( oSettings, false );
         
        /* Callback user function - for event handlers etc */
        if ( typeof fnCallback == 'function' && fnCallback != null )
        {
            fnCallback( oSettings );
        }
    }, oSettings );
}

tablalistar = $('.listar').dataTable( {
                    "bJQueryUI": true,
                    "sScrollY": "288px",
                    "bScrollCollapse": true,
                    "bPaginate": false, 
                    "aoColumns": [
                        { sWidth: '70px' },
                        { sWidth: '200px' },
                        { sWidth: '130px' },
                        { sWidth: '130px' },
                        { sWidth: '100px' },
                        { sWidth: '100px' },
                        { sWidth: '160px' },
                        { sWidth: '160px' }
                    ]
                })

tablalog = $('#tablalog').dataTable( {
                    "bJQueryUI": true,  
                    "sDom": '<"H"Tfr>t<"F"ip>',
                    "sScrollY": "350px",
                    "bScrollCollapse": true,
                    "bPaginate": false,
                    "aoColumns": [{ "sType": "date-euro" },null,null,{ "bVisible": false },null],
                    "oTableTools": {
                        "sSwfPath": "../bundles/miomio/js/media/swf/copy_csv_xls_pdf.swf",
                        "aButtons": [
                            { "sExtends": "copy","bFooter": false, "sButtonText": "Copiar","mColumns": "visible"},
                            { "sExtends": "csv", "bFooter": false, "sButtonText": "Csv", "mColumns": "visible"},
                            { "sExtends": "pdf", "bFooter": false, "sButtonText": "Pdf", "sPdfOrientation": "landscape", "mColumns": "visible"}
                            ]
                    }
                } )

tablalog.columnFilter({"bUseColVis": true, "aoColumns":[null,{ sSelector: "#mostrarempconexion", type:"select" },null,{ sSelector: "#datepicker",type: "date-range" },{ sSelector: "#mostrarconexion", type:"select" }]});

tablacambios = $('#tablacambios').dataTable( {
                    "bJQueryUI": true,  
                    "sScrollY": "350px",
                    "sDom": '<"H"Tfr>t<"F"ip>',
                    "bPaginate": false,
                    "bScrollCollapse": true,
                    "oTableTools": {
                        "sSwfPath": "../bundles/miomio/js/media/swf/copy_csv_xls_pdf.swf",
                        "aButtons": [
                            { "sExtends": "copy","bFooter": false, "sButtonText": "Copiar", "mColumns": [1,2,3,4,5]},
                            { "sExtends": "csv", "bFooter": false, "sButtonText": "Csv", "mColumns": [1,2,3,4,5]},
                            { "sExtends": "pdf", "bFooter": false, "sButtonText": "Pdf", "mColumns": [1,2,3,4,5]}
                            ]
                    },
                    "aoColumns": [
                        { "bVisible": false },
                        { "sType": "date-euro" },
                        null,
                        null,
                        null,
                        null,
                        null
                    ]
                    } )

tablacambios.columnFilter({"bUseColVis": true, "aoColumns":[null,{ sSelector: "#datepicker",type: "date-range" },{ sSelector: "#cempleado", type:"select" },{ sSelector: "#cempleado1", type:"select" },{ sSelector: "#cempleado2", type:"select" },null,null]});

tabla2 = $('#tabla2').dataTable( {
                "bJQueryUI": true,
                    "bPaginate": true,
                    "aoColumns": [
                        { "sType": "formatted-num" },
                        { sWidth: '30%' },
                        { "sType": "formatted-num" },
                        { "sType": "formatted-num" },
                        { "sType": "formatted-num" },
                        { sWidth: '30%' }
                    ]
                })

                tabla3 = $('#tabla3').dataTable( {
                    "bJQueryUI": true,  
                    "sScrollY": "310px",
                    "bPaginate": false,
                    "bScrollCollapse": true,
                    "aoColumns": [null,null,{ "sType": "formatted-num" },{ "bVisible": false },{ "sType": "formatted-num" },{ "sType": "formatted-num" },{ "sType": "formatted-num" },{ "bVisible": false },{ "sType": "formatted-num" },{ "bVisible": false },{ "bVisible": false },{ sWidth: '15%' }]
                } )
                tabla3.columnFilter({"bUseColVis": true,"aoColumns": [null,null,null,{sSelector: ".numeros", type:"number-range" },null,null,null,{sSelector: ".numeros1", type:"number-range" },null,{ sSelector: ".mostrarproductofamilia", type:"select" },{ sSelector: ".mostrarproductoproveedor", type:"select" },null]});
                
                tabla4 = $('#tabla4').dataTable( {
                "aoColumns": [
                        { sWidth: '5%',"sType": "formatted-num"  },
                        { sWidth: '25%' },
                        { sWidth: '15%',"sType": "formatted-num"  },
                        { sWidth: '10%',"sType": "formatted-num"  },
                        { sWidth: '10%',"sType": "formatted-num"  },
                        { sWidth: '40%' }
                    ],
                    "bJQueryUI": true
                } )

                    tablaseleccion = $('#tablaseleccion').dataTable( {
                    "bJQueryUI": true,
                    "sScrollY": "350px",
                    "bPaginate": false,
                    "bScrollCollapse": true
                } )

                    tablacitas = $('#tablacitas').dataTable( {
                    "bJQueryUI": true,
                    "sDom": '<"H"Tfr>t<"F"ip>',
                    "sScrollY": "400px",
                    "bPaginate": false,
                    "sAjaxSource": Routing.generate('listarcitas'),
                    "bScrollCollapse": true,
                    "oTableTools": {
                        "aButtons": [
                            { "sExtends": "copy","bFooter": false, "sButtonText": "Copiar","mColumns": [0,1,2,3,4,5,6,7]},
                            { "sExtends": "csv", "bFooter": false, "sButtonText": "Csv", "mColumns": [0,1,2,3,4,5,6,7]},
                            { "sExtends": "pdf", "bFooter": false, "sButtonText": "Pdf", "sPdfOrientation": "landscape", "mColumns": [0,1,2,3,4,5,6,7]}
                            ]
                    },
                    "aoColumns": [
                        { "mDataProp": "dni" },
                        { "mDataProp": "nombre" },
                        { "mDataProp": "apellido1" },
                        { "mDataProp": "apellido2" },
                        { "mDataProp": "realizada" },
                        { "mDataProp": "medico" },
                        { "mDataProp": "fecha", "sType": "date-euro" },
                        { "mDataProp": "fecha cita" , "sType": "date-euro" }
        ]
                } )
    
                tablafestivos = $('#tablafestivos').dataTable( {
                    "bJQueryUI": true,
                    "sDom": '<"H"Tfr>t<"F"ip>',
                    "sScrollY": "400px",
                    "bPaginate": false,
                    "sAjaxSource": Routing.generate('listarfestivos'),
                    "bScrollCollapse": true,
                    "oTableTools": {
                        "sSwfPath": "../bundles/miomio/js/media/swf/copy_csv_xls_pdf.swf",
                        "aButtons": [
                            { "sExtends": "copy","bFooter": false, "sButtonText": "Copiar"},
                            { "sExtends": "csv", "bFooter": false, "sButtonText": "Csv"},
                            { "sExtends": "pdf", "bFooter": false, "sButtonText": "Pdf"}
                            ]
                    },
                    "aoColumns": [
                        { "mDataProp": "fecha", "sType": "date" }
                            ]
                    } )

                    tablapermisos = $('#tablapermisos').dataTable( {
                    "bJQueryUI": true,
                    "sDom": '<"H"Tfr>t<"F"ip>',
                    "sScrollY": "400px",
                    "bPaginate": false,
                    "sAjaxSource": Routing.generate('listarpermisos',{id: 0}),
                    "bScrollCollapse": true,
                    "oTableTools": {
                        "sSwfPath": "../bundles/miomio/js/media/swf/copy_csv_xls_pdf.swf",
                        "aButtons": [
                            { "sExtends": "copy","bFooter": false, "sButtonText": "Copiar","mColumns": [0,1,2,3,4,5,6,7]},
                            { "sExtends": "csv", "bFooter": false, "sButtonText": "Csv", "mColumns": [0,1,2,3,4,5,6,7]},
                            { "sExtends": "pdf", "bFooter": false, "sButtonText": "Pdf", "sPdfOrientation": "landscape", "mColumns": [0,1,2,3,4,5,6,7]}
                            ]
                    },
                    "aoColumns": [
                        { "mDataProp": "dni" },
                        { "mDataProp": "username" },
                        { "mDataProp": "nombre" },
                        { "mDataProp": "apellido1" },
                        { "mDataProp": "tipo" },
                        { "mDataProp": "realizada", "sType": "date-euro" },
                        { "mDataProp": "inicio", "sType": "date-euro" },
                        { "mDataProp": "fin" , "sType": "date-euro" }
        ]
                } )

tablapermisos1 = $('#tablapermisos1').dataTable( {
                    "bJQueryUI": true,
                    "sDom": '<"H"Tfr>t<"F"ip>',
                    "sScrollY": "400px",
                    "bPaginate": false,
                    "bScrollCollapse": true,
                    "oTableTools": {
                        "sSwfPath": "../../bundles/miomio/js/media/swf/copy_csv_xls_pdf.swf",
                        "aButtons": [
                            { "sExtends": "copy","bFooter": false, "sButtonText": "Copiar","mColumns": [0,1,2,3]},
                            { "sExtends": "csv", "bFooter": false, "sButtonText": "Csv", "mColumns": [0,1,2,3]},
                            { "sExtends": "pdf", "bFooter": false, "sButtonText": "Pdf", "sPdfOrientation": "landscape", "sPdfMessage": "Vacaciones.", "mColumns": [0,1,2,3]}
                            ]
                    },
                    "aoColumns": [
                        { "mDataProp": "tipo" },
                        { "mDataProp": "realizada", "sType": "date-euro" },
                        { "mDataProp": "inicio", "sType": "date-euro" },
                        { "mDataProp": "fin" , "sType": "date-euro" }
        ]
                } )

            tabla1 = $('#tabla1').dataTable( {
                    "bJQueryUI": true,
                    "sScrollY": "310px",
                    "bPaginate": false,
                    "bScrollCollapse": true,
                    "aoColumns": [null,null,{ "sType": "formatted-num" },{ "bVisible": false },{ "sType": "formatted-num" },{ "sType": "formatted-num" },{ "sType": "formatted-num" },{ "bVisible": false },{ "sType": "formatted-num" },{ "bVisible": false },{ "bVisible": false },{ sWidth: '20%' }]
                } )
                tabla1.columnFilter({"bUseColVis": true,"aoColumns": [null,null,null,{sSelector: ".numeros1", type:"number-range" },null,null,null,{sSelector: ".numeros", type:"number-range" },null,{ sSelector: ".mostrarproductofamilia", type:"select" },{ sSelector: ".mostrarproductoproveedor", type:"select" },null]});

                tablalistaproveedores = $('#tablalistaproveedores').dataTable( {
                    "bJQueryUI": true,
                    "sDom": '<"H"Tfr>t<"F"ip>',
                    "sScrollY": "270px",
                    "bPaginate": false,
                    "bScrollCollapse": true,
                    "oTableTools": {
                        "aButtons": [
                            { "sExtends": "copy","bFooter": false, "sButtonText": "Copiar","mColumns": [0,1,2,3,4,5,6]},
                            { "sExtends": "csv", "bFooter": false, "sButtonText": "Csv", "mColumns": [0,1,2,3,4,5,6]},
                            { "sExtends": "pdf", "bFooter": false, "sButtonText": "Pdf", "sPdfOrientation": "landscape", "mColumns": [0,1,2,3,4,5,6]}
                            ]
                    },
                    "aoColumns": [
                        null,
                        null,
                        null,
                        null,
                        null,
                        null,
                        null,
                        { sWidth: '30%' }
                    ]
                } )

                tablalistaproveedorespedido = $('#tablalistaproveedorespedido').dataTable( {
                    "bJQueryUI": true,
                    "sDom": '<"H"Tfr>t<"F"ip>',
                    "sScrollY": "450px",
                    "bPaginate": false,
                    "bScrollCollapse": true,
                    "oTableTools": {
                        "aButtons": [
                            { "sExtends": "copy","bFooter": false, "sButtonText": "Copiar","mColumns": [0,1,2,3,4,5,6,7]},
                            { "sExtends": "csv", "bFooter": false, "sButtonText": "Csv", "mColumns": [0,1,2,3,4,5,6,7]},
                            { "sExtends": "pdf", "bFooter": false, "sButtonText": "Pdf", "sPdfOrientation": "landscape", "mColumns": [0,1,2,3,4,5,6,7]}
                            ]
                    },
                    "aoColumns": [
                        null,
                        null,
                        null,
                        null,
                        null,
                        null,
                        null,
                        null,
                        { sWidth: '30%' }
                    ]
                } )

                tablalistadevolucion = $('#tablalistadevolucion').dataTable( {
                    "bJQueryUI": true,
                    "sDom": '<"H"Tfr>t<"F"ip>',
                    "sScrollY": "250px",
                    "bPaginate": false,
                    "bScrollCollapse": true,
                    "oTableTools": {
                        "aButtons": [
                            { "sExtends": "copy","bFooter": false, "sButtonText": "Copiar","mColumns": [0,1,2,3,5,7,8,9]},
                            { "sExtends": "csv", "bFooter": false, "sButtonText": "Csv", "mColumns": [0,1,2,3,5,7,8,9]},
                            { "sExtends": "pdf", "bFooter": false, "sButtonText": "Pdf", "sPdfOrientation": "landscape", "mColumns": [0,1,2,3,5,7,8,9]}
                            ]
                    },
                    "aoColumns": [
                        null,
                        null,
                        null,
                        { "sType": "date-euro" },
                        { "bVisible": false },
                        { "sType": "formatted-num" },
                        { "bVisible": false },
                        null,
                        null,
                        null,
                        { sWidth: '20%' }
                    ]
                } )
tablalistadevolucion.columnFilter({"bUseColVis": true,"aoColumns": [null,null,null,null,{ sSelector: "#datepicker",type: "date-range" },null,{sSelector: ".numeros1", type:"number-range" },{ sSelector: ".mostrarempleado", type:"select" },{ sSelector: ".mostrarpago", type:"select" },null,null]});
                
                tablacliente = $('#tablacliente').dataTable( {
                    "bJQueryUI": true,
                    "sDom": '<"H"Tfr>t<"F"ip>',
                    "bPaginate": false,
                    "sScrollY": "270px",
                    "bScrollCollapse": true,
                    "oTableTools": {
                        "aButtons": [
                            { "sExtends": "copy","bFooter": false, "sButtonText": "Copiar","mColumns": [0, 1, 2, 3, 4 ,5 , 6, 7]},
                            { "sExtends": "csv", "bFooter": false, "sButtonText": "Csv", "mColumns": [0, 1, 2, 3, 4 ,5 , 6, 7]},
                            { "sExtends": "pdf", "bFooter": false, "sButtonText": "Pdf", "sPdfOrientation": "landscape", "mColumns": [0, 1, 2, 3, 4 ,5, 6, 7]}
                            ]
                    },
                    "aoColumns": [
                        null,
                        null,
                        null,
                        null,
                         {sWidth: '20%'},
                        null,
                        null,
                        null,
                        { sWidth: '25%'}
                    ]
                } )

                tablalistaproductos = $('#tablalistaproductos').dataTable( {
                    "bJQueryUI": true,
                    "sDom": '<"H"Tfr>t<"F"ip>',
                    "bPaginate": false,
                    "sScrollY": "300px",
                    "bScrollCollapse": true,
                    "oTableTools": {
                        "aButtons": [
                            { "sExtends": "copy","bFooter": false, "sButtonText": "Copiar","mColumns": [0,1,2,4,5,6,9]},
                            { "sExtends": "csv", "bFooter": false, "sButtonText": "Csv", "mColumns": [0,1,2,4,5,6,9]},
                            { "sExtends": "pdf", "bFooter": false, "sButtonText": "Pdf", "sPdfOrientation": "landscape", "mColumns": [0,1,2,4,5,6,9]}
                            ]
                    },
                    "aoColumns": [null,null,{ "sType": "formatted-num" },{ "bVisible": false },{ "sType": "formatted-num" },{ "sType": "formatted-num" },{ "sType": "formatted-num" },{ "sType": "formatted-num" },{ "bVisible": false },{ "sType": "formatted-num" },{ "bVisible": false },{ "bVisible": false },null]
                })

    tablalistaproductos.columnFilter({"bUseColVis": true,"aoColumns": [null,null,null,{sSelector: ".numeros1", type:"number-range" },null,null,null,null,{sSelector: ".numeros", type:"number-range" },null,{ sSelector: ".mostrarproductofamilia", type:"select" },{ sSelector: ".mostrarproductoproveedor", type:"select" },null]});
                
                tablaconsultaventausuario = $('#tablaconsultaventausuario').dataTable( {
                    "bJQueryUI": true,  
                    "sScrollY": "400px",
                    "bPaginate": false, 
                    "bScrollCollapse": true
                } )

        listapedido = $('#listapedido').dataTable( {
                    "bJQueryUI": true,  
                    "sDom": '<"H"Tfr>t<"F"ip>',
                    "sScrollY": "400px",
                    "bPaginate": false,
                    "bScrollCollapse": true,
                    "oTableTools": {
                        "aButtons": [
                            { "sExtends": "copy","bFooter": false, "sButtonText": "Copiar","mColumns": [0,1,2,3,4,5,6]},
                            { "sExtends": "csv", "bFooter": false, "sButtonText": "Csv", "mColumns": [0,1,2,3,4,5,6]},
                            { "sExtends": "pdf", "bFooter": false, "sButtonText": "Pdf", "sPdfOrientation": "landscape", "mColumns": [0,1,2,3,4,5,6]}
                            ]
                    },
                    "aoColumns": [
                        { sWidth: '5%' },
                        { sWidth: '15%' },
                        { sWidth: '15%' , "sType": "date-euro"},
                        { sWidth: '15%' , "sType": "date-euro"},
                        { sWidth: '5%' , "sType": "formatted-num" },
                        { sWidth: '10%' },
                        { sWidth: '10%' },
                        { sWidth: '25%' }
                    ]
                } )

        tablapedido = $('#tablapedido').dataTable( {
                    "bJQueryUI": true,  
                    "sScrollY": "300px",
                    "bPaginate": false,
                    "bScrollCollapse": true,
                    "aoColumns": [
                        null,
                        null,
                        null,
                        null,
                        null,
                        null,
                        null,
                        { sWidth: '20%' }
                    ]
                })
                
                tablalistaventa = $('#tablalistaventa').dataTable( {
                    "bJQueryUI": true,
                    "sDom": '<"H"Tfr>t<"F"ip>',
                    "sScrollY": "230px",
                    "bPaginate": false,
                    "bScrollCollapse": true,
                    "oTableTools": {
                        "aButtons": [
                            { "sExtends": "copy","bFooter": false, "sButtonText": "Copiar","mColumns": [0,1,2,3,5,7,8]},
                            { "sExtends": "csv", "bFooter": false, "sButtonText": "Csv", "mColumns": [0,1,2,3,5,7,8]},
                            { "sExtends": "pdf", "bFooter": false, "sButtonText": "Pdf", "sPdfOrientation": "landscape", "mColumns": [0,1,2,3,5,7,8]}
                            ]
                    },
                    "aoColumns": [
                        null,
                        null,
                        null,
                        { "sType": "date-euro" },
                        { "bVisible": false },
                        { "sType": "formatted-num" },
                        { "bVisible": false },
                        null,
                        null,
                        { sWidth: '38%' }
                    ]
                } )

tablalistaventa.columnFilter({"bUseColVis": true,"aoColumns": [null,null,null,null,{ sSelector: "#datepicker",type: "date-range" },null,{sSelector: ".numeros1", type:"number-range" },{ sSelector: ".mostrarempleado", type:"select" },{ sSelector: ".mostrarpago", type:"select" },null]});
                
                tablalistaoperacion = $('#tablalistaoperacion').dataTable( {
                    "bJQueryUI": true,
                    "sDom": '<"H"Tfr>t<"F"ip>',
                    "sScrollY": "230px",
                    "bPaginate": false,
                    "bScrollCollapse": true,
                    "oTableTools": {
                        "aButtons": [
                            { "sExtends": "copy","bFooter": false, "sButtonText": "Copiar","mColumns": [0,1,2,3,5,7,8,9]},
                            { "sExtends": "csv", "bFooter": false, "sButtonText": "Csv", "mColumns": [0,1,2,3,5,7,8,9]},
                            { "sExtends": "pdf", "bFooter": false, "sButtonText": "Pdf", "sPdfOrientation": "landscape", "mColumns": [0,1,2,3,5,7,8,9]}
                            ]
                    },
                    "aoColumns": [
                        null,
                        null,
                        null,
                        { "sType": "date-euro" },
                        { "bVisible": false },
                        { "sType": "formatted-num" },
                        { "bVisible": false },
                        null,
                        null,
                        null,
                      { sWidth: '28%' }
                    ]
                } )

tablalistaoperacion.columnFilter({"bUseColVis": true,"aoColumns": [null,null,null,null,{ sSelector: "#datepicker",type: "date-range" },null,{sSelector: ".numeros1", type:"number-range" },{ sSelector: ".mostrarempleado", type:"select" },{ sSelector: ".mostrarpago", type:"select" },{ sSelector: ".mostrartipo", type:"select" },null]});

                tablanewdevolucion = $('#tablanewdevolucion').dataTable( {
                    "bJQueryUI": true,
                    "sScrollY": "300px",
                    "bPaginate": false,
                    "bScrollCollapse": true,
                    "aoColumns": [null,null,null,{ "sType": "formatted-num" },null,null,null,null]
                } )
            
                listarreserva = $('#listarreserva').dataTable( {
                    "bJQueryUI": true,
                    "sDom": '<"H"Tfr>t<"F"ip>',
                    "sScrollY": "250px",
                    "bPaginate": false,
                    "bScrollCollapse": true,
                    "oTableTools": {
                        "aButtons": [
                            { "sExtends": "copy","bFooter": false, "sButtonText": "Copiar","mColumns": [0,1,2,3,5,7,8,9,10]},
                            { "sExtends": "csv", "bFooter": false, "sButtonText": "Csv", "mColumns": [0,1,2,3,5,7,8,9,10]},
                            { "sExtends": "pdf", "bFooter": false, "sButtonText": "Pdf", "sPdfOrientation": "landscape", "mColumns": [0,1,2,3,5,7,8,9,10]}
                            ]
                    },
                    "aoColumns": [null,null,null,{ "sType": "date-euro" },{ "bVisible": false },{ "sType": "formatted-num" },{ "bVisible": false },{ "sType": "formatted-num" },null,null,null,{ sWidth: '20%'}]
                } )

listarreserva.columnFilter({"bUseColVis": true,"aoColumns": [null,null,null,null,{ sSelector: "#datepicker",type: "date-range" },null,{sSelector: ".numeros1", type:"number-range" },null,{ sSelector: ".mostrarempleado", type:"select" },{ sSelector: ".mostrarpago", type:"select" },null,null]});

                listarapartado = $('#listarapartado').dataTable( {
                    "bJQueryUI": true,
                    "sDom": '<"H"Tfr>t<"F"ip>',
                    "sScrollY": "250px",
                    "bPaginate": false,
                    "bScrollCollapse": true,
                    "oTableTools": {
                        "aButtons": [
                            { "sExtends": "copy","bFooter": false, "sButtonText": "Copiar","mColumns": [0,1,2,3,5,7,8,9]},
                            { "sExtends": "csv", "bFooter": false, "sButtonText": "Csv", "mColumns": [0,1,2,3,5,7,8,9]},
                            { "sExtends": "pdf", "bFooter": false, "sButtonText": "Pdf", "sPdfOrientation": "landscape", "mColumns": [0,1,2,3,5,7,8,9]}
                            ]
                    },
                    "aoColumns": [
                        null,
                        null,
                        null,
                        { "sType": "date-euro" },
                        { "bVisible": false },
                        { "sType": "formatted-num" },
                        { "bVisible": false },
                        { "sType": "formatted-num" },
                        null,
                        null,
                        { sWidth: '25%'}
                    ]
                } )
                
listarapartado.columnFilter({"bUseColVis": true,"aoColumns": [null,null,null,null,{ sSelector: "#datepicker",type: "date-range" },null,{sSelector: ".numeros1", type:"number-range" },null,{ sSelector: ".mostrarempleado", type:"select" },{ sSelector: ".mostrarpago", type:"select" },null]});

                tabla5 = $('#tabla5').dataTable( {
                    "bJQueryUI": true,
                    "sDom": '<"H"Tfr>t<"F"ip>',
                    "sScrollY": "650px",
                    "bPaginate": false,
                    "bScrollCollapse": true,
                    "oTableTools": {
                        "sSwfPath": "../bundles/miomio/js/media/swf/copy_csv_xls_pdf.swf",
                        "aButtons": [
                            { "sExtends": "copy","bFooter": false, "sButtonText": "Copiar","mColumns": [0,1,2,3,4,5,6,7,8]},
                            { "sExtends": "csv", "bFooter": false, "sButtonText": "Csv", "mColumns": [0,1,2,3,4,5,6,7,8]},
                            { "sExtends": "pdf", "bFooter": false, "sButtonText": "Pdf", "sPdfOrientation": "landscape" ,"mColumns":[0,1,2,3,4,5,6,7,8]}
                            ]
                    }
                } )
        
  productosreserva = $('#ajaxreserva').dataTable( {
    "bProcessing": true,
    "bJQueryUI": true,
    "aoColumns": [
            { "mDataProp": "id" },
            { "mDataProp": "descripcion" },
            { "mDataProp": "cantidad", "sType": "formatted-num" },
            { "mDataProp": "pventa", "sType": "formatted-num" },
            { "mDataProp": "iva", "sType": "formatted-num" },
            { "mDataProp": "total", "sType": "formatted-num" }
        ]
  } )

  productosventa = $('#ajaxventa').dataTable( {
    "bProcessing": true,
    "bJQueryUI": true,
    "aoColumns": [
            { "mDataProp": "id" },
            { "mDataProp": "descripcion" },
            { "mDataProp": "cantidad", "sType": "formatted-num" },
            { "mDataProp": "pventa", "sType": "formatted-num" },
            { "mDataProp": "iva", "sType": "formatted-num" },
            { "mDataProp": "total", "sType": "formatted-num" }
        ]
  } )

  productosdevolucion = $('#listardevolucion').dataTable( {
    "bProcessing": true,
    "bJQueryUI": true,
    "aoColumns": [
            { "mDataProp": "id" },
            { "mDataProp": "descripcion" },
            { "mDataProp": "cantidad", "sType": "formatted-num" },
            { "mDataProp": "estado" },
            { "mDataProp": "pventa", "sType": "formatted-num" },
            { "mDataProp": "iva", "sType": "formatted-num" },
            { "mDataProp": "total", "sType": "formatted-num" }
        ]
  } )

ajaxproductos = $('.tablamostrarproductos').dataTable( {
    "bProcessing": true,
    "bJQueryUI": true,
    "sScrollY": "350px",
    "bPaginate": false,
    "bScrollCollapse": true,
    "aoColumns": [
            { "mDataProp": "id" },
            { "mDataProp": "descripcion" },
            { "mDataProp": "iva", "sType": "formatted-num" },
            { "mDataProp": "preciocompra", "sType": "formatted-num" },
            { "mDataProp": "precioventa", "sType": "formatted-num" },
            { "mDataProp": "stock", "sType": "formatted-num" },
            { "mDataProp": "apartado", "sType": "formatted-num" },
            { "mDataProp": "reservado", "sType": "formatted-num" }
        ]
  } )

ajaxproductosreservados = $('.tablamostrarproductosreservados').dataTable( {
    "bProcessing": true,
    "bJQueryUI": true,
    "sScrollY": "350px",
    "bPaginate": false,
    "bScrollCollapse": true,
         "fnRowCallback": function( nRow, aData, iDisplayIndex ) {
            var url = Routing.generate('usuario_show', { id: aData.clienteid });
            $('td:eq(1)', nRow).html("<a href=" + url + ">" + aData.cliente + "</a>");
            return nRow;
        },
    "aoColumns": [
            { "mDataProp": "id" },
            { "mDataProp": "cliente" },
            { "mDataProp": "clienteid", "bVisible": false},
            { "mDataProp": "reserva" },
            { "mDataProp": "descripcion" },
            { "mDataProp": "iva" },
            { "mDataProp": "preciocompra" },
            { "mDataProp": "precioventa" },
            { "mDataProp": "stock" },
            { "mDataProp": "apartado" },
            { "mDataProp": "reservado" }
        ]
  } )

  productospedido = $('#ajaxpedido').dataTable( {
    "bProcessing": true,
    "bJQueryUI": true,
    "aoColumns": [
            { "mDataProp": "id" },
            { "mDataProp": "descripcion" },
            { "mDataProp": "cantidad", "sType": "formatted-num" },
            { "mDataProp": "pcompra", "sType": "formatted-num" },
            { "mDataProp": "iva", "sType": "formatted-num" },
            { "mDataProp": "total", "sType": "formatted-num" }
        ]
  } )

  tablafamilia = $('#tablafamilia').dataTable( {
                    "bJQueryUI": true,
                    "sScrollY": "450px",
                    "bPaginate": false,
                    "bScrollCollapse": true,
                } )
                
                tabladevolucion = $('#tabladevolucion').dataTable( {
                    "bJQueryUI": true,
                    "bPaginate": false,
                    "aoColumns": [null,null,{ "sType": "formatted-num" },{ "sType": "formatted-num" },{ "sType": "formatted-num" },null,null]
                } )

                tablainformes = $('.tablainformes').dataTable( {
                    "bJQueryUI": true,
                    "sDom": '<"H"Tfr>t<"F"ip>',
                    "sScrollY": "450px",
                    "bPaginate": false,
                    "bScrollCollapse": true,
                    "oTableTools": {
                        "aButtons": [
                            { "sExtends": "copy","bFooter": false, "sButtonText": "Copiar","mColumns": [0,1,2,3,4,5,6]},
                            { "sExtends": "csv", "bFooter": false, "sButtonText": "Csv", "mColumns": [0,1,2,3,4,5,6]},
                            { "sExtends": "pdf", "bFooter": false, "sButtonText": "Pdf", "sPdfOrientation": "landscape" ,"mColumns":[0,1,2,3,4,5,6]}
                            ]
                    },
                    "aoColumns": [
                        null,
                        { "sType": "date-euro" },
                        null,
                        null,
                        { "sType": "date-euro" },
                        { "sType": "date-euro" },
                        null,
                        { sWidth: '15%'}
                    ]
                })

                tablaclientesinforme = $('#clientesinforme').dataTable( {
                    "bJQueryUI": true,  
                    "sScrollY": "300px",
                    "bPaginate": false
                })

                tablalistaarqueo = $('#tablalistaarqueo').dataTable( {
                    "bJQueryUI": true,  
                    "sScrollY": "300px",
                    "sDom": '<"H"Tfr>t<"F"ip>',
                    "bPaginate": false,
                    "bScrollCollapse": true,
                    "oTableTools": {
                        "sSwfPath": "../bundles/miomio/js/media/swf/copy_csv_xls_pdf.swf",
                        "aButtons": [
                            { "sExtends": "copy","bFooter": false, "sButtonText": "Copiar" },
                            { "sExtends": "csv", "bFooter": false, "sButtonText": "Csv"},
                            { "sExtends": "pdf", "bFooter": false, "sButtonText": "Pdf", "sPdfOrientation": "landscape"}
                            ]
                    },
                })
tablalistaarqueo.columnFilter({"bUseColVis": true, "aoColumns":[null,{ sSelector: "#datepicker1",type: "date-range" },null,null,null,null,null,null,null,{ sSelector: "#mostraremparqueo", type:"select"},{ sSelector: "#estadoarqueo", type:"select", bRegex:true, values:[{value:'^U',label:'Unconfirmed'},{value:'^C',label:'Confirmed'}] }]});
  });