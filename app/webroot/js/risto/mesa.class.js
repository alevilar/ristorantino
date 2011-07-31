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
var Mesa = function(mozo, jsonData) {
        if (jsonData && mozo) {
            return this.initialize(mozo, jsonData);
        }        
}



Mesa.prototype = {
    id: 0,
    comandas: ko.observableArray(),
    
  
    
    // attributos
    mozo: ko.observable(null),

    initialize: function(mozo, jsonData){
        this.mozo = ko.observable(mozo);
        
        // si vino jsonData mapeo con koMapp
        if ( mozo && jsonData ) {
            ko.mapping.fromJS(jsonData, {}, this);
        }
        
        return this;
    },
    
    urlView: function(){return urlDomain+'mesas/view/'+this.id()},
    urlEdit: function(){return urlDomain+'mesas/edit/'+this.id()},
    urlComandaAdd: function(){return urlDomain+'comandas/add/'+this.id()},
    
    /**
     *  Id del elemento que contiene los datos de esta mesa
     *  es utilizada en el action mesas/view
     */
    domElementContainer: function(){ return 'mesa-' + this.id(); },


    /**
     * devuelve un Button con el elemento mesa
     * @return jQuery Element button
     */
    getButton: function(){
        if (this.hasOwnProperty('mozo') && !this.button) {
            var btn = document.createElement('button');
            btn.setAttribute('mozo_id', this.mozo.id);
            btn.mesa_id = this.id;
            btn.innerHTML = this.numero;
            btn.mesa = this;
            this.button = btn;
            var cntx = this;
            this.button.onclick = function(){
                cntx.seleccionar.call(cntx)
            }
        }
        return this.button;
    },

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
            for (estado in estados ) {
                var event =  $.Event(estados[estado].event);
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
        //copio solo lo decclarado en el prototype de este modelo
        for (var i in this){
            if ((typeof this[i] != 'function') && (typeof this[i] != 'object')){
                this[i] = json[i];
            }

            if ((typeof this[i] == 'function') && json.hasOwnProperty(i) && (typeof this[i] != 'object')){
                this[i](json[i]);
            }
        }
        return this;
    },

    deseleccionar: function() {
        for (var e in this.__estado){
            if (this.__estado[e] == MESA_ESTADOS_POSIBLES.seleccionada) {
                var idx = this.__estado.indexOf(this.__estado[e]);
                if(idx!=-1) this.__estado.splice(idx, 1);
            }
        }

    },

    seleccionar: function() {
        var event =  $.Event(MESA_ESTADOS_POSIBLES.seleccionada.event);
        event.mesa = this;
        $(document).trigger(event);
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
        return this.cantComensales();
    },


    reimprimir : function(){
        var url = window.urlDomain+'mesas/imprimirTicket';
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
        var url = window.urlDomain + 'mesas/cerrarMesa' + '/' + this.currentMesa.id + '/0';
        var context = this;
        $.get(url, {}, function(){context.setEstadoCerrada();});
    },


    borrar : function(){
        var url = window.urlDomain + 'mesas/delete/' +this.id;
        var context = this;
        $.get(url, {}, function(){context.setEstadoBorrada()});
    },


    __abrir: function(){
        if (this.id) {
            alert('no se puede abrir una mesa que ya esta abierta. El ID ya existe. Consulte con el administrador del Sistema');
            return;
        }
        var context = this;
        alert("voy a abrir");
        var response = $.post( urlDomain + 'mesas/abrirMesa.json',
                {'data[Mesa][numero]': this.numero, 'data[Mesa][mozo_id]': this.mozo.id},
                function() {
                    context.setEstadoAbierta();
                },
            'json');
            
         response.error = function(t) {
             alert("error de ajax: "+t);
         }
    },

    /**
     * Setea el mozo a la mesa.
     * si agregarMesa es true, se agrega la mesa al listado de mesas del mozo
     * @param nuevoMozo Mozo es el mozo que voy a setear
     * @param agregarMesa Boolean indica si agrego la mesa al listado de mesas que tiene el mozo
     */
    setMozo: function(nuevoMozo, agregarMesa){
        if ( this.mozo() ){
            var mozoViejo = this.mozo();
            mozoViejo.sacarMesa(this);
        }
        this.mozo(nuevoMozo);
        if (agregarMesa) {
            this.mozo().agregarMesa(this);
        }
    },


    abrirlaConMozo: function(nuevoMozo){
        this.setMozo(nuevoMozo);
        return this.__abrir();
    },


    editar: function(data) {
        if (!data['data[Mesa][id]']){
            data['data[Mesa][id]'] = this.id;
        }
        $.post( window.urlDomain +'mesas/ajax_edit', data);
    },
    
    
    
    keepUpdated: function() {
        $.PeriodicalUpdater({
            url: urlDomain+'/comandas/de_mesa/'+this.id()
        }, function(data) {
            console.debug(data);
        });
    }



};