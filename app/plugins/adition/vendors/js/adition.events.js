/*--------------------------------------------------------------------------------------------------- Adition EVENTS
 *
 *
 * Adition Events
 * el el script que capura los eventos de la pagina adition.php[ctp]
 */

// mensaje de confirmacion cuando se esta por salir de la pagina (evitar perdidas de datos no actualizados)
//window.onbeforeunload=confirmacionDeSalida;



/**
 *JQM 
 * renderizado de cosas que se cargan dinamicamente en javascript
 * en cada cambio de pagina, hacemos que se  vuelva a refrescar JQM 
 * para enriquecer los elementos nuevos
 *
 */

// enrquiqueecr con JQM el listado ed comandas de la mesa en msa-view
$('#mesa-view').live('pageshow',function(event, ui){  
  $('#comanda-detalle-collapsible').trigger('create');
});


// acomodar todos mozos al ancho ed la pantalla segun resolucion
$('#listado-mesas').live('pageshow',function(event, ui){
  var tot = $('.listado-mozos-para-mesas > li');
  var por = 100/tot.length;
  tot.removeClass('ui-block-a');
  tot.removeClass('ui-block-b');
  tot.css({'width':por+'%', padding: '0px', margin: '0px', 'float': 'left'});
});



$('#page-sabores').live('pageshow', function(){
    var closeIcon = $('#page-sabores a[data-icon="delete"]');
    closeIcon.bind('click',function(){
                Risto.Adition.adicionar.currentMesa().currentComanda().limpiarSabores();
                closeIcon.unbind('click');
            });
});




/**
 *
 *                  Eventos ONLOAD
 *
 *
 */ 
