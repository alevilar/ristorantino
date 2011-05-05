(function(){


$(document).bind("mesaSeleccionada", function(e, myName, myValue){
        var elementoContenedorMesa = '#mesa-view';
        var paginaContenedorMesa = '#mesa-scroll';
        var tgt = $(e.target);
        $(elementoContenedorMesa).load(urlDomain+'mesas/view/'+tgt.attr('mesaid'));
        $(paginaContenedorMesa).pagesman();
    });



$(window).load(function(){
    if (adicion.currentMesa) {
        var mesa = adicion.currentMesa;
        var url = document.domain+'mesas/view/'+mesa.id;
        $('#mesa-scroll').load(url);
    }
});



})
