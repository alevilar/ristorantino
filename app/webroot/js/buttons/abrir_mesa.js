(function($){

//on ready
$(function(){
    
    // Agregar el boton el menu-top
    var btn = {
        'text': 'Abrir Mesa',
        'id' : 'abrirMesa',
        'class': 'cuadrado',
        'onclick': function(){adicion.abrirMesa.call(adicion)}
    }

    adicion.addButton(btn, 'menu-top');




    /**
     *
     * Extends Adicion
     *
    * Esta funcion es para cuando yo abro una nueva mesa,
    *  me muestra el form input con un PAD numerico
    */
    adicion.addMethod('abrirMesa', function(){
        var mesa = new Mesa();
        mesa.numero = window.prompt('introduzca número de mesa');

        // si no puso numero salir y eliminar la nueva mesa
        if (!mesa.numero) {
            delete mesa;
            return;
        }

        var l = adicion.butonizar(adicion.mozos);
        adicion.nombrificar(l,'numero');
        $(l).click(function(){
                    $(container).dialog('close');
                    mesa.abrirlaConMozo.call(mesa, this.obj)
                                });


        var container = document.createElement('div');
        $(container).dialog();
        $(l).appendTo(container);

    });
});

})(jQuery);