$(document).ready(function() {   
  
   hacerQueNoFuncioneElClickEnPagina();
    
    $(document).keydown(onKeyDown);
    $(document).keypress(onKeyPress);

    $(document).bind(MESA_ESTADOS_POSIBLES.seleccionada.event, mesaSeleccionada);

    // cambios de estado de la mesa
    $(document).bind(MESA_ESTADOS_POSIBLES.abierta.event, abrirMesa); //funcion vacia de jQuery
    $(document).bind(MESA_ESTADOS_POSIBLES.cerrada.event, mesaCerrada);
    $(document).bind(MESA_ESTADOS_POSIBLES.cuponPendiente.event, mesaCuponPendiente);
    $(document).bind(MESA_ESTADOS_POSIBLES.cobrada.event, mesaCobrada);
    $(document).bind(MESA_ESTADOS_POSIBLES.borrada.event, mesaBorrada);
    $(document).bind(MOZOS_POSIBLES_ESTADOS.agragaMesa.event, ponerMesaComoCurrent);
    
    
    
    //creacion de comandas
    // producto seleccionado
    $(document).bind(  MENU_ESTADOS_POSIBLES.productoSeleccionado.event , productoSeleccionado);
    
    
    
    
    // Eventos para abrir una mesa
    $('a[href="#mesa-add"]').bind('click', function(){
    });
    
    $('#add-mesa-paso1 LABEL, #add-mesa-paso3-volver').bind('click', function(){
       $('#add-mesa-paso1, #add-mesa-paso3').hide();$('#add-mesa-paso2').show(); 
       $('#add-mesa-paso2 input').focus();
    });
    
    $('#add-mesa-paso2-submit').bind('click', function(){
       $('#add-mesa-paso2, #add-mesa-paso1').hide();$('#add-mesa-paso3').show();
       $('#add-mesa-paso3 input').focus();
    });
    
    $('#add-mesa-paso3-submit, #add-mesa-paso2-volver').bind('click', function(){
       $('#add-mesa-paso3, #add-mesa-paso2').hide();$('#add-mesa-paso1').show();
    });
    
    
    $('#form-mesa-add').submit(agregarNuevaMesa);
    
    
    
    
    

    $(document).bind("adicionCambioMozo", cambioMozo);
    
    
    // para refrescar las mesas segun el mozo marcado
    $(document).bind('adicionMesasActualizadas', function(){
        /**
         *
         *  definicion del objeto que manejara las distintas respuestas dependiendo de la pagina activa
         *  Cada clave de este objeto es el ID de la page de JQM utilizada
         *  
         * */
        var onMesasActualizadasHandlerByPage = {
            'listado-mesas': function(){
                var btnMozo = $('.listado-mozos-para-mesas .ui-btn-active');
                var mozoId = 0;
                if ( btnMozo[0] ) {
                    mozoId = $(btnMozo[0]).attr('data-mozo-id');
                }
                mostrarMesasDeMozo(mozoId);
            },
            'mesa-view': function() {
                $('#comanda-detalle-collapsible').trigger('create');
            }
        }
        
        // llamar a la funcion correspondiente segun la pagina en la que estoy
        if ( $.mobile.activePage[0].id && onMesasActualizadasHandlerByPage.hasOwnProperty( $.mobile.activePage[0].id) ) {
            onMesasActualizadasHandlerByPage[$.mobile.activePage[0].id].call();
        }
        
    });
    
    
    
    // Form SUBMITS
    $('#form-cambiar-mozo').submit(cambiarMozo);
    $('#form-cambiar-numero').submit(cambiarNumeroMesa);
    
    
    
    $('#form-cliente-add').live('submit', function(e){
      var form = $('#form-cliente-add');
      var contenedorForm = form.parent();
       e.preventDefault();
       $.post(
           form.attr('action'), 
           form.serialize(),
           function(data){
               contenedorForm.html(data);
               contenedorForm.trigger('refresh');
           }
       );
       return false; 
    });
    
    
    
    // CLICKS
    $('A[href="#comanda-add-menu"]').click(function(){
        Risto.Adition.adicionar.nuevaComandaParaCurrentMesa();
    });
    
    $('#comanda-add-guardar').click(function(){
        Risto.Adition.adicionar.currentMesa().currentComanda().save();
    });
    
    $('A[href="#mesa-cobrar"]').live('click',function(){
        Risto.Adition.adicionar.pagos( [] );
    });
    
     $('#btn-comanda-opciones').click(function(){
         $('#comanda-opciones').toggle();
      });
      
      $('#mesa-menu').click(function(){
          Risto.Adition.adicionar.agregarMenu();
      });
      
      $('.cant_comensales').click(function(){
          Risto.Adition.adicionar.agregarCantCubiertos();
      });
    
    
    
    $('#mesa-cerrar').bind('click', function(){
        var mesa = Risto.Adition.adicionar.currentMesa();
        mesa.cambioDeEstadoAjax( MESA_ESTADOS_POSIBLES.cerrada );
    });
    
    $('.mesa-reimprimir').bind('click', function(){
        var mesa = Risto.Adition.adicionar.currentMesa();
        var url = mesa.urlReimprimirTicket();
        $.get(url);
    });
    
    
    $('#mesa-borrar').bind('click', function(){
        if (window.confirm('Seguro que desea borrar la mesa '+Risto.Adition.adicionar.currentMesa().numero())){
            var mesa = Risto.Adition.adicionar.currentMesa();
            mesa.cambioDeEstadoAjax( MESA_ESTADOS_POSIBLES.borrada );
        }
    });
    
    
    $('#mesa-reabrir').bind('click',function(){
        var mesa = Risto.Adition.adicionar.currentMesa();
        mesa.cambioDeEstadoAjax( MESA_ESTADOS_POSIBLES.reabierta );
    });
    
    
    $('#mesa-eliminar-cliente').live('click',function(){
        Risto.Adition.adicionar.currentMesa().setCliente( null );
        return true;
    });
    
    
    // al hacer click n un mozo del menu bar
    // se muestran solo lasmesas de ese mozo
    $('.listado-mozos-para-mesas a').bind('click',function(){
        var mId = undefined;
        mostrarMesasDeMozo( $(this).attr('data-mozo-id') );
        
    });
    
    
    // Al apretar el boton de cobro de pago procesa los pagos correspondientes
    $('#mesa-pagos-procesar').click(function(){
        // lipieza de pagos, selecciono solo los que se les haya agregado algun valor en el input
        for (var p in Risto.Adition.adicionar.pagos() ) {
            if ( Risto.Adition.adicionar.pagos()[p] ) {
                // agrego el pago a la mesa
                Risto.Adition.adicionar.currentMesa().Pago.push( Risto.Adition.adicionar.pagos()[p] );
            }
        }
        
        // reinicio los pagos
        Risto.Adition.adicionar.pagos([]);
        
        // cambio el estado de la mesa para disparar el evento
        Risto.Adition.adicionar.currentMesa().setEstadoCobrada();
    });
    
    
    $('#modo-k').live('change',function(){
        IMPRIME_REMITO_PRIMERO = !IMPRIME_REMITO_PRIMERO;
        $.get(urlDomain+'/configs/toggle_remito');
        
    });
    
    
    
    // Los botones que tengan la clase silent-click sirven para los dialogs
    // la idea es que al ser apretados el dialog se cierre, pero que se envie 
    // el href via ajax, Es util para las ocasiones en las que quiero mandar
    // una accion al servidor del cual no espero respuesta.
    $('[data-href]').live('click',function(e){
        var att = $(this).attr('data-href');
        if (att) {
            $.get( att );
        }
        $('.ui-dialog').dialog('close');
    });

    
    
    $('#contenedor-listado-clientes-factura-a input').live('keypress', function(){
                $('.factura-a-cliente-add').show();
     });
                 
});



