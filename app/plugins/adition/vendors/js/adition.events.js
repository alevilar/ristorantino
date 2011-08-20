

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
    
    $(document).keydown(buscarAccessKey);

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
    
function buscarAccessKey(e) {
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
    
    console.info(code > 47);
    if ( code > 47){ // desde el numero 0 hasta la ultima letra con simbolos
        // a los 3,5 segundos borrar el string y reiniciarlo
        
        // buscar la mesa con ese numero, busca por accesskey
        Risto.Adition.mesaBuscarAccessKey += String.fromCharCode( code );
        console.debug(Risto.Adition.mesaBuscarAccessKey);
        var domFinded = $("[accesskey='"+Risto.Adition.mesaBuscarAccessKey+"']");
        console.debug( domFinded);
        if ( domFinded.length ) {
            console.info("encontro");
            Risto.Adition.mesaCurrentIndex = $(domFinded[0]);
            domFinded[0].focus();
            Risto.Adition.mesaBuscarAccessKey = ''
        }
        
        setTimeout(function(  ){
            Risto.Adition.mesaBuscarAccessKey = '';
        },3200);
    }
    
}