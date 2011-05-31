var ventanas = {

    /**
     * COnvierte las "cosas" pasadas en botones.
     * Dado un listado de objetos, los botoniza para que al hacerle
     * click me ejecute un callback sobre este
     *
     * el nombre o texto que el boton contendra es el  fieldMostrar
     */
    botonizar: function(cosas, fieldMostrar ,callback, contextarg){

        //default actions when clicking
        var fnCallback = callback || function(){};
        var context = contextarg || this;

        var container = document.createElement('div');
        var ulCont = document.createElement('ul');
        container.appendChild(ulCont);

        for each (var m in cosas){
            var li = document.createElement('li');
            var but = document.createElement('button');
            but.textContent = m[fieldMostrar];
            but.objeto = m;
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