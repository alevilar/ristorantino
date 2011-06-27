
$(document).ready(function() {

    $(document).bind("mesaSeleccionada", mesaSeleccionada);

    // cambios de estado de la mesa
    $(document).bind("mesaAbierta", abrirMesa); //funcion vacia de jQuery
    $(document).bind("mesaCerrada", mesaCerrada);
    $(document).bind("mesaCuponPendiente", mesaCuponPendiente);
    $(document).bind("mesaCobrada", mesaCobrada);
    $(document).bind("mesaBorrada", mesaBorrada);

    $(document).bind("adicionCambioMozo", cambioMozo);
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
    console.info('mesa seleccionada');
    adicion.currentMesa = e.mesa;
    adicion.currentMozo = e.mesa.mozo;
    var mesaContainer = $('<div>');
    mesaContainer.mesa = e.mesa;
    mesaContainer.load(window.urlDomain+'mesas/view/'+e.mesa.id);
    mesaContainer.pagesman();
}



function abrirMesa(e) {
    if (!e.mesa.id) {
        setTimeout(function(){abrirMesa(e)},1000);
    } else {
        mesaSeleccionada(e);
    }
}