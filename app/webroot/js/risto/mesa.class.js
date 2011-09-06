/**
 * @var Static MESAS_POSIBLES_ESTADOS
 * 
 *  esta variable es simplemenete un catalogo de estados posibles que
 *  la mesa pude adoptar
 *
 **/
var MESA_ESTADOS_POSIBLES =  {
    abierta : {
        msg: 'Mesa Abierta',
        event: 'mesaAbierta',
        id: 1,
        icon: 'mesa-abierta'
    },
    cerrada: {
        msg: 'Mesa Cerrada',
        event: 'mesaCerrada',
        id: 2,
        icon: 'mesa-cerrada'
    },
    cuponPendiente: {
        msg: 'Mesa con Cupón Pendiente',
        event: 'mesaCuponPendiente',
        id: 0,
        icon: ''
    },
    cobrada: {
        msg: 'Mesa Cobrada',
        event: 'mesaCobrada',
        id: 3,
        icon: ''
    },
    borrada: {
        msg: 'Mesa Borrada',
        event: 'mesaBorrada',
        id: 0,
        icon: ''
    },
    seleccionada: {
        msg: 'Mesa Seleccionada',
        event: 'mesaSeleccionada',
        id: 0,
        icon: ''
    }
};

/**
 *
 *Definicion de la Clase Mesa
 *
 **/
var Mesa = function(mozo, jsonData) {
        
        this.totalCalculado = ko.dependentObservable(function(){
            var total = 0, dto = 0, totalText = '$-';
            
            for (var c in this.Comanda()){
                for (dc in this.Comanda()[c].DetalleComanda() ){
                    total += this.Comanda()[c].DetalleComanda()[dc].precio();
                    totalText = '$'+total;
                }
            }
            
            if (this.Cliente() && this.Cliente().Descuento()){
                dto = total * this.Cliente().Descuento().porcentaje() / 100;
                totalText = '$'+total+' - [Dto] $'+dto+' = '+(total - dto);
            }
            return totalText;
        }, this);
        
        
        
        /**
         * 
         * @return boolean
         **/
        this.estaCerrada = ko.dependentObservable(function(){
            return MESA_ESTADOS_POSIBLES.cerrada == this.estado();
        }, this);
        
        
        this.clienteNameData= ko.dependentObservable(function(){
            var cliente = this.Cliente();
            if (cliente){
                return cliente.nombre();
            }
            return '';
        }, this);
        
        
        this.initialize(mozo, jsonData);
         
        return this;
}



