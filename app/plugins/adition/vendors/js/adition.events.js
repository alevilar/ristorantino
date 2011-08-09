
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
    $('#form-mesa-add').submit(function(e){
       e.preventDefault();
        var mesaNumero = $(this).find('input[name$="numero"]').val();
         
        var mozoId =  $(this).find('input[name$="mozo_id"]').val();
       
        var mesa = Risto.Adition.adicionar.crearNuevaMesa(mesaNumero, mozoId);
       
       
        console.debug(mesa);
        Risto.Adition.adicionar.setCurrentMesa( mesa );
        
        $('.ui-dialog').dialog('close');
        
        return false;
    });
    
    
    
    // CLICKS
    $('A[href="#comanda-add-menu"]').click(function(){
        Risto.Adition.adicionar.nuevaComandaParaCurrentMesa();
    })
                 
});


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
