var ventanas = {

    /**
     * COnvierte las "cosas" pasadas en botones.
     * Dado un listado de objetos, los botoniza para que al hacerle
     * click me ejecute un callback sobre este
     * @param object ops
     *              string field es el campo del objeto que quiero que se muestre
     *              function callback es la funcion que se ejecutaria al hacer click en el boton generado
     *              object context es el contexto de la funcion callback. Sino utiliza this, pero hay que saber que this en un onClick referencia al boton clickeado
     * el nombre o texto que el boton contendra es el  fieldMostrar
     */
    botonizar: function(cosas, ops){

        //default actions when clicking
        var fnCallback = ops.callback || function(){};
        var context = ops.contextarg || this;
        var fieldMostrar = ops.field||'name';
        // css class
         var containerClass = '';

        if (ops.hasOwnProperty('class')) {
            containerClass = ops['class'];
        }

        var container = document.createElement('div');
        container.className = containerClass;
        var ulCont = document.createElement('ul');
        container.appendChild(ulCont);

        for (var m in cosas){
            var li = document.createElement('li');
            var but = document.createElement('button');
            but.textContent = cosas[m][fieldMostrar];
            but.objeto = cosas[m];
            li.appendChild(but);
            ulCont.appendChild(li);
        }

        $(container).dialog();

        $(ulCont).click(function(e){
            if (e.target.objeto){
                $(container).dialog('close');
                fnCallback.call(context, e.target.objeto);
            }
        });

    }
}