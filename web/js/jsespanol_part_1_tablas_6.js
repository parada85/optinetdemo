$(document).ready(function(){jQuery.extend(jQuery.fn.dataTableExt.oSort,{"formatted-num-pre":function(B){B=(B==="-")?0:B.replace(/[^\d\-\.]/g,"");return parseFloat(B)},"formatted-num-asc":function(C,B){return C-B},"formatted-num-desc":function(C,B){return B-C}});jQuery.extend(jQuery.fn.dataTableExt.oSort,{"date-euro-pre":function(D){if($.trim(D)!=""){var F=$.trim(D).split(" ");var C=F[1].split(":");var E=F[0].split("/");var B=(E[2]+E[1]+E[0]+C[0]+C[1]+C[2])*1}else{var B=10000000000000}return B},"date-euro-asc":function(C,B){return C-B},"date-euro-desc":function(C,B){return B-C}});TableTools.DEFAULTS.sSwfPath="bundles/miomio/js/media/swf/copy_csv_xls_pdf.swf";var A={sProcessing:"Procesando...",sLengthMenu:"Mostrar _MENU_ registros",sZeroRecords:"No se encontraron resultados",sInfo:"Mostrando desde _START_ hasta _END_ de _TOTAL_ registros",sInfoEmpty:"No existen registros",sInfoFiltered:"(filtrado de un total de _MAX_ líneas)",sInfoPostFix:"",sSearch:"Buscar:",sUrl:"",oPaginate:{sFirst:"Primero",sPrevious:"Anterior",sNext:"Siguiente",sLast:"Último"}};$.fn.dataTableExt.oApi.fnReloadAjax=function(G,E,H,D){if(typeof E!="undefined"&&E!=null){G.sAjaxSource=E}this.oApi._fnProcessingDisplay(G,true);var F=this;var B=G._iDisplayStart;var C=[];this.oApi._fnServerParams(G,C);G.fnServerData(G.sAjaxSource,C,function(K){F.oApi._fnClearTable(G);var I=(G.sAjaxDataProp!=="")?F.oApi._fnGetObjectDataFn(G.sAjaxDataProp)(K):K;for(var J=0;J<I.length;J++){F.oApi._fnAddData(G,I[J])}G.aiDisplay=G.aiDisplayMaster.slice();F.fnDraw();if(typeof D!="undefined"&&D===true){G._iDisplayStart=B;F.fnDraw(false)}F.oApi._fnProcessingDisplay(G,false);if(typeof H=="function"&&H!=null){H(G)}},G)};tablalistar=$(".listar").dataTable({bJQueryUI:true,sScrollY:"288px",bScrollCollapse:true,bPaginate:false,aoColumns:[{sWidth:"70px"},{sWidth:"200px"},{sWidth:"130px"},{sWidth:"130px"},{sWidth:"100px"},{sWidth:"100px"},{sWidth:"160px"},{sWidth:"160px"}],oLanguage:A});tablalog=$("#tablalog").dataTable({bJQueryUI:true,sDom:'<"H"Tfr>t<"F"ip>',sScrollY:"350px",bScrollCollapse:true,bPaginate:false,aoColumns:[{sType:"date-euro"},null,null,{bVisible:false},null],oTableTools:{sSwfPath:"../bundles/miomio/js/media/swf/copy_csv_xls_pdf.swf",aButtons:[{sExtends:"copy",bFooter:false,sButtonText:"Copiar",mColumns:"visible"},{sExtends:"csv",bFooter:false,sButtonText:"Csv",mColumns:"visible"},{sExtends:"pdf",bFooter:false,sButtonText:"Pdf",sPdfOrientation:"landscape",mColumns:"visible"}]},oLanguage:A});tablalog.columnFilter({bUseColVis:true,aoColumns:[null,{sSelector:"#mostrarempconexion",type:"select"},null,{sSelector:"#datepicker",type:"date-range"},{sSelector:"#mostrarconexion",type:"select"}]});tablacambios=$("#tablacambios").dataTable({bJQueryUI:true,sScrollY:"350px",sDom:'<"H"Tfr>t<"F"ip>',bPaginate:false,bScrollCollapse:true,oTableTools:{sSwfPath:"../bundles/miomio/js/media/swf/copy_csv_xls_pdf.swf",aButtons:[{sExtends:"copy",bFooter:false,sButtonText:"Copiar",mColumns:[1,2,3,4,5]},{sExtends:"csv",bFooter:false,sButtonText:"Csv",mColumns:[1,2,3,4,5]},{sExtends:"pdf",bFooter:false,sButtonText:"Pdf",mColumns:[1,2,3,4,5]}]},aoColumns:[{bVisible:false},{sType:"date-euro"},null,null,null,null,null],oLanguage:A});tablacambios.columnFilter({bUseColVis:true,aoColumns:[null,{sSelector:"#datepicker",type:"date-range"},{sSelector:"#cempleado",type:"select"},{sSelector:"#cempleado1",type:"select"},{sSelector:"#cempleado2",type:"select"},null,null]});tabla2=$("#tabla2").dataTable({bJQueryUI:true,bPaginate:true,aoColumns:[{sType:"formatted-num"},{sWidth:"30%"},{sType:"formatted-num"},{sType:"formatted-num"},{sType:"formatted-num"},{sWidth:"30%"}],oLanguage:A});tabla3=$("#tabla3").dataTable({bJQueryUI:true,sScrollY:"310px",bPaginate:false,bScrollCollapse:true,aoColumns:[null,null,{sType:"formatted-num"},{bVisible:false},{sType:"formatted-num"},{sType:"formatted-num"},{sType:"formatted-num"},{bVisible:false},{sType:"formatted-num"},{bVisible:false},{bVisible:false},{sWidth:"15%"}],oLanguage:A});tabla3.columnFilter({bUseColVis:true,aoColumns:[null,null,null,{sSelector:".numeros",type:"number-range"},null,null,null,{sSelector:".numeros1",type:"number-range"},null,{sSelector:".mostrarproductofamilia",type:"select"},{sSelector:".mostrarproductoproveedor",type:"select"},null]});tabla4=$("#tabla4").dataTable({aoColumns:[{sWidth:"5%",sType:"formatted-num"},{sWidth:"25%"},{sWidth:"15%",sType:"formatted-num"},{sWidth:"10%",sType:"formatted-num"},{sWidth:"10%",sType:"formatted-num"},{sWidth:"40%"}],bJQueryUI:true,oLanguage:A});tablaseleccion=$("#tablaseleccion").dataTable({bJQueryUI:true,sScrollY:"350px",bPaginate:false,bScrollCollapse:true,oLanguage:A});tablacitas=$("#tablacitas").dataTable({bJQueryUI:true,sDom:'<"H"Tfr>t<"F"ip>',sScrollY:"400px",bPaginate:false,sAjaxSource:Routing.generate("listarcitas"),bScrollCollapse:true,oLanguage:A,oTableTools:{aButtons:[{sExtends:"copy",bFooter:false,sButtonText:"Copiar",mColumns:[0,1,2,3,4,5,6,7]},{sExtends:"csv",bFooter:false,sButtonText:"Csv",mColumns:[0,1,2,3,4,5,6,7]},{sExtends:"pdf",bFooter:false,sButtonText:"Pdf",sPdfOrientation:"landscape",mColumns:[0,1,2,3,4,5,6,7]}]},aoColumns:[{mDataProp:"dni"},{mDataProp:"nombre"},{mDataProp:"apellido1"},{mDataProp:"apellido2"},{mDataProp:"realizada"},{mDataProp:"medico"},{mDataProp:"fecha",sType:"date-euro"},{mDataProp:"fecha cita",sType:"date-euro"}]});tablafestivos=$("#tablafestivos").dataTable({bJQueryUI:true,sDom:'<"H"Tfr>t<"F"ip>',sScrollY:"400px",bPaginate:false,sAjaxSource:Routing.generate("listarfestivos"),bScrollCollapse:true,oLanguage:A,oTableTools:{sSwfPath:"../bundles/miomio/js/media/swf/copy_csv_xls_pdf.swf",aButtons:[{sExtends:"copy",bFooter:false,sButtonText:"Copiar"},{sExtends:"csv",bFooter:false,sButtonText:"Csv"},{sExtends:"pdf",bFooter:false,sButtonText:"Pdf"}]},aoColumns:[{mDataProp:"fecha",sType:"date"}]});tablapermisos=$("#tablapermisos").dataTable({bJQueryUI:true,sDom:'<"H"Tfr>t<"F"ip>',sScrollY:"400px",bPaginate:false,sAjaxSource:Routing.generate("listarpermisos",{id:0}),bScrollCollapse:true,oLanguage:A,oTableTools:{sSwfPath:"../bundles/miomio/js/media/swf/copy_csv_xls_pdf.swf",aButtons:[{sExtends:"copy",bFooter:false,sButtonText:"Copiar",mColumns:[0,1,2,3,4,5,6,7]},{sExtends:"csv",bFooter:false,sButtonText:"Csv",mColumns:[0,1,2,3,4,5,6,7]},{sExtends:"pdf",bFooter:false,sButtonText:"Pdf",sPdfOrientation:"landscape",mColumns:[0,1,2,3,4,5,6,7]}]},aoColumns:[{mDataProp:"dni"},{mDataProp:"username"},{mDataProp:"nombre"},{mDataProp:"apellido1"},{mDataProp:"tipo"},{mDataProp:"realizada",sType:"date-euro"},{mDataProp:"inicio",sType:"date-euro"},{mDataProp:"fin",sType:"date-euro"}]});tablapermisos1=$("#tablapermisos1").dataTable({bJQueryUI:true,sDom:'<"H"Tfr>t<"F"ip>',sScrollY:"400px",bPaginate:false,bScrollCollapse:true,oLanguage:A,oTableTools:{sSwfPath:"../../bundles/miomio/js/media/swf/copy_csv_xls_pdf.swf",aButtons:[{sExtends:"copy",bFooter:false,sButtonText:"Copiar",mColumns:[0,1,2,3]},{sExtends:"csv",bFooter:false,sButtonText:"Csv",mColumns:[0,1,2,3]},{sExtends:"pdf",bFooter:false,sButtonText:"Pdf",sPdfOrientation:"landscape",sPdfMessage:"Vacaciones.",mColumns:[0,1,2,3]}]},aoColumns:[{mDataProp:"tipo"},{mDataProp:"realizada",sType:"date-euro"},{mDataProp:"inicio",sType:"date-euro"},{mDataProp:"fin",sType:"date-euro"}]});tabla1=$("#tabla1").dataTable({bJQueryUI:true,sScrollY:"310px",bPaginate:false,bScrollCollapse:true,aoColumns:[null,null,{sType:"formatted-num"},{bVisible:false},{sType:"formatted-num"},{sType:"formatted-num"},{sType:"formatted-num"},{bVisible:false},{sType:"formatted-num"},{bVisible:false},{bVisible:false},{sWidth:"20%"}],oLanguage:A});tabla1.columnFilter({bUseColVis:true,aoColumns:[null,null,null,{sSelector:".numeros1",type:"number-range"},null,null,null,{sSelector:".numeros",type:"number-range"},null,{sSelector:".mostrarproductofamilia",type:"select"},{sSelector:".mostrarproductoproveedor",type:"select"},null]});tablalistaproveedores=$("#tablalistaproveedores").dataTable({bJQueryUI:true,sDom:'<"H"Tfr>t<"F"ip>',sScrollY:"450px",bPaginate:false,bScrollCollapse:true,oLanguage:A,oTableTools:{aButtons:[{sExtends:"copy",bFooter:false,sButtonText:"Copiar",mColumns:[0,1,2,3,4,5,6]},{sExtends:"csv",bFooter:false,sButtonText:"Csv",mColumns:[0,1,2,3,4,5,6]},{sExtends:"pdf",bFooter:false,sButtonText:"Pdf",sPdfOrientation:"landscape",mColumns:[0,1,2,3,4,5,6]}]},aoColumns:[null,null,null,null,null,null,null,{sWidth:"30%"}]});tablalistaproveedorespedido=$("#tablalistaproveedorespedido").dataTable({bJQueryUI:true,sDom:'<"H"Tfr>t<"F"ip>',sScrollY:"450px",bPaginate:false,bScrollCollapse:true,oLanguage:A,oTableTools:{aButtons:[{sExtends:"copy",bFooter:false,sButtonText:"Copiar",mColumns:[0,1,2,3,4,5,6,7]},{sExtends:"csv",bFooter:false,sButtonText:"Csv",mColumns:[0,1,2,3,4,5,6,7]},{sExtends:"pdf",bFooter:false,sButtonText:"Pdf",sPdfOrientation:"landscape",mColumns:[0,1,2,3,4,5,6,7]}]},aoColumns:[null,null,null,null,null,null,null,null,{sWidth:"30%"}]});tablalistadevolucion=$("#tablalistadevolucion").dataTable({bJQueryUI:true,sDom:'<"H"Tfr>t<"F"ip>',sScrollY:"250px",bPaginate:false,bScrollCollapse:true,oLanguage:A,oTableTools:{aButtons:[{sExtends:"copy",bFooter:false,sButtonText:"Copiar",mColumns:[0,1,2,3,5,7,8,9]},{sExtends:"csv",bFooter:false,sButtonText:"Csv",mColumns:[0,1,2,3,5,7,8,9]},{sExtends:"pdf",bFooter:false,sButtonText:"Pdf",sPdfOrientation:"landscape",mColumns:[0,1,2,3,5,7,8,9]}]},aoColumns:[null,null,null,{sType:"date-euro"},{bVisible:false},{sType:"formatted-num"},{bVisible:false},null,null,null,{sWidth:"20%"}]});tablalistadevolucion.columnFilter({bUseColVis:true,aoColumns:[null,null,null,null,{sSelector:"#datepicker",type:"date-range"},null,{sSelector:".numeros1",type:"number-range"},{sSelector:".mostrarempleado",type:"select"},{sSelector:".mostrarpago",type:"select"},null,null]});tablacliente=$("#tablacliente").dataTable({bJQueryUI:true,sDom:'<"H"Tfr>t<"F"ip>',bPaginate:false,sScrollY:"300px",bScrollCollapse:true,oTableTools:{aButtons:[{sExtends:"copy",bFooter:false,sButtonText:"Copiar",mColumns:[0,1,2,3,4,5,6,7]},{sExtends:"csv",bFooter:false,sButtonText:"Csv",mColumns:[0,1,2,3,4,5,6,7]},{sExtends:"pdf",bFooter:false,sButtonText:"Pdf",sPdfOrientation:"landscape",mColumns:[0,1,2,3,4,5,6,7]}]},aoColumns:[null,null,null,null,{sWidth:"20%"},null,null,null,{sWidth:"25%"}],oLanguage:A});tablalistaproductos=$("#tablalistaproductos").dataTable({bJQueryUI:true,sDom:'<"H"Tfr>t<"F"ip>',bPaginate:false,sScrollY:"300px",bScrollCollapse:true,oTableTools:{aButtons:[{sExtends:"copy",bFooter:false,sButtonText:"Copiar",mColumns:[0,1,2,4,5,6,9]},{sExtends:"csv",bFooter:false,sButtonText:"Csv",mColumns:[0,1,2,4,5,6,9]},{sExtends:"pdf",bFooter:false,sButtonText:"Pdf",sPdfOrientation:"landscape",mColumns:[0,1,2,4,5,6,9]}]},aoColumns:[null,null,{sType:"formatted-num"},{bVisible:false},{sType:"formatted-num"},{sType:"formatted-num"},{sType:"formatted-num"},{sType:"formatted-num"},{bVisible:false},{sType:"formatted-num"},{bVisible:false},{bVisible:false},null],oLanguage:A});tablalistaproductos.columnFilter({bUseColVis:true,aoColumns:[null,null,null,{sSelector:".numeros1",type:"number-range"},null,null,null,null,{sSelector:".numeros",type:"number-range"},null,{sSelector:".mostrarproductofamilia",type:"select"},{sSelector:".mostrarproductoproveedor",type:"select"},null]});tablaconsultaventausuario=$("#tablaconsultaventausuario").dataTable({bJQueryUI:true,sScrollY:"400px",bPaginate:false,bScrollCollapse:true,oLanguage:A});listapedido=$("#listapedido").dataTable({bJQueryUI:true,sDom:'<"H"Tfr>t<"F"ip>',sScrollY:"400px",bPaginate:false,bScrollCollapse:true,oTableTools:{aButtons:[{sExtends:"copy",bFooter:false,sButtonText:"Copiar",mColumns:[0,1,2,3,4,5,6]},{sExtends:"csv",bFooter:false,sButtonText:"Csv",mColumns:[0,1,2,3,4,5,6]},{sExtends:"pdf",bFooter:false,sButtonText:"Pdf",sPdfOrientation:"landscape",mColumns:[0,1,2,3,4,5,6]}]},aoColumns:[{sWidth:"5%"},{sWidth:"15%"},{sWidth:"15%",sType:"date-euro"},{sWidth:"15%",sType:"date-euro"},{sWidth:"5%",sType:"formatted-num"},{sWidth:"10%"},{sWidth:"10%"},{sWidth:"25%"}],oLanguage:A});tablapedido=$("#tablapedido").dataTable({bJQueryUI:true,sScrollY:"300px",bPaginate:false,bScrollCollapse:true,aoColumns:[null,null,null,null,null,null,null,{sWidth:"20%"}],oLanguage:A});tablalistaventa=$("#tablalistaventa").dataTable({bJQueryUI:true,sDom:'<"H"Tfr>t<"F"ip>',sScrollY:"250px",bPaginate:false,bScrollCollapse:true,oTableTools:{aButtons:[{sExtends:"copy",bFooter:false,sButtonText:"Copiar",mColumns:[0,1,2,3,5,7,8]},{sExtends:"csv",bFooter:false,sButtonText:"Csv",mColumns:[0,1,2,3,5,7,8]},{sExtends:"pdf",bFooter:false,sButtonText:"Pdf",sPdfOrientation:"landscape",mColumns:[0,1,2,3,5,7,8]}]},aoColumns:[null,null,null,{sType:"date-euro"},{bVisible:false},{sType:"formatted-num"},{bVisible:false},null,null,{sWidth:"38%"}],oLanguage:A});tablalistaventa.columnFilter({bUseColVis:true,aoColumns:[null,null,null,null,{sSelector:"#datepicker",type:"date-range"},null,{sSelector:".numeros1",type:"number-range"},{sSelector:".mostrarempleado",type:"select"},{sSelector:".mostrarpago",type:"select"},null]});tablalistaoperacion=$("#tablalistaoperacion").dataTable({bJQueryUI:true,sDom:'<"H"Tfr>t<"F"ip>',sScrollY:"250px",bPaginate:false,bScrollCollapse:true,oTableTools:{aButtons:[{sExtends:"copy",bFooter:false,sButtonText:"Copiar",mColumns:[0,1,2,3,5,7,8,9]},{sExtends:"csv",bFooter:false,sButtonText:"Csv",mColumns:[0,1,2,3,5,7,8,9]},{sExtends:"pdf",bFooter:false,sButtonText:"Pdf",sPdfOrientation:"landscape",mColumns:[0,1,2,3,5,7,8,9]}]},aoColumns:[null,null,null,{sType:"date-euro"},{bVisible:false},{sType:"formatted-num"},{bVisible:false},null,null,null,{sWidth:"28%"}],oLanguage:A});tablalistaoperacion.columnFilter({bUseColVis:true,aoColumns:[null,null,null,null,{sSelector:"#datepicker",type:"date-range"},null,{sSelector:".numeros1",type:"number-range"},{sSelector:".mostrarempleado",type:"select"},{sSelector:".mostrarpago",type:"select"},{sSelector:".mostrartipo",type:"select"},null]});tablanewdevolucion=$("#tablanewdevolucion").dataTable({bJQueryUI:true,sScrollY:"300px",bPaginate:false,bScrollCollapse:true,aoColumns:[null,null,null,{sType:"formatted-num"},null,null,null,null],oLanguage:A});listarreserva=$("#listarreserva").dataTable({bJQueryUI:true,sDom:'<"H"Tfr>t<"F"ip>',sScrollY:"250px",bPaginate:false,bScrollCollapse:true,oTableTools:{aButtons:[{sExtends:"copy",bFooter:false,sButtonText:"Copiar",mColumns:[0,1,2,3,5,7,8,9,10]},{sExtends:"csv",bFooter:false,sButtonText:"Csv",mColumns:[0,1,2,3,5,7,8,9,10]},{sExtends:"pdf",bFooter:false,sButtonText:"Pdf",sPdfOrientation:"landscape",mColumns:[0,1,2,3,5,7,8,9,10]}]},aoColumns:[null,null,null,{sType:"date-euro"},{bVisible:false},{sType:"formatted-num"},{bVisible:false},{sType:"formatted-num"},null,null,null,{sWidth:"25%"}],oLanguage:A});listarreserva.columnFilter({bUseColVis:true,aoColumns:[null,null,null,null,{sSelector:"#datepicker",type:"date-range"},null,{sSelector:".numeros1",type:"number-range"},null,{sSelector:".mostrarempleado",type:"select"},{sSelector:".mostrarpago",type:"select"},null,null]});listarapartado=$("#listarapartado").dataTable({bJQueryUI:true,sDom:'<"H"Tfr>t<"F"ip>',sScrollY:"250px",bPaginate:false,bScrollCollapse:true,oTableTools:{aButtons:[{sExtends:"copy",bFooter:false,sButtonText:"Copiar",mColumns:[0,1,2,3,5,7,8,9]},{sExtends:"csv",bFooter:false,sButtonText:"Csv",mColumns:[0,1,2,3,5,7,8,9]},{sExtends:"pdf",bFooter:false,sButtonText:"Pdf",sPdfOrientation:"landscape",mColumns:[0,1,2,3,5,7,8,9]}]},aoColumns:[null,null,null,{sType:"date-euro"},{bVisible:false},{sType:"formatted-num"},{bVisible:false},{sType:"formatted-num"},null,null,{sWidth:"25%"}],oLanguage:A});listarapartado.columnFilter({bUseColVis:true,aoColumns:[null,null,null,null,{sSelector:"#datepicker",type:"date-range"},null,{sSelector:".numeros1",type:"number-range"},null,{sSelector:".mostrarempleado",type:"select"},{sSelector:".mostrarpago",type:"select"},null]});tabla5=$("#tabla5").dataTable({bJQueryUI:true,sDom:'<"H"Tfr>t<"F"ip>',sScrollY:"650px",bPaginate:false,bScrollCollapse:true,oTableTools:{sSwfPath:"../bundles/miomio/js/media/swf/copy_csv_xls_pdf.swf",aButtons:[{sExtends:"copy",bFooter:false,sButtonText:"Copiar",mColumns:[0,1,2,3,4,5,6,7,8]},{sExtends:"csv",bFooter:false,sButtonText:"Csv",mColumns:[0,1,2,3,4,5,6,7,8]},{sExtends:"pdf",bFooter:false,sButtonText:"Pdf",sPdfOrientation:"landscape",mColumns:[0,1,2,3,4,5,6,7,8]}]},oLanguage:A});productosreserva=$("#ajaxreserva").dataTable({bProcessing:true,bJQueryUI:true,oLanguage:A,aoColumns:[{mDataProp:"id"},{mDataProp:"descripcion"},{mDataProp:"cantidad",sType:"formatted-num"},{mDataProp:"pventa",sType:"formatted-num"},{mDataProp:"iva",sType:"formatted-num"},{mDataProp:"total",sType:"formatted-num"}]});productosventa=$("#ajaxventa").dataTable({bProcessing:true,bJQueryUI:true,oLanguage:A,aoColumns:[{mDataProp:"id"},{mDataProp:"descripcion"},{mDataProp:"cantidad",sType:"formatted-num"},{mDataProp:"pventa",sType:"formatted-num"},{mDataProp:"iva",sType:"formatted-num"},{mDataProp:"total",sType:"formatted-num"}]});productosdevolucion=$("#listardevolucion").dataTable({bProcessing:true,bJQueryUI:true,oLanguage:A,aoColumns:[{mDataProp:"id"},{mDataProp:"descripcion"},{mDataProp:"cantidad",sType:"formatted-num"},{mDataProp:"estado"},{mDataProp:"pventa",sType:"formatted-num"},{mDataProp:"iva",sType:"formatted-num"},{mDataProp:"total",sType:"formatted-num"}]});ajaxproductos=$(".tablamostrarproductos").dataTable({bProcessing:true,bJQueryUI:true,oLanguage:A,sScrollY:"350px",bPaginate:false,bScrollCollapse:true,aoColumns:[{mDataProp:"id"},{mDataProp:"descripcion"},{mDataProp:"iva",sType:"formatted-num"},{mDataProp:"preciocompra",sType:"formatted-num"},{mDataProp:"precioventa",sType:"formatted-num"},{mDataProp:"stock",sType:"formatted-num"},{mDataProp:"apartado",sType:"formatted-num"},{mDataProp:"reservado",sType:"formatted-num"}]});ajaxproductosreservados=$(".tablamostrarproductosreservados").dataTable({bProcessing:true,bJQueryUI:true,oLanguage:A,sScrollY:"350px",bPaginate:false,bScrollCollapse:true,fnRowCallback:function(E,D,C){var B=Routing.generate("usuario_show",{id:D.clienteid});$("td:eq(1)",E).html("<a href="+B+">"+D.cliente+"</a>");return E},aoColumns:[{mDataProp:"id"},{mDataProp:"cliente"},{mDataProp:"clienteid",bVisible:false},{mDataProp:"reserva"},{mDataProp:"descripcion"},{mDataProp:"iva"},{mDataProp:"preciocompra"},{mDataProp:"precioventa"},{mDataProp:"stock"},{mDataProp:"apartado"},{mDataProp:"reservado"}]});productospedido=$("#ajaxpedido").dataTable({bProcessing:true,bJQueryUI:true,oLanguage:A,aoColumns:[{mDataProp:"id"},{mDataProp:"descripcion"},{mDataProp:"cantidad",sType:"formatted-num"},{mDataProp:"pcompra",sType:"formatted-num"},{mDataProp:"iva",sType:"formatted-num"},{mDataProp:"total",sType:"formatted-num"}]});tablafamilia=$("#tablafamilia").dataTable({bJQueryUI:true,sScrollY:"450px",bPaginate:false,bScrollCollapse:true,oLanguage:A});tabladevolucion=$("#tabladevolucion").dataTable({bJQueryUI:true,bPaginate:false,aoColumns:[null,null,{sType:"formatted-num"},{sType:"formatted-num"},{sType:"formatted-num"},null,null],oLanguage:A});tablainformes=$(".tablainformes").dataTable({bJQueryUI:true,sDom:'<"H"Tfr>t<"F"ip>',sScrollY:"450px",bPaginate:false,bScrollCollapse:true,oTableTools:{aButtons:[{sExtends:"copy",bFooter:false,sButtonText:"Copiar",mColumns:[0,1,2,3,4,5,6]},{sExtends:"csv",bFooter:false,sButtonText:"Csv",mColumns:[0,1,2,3,4,5,6]},{sExtends:"pdf",bFooter:false,sButtonText:"Pdf",sPdfOrientation:"landscape",mColumns:[0,1,2,3,4,5,6]}]},aoColumns:[null,{sType:"date-euro"},null,null,{sType:"date-euro"},{sType:"date-euro"},null,{sWidth:"15%"}],oLanguage:A});tablaclientesinforme=$("#clientesinforme").dataTable({bJQueryUI:true,sScrollY:"300px",bPaginate:false,oLanguage:A});tablalistaarqueo=$("#tablalistaarqueo").dataTable({bJQueryUI:true,sDom:'<"H"Tfr>t<"F"ip>',sScrollY:"300px",bPaginate:false,bScrollCollapse:true,oTableTools:{sSwfPath:"../bundles/miomio/js/media/swf/copy_csv_xls_pdf.swf",aButtons:[{sExtends:"copy",bFooter:false,sButtonText:"Copiar"},{sExtends:"csv",bFooter:false,sButtonText:"Csv"},{sExtends:"pdf",bFooter:false,sButtonText:"Pdf",sPdfOrientation:"landscape"}]},oLanguage:A});tablalistaarqueo.columnFilter({bUseColVis:true,aoColumns:[null,{sSelector:"#datepicker1",type:"date-range"},null,null,null,null,null,null,null,{sSelector:"#mostraremparqueo",type:"select"},{sSelector:"#estadoarqueo",type:"select",bRegex:true,values:[{value:"^N",label:"No Confirmado"},{value:"^C",label:"Confirmado"}]}]})});