var ventanas = {


    /**
     * Abre una ventana que permite seleccionar un mozo
     * el mozo seleccionado lo setea en adicion.currentMozo como
     * accion por defecto, aunque se le puede pasar un callback y hacer otra cosa
     * con el mozo devuelto como 1er parametro de la funcion callback
     */
    seleccionDeMozo: function(callback, contextarg){

        //default actions when clicking
        var fnCallback = callback || function(){};
        var context = contextarg || this;

        var container = document.createElement('div');
        var ulCont = document.createElement('ul');
        container.appendChild(ulCont);

        for each (var m in this.mozos){
            var li = document.createElement('li');
            var but = document.createElement('button');
            but.textContent = m.numero;
            but.mozo = m;
            li.appendChild(but);
            ulCont.appendChild(li);
        }
        $(container).dialog();

        $(ulCont).click(function(e){
            if (e.target.mozo){
                $(container).dialog('close');
                fnCallback.call(context, e.target.mozo);
                e.target.mozo.seleccionar();
            }
        });

    }
}