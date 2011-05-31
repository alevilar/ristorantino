
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


$(window).load(function(){
    if (adicion.currentMesa) {
        var mesa = adicion.currentMesa;
        var url = document.domain+'mesas/view/'+mesa.id;
        $('#mesa-scroll').load(url);
    }
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
    alert("mesa seleccionada");
    console.info('mesa seleccionada');
    console.debug(e);
}



function abrirMesa(e) {
    alert("mesa abierta");
    adicion.mesas.push(e.mesa);
}