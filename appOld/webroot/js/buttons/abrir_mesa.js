    
//on ready
(function(){
    
    // Agregar el boton el menu-top
    var btn = {
        'text' : 'Abrir Mesa',
        'id'   : 'abrirMesa',
        'class': 'cuadrado'
    };

    adicion.registerButton(btn, function(){
        var mesa = new Mesa();
        mesa.numero = window.prompt('introduzca número de mesa');

        // si no puso numero salir y eliminar la nueva mesa
        if (!mesa.numero) {
            delete mesa;
            return null;
        }

        var l = adicion.mozosButonizados();
        var container = document.createElement('div');
        $(container).append(l);
        
        $(l).click(function(){
            mesa.abrirlaConMozo.call(mesa, this.mozo);
            $(container).remove();
        });

        
        return $(container);

    });
})();
