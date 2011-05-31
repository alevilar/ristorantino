/**
 * @var Static MESAS_POSIBLES_ESTADOS
 * 
 *  esta variable es simplemenete un catalogo de estados posibles que
 *  la mesa pude adoptar en su variable privada this.__estado
 *
 **/
var MESA_ESTADOS_POSIBLES =  {
    abierta : {
        msg: 'Mesa Abierta',
        event: 'mesaAbierta'
    },
    cerrada: {
        msg: 'Mesa Cerrada',
        event: 'mesaCerrada'
    },
    cuponPendiente: {
        msg: 'Mesa con Cupón Pendiente',
        event: 'mesaCuponPendiente'
    },
    cobrada: {
        msg: 'Mesa Cobrada',
        event: 'mesaCobrada'
    },
    borrada: {
        msg: 'Mesa Borrada',
        event: 'mesaBorrada'
    },
    seleccionada: {
        msg: 'Mesa Seleccionada',
        event: 'mesaSeleccionada'
    }
};




/**
 *
 *Definicion de la Clase Mesa
 *
 **/
function Mesa() {
    this.objtype = 'mesa';
}



Mesa.prototype = {

    id : 0,
    numero : 0,
    clienteId : null,
    created : null,
    menu : 0,
    modified : null,
    time_cerro : null,
    time_cobro : null,
    total : 0,
    productos : null,
    cliente : null,
    cantComensales : 0,
    mozo: {},

    /** estado de la mesa
     * @var __estado Private
     **/
    __estado: [],
    

    /**
     * con el estado actual __estado, va tirando triggers para el evento
     *
     **/
    __triggerEventCambioDeEstado: function(){
        if (!$.isEmptyObject(this.getEstado())) {
            var estados = this.getEstado();
            for each (estado in estados ) {
                var event =  $.Event(estado.event);
                event.mesa = this;
                $(document).trigger(event);
            }
        }
    },


    cambiarEstadoEnBaseASusDatetimes: function(){
        // seteo elestado a la mesa
        if(this.time_cerro == DATETIME_CERO){
            this.__estado = MESA_ESTADOS_POSIBLES.abierta;
        }
        else if (this.time_cerro != DATETIME_CERO && this.time_cobro == DATETIME_CERO) {
            this.__estado = MESA_ESTADOS_POSIBLES.cerrada;
        }
        else if (this.time_cobro != DATETIME_CERO && this.time_llego_cupon == DATETIME_CERO) {
            this.__estado = MESA_ESTADOS_POSIBLES.cuponPendiente;
        }
        else if (this.time_cobro != DATETIME_CERO) {
            this.__estado = MESA_ESTADOS_POSIBLES.cobrada;
        }
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

    seleccionar: function() {
        this.__estado.push(MESA_ESTADOS_POSIBLES.seleccionada);
        this.__triggerEventCambioDeEstado();
        return this;
    },
    

    setEstadoAbierta : function(){
        this.__estado = [];
        this.__estado.push(MESA_ESTADOS_POSIBLES.abierta);
        this.__triggerEventCambioDeEstado();
        return this;
    },

    setEstadoCerrada : function(){
        this.__estado = [];
        this.__estado.push(MESA_ESTADOS_POSIBLES.cerrada);
        this.__triggerEventCambioDeEstado();
        return this;
    },

    setEstadoBorrada: function() {
        this.__estado = [];
        this.__estado.push(MESA_ESTADOS_POSIBLES.borrada);
        this.__triggerEventCambioDeEstado();
        return this;
    },

    setEstadoCuponPendiente : function(){
        this.__estado = [];
        this.__estado.push(MESA_ESTADOS_POSIBLES.cuponPendiente);
        this.__triggerEventCambioDeEstado();
        return this;
    },

    setCobrada : function(){
        this.__estado = [];
        this.__estado.push(MESA_ESTADOS_POSIBLES.cobrada);
        this.__triggerEventCambioDeEstado();
        return this;
    },

    getEstado: function(){
        return this.__estado;
    },

    /**
     * Me dice si la mesa pidio el cierre y esta pendiente de cobro
     * @return boolean true si ya cerro, false si esta abierta
     */
    estaAbierta : function(){

        return ( $.inArray(MESA_ESTADOS_POSIBLES.abierta, this.getEstado()) );
    },

    /**
     * @deprecated deberia usar estaCerrada
     * Me dice si la mesa pidio el cierre y esta pendiente de cobro
     * @return boolean true si ya cerro, false si esta abierta
     */
    pidioCierre : function(){
        return this.estaCerrada();
    },

    /**
     * 
     * @return boolean
     **/
    estaCerrada : function(){
        return ( $.inArray(MESA_ESTADOS_POSIBLES.cerrada, this.getEstado()));
    },


    setId : function(id){
        this.id = id;
    },


    tieneCliente : function(){
        if (this.cliente.id != null ||this.cliente.id != undefined)
            return true;
        else
            return false;
    },
		
    
    tieneMenu : function(){
        if (this.menu > 0)
            return this.menu;
        else
            return 0;
    },


    getCantComensales : function(){
        return this.cantComensales;
    },


    reimprimir : function(){
        var url = document.referrer+'mesas/imprimirTicket';
        $.post( url+"/"+this.id);
    },



    /**
     * re-abre una mesa
     *
     */
    reabrir : function(url){
        var data = {
                'data[Mesa][time_cerro]': "0000-00-00 00:00:00",
                'data[Mesa][id]': this.id
        };

        $.post(url, data);
        this.setEstadoAbierta();
    },


    cerrar: function(){
        var url = document.referrer + 'mesas/cerrarMesa' + '/' + this.currentMesa.id + '/0';
        var context = this;
        $.get(url, {}, function(){context.setEstadoCerrada();});
    },


    borrar : function(){
        var url = document.referrer + 'mesas/delete/' +this.id;
        var context = this;
        $.get(url, {}, function(){context.setEstadoBorrada()});
    },


    abrir: function(){
        if (this.id) {
            alert('no se puede abrir una mesa que ya esta abierta. El ID ya existe. Consulte con el administrador del Sistema');
            return;
        }
        var context = this;        
        $.post(document.referrer + 'mesas/ajaxAbrirMesa',
                {'data[Mesa][numero]': this.numero, 'data[Mesa][mozo_id]': this.mozo.id},
                function(t, e){
                     context.setEstadoAbierta();
                });
    },

    setMozo: function(nuevoMozo, agregarMesa){
        if (!$.isEmptyObject(this.mozo)){
            var mozoViejo = this.mozo;
            mozoViejo.sacarMesa(this);
        }
        this.mozo = nuevoMozo;
        if (agregarMesa) {
            this.mozo.agregarMesa(this);
        }
    },


    abrirlaConMozo: function(nuevoMozo){
        this.setMozo(nuevoMozo);
        this.abrir();
    }


};