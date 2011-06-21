/**
 *  Trigger de los siguientes eventos:
 *      - mozoAgregaMesa
 *      - mozoSacaMesa
 *      - mozoSeleccionado
 * @var Static MOZOS_POSIBLES_ESTADOS
 *
 *  esta variable es simplemenete un catalogo de estados posibles que
 *  la mesa pude adoptar en su variable privada this.__estado
 *
 **/
var MOZOS_POSIBLES_ESTADOS =  {
    agragaMesa : {
        msg: 'El mozo tiene una nueva mesa',
        event: 'mozoAgregaMesa'
    },
    sacaMesa: {
        msg: 'El mozo tiene una mesa menos',
        event: 'mozoSacaMesa'
    },
    seleccionado: {
        msg: 'El mozo fue seleccionado',
        event: 'mozoSeleccionado'
    }
};



function Mozo(){
}


Mozo.prototype = {
    id : 0,
    numero : 0,
    mesas: [],
    seleccionado: false,

    /**
     * devuelve un Button con el elemento mozo
     * @return jQuery Element button
     */
    getButton: function(){
        var btn = document.createElement('button');
        btn.mozo_id = this.id;
        btn.innerHTML = this.numero;
        btn.mozo = this;
        return btn;
    },


    cloneFromJson: function(json){
        //copio solo lo decclarado en el prototype del objecto Mozo
        for (var i in this){
            if ((typeof this[i] != 'function') && (typeof this[i] != 'object')){
                this[i] = json[i];
            }
        }
        return this;
    },


    agregarMesa: function(nuevaMesa){
        this.mesas.push(nuevaMesa);
        var evento = $.Event(MOZOS_POSIBLES_ESTADOS.agragaMesa.event);
        evento.mozo = this;
        $(document).trigger(evento);
    },


    sacarMesa: function(mesa){
        var i = $.inArray(mesa, this.mesas);
        this.mesas.splice(i,1);
        var evento = $.Event(MOZOS_POSIBLES_ESTADOS.sacaMesa.event);
        evento.mozo = this;
        $(document).trigger(evento);
    },

    /**
     * Cuando un mozo es clickeado o elegido, es seleccionado.
     * Se dispara un evento mozoSeleccionado cuando esto ocurre
     */
    seleccionar: function(){
        this.seleccionado = true;
        var eventoMozoSeleccionado = $.Event(MOZOS_POSIBLES_ESTADOS.seleccionado.event);
        eventoMozoSeleccionado.mozo = this;
        $(document).trigger(eventoMozoSeleccionado);
    }
};