function agregarNuevaMesa(e){
    e.preventDefault();
    
    var rta = $('#form-mesa-add').serializeArray();    
    var miniMesa = {};
    
    for (var r in rta ) {
        if (rta[r].name == 'numero' && !rta[r].value){
            alert("Debe completar numero de mesa");
            return false;
        }
        
        if (rta[r].name == 'cant_comensales' && !rta[r].value && Risto.Adition.cubiertosObligatorios){
            alert("Debe indicar la cantidad de cubiertos");
            return false;
        }
        miniMesa[rta[r].name] = rta[r].value;
    }
    
    var mesa = Risto.Adition.adicionar.crearNuevaMesa( miniMesa );
    mesaSeleccionada( {"mesa": mesa} );
    Risto.Adition.adicionar.setCurrentMesa( mesa );
    $.mobile.changePage('#mesa-view');
    document.getElementById('form-mesa-add').reset(); // limpio el formulario

    return false;
}


function mesaCerrada(e){
//    e.mesa.estado( MESA_ESTADOS_POSIBLES.cerrada );
//    $("#mesa-li-id-"+e.mesa.id()).attr('class', '');
//    $("#mesa-li-id-"+e.mesa.id()).addClass(e.mesa.estado().icon);   
}

function mesaCuponPendiente(){
    
}

function mesaBorrada(e){
    var mesa = e.mesa;
    e.mesa.mozo().sacarMesa(mesa);
}


// Procesar los pagos de la mesa
function mesaCobrada(e){
    // envio los datos al servidor
    var m = e.mesa;
    var mes = {
            Mesa: {
                id: m.id(),
                estado_id: m.estado_id(),
                time_cobro: m.time_cobro(),
                model: 'Mesa'
            },
            Pago: m.Pago()
        };
        
        // guardo los pagos
        $cakeSaver.send({
            url: urlDomain+'pagos/add',
            obj: mes
        }, function(d){
            
        });
        
        e.mesa.mozo().sacarMesa( e.mesa );
}



function cambioMozo(e){
}


function mesaSeleccionada(e){
    Risto.Adition.adicionar.setCurrentMesa(e.mesa);
}



function abrirMesa(e) {
    if (!e.mesa.id) {
        setTimeout(function(){abrirMesa(e)},1000);
    }
}



/**
 * Cuando estoy creando una comanda se selecciona un producto y 
 * este debe ser agregado al listado de productos de la currentMesa()
 */
function productoSeleccionado(e) {
    Risto.Adition.adicionar.currentMesa().agregarProducto(e.producto);
}


function ponerMesaComoCurrent(e) {
//    alert("meti esta mesa actual");
//    Risto.Adition.adicionar.setCurrentMesa( e.mesa );
//    $.mobile.changePage( "#mesa-view", { transition: "slideup"} );	
}



function confirmacionDeSalida(e) {
	if(!e) e = window.event;
	//e.cancelBubble is supported by IE - this will kill the bubbling process.
	e.cancelBubble = true;
	e.returnValue = 'Seguro que deseas salir de la aplicación?\n si no hay datos guardados, los mismos se perderán'; //This is displayed on the dialog

	//e.stopPropagation works in Firefox.
	if (e.stopPropagation) {
		e.stopPropagation();
		e.preventDefault();
	}
    }
    
    
  

function irMesaPrev() {
    var mesaContainer = $('#mesas_container');
    
    if ( Risto.Adition.mesaCurrentIndex !== null) {
        var aaa = Risto.Adition.mesaCurrentIndex.parent().prev().find('a');
        if ( aaa.length ) {
            Risto.Adition.mesaCurrentIndex = aaa;
        }
    } else {
        Risto.Adition.mesaCurrentIndex = mesaContainer.find('a').first();
    }
    Risto.Adition.mesaCurrentIndex.focus();
}