Mesa.prototype = {
    model: 'Mesa',
    id: ko.observable(0),
    total: ko.observable(0),
    numero: ko.observable(0),
    mozo_id: ko.observable(0),
    created: ko.observable(0),
    Cliente: ko.observable(),   
    estado: ko.observable(0),
    
    // es la comanda que actualmente se esta haciendo objeto comandaFabrica
    currentComanda: ko.observable(), 
    Comanda: ko.observableArray(),
    
    
    // attributos
    mozo: ko.observable( {} ),
    
    timeAbrio: function(){
        if (!this.timeCreated) {
            Risto.modelizar(this);
        }
        return this.timeCreated();
    },

    initialize: function( mozo, jsonData ) {
        this.id             = ko.observable();
        this.created        = ko.observable();
        this.total          = ko.observable( 0 );
        this.numero         = ko.observable( 0 );
        this.mozo           = ko.observable( new Mozo() );
        this.currentComanda = ko.observable( new Risto.Adition.comandaFabrica() );
        this.Comanda        = ko.observableArray( [] );
        this.mozo_id        = this.mozo().id;
        this.Cliente        = ko.observable();
        this.estado         = ko.observable();
        
        // si vino jsonData mapeo con koMapp
        if ( jsonData ) {
            if (typeof jsonData.Cliente && jsonData.Cliente.id){
                this.Cliente( new Risto.Adition.cliente(jsonData.Cliente) );
            } else {               
                this.Cliente( null );
            }
            delete jsonData.Cliente;
            
            // si aun no fue mappeado
            var mapOps = {
                'Comanda': {
                    create: function(ops) {
                        return new Risto.Adition.comanda(ops.data);
                    },
                    key: function(data) {
                        return ko.utils.unwrapObservable(data.id);
                    }
                }
            }
            
            if (mozo) {
                // meto al mozo sin agregarle la mesa al listado porque seguramente vino en el json
                this.setMozo(mozo, false);
            }
            ko.mapping.fromJS(jsonData, mapOps, this);
        } else {
            if (mozo) {
                // meto al mozo agregandole al mozo
                this.setMozo(mozo, true);
            }
        }
        this.__inicializar_estado();
        
        Risto.modelizar(this);
        
        return this;
    },
    
    __inicializar_estado: function(){
        var estado = MESA_ESTADOS_POSIBLES.abierta;
         if (typeof this.estado_id == 'function' && this.estado_id() ){
            for(var ee in MESA_ESTADOS_POSIBLES){
                if ( MESA_ESTADOS_POSIBLES[ee].id && MESA_ESTADOS_POSIBLES[ee].id == this.estado_id() ){
                    estado = MESA_ESTADOS_POSIBLES[ee];
                    break;
                }
            }
         }
        return this.estado(estado);
    },
    
    
    /**
     * agregar un producto a la comanda que actualmente se esta haciendo
     * no implica que se haya agregado un producto a la mesa.
     * es un estado intermedio de generacion de la comanda
     * @param prod Producto  
     **/
    agregarProducto: function(prod){
        this.currentComanda().agregarProducto(prod);
    },
    
    nuevaComanda: function(){
        this.currentComanda( new Risto.Adition.comandaFabrica(this)  );
    },
    
    getData: function(){
        $.get(this.urlGetData(), function(){
            
        });
    },
    
    urlGetData: function(){return urlDomain+'mesas/ticket_view/'+this.id()},
    urlView: function(){return urlDomain+'mesas/view/'+this.id()},
    urlEdit: function(){return urlDomain+'mesas/edit/'+this.id()},
    urlDelete: function(){return urlDomain+'mesas/delete/'+this.id()},
    urlComandaAdd: function(){return urlDomain+'comandas/add/'+this.id()},
    urlCerrarMesa: function(){return urlDomain+'mesas/cerrarMesa/'+this.id()},
    urlReabrir: function(){return urlDomain+'mesas/reabrir/'+this.id()},
    urlAddCliente: function(clienteId){
        var url = urlDomain+'mesas/addClienteToMesa/'+this.id();
        if (clienteId){
            url += '/'+clienteId;
        }
        url += '.json';
        return url;
    },
    
    /**
     *  Id del elemento que contiene los datos de esta mesa
     *  es utilizada en el action mesas/view
     */
    domElementContainer: function(){return 'mesa-' + this.id();},


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

    

    /**
     * Disparador de triggers para el evento
     *
     **/
    __triggerEventCambioDeEstado: function(){
        var event =  $.Event(this.estado().event);
        event.mesa = this;
        $(document).trigger(event);
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
        
    },

    seleccionar: function() {
        var event =  $.Event(MESA_ESTADOS_POSIBLES.seleccionada.event);
        event.mesa = this;
        $(document).trigger(event);
        return this;
    },
    

    setEstadoAbierta : function(){
        this.setEstado(MESA_ESTADOS_POSIBLES.abierta);
        return this;
    },

    setEstadoCerrada : function(){
        this.setEstado(MESA_ESTADOS_POSIBLES.cerrada);
        return this;
    },

    setEstadoBorrada: function() {
        this.setEstado(MESA_ESTADOS_POSIBLES.borrada);
        return this;
    },

    setEstadoCuponPendiente : function(){        
        this.setEstado(MESA_ESTADOS_POSIBLES.cuponPendiente);
        return this;
    },

    setCobrada : function(){
        this.setEstado(MESA_ESTADOS_POSIBLES.cobrada);
        return this;
    },
    
    setEstado: function(nuevoestado){
        this.estado(nuevoestado);
        this.__triggerEventCambioDeEstado();
    },

    getEstado: function(){
        return this.estado();
    },
    
    getEstadoIcon: function(){
        if (this.estado()){
            return this.estado().icon;
        }
        return '';
    },
        
    
    getEstadoName: function(){
        if (this.estado()){
            return this.estado().msg;
        }
        return '';
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


    setId : function(id){
        this.id = id;
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
                'data[Mesa][estado_id]': MESA_ESTADOS_POSIBLES.abierta.id,
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
     * Si tiene un mozo setteado retorna true, caso contrario false
     * Verifica con el id del mozo (si es CERO es que no tiene mozo)
     * @return Boolean
     */
    tieneMozo: function(){
        return this.mozo().id() ? true: false;
    },


    /**
     * Setea el mozo a la mesa.
     * si agregarMesa es true, se agrega la mesa al listado de mesas del mozo
     * @param nuevoMozo Mozo es el mozo que voy a setear
     * @param agregarMesa Boolean indica si agrego la mesa al listado de mesas que tiene el mozo
     */
    setMozo: function(nuevoMozo, agregarMesa){
        // si la mesa que le quiero agregar, tenia otro mozo
        // lo debo sacar, eliminandole la mesa de su listado de mesas
        if ( this.tieneMozo() ){
            var mozoViejo = this.mozo();
            mozoViejo.sacarMesa(this);
        }
        
        this.mozo_id( nuevoMozo.id() );
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
    },
    
    
    /**
     * Si tiene un detalleComanda modificado dentro del listado de comandas
     * eme devuelve true
     * @return boolean
     */
    tieneComandaModificada: function(){
        var cc, ddcc;
        for (var c in this.Comanda() ) {
            cc = this.Comanda()[c];
            for (var dc in cc.DetalleComanda() ){
                // caa detalle comanda dentro del array de comandas
                ddcc = cc.DetalleComanda()[dc];
                if ( ddcc.modificada() == true ) {
                    return true;
                }
            }
        }
        return false;
    },
    
    
    
    handleAjaxSuccess: function(data, action, method) {
        ko.mapping.updateFromJS( this, data[this.model] );  
    },
    
    
    setCliente: function( objCliente ){
        var ctx = this, clienteId = null;
        
        if (objCliente) {
            clienteId = objCliente.id;
        }
        
        $.get(this.urlAddCliente(clienteId),function(data){
            if ( data.Cliente ){
                ctx.Cliente( new Risto.Adition.cliente(data.Cliente) );
            } else{
                ctx.Cliente(null);
            }
        });
    }
};

