
$(document).ready(function() {

    $(document).bind("mesaSeleccionada", mesaSeleccionada);


    // cambios de estado de la mesa
    $(document).bind("mesaAbierta", $.noop); //funcion vacia de jQuery
    $(document).bind("mesaCerrada", fnVacia);
    $(document).bind("mesaCuponPendiente", fnVacia);
    $(document).bind("mesaCobrada", fnVacia);
    $(document).bind("mesaBorrada", fnVacia);

    $(document).bind("adicionCambioMozo", cambioMozo);
});


$(window).load(function(){
    if (adicion.currentMesa) {
        var mesa = adicion.currentMesa;
        var url = document.domain+'mesas/view/'+mesa.id;
        $('#mesa-scroll').load(url);
    }
});


function fnVacia(){return;}



function cambioMozo(e){
}


function mesaSeleccionada(){
    alert("mesa seleccionada");
    var elementoContenedorMesa = '#mesa-view';
    var paginaContenedorMesa = '#mesa-scroll';
    var tgt = $(e.target);
    $(elementoContenedorMesa).load(urlDomain+'mesas/view/'+tgt.attr('mesaid'));
    $(paginaContenedorMesa).pagesman();
}