function irMesaNext() {
    var mesaContainer = $('#mesas_container');
    
    if ( Risto.Adition.mesaCurrentIndex !== null) {
        var aaa = Risto.Adition.mesaCurrentIndex.parent().next().find('a');
        if ( aaa.length ) {
            Risto.Adition.mesaCurrentIndex = aaa;
        }
    } else {
        Risto.Adition.mesaCurrentIndex = mesaContainer.find('a').first();
        Risto.Adition.mesaCurrentIndex.focus();
    }
    Risto.Adition.mesaCurrentIndex.focus();
}


function onKeyDown(e) {
    var code = e.which;
    
    // al apretar la tecla back, volver atras, menos cuando estoy en un INPUT o TEXTAREA
    if (code == 8 ) { // tecla backspace
        if (document.activeElement.tagName.toLowerCase() != 'input' && document.activeElement.tagName.toLowerCase() != 'textarea') {
            history.back();
        }
    }
    
    // mesa siguiente a la seleccionada (focus) del listado de mesas
    if (code == 39 ) { //btn flecha derecha
        irMesaNext();
    }
    
    // mesa anterior a la seleccionada del listado de mesas
    if (code == 37 ) { // boton flecha izq
        irMesaPrev();
    }
}

var oldTimeOut;
function onKeyPress(e) {
    var code = e.which;
    if ( code > 47){ // desde el numero 0 hasta la ultima letra con simbolos
        
        // buscar la mesa con ese numero, busca por accesskey
        Risto.Adition.mesaBuscarAccessKey += String.fromCharCode( code );
        var domFinded = $("[accesskey^='"+Risto.Adition.mesaBuscarAccessKey+"']");
        if ( domFinded.length ) {
            Risto.Adition.mesaCurrentIndex = $(domFinded[0]);
            domFinded[0].focus();
        }
        
        if(oldTimeOut){
            clearTimeout(oldTimeOut);
        }
        oldTimeOut = setTimeout(function(){
            Risto.Adition.mesaBuscarAccessKey = '';
        },1000);
    }
}



function cambiarMozo(e){    
    var mozoId = $(this).find('[name="mozo_id"]:checked').val();
    var mozo = Risto.Adition.adicionar.findMozoById(mozoId);
    var mozoAnterior = Risto.Adition.adicionar.currentMesa().mozo();
    Risto.Adition.adicionar.currentMesa().setMozo( mozo );
    
    $('.ui-dialog').dialog('close');
    
    var sendOb = {
        obj: {
            id: Risto.Adition.adicionar.currentMesa().id(),
            mozo_id: mozoId,
            model: 'Mesa',
            handleAjaxSuccess: function(){}
        },
        url: Risto.Adition.adicionar.currentMesa().urlEdit(),
        error: function(){
            Risto.Adition.adicionar.currentMesa().setMozo( mozoAnterior );
            alert("debido a un error en el servidor, el mozo no fue modificado");
        }
    }

    $cakeSaver.send(sendOb);
    
    return false;
}

function cambiarNumeroMesa(){
    var numeroMesa = $(this).find('[name="numero"]').val();
    var numAnt = Risto.Adition.adicionar.currentMesa().numero( numeroMesa );
    Risto.Adition.adicionar.currentMesa().numero( numeroMesa );
    $('.ui-dialog').dialog('close');
    
    var sendOb = {
        obj: {
            id: Risto.Adition.adicionar.currentMesa().id(),
            numero: numeroMesa,
            model: 'Mesa',
            handleAjaxSuccess: function(){}
        },
        url: Risto.Adition.adicionar.currentMesa().urlEdit(),
        error: function(){
            Risto.Adition.adicionar.currentMesa().numero( numAnt );
            alert("debido a un error en el servidor, el numero de mesa no fue modificado");
        }
    }
    $cakeSaver.send(sendOb);
    return false;
}



/**
 *  para que no titile el cursor. Que no se pueda hacer click
 */
function hacerQueNoFuncioneElClickEnPagina() {
   if(document.all){
      document.onselectstart = function(e) {return false;} // ie
   } else {
      document.onmousedown = function(e)
      {
         if(e.target.type!='text' && e.target.type!='button' && e.target.type!='textarea') return false;
         else return true;
      } // mozilla
   }
}