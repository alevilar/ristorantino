

// mensaje de confirmacion cuando se esta por salir de la pagina (evitar perdidas de datos no actualizados)
window.onbeforeunload=confirmacionDeSalida;



/**
 *JQM 
 * renderizado de cosas que se cargan dinamicamente en javascript
 * en cada cambio de pagina, hacemos que se  vuelva a refrescar JQM 
 * para enriquecer los elementos nuevos
 *
 */
$('#mesa-view').live('pagebeforeshow',function(event, ui){
  var el = $('#comanda-detalle-collapsible');
  el.find('div[data-role=collapsible]').collapsible();      
  $('.comandas-items').listview();
});
 


/**
 *
 *                  Eventos ONLOAD
 *
 *
 */ 
$(document).ready(function() {

    $(document).bind("mesaSeleccionada", mesaSeleccionada);

    // cambios de estado de la mesa
    $(document).bind("mesaAbierta", abrirMesa); //funcion vacia de jQuery
    $(document).bind("mesaCerrada", mesaCerrada);
    $(document).bind("mesaCuponPendiente", mesaCuponPendiente);
    $(document).bind("mesaCobrada", mesaCobrada);
    $(document).bind("mesaBorrada", mesaBorrada);
    $(document).bind(MOZOS_POSIBLES_ESTADOS.agragaMesa.event, ponerMesaComoCurrent);
    
    
    
    //creacion de comandas
    // producto seleccionado
    $(document).bind(  MENU_ESTADOS_POSIBLES.productoSeleccionado.event , productoSeleccionado);
    
    

    $(document).bind("adicionCambioMozo", cambioMozo);
    
    
    
    // Form SUBMITS
    $('#form-mesa-add').submit(agregarNuevaMesa);
    
    
    
    // CLICKS
    $('A[href="#comanda-add-menu"]').click(function(){
        Risto.Adition.adicionar.nuevaComandaParaCurrentMesa();
    })
                 
});


function agregarNuevaMesa(e){
    e.preventDefault();
    
    var rta = $('#form-mesa-add').serializeArray();
        
    var miniMesa = {};
    for (var r in rta ) {
        miniMesa[rta[r].name] = rta[r].value;
    }
    
    var mesa = Risto.Adition.adicionar.crearNuevaMesa(miniMesa.numero, miniMesa.mozo_id);
    Risto.Adition.adicionar.setCurrentMesa( mesa );
    document.getElementById('form-mesa-add').reset(); // limpio el formulario
    $('.ui-dialog').dialog('close');

    return false;
}


function mesaCerrada(){
    alert('mesa cerrada');
}

function mesaCuponPendiente(){
    alert('mesa cupon pendiente');
}

function mesaBorrada(){
    alert('mesa borrada');
}

function mesaCobrada(){
    alert('mesa cobrada');
}



function cambioMozo(e){
}


function mesaSeleccionada(e){
    Risto.Adition.adicionar.setCurrentMesa(e.mesa);
}



function abrirMesa(e) {
    if (!e.mesa.id) {
        setTimeout(function(){abrirMesa(e)},1000);
    } else {
        mesaSeleccionada(e);
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